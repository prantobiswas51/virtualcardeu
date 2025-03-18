<?php

use App\Http\Controllers\CryptoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepositController;

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
    Route::get('/deposit', [DepositController::class, 'getAvailableCurrencies'])->name('deposit');
    Route::get('/deposit/fee_check', [DepositController::class, 'feeCheck'])->name('deposit_fee_check');

    // paypal payment
    Route::post('/deposit/paypal', [DepositController::class, 'postPayWithPaypal'])->name('deposit_paypal');
    Route::get('/deposit/paypal/status', [DepositController::class, 'getPaypalPaymentStatus'])->name('deposit_status');

    // crypto payment
    Route::post('/deposit/crypto', [DepositController::class, 'createInvoice'])->name('deposit_crypto');
    Route::post('/payment/crypto/check', [DepositController::class, 'handleWebhook'])->name('payment_webhook');

    Route::get('/payment/status/{invoice_id}', [DepositController::class, 'checkPaymentStatus'])->name('payment.status');

    
});



require __DIR__.'/auth.php';
