<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shopping_Cart;
use Illuminate\Support\Facades\Auth;

class ShoppingCartController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'amount' => 'required|integer|min:1'
        ]);

        $productId = $request->product_id;
        $amount = $request->amount;

        if (Auth::check()) {
            $userId = Auth::id();

            $cartItem = Shopping_Cart::where('user_id', $userId)
                ->where('product_id', $productId)
                ->first();

            if ($cartItem) {
                $cartItem->amount += $amount;
                $cartItem->save();
            } else {
                Shopping_Cart::create([
                    'user_id' => $userId,
                    'product_id' => $productId,
                    'amount' => $amount,
                ]);
            }
        } else {
            $cart = session()->get('cart', []);

            if (isset($cart[$productId])) {
                $cart[$productId] += $amount;
            } else {
                $cart[$productId] = $amount;
            }

            session()->put('cart', $cart);
        }

        return redirect()->route('shopping-cart')->with('success', 'Product added to cart!');
    }


    public function show()
    {
        if (Auth::check()) {
            $items = Shopping_Cart::with('product')->where('user_id', Auth::id())->get();
        } else {
            $cart = session()->get('cart', []);
            $items = collect();

            foreach ($cart as $productId => $amount) {
                $product = \App\Models\Product::find($productId);
                if ($product) {
                    $cartItem = new \stdClass();
                    $cartItem->product = $product;
                    $cartItem->amount = $amount;
                    $items->push($cartItem);
                }
            }
        }

        $total = $items->reduce(function ($carry, $item) {
            $price = $item->product->on_sale
                ? $item->product->price * (1 - $item->product->sale_percent / 100)
                : $item->product->price;

            return $carry + $price * $item->amount;
        }, 0);

        return view('layouts.Shopping_Cart', compact('items', 'total'));
    }

public function update(Request $request, $id)
{
    $direction = $request->input('direction');
    $userId = Auth::id();

    if ($userId) {
        $item = Shopping_Cart::where('id', $id)->where('user_id', $userId)->first();
        if (!$item) return redirect()->back();

        if ($direction === 'increase') {
            $item->amount += 1;
        } elseif ($direction === 'decrease' && $item->amount > 1) {
            $item->amount -= 1;
        }
        $item->save();
    } else {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            if ($direction === 'increase') {
                $cart[$id] += 1;
            } elseif ($direction === 'decrease' && $cart[$id] > 1) {
                $cart[$id] -= 1;
            }
            session()->put('cart', $cart);
        }
    }

    return redirect()->route('shopping-cart');
}

}
