<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\BlogPost;
use Carbon\Carbon;

class ImportBlogManual extends Command
{
    protected $signature = 'blog:import-manual 
                            {--title= : Blog post title}
                            {--url= : Source URL}
                            {--content= : Blog post content (HTML)}
                            {--excerpt= : Blog post excerpt}
                            {--image= : Featured image URL}
                            {--date= : Published date (Y-m-d)}';
    
    protected $description = 'Manually import a single blog post with provided data';

    public function handle()
    {
        $title = $this->option('title');
        $url = $this->option('url');
        $content = $this->option('content');
        $excerpt = $this->option('excerpt');
        $date = $this->option('date');
        $imageUrl = $this->option('image');

        if (!$title || !$url) {
            $this->error('Title and URL are required!');
            $this->line('Usage: php artisan blog:import-manual --title="Post Title" --url="https://..." --content="<p>...</p>"');
            return Command::FAILURE;
        }

        $this->info("Importing: {$title}");

        // Generate slug
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $counter = 1;
        while (BlogPost::where('slug', $slug)->where('source_url', '!=', $url)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        // Download image if provided
        $imagePath = null;
        if ($imageUrl) {
            try {
                $imagePath = $this->downloadImage($imageUrl, $slug);
            } catch (\Exception $e) {
                $this->warn("Failed to download image: " . $e->getMessage());
            }
        }

        // Parse date
        $publishedAt = null;
        if ($date) {
            try {
                $publishedAt = Carbon::parse($date);
            } catch (\Exception $e) {
                // Ignore
            }
        }

        // Create blog post
        BlogPost::updateOrCreate(
            ['source_url' => $url],
            [
                'title' => $title,
                'slug' => $slug,
                'excerpt' => $excerpt ?? Str::limit(strip_tags($content ?? ''), 200),
                'content' => $content,
                'featured_image' => $imagePath,
                'published_at' => $publishedAt,
                'is_published' => true,
            ]
        );

        $this->info("✓ Successfully imported: {$title}");
        return Command::SUCCESS;
    }

    protected function downloadImage(string $url, string $slug): ?string
    {
        try {
            Storage::disk('public')->makeDirectory('blog');
            
            $response = \Illuminate\Support\Facades\Http::timeout(60)
                ->retry(2, 1000)
                ->get($url);
            
            if (!$response->successful()) {
                return null;
            }

            $extension = $this->getImageExtension($url, $response->header('Content-Type'));
            $filename = $slug . '-' . time() . '.' . $extension;
            $path = 'blog/' . $filename;

            Storage::disk('public')->put($path, $response->body());
            return $path;
        } catch (\Exception $e) {
            return null;
        }
    }

    protected function getImageExtension(string $url, ?string $contentType): string
    {
        $path = parse_url($url, PHP_URL_PATH);
        if ($path) {
            $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
            if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                return $ext === 'jpeg' ? 'jpg' : $ext;
            }
        }
        if ($contentType) {
            if (strpos($contentType, 'jpeg') !== false) return 'jpg';
            if (strpos($contentType, 'png') !== false) return 'png';
            if (strpos($contentType, 'gif') !== false) return 'gif';
            if (strpos($contentType, 'webp') !== false) return 'webp';
        }
        return 'jpg';
    }
}
