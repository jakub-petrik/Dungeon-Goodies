<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

class SaleController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->input('sort', 'new');

        $query = Product::where('on_sale', true);

        if ($request->has('type')) {
            $query->whereIn('type', $request->input('type', []));
        }

        if ($request->filled('rating')) {
            $exactRating = (float) $request->input('rating');
            $query->where('rating', '=', $exactRating);
        }

        $products = $query->get()->map(function ($product) {
            $product->discounted_price = $product->price * (1 - $product->sale_percent / 100);
            return $product;
        });

        if ($request->filled('price_max')) {
            $priceMax = $request->input('price_max');
            $products = $products->filter(function ($product) use ($priceMax) {
                return $product->discounted_price <= $priceMax;
            });
        }

        if ($sort === 'pa') {
            $products = $products->sortBy('discounted_price');
        } elseif ($sort === 'pd') {
            $products = $products->sortByDesc('discounted_price');
        } elseif ($sort === 'ra') {
            $products = $products->sortByDesc('rating');
        } else {
            $products = $products->sortByDesc('created_at');
        }

        $page = $request->get('page', 1);
        $perPage = 6;
        $paginated = new LengthAwarePaginator(
            $products->forPage($page, $perPage),
            $products->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('layouts.Sales', ['products' => $paginated]);
    }
}
