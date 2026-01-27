<?php

namespace Database\Seeders;

use App\Models\Navigation;
use Illuminate\Database\Seeder;

class NavigationSeeder extends Seeder
{
    public function run(): void
    {
        $headerLinks = [
            ['label' => 'Home', 'url' => '/', 'location' => 'header', 'order' => 1],
            ['label' => 'About Us', 'url' => '/about', 'location' => 'header', 'order' => 2],
            ['label' => 'Events', 'url' => '/events', 'location' => 'header', 'order' => 3],
            ['label' => 'Coaches', 'url' => '/coaches', 'location' => 'header', 'order' => 4],
            ['label' => 'Become a Coach', 'url' => '/become-a-coach', 'location' => 'header', 'order' => 5],
            ['label' => 'Videos', 'url' => '/videos', 'location' => 'header', 'order' => 6],
            ['label' => 'Our Blog', 'url' => '/blog', 'location' => 'header', 'order' => 7],
            // These will be CMS-controlled but not shown in frontend nav
            ['label' => 'Life Mastery Bootcamp', 'url' => '/life-mastery-bootcamp', 'location' => 'header', 'is_visible' => false, 'order' => 8],
            ['label' => 'Life Mastery Webinar', 'url' => '/life-mastery-webinar', 'location' => 'header', 'is_visible' => false, 'order' => 9],
            ['label' => 'My Account', 'url' => '/my-account', 'location' => 'header', 'is_visible' => false, 'order' => 10],
        ];

        $footerLinks = [
            ['label' => 'Home', 'url' => '/', 'location' => 'footer', 'category' => 'quick_links', 'order' => 1],
            ['label' => 'About Us', 'url' => '/about', 'location' => 'footer', 'category' => 'quick_links', 'order' => 2],
            ['label' => 'Events', 'url' => '/events', 'location' => 'footer', 'category' => 'quick_links', 'order' => 3],
            ['label' => 'Coaches', 'url' => '/coaches', 'location' => 'footer', 'category' => 'quick_links', 'order' => 4],
            ['label' => 'Become a Coach', 'url' => '/become-a-coach', 'location' => 'footer', 'category' => 'quick_links', 'order' => 5],
            ['label' => 'Videos', 'url' => '/videos', 'location' => 'footer', 'category' => 'quick_links', 'order' => 6],
            ['label' => 'Contact', 'url' => '/contact', 'location' => 'footer', 'category' => 'quick_links', 'order' => 7],
        ];

        foreach (array_merge($headerLinks, $footerLinks) as $link) {
            Navigation::updateOrCreate(
                [
                    'location' => $link['location'],
                    'label' => $link['label'],
                    'url' => $link['url'],
                    'category' => $link['category'] ?? null,
                ],
                $link
            );
        }
    }
}
