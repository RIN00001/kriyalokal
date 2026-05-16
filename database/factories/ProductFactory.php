<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Seller;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        $name = fake()->words(3, true);

        return [
            'seller_id' => Seller::inRandomOrder()->first()?->id,
            'category_id' => Category::inRandomOrder()->first()?->id,

            'name' => ucwords($name),
            'slug' => Str::slug($name . '-' . fake()->unique()->numberBetween(1, 9999)),

            'description' => fake()->paragraphs(3, true),

            'price' => fake()->numberBetween(25000, 500000),
            'stock' => fake()->numberBetween(0, 50),

            'selling_type' => fake()->randomElement([
                'internal',
                'external',
                'both',
            ]),

            'external_url' => fake()->optional()->url(),

            'is_active' => fake()->boolean(90),
        ];
    }
}