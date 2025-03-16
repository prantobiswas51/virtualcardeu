<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('home');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/upload-profile-photo', [ProfileController::class, 'uploadProfilePhoto'])->name('upload_photo');


    // payments
    Route::post('/deposit/paypal', [PaypalController::class, 'postPayWithPaypal'])->name('deposit_paypal');
    Route::get('/deposit/status', [PaypalController::class, 'getPaymentStatus'])->name('deposit_status');


    Route::get('/deposit', function () { return view('deposit'); })->name('deposit');
    Route::get('/deposit/fee_check', [PaypalController::class, 'feeCheck'])->name('deposit_fee_check');
    
});

// Custom controller routes
Route::get('/force_logout', [DashboardController::class, 'logout'])->name('force_logout');

require __DIR__.'/auth.php';
