<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Navigation;

class NavigationSeeder extends Seeder
{
    public function run(): void
    {
        Navigation::updateOrCreate(
            [
                'label' => 'Home',
                'url' => '/',
                'location' => 'header',
            ],
            [
                'category' => null,
                'is_visible' => 1,
                'order' => 1,
                'created_at' => '2025-12-10 09:18:00',
                'updated_at' => '2025-12-10 09:18:00',
            ]
        );

        Navigation::updateOrCreate(
            [
                'label' => 'About Us',
                'url' => '/about',
                'location' => 'header',
            ],
            [
                'category' => null,
                'is_visible' => 1,
                'order' => 2,
                'created_at' => '2025-12-10 09:18:00',
                'updated_at' => '2025-12-10 09:18:00',
            ]
        );

        Navigation::updateOrCreate(
            [
                'label' => 'Events',
                'url' => '/events',
                'location' => 'header',
            ],
            [
                'category' => null,
                'is_visible' => 1,
                'order' => 3,
                'created_at' => '2025-12-10 09:18:00',
                'updated_at' => '2025-12-10 09:18:00',
            ]
        );

        Navigation::updateOrCreate(
            [
                'label' => 'Become a Coach',
                'url' => '/become-a-coach',
                'location' => 'header',
            ],
            [
                'category' => null,
                'is_visible' => 1,
                'order' => 5,
                'created_at' => '2025-12-10 09:18:00',
                'updated_at' => '2026-01-27 08:08:19',
            ]
        );

        Navigation::updateOrCreate(
            [
                'label' => 'Life Mastery Bootcamp',
                'url' => '/life-mastery-bootcamp',
                'location' => 'header',
            ],
            [
                'category' => null,
                'is_visible' => 0,
                'order' => 8,
                'created_at' => '2025-12-10 09:18:00',
                'updated_at' => '2026-01-27 08:08:19',
            ]
        );

        Navigation::updateOrCreate(
            [
                'label' => 'Life Mastery Webinar',
                'url' => '/life-mastery-webinar',
                'location' => 'header',
            ],
            [
                'category' => null,
                'is_visible' => 0,
                'order' => 9,
                'created_at' => '2025-12-10 09:18:00',
                'updated_at' => '2026-01-27 08:08:19',
            ]
        );

        Navigation::updateOrCreate(
            [
                'label' => 'My Account',
                'url' => '/my-account',
                'location' => 'header',
            ],
            [
                'category' => null,
                'is_visible' => 0,
                'order' => 10,
                'created_at' => '2025-12-10 09:18:00',
                'updated_at' => '2026-01-27 08:08:19',
            ]
        );

        Navigation::updateOrCreate(
            [
                'label' => 'Home',
                'url' => '/',
                'location' => 'footer',
            ],
            [
                'category' => 'quick_links',
                'is_visible' => 1,
                'order' => 1,
                'created_at' => '2025-12-10 09:18:00',
                'updated_at' => '2025-12-10 09:18:00',
            ]
        );

        Navigation::updateOrCreate(
            [
                'label' => 'About Us',
                'url' => '/about',
                'location' => 'footer',
            ],
            [
                'category' => 'quick_links',
                'is_visible' => 1,
                'order' => 2,
                'created_at' => '2025-12-10 09:18:00',
                'updated_at' => '2025-12-10 09:18:00',
            ]
        );

        Navigation::updateOrCreate(
            [
                'label' => 'Events',
                'url' => '/events',
                'location' => 'footer',
            ],
            [
                'category' => 'quick_links',
                'is_visible' => 1,
                'order' => 3,
                'created_at' => '2025-12-10 09:18:00',
                'updated_at' => '2025-12-10 09:18:00',
            ]
        );

        Navigation::updateOrCreate(
            [
                'label' => 'Become a Coach',
                'url' => '/become-a-coach',
                'location' => 'footer',
            ],
            [
                'category' => 'quick_links',
                'is_visible' => 1,
                'order' => 5,
                'created_at' => '2025-12-10 09:18:00',
                'updated_at' => '2026-01-27 08:52:21',
            ]
        );

        Navigation::updateOrCreate(
            [
                'label' => 'Contact',
                'url' => '/contact',
                'location' => 'footer',
            ],
            [
                'category' => 'quick_links',
                'is_visible' => 1,
                'order' => 7,
                'created_at' => '2025-12-10 09:18:00',
                'updated_at' => '2026-01-27 08:52:21',
            ]
        );

        Navigation::updateOrCreate(
            [
                'label' => 'Videos',
                'url' => '/videos',
                'location' => 'header',
            ],
            [
                'category' => null,
                'is_visible' => 1,
                'order' => 6,
                'created_at' => '2026-01-26 09:27:42',
                'updated_at' => '2026-01-27 08:08:19',
            ]
        );

        Navigation::updateOrCreate(
            [
                'label' => 'Videos',
                'url' => '/videos',
                'location' => 'footer',
            ],
            [
                'category' => 'quick_links',
                'is_visible' => 1,
                'order' => 6,
                'created_at' => '2026-01-26 09:27:42',
                'updated_at' => '2026-01-27 08:52:21',
            ]
        );

        Navigation::updateOrCreate(
            [
                'label' => 'Coaches',
                'url' => '/coaches',
                'location' => 'header',
            ],
            [
                'category' => null,
                'is_visible' => 1,
                'order' => 4,
                'created_at' => '2026-01-27 08:08:19',
                'updated_at' => '2026-01-27 08:08:19',
            ]
        );

        Navigation::updateOrCreate(
            [
                'label' => 'Coaches',
                'url' => '/coaches',
                'location' => 'footer',
            ],
            [
                'category' => 'quick_links',
                'is_visible' => 1,
                'order' => 4,
                'created_at' => '2026-01-27 08:17:32',
                'updated_at' => '2026-01-27 08:17:32',
            ]
        );

        Navigation::updateOrCreate(
            [
                'label' => 'Our Blog',
                'url' => '/blog',
                'location' => 'header',
            ],
            [
                'category' => null,
                'is_visible' => 1,
                'order' => 7,
                'created_at' => '2026-01-27 08:52:21',
                'updated_at' => '2026-01-27 08:52:21',
            ]
        );

    }
}
