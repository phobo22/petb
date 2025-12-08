<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::factory()
            ->count(16)
            ->sequence(fn ($sequence) => [
                'category' => ['cloth', 'food', 'toy'][$sequence->index % 3],
                'image' => 'item' . ($sequence->index + 1) . '.jpg',
            ])
            ->create();
    }
}
