<?php

namespace App\Http\Controllers;

use App\Models\Billing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $billing = new Billing($validatedData);
        $billing->user_id = Auth::check() ? Auth::id() : null;
        $billing->save();

        session(['billing_id' => $billing->id]);

        return redirect()->route('payment');
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'payment' => 'required|string|in:cash,card,bank',
        ]);

        $billingId = session('billing_id');

        if ($billingId) {
            $billing = Billing::findOrFail($billingId);
            $billing->payment = $request->input('payment');
            $billing->save();

            session()->forget('billing_id');

            return redirect()->route('payment-success');
        } else {
            return redirect()->route('delivery')->with('error', 'Please fill in your delivery details.');
        }
    }

    public function paymentSuccess()
    {
        return view('layouts.Payment_Succeeded_Page');
    }
}
