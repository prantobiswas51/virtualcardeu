<?php

namespace App\Http\Controllers;

use App\Models\User;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
use App\Models\Invoice;
use PayPal\Api\Payment;
use PayPal\Api\Transaction;
use PayPal\Rest\ApiContext;
use Illuminate\Http\Request;
use PayPal\Api\RedirectUrls;

use PayPal\Api\PaymentExecution;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use PayPal\Auth\OAuthTokenCredential;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class DepositController extends Controller
{

    private $_api_context;

    public function __construct()
    {
        $paypal = config('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal['client_id'], $paypal['secret']));
        $this->_api_context->setConfig($paypal['settings']);
    }

    // Deposit page return + currency
    public function index()
    {
       return view('deposit');
    }

    public function feeCheck(Request $request)
    {
        $method = $request->selected_method;
        $amount = $request->total_amount;

        return view('deposit_fee', compact(['method', 'amount']));
    }

    // Paypal
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

        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            if (Config::get('app.debug')) {
                Session::put('error', 'Connection Timeout');
                return Redirect::route('deposit');
            } else {
                Session::put('error', 'Something went wrong! Sorry for inconveninet');
                return Redirect::route('deposit');
            }
        }

        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        Session::put('paypal_payment_id', $payment->getId());

        if (isset($redirect_url)) {
            return Redirect::away($redirect_url);
        }

        Session::put('error', 'Unknow Error Occurred');
        return Redirect::route('deposit');
    }

    // paypal
    public function getPaypalPaymentStatus(Request $request)
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

                $total_amount = $result->transactions[0]->amount->total;
                $deposit_amount = $total_amount / 1.1;
                $transaction_fee = $total_amount - $deposit_amount;
                $amount_to_add = $deposit_amount;

                Auth::user()->increment('balance', $amount_to_add);

                \App\Models\Transaction::create([
                    'user_id' => Auth::id(),
                    'payment_method' => 'Paypal',
                    'payment_id' => $result->id,
                    'payer_email' => $result->payer->payer_info->email,
                    'amount' => $amount_to_add,
                    'status' => $result->state,
                    'type' => 'deposit'
                ]);

                Mail::raw('Your Transaction is Completed', function ($message) {
                    $message->to(Auth::user()->email)
                        ->subject('Deposit VirtualCardEU');
                });

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

    // Crypto create invoice
    public function createInvoice(Request $request)
    {

        $amount = $request->total_amount;
        $currency = "USD";
        $email = Auth::user()->email;

        $postData = [
            "price_amount" => $amount,
            "price_currency" => $currency,
            "customer_email" => $email,
            "is_fixed_rate" => true,
            "is_fee_paid_by_user" => true,
            "ipn_callback_url" => route('payment_webhook'),
            "success_url" => route('dashboard'),
            "cancel_url" => route('deposit'),

        ];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://api.nowpayments.io/v1/invoice',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 1000,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($postData), // Properly encoded JSON
            CURLOPT_HTTPHEADER => [
                'x-api-key: 5BTM43E-8SN436A-M5BM6SX-CZFF0J1',
                'Content-Type: application/json'
            ],
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        $json_response = json_decode($response, true);

        if (!isset($json_response['id'])) {
            return response()->json(['error' => 'Failed to create invoice'], 500);
        }

        $invoice = new Invoice();
        $invoice->np_invoice_id = $json_response['id'];
        $invoice->amount = $json_response['price_amount'];
        $invoice->currency = $json_response['price_currency'];
        $invoice->payer_email = $json_response['customer_email'];
        $invoice->invoice_url = $json_response['invoice_url'];
        $invoice->status = "Dev";
        $invoice->save();

        if (isset($json_response['invoice_url'])) {
            return redirect($json_response['invoice_url']);
        }
    }

    // Crypto
    public function handleWebhook(Request $request)
    {
        $data = $request->all();

        dd($data);

        // Verify if payment is completed
        if (isset($data['payment_status']) && $data['payment_status'] == 'finished') {
            $invoice = Invoice::where('np_invoice_id', $data['payment_id'])->first();

            if ($invoice && $invoice->status != 'Completed') {
                // Update invoice status
                $invoice->status = "Completed";
                $invoice->save();

                // Get user & update balance
                $user = User::where('email', $invoice->payer_email)->first();
                if ($user) {
                    $user->balance += $invoice->amount; // Add USD amount to user balance
                    $user->save();
                }

                return response()->json(['message' => 'Payment successful, balance updated']);
            }
        }

        return response()->json(['error' => 'Invalid payment data'], 400);
    }

    // Crypto
    public function checkPaymentStatus($invoice_id)
    {
        $invoice = Invoice::where('np_invoice_id', $invoice_id)->first();

        if (!$invoice) {
            return redirect()->route('dashboard')->with('error', 'Invoice not found');
        }

        if ($invoice->status == 'Completed') {
            return redirect()->route('dashboard')->with('success', 'Deposit successful');
        }

        return redirect()->route('dashboard')->with('error', 'Payment not completed yet');
    }

    // Payeer Accounts
    public function createPayeerDeposit(Request $request)
    {
        $m_shop = env('PAYEER_MERCHANT_ID');
        $m_orderid = '1';
        $m_amount = number_format($request->total_amount, 2, '.', '');
        $m_curr = 'USD';
        $m_desc = base64_encode('Test');
        $m_key = env('PAYEER_SECRET_KEY');

        $arHash = array(
            $m_shop,
            $m_orderid,
            $m_amount,
            $m_curr,
            $m_desc
        );

        $arHash[] = $m_key;

        $sign = strtoupper(hash('sha256', implode(':', $arHash)));

        // Redirect to Payeer payment page
        $url = 'https://payeer.com/merchant/?' . http_build_query([
            'm_shop' => $m_shop,
            'm_orderid' => $m_orderid,
            'm_amount' => $m_amount,
            'm_curr' => $m_curr,
            'm_desc' => $m_desc,
            'm_sign' => $sign,
            'lang' => 'en'
        ]);

        return redirect($url);
    }

    public function payeerSuccess()
    {
        dd('Success');
        return view('payeer_success'); // Create a success view
    }

    public function payeerFail()
    {
        dd('Fail');
        return view('payeer_fail'); // Create a failure view
    }
}
