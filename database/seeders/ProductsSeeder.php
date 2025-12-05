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
            ->count(4)
            ->sequence(
                ['image' => 'item1.jpg'],
                ['image' => 'item2.jpg'],
                ['image' => 'item3.jpg'],
                ['image' => 'item4.jpg'],
            )
            ->create();
    }
}
