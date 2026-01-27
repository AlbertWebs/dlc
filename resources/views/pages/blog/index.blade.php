@extends('layouts.app')

@php
    $pageTitle = 'Blog – Life Coaching Articles & Insights | DLC Kenya';
    $pageDescription = 'Read our latest blog posts on coaching, personal development, and life transformation. Expert insights, tips, and success stories from Kenya\'s leading life coaching school.';
    $pageKeywords = 'life coaching blog, coaching articles, personal development blog, coaching tips, life transformation, coaching insights Kenya, coaching advice';
    $pageImage = asset('images/og-image.jpg');
    $pageType = 'website';
@endphp

@push('schema')
@php
    $blogPageSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'Blog',
        'name' => 'Destiny Life Coaching Blog',
        'description' => $pageDescription,
        'url' => url('/blog'),
        'inLanguage' => 'en-KE',
        'publisher' => [
            '@type' => 'Organization',
            'name' => 'Destiny Life Coaching Kenya',
            'url' => config('app.url')
        ]
    ];
@endphp
<script type="application/ld+json">
@verbatim
{!! json_encode($blogPageSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
@endverbatim
</script>
@endpush

@section('content')
    <!-- Breadcrumb -->
    <x-breadcrumb :items="[
        ['label' => 'Home', 'url' => route('home')],
        ['label' => 'Blog', 'url' => route('blog.index')]
    ]" />

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-primary-900 via-primary-800 to-primary-900 text-white py-16 lg:py-24 relative overflow-hidden">
        <!-- Decorative Background -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 right-0 w-96 h-96 bg-accent-500 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-accent-400 rounded-full blur-3xl"></div>
        </div>
        
        <div class="container text-center relative z-10">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full mb-6 border border-white/20">
                <i class="fas fa-newspaper text-accent-400"></i>
                <span class="text-sm font-semibold text-accent-300">Latest Articles</span>
            </div>
            <h1 class="text-4xl lg:text-5xl xl:text-6xl font-bold mb-4 animate-fade-in">Our Blog</h1>
            <p class="text-xl lg:text-2xl text-primary-100 max-w-3xl mx-auto animate-fade-in-delay">
                Insights, tips, and stories on coaching, personal development, and life transformation
            </p>
        </div>
    </section>

    <!-- Blog Posts Grid -->
    <section class="py-16 lg:py-24 bg-gradient-to-br from-gray-50 via-white to-gray-50">
        <div class="container">
            <!-- Enhanced Search Bar -->
            <div class="mb-12 max-w-3xl mx-auto">
                <form action="{{ route('blog.index') }}" method="GET" class="relative group">
                    <div class="relative">
                        <!-- Search Icon -->
                        <div class="absolute left-6 top-1/2 -translate-y-1/2 z-10">
                            <i class="fas fa-search text-gray-400 text-xl group-focus-within:text-primary-600 transition-colors"></i>
                        </div>
                        
                        <!-- Search Input -->
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}"
                               placeholder="Search articles, topics, or keywords..." 
                               class="w-full pl-16 pr-24 py-5 bg-white border-2 border-gray-200 rounded-2xl focus:border-primary-500 focus:ring-4 focus:ring-primary-200 text-lg shadow-lg hover:shadow-xl transition-all duration-300 placeholder:text-gray-400">
                        
                        <!-- Action Buttons -->
                        <div class="absolute right-2 top-1/2 -translate-y-1/2 flex items-center gap-2">
                            @if(request('search'))
                                <a href="{{ route('blog.index') }}" 
                                   class="w-10 h-10 flex items-center justify-center text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-all duration-200"
                                   title="Clear search">
                                    <i class="fas fa-times"></i>
                                </a>
                            @endif
                            <button type="submit" 
                                    class="px-6 py-2.5 bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-xl hover:from-primary-700 hover:to-primary-800 transition-all duration-300 shadow-md hover:shadow-lg font-semibold flex items-center gap-2 group/btn">
                                <span>Search</span>
                                <i class="fas fa-arrow-right group-hover/btn:translate-x-1 transition-transform"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Search Results Count -->
                    @if(request('search'))
                        <div class="mt-4 text-center">
                            <p class="text-gray-600">
                                <span class="font-semibold text-primary-700">{{ $posts->total() }}</span>
                                {{ Str::plural('result', $posts->total()) }} found for 
                                <span class="font-semibold text-gray-900">"{{ request('search') }}"</span>
                            </p>
                        </div>
                    @endif
                </form>
            </div>

            @if($posts->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                    @foreach($posts as $post)
                        <article class="group bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
                            @if($post->featured_image)
                                <a href="{{ route('blog.show', $post->slug) }}" class="block relative aspect-video bg-gray-900 overflow-hidden">
                                    @php
                                        $imageUrl = str_starts_with($post->featured_image, 'http') 
                                            ? $post->featured_image 
                                            : asset('storage/' . $post->featured_image);
                                    @endphp
                                    <img src="{{ $imageUrl }}" 
                                         alt="{{ $post->title }}" 
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                         onerror="this.onerror=null; this.src=''; this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                    <div class="w-full h-full bg-gradient-to-br from-primary-600 to-primary-800 flex items-center justify-center hidden">
                                        <i class="fas fa-newspaper text-white text-5xl opacity-50"></i>
                                    </div>
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                                    
                                    <!-- Published Badge -->
                                    @if($post->published_at)
                                        <div class="absolute top-4 left-4 px-3 py-1.5 bg-white/90 backdrop-blur-sm rounded-lg text-xs font-semibold text-gray-700">
                                            <i class="fas fa-calendar-alt mr-1.5 text-primary-600"></i>
                                            {{ $post->published_at->format('M d, Y') }}
                                        </div>
                                    @endif
                                </a>
                            @else
                                <a href="{{ route('blog.show', $post->slug) }}" class="block relative aspect-video bg-gradient-to-br from-primary-600 to-primary-800 flex items-center justify-center">
                                    <i class="fas fa-newspaper text-white text-5xl opacity-50"></i>
                                    @if($post->published_at)
                                        <div class="absolute top-4 left-4 px-3 py-1.5 bg-white/90 backdrop-blur-sm rounded-lg text-xs font-semibold text-gray-700">
                                            <i class="fas fa-calendar-alt mr-1.5 text-primary-600"></i>
                                            {{ $post->published_at->format('M d, Y') }}
                                        </div>
                                    @endif
                                </a>
                            @endif
                            
                            <div class="p-6">
                                <h2 class="text-2xl font-bold text-primary-900 mb-3 group-hover:text-primary-600 transition-colors line-clamp-2 min-h-[3.5rem]">
                                    <a href="{{ route('blog.show', $post->slug) }}" class="hover:underline">{{ $post->title }}</a>
                                </h2>
                                
                                @if($post->excerpt)
                                    <p class="text-gray-600 mb-4 line-clamp-3 leading-relaxed min-h-[4.5rem]">
                                        {{ strip_tags($post->excerpt) }}
                                    </p>
                                @elseif($post->content)
                                    <p class="text-gray-600 mb-4 line-clamp-3 leading-relaxed min-h-[4.5rem]">
                                        {{ Str::limit(strip_tags($post->content), 150) }}
                                    </p>
                                @endif
                                
                                <a href="{{ route('blog.show', $post->slug) }}" 
                                   class="inline-flex items-center gap-2 text-primary-600 font-semibold hover:text-primary-700 transition-colors group/read">
                                    <span>Read Article</span>
                                    <i class="fas fa-arrow-right transform group-hover/read:translate-x-1 transition-transform"></i>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>

                <!-- Enhanced Pagination -->
                @if($posts->hasPages())
                    <div class="flex items-center justify-center gap-2 mt-12 flex-wrap">
                        {{-- Previous Page Link --}}
                        @if($posts->onFirstPage())
                            <span class="px-4 py-2.5 rounded-xl bg-gray-100 text-gray-400 cursor-not-allowed shadow-sm">
                                <i class="fas fa-chevron-left"></i>
                            </span>
                        @else
                            <a href="{{ $posts->previousPageUrl() }}" class="px-4 py-2.5 rounded-xl bg-gradient-to-r from-primary-600 to-primary-700 text-white hover:from-primary-700 hover:to-primary-800 transition-all shadow-md hover:shadow-lg font-medium">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                        @endif

                        {{-- Page Numbers --}}
                        @php
                            $currentPage = $posts->currentPage();
                            $lastPage = $posts->lastPage();
                            $startPage = max(1, $currentPage - 2);
                            $endPage = min($lastPage, $currentPage + 2);
                        @endphp

                        @if($startPage > 1)
                            <a href="{{ $posts->url(1) }}" class="px-4 py-2.5 rounded-xl bg-white text-primary-600 border-2 border-primary-200 hover:bg-primary-50 hover:border-primary-400 transition-all duration-300 font-medium shadow-sm hover:shadow-md">
                                1
                            </a>
                            @if($startPage > 2)
                                <span class="px-2 text-gray-400">...</span>
                            @endif
                        @endif

                        @for($page = $startPage; $page <= $endPage; $page++)
                            @if($page == $currentPage)
                                <span class="px-4 py-2.5 rounded-xl bg-gradient-to-r from-primary-600 to-primary-700 text-white font-semibold shadow-md">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $posts->url($page) }}" class="px-4 py-2.5 rounded-xl bg-white text-primary-600 border-2 border-primary-200 hover:bg-primary-50 hover:border-primary-400 transition-all duration-300 font-medium shadow-sm hover:shadow-md">
                                    {{ $page }}
                                </a>
                            @endif
                        @endfor

                        @if($endPage < $lastPage)
                            @if($endPage < $lastPage - 1)
                                <span class="px-2 text-gray-400">...</span>
                            @endif
                            <a href="{{ $posts->url($lastPage) }}" class="px-4 py-2.5 rounded-xl bg-white text-primary-600 border-2 border-primary-200 hover:bg-primary-50 hover:border-primary-400 transition-all duration-300 font-medium shadow-sm hover:shadow-md">
                                {{ $lastPage }}
                            </a>
                        @endif

                        {{-- Next Page Link --}}
                        @if($posts->hasMorePages())
                            <a href="{{ $posts->nextPageUrl() }}" class="px-4 py-2.5 rounded-xl bg-gradient-to-r from-primary-600 to-primary-700 text-white hover:from-primary-700 hover:to-primary-800 transition-all shadow-md hover:shadow-lg font-medium">
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        @else
                            <span class="px-4 py-2.5 rounded-xl bg-gray-100 text-gray-400 cursor-not-allowed shadow-sm">
                                <i class="fas fa-chevron-right"></i>
                            </span>
                        @endif
                    </div>
                @endif
            @else
                <!-- Enhanced Empty State -->
                <div class="text-center py-20">
                    <div class="max-w-md mx-auto">
                        <div class="w-32 h-32 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-search text-5xl text-gray-400"></i>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-800 mb-3">No Blog Posts Found</h3>
                        <p class="text-gray-600 mb-8 text-lg">
                            @if(request('search'))
                                We couldn't find any articles matching <span class="font-semibold text-gray-900">"{{ request('search') }}"</span>.
                                <br>Try different keywords or browse all articles.
                            @else
                                No blog posts available yet. Check back soon for new content!
                            @endif
                        </p>
                        @if(request('search'))
                            <div class="flex items-center justify-center gap-4 flex-wrap">
                                <a href="{{ route('blog.index') }}" 
                                   class="px-6 py-3 bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-xl hover:from-primary-700 hover:to-primary-800 transition-all shadow-md hover:shadow-lg font-semibold">
                                    <i class="fas fa-arrow-left mr-2"></i> View All Posts
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Google Reviews Section -->
    <x-google-reviews-section />
@endsection

@push('styles')
<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    /* Smooth focus transitions */
    input:focus {
        outline: none;
    }
    
    /* Search input animation */
    @keyframes searchPulse {
        0%, 100% {
            box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.4);
        }
        50% {
            box-shadow: 0 0 0 8px rgba(59, 130, 246, 0);
        }
    }
    
    input:focus {
        animation: searchPulse 2s infinite;
    }
</style>
@endpush
