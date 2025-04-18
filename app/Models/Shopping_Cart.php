<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shopping_Cart extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'amount'
    ];

    public function user()
    {
        return $this->belongsTo(User::class)
    }
}
