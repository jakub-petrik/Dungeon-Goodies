<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

class SaleController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->input('sort', 'new'); // default 'new'

        // 1. Základný dotaz: iba produkty v zľave
        $query = Product::where('on_sale', true);

        // 2. Filtrovanie podľa typu (ak sú zaškrtnuté checkboxy)
        if ($request->has('type')) {
            $query->whereIn('type', $request->input('type', []));
        }

        if ($request->filled('rating')) {
            $exactRating = (float) $request->input('rating');
            $query->where('rating', '=', $exactRating);
        }

        // 3. Získame všetky produkty, lebo musíme počítať zľavnenú cenu
        $products = $query->get()->map(function ($product) {
            $product->discounted_price = $product->price * (1 - $product->sale_percent / 100);
            return $product;
        });

        // 4. Filtrovanie podľa zľavnenej ceny (discounted_price)
        if ($request->filled('price_max')) {
            $priceMax = $request->input('price_max');
            $products = $products->filter(function ($product) use ($priceMax) {
                return $product->discounted_price <= $priceMax;
            });
        }

        // 5. Triedenie
        if ($sort === 'pa') {
            $products = $products->sortBy('discounted_price');
        } elseif ($sort === 'pd') {
            $products = $products->sortByDesc('discounted_price');
        } elseif ($sort === 'ra') {
            $products = $products->sortByDesc('rating');
        } else {
            $products = $products->sortByDesc('created_at');
        }

        // 6. Manuálne stránkovanie
        $page = $request->get('page', 1);
        $perPage = 6;
        $paginated = new LengthAwarePaginator(
            $products->forPage($page, $perPage),
            $products->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        // 7. Zobrazenie view
        return view('layouts.Sales', ['products' => $paginated]);
    }
}
