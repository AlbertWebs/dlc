<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\BlogPost;
use DOMDocument;
use DOMXPath;

class ImportDlcBlogs extends Command
{
    protected $signature = 'blogs:import-dlc {--force : Force re-import even if blog already exists} {--url= : Import a specific blog post URL}';
    protected $description = 'Import all blog posts from dlc.co.ke/blog-2/ or import a specific blog URL';

    protected $baseUrl = 'https://dlc.co.ke';
    protected $blogListUrl = 'https://dlc.co.ke/blog-2/';
    protected $importedCount = 0;
    protected $skippedCount = 0;
    protected $errorCount = 0;

    public function handle()
    {
        // If a specific URL is provided, import just that one
        if ($url = $this->option('url')) {
            $this->info('Importing single blog post from: ' . $url);
            $this->newLine();
            
            Storage::disk('public')->makeDirectory('blog');
            
            try {
                $this->importBlogPost($url);
                $this->info("Successfully imported blog post!");
                return Command::SUCCESS;
            } catch (\Exception $e) {
                $this->error('Error importing blog post: ' . $e->getMessage());
                return Command::FAILURE;
            }
        }

        $this->info('Starting blog import from ' . $this->blogListUrl);
        $this->newLine();

        // Ensure blog images directory exists
        Storage::disk('public')->makeDirectory('blog');

        try {
            // Fetch the blog listing page
            $this->info('Fetching blog listing page...');
            $this->info('This may take a while if the site is slow...');
            
            $html = null;
            
            // Try HTTP client first
            try {
                $response = Http::timeout(120)
                    ->retry(3, 5000)
                    ->withHeaders([
                        'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
                        'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
                        'Accept-Language' => 'en-US,en;q=0.9',
                    ])
                    ->get($this->blogListUrl);

                if ($response->successful()) {
                    $html = $response->body();
                }
            } catch (\Exception $e) {
                $this->warn('HTTP client failed: ' . $e->getMessage());
            }
            
            // Fallback to file_get_contents if HTTP client fails
            if (empty($html)) {
                $this->info('Trying alternative method...');
                try {
                    $context = stream_context_create([
                        'http' => [
                            'method' => 'GET',
                            'header' => [
                                'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                                'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                            ],
                            'timeout' => 120,
                        ],
                    ]);
                    
                    $html = @file_get_contents($this->blogListUrl, false, $context);
                } catch (\Exception $e) {
                    $this->error('Alternative method also failed: ' . $e->getMessage());
                }
            }
            
            if (empty($html)) {
                $this->error('Failed to fetch blog listing page. The website may be down or blocking requests.');
                $this->newLine();
                $this->warn('Alternative options:');
                $this->line('1. Try again later when the website is more responsive');
                $this->line('2. Import individual blog posts using: php artisan blogs:import-dlc --url="https://dlc.co.ke/blog-2/specific-post/"');
                $this->line('3. Check your internet connection and firewall settings');
                return Command::FAILURE;
            }
            $blogLinks = $this->extractBlogLinks($html);

            if (empty($blogLinks)) {
                $this->warn('No blog links found on the listing page.');
                return Command::FAILURE;
            }

            $this->info('Found ' . count($blogLinks) . ' blog posts to import.');
            $this->newLine();

            $bar = $this->output->createProgressBar(count($blogLinks));
            $bar->start();

            foreach ($blogLinks as $blogUrl) {
                try {
                    $this->importBlogPost($blogUrl);
                    $this->importedCount++;
                } catch (\Exception $e) {
                    $this->errorCount++;
                    $this->newLine();
                    $this->error("Error importing {$blogUrl}: " . $e->getMessage());
                }
                $bar->advance();
            }

            $bar->finish();
            $this->newLine(2);

            $this->info("Import completed!");
            $this->info("  - Imported: {$this->importedCount}");
            $this->info("  - Skipped: {$this->skippedCount}");
            $this->info("  - Errors: {$this->errorCount}");

            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->error('Fatal error: ' . $e->getMessage());
            return Command::FAILURE;
        }
    }

