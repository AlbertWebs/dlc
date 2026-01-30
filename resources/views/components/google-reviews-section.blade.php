@php
    // Show up to 100 Google reviews in random order
    $testimonials = \App\Models\Testimonial::where('is_active', true)
        ->where('is_from_google', true)
        ->inRandomOrder()
        ->limit(100)
        ->get();
@endphp

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
        
        @if($testimonials->count() > 0)
            <!-- Reviews Carousel Container -->
            <div class="reviews-carousel-wrapper relative max-w-7xl mx-auto">
                <!-- Carousel Track -->
                <div class="reviews-carousel-track overflow-hidden" id="reviewsCarousel">
                    <div class="reviews-carousel-inner flex gap-8">
                        <!-- First set of reviews -->
                        @foreach($testimonials as $testimonial)
                            <div class="reviews-carousel-item flex-shrink-0 w-full md:w-1/2 lg:w-1/3 px-2">
                                <div class="bg-white rounded-2xl shadow-xl p-8 border-l-4 border-l-blue-500 bg-gradient-to-r from-blue-50/30 to-white hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 h-full">
                                    <div class="text-accent-500 text-5xl mb-6 opacity-20">
                                        <i class="fas fa-quote-left"></i>
                                    </div>
                                    <p class="text-gray-700 italic mb-6 leading-relaxed text-lg line-clamp-4">
                                        "{{ $testimonial->content }}"
                                    </p>
                                    <div class="flex items-center gap-4 pt-6 border-t border-gray-100">
                                        @if($testimonial->photo)
                                            <img src="{{ $testimonial->is_from_google ? $testimonial->photo : asset('storage/' . $testimonial->photo) }}" 
                                                 alt="{{ $testimonial->name }}" 
                                                 class="w-14 h-14 rounded-full object-cover border-2 border-accent-500/30 flex-shrink-0">
                                        @else
                                            <div class="w-14 h-14 bg-gradient-to-br from-primary-600 to-primary-800 rounded-full flex items-center justify-center border-2 border-accent-500/30 flex-shrink-0">
                                                <i class="fas fa-user text-white text-lg"></i>
                                            </div>
                                        @endif
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center gap-2 flex-wrap">
                                                <span class="font-bold text-primary-900 text-lg">{{ $testimonial->name }}</span>
                                                @if($testimonial->is_from_google)
                                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-gradient-to-r from-blue-50 to-blue-100 text-blue-700 text-xs rounded-full font-bold shadow-sm border border-blue-200 hover:shadow-md transition-all duration-200 flex-shrink-0">
                                                        <i class="fab fa-google text-blue-600"></i>
                                                        <span>Google Review</span>
                                                    </span>
                                                @endif
                                            </div>
                                            @if($testimonial->rating)
                                                <div class="flex items-center gap-1 mt-2">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <i class="fas fa-star {{ $i <= $testimonial->rating ? 'text-yellow-400' : 'text-gray-300' }} text-xs"></i>
                                                    @endfor
                                                    <span class="text-xs text-gray-500 ml-1">({{ $testimonial->rating }}/5)</span>
                                                </div>
                                            @endif
                                            @if($testimonial->role)
                                                <div class="text-sm text-gray-600 mt-1">{{ $testimonial->role }}{{ $testimonial->company ? ' at ' . $testimonial->company : '' }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <!-- Duplicate all items for seamless infinite loop -->
                        @foreach($testimonials as $testimonial)
                            <div class="reviews-carousel-item flex-shrink-0 w-full md:w-1/2 lg:w-1/3 px-2">
                                <div class="bg-white rounded-2xl shadow-xl p-8 border-l-4 border-l-blue-500 bg-gradient-to-r from-blue-50/30 to-white hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 h-full">
                                    <div class="text-accent-500 text-5xl mb-6 opacity-20">
                                        <i class="fas fa-quote-left"></i>
                                    </div>
                                    <p class="text-gray-700 italic mb-6 leading-relaxed text-lg line-clamp-4">
                                        "{{ $testimonial->content }}"
                                    </p>
                                    <div class="flex items-center gap-4 pt-6 border-t border-gray-100">
                                        @if($testimonial->photo)
                                            <img src="{{ $testimonial->is_from_google ? $testimonial->photo : asset('storage/' . $testimonial->photo) }}" 
                                                 alt="{{ $testimonial->name }}" 
                                                 class="w-14 h-14 rounded-full object-cover border-2 border-accent-500/30 flex-shrink-0">
                                        @else
                                            <div class="w-14 h-14 bg-gradient-to-br from-primary-600 to-primary-800 rounded-full flex items-center justify-center border-2 border-accent-500/30 flex-shrink-0">
                                                <i class="fas fa-user text-white text-lg"></i>
                                            </div>
                                        @endif
                                        <div class="flex-1 min-w-0">
                                            <div class="flex items-center gap-2 flex-wrap">
                                                <span class="font-bold text-primary-900 text-lg">{{ $testimonial->name }}</span>
                                                @if($testimonial->is_from_google)
                                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-gradient-to-r from-blue-50 to-blue-100 text-blue-700 text-xs rounded-full font-bold shadow-sm border border-blue-200 hover:shadow-md transition-all duration-200 flex-shrink-0">
                                                        <i class="fab fa-google text-blue-600"></i>
                                                        <span>Google Review</span>
                                                    </span>
                                                @endif
                                            </div>
                                            @if($testimonial->rating)
                                                <div class="flex items-center gap-1 mt-2">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <i class="fas fa-star {{ $i <= $testimonial->rating ? 'text-yellow-400' : 'text-gray-300' }} text-xs"></i>
                                                    @endfor
                                                    <span class="text-xs text-gray-500 ml-1">({{ $testimonial->rating }}/5)</span>
                                                </div>
                                            @endif
                                            @if($testimonial->role)
                                                <div class="text-sm text-gray-600 mt-1">{{ $testimonial->role }}{{ $testimonial->company ? ' at ' . $testimonial->company : '' }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @else
            <!-- No Google reviews yet -->
            <div class="text-center py-12">
                <div class="inline-block p-8 bg-white rounded-2xl border-2 border-dashed border-gray-300 max-w-md mx-auto">
                    <i class="fab fa-google text-5xl text-gray-400 mb-4"></i>
                    <p class="text-gray-600 text-lg mb-2">No Google reviews available yet</p>
                    <p class="text-gray-500 text-sm">Google reviews will appear here once synced from your Google Business Profile.</p>
                </div>
            </div>
        @endif
    </div>
</section>

@push('styles')
<style>
    .reviews-carousel-wrapper {
        position: relative;
    }
    
    .reviews-carousel-track {
        position: relative;
        overflow: hidden;
        mask-image: linear-gradient(
            to right,
            transparent 0%,
            black 5%,
            black 95%,
            transparent 100%
        );
        -webkit-mask-image: linear-gradient(
            to right,
            transparent 0%,
            black 5%,
            black 95%,
            transparent 100%
        );
    }
    
    .reviews-carousel-inner {
        display: flex;
        gap: 2rem;
        animation: slideReviews {{ max(60, $testimonials->count() * 2) }}s linear infinite;
        will-change: transform;
    }
    
    .reviews-carousel-wrapper:hover .reviews-carousel-inner {
        animation-play-state: paused;
    }
    
    @keyframes slideReviews {
        0% {
            transform: translateX(0);
        }
        100% {
            transform: translateX(-50%);
        }
    }
    
    /* Smooth sliding animation */
    @media (prefers-reduced-motion: no-preference) {
        .reviews-carousel-inner {
            animation: slideReviews {{ max(60, $testimonials->count() * 2) }}s linear infinite;
        }
    }
    
    @media (prefers-reduced-motion: reduce) {
        .reviews-carousel-inner {
            animation: none;
        }
    }
    
    .reviews-carousel-item {
        flex: 0 0 auto;
    }
    
    .line-clamp-4 {
        display: -webkit-box;
        -webkit-line-clamp: 4;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endpush
