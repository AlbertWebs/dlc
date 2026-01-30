<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HeroBanner;

class HeroBannerSeeder extends Seeder
{
    public function run(): void
    {
        HeroBanner::updateOrCreate(
            [
                'location' => 'home',
                'order' => 0,
                'media_type' => 'video',
            ],
            [
                'title' => 'Transform Your Life Through Professional Coaching',
                'subtitle' => 'Unlock your potential with certified coaching programs designed to help you achieve your personal and professional goals.',
                'description' => null,
                'image' => null,
                'cta_text' => 'Find a Coach',
                'cta_link' => 'https://calendly.com/breakthrough101/1-on-1-coaching-session-with-jeff',
                'is_active' => 1,
                'created_at' => '2026-01-26 08:51:02',
                'updated_at' => '2026-01-30 06:24:56',
                'video_url' => null,
                'secondary_cta_text' => 'Learn More',
                'secondary_cta_link' => '/programs',
                'video_file' => 'hero-banners/videos/CzIL7WK8hzQM7uIXCcVlBa868LlSFYnvEPIh8Zsf.mp4',
            ]
        );

        HeroBanner::updateOrCreate(
            [
                'location' => 'home',
                'order' => 0,
                'media_type' => 'image',
            ],
            [
                'title' => 'Transform Your Life Through Professional Coaching',
                'subtitle' => 'Unlock your potential with certified coaching programs designed to help you achieve your personal and professional goals.',
                'description' => null,
                'image' => 'hero-banners/7Mepi18JVqNRyquHOkCy2iMYi7XeKemHlYnO6nuL.jpg',
                'cta_text' => 'Find a Coach',
                'cta_link' => 'https://calendly.com/breakthrough101/1-on-1-coaching-session-with-jeff',
                'is_active' => 1,
                'created_at' => '2026-01-26 08:52:40',
                'updated_at' => '2026-01-30 06:24:57',
                'video_url' => null,
                'secondary_cta_text' => 'Learn More',
                'secondary_cta_link' => '/programs',
                'video_file' => null,
            ]
        );

    }
}
