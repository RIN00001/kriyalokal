<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $customer = User::create([
            'name' => 'Customer Test',
            'email' => 'customer@test.com',
            'password' => Hash::make('password'),
            'role' => 'customer',
        ]);

        $sellerUser = User::create([
            'name' => 'Seller Test',
            'email' => 'seller@test.com',
            'password' => Hash::make('password'),
            'role' => 'seller',
        ]);

        User::create([
            'name' => 'Employee Test',
            'email' => 'employee@test.com',
            'password' => Hash::make('password'),
            'role' => 'employee',
        ]);

        User::create([
            'name' => 'Admin Test',
            'email' => 'admin@test.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $seller = Seller::create([
            'user_id' => $sellerUser->id,
            'shop_name' => 'Batik Nusantara',
            'slug' => 'batik-nusantara',
            'description' => 'Toko produk budaya lokal Indonesia.',
            'status' => 'active',
        ]);

        $categories = collect([
            'Fashion',
            'Kerajinan',
            'Aksesoris',
            'Dekorasi',
        ])->map(function ($name) {
            return Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
            ]);
        });

        $products = [
            [
                'name' => 'Batik Modern Kriya',
                'category' => 'Fashion',
                'price' => 150000,
                'stock' => 20,
                'selling_type' => 'internal',
            ],
            [
                'name' => 'Topeng Kayu Tradisional',
                'category' => 'Kerajinan',
                'price' => 220000,
                'stock' => 10,
                'selling_type' => 'internal',
            ],
            [
                'name' => 'Gelang Motif Etnik',
                'category' => 'Aksesoris',
                'price' => 45000,
                'stock' => 35,
                'selling_type' => 'both',
                'external_url' => 'https://tokopedia.com/example-product',
            ],
            [
                'name' => 'Hiasan Dinding Nusantara',
                'category' => 'Dekorasi',
                'price' => 175000,
                'stock' => 8,
                'selling_type' => 'external',
                'external_url' => 'https://shopee.co.id/example-product',
            ],
        ];

        foreach ($products as $item) {
            $category = $categories->firstWhere('name', $item['category']);

            $product = Product::create([
                'seller_id' => $seller->id,
                'category_id' => $category->id,
                'name' => $item['name'],
                'slug' => Str::slug($item['name']),
                'description' => 'Produk budaya lokal untuk prototype KriyaLokal.',
                'price' => $item['price'],
                'stock' => $item['stock'],
                'selling_type' => $item['selling_type'],
                'external_url' => $item['external_url'] ?? null,
                'is_active' => true,
            ]);

            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => 'products/sample-product.jpg',
                'is_main' => true,
                'sort_order' => 1,
            ]);
        }
    }
}