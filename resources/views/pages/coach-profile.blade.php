@extends('layouts.app')

@php
    $pageTitle = $coach->name . ' – ' . ($coach->title ?? 'Certified Life Coach') . ' | ' . config('app.name');
    $pageDescription = $coach->bio ?? 'Professional life coach helping you achieve your goals.';
    $pageImage = $coach->photo ? asset('storage/' . $coach->photo) : asset('images/og-image.jpg');
    $pageType = 'profile';
@endphp

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
                <a href="{{ route('about') }}" class="hover:text-accent-400 transition-colors whitespace-nowrap px-2 py-1 rounded-md hover:bg-white/10">About</a>
                <i class="fas fa-chevron-right text-xs text-primary-300 flex-shrink-0"></i>
                <span class="text-accent-400 font-semibold px-2 py-1 rounded-md bg-accent-500/10 border border-accent-500/30 truncate max-w-[200px] sm:max-w-none">
                    {{ $coach->name }}
                </span>
            </nav>
        </div>
    </section>

    <!-- Hero Section with Parallax Effect -->
    <section class="relative min-h-[90vh] flex items-center justify-center overflow-hidden bg-gradient-to-br from-primary-900 via-primary-800 to-primary-950">
        <!-- Animated Background -->
        <div class="absolute inset-0">
            <div class="absolute top-0 left-0 w-full h-full bg-[radial-gradient(circle_at_30%_20%,rgba(248,176,22,0.1),transparent_50%)]"></div>
            <div class="absolute bottom-0 right-0 w-full h-full bg-[radial-gradient(circle_at_70%_80%,rgba(248,176,22,0.08),transparent_50%)]"></div>
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-20 left-20 w-72 h-72 bg-accent-500 rounded-full blur-3xl animate-pulse"></div>
                <div class="absolute bottom-20 right-20 w-96 h-96 bg-primary-600 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
            </div>
        </div>

        <div class="container relative z-10 px-4 sm:px-6 lg:px-8 py-20">
            <div class="max-w-7xl mx-auto">
                <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                    <!-- Left Content -->
                    <div class="text-center lg:text-left space-y-8 animate-on-scroll">
                        <!-- Badge -->
                        <div class="inline-block">
                            <span class="px-6 py-3 bg-accent-500/20 border-2 border-accent-400/50 rounded-full text-accent-300 font-bold text-sm uppercase tracking-widest backdrop-blur-sm shadow-xl">
                                <i class="fas fa-star mr-2"></i>{{ $coach->title ?? 'Certified Life Coach' }}
                            </span>
                        </div>

                        <!-- Name -->
                        <h1 class="text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-bold leading-tight">
                            <span class="text-white">{{ explode(' ', $coach->name)[0] ?? $coach->name }}</span>
                            @if(count(explode(' ', $coach->name)) > 1)
                                <span class="text-accent-400 font-accent italic">
                                    {{ implode(' ', array_slice(explode(' ', $coach->name), 1)) }}
                                </span>
                            @endif
                        </h1>

                        <!-- Bio -->
                        @if($coach->bio)
                            <p class="text-xl md:text-2xl text-gray-200 leading-relaxed max-w-2xl mx-auto lg:mx-0">
                                {{ $coach->bio }}
                            </p>
                        @endif

                        <!-- Quick Stats & Contact Actions -->
                        <div class="flex flex-wrap items-center gap-3 md:gap-4 justify-center lg:justify-start pt-4">
                            @if($coach->credentials && count($coach->credentials) > 0)
                                <div class="bg-white/10 backdrop-blur-md rounded-xl px-4 py-3 border border-white/20">
                                    <div class="text-2xl font-bold text-accent-400">{{ count($coach->credentials) }}+</div>
                                    <div class="text-xs text-gray-300">Certifications</div>
                                </div>
                            @endif
                            @if($coach->specializations && count($coach->specializations) > 0)
                                <div class="bg-white/10 backdrop-blur-md rounded-xl px-4 py-3 border border-white/20">
                                    <div class="text-2xl font-bold text-accent-400">{{ count($coach->specializations) }}+</div>
                                    <div class="text-xs text-gray-300">Specializations</div>
                                </div>
                            @endif
                            
                            @if($coach->phone)
                                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $coach->phone) }}" 
                                   class="inline-flex items-center gap-2 px-5 py-3 bg-gradient-to-r from-accent-500 to-accent-600 text-primary-900 font-bold rounded-xl hover:from-accent-400 hover:to-accent-500 transform hover:scale-105 transition-all duration-300 shadow-xl hover:shadow-accent-500/50 text-sm">
                                    <i class="fas fa-phone"></i>
                                    <span>Call Now</span>
                                </a>
                            @endif
                            @if($coach->email)
                                <a href="mailto:{{ $coach->email }}" 
                                   class="inline-flex items-center gap-2 px-5 py-3 bg-white/10 backdrop-blur-sm text-white border-2 border-white/30 font-semibold rounded-xl hover:bg-white/20 transform hover:scale-105 transition-all duration-300 text-sm">
                                    <i class="fas fa-envelope"></i>
                                    <span>Email Me</span>
                                </a>
                            @endif
                        </div>

                        <!-- Social Links -->
                        @if($coach->social_links && count($coach->social_links) > 0)
                            <div class="flex items-center gap-4 justify-center lg:justify-start pt-4">
                                <span class="text-gray-300 text-sm font-medium">Follow:</span>
                                <div class="flex gap-3">
                                    @foreach($coach->social_links as $platform => $url)
                                        <a href="{{ $url }}" target="_blank" rel="noopener noreferrer" 
                                           class="w-12 h-12 flex items-center justify-center rounded-xl bg-white/10 backdrop-blur-sm border border-white/20 hover:bg-accent-500 hover:border-accent-500 transform hover:scale-110 transition-all duration-300 shadow-lg">
                                            @if($platform === 'linkedin')
                                                <i class="fab fa-linkedin-in text-white text-lg"></i>
                                            @elseif($platform === 'facebook')
                                                <i class="fab fa-facebook-f text-white text-lg"></i>
                                            @elseif($platform === 'twitter' || $platform === 'x')
                                                <i class="fab fa-twitter text-white text-lg"></i>
                                            @elseif($platform === 'instagram')
                                                <i class="fab fa-instagram text-white text-lg"></i>
                                            @elseif($platform === 'youtube')
                                                <i class="fab fa-youtube text-white text-lg"></i>
                                            @else
                                                <i class="fas fa-link text-white text-lg"></i>
                                            @endif
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Right - Photo -->
                    <div class="relative animate-on-scroll">
                        <div class="relative">
                            <!-- Floating Badges -->
                            @if($coach->is_featured)
                                <div class="absolute -top-6 -left-6 z-20 bg-gradient-to-r from-accent-500 to-accent-600 text-primary-900 px-6 py-3 rounded-full shadow-2xl transform rotate-[-12deg] animate-float">
                                    <div class="flex items-center gap-2 font-bold">
                                        <i class="fas fa-star"></i>
                                        <span>Featured Coach</span>
                                    </div>
                                </div>
                            @endif

                            <!-- Main Photo Container -->
                            <div class="relative">
                                <!-- Decorative Background -->
                                <div class="absolute inset-0 bg-gradient-to-br from-accent-400 via-accent-500 to-accent-600 rounded-3xl transform rotate-6 opacity-20 blur-xl"></div>
                                <div class="absolute inset-0 bg-gradient-to-br from-primary-600 to-primary-800 rounded-3xl transform -rotate-3"></div>
                                
                                <!-- Photo -->
                                <div class="relative bg-primary-900 rounded-3xl overflow-hidden shadow-2xl border-4 border-white/20">
                                    @if($coach->photo)
                                        <img src="{{ asset('storage/' . $coach->photo) }}" 
                                             alt="{{ $coach->name }}" 
                                             class="w-full h-full object-cover aspect-square">
                                    @else
                                        <div class="w-full aspect-square flex items-center justify-center bg-gradient-to-br from-primary-700 to-primary-900">
                                            <i class="fas fa-user text-white text-9xl opacity-50"></i>
                                        </div>
                                    @endif
                                    
                                    <!-- Overlay Gradient -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>
                                </div>
                            </div>

                            <!-- Location Badge -->
                            @if($coach->location)
                                <div class="absolute -bottom-6 -right-6 z-20 bg-white/95 backdrop-blur-md text-primary-900 px-6 py-3 rounded-full shadow-2xl border-2 border-accent-500/30">
                                    <div class="flex items-center gap-2 font-semibold">
                                        <i class="fas fa-map-marker-alt text-accent-600"></i>
                                        <span>{{ $coach->location }}</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-10">
            <button type="button" onclick="scrollToNextSection()" class="flex flex-col items-center gap-2 animate-bounce cursor-pointer focus:outline-none focus:ring-2 focus:ring-white/50 rounded-full p-2 group">
                <div class="w-10 h-10 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 flex items-center justify-center shadow-lg group-hover:bg-white/20 group-active:bg-white/30 transition-all duration-300">
                    <i class="fas fa-chevron-down text-white text-sm group-hover:translate-y-0.5 transition-transform duration-300"></i>
                </div>
                <div class="w-0.5 h-8 bg-gradient-to-b from-white/60 to-transparent"></div>
            </button>
        </div>
    </section>

    <!-- About Section -->
    @if($coach->description)
        <section class="relative py-20 lg:py-32 bg-gradient-to-br from-white via-primary-50/30 to-white overflow-hidden">
            <div class="absolute top-0 right-0 w-96 h-96 bg-accent-500/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-primary-500/5 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2"></div>
            
            <div class="container relative z-10 px-4 sm:px-6 lg:px-8">
                <div class="max-w-4xl mx-auto animate-on-scroll">
                    <div class="text-center mb-12">
                        <h2 class="text-4xl md:text-5xl font-bold text-primary-900 mb-4">
                            About <span class="text-accent-500 font-accent italic">{{ explode(' ', $coach->name)[0] ?? $coach->name }}</span>
                        </h2>
                        <div class="w-24 h-1 bg-gradient-to-r from-transparent via-accent-500 to-transparent mx-auto"></div>
                    </div>
                    
                    <div class="prose prose-lg prose-primary max-w-none bg-white/80 backdrop-blur-sm rounded-3xl p-8 md:p-12 shadow-2xl border border-primary-100">
                        {!! $coach->description !!}
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Credentials & Specializations Grid -->
    <section class="relative py-20 lg:py-32 bg-gradient-to-br from-primary-900 via-primary-800 to-primary-950 text-white overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 right-0 w-96 h-96 bg-accent-500 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-accent-400 rounded-full blur-3xl"></div>
        </div>
        
        <div class="container relative z-10 px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-8 lg:gap-12 max-w-6xl mx-auto">
                <!-- Credentials -->
                @if($coach->credentials && count($coach->credentials) > 0)
                    <div class="bg-white/5 backdrop-blur-md rounded-3xl p-8 border border-white/10 shadow-2xl animate-on-scroll">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-16 h-16 bg-gradient-to-br from-accent-400 to-accent-600 rounded-2xl flex items-center justify-center shadow-lg">
                                <i class="fas fa-certificate text-white text-2xl"></i>
                            </div>
                            <h3 class="text-3xl font-bold">Credentials</h3>
                        </div>
                        <ul class="space-y-4">
                            @foreach($coach->credentials as $credential)
                                <li class="flex items-start gap-3 p-4 bg-white/5 rounded-xl hover:bg-white/10 transition-all duration-300">
                                    <i class="fas fa-check-circle text-accent-400 text-xl mt-0.5 flex-shrink-0"></i>
                                    <span class="text-gray-100 text-lg">{{ $credential }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Specializations -->
                @if($coach->specializations && count($coach->specializations) > 0)
                    <div class="bg-white/5 backdrop-blur-md rounded-3xl p-8 border border-white/10 shadow-2xl animate-on-scroll">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-16 h-16 bg-gradient-to-br from-primary-600 to-primary-800 rounded-2xl flex items-center justify-center shadow-lg">
                                <i class="fas fa-star text-white text-2xl"></i>
                            </div>
                            <h3 class="text-3xl font-bold">Specializations</h3>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            @foreach($coach->specializations as $specialization)
                                <div class="p-4 bg-white/5 rounded-xl hover:bg-white/10 transition-all duration-300 border border-white/10">
                                    <span class="text-gray-100 font-medium">{{ $specialization }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Experience, Education, Certifications -->
    <section class="relative py-20 lg:py-32 bg-white overflow-hidden">
        <div class="container px-4 sm:px-6 lg:px-8">
            <div class="max-w-5xl mx-auto space-y-12">
                <!-- Experience -->
                @if($coach->experience)
                    <div class="bg-gradient-to-br from-primary-50 to-white rounded-3xl p-8 md:p-12 shadow-2xl border-l-4 border-accent-500 animate-on-scroll">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-16 h-16 bg-gradient-to-br from-accent-400 to-accent-600 rounded-2xl flex items-center justify-center shadow-lg">
                                <i class="fas fa-briefcase text-white text-2xl"></i>
                            </div>
                            <h2 class="text-3xl md:text-4xl font-bold text-primary-900">Experience</h2>
                        </div>
                        <div class="text-gray-700 text-lg leading-relaxed whitespace-pre-line">
                            {{ $coach->experience }}
                        </div>
                    </div>
                @endif

                <!-- Education -->
                @if($coach->education)
                    <div class="bg-white rounded-3xl p-8 md:p-12 shadow-2xl border-l-4 border-primary-600 animate-on-scroll">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-16 h-16 bg-gradient-to-br from-primary-600 to-primary-800 rounded-2xl flex items-center justify-center shadow-lg">
                                <i class="fas fa-graduation-cap text-white text-2xl"></i>
                            </div>
                            <h2 class="text-3xl md:text-4xl font-bold text-primary-900">Education</h2>
                        </div>
                        <div class="text-gray-700 text-lg leading-relaxed whitespace-pre-line">
                            {{ $coach->education }}
                        </div>
                    </div>
                @endif

                <!-- Certifications -->
                @if($coach->certifications)
                    <div class="bg-gradient-to-br from-accent-50 to-white rounded-3xl p-8 md:p-12 shadow-2xl border-l-4 border-accent-500 animate-on-scroll">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-16 h-16 bg-gradient-to-br from-accent-400 to-accent-600 rounded-2xl flex items-center justify-center shadow-lg">
                                <i class="fas fa-certificate text-white text-2xl"></i>
                            </div>
                            <h2 class="text-3xl md:text-4xl font-bold text-primary-900">Certifications</h2>
                        </div>
                        <div class="text-gray-700 text-lg leading-relaxed whitespace-pre-line">
                            {{ $coach->certifications }}
                        </div>
                    </div>
                @endif

                <!-- Coaching Style -->
                @if($coach->coaching_style)
                    <div class="bg-gradient-to-br from-primary-900 via-primary-800 to-primary-950 rounded-3xl p-8 md:p-12 shadow-2xl text-white animate-on-scroll">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-16 h-16 bg-gradient-to-br from-accent-400 to-accent-600 rounded-2xl flex items-center justify-center shadow-lg">
                                <i class="fas fa-heart text-white text-2xl"></i>
                            </div>
                            <h2 class="text-3xl md:text-4xl font-bold">Coaching Style</h2>
                        </div>
                        <p class="text-gray-100 text-xl font-medium leading-relaxed">
                            {{ $coach->coaching_style }}
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    @if($coach->testimonials)
        <section class="relative py-20 lg:py-32 bg-gradient-to-br from-primary-50 via-white to-accent-50/20 overflow-hidden">
            <div class="container px-4 sm:px-6 lg:px-8">
                <div class="max-w-4xl mx-auto animate-on-scroll">
                    <div class="text-center mb-12">
                        <h2 class="text-4xl md:text-5xl font-bold text-primary-900 mb-4">
                            What Clients Say
                        </h2>
                        <div class="w-24 h-1 bg-gradient-to-r from-transparent via-accent-500 to-transparent mx-auto"></div>
                    </div>
                    
                    <div class="bg-white rounded-3xl p-8 md:p-12 shadow-2xl border border-primary-100">
                        <div class="text-accent-500 text-6xl mb-6 opacity-20">
                            <i class="fas fa-quote-left"></i>
                        </div>
                        <div class="text-gray-700 text-lg md:text-xl leading-relaxed italic whitespace-pre-line">
                            {{ $coach->testimonials }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Testimonials Section -->
    <section class="relative py-20 lg:py-32 bg-gradient-to-br from-primary-50 via-white to-accent-50/20 overflow-hidden">
        <div class="absolute top-0 right-0 w-96 h-96 bg-accent-500/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-primary-500/5 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2"></div>
        
        <div class="container relative z-10 px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 animate-on-scroll">
                <span class="text-accent-600 font-semibold text-sm uppercase tracking-wider">Success Stories</span>
                <h2 class="text-3xl lg:text-4xl xl:text-5xl font-bold text-primary-900 mt-2 mb-4">
                    What Clients Say About <span class="text-accent-500 font-accent italic">{{ explode(' ', $coach->name)[0] ?? $coach->name }}</span>
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
                                "Working with {{ explode(' ', $coach->name)[0] ?? $coach->name }} transformed my entire perspective on life and career. The coaching helped me identify and release limiting beliefs I didn't even know I had."
                            </p>
                            <div class="flex items-center gap-4 pt-6 border-t border-gray-100">
                                <div class="w-14 h-14 bg-gradient-to-br from-primary-600 to-primary-800 rounded-full flex items-center justify-center border-2 border-accent-500/30">
                                    <i class="fas fa-user text-white text-lg"></i>
                                </div>
                                <div>
                                    <div class="font-bold text-primary-900 text-lg">Client Testimonial</div>
                                    <div class="text-sm text-gray-600">Satisfied Client</div>
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
    @keyframes float {
        0%, 100% {
            transform: translateY(0) rotate(-12deg);
        }
        50% {
            transform: translateY(-10px) rotate(-12deg);
        }
    }
    
    .animate-float {
        animation: float 3s ease-in-out infinite;
    }
    
    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
</style>
@endpush

@push('scripts')
<script>
    // Scroll to next section
    function scrollToNextSection() {
        const heroSection = document.querySelector('section');
        if (heroSection) {
            const nextSection = heroSection.nextElementSibling;
            if (nextSection) {
                nextSection.scrollIntoView({ 
                    behavior: 'smooth',
                    block: 'start'
                });
            } else {
                // Fallback: scroll down by viewport height
                window.scrollBy({
                    top: window.innerHeight * 0.8,
                    behavior: 'smooth'
                });
            }
        }
    }
    
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
