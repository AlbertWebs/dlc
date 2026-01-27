<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use DOMDocument;
use DOMXPath;

class BlogPostSeeder extends Seeder
{
    protected $baseUrl = 'https://dlc.co.ke';

    protected $blogUrls = [
        'https://dlc.co.ke/professional-coach-training-courses-in-kenya-become-a-certified-icr-coach/',
        'https://dlc.co.ke/the-school-of-life/',
        'https://dlc.co.ke/the-breakthrough-forum/',
        'https://dlc.co.ke/how-to-become-a-professional-life-coach-in-kenya-insights-into-destiny-life-coaching/',
        'https://dlc.co.ke/how-to-become-a-certified-life-coach-with-destiny-life-coaching-in-kenya-your-ultimate-guide/',
        'https://dlc.co.ke/how-to-change-your-life-completely/',
        'https://dlc.co.ke/personal-development-training-in-kenya/',
        'https://dlc.co.ke/life-coaching-course-in-kenya/',
        'https://dlc.co.ke/you-need-to-know-about-building-a-life-coaching-brand/',
        'https://dlc.co.ke/become-a-professional-life-coach/',
        'https://dlc.co.ke/how-to-get-a-life-coach-certification/',
        'https://dlc.co.ke/why-is-life-coaching-important/',
        'https://dlc.co.ke/what-is-a-simple-self-coaching-method/',
        'https://dlc.co.ke/seven-principles-of-life-coaching/',
        'https://dlc.co.ke/online-life-coaching-can-provide-the-help-you-need/',
        'https://dlc.co.ke/life-coaching-tips-organize-yourself-for-success/',
        'https://dlc.co.ke/what-are-your-income-salary-and-annual-income-as-a-professional-life-coach/',
        'https://dlc.co.ke/is-a-personal-life-coach-suitable-for-you/',
        'https://dlc.co.ke/how-to-become-a-life-coach-qualifications-and-necessary-expenses/',
    ];

    public function run(): void
    {
        $this->command->info('Starting blog post import...');
        $this->command->newLine();

        // Ensure blog images directory exists
        Storage::disk('public')->makeDirectory('blog');

        $importedCount = 0;
        $skippedCount = 0;
        $errorCount = 0;

        foreach ($this->blogUrls as $url) {
            try {
                $this->command->info("Processing: {$url}");
                
                // Check if blog already exists
                $existing = BlogPost::where('source_url', $url)->first();
                if ($existing) {
                    $this->command->warn("  → Already exists, skipping...");
                    $skippedCount++;
                    continue;
                }

                $this->importBlogPost($url);
                $importedCount++;
                $this->command->info("  → Successfully imported!");
            } catch (\Exception $e) {
                $errorCount++;
                $this->command->error("  → Error: " . $e->getMessage());
            }
            $this->command->newLine();
        }

        $this->command->newLine();
        $this->command->info("Import completed!");
        $this->command->info("  - Imported: {$importedCount}");
        $this->command->info("  - Skipped: {$skippedCount}");
        $this->command->info("  - Errors: {$errorCount}");
    }

    protected function importBlogPost(string $url): void
    {
        // Fetch the blog post page
        $html = null;
        
        // Try HTTP client first
        try {
            $response = Http::timeout(120)
                ->retry(3, 5000)
                ->withoutVerifying() // Disable SSL verification for development
                ->withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
                    'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
                    'Accept-Language' => 'en-US,en;q=0.9',
                ])
                ->get($url);

