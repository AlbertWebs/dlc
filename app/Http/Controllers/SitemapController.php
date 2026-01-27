<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\Event;
use App\Models\BlogPost;
use App\Models\Coach;
use Illuminate\Http\Request;

class SitemapController extends Controller
{
    public function index()
    {
        $sitemap = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . "\n";
        
        $baseUrl = config('app.url');
        $now = now()->toAtomString();
        
        // Homepage
        $sitemap .= $this->url($baseUrl, $now, '1.0', 'daily');
        
        // Static pages
        $staticPages = [
            ['url' => '/about', 'priority' => '0.9', 'changefreq' => 'monthly'],
            ['url' => '/become-a-coach', 'priority' => '0.9', 'changefreq' => 'monthly'],
            ['url' => '/contact', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => '/events', 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['url' => '/programs', 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['url' => '/coaches', 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['url' => '/videos', 'priority' => '0.7', 'changefreq' => 'weekly'],
            ['url' => '/blog', 'priority' => '0.8', 'changefreq' => 'daily'],
        ];
        
        foreach ($staticPages as $page) {
            $sitemap .= $this->url($baseUrl . $page['url'], $now, $page['priority'], $page['changefreq']);
        }
        
        // Programs
        try {
            $programs = Program::where('is_published', true)->get();
            foreach ($programs as $program) {
                $slug = $program->slug;
                if (str_contains($slug, 'httplocalhost') || str_contains($slug, 'http://') || str_contains($slug, 'https://')) {
                    $slug = \Illuminate\Support\Str::slug($program->title);
                }
                $sitemap .= $this->url($baseUrl . '/programs/' . $slug, $program->updated_at->toAtomString(), '0.8', 'monthly');
            }
        } catch (\Exception $e) {
            // Continue if programs table doesn't exist
        }
        
        // Events
        try {
            $events = Event::where('is_published', true)->get();
            foreach ($events as $event) {
                $sitemap .= $this->url($baseUrl . '/events', $event->updated_at->toAtomString(), '0.7', 'weekly');
            }
        } catch (\Exception $e) {
            // Continue if events table doesn't exist
        }
        
        // Blog Posts
        try {
            $blogPosts = BlogPost::where('is_published', true)->get();
            foreach ($blogPosts as $post) {
                $sitemap .= $this->url($baseUrl . '/blog/' . $post->slug, $post->updated_at->toAtomString(), '0.7', 'monthly');
            }
        } catch (\Exception $e) {
            // Continue if blog_posts table doesn't exist
        }
        
        // Coaches
        try {
            $coaches = Coach::where('is_published', true)->get();
            foreach ($coaches as $coach) {
                $slug = $coach->slug;
                if (str_contains($slug, 'httplocalhost') || str_contains($slug, 'http://') || str_contains($slug, 'https://')) {
                    $slug = \Illuminate\Support\Str::slug($coach->name);
                }
                $sitemap .= $this->url($baseUrl . '/coach/' . $slug, $coach->updated_at->toAtomString(), '0.6', 'monthly');
            }
        } catch (\Exception $e) {
            // Continue if coaches table doesn't exist
        }
        
        $sitemap .= '</urlset>';
        
        return response($sitemap, 200)
            ->header('Content-Type', 'application/xml');
    }
    
    private function url($loc, $lastmod, $priority, $changefreq)
    {
        return "  <url>\n" .
               "    <loc>" . htmlspecialchars($loc) . "</loc>\n" .
               "    <lastmod>" . $lastmod . "</lastmod>\n" .
               "    <changefreq>" . $changefreq . "</changefreq>\n" .
               "    <priority>" . $priority . "</priority>\n" .
               "  </url>\n";
    }
}
