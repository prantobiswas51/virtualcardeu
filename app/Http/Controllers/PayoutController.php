<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class PayoutController extends Controller
{
    public function index()
    {
        return view('payout');
    }

    public function handlePaypalCallback(Request $request)
    {

        dd($request->all());

        $code = $request->query('code');

        if (!$code) {
            return response()->json([
                'success' => false,
                'message' => 'Authorization code missing.'
            ], 400);
        }

        // Get PayPal credentials
        $clientId = config('paypal.client_id');
        $clientSecret = config('paypal.client_secret');

        // Exchange code for access token
        $response = Http::withBasicAuth($clientId, $clientSecret)->asForm()->post('https://api-m.sandbox.paypal.com/v1/identity/openidconnect/tokenservice', [
            'grant_type' => 'authorization_code',
            'code' => $code
        ]);

        if ($response->failed()) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to get access token',
                'error' => $response->json()
            ], 400);
        }

        $data = $response->json();
        return response()->json([
            'success' => true,
            'message' => 'PayPal Login Successful',
            'data' => $data
        ]);
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
        $clientId = 'AdjT7lhJRcWE9VlwdKOyBMO2_JKwvOPM49rYj37LWAuvlpgk0OxUT_b91F5IYeFnzrVPNEuzHLKKS7SD';
        $clientSecret = 'EIpcTzfpSHv069AZH0_5BsdNQeYTzXcuMbGE40pVH-r257ff9PTh4dTKwrkp4JUCRLylrg-I8cBc0ins';
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
