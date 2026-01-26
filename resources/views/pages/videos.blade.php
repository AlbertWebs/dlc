@extends('layouts.app')

@php
    use Illuminate\Support\Str;
    $pageTitle = 'Videos – ' . config('app.name');
    $pageDescription = 'Watch our collection of coaching videos, training sessions, testimonials, and more.';
    $pageImage = asset('images/og-image.jpg');
    $pageType = 'website';
@endphp

@section('content')
    <!-- Breadcrumb -->
    <x-breadcrumb :items="[
        ['label' => 'Home', 'url' => route('home')],
        ['label' => 'Videos', 'url' => route('videos.index')]
    ]" />

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-primary-900 via-primary-800 to-primary-900 text-white py-16 lg:py-24">
        <div class="container text-center">
            <h1 class="text-4xl lg:text-5xl xl:text-6xl font-bold mb-4 animate-fade-in">Our Video Library</h1>
            <p class="text-xl lg:text-2xl text-primary-100 max-w-3xl mx-auto animate-fade-in-delay">
                Explore our collection of coaching videos, training sessions, testimonials, and educational content
            </p>
        </div>
    </section>

    <!-- Featured Videos Section -->
    @if($featuredVideos->count() > 0)
    <section class="py-12 lg:py-16 bg-gradient-to-br from-accent-50 to-white">
        <div class="container">
            <div class="text-center mb-8">
                <span class="text-accent-600 font-semibold text-sm uppercase tracking-wider">Featured</span>
                <h2 class="text-3xl lg:text-4xl font-bold text-primary-900 mt-2">Featured Videos</h2>
            </div>
            <div class="grid md:grid-cols-3 gap-6 lg:gap-8">
                @foreach($featuredVideos as $video)
                    <div class="group bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                        <div class="relative aspect-video bg-gray-900 overflow-hidden">
                            <a href="{{ $video->youtube_url }}" target="_blank" rel="noopener noreferrer" class="block w-full h-full">
                                @if($video->thumbnail_url)
                                    <img src="{{ $video->thumbnail_url }}" alt="{{ $video->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-primary-800">
                                        <i class="fas fa-video text-white text-4xl"></i>
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-black/40 group-hover:bg-black/20 transition-colors duration-300 flex items-center justify-center">
                                    <div class="w-16 h-16 bg-red-600 rounded-full flex items-center justify-center transform group-hover:scale-110 transition-transform duration-300 shadow-2xl">
                                        <i class="fab fa-youtube text-white text-2xl"></i>
                                    </div>
                                </div>
                                <div class="absolute bottom-2 right-2 bg-black/80 text-white text-xs px-2 py-1 rounded">
                                    <i class="fas fa-play mr-1"></i> Watch
                                </div>
                            </a>
                        </div>
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-primary-900 mb-2 line-clamp-2 group-hover:text-primary-600 transition-colors">
                                <a href="{{ $video->youtube_url }}" target="_blank" rel="noopener noreferrer">{{ $video->title }}</a>
                            </h3>
                            @if($video->description)
                                <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ Str::limit($video->description, 100) }}</p>
                            @endif
                            @if($video->category)
                                <span class="inline-block px-3 py-1 bg-primary-100 text-primary-700 text-xs rounded-full font-medium">
                                    {{ $video->category }}
                                </span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- All Videos Section -->
    <section class="py-12 lg:py-16 bg-white">
        <div class="container">
            <!-- Category Filter -->
            @if($categories->count() > 0)
            <div class="mb-8">
                <div class="flex flex-wrap items-center gap-3 justify-center">
                    <a href="{{ route('videos.index') }}" 
                       class="px-4 py-2 rounded-lg font-medium transition-all duration-300 {{ !request('category') ? 'bg-primary-600 text-white shadow-md' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                        All Videos
                    </a>
                    @foreach($categories as $category)
                        <a href="{{ route('videos.index', ['category' => $category]) }}" 
                           class="px-4 py-2 rounded-lg font-medium transition-all duration-300 {{ request('category') === $category ? 'bg-primary-600 text-white shadow-md' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}">
                            {{ $category }}
                        </a>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Videos Grid -->
            @if($videos->count() > 0)
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 lg:gap-8 mb-12">
                    @foreach($videos as $video)
                        <div class="group bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                            <div class="relative aspect-video bg-gray-900 overflow-hidden">
                                <a href="{{ $video->youtube_url }}" target="_blank" rel="noopener noreferrer" class="block w-full h-full">
                                    @if($video->thumbnail_url)
                                        <img src="{{ $video->thumbnail_url }}" alt="{{ $video->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-primary-800">
                                            <i class="fas fa-video text-white text-4xl"></i>
                                        </div>
                                    @endif
                                    <div class="absolute inset-0 bg-black/40 group-hover:bg-black/20 transition-colors duration-300 flex items-center justify-center">
                                        <div class="w-14 h-14 bg-red-600 rounded-full flex items-center justify-center transform group-hover:scale-110 transition-transform duration-300 shadow-2xl">
                                            <i class="fab fa-youtube text-white text-xl"></i>
                                        </div>
                                    </div>
                                    <div class="absolute bottom-2 right-2 bg-black/80 text-white text-xs px-2 py-1 rounded">
                                        <i class="fas fa-play mr-1"></i> Watch
                                    </div>
                                </a>
                            </div>
                            <div class="p-5">
                                <h3 class="text-base font-bold text-primary-900 mb-2 line-clamp-2 group-hover:text-primary-600 transition-colors">
                                    <a href="{{ $video->youtube_url }}" target="_blank" rel="noopener noreferrer">{{ $video->title }}</a>
                                </h3>
                                @if($video->description)
                                    <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ Str::limit($video->description, 80) }}</p>
                                @endif
                                <div class="flex items-center justify-between">
                                    @if($video->category)
                                        <span class="inline-block px-2 py-1 bg-primary-100 text-primary-700 text-xs rounded-full font-medium">
                                            {{ $video->category }}
                                        </span>
                                    @endif
                                    @if($video->views > 0)
                                        <span class="text-xs text-gray-500 flex items-center gap-1">
                                            <i class="fas fa-eye"></i> {{ number_format($video->views) }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Elegant Pagination -->
                @if($videos->hasPages())
                <div class="flex items-center justify-center gap-2 mt-12 flex-wrap">
                    {{-- Previous Page Link --}}
                    @if($videos->onFirstPage())
                        <span class="px-4 py-2 rounded-lg bg-gray-100 text-gray-400 cursor-not-allowed">
                            <i class="fas fa-chevron-left"></i>
                        </span>
                    @else
                        <a href="{{ $videos->previousPageUrl() }}" class="px-4 py-2 rounded-lg bg-primary-600 text-white hover:bg-primary-700 transition-colors shadow-md hover:shadow-lg">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    @endif

                    {{-- Page Numbers with Smart Pagination --}}
                    @php
                        $currentPage = $videos->currentPage();
                        $lastPage = $videos->lastPage();
                        $startPage = max(1, $currentPage - 2);
                        $endPage = min($lastPage, $currentPage + 2);
                    @endphp

                    @if($startPage > 1)
                        <a href="{{ $videos->url(1) }}" class="px-4 py-2 rounded-lg bg-white text-primary-600 border-2 border-primary-200 hover:bg-primary-50 hover:border-primary-400 transition-all duration-300 font-medium">
                            1
                        </a>
                        @if($startPage > 2)
                            <span class="px-2 text-gray-400">...</span>
                        @endif
                    @endif

                    @for($page = $startPage; $page <= $endPage; $page++)
                        @if($page == $currentPage)
                            <span class="px-4 py-2 rounded-lg bg-primary-600 text-white font-semibold shadow-md">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $videos->url($page) }}" class="px-4 py-2 rounded-lg bg-white text-primary-600 border-2 border-primary-200 hover:bg-primary-50 hover:border-primary-400 transition-all duration-300 font-medium">
                                {{ $page }}
                            </a>
                        @endif
                    @endfor

                    @if($endPage < $lastPage)
                        @if($endPage < $lastPage - 1)
                            <span class="px-2 text-gray-400">...</span>
                        @endif
                        <a href="{{ $videos->url($lastPage) }}" class="px-4 py-2 rounded-lg bg-white text-primary-600 border-2 border-primary-200 hover:bg-primary-50 hover:border-primary-400 transition-all duration-300 font-medium">
                            {{ $lastPage }}
                        </a>
                    @endif

                    {{-- Next Page Link --}}
                    @if($videos->hasMorePages())
                        <a href="{{ $videos->nextPageUrl() }}" class="px-4 py-2 rounded-lg bg-primary-600 text-white hover:bg-primary-700 transition-colors shadow-md hover:shadow-lg">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    @else
                        <span class="px-4 py-2 rounded-lg bg-gray-100 text-gray-400 cursor-not-allowed">
                            <i class="fas fa-chevron-right"></i>
                        </span>
                    @endif
                </div>
                @endif
            @else
                <div class="text-center py-16">
                    <i class="fas fa-video text-6xl text-gray-300 mb-4"></i>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">No Videos Available</h3>
                    <p class="text-gray-600">Check back soon for new videos.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 lg:py-20 bg-gradient-to-r from-primary-900 to-primary-800 text-white">
        <div class="container text-center">
            <h2 class="text-3xl lg:text-4xl font-bold mb-4">Subscribe to Our Channel</h2>
            <p class="text-xl text-gray-200 mb-8 max-w-2xl mx-auto">
                Stay updated with our latest coaching videos, training sessions, and educational content.
            </p>
            <a href="https://www.youtube.com" target="_blank" rel="noopener noreferrer" class="btn btn-accent btn-large inline-flex items-center">
                <i class="fab fa-youtube mr-2 text-xl"></i> Subscribe on YouTube
            </a>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="relative py-20 lg:py-32 bg-gradient-to-br from-primary-50 via-white to-accent-50/20 overflow-hidden">
        <div class="absolute top-0 right-0 w-96 h-96 bg-accent-500/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-primary-500/5 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2"></div>
        
        <div class="container relative z-10 px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 animate-on-scroll">
                <span class="text-accent-600 font-semibold text-sm uppercase tracking-wider">Success Stories</span>
                <h2 class="text-3xl lg:text-4xl xl:text-5xl font-bold text-primary-900 mt-2 mb-4">
                    What Our Clients Say
                </h2>
                <div class="w-24 h-1 bg-gradient-to-r from-transparent via-accent-500 to-transparent mx-auto"></div>
            </div>
            
            @php
                $testimonials = \App\Models\Testimonial::where('is_published', true)
                    ->orderBy('order')
                    ->orderBy('created_at', 'desc')
                    ->limit(3)
                    ->get();
            @endphp
            
            @if($testimonials->count() > 0)
                <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                    @foreach($testimonials as $testimonial)
                        <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 animate-on-scroll">
                            <div class="text-accent-500 text-5xl mb-6 opacity-20">
                                <i class="fas fa-quote-left"></i>
                            </div>
                            <p class="text-gray-700 italic mb-6 leading-relaxed text-lg">
                                "{{ $testimonial->quote ?? $testimonial->content ?? '' }}"
                            </p>
                            <div class="flex items-center gap-4 pt-6 border-t border-gray-100">
                                @if($testimonial->image)
                                    <img src="{{ asset('storage/' . $testimonial->image) }}" 
                                         alt="{{ $testimonial->author_name }}" 
                                         class="w-14 h-14 rounded-full object-cover border-2 border-accent-500/30">
                                @else
                                    <div class="w-14 h-14 bg-gradient-to-br from-primary-600 to-primary-800 rounded-full flex items-center justify-center border-2 border-accent-500/30">
                                        <i class="fas fa-user text-white text-lg"></i>
                                    </div>
                                @endif
                                <div>
                                    <div class="font-bold text-primary-900 text-lg">{{ $testimonial->author_name }}</div>
                                    @if($testimonial->author_title)
                                        <div class="text-sm text-gray-600">{{ $testimonial->author_title }}</div>
                                    @endif
                                    @if($testimonial->rating)
                                        <div class="flex gap-1 mt-1">
                                            @for($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $testimonial->rating ? 'text-accent-500' : 'text-gray-300' }} text-xs"></i>
                                            @endfor
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Fallback Testimonials -->
                <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                    @for($i = 0; $i < 3; $i++)
                        <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 animate-on-scroll">
                            <div class="text-accent-500 text-5xl mb-6 opacity-20">
                                <i class="fas fa-quote-left"></i>
                            </div>
                            <p class="text-gray-700 italic mb-6 leading-relaxed text-lg">
                                "The coaching program transformed my career. I gained clarity on my goals and the confidence to pursue them. Highly recommended!"
                            </p>
                            <div class="flex items-center gap-4 pt-6 border-t border-gray-100">
                                <div class="w-14 h-14 bg-gradient-to-br from-primary-600 to-primary-800 rounded-full flex items-center justify-center border-2 border-accent-500/30">
                                    <i class="fas fa-user text-white text-lg"></i>
                                </div>
                                <div>
                                    <div class="font-bold text-primary-900 text-lg">Sarah Johnson</div>
                                    <div class="text-sm text-gray-600">Marketing Director</div>
                                    <div class="flex gap-1 mt-1">
                                        @for($j = 1; $j <= 5; $j++)
                                            <i class="fas fa-star text-accent-500 text-xs"></i>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            @endif
        </div>
    </section>

 
@endsection

@push('styles')
<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endpush

@push('scripts')
<script>
    // Scroll animations
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

    document.querySelectorAll('.animate-on-scroll').forEach(el => {
        observer.observe(el);
    });
</script>
@endpush
