<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\Cart;
use App\Models\CartItem;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->count(2)
            ->sequence(
                ['email' => 'ptb@gmail.com', 'password' => 'ptb12345'],
                ['email' => 'ptb1@gmail.com', 'password' => 'ptb12345'],
            )
            ->afterCreating(function (User $user) {
                UserProfile::factory()->create([
                    'user_id' => $user->id,
                ]);

                Cart::factory()
                    ->afterCreating(function (Cart $cart) {
                        CartItem::factory()
                            ->count(3)
                            ->create([
                                'cart_id' => $cart->id,
                        ]);
                    })
                    ->create([
                        'user_id' => $user->id,
                ]);
            })
            ->create();
    }
}
