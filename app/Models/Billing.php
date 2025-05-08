<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{

    protected $fillable = [
        'user_id',
        'email',
        'first_name',
        'last_name',
        'country',
        'state',
        'city',
        'postal_code',
        'phone_number',
        'transport',
        'payment',
        'total'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
