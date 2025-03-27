<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;

class Setting extends Model
{
    protected $fillable = [
        'paypal_client_id',
        'paypal_secret',
        'paypal_merchant_id'
    ];
}
