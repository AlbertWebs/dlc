@extends('layouts.app')

@php
    $pageTitle = 'Events & Workshops – Destiny Life Coaching Kenya | Upcoming Coaching Events';
    $pageDescription = 'Stay updated with our latest events, workshops, and blog posts on coaching and personal development. Join our upcoming coaching events and workshops in Kenya.';
    $pageKeywords = 'coaching events Kenya, life coaching workshops, coaching seminars, professional development events, coaching training events, DLC events';
    $pageImage = asset('images/og-image.jpg');
    $pageType = 'website';
@endphp

@push('schema')
@php
    $eventsPageSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'CollectionPage',
        'name' => $pageTitle,
        'description' => $pageDescription,
        'url' => url('/events'),
        'inLanguage' => 'en-KE',
        'about' => [
            '@type' => 'Thing',
            'name' => 'Coaching Events and Workshops'
        ]
    ];
    
    // Add event schemas if events exist
    if (isset($events) && $events->count() > 0) {
        $eventsPageSchema['hasPart'] = [];
        foreach ($events->take(5) as $event) {
            $eventsPageSchema['hasPart'][] = [
                '@type' => 'Event',
                'name' => $event->title,
                'description' => $event->excerpt ?? Str::limit(strip_tags($event->description ?? ''), 200),
                'startDate' => $event->event_date->toIso8601String(),
                'location' => [
                    '@type' => 'Place',
                    'name' => $event->location ?? 'Nairobi, Kenya',
                    'address' => [
                        '@type' => 'PostalAddress',
                        'addressLocality' => 'Nairobi',
                        'addressCountry' => 'KE'
                    ]
                ],
                'offers' => [
                    '@type' => 'Offer',
                    'price' => $event->price ?? '0',
                    'priceCurrency' => $event->currency ?? 'KES',
                    'availability' => 'https://schema.org/InStock'
                ]
            ];
        }
    }
