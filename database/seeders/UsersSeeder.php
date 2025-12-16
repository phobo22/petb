<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserProfile;

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
            })
            ->create();
    }
}
