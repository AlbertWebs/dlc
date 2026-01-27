<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TeamMember;

class TeamMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * Note: No team members exist in production database.
     * Add team member records here when they are created.
     */
    public function run(): void
    {
        // No team members in production database
        // Example structure:
        // TeamMember::updateOrCreate(
        //     ['name' => 'John Doe', 'email' => 'john@example.com'],
        //     [
        //         'name' => 'John Doe',
        //         'role' => 'Senior Coach',
        //         'bio' => 'Bio text here',
        //         'email' => 'john@example.com',
        //         'is_visible' => true,
        //         'order' => 0,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]
        // );
    }
}
