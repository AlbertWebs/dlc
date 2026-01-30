<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class PWAController extends Controller
{
    /**
     * Generate and return the PWA manifest file
     */
    public function manifest()
    {
        $siteName = Setting::get('site_name', config('app.name', 'DLC Kenya'));
        $siteDescription = Setting::get('meta_description', 'Destiny Life Coaching - Transform your life through professional coaching and certification programs.');
        
        // Get logo from settings
        $logoFile = Setting::get('logo_file', '');
        $logoUrl = Setting::get('logo_url', '');
        $logo = $logoFile ? asset('storage/' . $logoFile) : ($logoUrl ?: asset('images/logo.png'));
        
        $manifest = [
            'name' => $siteName,
            'short_name' => 'DLC Kenya',
            'description' => $siteDescription,
            'start_url' => '/',
            'display' => 'standalone',
            'background_color' => '#1e3a5f',
            'theme_color' => '#f8b016',
            'orientation' => 'portrait-primary',
            'scope' => '/',
            'icons' => [
                [
                    'src' => $logo,
                    'sizes' => '192x192',
                    'type' => 'image/png',
                    'purpose' => 'any maskable'
                ],
                [
                    'src' => $logo,
                    'sizes' => '512x512',
                    'type' => 'image/png',
                    'purpose' => 'any maskable'
                ]
            ],
            'screenshots' => [],
            'categories' => ['education', 'lifestyle'],
            'shortcuts' => [
                [
                    'name' => 'Programs',
                    'short_name' => 'Programs',
                    'description' => 'View our coaching programs',
                    'url' => '/programs',
                    'icons' => [
                        [
                            'src' => $logo,
                            'sizes' => '96x96'
                        ]
                    ]
                ],
                [
                    'name' => 'Contact',
                    'short_name' => 'Contact',
                    'description' => 'Get in touch with us',
                    'url' => '/contact',
                    'icons' => [
                        [
                            'src' => $logo,
                            'sizes' => '96x96'
                        ]
                    ]
                ]
            ]
        ];
        
        return response()->json($manifest)
            ->header('Content-Type', 'application/manifest+json');
    }
}
