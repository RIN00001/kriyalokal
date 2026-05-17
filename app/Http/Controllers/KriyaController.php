<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Throwable;

class KriyaController extends Controller
{
    private array $fallbackImages = [
        'garuda-cyberpunk.jpg',
        'wayang-comic.jpg',
        'batik-fractal.jpg',
        'reog-anime.jpg',
        'borobudur-minimal.jpg',
        'ondel-graffiti.jpg',
        'parang-long.jpg',
    ];

    private function catalog(): array
    {
        try {
            $products = Product::query()
                ->with(['seller.user', 'category', 'mainImage'])
                ->where('is_active', true)
                ->latest()
                ->get();
        } catch (Throwable) {
            return array_values(config('kriya_products', []));
        }

        if ($products->isEmpty()) {
            return array_values(config('kriya_products', []));
        }

        return $products
            ->values()
            ->map(fn (Product $product, int $index) => $this->frontendProduct($product, $index))
            ->all();
    }

    private function productById(string $id): ?array
    {
        foreach ($this->catalog() as $product) {
            if (($product['id'] ?? '') === $id) {
                return $product;
            }
        }

        return null;
    }

    private function featuredProducts(Collection|array $products): array
    {
        $products = collect($products)->values();
        $featured = $products->filter(fn (array $product) => ! empty($product['featured']))->values();

        return ($featured->isNotEmpty() ? $featured : $products)
            ->take(3)
            ->all();
    }

    private function frontendProduct(Product $product, int $index): array
    {
        return [
            'id' => $product->slug,
            'name' => $product->name,
            'price' => (int) $product->price,
            'category' => $product->category?->name ?? 'Produk Lokal',
            'heritage' => $product->seller?->shop_name ?? 'UMKM Lokal',
            'description' => $product->description ?: 'Produk budaya lokal pilihan dari seller Kriya.Lokal.',
            'story' => $product->description ?: 'Produk ini dikurasi dari seller lokal dan siap dipadukan dengan narasi budaya Kriya.Lokal.',
            'image' => $this->imageFor($product, $index),
            'featured' => $index < 3,
            'stock' => $product->stock,
            'backend_id' => $product->id,
            'selling_type' => $product->selling_type,
            'external_url' => $product->external_url,
        ];
    }

    private function imageFor(Product $product, int $index): string
    {
        $path = $product->mainImage?->image_path;

        if ($path && ! str_starts_with($path, 'http://') && ! str_starts_with($path, 'https://')) {
            return basename($path);
        }

        return $this->fallbackImages[$index % count($this->fallbackImages)];
    }

    private function storefront(string $view, array $data = []): View
    {
        $catalog = $this->catalog();

        return view($view, array_merge([
            'catalog' => $catalog,
            'products' => $catalog,
            'featuredProducts' => $this->featuredProducts($catalog),
            'catalogJson' => json_encode($catalog),
        ], $data));
    }

    public function home(): View
    {
        return $this->storefront('kriya.home');
    }

    public function collection(): View
    {
        return $this->storefront('kriya.collection');
    }

    public function product(string $slug): View
    {
        return $this->storefront('kriya.product', [
            'product' => $this->productById($slug),
            'slug' => $slug,
        ]);
    }

    public function about(): View
    {
        return $this->storefront('kriya.about');
    }

    public function cart(): View
    {
        return $this->storefront('kriya.cart');
    }

    public function checkout(): View
    {
        return $this->storefront('kriya.checkout');
    }

    public function orderSuccess(): View
    {
        return $this->storefront('kriya.order-success');
    }

    public function seller(): View
    {
        return $this->storefront('kriya.seller');
    }
}
