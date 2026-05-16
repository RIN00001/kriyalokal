<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $seller = auth()->user()->seller;

        $products = Product::with(['category', 'mainImage'])
            ->where('seller_id', $seller->id)
            ->latest()
            ->paginate(10);

        return view('seller.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('seller.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $seller = auth()->user()->seller;

        $data = $request->validate([
            'category_id' => ['nullable', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'selling_type' => ['required', 'in:internal,external,both'],
            'external_url' => ['nullable', 'url'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        if (in_array($data['selling_type'], ['external', 'both']) && empty($data['external_url'])) {
            return back()
                ->withErrors(['external_url' => 'External URL is required for external products.'])
                ->withInput();
        }

        $data['seller_id'] = $seller->id;
        $data['slug'] = Str::slug($data['name'] . '-' . uniqid());
        $data['is_active'] = $request->boolean('is_active');

        Product::create($data);

        return redirect()
            ->route('seller.products.index')
            ->with('status', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        $this->authorizeSellerProduct($product);

        $product->load(['category', 'images']);

        return view('seller.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $this->authorizeSellerProduct($product);

        $categories = Category::orderBy('name')->get();

        return view('seller.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $this->authorizeSellerProduct($product);

        $data = $request->validate([
            'category_id' => ['nullable', 'exists:categories,id'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'selling_type' => ['required', 'in:internal,external,both'],
            'external_url' => ['nullable', 'url'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        if (in_array($data['selling_type'], ['external', 'both']) && empty($data['external_url'])) {
            return back()
                ->withErrors(['external_url' => 'External URL is required for external products.'])
                ->withInput();
        }

        $data['is_active'] = $request->boolean('is_active');

        if ($product->name !== $data['name']) {
            $data['slug'] = Str::slug($data['name'] . '-' . $product->id);
        }

        $product->update($data);

        return redirect()
            ->route('seller.products.index')
            ->with('status', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $this->authorizeSellerProduct($product);

        $product->delete();

        return redirect()
            ->route('seller.products.index')
            ->with('status', 'Product deleted successfully.');
    }

    public function toggle(Product $product)
    {
        $this->authorizeSellerProduct($product);

        $product->update([
            'is_active' => ! $product->is_active,
        ]);

        return back()->with('status', 'Product status updated.');
    }

    private function authorizeSellerProduct(Product $product): void
    {
        abort_if($product->seller_id !== auth()->user()->seller->id, 403);
    }
}