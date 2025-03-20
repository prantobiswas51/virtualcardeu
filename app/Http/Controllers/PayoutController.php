<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

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

            return response()->json([
                'message' => 'PayPal login successful!',
                'paypal_id' => $userData['payer_id'] ?? null,
                'email' => $userData['email'] ?? null
            ]);

        } catch (\Exception $e) {
            Log::error("PayPal Callback Error: " . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'PayPal authentication failed.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function paypalPayout()
    {
        // Validate request
        // $request->validate([
        //     'recipient' => 'required', // Can be an email or Payer ID
        //     'amount' => 'required|numeric|min:1',
        //     'currency' => 'required|string|min:3|max:3',
        //     'recipient_type' => 'required|in:EMAIL,PAYPAL_ID' // EMAIL or PAYPAL_ID
        // ]);

        // Get PayPal credentials from .env
        $clientId = config('paypal.client_id');
        $clientSecret = config('paypal.secret');
        $paypalEnv = env('PAYPAL_ENV', 'sandbox'); // 'sandbox' or 'production'

        // Set PayPal API URL
        $paypalUrl = "https://api-m.sandbox.paypal.com";

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
                        'email_subject' => "You have received a payout!",
                        'email_message' => "You have received a payment. Thanks for using our service!",
                    ],
                    'items' => [
                        [
                            'recipient_type' => "EMAIL", // EMAIL or PAYPAL_ID
                            'receiver' => 'sb-fw0ei38674837@personal.example.com',
                            'amount' => [
                                'value' => "55",
                                'currency' => "USD",
                            ],
                            'note' => 'Payout from your website',
                            'sender_item_id' => uniqid(),
                        ]
                    ]
                ]
            ]);

            $payoutData = json_decode($payoutResponse->getBody(), true);

            // Log the response
            Log::info("PayPal Payout Response", $payoutData);

            return response()->json([
                'success' => true,
                'message' => 'Payout sent successfully!',
                'data' => $payoutData
            ], 200);
        } catch (\Exception $e) {
            Log::error("PayPal Payout Error: " . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Payout failed. Please try again later.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    



}
