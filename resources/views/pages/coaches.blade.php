@extends('layouts.app')

@php
    $pageTitle = 'Our Coaches – Certified Life Coaches in Kenya | DLC Kenya';
    $pageDescription = 'Meet our professional ICR-certified life coaches in Kenya. Find the right coach for your personal transformation journey. Expert coaches specializing in career, relationship, and life coaching.';
    $pageKeywords = 'life coaches Kenya, certified coaches, professional coaches, ICR certified coaches, coaching experts, life coach directory';
    $pageImage = asset('images/og-image.jpg');
    $pageType = 'website';
@endphp

@push('schema')
@php
    $coachesPageSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'CollectionPage',
        'name' => $pageTitle,
        'description' => $pageDescription,
        'url' => url('/coaches'),
        'inLanguage' => 'en-KE',
        'about' => [
            '@type' => 'Thing',
            'name' => 'Professional Life Coaches'
        ]
    ];
@endphp
<script type="application/ld+json">
@verbatim
{!! json_encode($coachesPageSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
@endverbatim
</script>
@endpush

@section('content')
    <!-- Breadcrumb -->
    <section class="bg-gradient-to-r from-primary-900 via-primary-800 to-primary-900 text-white py-3 md:py-4 border-b-2 border-accent-500/30 shadow-lg">
        <div class="container">
            <nav class="flex items-center gap-2 text-xs md:text-sm overflow-x-auto scrollbar-hide" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-accent-400 transition-colors flex items-center gap-1.5 whitespace-nowrap px-2 py-1 rounded-md hover:bg-white/10">
                    <i class="fas fa-home text-xs"></i>
                    <span class="hidden sm:inline">Home</span>
                </a>
                <i class="fas fa-chevron-right text-xs text-primary-300 flex-shrink-0"></i>
                <span class="text-accent-400 font-semibold px-2 py-1 rounded-md bg-accent-500/10 border border-accent-500/30 whitespace-nowrap">Coaches</span>
            </nav>
        </div>
    </section>

    <!-- Hero -->
    <section class="relative py-16 md:py-24 bg-gradient-to-br from-primary-900 via-primary-800 to-primary-950 text-white overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 right-0 w-96 h-96 bg-accent-500 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-primary-600 rounded-full blur-3xl"></div>
        </div>
        <div class="container relative z-10">
            <div class="max-w-3xl">
                <span class="inline-flex items-center gap-2 px-4 py-2 bg-accent-500/20 border border-accent-400/40 rounded-full text-accent-200 font-semibold text-xs uppercase tracking-widest">
                    <i class="fas fa-user-friends"></i> Our Team
                </span>
                <h1 class="text-4xl md:text-5xl font-bold mt-4">Meet Our Coaches</h1>
                <p class="text-gray-200 text-lg md:text-xl mt-4 max-w-2xl">
                    Find the right coach for your goals—browse profiles, credentials, and specialties.
                </p>
            </div>
        </div>
    </section>

    <!-- Coaches Grid -->
    <section class="py-14 md:py-20 bg-gradient-to-br from-white via-primary-50/30 to-white">
        <div class="container">
            @if($coaches->count() === 0)
                <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-xl p-10 border border-gray-100 text-center">
                    <div class="w-16 h-16 mx-auto rounded-2xl bg-primary-50 border border-primary-100 flex items-center justify-center mb-4">
                        <i class="fas fa-user text-primary-700 text-2xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-primary-900">No coaches published yet</h2>
                    <p class="text-gray-600 mt-2">Please check back soon.</p>
                </div>
            @else
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($coaches as $coach)
                        <a href="{{ route('coach.show', $coach->slug) }}" class="group block bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                            <div class="relative">
                                @if($coach->photo)
                                    <img src="{{ asset('storage/' . $coach->photo) }}" alt="{{ $coach->name }}" class="w-full aspect-[4/3] object-cover">
                                @else
                                    <div class="w-full aspect-[4/3] bg-gradient-to-br from-primary-700 to-primary-900 flex items-center justify-center">
                                        <i class="fas fa-user text-white text-6xl opacity-60"></i>
                                    </div>
                                @endif
                                @if($coach->is_featured)
                                    <div class="absolute top-4 left-4 inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-accent-500 text-primary-900 font-bold text-xs shadow-lg">
                                        <i class="fas fa-star"></i> Featured
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-black/35 via-transparent to-transparent opacity-60"></div>
                            </div>

                            <div class="p-6">
                                <div class="flex items-start justify-between gap-4">
                                    <div>
                                        <h3 class="text-xl font-bold text-primary-900 group-hover:text-primary-700 transition-colors">{{ $coach->name }}</h3>
                                        @if($coach->title)
                                            <div class="text-sm text-gray-600 mt-1">{{ $coach->title }}</div>
                                        @endif
                                    </div>
                                    <span class="w-10 h-10 rounded-xl bg-primary-50 border border-primary-100 flex items-center justify-center text-primary-700 group-hover:bg-primary-100 transition-colors">
                                        <i class="fas fa-arrow-right"></i>
                                    </span>
                                </div>

                                @if($coach->bio)
                                    <p class="text-gray-700 mt-4 line-clamp-3">{{ $coach->bio }}</p>
                                @endif

                                <div class="flex flex-wrap gap-2 mt-5">
                                    @if($coach->location)
                                        <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-gray-50 border border-gray-100 text-gray-700 text-xs font-semibold">
                                            <i class="fas fa-map-marker-alt text-accent-600"></i> {{ $coach->location }}
                                        </span>
                                    @endif
                                    @if($coach->specializations && count($coach->specializations) > 0)
                                        <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-blue-50 border border-blue-100 text-blue-700 text-xs font-semibold">
                                            <i class="fas fa-bullseye"></i> {{ $coach->specializations[0] }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection

