<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sort = $request->input('sort', 'new');

        $query = Product::query();

        if ($request->has('type')) {
            $types = $request->input('type');

            if (is_array($types)) {
                $query->whereIn('type', $types);
            }
        }

        if ($request->has('manufacturer')) {
            $manufacturers = $request->input('manufacturer');

            if (is_array($manufacturers)) {
                $query->whereIn('manufacturer', $manufacturers);
            }
        }

        if ($request->has('format')) {
            $formats = $request->input('format');

            if (is_array($formats)) {
                $query->whereIn('format', $formats);
            }
        }

        if ($request->filled('search')) {
            $search = strtolower($request->input('search'));
            $escapedSearch = addcslashes(strtolower($search), '%_');

            $query->where(function($q) use ($escapedSearch) {
                $q->whereRaw('LOWER(name) LIKE ?', ["%{$escapedSearch}%"])
                  ->orWhereRaw('LOWER(description) LIKE ?', ["%{$escapedSearch}%"])
                  ->orWhereRaw('LOWER(type) LIKE ?', ["%{$escapedSearch}%"])
                  ->orWhereRaw('LOWER(series) LIKE ?', ["%{$escapedSearch}%"])
                  ->orWhereRaw('LOWER(manufacturer) LIKE ?', ["%{$escapedSearch}%"])
                  ->orWhereRaw('LOWER(format) LIKE ?', ["%{$escapedSearch}%"]);
            });
        }

        $products = $query->get()->map(function ($product) {
            $product->discounted_price = $product->on_sale
                ? $product->price * (1 - $product->sale_percent / 100)
                : $product->price;
            return $product;
        });

        $min = is_numeric($request->input('price_min')) ? (float)$request->input('price_min') : 0;
        $max = is_numeric($request->input('price_max')) ? (float)$request->input('price_max') : 1000000;

        $products = $products->filter(function ($product) use ($min, $max) {
            return $product->discounted_price >= $min && $product->discounted_price <= $max;
        });

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

        return view('layouts.Product_Page', ['products' => $paginated]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::findOrFail($id);

        return view('layouts.Product_Detail', [
            'product' => $product
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
