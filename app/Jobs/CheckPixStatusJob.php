<?php

namespace App\Jobs;

use App\Models\PaymentGateways;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
//use App\Http\Controllers\MercadoPagoController;

class CheckPixStatusJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $transactionId;
    protected $userId;
    protected $planId;

    /**
     * Create a new job instance.
     *
     * @param string $transactionId
     * @param int $userId
     * @param int $planId
     */
    public function __construct($transactionId, $userId, $planId)
    {
        $this->transactionId = $transactionId;
        $this->userId = $userId;
        $this->planId = $planId;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        try {
            Log::info('Checking Pix status via Job...', ['transactionId' => $this->transactionId]);
            $paymentGateway = PaymentGateways::whereName('Mercadopago')->firstOrFail();
            $accessToken = $paymentGateway->key_secret;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api.mercadopago.com/v1/payments/{$this->transactionId}");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Authorization: Bearer ' . $accessToken,
            ]);

            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($httpCode === 200 || $httpCode === 201) {
                $paymentResponse = json_decode($response);
                $status = $paymentResponse->status;

                // Atualiza o histórico do Pix
                $historyFile = storage_path('app/pix-history.json');
                $history = file_exists($historyFile) ? json_decode(file_get_contents($historyFile), true) : [];

                foreach ($history as &$pix) {
                    if ((string) $pix['transaction_id'] === (string) $this->transactionId) {
                        $pix['status'] = $status;

                        if ($status === 'approved') {
                            Log::info('Pix approved via Job.', ['transactionId' => $this->transactionId]);
                            app('App\Http\Controllers\MercadoPagoController')->createPlanPix($this->userId, $this->planId);
                        }

                        break;
                    }
                }

                file_put_contents($historyFile, json_encode($history, JSON_PRETTY_PRINT));
            } else {
                Log::error("Failed to check Pix status via Job.", ['transactionId' => $this->transactionId]);
            }
        } catch (\Exception $e) {
            Log::error("Error in CheckPixStatusJob: {$e->getMessage()}");
        }
    }
}