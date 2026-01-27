<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function index()
    {
        return view('admin.settings', [
            'settings' => $this->getSettings()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            // General Settings
            'site_name' => 'nullable|string|max:255',
            'site_url' => 'nullable|url|max:255',
            'site_email' => 'nullable|email|max:255',
            'timezone' => 'nullable|string|max:50',
            
            // Contact Information
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'location' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:500',
            'city' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            
            // Social Media
            'social_facebook' => 'nullable|url|max:255',
            'social_linkedin' => 'nullable|url|max:255',
            'social_instagram' => 'nullable|url|max:255',
            'social_twitter' => 'nullable|url|max:255',
            'social_youtube' => 'nullable|url|max:255',
            
            // SEO Settings
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
            'google_analytics' => 'nullable|string|max:100',
            'google_tag_manager' => 'nullable|string|max:100',
            
            // Appearance
            'logo_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:5120',
            'favicon_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,ico|max:2048',
            'logo_url' => 'nullable|url|max:500',
            'favicon_url' => 'nullable|url|max:500',
            'clear_logo' => 'nullable|boolean',
            'clear_favicon' => 'nullable|boolean',
            'hero_type' => 'nullable|in:slider,fullwidth-video',
            
            // Who We Are Section
            'about_section_title' => 'nullable|string|max:255',
            'about_section_subtitle' => 'nullable|string|max:500',
            'about_section_description' => 'nullable|string',
            'about_section_image' => 'nullable|url|max:500',
            
            // Home Page Images
            'home_breakthrough_coach_image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'home_breakthrough_coach_image_url' => 'nullable|url|max:500',
            'clear_breakthrough_coach_image' => 'nullable|boolean',
            'home_video_testimonial_image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'home_video_testimonial_image_url' => 'nullable|url|max:500',
            'clear_video_testimonial_image' => 'nullable|boolean',
            
            // Google Reviews API
            'google_places_api_key' => 'nullable|string|max:255',
            'google_place_id' => 'nullable|string|max:255',
        ]);

        // Handle logo file upload
        if ($request->hasFile('logo_file')) {
            try {
                // Delete old logo if exists
                $oldLogo = Setting::get('logo_file');
                if ($oldLogo && Storage::disk('public')->exists($oldLogo)) {
                    Storage::disk('public')->delete($oldLogo);
                }
                
                $logoPath = $request->file('logo_file')->store('settings', 'public');
                Setting::set('logo_file', $logoPath);
            } catch (\Exception $e) {
                return redirect()->route('admin.settings')
                    ->withErrors(['logo_file' => 'Error uploading logo: ' . $e->getMessage()])
                    ->withInput();
            }
        } elseif ($request->has('clear_logo')) {
            $oldLogo = Setting::get('logo_file');
            if ($oldLogo && Storage::disk('public')->exists($oldLogo)) {
                Storage::disk('public')->delete($oldLogo);
            }
            Setting::set('logo_file', null);
        }

        // Handle favicon file upload
        if ($request->hasFile('favicon_file')) {
            try {
                // Delete old favicon if exists
                $oldFavicon = Setting::get('favicon_file');
                if ($oldFavicon && Storage::disk('public')->exists($oldFavicon)) {
                    Storage::disk('public')->delete($oldFavicon);
                }
                
                $faviconPath = $request->file('favicon_file')->store('settings', 'public');
                Setting::set('favicon_file', $faviconPath);
            } catch (\Exception $e) {
                return redirect()->route('admin.settings')
                    ->withErrors(['favicon_file' => 'Error uploading favicon: ' . $e->getMessage()])
                    ->withInput();
            }
        } elseif ($request->has('clear_favicon')) {
            $oldFavicon = Setting::get('favicon_file');
            if ($oldFavicon && Storage::disk('public')->exists($oldFavicon)) {
                Storage::disk('public')->delete($oldFavicon);
            }
            Setting::set('favicon_file', null);
        }

        // Handle breakthrough coach image upload
        if ($request->hasFile('home_breakthrough_coach_image_file')) {
            try {
                $oldImage = Setting::get('home_breakthrough_coach_image_file');
                if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                    Storage::disk('public')->delete($oldImage);
                }
                
                $imagePath = $request->file('home_breakthrough_coach_image_file')->store('settings/home-images', 'public');
                Setting::set('home_breakthrough_coach_image_file', $imagePath);
            } catch (\Exception $e) {
                return redirect()->route('admin.settings')
                    ->withErrors(['home_breakthrough_coach_image_file' => 'Error uploading image: ' . $e->getMessage()])
                    ->withInput();
            }
        } elseif ($request->has('clear_breakthrough_coach_image')) {
            $oldImage = Setting::get('home_breakthrough_coach_image_file');
            if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                Storage::disk('public')->delete($oldImage);
            }
            Setting::set('home_breakthrough_coach_image_file', null);
        }

        // Handle video testimonial image upload
        if ($request->hasFile('home_video_testimonial_image_file')) {
            try {
                $oldImage = Setting::get('home_video_testimonial_image_file');
                if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                    Storage::disk('public')->delete($oldImage);
                }
                
                $imagePath = $request->file('home_video_testimonial_image_file')->store('settings/home-images', 'public');
                Setting::set('home_video_testimonial_image_file', $imagePath);
            } catch (\Exception $e) {
                return redirect()->route('admin.settings')
                    ->withErrors(['home_video_testimonial_image_file' => 'Error uploading image: ' . $e->getMessage()])
                    ->withInput();
            }
        } elseif ($request->has('clear_video_testimonial_image')) {
            $oldImage = Setting::get('home_video_testimonial_image_file');
            if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                Storage::disk('public')->delete($oldImage);
            }
            Setting::set('home_video_testimonial_image_file', null);
        }

        // Save all other settings to database
        foreach ($validated as $key => $value) {
            // Skip file fields as they're handled above
            if (!in_array($key, [
                'logo_file', 'favicon_file', 'clear_logo', 'clear_favicon',
                'home_breakthrough_coach_image_file', 'clear_breakthrough_coach_image',
                'home_video_testimonial_image_file', 'clear_video_testimonial_image'
            ])) {
                Setting::set($key, $value ?? '');
            }
        }

        return redirect()->route('admin.settings')
            ->with('success', 'Settings saved successfully!');
    }

    private function getSettings()
    {
        // Get settings from database, fallback to config
        return [
            'site_name' => Setting::get('site_name', config('app.name', 'DLC')),
            'site_url' => Setting::get('site_url', config('app.url', url('/'))),
            'site_email' => Setting::get('site_email', config('app.email', 'info@dlc.co.ke')),
            'timezone' => Setting::get('timezone', config('app.timezone', 'Africa/Nairobi')),
            'phone' => Setting::get('phone', config('app.phone', '+254 722 992 111')),
            'email' => Setting::get('email', config('app.email', 'info@dlc.co.ke')),
            'location' => Setting::get('location', config('app.location', 'Nairobi, Kenya')),
            'address' => Setting::get('address', config('app.address', '')),
            'city' => Setting::get('city', config('app.city', 'Nairobi')),
            'country' => Setting::get('country', config('app.country', 'Kenya')),
            'postal_code' => Setting::get('postal_code', config('app.postal_code', '')),
            'social_facebook' => Setting::get('social_facebook', config('app.social.facebook', '')),
            'social_linkedin' => Setting::get('social_linkedin', config('app.social.linkedin', '')),
            'social_instagram' => Setting::get('social_instagram', config('app.social.instagram', '')),
            'social_twitter' => Setting::get('social_twitter', config('app.social.twitter', '')),
            'social_youtube' => Setting::get('social_youtube', config('app.social.youtube', '')),
            'meta_description' => Setting::get('meta_description', config('app.meta.description', '')),
            'meta_keywords' => Setting::get('meta_keywords', config('app.meta.keywords', '')),
            'google_analytics' => Setting::get('google_analytics', config('app.google.analytics', '')),
            'google_tag_manager' => Setting::get('google_tag_manager', config('app.google.tag_manager', '')),
            'logo_file' => Setting::get('logo_file', ''),
            'favicon_file' => Setting::get('favicon_file', ''),
            'logo_url' => Setting::get('logo_url', config('app.logo_url', '')),
            'favicon_url' => Setting::get('favicon_url', config('app.favicon_url', '')),
            'hero_type' => Setting::get('hero_type', 'slider'),
            'about_section_title' => Setting::get('about_section_title', 'Empowering Lives Through Expert Coaching'),
            'about_section_subtitle' => Setting::get('about_section_subtitle', 'We are a leading coaching organization dedicated to helping individuals unlock their full potential through personalized guidance, proven methodologies, and comprehensive certification programs.'),
            'about_section_description' => Setting::get('about_section_description', 'Our mission is to transform lives by providing world-class coaching education and support. With years of experience and a commitment to excellence, we\'ve helped thousands of individuals achieve their personal and professional goals.'),
            'about_section_image' => Setting::get('about_section_image', config('app.about_section_image', '')),
            'home_breakthrough_coach_image_file' => Setting::get('home_breakthrough_coach_image_file', ''),
            'home_breakthrough_coach_image_url' => Setting::get('home_breakthrough_coach_image_url', ''),
            'home_video_testimonial_image_file' => Setting::get('home_video_testimonial_image_file', ''),
            'home_video_testimonial_image_url' => Setting::get('home_video_testimonial_image_url', ''),
            'google_places_api_key' => Setting::get('google_places_api_key', ''),
            'google_place_id' => Setting::get('google_place_id', ''),
        ];
    }
}
