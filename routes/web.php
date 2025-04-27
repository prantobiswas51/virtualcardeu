<?php

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CardController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\CryptoController;
use App\Http\Controllers\PayoutController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use SocialiteProviders\Manager\Config as SocialiteConfig;
use SocialiteProviders\PayPal\Provider as PayPalProvider;

Route::get('/', function () { return view('home'); });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/activity', [DashboardController::class, 'activity'])->name('activity');
    Route::get('/support', [DashboardController::class, 'support'])->name('support');
    Route::get('/cards', [DashboardController::class, 'cards'])->name('cards');
    Route::get('/banks', [DashboardController::class, 'banks'])->name('banks');
    Route::get('/settings', [DashboardController::class, 'settings'])->name('settings');

    Route::post('/upload_profile_photo', [ProfileController::class, 'uploadProfilePhoto'])->name('upload_photo');
    Route::post('/update_info', [ProfileController::class, 'update_other_info'])->name('update_other_info');

    // Custom controller routes
    Route::get('/force_logout', [DashboardController::class, 'logout'])->name('force_logout');

    // payments
    Route::get('/deposit', [DepositController::class, 'index'])->name('deposit');
    Route::get('/deposit/fee_check', [DepositController::class, 'feeCheck'])->name('deposit_fee_check');

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

    // Card Management
    Route::post('/cards/request_card', [CardController::class, 'requestCard'])->name('request_card');


});

require __DIR__.'/auth.php';
