<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'np_invoice_id',
        'amount',
        'payer_email',
        'currency',
        'invoice_url',
        'status'
    ];
}
