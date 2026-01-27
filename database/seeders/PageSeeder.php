<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * Note: No pages exist in production database.
     * Add page records here when they are created.
     */
    public function run(): void
    {
        // No pages in production database
        // Example structure:
        // Page::updateOrCreate(
        //     ['slug' => 'example-page'],
        //     [
        //         'title' => 'Example Page',
        //         'slug' => 'example-page',
        //         'content' => 'Page content here',
        //         'is_published' => true,
        //         'order' => 0,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]
        // );
    }
}
