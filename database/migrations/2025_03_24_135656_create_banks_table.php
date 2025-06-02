<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('banks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('bank_name');
            $table->string('bank_location');
            $table->string('account_type');
            $table->string('account_holder_name')->nullable();
            $table->string('currency')->default('USD');

            $table->string('routing_number')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('bank_address')->nullable();
            $table->string('bic')->nullable();
            $table->string('iban')->nullable();
            $table->string('bank_short_code')->nullable();
            
            $table->string('bank_balance')->nullable();

            $table->enum('status', ['Active', 'Inactive', 'Expired'])->default('Inactive');
            $table->string('registered_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banks');
    }
};
