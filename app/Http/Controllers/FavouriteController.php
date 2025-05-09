<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favourite;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
{

    public function index(Request $request)
    {
        $favourites = \App\Models\Favourite::where('user_id', \Auth::id())
            ->with('product')
            ->get()
            ->sortBy(fn($fav) => $fav->product->name)
            ->values();

        $perPage = 5;
        $currentPage = \Illuminate\Pagination\Paginator::resolveCurrentPage('page');
        $pagedData = $favourites->slice(($currentPage - 1) * $perPage, $perPage)->all();

        $favouritesPaginated = new \Illuminate\Pagination\LengthAwarePaginator(
            $pagedData,
            $favourites->count(),
            $perPage,
            $currentPage,
            ['path' => \Illuminate\Pagination\Paginator::resolveCurrentPath()]
        );

        return view('layouts.Favourites', ['favourites' => $favouritesPaginated]);
    }

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

    public function __construct()
    {
        $this->middleware('auth');
    }
}
