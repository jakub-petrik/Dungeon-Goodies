<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'price',
        'type',
        'series',
        'manufacturer',
        'date_of_release',
        'description',
        'rating',
        'image_1',
        'image_2',
        'on_sale',
        'sale_percent'
    ];

    public function shoppingCartItems()
    {
        return $this->hasMany(Shopping_Cart::class, 'product_id');
    }

    public function favourites()
    {
        return $this->hasMany(Favourite::class);
    }

}
