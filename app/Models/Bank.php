<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $fillable = [
        'user_id',
        'bank_name',
        'bank_location',
        'account_holder_name',
        'account_type',
        'currency',
        'routing_number',
        'bank_account_number',
        'bic',
        'iban',
        'bank_short_code',
        'status',
        'registered_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
