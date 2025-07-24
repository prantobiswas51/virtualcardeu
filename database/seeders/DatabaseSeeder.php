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
            'balance' => 10000, // Optional
        ]);

        // Regular user
        User::create([
            'name' => 'John user',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'balance' => 5000,
        ]);


        // Admin user
        Bank::create([
            'user_id' => 2,
            'bank_name' => 'DBBL',
            'bank_location' => 'USA',
            'bank_balance' => 5455,
            'account_type' => 'DFA',
            'bank_account_number' => '5768756 4887',
            'currency' => 'USD',
        ]);

        Card::create([
            'user_id' => 2,
            'number' => 484564845846,
            'amount' => 545,
            'type' => "Reloadable Visa Card",
            'expiry_date' => '4/45',
            'cvc' => '576',
            'status' => 'Inactive',
        ]);
        
    }
}
