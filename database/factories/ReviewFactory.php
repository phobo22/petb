<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->randomElement([1, 2]),
            'product_id' => random_int(1, 16),
            'rating' => random_int(1, 5),
            'comment' => fake()->sentence(10),
            'status' => 'rated',
            'created_at' => fake()->date('Y-m-d'),
        ];
    }
}
