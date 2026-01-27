@extends('layouts.app')

@php
    $pageTitle = $post->title . ' – ' . config('app.name');
    $pageDescription = $post->excerpt ?? Str::limit(strip_tags($post->content ?? ''), 160);
    $pageImage = $post->featured_image ? (str_starts_with($post->featured_image, 'http') ? $post->featured_image : asset('storage/' . $post->featured_image)) : asset('images/og-image.jpg');
    $pageType = 'article';
    $pagePublishedTime = $post->published_at ? $post->published_at->toIso8601String() : $post->created_at->toIso8601String();
    $pageModifiedTime = $post->updated_at->toIso8601String();
    $pageKeywords = 'life coaching, ' . Str::limit(strip_tags($post->content ?? ''), 50);
@endphp

@push('schema')
@php
    $articleSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'BlogPosting',
        'headline' => $post->title,
        'description' => $pageDescription,
        'image' => $pageImage,
        'datePublished' => $pagePublishedTime,
        'dateModified' => $pageModifiedTime,
        'author' => [
            '@type' => 'Organization',
            'name' => 'Destiny Life Coaching Kenya',
            'url' => config('app.url')
        ],
        'publisher' => [
            '@type' => 'Organization',
            'name' => 'Destiny Life Coaching Kenya',
            'url' => config('app.url'),
            'logo' => [
                '@type' => 'ImageObject',
                'url' => asset('images/logo.png')
            ]
        ],
        'mainEntityOfPage' => [
            '@type' => 'WebPage',
            '@id' => url()->current()
        ],
        'url' => url()->current(),
        'inLanguage' => 'en-KE'
    ];
    
    if ($post->source_url) {
        $articleSchema['citation'] = $post->source_url;
    }
@endphp
<script type="application/ld+json">
@verbatim
{!! json_encode($articleSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
@endverbatim
</script>
@endpush

@section('content')
    <!-- Breadcrumb -->
    <x-breadcrumb :items="[
        ['label' => 'Home', 'url' => route('home')],
        ['label' => 'Blog', 'url' => route('blog.index')],
        ['label' => $post->title, 'url' => route('blog.show', $post->slug)]
    ]" />

    <!-- Featured Image -->
    @if($post->featured_image)
    <section class="relative h-64 md:h-96 lg:h-[500px] overflow-hidden">
        <img src="{{ asset('storage/' . $post->featured_image) }}" 
             alt="{{ $post->title }}" 
             class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent"></div>
    </section>
    @endif

    <!-- Blog Post Content -->
    <article class="py-12 lg:py-16 bg-white">
        <div class="container max-w-4xl">
            <!-- Post Header -->
            <header class="mb-8">
                <h1 class="text-4xl lg:text-5xl font-bold text-primary-900 mb-4 leading-tight">
                    {{ $post->title }}
                </h1>
                
                <div class="flex items-center gap-4 text-gray-600 mb-6">
                    @if($post->published_at)
                        <div class="flex items-center gap-2">
                            <i class="fas fa-calendar-alt"></i>
                            <span>{{ $post->published_at->format('F d, Y') }}</span>
                        </div>
                    @endif
                    <div class="flex items-center gap-2">
                        <i class="fas fa-clock"></i>
                        <span>{{ $post->published_at ? $post->published_at->diffForHumans() : 'Recently' }}</span>
                    </div>
                </div>
            </header>

            <!-- Post Content -->
            <div class="prose prose-lg prose-primary max-w-none">
                {!! $post->content !!}
            </div>

            <!-- Post Footer -->
            <footer class="mt-12 pt-8 border-t border-gray-200">
                <div class="flex flex-wrap items-center gap-4">
                    <a href="{{ route('blog.index') }}" 
                       class="inline-flex items-center gap-2 text-primary-600 font-semibold hover:text-primary-700 transition-colors">
                        <i class="fas fa-arrow-left"></i>
                        <span>Back to Blog</span>
                    </a>
                    @if($post->source_url)
                        <a href="{{ $post->source_url }}" 
                           target="_blank" 
                           rel="noopener noreferrer"
                           class="inline-flex items-center gap-2 text-gray-600 hover:text-primary-600 transition-colors">
                            <i class="fas fa-external-link-alt"></i>
                            <span>View Original</span>
                        </a>
                    @endif
                </div>
            </footer>
        </div>
    </article>

    <!-- Related Posts -->
    @if($relatedPosts->count() > 0)
    <section class="py-12 lg:py-16 bg-gray-50">
        <div class="container">
            <h2 class="text-3xl lg:text-4xl font-bold text-primary-900 mb-8 text-center">Related Posts</h2>
            <div class="grid md:grid-cols-3 gap-8">
                @foreach($relatedPosts as $relatedPost)
                    <article class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                        @if($relatedPost->featured_image)
                            <a href="{{ route('blog.show', $relatedPost->slug) }}" class="block relative aspect-video bg-gray-900 overflow-hidden">
                                <img src="{{ asset('storage/' . $relatedPost->featured_image) }}" 
                                     alt="{{ $relatedPost->title }}" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            </a>
                        @endif
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-primary-900 mb-3 line-clamp-2">
                                <a href="{{ route('blog.show', $relatedPost->slug) }}" class="hover:text-primary-600 transition-colors">
                                    {{ $relatedPost->title }}
                                </a>
                            </h3>
                            @if($relatedPost->excerpt)
                                <p class="text-gray-600 mb-4 line-clamp-2">
                                    {{ $relatedPost->excerpt }}
                                </p>
                            @endif
                            <a href="{{ route('blog.show', $relatedPost->slug) }}" 
                               class="inline-flex items-center gap-2 text-primary-600 font-semibold hover:text-primary-700 transition-colors">
                                <span>Read More</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Google Reviews Section -->
    <x-google-reviews-section />
@endsection

@push('styles')
<style>
    .prose {
        color: #374151;
    }
    .prose h2 {
        color: #1e3a5f;
        font-weight: 700;
        margin-top: 2em;
        margin-bottom: 1em;
    }
    .prose h3 {
        color: #1e3a5f;
        font-weight: 600;
        margin-top: 1.5em;
        margin-bottom: 0.75em;
    }
    .prose img {
        border-radius: 0.5rem;
        margin: 1.5em 0;
    }
    .prose a {
        color: #1e3a5f;
        text-decoration: underline;
    }
    .prose a:hover {
        color: #f8b016;
    }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endpush
