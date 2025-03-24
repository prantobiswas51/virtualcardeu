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
            $table->string('account_name')->nullable();
            $table->string('account_title');
            $table->string('routing_number');
            $table->string('bank_code');
            $table->string('branch_code');
            $table->string('swift_code');
            $table->enum('status', ['Active', 'Inactive', 'Expired'])->default('Inactive');
            $table->string('mobile_number')->nullable();
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
