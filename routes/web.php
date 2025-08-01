<?php

use App\Models\Bank;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BankController;
use App\Http\Controllers\CardController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\CryptoController;
use App\Http\Controllers\PayoutController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TicketController;
use SocialiteProviders\Manager\Config as SocialiteConfig;
use SocialiteProviders\PayPal\Provider as PayPalProvider;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/pricing', function () {
    return view('pricing');
})->name('pricing');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/transactions', [DashboardController::class, 'activity'])->name('activity');

    // Ticket control
    Route::get('/support', [TicketController::class, 'index'])->name('support');
    Route::post('/support/create', [TicketController::class, 'create_ticket'])->name('create_ticket');
    Route::get('/ticket/{id}', [TicketController::class, 'show_ticket'])->name('view_ticket');
    Route::post('/ticket/{ticket}/reply', [TicketController::class, 'ticket_reply'])->name('ticket_reply');


    // Manage Cards
    Route::get('/cards', [CardController::class, 'cards'])->name('cards');
    Route::get('/cards/new', [CardController::class, 'order_cards'])->name('order_cards');
    Route::post('/cards/request_card', [CardController::class, 'requestCard'])->name('request_card');

    Route::get('/cards/{card}/transactions', [CardController::class, 'transactions']);
    Route::post('/cards/topup', [CardController::class, 'card_topup'])->name('card_topup');

    Route::post('/cards/{card}/delete', [CardController::class, 'delete_card'])->name('delete_card');


    // Manage Banks
    Route::get('/banks', [BankController::class, 'banks'])->name('banks');
    Route::get('/banks/new', [BankController::class, 'order_banks'])->name('order_banks');
    Route::post('/banks/request', [BankController::class, 'request_bank'])->name('request_bank');
    Route::post('/banks/transfer', [BankController::class, 'transfer_bank_balance'])->name('transfer_bank_balance');

    Route::get('/settings', [DashboardController::class, 'settings'])->name('settings');
    Route::get('/notifications', [DashboardController::class, 'notifications'])->name('notifications');
    Route::post('/notifications/mark-all-as-read', [DashboardController::class, 'mark_all_asRead'])->middleware('auth')->name('notifications_mark_all_asRead');

    Route::post('/upload_profile_photo', [ProfileController::class, 'uploadProfilePhoto'])->name('upload_photo');
    Route::post('/update_info', [ProfileController::class, 'update_other_info'])->name('update_other_info');

    // Custom controller routes
    Route::get('/force_logout', [DashboardController::class, 'logout'])->name('force_logout');

    // payments
    Route::get('/deposit', [DepositController::class, 'index'])->name('deposit');
    // Route::get('/deposit/fee_check', [DepositController::class, 'feeCheck'])->name('deposit_fee_check');

    // paypal payment
    Route::post('/deposit/paypal', [DepositController::class, 'postPayWithPaypal'])->name('deposit_paypal');
    Route::get('/deposit/paypal/status', [DepositController::class, 'getPaypalPaymentStatus'])->name('deposit_status');

    // crypto payment
    Route::post('/deposit/crypto', [DepositController::class, 'createInvoice'])->name('deposit_crypto');
    Route::post('/payment/crypto/check', [DepositController::class, 'handleWebhook'])->name('payment_webhook');

    Route::get('/payment/status/{invoice_id}', [DepositController::class, 'checkPaymentStatus'])->name('payment.status');

    // Payeer deposit
    Route::post('/deposit/payeer', [DepositController::class, 'createPayeerDeposit'])->name('deposit_payeer');
    Route::get('/deposit/payeer/success', [DepositController::class, 'success'])->name('payeer_success');
    Route::get('/deposit/payeer/fail', [DepositController::class, 'fail'])->name('payeer_fail');

    // Payout======
    Route::get('/payout', [PayoutController::class, 'index'])->name('payout');
    Route::get('/payout/paypal/success', [PayoutController::class, 'success'])->name('payout_success');

    Route::get('/payout/paypal/form', function () {
        return view('paypal_payout');
    });

    Route::post('/payout/paypal', [PayoutController::class, 'paypalPayout'])->name('paypal_payout');
    Route::get('/payout/paypal/callback', [PayoutController::class, 'handlePaypalCallback'])->name('paypal_login_callback');

    Route::post('/payout/paypal/check/status', [PayoutController::class, 'handlePaypalWebhook']);

    // crypto payout
    Route::post('/payout/crypto', [PayoutController::class, 'createCryptoPayout'])->name('crypto_payout');

    // Bank View 
    Route::middleware('auth')->group(function () {
        Route::get('/my-banks/{id}', function ($id) {
            $bank = Bank::find($id); // Use findOrFail if you want Laravel to automatically handle 404s for missing IDs

            if (!$bank) {
                // Optional: return a more specific message for not found
                return response()->json(['message' => 'Bank account not found.'], 404);
            }

            // Make sure the bank belongs to the authenticated user for security
            if ($bank->user_id !== Auth::id()) {
                return response()->json(['message' => 'Unauthorized access.'], 403); // Forbidden
            }

            return response()->json($bank);
        });
    });
});

require __DIR__ . '/auth.php';
