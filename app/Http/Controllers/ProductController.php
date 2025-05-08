<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\File;

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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'price' => 'required|numeric|min:0.99',
            'manufacturer' => 'nullable|string|max:255',
            'format' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'on_sale' => 'required|boolean',
            'sale_percent' => 'nullable|numeric|min:1|max:100',
            'image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image1Path = null;
        $image2Path = null;

        if ($request->hasFile('image_1')) {
            $image1 = $request->file('image_1');
            $image1Name = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $image1->getClientOriginalName());
            $image1->move(public_path('products'), $image1Name);
            $image1Path = 'products/' . $image1Name;
        }
        else
            {return back()->withErrors(['image1' => 'Two product images are required.'])->withInput();}

        if ($request->hasFile('image_2')) {
            $image2 = $request->file('image_2');
            $image2Name = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $image2->getClientOriginalName());
            $image2->move(public_path('products'), $image2Name);
            $image2Path = 'products/' . $image2Name;
        }
        else
            {return back()->withErrors(['image2' => 'Two product images are required.'])->withInput();}

        $product = new Product();
        $product->name = $validated['name'];
        $product->type = $validated['type'];
        $product->price = $validated['price'];
        $product->series = 'Standalone';
        $product->date_of_release = now();
        $product->manufacturer = $validated['manufacturer'] ?? null;
        $product->format = $validated['format'] ?? null;
        $product->description = $validated['description'] ?? '';
        $product->on_sale = $validated['on_sale'];
        $product->sale_percent = $validated['sale_percent'] ?? 0;
        $product->image_1 = $image1Path;
        $product->image_2 = $image2Path;

        $product->save();

        return redirect()->route('admin-page')->with('success', 'Product added!');
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

    public function editProductList(Request $request)
    {
        $search = $request->input('search');

        $query = Product::query();

        if ($search) {
            $query->where('name', 'ILIKE', '%' . $search . '%');
        }

        $products = $query->orderBy('name')->paginate(6);

        return view('layouts.Edit_Product_Page', [
            'products' => $products,
            'search' => $search
        ]);
    }

    public function editDetail($id)
    {
        $product = Product::findOrFail($id);

        return view('layouts.Edit_Product_Detail_Page', [
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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'price' => 'required|numeric|min:0.99',
            'manufacturer' => 'nullable|string|max:255',
            'format' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'on_sale' => 'required|boolean',
            'sale_percent' => 'nullable|numeric|min:1|max:100',
            'image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product = Product::findOrFail($id);
        $product->update($validated);

        return redirect()->route('edit-product')->with('success', 'Product updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->image_1 && File::exists(public_path($product->image_1))) {
            File::delete(public_path($product->image_1));
        }

        if ($product->image_2 && File::exists(public_path($product->image_2))) {
            File::delete(public_path($product->image_2));
        }

        $product->delete();

        return redirect()->route('admin-page')->with('success', 'Product deleted successfully.');
    }

    public function deleteImage(Request $request, $id, $index)
    {
        $product = Product::findOrFail($id);

        if (!in_array($index, [1, 2])) {
            return response()->json(['error' => 'Invalid image index'], 400);
        }

        $imageField = 'image_' . $index;
        $imagePath = $product->$imageField;

        // Ensure the path starts with 'Products/' and is under 'public'
        if ($imagePath && file_exists(public_path($imagePath))) {
            unlink(public_path($imagePath)); // Deletes from public/Products/...
            $product->$imageField = null;
            $product->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['error' => 'Image not found or already deleted'], 404);
    }
}
