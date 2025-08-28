<?php

namespace Database\Factories;

use App\Models\Store;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->words(2,true);
        return [
            'name' => $name,
            'slug' => \Str::slug($name),
            'description' => $this->faker->sentence(16),
            'image' => $this->faker->imageUrl(),
            'price' => $this->faker->randomFloat(1, 1, 499),
            'compare_price' => $this->faker->randomFloat(1, 500, 999),
            'featured' => rand(0,1),
            'category_id' => Category::inRandomOrder()->first()->id,
            'store_id' => Store::inRandomOrder()->first()->id,
        ];
    }
}
