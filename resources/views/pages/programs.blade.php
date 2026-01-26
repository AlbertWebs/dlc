@extends('layouts.app')

@section('title', 'Coaching Programs')
@section('description', 'Explore our comprehensive coaching programs: Career, Life, Certification, and Corporate coaching.')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-primary-50 to-white py-20 lg:py-24">
        <div class="container text-center">
            <h1 class="text-4xl lg:text-5xl font-bold text-primary-900 mb-4">Our Coaching Programs</h1>
            <p class="text-xl text-gray-600">Comprehensive programs designed to transform your life and career</p>
        </div>
    </section>

    <!-- Programs Listing -->
    <section class="section">
        <div class="container">
            @forelse($programs as $program)
                <div class="card mb-8 animate-on-scroll">
                    <div class="grid lg:grid-cols-4 gap-8">
                        <div class="lg:col-span-1">
                            <div class="w-20 h-20 bg-gradient-to-br from-primary-600 to-primary-800 rounded-xl flex items-center justify-center mb-4">
                                <i class="fas {{ $program->icon ?? 'fa-briefcase' }} text-3xl text-white"></i>
                            </div>
                        </div>
                        <div class="lg:col-span-2">
                            <h2 class="text-2xl font-bold text-primary-900 mb-3">{{ $program->title }}</h2>
                            <p class="text-gray-600 mb-4">{{ $program->excerpt ?? Str::limit($program->description, 200) }}</p>
                            @if($program->features)
                                <ul class="space-y-2 mb-4">
                                    @foreach(array_slice($program->features, 0, 3) as $feature)
                                        <li class="flex items-center gap-2 text-gray-700">
                                            <i class="fas fa-check text-accent-500"></i>
                                            <span>{{ $feature }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                            <a href="{{ route('programs.show', $program->slug) }}" class="btn btn-primary inline-flex items-center">
                                Learn More <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                        <div class="lg:col-span-1 text-right">
                            @if($program->price)
                                <div class="text-3xl font-bold text-primary-600 mb-2">
                                    {{ $program->currency }} {{ number_format($program->price) }}
                                </div>
                            @endif
                            @if($program->meta && isset($program->meta['duration']))
                                <div class="text-gray-600 mb-1">
                                    <i class="fas fa-clock"></i> {{ $program->meta['duration'] }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-12">
                    <i class="fas fa-graduation-cap text-6xl text-gray-300 mb-4"></i>
                    <p class="text-xl text-gray-600">No programs available at this time.</p>
                    <p class="text-gray-500 mt-2">Check back soon for new programs.</p>
                </div>
            @endforelse
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section bg-gradient-to-r from-primary-900 to-primary-800 text-white">
        <div class="container text-center">
            <h2 class="text-3xl lg:text-4xl font-bold mb-4">Not Sure Which Program Is Right For You?</h2>
            <p class="text-xl text-gray-200 mb-8 max-w-2xl mx-auto">
                Contact us for a free consultation to discuss your goals and find the perfect program.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('contact') }}" class="btn btn-accent btn-large">Schedule Consultation</a>
                <a href="{{ route('about') }}" class="btn bg-white text-primary-900 hover:bg-gray-100 btn-large">Meet Our Coaches</a>
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

