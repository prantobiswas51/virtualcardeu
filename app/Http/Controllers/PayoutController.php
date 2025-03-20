<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PayoutController extends Controller
{
    public function index(){
        return view('payout');
    }

    public function paypal_login()
    {
        $clientId = env('PAYPAL_CLIENT_ID');
        $redirectUri = urlencode(env('PAYPAL_REDIRECT_URI'));
        $paypalUrl = "https://www.sandbox.paypal.com/signin/authorize?client_id={$clientId}&response_type=code&scope=email&redirect_uri={$redirectUri}";

        return redirect($paypalUrl);
    }
}
