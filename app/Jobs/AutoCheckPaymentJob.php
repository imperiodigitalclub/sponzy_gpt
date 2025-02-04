<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\PaymentGateways;
use App\Models\Deposits;
use App\Models\User;
use App\Http\Controllers\AddFundsController;
use Exception;

class AutoCheckPaymentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $transactionId;
    protected $external_reference;

    public function __construct($transactionId, $external_reference)
    {
        $this->transactionId = $transactionId;
        $this->external_reference = $external_reference;
    }

    public function handle()
    {
        try {
            \Log::info("AutoCheckPaymentJob: iniciando consulta [$this->external_reference] [$this->transactionId]");

            // Get Payment Gateway
            $payment = PaymentGateways::whereName('Mercadopago')->firstOrFail();

            // Construct the URL for the API request
            $url = 'https://api.mercadopago.com/v1/payments/search?' .
                'sort=date_created&criteria=desc&external_reference=' . urlencode($this->external_reference) .
                '&range=date_created&begin_date=NOW-30DAYS&end_date=NOW';

            // Initialize cURL
            $ch = curl_init();

            // Set cURL options
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Authorization: Bearer ' . $payment->key_secret,
            ]);

            // Execute the API request
            $response = curl_exec($ch);

            // Check for cURL errors
            if (curl_errno($ch)) {
                throw new Exception('cURL Error: ' . curl_error($ch));
            }

            // Close cURL
            curl_close($ch);

            // Decode the response
            $searchResults = json_decode($response, true);
            \Log::info('Payment Search Results: ' . json_encode($searchResults));

            // Extract the payment data (assuming there's a result)
            if (isset($searchResults['results']) && count($searchResults['results']) > 0) {
                $paymentData = $searchResults['results'][0]; // Pegando o primeiro resultado
                \Log::info("Payment found: " . json_encode($paymentData));
            } else {
                \Log::info('Payment not found for external_reference: ' . $this->external_reference);
                throw new Exception('Payment not found');
            }

            \Log::info('AutoCheckPaymentJob: ' . $paymentData['status'] . ' - tid [' . $this->transactionId . ']');

            // Extract the userId from external_reference
            preg_match('/userId=(\d+)/', $this->external_reference, $matches);
            $userId = isset($matches[1]) ? $matches[1] : null;

            if (!$userId) {
                throw new Exception('User ID not found in external_reference');
            }

            // Verify if the payment has already been processed
            $verifyTxnId = Deposits::whereTxnId($this->transactionId)->first();

            if (!isset($verifyTxnId) && $paymentData['status'] == 'approved') {
                $this->deposit(
                    $userId,
                    $this->transactionId,
                    $paymentData['transaction_amount'],
                    'Mercadopago',
                    null
                );

                /*
                // Insert Deposit
                Deposits::create([
                    'user_id' => $userId,
                    'txn_id' => $this->transactionId,
                    'amount' => $paymentData['transaction_amount'],
                    'gateway' => 'Mercadopago',
                ]);
                */

                // Add funds to user
                User::find($userId)->increment('wallet', $paymentData['transaction_amount']);
            }
        } catch (Exception $e) {
            \Log::error("Error in AutoCheckPaymentJob: " . $e->getMessage());
        }
    }

    public function deposit($userId, $txnId, $amount, $paymentGateway, $taxes, $screenshotTransfer = '')
	{
		$payment = PaymentGateways::whereName($paymentGateway)->firstOrFail();
		$paymentFee = $payment->fee;
		$paymentFeeCents = $payment->fee_cents;

		// Percentage applied
		$percentageApplied =  $paymentFeeCents == 0.00 ?
			(($paymentFee != 0.0) ? $paymentFee . '%' : null)
			: (($paymentFee != 0.0) ? $paymentFee . '% + ' : null) . $paymentFeeCents;

		// Percentage applied amount
		$transactionFeeAmount = number_format($amount + ($amount * $paymentFee / 100) + $paymentFeeCents, 2, '.', '');
		$transactionFee = ($transactionFeeAmount - $amount);

		$sql = new Deposits();
		$sql->user_id = $userId;
		$sql->txn_id = $txnId;
		$sql->amount = $amount;
		$sql->payment_gateway = $paymentGateway;
		$sql->status = $paymentGateway == 'Bank' ? 'pending' : 'active';
		$sql->screenshot_transfer = $screenshotTransfer;
		$sql->percentage_applied = $percentageApplied;
		$sql->transaction_fee = $transactionFee;
		$sql->taxes = $taxes;
		$sql->save();

		return $sql;
	} // End Method
}