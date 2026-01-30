<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Seed in order to respect dependencies
        $this->call([
        // Core settings first
        SettingSeeder::class,
        
        // Admin user (must be seeded before other content)
        AdminUserSeeder::class,
        
        // Navigation structure
        NavigationSeeder::class,
        
        // Content
        ProgramSeeder::class,
        HeroBannerSeeder::class,
        VideoSeeder::class,
        
        // People
        CoachSeeder::class,
        ImportedCoaches20260127Seeder::class,
        
        // Content continued
        BlogPostSeeder::class,
        LegalPageSeeder::class,
        
        // Note: Pages, Team Members, Events, and Testimonials seeders
        // are not included as they have no data in production.
        // Add them here when data exists:
        // PageSeeder::class,
        // TeamMemberSeeder::class,
        // EventSeeder::class,
        // TestimonialSeeder::class,
        ]);
    }
}
