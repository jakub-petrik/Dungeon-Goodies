<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;
use App\Models\Shopping_Cart;
use Illuminate\Support\Facades\Session;

class MergeGuestCart
{
    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $user = $event->user;

        $guestCart = Session::get('cart', []);

        if ($guestCart) {
            foreach ($guestCart as $productId => $amount) {
                $existingItem = Shopping_Cart::where('user_id', $user->id)
                    ->where('product_id', $productId)
                    ->first();

                if ($existingItem) {
                    $existingItem->amount += $amount;
                    $existingItem->save();
                } else {
                    Shopping_Cart::create([
                        'user_id' => $user->id,
                        'product_id' => $productId,
                        'amount' => $amount,
                    ]);
                }
            }
            Session::forget('cart');
        }
    }
}
