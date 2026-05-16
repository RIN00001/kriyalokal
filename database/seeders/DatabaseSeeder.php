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
        User::create([
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

        Seller::create([
            'user_id' => $sellerUser->id,
            'shop_name' => 'Batik Nusantara',
            'slug' => 'batik-nusantara',
            'description' => 'Toko produk budaya lokal Indonesia.',
            'status' => 'active',
        ]);

        collect([
            'Fashion',
            'Kerajinan',
            'Aksesoris',
            'Dekorasi',
        ])->each(function ($name) {
            Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
            ]);
        });

        Product::factory(30)->create()->each(function ($product) {
            ProductImage::factory(fake()->numberBetween(1, 4))->create([
                'product_id' => $product->id,
            ]);
        });
    }
}