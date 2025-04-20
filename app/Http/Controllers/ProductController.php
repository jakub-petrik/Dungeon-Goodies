<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Zoradenie podľa parametra 'sort'
        $sort = $request->input('sort', 'new'); // defaultne 'new'

        $query = Product::query();

        // Filtrovanie podľa typu (napr. ?type=Manga)
        if ($request->has('type')) {
            $query->where('type', $request->input('type'));
        }

        // Filtrovanie podľa ceny (napr. ?price_min=10&price_max=20)
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
        } elseif ($sort === 'ra') {
            $query->orderBy('rating', 'desc'); // ak máš rating stĺpec
        } else {
            $query->latest('created_at'); // default 'new'
        }

        // Stránkovanie (12 produktov na stránku)
        $products = $query->paginate(6);

        return view('layouts.Product_Page', compact('products'));
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