@endphp
<script type="application/ld+json">
@verbatim
{!! json_encode($eventsPageSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
@endverbatim
</script>
@endpush

@section('content')
    <!-- Breadcrumb -->
    <x-breadcrumb :items="[
        ['label' => 'Home', 'url' => route('home')],
        ['label' => 'Events', 'url' => route('events.index')]
    ]" />

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-primary-600 via-primary-700 to-primary-800 text-white py-20 lg:py-32 overflow-hidden">
        <!-- Decorative Background -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 right-0 w-96 h-96 bg-accent-400 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-accent-500 rounded-full blur-3xl"></div>
        </div>
        
        <!-- Accent Border Top -->
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-transparent via-accent-400 to-transparent"></div>
        
        <div class="container relative z-10 text-center">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full mb-6 border border-white/20">
                <i class="fas fa-calendar-alt text-accent-400"></i>
                <span class="text-sm font-semibold text-accent-300">Upcoming Events</span>
            </div>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4 leading-tight">
                Events & <span class="text-accent-400 italic">Insights</span>
            </h1>
            <p class="text-xl text-gray-100 max-w-2xl mx-auto leading-relaxed">
                Stay connected with our latest events, workshops, and coaching insights
            </p>
        </div>
    </section>

    <!-- Upcoming Events -->
    <section class="section">
        <div class="container">
            <div class="text-center mb-12 animate-on-scroll">
                <span class="text-accent-600 font-semibold text-sm uppercase tracking-wider">Upcoming Events</span>
                <h2 class="text-3xl lg:text-4xl font-bold text-primary-900 mt-2 mb-4">Join Our Events</h2>
            </div>
            
            @forelse($events as $event)
                @php
                    // Get image URL
                    $imageUrl = null;
                    if ($event->image) {
                        $imageUrl = str_starts_with($event->image, 'http') 
                            ? $event->image 
                            : asset('storage/' . $event->image);
                    }
                    
                    // Event type badge colors
                    $typeColors = [
                        'workshop' => 'bg-blue-100 text-blue-700 border-blue-200',
                        'webinar' => 'bg-purple-100 text-purple-700 border-purple-200',
                        'retreat' => 'bg-green-100 text-green-700 border-green-200',
                        'other' => 'bg-gray-100 text-gray-700 border-gray-200',
                    ];
                    $typeColor = $typeColors[$event->type] ?? $typeColors['other'];
                @endphp
                
                <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100 mb-8 animate-on-scroll">
                    <div class="flex flex-col lg:flex-row">
                        <!-- Image Section -->
                        <div class="lg:w-1/3 relative h-64 lg:h-auto overflow-hidden bg-gradient-to-br from-primary-600 to-primary-800">
                            @if($imageUrl)
                                <img src="{{ $imageUrl }}" 
                                     alt="{{ $event->title }}" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                     onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                <div class="w-full h-full bg-gradient-to-br from-primary-600 to-primary-800 flex items-center justify-center hidden">
                                    <i class="fas fa-calendar-alt text-6xl text-white opacity-50"></i>
                                </div>
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-primary-600 via-primary-700 to-primary-800 flex items-center justify-center">
                                    <div class="text-center text-white">
                                        <i class="fas fa-calendar-alt text-6xl mb-4 opacity-50"></i>
                                        <div class="text-3xl font-bold">{{ $event->event_date->format('d') }}</div>
                                        <div class="text-sm uppercase tracking-wider">{{ $event->event_date->format('M Y') }}</div>
                                    </div>
                                </div>
                            @endif
                            <!-- Date Badge Overlay -->
                            <div class="absolute top-4 left-4 bg-white/95 backdrop-blur-sm rounded-xl p-3 text-center shadow-lg">
                                <div class="text-2xl font-bold text-primary-900">{{ $event->event_date->format('d') }}</div>
                                <div class="text-xs uppercase tracking-wider text-gray-600">{{ $event->event_date->format('M') }}</div>
                            </div>
                            <!-- Type Badge -->
                            <div class="absolute top-4 right-4">
                                <span class="px-3 py-1 {{ $typeColor }} rounded-full text-xs font-semibold uppercase tracking-wider border">
                                    {{ ucfirst($event->type) }}
                                </span>
                            </div>
                        </div>
                        
                        <!-- Content Section -->
                        <div class="lg:w-2/3 p-6 lg:p-8 flex flex-col justify-between">
                            <div>
                                <h3 class="text-2xl lg:text-3xl font-bold text-primary-900 mb-3 group-hover:text-accent-600 transition-colors">
                                    {{ $event->title }}
                                </h3>
                                <p class="text-gray-600 mb-4 leading-relaxed">
                                    {{ $event->excerpt ?? Str::limit(strip_tags($event->description), 200) }}
                                </p>
                                
                                <!-- Event Details -->
                                <div class="flex flex-wrap gap-4 mb-6">
                                    <div class="flex items-center gap-2 text-gray-600">
                                        <div class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-clock text-primary-600"></i>
                                        </div>
                                        <div>
                                            <div class="text-xs text-gray-500">Time</div>
                                            <div class="font-semibold">{{ $event->event_date->format('g:i A') }}</div>
                                        </div>
                                    </div>
                                    
                                    @if($event->location)
                                    <div class="flex items-center gap-2 text-gray-600">
                                        <div class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-map-marker-alt text-primary-600"></i>
                                        </div>
                                        <div>
                                            <div class="text-xs text-gray-500">Location</div>
                                            <div class="font-semibold">{{ Str::limit($event->location, 30) }}</div>
                                        </div>
                                    </div>
                                    @endif
                                    
                                    <div class="flex items-center gap-2 text-gray-600">
                                        <div class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-tag text-primary-600"></i>
                                        </div>
                                        <div>
                                            <div class="text-xs text-gray-500">Price</div>
                                            <div class="font-semibold">
                                                @if($event->price)
                                                    {{ $event->currency }} {{ number_format($event->price) }}
                                                @else
                                                    Free Event
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Action Button -->
                            <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
                                <a href="{{ route('contact') }}?subject=Event Registration: {{ urlencode($event->title) }}" 
                                   class="btn btn-primary inline-flex items-center gap-2 flex-1 justify-center">
                                    <i class="fas fa-user-plus"></i>
                                    <span>Register Now</span>
                                </a>
                                <a href="{{ route('contact') }}?subject=Event Inquiry: {{ urlencode($event->title) }}" 
                                   class="btn btn-secondary inline-flex items-center gap-2">
                                    <i class="fas fa-info-circle"></i>
                                    <span>Learn More</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-16 lg:py-24">
                    <div class="max-w-md mx-auto">
                        <div class="relative mb-8">
                            <div class="w-32 h-32 mx-auto bg-gradient-to-br from-primary-100 to-accent-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-calendar-times text-6xl text-primary-400"></i>
                            </div>
                            <div class="absolute -top-2 -right-2 w-16 h-16 bg-accent-200 rounded-full opacity-50"></div>
                            <div class="absolute -bottom-2 -left-2 w-12 h-12 bg-primary-200 rounded-full opacity-50"></div>
                        </div>
                        <h3 class="text-2xl font-bold text-primary-900 mb-3">No Upcoming Events</h3>
                        <p class="text-lg text-gray-600 mb-2">We're currently planning our next exciting events and workshops.</p>
                        <p class="text-gray-500 mb-8">Check back soon or subscribe to our newsletter to be notified when new events are announced.</p>
                        <a href="{{ route('contact') }}" class="btn btn-primary inline-flex items-center gap-2">
                            <i class="fas fa-envelope"></i>
                            <span>Subscribe for Updates</span>
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
    </section>

    <!-- Blog/Insights Section -->
    <section class="section bg-gradient-to-br from-gray-50 via-white to-gray-50">
        <div class="container">
            <div class="text-center mb-12 animate-on-scroll">
                <span class="text-accent-600 font-semibold text-sm uppercase tracking-wider">Latest Insights</span>
                <h2 class="text-3xl lg:text-4xl font-bold text-primary-900 mt-2 mb-4">From Our Blog</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Discover coaching insights, tips, and success stories</p>
            </div>
            @php
                $blogPosts = \App\Models\BlogPost::where('is_published', true)
                    ->orderBy('published_at', 'desc')
                    ->limit(3)
                    ->get();
            @endphp
            
            @if($blogPosts->count() > 0)
                <div class="grid md:grid-cols-3 gap-8">
                    @foreach($blogPosts as $index => $post)
                        @php
                            $imageUrl = null;
                            if ($post->featured_image) {
                                $imageUrl = str_starts_with($post->featured_image, 'http') 
                                    ? $post->featured_image 
                                    : asset('storage/' . $post->featured_image);
                            }
                        @endphp
                        <div class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100 animate-on-scroll">
                            <!-- Image -->
                            <div class="relative h-48 overflow-hidden bg-gradient-to-br from-primary-600 to-primary-800">
                                @if($imageUrl)
                                    <img src="{{ $imageUrl }}" 
                                         alt="{{ $post->title }}" 
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                         onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                    <div class="w-full h-full bg-gradient-to-br from-primary-600 to-primary-800 flex items-center justify-center hidden">
                                        <i class="fas fa-newspaper text-5xl text-white opacity-50"></i>
                                    </div>
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-primary-600 via-primary-700 to-primary-800 flex items-center justify-center">
                                        <i class="fas fa-newspaper text-5xl text-white opacity-50"></i>
                                    </div>
                                @endif
                                <!-- Date Badge -->
                                @if($post->published_at)
                                <div class="absolute top-4 left-4 bg-white/95 backdrop-blur-sm rounded-lg px-3 py-2 shadow-lg">
                                    <div class="text-xs text-gray-500 uppercase tracking-wider">{{ $post->published_at->format('M') }}</div>
                                    <div class="text-xl font-bold text-primary-900">{{ $post->published_at->format('d') }}</div>
                                </div>
                                @endif
                            </div>
                            
                            <!-- Content -->
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-primary-900 mb-3 group-hover:text-accent-600 transition-colors line-clamp-2">
                                    {{ $post->title }}
                                </h3>
                                <p class="text-gray-600 mb-4 line-clamp-3">
                                    {{ $post->excerpt ?? Str::limit(strip_tags($post->content), 120) }}
                                </p>
                                <a href="{{ route('blog.show', $post->slug) }}" 
                                   class="text-primary-600 font-semibold hover:text-accent-500 transition-colors inline-flex items-center gap-2">
                                    <span>Read More</span>
                                    <i class="fas fa-arrow-right transform group-hover:translate-x-1 transition-transform"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="text-center mt-12">
                    <a href="{{ route('blog.index') }}" class="btn btn-primary btn-large inline-flex items-center gap-2">
                        <span>View All Blog Posts</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            @else
                <div class="text-center py-12">
                    <div class="w-24 h-24 mx-auto bg-gradient-to-br from-primary-100 to-accent-100 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-newspaper text-4xl text-primary-400"></i>
                    </div>
                    <p class="text-lg text-gray-600 mb-4">No blog posts available at this time.</p>
                    <a href="{{ route('blog.index') }}" class="btn btn-secondary">Visit Blog</a>
                </div>
            @endif
        </div>
    </section>

    <!-- Google Reviews Section -->
    <x-google-reviews-section />

    <!-- CTA Section -->
    <section class="section bg-gradient-to-r from-primary-900 to-primary-800 text-white">
        <div class="container text-center">
            <h2 class="text-3xl lg:text-4xl font-bold mb-4">Stay Updated</h2>
            <p class="text-xl text-gray-200 mb-8 max-w-2xl mx-auto">
                Subscribe to our newsletter to receive updates on events, workshops, and coaching insights.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('contact') }}" class="btn btn-accent btn-large">Subscribe</a>
                <a href="{{ route('contact') }}" class="btn bg-white text-primary-900 hover:bg-gray-100 btn-large">Contact Us</a>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
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

