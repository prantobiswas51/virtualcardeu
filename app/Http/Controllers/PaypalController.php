<?php

namespace App\Http\Controllers;

use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\Payment;
use PayPal\Api\Transaction;
use PayPal\Rest\ApiContext;
use Illuminate\Http\Request;
use PayPal\Api\RedirectUrls;

use PayPal\Api\PaymentExecution;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use PayPal\Auth\OAuthTokenCredential;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;


class PaypalController extends Controller
{

    private $_api_context;

    public function __construct() {
        $paypal = config('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal['client_id'], $paypal['secret']));
        $this->_api_context->setConfig($paypal['settings']);
    }

    public function feeCheck(Request $request){
        $method = $request->selected_method;
        $amount = $request->total_amount;

        return view('deposit_fee', compact(['method', 'amount']));
    }

    public function postPayWithPaypal(Request $request)
    {

        $request->validate([
            'total_amount' => 'required|numeric|min:1',
        ]);

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $amount = new Amount();
        $amount->setTotal($request->total_amount);
        $amount->setCurrency('USD');

        $transaction = new Transaction();
        $transaction->setAmount($amount);

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(URL::route('deposit_status'))->setCancelUrl(URL::route('deposit_status'));

        $payment = new Payment();
        $payment->setIntent('sale')->setPayer($payer)->setTransactions(array($transaction))->setRedirectUrls($redirectUrls);

        try 
        {
            $payment->create($this->_api_context);
        } 

        catch (\PayPal\Exception\PayPalConnectionException $ex) 
        {
            if (Config::get('app.debug')) {
                Session::put('error', 'Connection Timeout');
                return Redirect::route('deposit');
            }else{
                Session::put('error', 'Something went wrong! Sorry for inconveninet');
                return Redirect::route('deposit');
            }
        }

        foreach($payment->getLinks() as $link){
            if($link->getRel() == 'approval_url'){
                $redirect_url = $link->getHref();
                break;
            }
        }

        Session::put('paypal_payment_id', $payment->getId());

        if(isset($redirect_url)){
            return Redirect::away($redirect_url);
        }

        Session::put('error', 'Unknow Error Occurred');
        return Redirect::route('deposit');
    }

    public function getPaymentStatus(Request $request)
    {
        $paymentId = $request->query('paymentId');
        $PayerID = $request->query('PayerID');
        $token = $request->query('token');

        if (empty($PayerID) || empty($token)) {
            Session::put('error', 'Payment Failed');
            return redirect()->route('deposit');
        }

        try {
            $payment = Payment::get($paymentId, $this->_api_context);
            $execution = new PaymentExecution();
            $execution->setPayerId($PayerID);

            $result = $payment->execute($execution, $this->_api_context);

            if ($result->getState() === 'approved') {
                Session::put('success', 'Payment successful!');
                
                Auth::user()->increment('balance', $result->transactions[0]->amount->total);

                \App\Models\Transaction::create([
                    'user_id' => Auth::id(),
                    'payment_method' => 'Paypal',
                    'payment_id' => $result->id,
                    'payer_email' => $result->payer->payer_info->email,
                    'amount' => $result->transactions[0]->amount->total,
                    'status' => $result->state,
                ]);

                return view('deposit_success', compact('result'));
            } else {
                Session::put('error', 'Payment not approved.');
                return redirect()->route('deposit');
            }
        } catch (\Exception $e) {
            Session::put('error', 'Error processing payment: ' . $e->getMessage());
            return redirect()->route('deposit');
        }
    }

}
