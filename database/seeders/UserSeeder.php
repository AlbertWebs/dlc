<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        App\Models\User::updateOrCreate(
            [
                'email' => 'admin@dlc.co.ke',
            ],
            [
                'id' => 1,
                'name' => 'DLC Administrator',
                'email_verified_at' => '2026-01-30 08:18:16',
                'password' => '$2y$12$.DeGQ/ySrq2kEB0m7mtuDOsIsCuxRYJcyOw.WqgidN.7QN/pUvKKW',
                'remember_token' => 'MBxduoDm7Aa0EO0VKRaJqZT7wbgZvLHrpD8D9WdJO5iExeJuVbKdJkfu7Z32',
                'created_at' => '2026-01-30 08:18:16',
                'updated_at' => '2026-01-30 08:18:16',
            ]
        );

    }
}
