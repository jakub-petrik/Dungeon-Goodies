<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Shopping_Cart;

class BillingController extends Controller
{
    public function storeBilling(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'state' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:20',
            'phone_number' => 'required|string|max:20',
            'transport' => 'required|string|in:sps,packet,upc',
        ]);

        session(['billing_data' => $validatedData]);

        return redirect()->route('payment');
    }

    public function payment()
    {
        $billingData = session('billing_data');

        if (!$billingData) {
            return redirect()->route('delivery')->with('error', 'Please fill delivery info first.');
        }

        $deliveryCost = match ($billingData['transport']) {
            'sps' => 5.99,
            'packet' => 6.99,
            'upc' => 7.99,
            default => 0,
        };

        $productTotal = $this->calculateCartTotal();

        return view('layouts.Payment', [
            'productTotal' => $productTotal,
            'deliveryCost' => $deliveryCost,
        ]);
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'payment' => 'required|string|in:cash,card,bank',
        ]);

        $billingData = session('billing_data');

        if (!$billingData) {
            return redirect()->route('delivery')->with('error', 'Missing delivery data.');
        }

        $billing = new Billing($billingData);
        $billing->payment = $request->payment;
        $billing->user_id = Auth::check() ? Auth::id() : null;
        $billing->save();

        if (Auth::check()) {
            Shopping_Cart::where('user_id', Auth::id())->delete();
        } else {
            session()->forget('cart');
        }

        session()->forget('billing_data');

        return redirect()->route('payment-success');
    }


    public function paymentSuccess()
    {
        return view('layouts.Payment_Succeeded_Page');
    }

    private function calculateCartTotal()
    {
        if (Auth::check()) {
            $items = Shopping_Cart::with('product')->where('user_id', Auth::id())->get();
        } else {
            $cart = session()->get('cart', []);
            $items = collect();

            foreach ($cart as $productId => $amount) {
                $product = \App\Models\Product::find($productId);

                if ($product) {
                    $obj = new \stdClass();
                    $obj->product = $product;
                    $obj->amount = $amount;
                    $items->push($obj);
                }
            }
        }

        return $items->reduce(function ($carry, $item) {
            $price = $item->product->on_sale
                ? $item->product->price * (1 - $item->product->sale_percent / 100)
                : $item->product->price;

            return $carry + $price * $item->amount;
        }, 0);
    }

}
