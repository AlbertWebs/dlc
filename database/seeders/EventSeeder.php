<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * Note: No events exist in production database.
     * Add event records here when they are created.
     */
    public function run(): void
    {
        // No events in production database
        // Example structure:
        // Event::updateOrCreate(
        //     ['slug' => 'example-event'],
        //     [
        //         'title' => 'Example Event',
        //         'slug' => 'example-event',
        //         'description' => 'Event description',
        //         'event_date' => '2026-12-31 10:00:00',
        //         'is_published' => true,
        //         'is_featured' => false,
        //         'order' => 0,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]
        // );
    }
}
