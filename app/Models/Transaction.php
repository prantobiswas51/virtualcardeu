<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'bank_id',
        'card_id',
        'payment_id',
        'merchant',
        'payer_email',
        'payment_method',
        'amount',
        'status',
        'type'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function bank() {
        return $this->belongsTo(Bank::class);
    }

    public function card() {
        return $this->belongsTo(Card::class);
    }
}
