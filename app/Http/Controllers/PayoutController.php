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
        $paypalEnv = config('paypal.env', 'sandbox');

        $paypalUrl = $paypalEnv === 'sandbox'
            ? "https://api-m.sandbox.paypal.com"
            : "https://api-m.paypal.com";

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

            return redirect()->route('payout')->with('message', 'Paypal Logged in Success');
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
            return response()->json([
                'success' => false,
                'message' => 'No PayPal email found. Please update your profile.',
            ], 400);
        }

        // Get PayPal credentials
        $clientId = config('paypal.client_id');
        $clientSecret = config('paypal.secret');
        $paypalEnv = env('PAYPAL_ENV', 'sandbox');
        $paypalUrl = $paypalEnv === 'production'
            ? "https://api-m.paypal.com"
            : "https://api-m.sandbox.paypal.com";

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
                                'value' => $amount_to_payout,
                                'currency' => "USD",
                            ],
                            'note' => 'Payout from VirtualCardEU',
                            'sender_item_id' => uniqid(),
                        ]
                    ]
                ]
            ]);

            $payoutData = json_decode($payoutResponse->getBody(), true);

            // Step 3: Save Transaction
            $transaction = new Transaction();
            $transaction->user_id = Auth::id();
            $transaction->payment_method = 'Paypal';
            $transaction->payment_id = $payoutData['batch_header']['payout_batch_id'] ?? 'unknown';
            $transaction->payer_email = Auth::user()->paypal_email;
            $transaction->amount = $total_amount;
            $transaction->type = 'withdrawal';
            $transaction->save();

            // $transactions = Transaction::where('user_id', Auth::id())->get();

            // Step 4: Deduct balance
            Auth::user()->decrement('balance', $total_amount);

            // Log response
            Log::info("PayPal Payout Response", $payoutData);

            return redirect()->route('dashboard');

        } catch (\Exception $e) {
            Log::error("PayPal Payout Error: " . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Payout failed. Please try again later',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
