<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;

class Setting extends Model
{
    protected $fillable = [
        'paypal_client_id',
        'paypal_secret',
        'paypal_merchant_id',
        
        'paypal_client_id_demo',
        'paypal_secret_demo',
        'paypal_merchant_id_demo',
        'paypal_mode',

        'deposit_fee',
        'withdrawal_fee',
        
        'bank_setup_fee',
        'bank_maintenance_fee',
        'incoming_transfer_fee',
        'card_issuance_fee',
    ];
}
