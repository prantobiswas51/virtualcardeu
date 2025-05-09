<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('paypal_client_id')->nullable();
            $table->string('paypal_secret')->nullable();
            $table->string('paypal_merchant_id')->nullable();

            $table->string('paypal_client_id_demo')->nullable();
            $table->string('paypal_secret_demo')->nullable();
            $table->string('paypal_merchant_id_demo')->nullable();

            $table->boolean('paypal_mode')->default(0);

            $table->string('deposit_fee')->nullable();
            $table->string('withdrawal_fee')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
