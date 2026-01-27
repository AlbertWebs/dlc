<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * Note: No users exist in production database.
     * Add user records here when they are created.
     */
    public function run(): void
    {
        // No users in production database
        // Example structure:
        // User::updateOrCreate(
        //     ['email' => 'admin@dlc.co.ke'],
        //     [
        //         'name' => 'Admin User',
        //         'email' => 'admin@dlc.co.ke',
        //         'password' => bcrypt('password'),
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]
        // );
    }
}
