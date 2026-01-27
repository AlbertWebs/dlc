<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * Note: No testimonials exist in production database.
     * Add testimonial records here when they are created.
     */
    public function run(): void
    {
        // No testimonials in production database
        // Example structure:
        // Testimonial::updateOrCreate(
        //     ['name' => 'John Doe', 'content' => 'Testimonial text'],
        //     [
        //         'name' => 'John Doe',
        //         'role' => 'Client',
        //         'content' => 'Testimonial text',
        //         'is_featured' => false,
        //         'is_active' => true,
        //         'order' => 0,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]
        // );
    }
}
