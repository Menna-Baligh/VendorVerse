<?php

namespace Database\Factories;
use Bezhanov\Faker\Provider\Commerce;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = $this->faker;
        $faker->addProvider(new Commerce($faker));
        $name = $faker->unique()->category;
        return [
            'name' => $name,
            'slug' => \Str::slug($name) . '-' . $this->faker->unique()->randomNumber(5),
            'description' => $this->faker->sentence(16),
            'image' => $this->faker->imageUrl(),
        ];
    }
}