    protected function extractBlogLinks(string $html): array
    {
        $links = [];
        
        // Create DOMDocument and load HTML
        libxml_use_internal_errors(true);
        $dom = new DOMDocument();
        @$dom->loadHTML('<?xml encoding="UTF-8">' . $html);
        libxml_clear_errors();

        $xpath = new DOMXPath($dom);

        // Try multiple selectors to find blog post links
        $selectors = [
            '//article//a[@href]',
            '//div[contains(@class, "post")]//a[@href]',
            '//div[contains(@class, "blog")]//a[@href]',
            '//a[contains(@href, "/blog/")]',
            '//a[contains(@href, "/blog-2/")]',
        ];

        foreach ($selectors as $selector) {
            $nodes = $xpath->query($selector);
            if ($nodes && $nodes->length > 0) {
                foreach ($nodes as $node) {
                    $href = $node->getAttribute('href');
                    if ($href && $this->isBlogPostUrl($href)) {
                        $fullUrl = $this->makeAbsoluteUrl($href);
                        if (!in_array($fullUrl, $links)) {
                            $links[] = $fullUrl;
                        }
                    }
                }
            }
        }

        // If no links found with selectors, try to find any links containing "blog" in the path
        if (empty($links)) {
            $allLinks = $xpath->query('//a[@href]');
            if ($allLinks) {
                foreach ($allLinks as $link) {
                    $href = $link->getAttribute('href');
                    if ($href && (strpos($href, '/blog/') !== false || strpos($href, '/blog-2/') !== false)) {
                        $fullUrl = $this->makeAbsoluteUrl($href);
                        if (!in_array($fullUrl, $links) && $this->isBlogPostUrl($fullUrl)) {
                            $links[] = $fullUrl;
                        }
                    }
                }
            }
        }

        return array_unique($links);
    }

    protected function isBlogPostUrl(string $url): bool
    {
        // Exclude listing pages, categories, tags, etc.
        $excludePatterns = [
            '/blog-2/$',
            '/blog-2/page/',
            '/category/',
            '/tag/',
            '/author/',
            '/feed/',
            '/rss/',
            '#',
            'javascript:',
        ];

        foreach ($excludePatterns as $pattern) {
            if (preg_match('#' . preg_quote($pattern, '#') . '#i', $url)) {
                return false;
            }
        }

        // Should be a specific post URL
        return preg_match('#/blog-2/[^/]+/?$#i', $url) || preg_match('#/blog/[^/]+/?$#i', $url);
    }

    protected function makeAbsoluteUrl(string $url): string
    {
        if (strpos($url, 'http') === 0) {
            return $url;
        }
        if (strpos($url, '/') === 0) {
            return $this->baseUrl . $url;
        }
        return $this->blogListUrl . ltrim($url, '/');
    }

    public function importBlogPost(string $url): void
    {
        // Check if blog already exists
        $existing = BlogPost::where('source_url', $url)->first();
        if ($existing && !$this->option('force')) {
            $this->skippedCount++;
            return;
        }

        // Fetch the blog post page
        $response = Http::timeout(120)
            ->retry(3, 3000)
            ->withHeaders([
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
                'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
                'Accept-Language' => 'en-US,en;q=0.9',
            ])
            ->get($url);
        if (!$response->successful()) {
            throw new \Exception("Failed to fetch blog post. Status: " . $response->status());
        }

        $html = $response->body();
        $data = $this->parseBlogPost($html, $url);

        if (empty($data['title'])) {
            throw new \Exception("Could not extract title from blog post");
        }

        // Download and save featured image
        if (!empty($data['featured_image_url'])) {
            $data['featured_image'] = $this->downloadImage($data['featured_image_url'], $data['slug']);
        }

        // Create or update blog post
        BlogPost::updateOrCreate(
            ['source_url' => $url],
            [
                'title' => $data['title'],
                'slug' => $data['slug'],
                'excerpt' => $data['excerpt'],
                'content' => $data['content'],
                'featured_image' => $data['featured_image'],
                'published_at' => $data['published_at'],
                'is_published' => true,
            ]
        );
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
        while (BlogPost::where('slug', $slug)->where('source_url', '!=', $url)->exists()) {
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

    protected function downloadImage(string $url, string $slug): ?string
    {
        try {
            $response = Http::timeout(60)
                ->retry(2, 1000)
                ->withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                ])
                ->get($url);
            if (!$response->successful()) {
                return null;
            }

            // Get file extension from URL or content type
            $extension = $this->getImageExtension($url, $response->header('Content-Type'));
            $filename = $slug . '-' . time() . '.' . $extension;
            $path = 'blog/' . $filename;

            Storage::disk('public')->put($path, $response->body());

            return $path;
        } catch (\Exception $e) {
            $this->warn("Failed to download image from {$url}: " . $e->getMessage());
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