            if ($response->successful()) {
                $html = $response->body();
            }
        } catch (\Exception $e) {
            $this->command->warn("HTTP client failed: " . $e->getMessage());
        }
        
        // Fallback to file_get_contents if HTTP client fails
        if (empty($html)) {
            try {
                $context = stream_context_create([
                    'http' => [
                        'method' => 'GET',
                        'header' => [
                            'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                            'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                        ],
                        'timeout' => 120,
                        'ignore_errors' => true,
                    ],
                    'ssl' => [
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                    ],
                ]);
                
                $html = @file_get_contents($url, false, $context);
            } catch (\Exception $e) {
                throw new \Exception("Failed to fetch blog post: " . $e->getMessage());
            }
        }
        
        if (empty($html)) {
            throw new \Exception("Failed to fetch blog post. No content received.");
        }

        $data = $this->parseBlogPost($html, $url);

        if (empty($data['title'])) {
            throw new \Exception("Could not extract title from blog post");
        }

        // Download and save featured image
        if (!empty($data['featured_image_url'])) {
            $data['featured_image'] = $this->downloadImage($data['featured_image_url'], $data['slug']);
        }

        // Create blog post
        BlogPost::create([
            'title' => $data['title'],
            'slug' => $data['slug'],
            'excerpt' => $data['excerpt'],
            'content' => $data['content'],
            'featured_image' => $data['featured_image'],
            'published_at' => $data['published_at'],
            'source_url' => $url,
            'is_published' => true,
        ]);
    }

    protected function parseBlogPost(string $html, string $url): array
    {
        libxml_use_internal_errors(true);
        $dom = new DOMDocument();
        @$dom->loadHTML('<?xml encoding="UTF-8">' . $html);
        libxml_clear_errors();

        $xpath = new DOMXPath($dom);

        // Extract title
        $title = '';
        $titleSelectors = [
            '//h1[contains(@class, "entry-title")]',
            '//h1[contains(@class, "post-title")]',
            '//article//h1',
            '//h1',
        ];
        foreach ($titleSelectors as $selector) {
            $nodes = $xpath->query($selector);
            if ($nodes && $nodes->length > 0) {
                $title = trim($nodes->item(0)->textContent);
                break;
            }
        }

        // Extract content
        $content = '';
        $contentSelectors = [
            '//article//div[contains(@class, "entry-content")]',
            '//article//div[contains(@class, "post-content")]',
            '//div[contains(@class, "entry-content")]',
            '//article',
        ];
        foreach ($contentSelectors as $selector) {
            $nodes = $xpath->query($selector);
            if ($nodes && $nodes->length > 0) {
                $contentNode = $nodes->item(0);
                // Get inner HTML
                $innerHTML = '';
                foreach ($contentNode->childNodes as $child) {
                    $innerHTML .= $dom->saveHTML($child);
                }
                $content = $innerHTML;
                break;
            }
        }

        // Extract excerpt
        $excerpt = '';
        $excerptSelectors = [
            '//meta[@property="og:description"]/@content',
            '//meta[@name="description"]/@content',
        ];
        foreach ($excerptSelectors as $selector) {
            $nodes = $xpath->query($selector);
            if ($nodes && $nodes->length > 0) {
                $excerpt = trim($nodes->item(0)->value);
                break;
            }
        }
        if (empty($excerpt) && !empty($content)) {
            $excerpt = Str::limit(strip_tags($content), 200);
        }

        // Extract featured image
        $featuredImageUrl = '';
        $imageSelectors = [
            '//meta[@property="og:image"]/@content',
            '//img[contains(@class, "wp-post-image")]/@src',
            '//article//img[1]/@src',
        ];
        foreach ($imageSelectors as $selector) {
            $nodes = $xpath->query($selector);
            if ($nodes && $nodes->length > 0) {
                $featuredImageUrl = trim($nodes->item(0)->value);
                if (!empty($featuredImageUrl)) {
                    $featuredImageUrl = $this->makeAbsoluteUrl($featuredImageUrl);
                }
                break;
            }
        }

        // Extract published date
        $publishedAt = null;
        $dateSelectors = [
            '//time[@datetime]/@datetime',
            '//meta[@property="article:published_time"]/@content',
            '//span[contains(@class, "published")]',
        ];
        foreach ($dateSelectors as $selector) {
            $nodes = $xpath->query($selector);
            if ($nodes && $nodes->length > 0) {
                $dateValue = trim($nodes->item(0)->nodeValue ?? $nodes->item(0)->value ?? '');
                if (!empty($dateValue)) {
                    try {
                        $publishedAt = \Carbon\Carbon::parse($dateValue);
                        break;
                    } catch (\Exception $e) {
                        // Continue to next selector
                    }
                }
            }
        }

        // Generate slug from title or URL
        $slug = Str::slug($title);
        if (empty($slug)) {
            $slug = Str::slug(basename(parse_url($url, PHP_URL_PATH)));
        }
        // Ensure unique slug
        $originalSlug = $slug;
        $counter = 1;
        while (BlogPost::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        // Process content: download images and update URLs
        if (!empty($content)) {
            $content = $this->processContentImages($content, $slug);
        }

        return [
            'title' => $title,
            'slug' => $slug,
            'excerpt' => $excerpt,
            'content' => $content,
            'featured_image_url' => $featuredImageUrl,
            'published_at' => $publishedAt,
        ];
    }

    protected function makeAbsoluteUrl(string $url): string
    {
        if (strpos($url, 'http') === 0) {
            return $url;
        }
        if (strpos($url, '/') === 0) {
            return $this->baseUrl . $url;
        }
        return $this->baseUrl . '/' . ltrim($url, '/');
    }

    protected function downloadImage(string $url, string $slug): ?string
    {
        try {
            $imageData = null;
            
            // Try HTTP client first
            try {
                $response = Http::timeout(60)
                    ->retry(2, 1000)
                    ->withoutVerifying() // Disable SSL verification for development
                    ->withHeaders([
                        'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                    ])
                    ->get($url);

                if ($response->successful()) {
                    $imageData = $response->body();
                    $contentType = $response->header('Content-Type');
                }
            } catch (\Exception $e) {
                // Fallback to file_get_contents
            }
            
            // Fallback to file_get_contents if HTTP client fails
            if (empty($imageData)) {
                $context = stream_context_create([
                    'http' => [
                        'method' => 'GET',
                        'header' => 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                        'timeout' => 60,
                        'ignore_errors' => true,
                    ],
                    'ssl' => [
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                    ],
                ]);
                
                $imageData = @file_get_contents($url, false, $context);
                $contentType = null;
            }
            
            if (empty($imageData)) {
                return null;
            }

            // Get file extension from URL or content type
            $extension = $this->getImageExtension($url, $contentType);
            $filename = $slug . '-' . time() . '.' . $extension;
            $path = 'blog/' . $filename;

            Storage::disk('public')->put($path, $imageData);

            return $path;
        } catch (\Exception $e) {
            $this->command->warn("Failed to download image from {$url}: " . $e->getMessage());
            return null;
        }
    }

    protected function getImageExtension(string $url, ?string $contentType): string
    {
        // Try to get extension from URL
        $path = parse_url($url, PHP_URL_PATH);
        if ($path) {
            $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
            if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                return $ext === 'jpeg' ? 'jpg' : $ext;
            }
        }

        // Try to get from content type
        if ($contentType) {
            if (strpos($contentType, 'jpeg') !== false) return 'jpg';
            if (strpos($contentType, 'jpg') !== false) return 'jpg';
            if (strpos($contentType, 'png') !== false) return 'png';
            if (strpos($contentType, 'gif') !== false) return 'gif';
            if (strpos($contentType, 'webp') !== false) return 'webp';
        }

        return 'jpg'; // Default
    }

    protected function processContentImages(string $content, string $slug): string
    {
        libxml_use_internal_errors(true);
        $dom = new DOMDocument();
        @$dom->loadHTML('<?xml encoding="UTF-8">' . $content);
        libxml_clear_errors();

        $xpath = new DOMXPath($dom);
        $images = $xpath->query('//img[@src]');

        if ($images) {
            foreach ($images as $img) {
                $src = $img->getAttribute('src');
                if (!empty($src) && strpos($src, 'http') !== false) {
                    // Download and replace
                    $localPath = $this->downloadImage($src, $slug . '-' . uniqid());
                    if ($localPath) {
                        $img->setAttribute('src', asset('storage/' . $localPath));
                    }
                } elseif (!empty($src) && strpos($src, '/') === 0) {
                    // Relative URL, make absolute first
                    $absoluteUrl = $this->makeAbsoluteUrl($src);
                    $localPath = $this->downloadImage($absoluteUrl, $slug . '-' . uniqid());
                    if ($localPath) {
                        $img->setAttribute('src', asset('storage/' . $localPath));
                    }
                }
            }

            // Get updated HTML
            $body = $dom->getElementsByTagName('body')->item(0);
            if ($body) {
                $content = '';
                foreach ($body->childNodes as $child) {
                    $content .= $dom->saveHTML($child);
                }
            }
        }

        return $content;
    }
}
