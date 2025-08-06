<?php

namespace Database\Seeders;

use App\Models\Bank;
use App\Models\Card;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // Change in production
            'role' => 'Admin',
            'balance' => 1000, // Optional
        ]);

        // Regular user
        User::create([
            'name' => 'John user',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'balance' => 5000,
        ]);        
    }
}
