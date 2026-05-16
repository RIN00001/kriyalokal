<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductBrowseController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::query()
            ->with(['seller', 'category', 'mainImage'])
            ->where('is_active', true)
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->when($request->category, function ($query, $category) {
                $query->whereHas('category', function ($q) use ($category) {
                    $q->where('slug', $category);
                });
            })
            ->when($request->selling_type, function ($query, $sellingType) {
                $query->where('selling_type', $sellingType);
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $categories = Category::orderBy('name')->get();

        return view('products.index', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        abort_if(! $product->is_active, 404);

        $product->load(['seller.user', 'category', 'images']);

        return view('products.show', compact('product'));
    }
}