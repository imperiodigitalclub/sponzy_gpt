<?php

namespace App\Http\Controllers;
require_once 'vendor/autoload.php';
use App\Helper;
use App\Models\User;
use App\Models\Plans;
use MercadoPago\Payment;
use MercadoPago\SDK;
use MercadoPago\Preapproval;
use App\Models\Updates;
use App\Models\Deposits;
use App\Models\Messages;
use App\Models\Transactions;
use Illuminate\Http\Request;
use App\Models\Notifications;
use App\Models\Subscriptions;
use App\Models\PaymentGateways;
use Illuminate\Support\Facades\Log;
use MercadoPago\Client\Common\RequestOptions;
use App\Jobs\CheckPixStatusJob;
use Carbon\Carbon;
use Exception;

class MercadoPagoController extends Controller
{
    use Traits\Functions;
    public function formAddUpdatePaymentCard()
    {
        // TODO - Parâmetros p view
        $payment = PaymentGateways::whereName('Mercadopago')->firstOrFail();
        return view('users.mp_add_payment_card', data: ["data" => "data"]);
    } // End Method

    public function cardPayPlan(Request $request)
    {
        try {
            $token = $request->input('token');

            if (!$token) {
                return response()->json(['status' => 'error', 'message' => 'Missing required parameters.'], 400);
            }

            $validated = $request->validate([
                'creator_id' => 'required|exists:users,id',
                'plan_id' => 'required|exists:plans,id',
                'interval' => 'required|string',
            ]);

            $creator = User::findOrFail($validated['creator_id']);
            $plan = Plans::findOrFail($validated['plan_id']);
            $paymentGateway = PaymentGateways::whereName('Mercadopago')->firstOrFail();
            $accessToken = $paymentGateway->key_secret;

            // Definir frequency e frequency_type com base no intervalo do plano
            switch ($plan->interval) {
                case 'weekly':
                    $frequency_type = 'days';
                    $frequency = 7;
                    break;
                case 'monthly':
                    $frequency_type = 'months';
                    $frequency = 1;
                    break;
                case 'quarterly':
                    $frequency_type = 'months';
                    $frequency = 3;
                    break;
                case 'biannually':
                    $frequency_type = 'months';
                    $frequency = 6;
                    break;
                case 'yearly':
                    $frequency_type = 'months';
                    $frequency = 12;
                    break;
                default:
                    return response()->json(['status' => 'error', 'message' => 'Invalid plan interval.'], 400);
            }

            $payload = [
                'back_url' => url('/success'),
                'reason' => 'Subscription for plan ' . $validated['plan_id'],
                'auto_recurring' => [
                    'frequency' => $frequency,
                    'frequency_type' => $frequency_type,
                    'transaction_amount' => $plan->price,
                    'currency_id' => 'BRL',
                ],
                'payer_email' => $request->input('email'), // TODO - Replace to user/buyer email
                'card_token_id' => $token,
            ];

            // Make the request to the MercadoPago /preapproval endpoint
            $ch = curl_init('https://api.mercadopago.com/preapproval');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Authorization: Bearer ' . $accessToken,
                'Content-Type: application/json',
            ]);

            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($httpCode === 201 || $httpCode === 200) {
                $responseData = json_decode($response);
                // TODO - Laravel log response  to debug

                if ($responseData->status === 'authorized') {
                    // TODO - Handle approved payment (..)



                    return response()->json([
                        'status' => 'success',
                        'message' => 'Payment authorized and subscription created successfully.',
                        'subscription_id' => $responseData->id,
                    ]);
                } elseif ($responseData->status === 'pending') {
                    // TODO - Handle pending payment
                    return response()->json([
                        'status' => 'pending',
                        'message' => 'Payment pending, verification scheduled.',
                    ]);
                } else {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Unexpected payment status: ' . $responseData->status,
                    ]);
                }
            } else {
                $errorData = json_decode($response, true);
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to process payment.',
                    'details' => $errorData,
                ], $httpCode);
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while processing the payment.',
                'details' => $e->getMessage(),
            ], 500);
        }
    }

    public function generatePix(Request $request)
    {
        try {
              \Log::info('gerando pix...:');
            $validated = $request->validate([
                'plan_id' => 'required|exists:plans,id',
                'interval' => 'required|string',
            ]);

            $plan = Plans::findOrFail($validated['plan_id']);
            $paymentGateway = PaymentGateways::whereName('Mercadopago')->firstOrFail();
            $accessToken = $paymentGateway->key_secret;

            // Dados do pagamento
            $userName = auth()->user()->name;
            $nameParts = explode(' ', $userName, 2);
            $firstName = $nameParts[0];
            $lastName = $nameParts[1] ?? '';

            $paymentData = [
                "description" => sprintf("%s-%s-%s", auth()->user()->id, $plan->id, now()->timestamp),
                "transaction_amount" => (float) $plan->price,
                "payment_method_id" => "pix",
                "payer" => [
                    "email" => auth()->user()->email,
                    "first_name" => $firstName,
                    "last_name" => $lastName,
                ],
                "installments" => 1,
                "external_reference" => "MP" . auth()->user()->id . "-" . now()->timestamp,
            ];

            // Iniciando a cURL
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://api.mercadopago.com/v1/payments');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Authorization: Bearer ' . $accessToken,
                'X-Idempotency-Key: ' . uniqid('', true),
            ]);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($paymentData));

            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($httpCode == 201 || $httpCode == 200) {
                $paymentResponse = json_decode($response);

                // Salvar no pix-history.json
                $historyFile = storage_path('app/pix-history.json');
                $pixData = [
                    'transaction_id' => $paymentResponse->id,
                    'plan_id' => $validated['plan_id'],
                    'user_id' => auth()->user()->id,
                    'timestamp' => now()->toDateTimeString(),
                    'status' => 'pending',
                ];

                $history = [];
                if (file_exists($historyFile)) {
                    $history = json_decode(file_get_contents($historyFile), true);
                }
                $history[] = $pixData;
                file_put_contents($historyFile, json_encode($history, JSON_PRETTY_PRINT));

                // Dispatch CheckPixStatusJob com delay
                CheckPixStatusJob::dispatch($paymentResponse->id, auth()->user()->id, $validated['plan_id'])->delay(now()->addHour(1));
                CheckPixStatusJob::dispatch($paymentResponse->id, auth()->user()->id, $validated['plan_id'])->delay(now()->addHours(12));

                return response()->json([
                    'status' => 'success',
                    'qr_code_base64' => $paymentResponse->point_of_interaction->transaction_data->qr_code_base64,
                    'qr_code' => $paymentResponse->point_of_interaction->transaction_data->qr_code,
                    'id' => $paymentResponse->id,
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Erro ao gerar o pagamento via Pix.',
                ], 400);
            }
        } catch (Exception $e) {
            Log::error('Erro generatePix: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'Erro ao gerar Pix.',
            ], 500);
        }
    }
    protected function checkPixStatus(Request $request)
    {
        try {
            $validated = $request->validate([
                'transaction_id' => 'required|string',
            ]);

            $transactionId = $validated['transaction_id'];
            $paymentGateway = PaymentGateways::whereName('Mercadopago')->firstOrFail();
            $accessToken = $paymentGateway->key_secret;

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://api.mercadopago.com/v1/payments/{$transactionId}");
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

                $historyFile = storage_path('app/pix-history.json');
                $history = file_exists($historyFile) ? json_decode(file_get_contents($historyFile), true) : [];

                foreach ($history as &$pix) {
                    if ((string) $pix['transaction_id'] === (string) $transactionId) {
                        $pix['status'] = $status;
                        if ($status === 'approved') {
                            \Log::info('approved');
                            $this->createPlanPix($pix['user_id'], $pix['plan_id']);
                            // TODO - Update pix-history.json
                        }
                        \Log::info('not approved');
                        break;
                    }
                }

                file_put_contents($historyFile, json_encode($history, JSON_PRETTY_PRINT));

                return response()->json([
                    'status' => 'success',
                    'payment_status' => $status,
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Falha ao verificar status do Pix.',
                ], $httpCode);
            }
        } catch (Exception $e) {
            Log::error("Error in checkPixStatus: {$e->getMessage()}");
            return response()->json([
                'status' => 'error',
                'message' => 'Erro inesperado ao verificar status do Pix.',
            ], 500);
        }
    }

    protected function createPlanPix($userId, $planId)
    {
        try {
            \Log::info('createPlanPix - userId:' . $userId . ' - planId: ' . $planId);

            // Find the Plan
            $plan = Plans::whereId($planId)->firstOrFail();

            // Find the Creator from the Plan
            $creator = User::whereId($plan->user_id)
                ->whereVerifiedId('yes')
                ->firstOrFail();

            // Check if Plan exists
            $plan = $creator->plans()
                ->whereId($planId)
                ->firstOrFail();

            // Verify the plan is active
            if (!$plan->status) {
                return response()->json([
                    'success' => false,
                    'errors' => ['error' => __('general.subscription_not_available')],
                ]);
            }

            // Insert Subscription into DB
            $subscription = new Subscriptions();
            $subscription->user_id = auth()->id();
            $subscription->creator_id = $creator->id;
            $subscription->stripe_price = $plan->name;
            $subscription->ends_at = $creator->planInterval($plan->interval);
            $subscription->interval = $plan->interval;
            $subscription->rebill_wallet = 'off'; // Disable wallet rebilling by default for Pix
            $subscription->taxes = auth()->user()->taxesPayable();
            $subscription->save();

            // Admin and user earnings calculation
            $amount = $plan->price;
            $earnings = $this->earningsAdminUser($creator->custom_fee, $amount, null, null);

            // Insert Transaction
            $this->transaction(
                'subpix_' . str_random(25),
                auth()->id(),
                $subscription->id,
                $creator->id,
                $amount,
                $earnings['user'],
                $earnings['admin'],
                'Pix',
                'subscription',
                $earnings['percentageApplied'],
                auth()->user()->taxesPayable()
            );

            // Add earnings to creator's balance
            $creator->increment('balance', $earnings['user']);

            // Send email and notification
            Subscriptions::sendEmailAndNotify(auth()->user()->name, $creator->id);

            $this->sendWelcomeMessageAction($creator, auth()->id());

            return response()->json([
                'success' => true,
                'url' => url('buy/subscription/success', $creator->username)
            ]);
        } catch (Exception $e) {
            Log::error("Erro em createPlanPix: {$e->getMessage()}");
            return response()->json([
                'success' => false,
                'message' => 'Erro ao verificar o status do Pix. Contate o administrador.',
            ]);
        }
    }

    public function createPlan()
    {
        try {
            /** CODE ABOVE IS FROM CCBillController.php (contains all steps we must execute when approved) - Take me to a single method so I can be called anywhere bb
                     
                       if ($request->{'X-type'} == 'subscription') {

                        // Find user
                        $creator = User::whereId($request->{'X-creator'})
                            ->whereVerifiedId('yes')
                            ->firstOrFail();

                        // Check if Plan exists
                        $plan = $creator->plans()
                            ->whereInterval($request->{'X-planInterval'})
                            ->firstOrFail();

                        // Subscription ID
                        $subscr_id = $request->subscriptionId;

                        // Amount
                        $amount = $request->{'X-priceOriginal'};

                        $userID = $request->{'X-user'};

                        // Subscription
                        $subscription = Subscriptions::where('subscription_id', $subscr_id)->first();

                        if (!isset($subscription)) {
                            // Insert DB
                            $subscription          = new Subscriptions();
                            $subscription->user_id = $userID;
                            $subscription->creator_id = $creator->id;
                            $subscription->stripe_price = $plan->name;
                            $subscription->subscription_id = $subscr_id;
                            $subscription->ends_at = $creator->planInterval($plan->interval);
                            $subscription->interval = $plan->interval;
                            $subscription->save();

                            $this->sendWelcomeMessageAction($creator, $userID);

                            // Send Notification
                            if ($creator->notify_new_subscriber == 'yes') {
                            Notifications::send($creator->id, $userID, 1, $userID);
                            }
                        }

                        // Admin and user earnings calculation
                        $earnings = $this->earningsAdminUser($creator->custom_fee, $amount, $payment->fee, $payment->fee_cents);

                        // Insert Transaction
                        $this->transaction(
                            $request->transactionId,
                            $userID,
                            $subscription->id,
                            $creator->id,
                            $amount,
                            $earnings['user'],
                            $earnings['admin'],
                            'CCBill',
                            'subscription',
                            $earnings['percentageApplied'],
                            $request->{'X-taxes'} ?? null
                        );

                        // Add Earnings to User
                        $creator->increment('balance', $earnings['user']);
                        }
                     */
        } catch (Exception $e) {

        }
    }

    public function buyPlan(Request $request)
    {
        // TODO - Validar todos campos obrigatórios para criar uma assinatura
        $validated = $request->validate([
            'creator_id' => 'required|exists:users,id',
            'plan_id' => 'required|exists:plans,id',
            'price' => 'required|numeric',
            'interval' => 'required|string',
        ]);

        $creator = User::findOrFail($validated['creator_id']);
        $plan = Plans::findOrFail($validated['plan_id']);

        /**
         * TODO - Identificar card_token da request e criar assinatura com api do mercadopago (cURL POST)
         * 
         *  Interval deve ser definido baseado no modelo selecionado:
         * switch ($plan->interval) {
            case 'weekly':
                $frequency_type = 'days';
                frequency = 7;
                break;

            case 'monthly':
                $frequency_type = 'MONTH';
                frequency = 1;
                break;

            case 'quarterly':
                $frequency_type = 'MONTH';
                frequency = 3;
                break;

            case 'biannually':
                $frequency_type = 'MONTH';
                frequency = 6;
                break;

            case 'yearly':
                $frequency_type = 'YEAR';
                frequency = 1;
                break;
         * 
         */

        return view('users.mp_add_payment_card', [
            'creator' => $creator,
            'plan' => $plan,
            'price' => $validated['price'],
            'interval' => $validated['interval'],
        ]);
    }

    public function cancelSubscription($id)
    {
        $subscription = auth()->user()->userSubscriptions()->whereId($id)->firstOrFail();
        $creator = Plans::whereName($subscription->stripe_price)->first();

        // Delete Subscription
        $subscription->cancelled = 'yes';
        $subscription->save();

        session()->put('subscription_cancel', __('general.subscription_cancel'));

        return redirect($creator->user()->username);
    }
}