<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $fillable = [
        'user_id',
        'bank_name',
        'account_name',
        'account_title',
        'routing_number',
        'bank_code',
        'branch_code',
        'swift_code',
        'mobile_number',
        'registered_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
