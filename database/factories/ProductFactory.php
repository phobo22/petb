<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Products>
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
        return [
            'name' => fake()->words(2, true),
            'category' => fake()->randomElement(['clothing', 'food', 'toy']),
            'for' => fake()->randomElement(['dog', 'cat']),
            'price' => fake()->randomFloat(2, 3, 30),
            'reviews' => fake()->randomElement([0, 1, 2, 3, 4, 5]),
            'image' => fake()->randomElement(['item1', 'item2', 'item3', 'item4']) . '.jpg',
        ];
    }
}
