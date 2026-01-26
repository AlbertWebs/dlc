@extends('layouts.app')

@php
    $pageTitle = $coach->name . ' – ' . ($coach->title ?? 'Certified Life Coach') . ' | ' . config('app.name');
    $pageDescription = $coach->bio ?? 'Professional life coach helping you achieve your goals.';
    $pageImage = $coach->photo ? asset('storage/' . $coach->photo) : asset('images/og-image.jpg');
    $pageType = 'profile';
@endphp

@section('content')
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-primary-900 via-primary-800 to-primary-900 text-white py-16 lg:py-24">
        <div class="container">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="fade-in">
                    <div class="inline-block px-4 py-2 bg-accent-500/20 border border-accent-500/40 rounded-full mb-4">
                        <span class="text-sm font-semibold text-accent-400">{{ $coach->title ?? 'Certified Life Coach' }}</span>
                    </div>
                    <h1 class="text-4xl lg:text-5xl xl:text-6xl font-bold mb-4 leading-tight">
                        {{ $coach->name }}
                    </h1>
                    @if($coach->bio)
                        <p class="text-xl text-primary-100 mb-6 leading-relaxed">
                            {{ $coach->bio }}
                        </p>
                    @endif
                    
                    @if($coach->location || $coach->email || $coach->phone)
                        <div class="flex flex-wrap gap-4 mb-6">
                            @if($coach->location)
                                <div class="flex items-center gap-2 text-primary-200">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span>{{ $coach->location }}</span>
                                </div>
                            @endif
                            @if($coach->email)
                                <a href="mailto:{{ $coach->email }}" class="flex items-center gap-2 text-primary-200 hover:text-accent-400 transition-colors">
                                    <i class="fas fa-envelope"></i>
                                    <span>{{ $coach->email }}</span>
                                </a>
                            @endif
                            @if($coach->phone)
                                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $coach->phone) }}" class="flex items-center gap-2 text-primary-200 hover:text-accent-400 transition-colors">
                                    <i class="fas fa-phone"></i>
                                    <span>{{ $coach->phone }}</span>
                                </a>
                            @endif
                        </div>
                    @endif

                    @if($coach->social_links && count($coach->social_links) > 0)
                        <div class="flex items-center gap-4">
                            @foreach($coach->social_links as $platform => $url)
                                <a href="{{ $url }}" target="_blank" rel="noopener noreferrer" 
                                   class="w-10 h-10 flex items-center justify-center rounded-full bg-white/10 border border-white/20 hover:bg-accent-500 hover:border-accent-500 transition-all duration-300">
                                    @if($platform === 'linkedin')
                                        <i class="fab fa-linkedin-in text-white"></i>
                                    @elseif($platform === 'facebook')
                                        <i class="fab fa-facebook-f text-white"></i>
                                    @elseif($platform === 'twitter' || $platform === 'x')
                                        <i class="fab fa-twitter text-white"></i>
                                    @elseif($platform === 'instagram')
                                        <i class="fab fa-instagram text-white"></i>
                                    @elseif($platform === 'youtube')
                                        <i class="fab fa-youtube text-white"></i>
                                    @else
                                        <i class="fas fa-link text-white"></i>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
                
                <div class="hidden lg:block animate-on-scroll">
                    <div class="relative">
                        <div class="absolute inset-0 bg-gradient-to-br from-accent-400 to-accent-600 rounded-2xl transform rotate-6"></div>
                        <div class="relative bg-primary-900 rounded-2xl p-8 aspect-square flex items-center justify-center overflow-hidden">
                            @if($coach->photo)
                                <img src="{{ asset('storage/' . $coach->photo) }}" 
                                     alt="{{ $coach->name }}" 
                                     class="w-full h-full object-cover rounded-2xl">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-primary-800 rounded-2xl">
                                    <i class="fas fa-user text-white text-8xl"></i>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-16 lg:py-24 bg-white">
        <div class="container">
            <div class="grid lg:grid-cols-3 gap-12">
                <!-- Sidebar -->
                <aside class="lg:col-span-1">
                    <div class="sticky top-24 space-y-6">
                        <!-- Photo (Mobile) -->
                        <div class="lg:hidden mb-6">
                            @if($coach->photo)
                                <img src="{{ asset('storage/' . $coach->photo) }}" 
                                     alt="{{ $coach->name }}" 
                                     class="w-full rounded-2xl shadow-xl">
                            @endif
                        </div>

                        <!-- Contact Card -->
                        <div class="bg-gradient-to-br from-primary-50 to-white rounded-xl shadow-lg p-6 border border-primary-100">
                            <h3 class="text-lg font-bold text-primary-900 mb-4">Get in Touch</h3>
                            @if($coach->email)
                                <a href="mailto:{{ $coach->email }}" class="flex items-center gap-3 mb-3 text-gray-700 hover:text-primary-600 transition-colors">
                                    <i class="fas fa-envelope text-primary-600"></i>
                                    <span>{{ $coach->email }}</span>
                                </a>
                            @endif
                            @if($coach->phone)
                                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $coach->phone) }}" class="flex items-center gap-3 mb-3 text-gray-700 hover:text-primary-600 transition-colors">
                                    <i class="fas fa-phone text-primary-600"></i>
                                    <span>{{ $coach->phone }}</span>
                                </a>
                            @endif
                            @if($coach->location)
                                <div class="flex items-center gap-3 text-gray-700">
                                    <i class="fas fa-map-marker-alt text-primary-600"></i>
                                    <span>{{ $coach->location }}</span>
                                </div>
                            @endif
                        </div>

                        <!-- Credentials -->
                        @if($coach->credentials && count($coach->credentials) > 0)
                            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                                <h3 class="text-lg font-bold text-primary-900 mb-4">Credentials</h3>
                                <ul class="space-y-2">
                                    @foreach($coach->credentials as $credential)
                                        <li class="flex items-center gap-2 text-gray-700">
                                            <i class="fas fa-check-circle text-accent-500"></i>
                                            <span>{{ $credential }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Specializations -->
                        @if($coach->specializations && count($coach->specializations) > 0)
                            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                                <h3 class="text-lg font-bold text-primary-900 mb-4">Specializations</h3>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($coach->specializations as $specialization)
                                        <span class="px-3 py-1 bg-primary-100 text-primary-700 rounded-full text-sm font-medium">
                                            {{ $specialization }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </aside>

                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Full Description -->
                    @if($coach->description)
                        <div class="prose prose-lg max-w-none">
                            <div class="text-gray-700 leading-relaxed">
                                {!! $coach->description !!}
                            </div>
                        </div>
                    @endif

                    <!-- Experience -->
                    @if($coach->experience)
                        <div class="bg-gradient-to-br from-primary-50 to-white rounded-xl shadow-lg p-8 border border-primary-100">
                            <h2 class="text-2xl font-bold text-primary-900 mb-4 flex items-center gap-3">
                                <i class="fas fa-briefcase text-accent-500"></i>
                                Experience
                            </h2>
                            <div class="text-gray-700 whitespace-pre-line leading-relaxed">
                                {{ $coach->experience }}
                            </div>
                        </div>
                    @endif

                    <!-- Education -->
                    @if($coach->education)
                        <div class="bg-white rounded-xl shadow-lg p-8 border border-gray-100">
                            <h2 class="text-2xl font-bold text-primary-900 mb-4 flex items-center gap-3">
                                <i class="fas fa-graduation-cap text-accent-500"></i>
                                Education
                            </h2>
                            <div class="text-gray-700 whitespace-pre-line leading-relaxed">
                                {{ $coach->education }}
                            </div>
                        </div>
                    @endif

                    <!-- Certifications -->
                    @if($coach->certifications)
                        <div class="bg-white rounded-xl shadow-lg p-8 border border-gray-100">
                            <h2 class="text-2xl font-bold text-primary-900 mb-4 flex items-center gap-3">
                                <i class="fas fa-certificate text-accent-500"></i>
                                Certifications
                            </h2>
                            <div class="text-gray-700 whitespace-pre-line leading-relaxed">
                                {{ $coach->certifications }}
                            </div>
                        </div>
                    @endif

                    <!-- Coaching Style -->
                    @if($coach->coaching_style)
                        <div class="bg-gradient-to-br from-accent-50 to-white rounded-xl shadow-lg p-8 border border-accent-100">
                            <h2 class="text-2xl font-bold text-primary-900 mb-4 flex items-center gap-3">
                                <i class="fas fa-heart text-accent-500"></i>
                                Coaching Style
                            </h2>
                            <p class="text-gray-700 text-lg font-medium">
                                {{ $coach->coaching_style }}
                            </p>
                        </div>
                    @endif

                    <!-- Testimonials -->
                    @if($coach->testimonials)
                        <div class="bg-white rounded-xl shadow-lg p-8 border border-gray-100">
                            <h2 class="text-2xl font-bold text-primary-900 mb-4 flex items-center gap-3">
                                <i class="fas fa-quote-left text-accent-500"></i>
                                Testimonials
                            </h2>
                            <div class="text-gray-700 whitespace-pre-line leading-relaxed italic">
                                {{ $coach->testimonials }}
                            </div>
                        </div>
                    @endif

                    <!-- CTA Section -->
                    <div class="bg-gradient-to-r from-primary-600 to-primary-800 rounded-xl shadow-xl p-8 text-white text-center">
                        <h3 class="text-2xl font-bold mb-4">Ready to Start Your Journey?</h3>
                        <p class="text-primary-100 mb-6">Let's work together to achieve your goals</p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="{{ route('contact') }}" class="btn btn-accent btn-large">
                                <i class="fas fa-envelope mr-2"></i> Contact Me
                            </a>
                            <a href="{{ route('programs.index') }}" class="btn bg-white text-primary-600 hover:bg-primary-50 btn-large">
                                <i class="fas fa-graduation-cap mr-2"></i> View Programs
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
