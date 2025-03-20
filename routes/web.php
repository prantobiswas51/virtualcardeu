<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\CryptoController;
use App\Http\Controllers\PayoutController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use SocialiteProviders\PayPal\Provider as PayPalProvider;
use SocialiteProviders\Manager\Config as SocialiteConfig;

Route::get('/', function () {
    return view('home');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/upload-profile-photo', [ProfileController::class, 'uploadProfilePhoto'])->name('upload_photo');

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

    Route::get('/payout/paypal/login', [PayoutController::class, 'paypal_login'])->name('paypal_login');
    
    Route::get('/payout/paypal/callback', function () {
        
        // $paypalUser = Socialite::driver('paypal')->stateless()->user();
        
        // // Get the authenticated user
        // $user = Auth::user();
    
        // // Save PayPal email to the user profile
        // $user->paypal_email = $paypalUser->email;
        // $user->save();
    
        return redirect()->route('dashboard')->with('success', 'PayPal email linked successfully!');
    })->name('paypal_callback');


});



require __DIR__.'/auth.php';
