<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductImageFactory extends Factory
{
    public function definition(): array
    {
        return [
            'product_id' => Product::inRandomOrder()->first()?->id,

            'image_path' =>
                'https://picsum.photos/seed/' .
                fake()->uuid() .
                '/600/600',

            'is_main' => true,

            'sort_order' => 1,
        ];
    }
}