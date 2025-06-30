<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'user_id',
        'email',
        'number',
        'subject',
        'message',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
