<?php

namespace App\Http\Controllers;

use App\Models\Product;

class MainPageController extends Controller
{
    public function showMainPage()
    {
        $latestProducts = Product::orderBy('created_at', 'desc')->take(9)->get();

        $allProducts = Product::all();

        $topRatedProducts = $allProducts->sortBy(function ($product) {
            return $product->on_sale
                ? $product->price * (1 - $product->sale_percent / 100)
                : $product->price;
        })->take(9);

        return view('layouts.Main_Page', [
            'latestProducts' => $latestProducts,
            'topRatedProducts' => $topRatedProducts
        ]);

        if ($request->filled('search')) {
            $search = strtolower($request->input('search'));
            $escapedSearch = addcslashes(strtolower($search), '%_');

            $query->where(function($q) use ($escapedSearch) {
                $q->whereRaw('LOWER(name) LIKE ?', ["%{$escapedSearch}%"])
                  ->orWhereRaw('LOWER(description) LIKE ?', ["%{$escapedSearch}%"])
                  ->orWhereRaw('LOWER(type) LIKE ?', ["%{$escapedSearch}%"])
                  ->orWhereRaw('LOWER(series) LIKE ?', ["%{$escapedSearch}%"]);
            });
        }
    }
}
