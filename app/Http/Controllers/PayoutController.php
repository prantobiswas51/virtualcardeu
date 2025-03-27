<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class PayoutController extends Controller
{
    protected $apiKey;
    protected $bearerToken;
    protected $baseUrl = 'https://api.nowpayments.io/v1';

    public function __construct()
    {
        $this->apiKey = config('paypal.nowpayment_key');
    }

    public function index()
    {
        return view('payout');
    }

    public function handlePaypalCallback(Request $request)
    {
        if (!$request->has('code')) {
            return response()->json(['error' => 'Missing authorization code'], 400);
        }

        $code = $request->query('code');
        $clientId = config('paypal.client_id');
        $clientSecret = config('paypal.secret');
        // $paypalEnv = config('paypal.env', 'sandbox');

        $paypalUrl = "https://api-m.paypal.com";

        try {
            $client = new Client();

            // Step 1: Exchange Authorization Code for Access Token
            $response = $client->post("$paypalUrl/v1/identity/openidconnect/tokenservice", [
                'auth' => [$clientId, $clientSecret],
                'form_params' => [
                    'grant_type' => 'authorization_code',
                    'code' => $code,
                ]
            ]);

            $data = json_decode($response->getBody(), true);
            $accessToken = $data['access_token'];

            // Step 2: Get User Info (Email & PayPal ID)
            $userResponse = $client->get("$paypalUrl/v1/oauth2/token/userinfo?schema=openid", [
                'headers' => [
                    'Authorization' => "Bearer $accessToken",
                    'Content-Type' => 'application/json',
                ]
            ]);

            $userData = json_decode($userResponse->getBody(), true);

            $user = Auth::user();
            $user->paypal_id = $userData['payer_id'];
            $user->paypal_email = $userData['email'];
            $user->save();

            Mail::raw('Your Paypal Account is Linked Now!', function ($message) {
                $message->to(Auth::user()->email)
                    ->subject('Virtual Card EU');
            });

            return redirect()->route('payout')->with('message', 'Paypal Connected Successfully!');
        } catch (\Exception $e) {
            Log::error("PayPal Callback Error: " . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'PayPal authentication failed.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function paypalPayout(Request $request)
    {
        // Validate request
        $request->validate([
            'total_amount' => 'required|numeric|min:1',
        ]);

        $total_amount = $request->total_amount;
        $amount_to_payout = $total_amount - ($total_amount * 0.05);

        // Check if user has a PayPal email
        if (!Auth::user()->paypal_email) {
            return redirect()->route('payout')->with('message', 'Paypal Email Not Found!');
        }

        // Check if user has enough balance
        if (Auth::user()->balance < $total_amount) {
            return redirect()->route('payout')->with('message', 'Not enough balance left!');
        }

        // Get PayPal credentials
        $clientId = config('paypal.client_id');
        $clientSecret = config('paypal.secret');
        // $paypalEnv = config('paypal.env', 'sandbox');
        $paypalUrl = "https://api-m.paypal.com";

        try {
            $client = new Client();

            // Step 1: Get Access Token
            $authResponse = $client->post("$paypalUrl/v1/oauth2/token", [
                'headers' => [
                    'Authorization' => 'Basic ' . base64_encode("$clientId:$clientSecret"),
                    'Content-Type' => 'application/x-www-form-urlencoded'
                ],
                'form_params' => [
                    'grant_type' => 'client_credentials'
                ]
            ]);

            $authData = json_decode($authResponse->getBody(), true);
            $accessToken = $authData['access_token'];

            // Step 2: Make Payout API Call
            $payoutResponse = $client->post("$paypalUrl/v1/payments/payouts", [
                'headers' => [
                    'Authorization' => "Bearer $accessToken",
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'sender_batch_header' => [
                        'email_subject' => "VirtualCardEU payout!",
                        'email_message' => "Payout Received! Thanks for using VirtualCardEU!",
                    ],
                    'items' => [
                        [
                            'recipient_type' => "EMAIL",
                            'receiver' => Auth::user()->paypal_email,
                            'amount' => [
                                'value' => $total_amount,
                                'currency' => "USD",
                            ],
                            'note' => 'Payout from VirtualCardEU',
                            'sender_item_id' => uniqid(),
                        ]
                    ]
                ]
            ]);

            $payoutData = json_decode($payoutResponse->getBody(), true);

            // Check if we received a valid payout batch ID
            $paymentId = $payoutData['batch_header']['payout_batch_id'] ?? null;

            if (!$paymentId) {
                return redirect()->route('payout')->with('message', 'No Payment Batch ID received');
            }

            // Step 3: Save Transaction
            $transaction = new Transaction();
            $transaction->user_id = Auth::id();
            $transaction->payment_method = 'Paypal';
            $transaction->payment_id = $paymentId;
            $transaction->payer_email = Auth::user()->paypal_email;
            $transaction->amount = $total_amount;
            $transaction->type = 'withdrawal';
            $transaction->status = 'pending'; // Initially set as pending
            $transaction->save();

            // Step 4: Deduct balance
            Auth::user()->decrement('balance', $total_amount);

            // Log response
            Log::info("PayPal Payout Response", $payoutData);

            // Redirect with safer data passing
            return redirect()->route('payout_success', [
                'payment_id' => $paymentId,
                'amount' => $amount_to_payout
            ])->with('payout_email', Auth::user()->paypal_email);
        } catch (\Exception $e) {
            Log::error("PayPal Payout Error: " . $e->getMessage());

            return redirect()->route('payout', compact([
                'message' => 'Payout failed. Please try again later or contact support!',
                'error' => $e->getMessage()
            ]));
        }
    }

    // paypal success payout
    public function success(Request $request)
    {
        $payment_id = $request->query('payment_id');
        $amount = $request->query('amount');
        $payout_email = $request->query('payout_email');

        return view('payout_success', compact('payment_id', 'amount', 'payout_email'));
    }

    public function handlePaypalWebhook(Request $request)
    {
        $payload = $request->all();
        Log::info('PayPal Webhook Received', $payload);

        $eventType = $payload['event_type'] ?? null;
        $resource = $payload['resource'] ?? [];

        if (!$eventType) {
            return response()->json(['message' => 'Invalid request'], 400);
        }

        // Extract payout details
        $payoutItemId = $resource['payout_item_id'] ?? null;
        $transactionId = $resource['transaction_id'] ?? null;
        $transactionStatus = strtolower($resource['transaction_status'] ?? 'PENDING'); // Make it lowercase for easy comparison

        if (!$payoutItemId) {
            Log::info('Payout Item ID not found');
            return response()->json(['message' => 'Payout Item ID not found'], 400);            
        }

        // Find transaction by payout ID
        $transaction = Transaction::where('payment_id', $payoutItemId)->first();

        if (!$transaction) {
            Log::info('Transaction ID not found on our server - POSHALGO');
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        // Update transaction status based on webhook event
        if ($eventType === 'CUSTOMER.PAYOUT.COMPLETED') {
            $transaction->status = 'success';
            $transaction->payment_id = $transactionId; // Save transaction ID from PayPal
        } elseif ($eventType === 'CUSTOMER.PAYOUT.FAILED') {
            $transaction->status = 'failed';
        }

        $transaction->save();
        Log::info("Payout ID $payoutItemId updated to status: $transaction->status");
    }







    // Nowpayments (Crypto Payments)
    public function createCryptoPayout(Request $request)
    {
        $request->validate([
            'address' => 'required|string',
            'amount' => 'required|numeric|min:0.000001',
        ]);

        // STEP 1: Authenticate and Get Token
        $authResponse = Http::post('https://api.nowpayments.io/v1/auth', [
            'email' => config('paypal.nowpayment_email'),
            'password' => config('paypal.nowpayment_password'),
        ]);

        if ($authResponse->failed()) {
            return response()->json(['message' => 'Authentication failed'], 401);
        }

        $bearerToken = $authResponse->json('token');
        $apiKey = config('paypal.nowpayment_key');

        $payoutResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . $bearerToken,
            'x-api-key' => $apiKey,
            'Content-Type' => 'application/json',
        ])->post('https://api.nowpayments.io/v1/payout', [
            "ipn_callback_url" => "https://yourwebsite.com/callback",
            "withdrawals" => [
                [
                    "address" => $request->address,
                    "currency" => "trx", // Use the correct crypto currency
                    "amount" => $request->amount,
                    "ipn_callback_url" => "https://yourwebsite.com/callback"
                ]
            ]
        ]);

        return response()->json($payoutResponse->json(), $payoutResponse->status());
    }
}
