<?php

namespace App\Http\Controllers;

use App\Models\Product;

class MainPageController extends Controller
{
    public function showMainPage()
    {
        $latestProducts = Product::orderBy('created_at', 'desc')->take(9)->get();

        $topRatedProducts = Product::orderBy('rating', 'desc')->take(9)->get();

        return view('layouts.Main_Page', [
            'latestProducts' => $latestProducts,
            'topRatedProducts' => $topRatedProducts
        ]);

        if ($request->filled('search')) {
            $search = strtolower($request->input('search'));}
    }
}
