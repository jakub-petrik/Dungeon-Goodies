<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
         'nickname', 'email', 'password', 'first_name', 'last_name', 'admin'
    ];

    protected $hidden = [
        'password', 'admin'
    ];

    public function favourites()
    {
        return $this->hasMany(Favourite::class);
    }

    public function billing()
    {
        return $this->hasMany(Billing::class);
    }
}
