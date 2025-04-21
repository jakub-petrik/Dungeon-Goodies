<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favourite;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{
    public function toggle(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $user = auth()->user();

        $favourite = Favourite::where('user_id', $user->id)
                              ->where('product_id', $request->product_id)
                              ->first();

        if ($favourite) {
            $favourite->delete();
            return response()->json(['status' => 'removed']);
        } else {
            Favourite::create([
                'user_id' => $user->id,
                'product_id' => $request->product_id
            ]);
            return response()->json(['status' => 'added']);
        }
    }
}
