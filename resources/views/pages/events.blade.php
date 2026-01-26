@extends('layouts.app')

@section('title', 'Events & Blog')
@section('description', 'Stay updated with our latest events, workshops, and blog posts on coaching and personal development.')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-primary-50 to-white py-20 lg:py-24">
        <div class="container text-center">
            <h1 class="text-4xl lg:text-5xl font-bold text-primary-900 mb-4">Events & Insights</h1>
            <p class="text-xl text-gray-600">Stay connected with our latest events, workshops, and coaching insights</p>
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
                <div class="card mb-6 hover:-translate-y-1 transition-transform duration-300 animate-on-scroll">
                    <div class="flex flex-col md:flex-row gap-6">
                        <div class="flex-shrink-0">
                            <div class="bg-primary-600 text-white rounded-lg p-6 text-center min-w-[100px]">
                                <div class="text-3xl font-bold">{{ $event->event_date->format('d') }}</div>
                                <div class="text-sm uppercase tracking-wider">{{ $event->event_date->format('M') }}</div>
                            </div>
                        </div>
                        <div class="flex-grow">
                            <h3 class="text-2xl font-bold text-primary-900 mb-2">{{ $event->title }}</h3>
                            <p class="text-gray-600 mb-4">{{ $event->excerpt ?? Str::limit($event->description, 150) }}</p>
                            <div class="flex flex-wrap gap-4 text-sm text-gray-500 mb-4">
                                <span class="flex items-center gap-2">
                                    <i class="fas fa-clock"></i>
                                    {{ $event->event_date->format('g:i A') }}
                                </span>
                                @if($event->location)
                                <span class="flex items-center gap-2">
                                    <i class="fas fa-map-marker-alt"></i>
                                    {{ $event->location }}
                                </span>
                                @endif
                                @if($event->price)
                                <span class="flex items-center gap-2">
                                    <i class="fas fa-tag"></i>
                                    {{ $event->currency }} {{ number_format($event->price) }}
                                </span>
                                @else
                                <span class="flex items-center gap-2">
                                    <i class="fas fa-tag"></i>
                                    Free Event
                                </span>
                                @endif
                            </div>
                            <a href="{{ route('contact') }}" class="btn btn-primary inline-flex items-center">
                                Register <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <i class="fas fa-calendar-times text-6xl text-gray-300 mb-4"></i>
                    <p class="text-xl text-gray-600">No upcoming events at this time.</p>
                    <p class="text-gray-500 mt-2">Check back soon for new events and workshops.</p>
                </div>
            @endforelse
        </div>
    </section>

    <!-- Blog/Insights Section -->
    <section class="section bg-gray-50">
        <div class="container">
            <div class="text-center mb-12 animate-on-scroll">
                <span class="text-accent-600 font-semibold text-sm uppercase tracking-wider">Latest Insights</span>
                <h2 class="text-3xl lg:text-4xl font-bold text-primary-900 mt-2 mb-4">From Our Blog</h2>
            </div>
            <div class="grid md:grid-cols-3 gap-6">
                @for($i = 0; $i < 3; $i++)
                    <div class="card animate-on-scroll">
                        <div class="bg-primary-600 text-white rounded-lg p-4 text-center mb-4 inline-block">
                            <div class="text-2xl font-bold">{{ now()->subDays($i * 7)->format('d') }}</div>
                            <div class="text-xs uppercase">{{ now()->subDays($i * 7)->format('M') }}</div>
                        </div>
                        <h3 class="text-xl font-bold text-primary-900 mb-2">Blog Post Title {{ $i + 1 }}</h3>
                        <p class="text-gray-600 mb-4">
                            Discover proven techniques for setting and achieving your goals. Learn how to create actionable plans and stay motivated throughout your journey.
                        </p>
                        <a href="#" class="text-primary-600 font-semibold hover:text-accent-500 transition-colors">
                            Read More <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                @endfor
            </div>
        </div>
    </section>

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

