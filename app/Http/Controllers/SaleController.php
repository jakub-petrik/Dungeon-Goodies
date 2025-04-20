<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class SaleController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->input('sort', 'new');

        $query = Product::where('on_sale', true);

        if ($request->has('type')) {
            $query->where('type', $request->input('type'));
        }

        if ($request->has('price_min')) {
            $query->where('price', '>=', $request->input('price_min'));
        }

        if ($request->has('price_max')) {
            $query->where('price', '<=', $request->input('price_max'));
        }

        // Zoradenie
        if ($sort === 'pa') {
            $query->orderBy('price', 'asc');
        } elseif ($sort === 'pd') {
            $query->orderBy('price', 'desc');
        } else {
            $query->latest('created_at');
        }

        $products = $query->paginate(6);

        return view('layouts.Sales', compact('products'));
    }
}
