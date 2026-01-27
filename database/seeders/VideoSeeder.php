<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Video;

class VideoSeeder extends Seeder
{
    public function run(): void
    {
        Video::updateOrCreate(
            [
                'youtube_id' => '2qxKCD1JHLk',
            ],
            [
                'title' => 'Authority Returns to the Self | Stop Reacting and Start Leading Your Life',
                'description' => 'Authority Returns to the Self | Stop Reacting and Start Leading Your Life',
                'youtube_url' => 'https://www.youtube.com/watch?v=2qxKCD1JHLk',
                'youtube_id' => '2qxKCD1JHLk',
                'thumbnail_url' => 'https://img.youtube.com/vi/2qxKCD1JHLk/maxresdefault.jpg',
                'duration' => null,
                'views' => 0,
                'category' => null,
                'is_featured' => false,
                'is_active' => true,
                'order' => 0,
                'created_at' => '2026-01-26 16:20:35',
                'updated_at' => '2026-01-26 16:20:35',
            ]
        );

        Video::updateOrCreate(
            [
                'youtube_id' => 'ouT6dBhaAv4',
            ],
            [
                'title' => 'Nervous System Reset | Embodied Peace & Zero Limits (Breakthrough with Jeff)',
                'description' => 'Nervous System Reset | Embodied Peace & Zero Limits (Breakthrough with Jeff)',
                'youtube_url' => 'https://www.youtube.com/watch?v=ouT6dBhaAv4',
                'youtube_id' => 'ouT6dBhaAv4',
                'thumbnail_url' => 'https://img.youtube.com/vi/ouT6dBhaAv4/maxresdefault.jpg',
                'duration' => null,
                'views' => 0,
                'category' => null,
                'is_featured' => false,
                'is_active' => true,
                'order' => 0,
                'created_at' => '2026-01-26 16:21:08',
                'updated_at' => '2026-01-26 16:21:08',
            ]
        );

        Video::updateOrCreate(
            [
                'youtube_id' => '9yenx0XBUjY',
            ],
            [
                'title' => 'Grounded Certainty Meditation for 2026 | RESET Session 1 Nervous System Reset',
                'description' => 'Grounded Certainty Meditation for 2026 | RESET Session 1 Nervous System Reset',
                'youtube_url' => 'https://www.youtube.com/watch?v=9yenx0XBUjY',
                'youtube_id' => '9yenx0XBUjY',
                'thumbnail_url' => 'https://img.youtube.com/vi/9yenx0XBUjY/maxresdefault.jpg',
                'duration' => null,
                'views' => 0,
                'category' => null,
                'is_featured' => false,
                'is_active' => true,
                'order' => 0,
                'created_at' => '2026-01-26 16:21:47',
                'updated_at' => '2026-01-26 16:21:47',
            ]
        );

        Video::updateOrCreate(
            [
                'youtube_id' => 'Z67a9NPqcDU',
            ],
            [
                'title' => 'Find Your True North | Why Discipline Without Direction Breaks You | Breakthrough With Jeff',
                'description' => 'Find Your True North | Why Discipline Without Direction Breaks You | Breakthrough With Jeff',
                'youtube_url' => 'https://www.youtube.com/watch?v=Z67a9NPqcDU',
                'youtube_id' => 'Z67a9NPqcDU',
                'thumbnail_url' => 'https://img.youtube.com/vi/Z67a9NPqcDU/maxresdefault.jpg',
                'duration' => null,
                'views' => 0,
                'category' => null,
                'is_featured' => false,
                'is_active' => true,
                'order' => 0,
                'created_at' => '2026-01-26 16:23:55',
                'updated_at' => '2026-01-26 16:23:55',
            ]
        );

    }
}
