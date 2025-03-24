<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    protected $fillable = [
        'user_id',
        'number',
        'amount',
        'company',
        'expiry_date',
        'type',
        'status',
        'cvc',
        'registered_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
