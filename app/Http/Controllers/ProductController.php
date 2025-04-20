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

        // 1. Query base
        $query = Product::query();

        // 2. Filter: types (checkboxes)
        if ($request->has('type')) {
            $types = $request->input('type');
            if (is_array($types)) {
                $query->whereIn('type', $types);
            }
        }

        // 2.5: Filter: rating
        if ($request->filled('rating')) {
            $exactRating = (float) $request->input('rating');
            $query->where('rating', '=', $exactRating);
        }

        // 3. Get all and compute discounted price
        $products = $query->get()->map(function ($product) {
            $product->discounted_price = $product->on_sale
                ? $product->price * (1 - $product->sale_percent / 100)
                : $product->price;
            return $product;
        });

        // 4. Filter: max price (after discount)
        if ($request->filled('price_max')) {
            $max = $request->input('price_max');
            $products = $products->filter(function ($product) use ($max) {
                return $product->discounted_price <= $max;
            });
        }

        // 5. Sorting
        if ($sort === 'pa') {
            $products = $products->sortBy('discounted_price');
        } elseif ($sort === 'pd') {
            $products = $products->sortByDesc('discounted_price');
        } elseif ($sort === 'ra') {
            $products = $products->sortByDesc('rating');
        } else {
            $products = $products->sortByDesc('created_at');
        }

        // 6. Pagination
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
        //
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
