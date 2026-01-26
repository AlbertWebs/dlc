@extends('layouts.app')

@php
    $pageTitle = 'Kenya Life Coach Certification – Kenya\'s top life coaching school offering internationally certified training, breakthrough coaching, and online programs to help you become a powerful coach.';
    $pageDescription = 'Kenya\'s top life coaching school offering internationally certified training, breakthrough coaching, and online programs to help you become a powerful coach.';
    $pageImage = asset('images/og-image.jpg');
    $pageType = 'website';
@endphp

@section('content')
    <!-- Hero Section -->
    @php
        try {
            $heroBanner = \App\Models\HeroBanner::where('is_active', true)->where('location', 'home')->first();
            $heroType = \App\Models\Setting::get('hero_type', 'slider');
        } catch (\Exception $e) {
            $heroBanner = null;
            $heroType = 'slider';
        }
    @endphp
    
    @if($heroType === 'fullwidth-video' && $heroBanner && $heroBanner->media_type === 'video' && ($heroBanner->video_file || $heroBanner->video_url))
        <!-- Full Width Video Hero -->
        <section class="relative w-full h-screen min-h-[600px] max-h-[900px] overflow-hidden">
            <!-- Video Background -->
            <div class="absolute inset-0 w-full h-full">
                @if($heroBanner->video_file)
                    <video autoplay muted loop playsinline class="w-full h-full object-cover">
                        <source src="{{ asset('storage/' . $heroBanner->video_file) }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                @elseif($heroBanner->video_url)
                    @php
                        $videoUrl = $heroBanner->video_url;
                        // Check if it's a direct video URL
                        if (preg_match('/\.(mp4|webm|ogg)$/i', $videoUrl)) {
                            $isDirectVideo = true;
                        } else {
                            $isDirectVideo = false;
                        }
                    @endphp
                    @if($isDirectVideo)
                        <video autoplay muted loop playsinline class="w-full h-full object-cover">
                            <source src="{{ $videoUrl }}" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    @else
                        {{-- For YouTube/Vimeo, we'll use a background image fallback or iframe --}}
                        <div class="w-full h-full bg-primary-900"></div>
                    @endif
                @endif
            </div>

            <!-- Content Overlay -->
            <div class="relative z-10 h-full flex items-center justify-center">
                <div class="container mx-auto px-4 lg:px-6">
                    <div class="max-w-4xl mx-auto text-center text-white relative px-6 py-8 md:px-8 md:py-10">
                        <!-- Dark Overlay for better text readability - only behind text content -->
                        <div class="absolute inset-0 bg-black/50 rounded-lg -z-10"></div>
                        <h1 class="text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-bold mb-5 leading-tight animate-fade-in relative z-10">
                            @if($heroBanner && $heroBanner->title)
                                @php
                                    $title = $heroBanner->title;
                                    if (stripos($title, 'Professional Coaching') !== false) {
                                        $parts = preg_split('/(Professional Coaching)/i', $title, -1, PREG_SPLIT_DELIM_CAPTURE);
                                        echo e($parts[0] ?? '');
                                        if (isset($parts[1])) {
                                            echo '<span class="text-accent-400 font-accent italic">' . e($parts[1]) . '</span>';
                                        }
                                        echo e($parts[2] ?? '');
                                    } else {
                                        echo e($title);
                                    }
                                @endphp
                            @else
                                Transform Your Life Through 
                                <span class="text-accent-400 font-accent italic">Professional Coaching</span>
                            @endif
                        </h1>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center animate-fade-in-delay-2 relative z-10">
                            @if($heroBanner && $heroBanner->cta_text && $heroBanner->cta_link)
                                <a href="{{ $heroBanner->cta_link }}" class="btn btn-accent text-base px-6 py-3 shadow-2xl hover:shadow-accent-500/50 transform hover:scale-105 transition-all duration-300">
                                    {{ $heroBanner->cta_text }}
                                </a>
                            @else
                                <a href="{{ route('contact') }}" class="btn btn-accent text-base px-6 py-3 shadow-2xl hover:shadow-accent-500/50 transform hover:scale-105 transition-all duration-300">
                                    Start Your Journey
                                </a>
                            @endif
                            @if($heroBanner && $heroBanner->secondary_cta_text && $heroBanner->secondary_cta_link)
                                <a href="{{ $heroBanner->secondary_cta_link }}" class="btn bg-white/10 backdrop-blur-sm text-white border-2 border-white/30 hover:bg-white/20 text-base px-6 py-3 shadow-2xl transform hover:scale-105 transition-all duration-300">
                                    {{ $heroBanner->secondary_cta_text }}
                                </a>
                            @else
                                <a href="{{ route('programs.index') }}" class="btn bg-white/10 backdrop-blur-sm text-white border-2 border-white/30 hover:bg-white/20 text-base px-6 py-3 shadow-2xl transform hover:scale-105 transition-all duration-300">
                                    Learn More
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Scroll Indicator -->
            <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-10">
                <button type="button" onclick="scrollToNextSection()" class="flex flex-col items-center gap-2 scroll-indicator cursor-pointer focus:outline-none focus:ring-2 focus:ring-white/50 rounded-full p-1">
                    <div class="w-10 h-10 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 flex items-center justify-center shadow-lg hover:bg-white/20 active:bg-white/30 transition-all duration-300 group">
                        <i class="fas fa-chevron-down text-white text-sm opacity-90 group-hover:opacity-100 transform group-hover:translate-y-0.5 transition-all duration-300"></i>
                    </div>
                    <div class="w-0.5 h-8 bg-gradient-to-b from-white/60 to-transparent"></div>
                </button>
            </div>
        </section>
    @else
        <!-- Normal Slider Hero -->
        <section class="relative bg-gradient-to-br from-primary-50 to-white pt-12 pb-20 lg:pt-20 lg:pb-32 overflow-hidden">
        <div class="container">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="fade-in">
                    <h1 class="text-4xl lg:text-5xl xl:text-6xl font-bold text-primary-900 mb-6 leading-tight">
                        @if($heroBanner && $heroBanner->title)
                            @php
                                // Check if title contains "Professional Coaching" or similar pattern for accent styling
                                $title = $heroBanner->title;
                                if (stripos($title, 'Professional Coaching') !== false) {
                                    $parts = preg_split('/(Professional Coaching)/i', $title, -1, PREG_SPLIT_DELIM_CAPTURE);
                                    echo e($parts[0] ?? '');
                                    if (isset($parts[1])) {
                                        echo '<span class="text-accent-500 font-accent italic">' . e($parts[1]) . '</span>';
                                    }
                                    echo e($parts[2] ?? '');
                                } else {
                                    echo e($title);
                                }
                            @endphp
                        @else
                            Transform Your Life Through 
                            <span class="text-accent-500 font-accent italic">Professional Coaching</span>
                        @endif
                    </h1>
                    <p class="text-xl text-gray-600 mb-8 leading-relaxed">
                        {{ $heroBanner && $heroBanner->subtitle ? $heroBanner->subtitle : 'Unlock your potential with certified coaching programs designed to help you achieve your personal and professional goals.' }}
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        @if($heroBanner && $heroBanner->cta_text && $heroBanner->cta_link)
                            <a href="{{ $heroBanner->cta_link }}" class="btn btn-accent btn-large">
                                {{ $heroBanner->cta_text }}
                            </a>
                        @else
                            <a href="{{ route('contact') }}" class="btn btn-accent btn-large">
                                Start Your Journey
                            </a>
                        @endif
                        @if($heroBanner && $heroBanner->secondary_cta_text && $heroBanner->secondary_cta_link)
                            <a href="{{ $heroBanner->secondary_cta_link }}" class="btn btn-secondary btn-large">
                                {{ $heroBanner->secondary_cta_text }}
                            </a>
                        @else
                            <a href="{{ route('programs.index') }}" class="btn btn-secondary btn-large">
                                Learn More
                            </a>
                        @endif
                    </div>
                    <div class="grid grid-cols-3 gap-6 mt-12">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-primary-600">10,000+</div>
                            <div class="text-sm text-gray-600 mt-1">Lives Transformed</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-primary-600">500+</div>
                            <div class="text-sm text-gray-600 mt-1">Certified Coaches</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-primary-600">50+</div>
                            <div class="text-sm text-gray-600 mt-1">Programs Available</div>
                        </div>
                    </div>
                </div>
                <div class="hidden lg:block animate-on-scroll">
                    <div class="relative">
                        @if($heroBanner && $heroBanner->media_type === 'video' && $heroBanner->video_url)
                            @php
                                $videoUrl = $heroBanner->video_url;
                                $embedUrl = '';
                                if (strpos($videoUrl, 'youtube.com/watch') !== false || strpos($videoUrl, 'youtu.be/') !== false) {
                                    preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&\n?#]+)/', $videoUrl, $matches);
                                    if (isset($matches[1])) {
                                        $embedUrl = 'https://www.youtube.com/embed/' . $matches[1] . '?autoplay=1&mute=1&loop=1&playlist=' . $matches[1];
                                    }
                                } elseif (strpos($videoUrl, 'vimeo.com/') !== false) {
                                    preg_match('/vimeo\.com\/(\d+)/', $videoUrl, $matches);
                                    if (isset($matches[1])) {
                                        $embedUrl = 'https://player.vimeo.com/video/' . $matches[1] . '?autoplay=1&muted=1&loop=1';
                                    }
                                }
                            @endphp
                            @if($embedUrl)
                                <div class="absolute inset-0 bg-gradient-to-br from-accent-400 to-accent-600 rounded-2xl transform rotate-6"></div>
                                <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                                    <div class="aspect-video">
                                        <iframe src="{{ $embedUrl }}" 
                                                frameborder="0" 
                                                allow="autoplay; fullscreen; picture-in-picture" 
                                                allowfullscreen
                                                class="w-full h-full rounded-2xl"></iframe>
                                    </div>
                                </div>
                            @else
                                <div class="absolute inset-0 bg-gradient-to-br from-accent-400 to-accent-600 rounded-2xl transform rotate-6"></div>
                                <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                                    <div class="aspect-video">
                                        <video src="{{ $videoUrl }}" 
                                               autoplay 
                                               muted 
                                               loop 
                                               playsinline
                                               class="w-full h-full object-cover rounded-2xl"></video>
                                    </div>
                                </div>
                            @endif
                        @elseif($heroBanner && $heroBanner->image)
                            <div class="absolute inset-0 bg-gradient-to-br from-accent-400 to-accent-600 rounded-2xl transform rotate-6"></div>
                            <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                                @php
                                    $imageUrl = $heroBanner->image;
                                    if (strpos($imageUrl, 'http') !== 0 && strpos($imageUrl, '/') !== 0) {
                                        $imageUrl = asset('storage/' . $imageUrl);
                                    }
                                @endphp
                                <img src="{{ $imageUrl }}" 
                                     alt="{{ $heroBanner->title }}"
                                     class="w-full h-full object-cover rounded-2xl aspect-square">
                            </div>
                        @else
                            <div class="absolute inset-0 bg-gradient-to-br from-accent-400 to-accent-600 rounded-2xl transform rotate-6"></div>
                            <div class="relative bg-primary-900 rounded-2xl p-8 aspect-square flex items-center justify-center">
                                <i class="fas fa-user-graduate text-white text-8xl"></i>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- Who We Are Section -->
    <section class="relative py-20 lg:py-32 bg-gradient-to-br from-white via-primary-50/30 to-white overflow-hidden">
        <!-- Decorative Background Elements -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-accent-500/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-primary-500/5 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2"></div>
        
        <div class="container relative z-10">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                <!-- Image Section -->
                <div class="order-2 lg:order-1 animate-on-scroll">
                    <div class="relative">
                        <!-- Decorative Elements -->
                        <div class="absolute -top-6 -left-6 w-full h-full bg-gradient-to-br from-accent-400 to-accent-600 rounded-3xl transform rotate-3 opacity-20"></div>
                        <div class="absolute -bottom-6 -right-6 w-full h-full bg-gradient-to-br from-primary-600 to-primary-800 rounded-3xl transform -rotate-3 opacity-20"></div>
                        
                        <!-- Main Media Container -->
                        <div class="relative rounded-3xl overflow-hidden shadow-2xl transform hover:scale-[1.02] transition-transform duration-500">
                            <div class="aspect-[4/3] bg-gradient-to-br from-primary-700 to-primary-900">
                                @php
                                    // Try to get video or image from settings
                                    $aboutVideo = \App\Models\Setting::get('about_section_video_file', '');
                                    $aboutImageFile = \App\Models\Setting::get('about_section_image_file', '');
                                    $aboutImageUrl = \App\Models\Setting::get('about_section_image', '');
                                    // Use uploaded file if exists, otherwise use URL
                                    $aboutImage = $aboutImageFile ? asset('storage/' . $aboutImageFile) : ($aboutImageUrl && !str_starts_with($aboutImageUrl, 'who-we-are/') ? $aboutImageUrl : null);
                                @endphp
                                @if($aboutVideo)
                                    <video autoplay muted loop playsinline class="w-full h-full object-cover">
                                        <source src="{{ asset('storage/' . $aboutVideo) }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                @elseif($aboutImage)
                                    <img src="{{ $aboutImage }}" 
                                         alt="Who We Are" 
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-primary-700 via-primary-800 to-primary-900">
                                        <div class="text-center text-white p-8">
                                            <i class="fas fa-users text-6xl lg:text-8xl mb-4 opacity-50"></i>
                                            <p class="text-lg font-medium opacity-75">Add Image or Video in Settings</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <!-- Overlay Gradient -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent"></div>
                        </div>
                        
                        <!-- Floating Stats Card -->
                        <div class="absolute -bottom-6 -right-6 lg:-right-12 bg-white rounded-2xl shadow-2xl p-6 border-2 border-accent-500/20 transform hover:scale-105 transition-transform duration-300">
                            <div class="flex items-center gap-4">
                                <div class="w-16 h-16 bg-gradient-to-br from-accent-400 to-accent-600 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-trophy text-white text-2xl"></i>
                                </div>
                                <div>
                                    <div class="text-3xl font-bold text-primary-900">{{ \App\Models\Setting::get('about_section_stats_number', '10,000+') }}</div>
                                    <div class="text-sm text-gray-600 font-medium">{{ \App\Models\Setting::get('about_section_stats_label', 'Lives Transformed') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content Section -->
                <div class="order-1 lg:order-2 animate-on-scroll">
                    <div class="inline-block mb-4">
                        <span class="px-4 py-2 bg-accent-500/10 border border-accent-500/30 rounded-full text-accent-600 font-semibold text-sm uppercase tracking-wider">
                            Who We Are
                        </span>
                    </div>
                    
                    <h2 class="text-4xl lg:text-5xl xl:text-6xl font-bold text-primary-900 mb-6 leading-tight">
                        @php
                            $aboutTitle = \App\Models\Setting::get('about_section_title', 'Empowering Lives Through Expert Coaching');
                            if (stripos($aboutTitle, 'Expert Coaching') !== false) {
                                $parts = preg_split('/(Expert Coaching)/i', $aboutTitle, -1, PREG_SPLIT_DELIM_CAPTURE);
                                echo e($parts[0] ?? '');
                                if (isset($parts[1])) {
                                    echo '<span class="text-accent-500 font-accent italic">' . e($parts[1]) . '</span>';
                                }
                                echo e($parts[2] ?? '');
                            } else {
                                echo e($aboutTitle);
                            }
                        @endphp
                    </h2>
                    
                    <p class="text-xl text-gray-700 mb-8 leading-relaxed">
                        {{ \App\Models\Setting::get('about_section_subtitle', 'We are a leading coaching organization dedicated to helping individuals unlock their full potential through personalized guidance, proven methodologies, and comprehensive certification programs.') }}
                    </p>
                    
                    <p class="text-lg text-gray-600 mb-10 leading-relaxed">
                        {{ \App\Models\Setting::get('about_section_description', 'Our mission is to transform lives by providing world-class coaching education and support. With years of experience and a commitment to excellence, we\'ve helped thousands of individuals achieve their personal and professional goals.') }}
                    </p>

                    <!-- Feature Points -->
                    <div class="space-y-4 mb-10">
                        @php
                            $feature1Title = \App\Models\Setting::get('about_section_feature_1_title', 'Internationally Certified Programs');
                            $feature1Desc = \App\Models\Setting::get('about_section_feature_1_description', 'Globally recognized certifications that open doors to new opportunities');
                            $feature2Title = \App\Models\Setting::get('about_section_feature_2_title', 'Expert Coaching Team');
                            $feature2Desc = \App\Models\Setting::get('about_section_feature_2_description', 'Learn from experienced professionals with proven track records');
                            $feature3Title = \App\Models\Setting::get('about_section_feature_3_title', 'Proven Results & Success Stories');
                            $feature3Desc = \App\Models\Setting::get('about_section_feature_3_description', 'Join thousands who have transformed their lives through our programs');
                        @endphp
                        
                        @if($feature1Title)
                        <div class="flex items-start gap-4 group">
                            <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-accent-400 to-accent-600 rounded-xl flex items-center justify-center transform group-hover:scale-110 transition-transform duration-300 shadow-lg">
                                <i class="fas fa-check text-white text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-primary-900 mb-1">{{ $feature1Title }}</h3>
                                <p class="text-gray-600">{{ $feature1Desc }}</p>
                            </div>
                        </div>
                        @endif
                        
                        @if($feature2Title)
                        <div class="flex items-start gap-4 group">
                            <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-primary-600 to-primary-800 rounded-xl flex items-center justify-center transform group-hover:scale-110 transition-transform duration-300 shadow-lg">
                                <i class="fas fa-check text-white text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-primary-900 mb-1">{{ $feature2Title }}</h3>
                                <p class="text-gray-600">{{ $feature2Desc }}</p>
                            </div>
                        </div>
                        @endif
                        
                        @if($feature3Title)
                        <div class="flex items-start gap-4 group">
                            <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-accent-400 to-accent-600 rounded-xl flex items-center justify-center transform group-hover:scale-110 transition-transform duration-300 shadow-lg">
                                <i class="fas fa-check text-white text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-primary-900 mb-1">{{ $feature3Title }}</h3>
                                <p class="text-gray-600">{{ $feature3Desc }}</p>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- CTA Button -->
                    @php
                        $buttonText = \App\Models\Setting::get('about_section_button_text', 'Learn More About Us');
                        $buttonLink = \App\Models\Setting::get('about_section_button_link', route('about'));
                    @endphp
                    @if($buttonText && $buttonLink)
                        <a href="{{ $buttonLink }}" class="inline-flex items-center gap-3 btn btn-primary btn-large group">
                            <span>{{ $buttonText }}</span>
                            <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform duration-300"></i>
                        </a>
                    @endif
                </div>
            </div>

            <!-- Stats Section -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 lg:gap-8 mt-16 lg:mt-24">
                @php
                    $stat1Number = \App\Models\Setting::get('about_section_stat1_number', '500+');
                    $stat1Label = \App\Models\Setting::get('about_section_stat1_label', 'COACHES TRAINED');
                    $stat2Number = \App\Models\Setting::get('about_section_stat2_number', '10+');
                    $stat2Label = \App\Models\Setting::get('about_section_stat2_label', 'BOOKS WRITTEN');
                    $stat3Number = \App\Models\Setting::get('about_section_stat3_number', '18+');
                    $stat3Label = \App\Models\Setting::get('about_section_stat3_label', 'YEARS Experience');
                    $stat4Number = \App\Models\Setting::get('about_section_stat4_number', '4,000+');
                    $stat4Label = \App\Models\Setting::get('about_section_stat4_label', 'CLIENTS');
                @endphp
                <div class="text-center p-6 bg-white/80 backdrop-blur-sm rounded-2xl border border-primary-100 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 animate-on-scroll">
                    <div class="text-4xl lg:text-5xl font-bold bg-gradient-to-r from-primary-600 to-primary-800 bg-clip-text text-transparent mb-2">{{ $stat1Number }}</div>
                    <div class="text-sm lg:text-base text-gray-600 font-medium">{{ $stat1Label }}</div>
                </div>
                <div class="text-center p-6 bg-white/80 backdrop-blur-sm rounded-2xl border border-primary-100 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 animate-on-scroll">
                    <div class="text-4xl lg:text-5xl font-bold bg-gradient-to-r from-accent-500 to-accent-600 bg-clip-text text-transparent mb-2">{{ $stat2Number }}</div>
                    <div class="text-sm lg:text-base text-gray-600 font-medium">{{ $stat2Label }}</div>
                </div>
                <div class="text-center p-6 bg-white/80 backdrop-blur-sm rounded-2xl border border-primary-100 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 animate-on-scroll">
                    <div class="text-4xl lg:text-5xl font-bold bg-gradient-to-r from-primary-600 to-primary-800 bg-clip-text text-transparent mb-2">{{ $stat3Number }}</div>
                    <div class="text-sm lg:text-base text-gray-600 font-medium">{{ $stat3Label }}</div>
                </div>
                <div class="text-center p-6 bg-white/80 backdrop-blur-sm rounded-2xl border border-primary-100 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 animate-on-scroll">
                    <div class="text-4xl lg:text-5xl font-bold bg-gradient-to-r from-accent-500 to-accent-600 bg-clip-text text-transparent mb-2">{{ $stat4Number }}</div>
                    <div class="text-sm lg:text-base text-gray-600 font-medium">{{ $stat4Label }}</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Programs Section -->
    <section class="section bg-gradient-to-br from-white via-primary-50/30 to-white relative overflow-hidden">
        <!-- Decorative Background Elements -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-accent-500/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-primary-500/5 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2"></div>
        
        <div class="container relative z-10">
            <div class="text-center mb-16 animate-on-scroll">
                <div class="inline-block mb-4">
                    <span class="px-4 py-2 bg-accent-500/10 border border-accent-500/30 rounded-full text-accent-600 font-semibold text-sm uppercase tracking-wider">
                        Our Programs
                    </span>
                </div>
                <h2 class="text-3xl lg:text-4xl xl:text-5xl font-bold text-primary-900 mt-4 mb-6">
                    Coaching Programs That <span class="text-accent-500 font-accent italic">Transform</span>
                </h2>
                <p class="text-lg md:text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Choose from our comprehensive range of coaching programs designed to meet your unique needs and goals.
                </p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
                @php
                    try {
                        $programs = \App\Models\Program::where('is_published', true)->orderBy('order')->limit(3)->get();
                    } catch (\Exception $e) {
                        $programs = collect([]);
                    }
                @endphp
                @forelse($programs as $program)
                    @php
                        // Get image URL
                        $imageUrl = null;
                        if ($program->image) {
                            $imageUrl = str_starts_with($program->image, 'http') 
                                ? $program->image 
                                : asset('storage/' . $program->image);
                        }
                        
                        // Clean slug - fix broken slugs
                        $slug = $program->slug;
                        if (str_contains($slug, 'httplocalhost') || str_contains($slug, 'http://') || str_contains($slug, 'https://')) {
                            $slug = \Illuminate\Support\Str::slug($program->title);
                        }
                        
                        // Get excerpt or description
                        $excerpt = $program->excerpt ?? strip_tags($program->description ?? '');
                        $excerpt = \Illuminate\Support\Str::limit($excerpt, 120);
                    @endphp
                    <div class="group relative animate-on-scroll">
                        <!-- Card Container -->
                        <div class="relative bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3 border border-gray-100 h-full flex flex-col">
                            <!-- Image Section -->
                            <div class="relative h-56 overflow-hidden bg-gradient-to-br from-primary-600 to-primary-800">
                                @if($imageUrl)
                                    <img src="{{ $imageUrl }}" 
                                         alt="{{ $program->title }}" 
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                         onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                    <div class="w-full h-full bg-gradient-to-br from-primary-600 to-primary-800 flex items-center justify-center hidden">
                                        <i class="fas {{ $program->icon ?? 'fa-briefcase' }} text-5xl text-white opacity-50"></i>
                                    </div>
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-primary-600 via-primary-700 to-primary-800 flex items-center justify-center relative">
                                        <i class="fas {{ $program->icon ?? 'fa-briefcase' }} text-5xl text-white opacity-50 group-hover:opacity-70 transition-opacity"></i>
                                        <!-- Decorative Pattern -->
                                        <div class="absolute inset-0 opacity-10">
                                            <div class="absolute top-4 left-4 w-20 h-20 border-2 border-white rounded-lg rotate-12"></div>
                                            <div class="absolute bottom-4 right-4 w-16 h-16 border-2 border-white rounded-full"></div>
                                        </div>
                                    </div>
                                @endif
                                
                                <!-- Overlay Gradient -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                
                                <!-- Icon Badge -->
                                <div class="absolute top-4 right-4 w-12 h-12 bg-white/90 backdrop-blur-sm rounded-xl flex items-center justify-center shadow-lg transform group-hover:scale-110 group-hover:rotate-6 transition-all duration-300">
                                    <i class="fas {{ $program->icon ?? 'fa-briefcase' }} text-primary-600 text-lg"></i>
                                </div>
                                
                                <!-- Price Badge (if available) -->
                                @if($program->price)
                                    <div class="absolute bottom-4 left-4 px-4 py-2 bg-accent-500 text-primary-900 font-bold rounded-lg shadow-lg transform group-hover:scale-105 transition-transform">
                                        {{ $program->currency ?? 'KES' }} {{ number_format($program->price) }}
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Content Section -->
                            <div class="p-7 flex-1 flex flex-col">
                                <h3 class="text-2xl font-bold text-primary-900 mb-4 group-hover:text-primary-700 transition-colors line-clamp-2 leading-tight">
                                    {{ $program->title }}
                                </h3>
                                
                                @if($excerpt)
                                    <p class="text-gray-600 mb-6 flex-1 leading-relaxed text-base line-clamp-4">
                                        {{ $excerpt }}
                                    </p>
                                @endif
                                
                                <!-- Features Preview (if available) -->
                                @if($program->features && count($program->features) > 0)
                                    <div class="mb-6 pb-6 border-b border-gray-100">
                                        <ul class="space-y-2.5">
                                            @foreach(array_slice($program->features, 0, 3) as $feature)
                                                <li class="flex items-start gap-3 text-sm text-gray-700">
                                                    <i class="fas fa-check-circle text-accent-500 text-sm mt-0.5 flex-shrink-0"></i>
                                                    <span class="line-clamp-2">{{ $feature }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                
                                <!-- CTA Button -->
                                <a href="{{ route('programs.show', $slug) }}" 
                                   class="inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-gradient-to-r from-primary-600 to-primary-700 text-white font-semibold rounded-xl hover:from-primary-700 hover:to-primary-800 transform hover:scale-105 transition-all duration-300 shadow-md hover:shadow-lg group/btn text-base">
                                    <span>Learn More</span>
                                    <i class="fas fa-arrow-right transform group-hover/btn:translate-x-1 transition-transform"></i>
                                </a>
                            </div>
                            
                            <!-- Hover Border Effect -->
                            <div class="absolute inset-0 border-2 border-accent-500 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none"></div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-16">
                        <div class="inline-block p-8 bg-gray-50 rounded-2xl border-2 border-dashed border-gray-300">
                            <i class="fas fa-graduation-cap text-5xl text-gray-400 mb-4"></i>
                            <p class="text-gray-500 text-lg">No programs available at this time.</p>
                        </div>
                    </div>
                @endforelse
            </div>
            
            <!-- View All Programs Link -->
            @if($programs->count() > 0)
                <div class="text-center mt-12 animate-on-scroll">
                    <a href="{{ route('programs.index') }}" 
                       class="inline-flex items-center gap-3 px-8 py-4 bg-white border-2 border-primary-600 text-primary-600 font-semibold rounded-xl hover:bg-primary-600 hover:text-white transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                        <span>View All Programs</span>
                        <i class="fas fa-arrow-right transform group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- Rewire Your Mind Section -->
    <section class="relative py-16 md:py-24 lg:py-32 overflow-hidden bg-gradient-to-br from-primary-900 via-primary-800 to-primary-950 text-white">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-0 left-0 w-64 md:w-96 h-64 md:h-96 bg-accent-500/10 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2 animate-pulse"></div>
            <div class="absolute bottom-0 right-0 w-64 md:w-96 h-64 md:h-96 bg-accent-400/10 rounded-full blur-3xl translate-x-1/2 translate-y-1/2 animate-pulse" style="animation-delay: 1s;"></div>
            <div class="absolute top-1/2 left-1/2 w-64 md:w-96 h-64 md:h-96 bg-primary-700/10 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
        </div>
        
        <!-- Pattern Overlay -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0" style="background-image: radial-gradient(circle, white 1px, transparent 1px); background-size: 40px 40px;"></div>
        </div>
        
        <!-- Accent Border Top -->
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-transparent via-accent-500 to-transparent"></div>
        
        <div class="container relative z-10 px-4 sm:px-6 lg:px-8">
            <div class="max-w-5xl mx-auto">
                <!-- Badge -->
                <div class="text-center mb-6 md:mb-8 animate-on-scroll">
                    <span class="inline-block px-4 md:px-6 py-2 md:py-2.5 bg-accent-500/20 border-2 border-accent-400/50 rounded-full text-accent-300 font-bold text-xs md:text-sm uppercase tracking-widest backdrop-blur-sm shadow-lg">
                        <i class="fas fa-star mr-2"></i>Destiny Life Coaching
                    </span>
                </div>
                
                <!-- Main Heading -->
                <div class="text-center mb-8 md:mb-12 animate-on-scroll">
                    <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-bold mb-4 md:mb-6 leading-tight px-4">
                        <span class="block mb-2">REWIRE YOUR MIND</span>
                        <span class="block text-accent-400 font-accent italic text-2xl sm:text-3xl md:text-4xl lg:text-5xl xl:text-6xl">WITH DESTINY LIFE COACHING</span>
                    </h2>
                </div>
                
                <!-- Content -->
                <div class="bg-white/5 backdrop-blur-md rounded-2xl md:rounded-3xl p-6 md:p-10 lg:p-12 xl:p-16 border border-white/10 shadow-2xl animate-on-scroll relative overflow-hidden">
                    <!-- Inner Glow Effect -->
                    <div class="absolute inset-0 bg-gradient-to-br from-accent-500/5 via-transparent to-primary-700/5 pointer-events-none"></div>
                    
                    <div class="relative z-10 prose prose-lg prose-invert max-w-none">
                        <p class="text-base sm:text-lg md:text-xl text-gray-100 leading-relaxed mb-5 md:mb-6">
                            <strong class="text-accent-400">Destiny Life Coaching Kenya</strong> is a leading provider of certified life coaching services designed to help you <strong class="text-accent-300">rewire your mind</strong>, break through limitations, and create the life you were born to live. As Kenya's top life coaching school, we deliver a unique, results-driven approach to <strong class="text-accent-300">personal transformation and mindset mastery</strong>.
                        </p>
                        
                        <p class="text-base sm:text-lg md:text-xl text-gray-100 leading-relaxed mb-5 md:mb-6">
                            Our team of <strong class="text-accent-400">ICR-certified life coaches in Kenya</strong> offers personalized one-on-one coaching tailored to your specific goals — whether you're pursuing a career shift, launching a new business, or seeking greater well-being and life balance.
                        </p>
                        
                        <p class="text-base sm:text-lg md:text-xl text-gray-100 leading-relaxed mb-6 md:mb-8 font-semibold">
                            At Destiny Life Coaching, we go beyond generic motivation. We help you:
                        </p>
                        
                        <!-- Benefits List -->
                        <div class="grid sm:grid-cols-1 md:grid-cols-2 gap-4 md:gap-6 mb-8 md:mb-10">
                            <div class="flex items-start gap-3 md:gap-4 group p-4 md:p-5 bg-white/5 rounded-xl hover:bg-white/10 transition-all duration-300">
                                <div class="flex-shrink-0 w-10 h-10 md:w-12 md:h-12 bg-gradient-to-br from-accent-400 to-accent-600 rounded-xl flex items-center justify-center transform group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 shadow-lg">
                                    <i class="fas fa-check text-white text-sm md:text-lg"></i>
                                </div>
                                <p class="text-base sm:text-lg text-gray-100 leading-relaxed pt-1 md:pt-2">
                                    Identify the areas of your life that need the most change.
                                </p>
                            </div>
                            
                            <div class="flex items-start gap-3 md:gap-4 group p-4 md:p-5 bg-white/5 rounded-xl hover:bg-white/10 transition-all duration-300">
                                <div class="flex-shrink-0 w-10 h-10 md:w-12 md:h-12 bg-gradient-to-br from-accent-400 to-accent-600 rounded-xl flex items-center justify-center transform group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 shadow-lg">
                                    <i class="fas fa-check text-white text-sm md:text-lg"></i>
                                </div>
                                <p class="text-base sm:text-lg text-gray-100 leading-relaxed pt-1 md:pt-2">
                                    Uncover and release limiting beliefs and patterns.
                                </p>
                            </div>
                            
                            <div class="flex items-start gap-3 md:gap-4 group p-4 md:p-5 bg-white/5 rounded-xl hover:bg-white/10 transition-all duration-300">
                                <div class="flex-shrink-0 w-10 h-10 md:w-12 md:h-12 bg-gradient-to-br from-accent-400 to-accent-600 rounded-xl flex items-center justify-center transform group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 shadow-lg">
                                    <i class="fas fa-check text-white text-sm md:text-lg"></i>
                                </div>
                                <p class="text-base sm:text-lg text-gray-100 leading-relaxed pt-1 md:pt-2">
                                    Create a customized, step-by-step action plan for success.
                                </p>
                            </div>
                            
                            <div class="flex items-start gap-3 md:gap-4 group p-4 md:p-5 bg-white/5 rounded-xl hover:bg-white/10 transition-all duration-300">
                                <div class="flex-shrink-0 w-10 h-10 md:w-12 md:h-12 bg-gradient-to-br from-accent-400 to-accent-600 rounded-xl flex items-center justify-center transform group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 shadow-lg">
                                    <i class="fas fa-check text-white text-sm md:text-lg"></i>
                                </div>
                                <p class="text-base sm:text-lg text-gray-100 leading-relaxed pt-1 md:pt-2">
                                    Build an empowering mindset that supports long-term results.
                                </p>
                            </div>
                        </div>
                        
                        <p class="text-base sm:text-lg md:text-xl text-gray-100 leading-relaxed mb-6 md:mb-8">
                            Our proven methods have helped hundreds of clients across Kenya and beyond to create lasting transformation in their personal and professional lives. Whether you're looking to <strong class="text-accent-400">become a certified life coach</strong>, find clarity in your next move, or transform your mindset, <strong class="text-accent-400">DLC Kenya</strong> is here to guide you every step of the way. We believe that every individual has the power to shape their own destiny — and we're here to help you do exactly that. Start your journey today with the <strong class="text-accent-400">best life coaching service in Kenya</strong> — and take the next step toward the future you truly deserve.
                        </p>
                    </div>
                    
                    <!-- CTA Button -->
                    <div class="text-center mt-8 md:mt-10 pt-6 md:pt-8 border-t border-white/10 relative z-10">
                        <a href="https://calendly.com/breakthrough101/clarity-call" 
                           target="_blank"
                           rel="noopener noreferrer"
                           class="inline-flex items-center gap-3 px-8 md:px-10 py-4 md:py-5 bg-gradient-to-r from-accent-500 via-accent-400 to-accent-500 text-primary-900 font-bold text-base md:text-lg rounded-xl hover:from-accent-400 hover:via-accent-300 hover:to-accent-400 transform hover:scale-105 active:scale-95 transition-all duration-300 shadow-2xl hover:shadow-accent-500/50 group w-full sm:w-auto justify-center">
                            <span>Visit Now</span>
                            <i class="fas fa-arrow-right transform group-hover:translate-x-2 transition-transform duration-300"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Decorative Elements -->
                <div class="absolute -top-10 -left-10 w-24 h-24 md:w-32 md:h-32 bg-accent-500/20 rounded-full blur-2xl hidden lg:block"></div>
                <div class="absolute -bottom-10 -right-10 w-24 h-24 md:w-32 md:h-32 bg-accent-400/20 rounded-full blur-2xl hidden lg:block"></div>
            </div>
        </div>
        
        <!-- Accent Border Bottom -->
        <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-transparent via-accent-500 to-transparent"></div>
    </section>

    <!-- Certified Life Coaching Kenya Section -->
    <section class="relative py-16 md:py-24 lg:py-32 bg-gradient-to-br from-white via-primary-50/30 to-white overflow-hidden">
        <!-- Decorative Background Elements -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-accent-500/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-primary-500/5 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2"></div>
        
        <div class="container relative z-10 px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 xl:gap-16 items-start">
                <!-- Left Column - Content -->
                <div class="animate-on-scroll space-y-8">
                    <!-- Main Heading -->
                    <div>
                        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-primary-900 mb-6 leading-tight">
                            Certified Life Coaching Kenya – <span class="text-accent-500 font-accent italic">Empower Your Mind, Transform Your Future</span>
                        </h2>
                        <p class="text-lg md:text-xl text-gray-700 leading-relaxed">
                            Our life coaching program in Kenya guides you through a powerful process of self-discovery, helping you set clear personal and professional goals, break limiting patterns, and take strategic action toward the life you truly want.
                        </p>
                    </div>
                    
                    <!-- About Life Coaching Heading -->
                    <div>
                        <h3 class="text-2xl md:text-3xl font-bold text-primary-900 mb-6">
                            About Life Coaching – What It Is and Why It Works.
                        </h3>
                        
                        <!-- Divider -->
                        <div class="w-24 h-1 bg-gradient-to-r from-accent-500 to-transparent mb-6"></div>
                        
                        <p class="text-lg md:text-xl text-gray-700 leading-relaxed mb-6">
                            Life coaching at <strong class="text-primary-700">Destiny Life Coaching Kenya</strong> goes beyond traditional guidance — it's a transformational journey led by certified coaches using our proven <strong class="text-accent-600">SHIFT Breakthrough Process™</strong>. This unique 5-step system is designed to help you gain deep awareness, release limiting beliefs, reprogram your mindset, reinvent your identity, and integrate lasting change. With expert support, clarity, and purpose, you'll move from stuck to unstoppable — and create the life you were born to live.
                        </p>
                        
                        <!-- Inner Content Box -->
                        <div class="bg-primary-50/50 rounded-2xl p-6 md:p-8 border-l-4 border-accent-500 shadow-lg">
                            <p class="text-base md:text-lg text-gray-700 leading-relaxed mb-4">
                                A professional <strong class="text-primary-700">life coach in Kenya</strong> uses powerful tools such as deep questioning, active listening, mindset reflection, and goal setting to help clients uncover their strengths, break through limitations, and design a clear action plan for success.
                            </p>
                            <p class="text-base md:text-lg text-gray-700 leading-relaxed">
                                Unlike therapy or counseling, which often focus on past trauma and emotional healing, <strong class="text-primary-700">life coaching is forward-focused</strong> — empowering individuals to take ownership of their future, align with their purpose, and achieve tangible personal and professional breakthroughs.
                            </p>
                        </div>
                    </div>
                </div>
                
                <!-- Right Column - Image and Content -->
                <div class="animate-on-scroll space-y-8">
                    <!-- Image -->
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl transform hover:scale-[1.02] transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-br from-accent-400/20 to-primary-600/20 rounded-2xl"></div>
                        <img src="https://dlc.co.ke/wp-content/uploads/elementor/thumbs/ChatGPT-Image-Jun-4-2025-09_46_15-PM-r6tq51fgwytx5tcd8q5z0yfio99kocnhl574kp0t76.png" 
                             alt="Breakthrough life coach" 
                             class="w-full h-auto object-cover rounded-2xl relative z-10"
                             loading="lazy"
                             onerror="this.onerror=null; this.src='{{ asset('storage/placeholder-coach.jpg') }}';">
                    </div>
                    
                    <!-- Content Text -->
                    <div class="bg-white rounded-2xl p-6 md:p-8 shadow-lg border border-gray-100">
                        <h3 class="text-2xl md:text-3xl font-bold text-primary-900 mb-6 leading-tight">
                            While therapy looks to the past, a <span class="text-accent-500">life coach in Kenya</span> helps you focus on what actually matters — the present and the future.
                        </h3>
                        <p class="text-lg text-gray-700 leading-relaxed mb-4">
                            At <strong class="text-primary-700">Destiny Life Coaching</strong>, we help you get clear on your vision, align with your deepest values, and take bold, focused action toward the goals that will truly move your life forward.
                        </p>
                        <p class="text-lg text-gray-700 leading-relaxed mb-4">
                            Whether you're looking to level up in your career, heal and grow in your relationships, improve your health, master your finances, or expand your personal development, our transformational life coaching services in Kenya are designed to help you unlock your next level — fast.
                        </p>
                        <p class="text-lg text-gray-700 leading-relaxed font-semibold">
                            This isn't just about talking.<br>
                            <span class="text-accent-600 text-xl">This is about becoming the person your future is waiting for.</span>
                        </p>
                    </div>
                    
                    <!-- Social Media Icons -->
                    <div class="flex items-center gap-4">
                        <span class="text-gray-600 font-medium text-sm md:text-base">Follow Us:</span>
                        <div class="flex gap-3">
                            @php
                                $socialFacebook = \App\Models\Setting::get('social_facebook', '');
                                $socialTwitter = \App\Models\Setting::get('social_twitter', '');
                                $socialLinkedin = \App\Models\Setting::get('social_linkedin', '');
                                $socialInstagram = \App\Models\Setting::get('social_instagram', '');
                            @endphp
                            
                            @if($socialFacebook)
                                <a href="{{ $socialFacebook }}" target="_blank" rel="noopener noreferrer" 
                                   class="w-12 h-12 bg-gradient-to-br from-blue-600 to-blue-700 rounded-xl flex items-center justify-center text-white hover:from-blue-500 hover:to-blue-600 transform hover:scale-110 transition-all duration-300 shadow-lg hover:shadow-xl">
                                    <i class="fab fa-facebook-f text-lg"></i>
                                </a>
                            @endif
                            
                            @if($socialTwitter)
                                <a href="{{ $socialTwitter }}" target="_blank" rel="noopener noreferrer" 
                                   class="w-12 h-12 bg-gradient-to-br from-sky-500 to-sky-600 rounded-xl flex items-center justify-center text-white hover:from-sky-400 hover:to-sky-500 transform hover:scale-110 transition-all duration-300 shadow-lg hover:shadow-xl">
                                    <i class="fab fa-twitter text-lg"></i>
                                </a>
                            @endif
                            
                            @if($socialLinkedin)
                                <a href="{{ $socialLinkedin }}" target="_blank" rel="noopener noreferrer" 
                                   class="w-12 h-12 bg-gradient-to-br from-blue-700 to-blue-800 rounded-xl flex items-center justify-center text-white hover:from-blue-600 hover:to-blue-700 transform hover:scale-110 transition-all duration-300 shadow-lg hover:shadow-xl">
                                    <i class="fab fa-linkedin-in text-lg"></i>
                                </a>
                            @endif
                            
                            @if($socialInstagram)
                                <a href="{{ $socialInstagram }}" target="_blank" rel="noopener noreferrer" 
                                   class="w-12 h-12 bg-gradient-to-br from-pink-600 via-purple-600 to-orange-500 rounded-xl flex items-center justify-center text-white hover:opacity-90 transform hover:scale-110 transition-all duration-300 shadow-lg hover:shadow-xl">
                                    <i class="fab fa-instagram text-lg"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Breakthrough Intervention Coaching Box -->
                    <div class="bg-gradient-to-br from-primary-900 via-primary-800 to-primary-900 rounded-2xl p-6 md:p-8 text-white shadow-2xl border-2 border-accent-500/30">
                        <h4 class="text-xl md:text-2xl font-bold mb-4 text-accent-400">
                            Breakthrough Intervention Coaching in Kenya
                        </h4>
                        <p class="text-base md:text-lg text-gray-100 leading-relaxed">
                            <strong class="text-accent-400">Breakthrough Intervention Coaching in Kenya</strong> is a game-changing approach that empowers individuals to experience rapid, lasting transformation by targeting the root cause of limiting beliefs, emotional blocks, and self-sabotaging patterns. Unlike traditional coaching models, this powerful method combines mindset rewiring, emotional mastery, and identity alignment to create deep inner shifts that ripple across every area of life—from career and relationships to purpose and confidence. At <strong class="text-accent-400">Destiny Life Coaching</strong>, our certified Breakthrough Coaches in Kenya use this results-based process to guide clients from confusion to clarity, from fear to bold action, and from survival mode to a life of intentional success and fulfillment.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Coaching with Jeff Section -->
    <section class="relative py-16 md:py-24 lg:py-32 bg-gradient-to-br from-primary-900 via-primary-800 to-primary-950 text-white overflow-hidden">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-0 right-0 w-96 h-96 bg-accent-500/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 animate-pulse"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-accent-400/10 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2 animate-pulse" style="animation-delay: 1.5s;"></div>
        </div>
        
        <!-- Pattern Overlay -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0" style="background-image: radial-gradient(circle, white 1px, transparent 1px); background-size: 50px 50px;"></div>
        </div>
        
        <div class="container relative z-10 px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto text-center">
                <!-- Badge -->
                <div class="mb-6 animate-on-scroll">
                    <span class="inline-block px-6 py-2.5 bg-accent-500/20 border-2 border-accent-400/50 rounded-full text-accent-300 font-bold text-sm uppercase tracking-widest backdrop-blur-sm shadow-lg">
                        <i class="fas fa-user-tie mr-2"></i>Personal Coaching
                    </span>
                </div>
                
                <!-- Main Heading -->
                <div class="mb-6 animate-on-scroll">
                    <h2 class="text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-bold mb-4 leading-tight">
                        Coaching with <span class="text-accent-400 font-accent italic">Jeff</span>
                    </h2>
                </div>
                
                <!-- Subheading -->
                <div class="mb-8 animate-on-scroll">
                    <h3 class="text-2xl md:text-3xl lg:text-4xl font-semibold text-gray-200 leading-relaxed">
                        1 On 1 Coaching Session With Jeff
                    </h3>
                </div>
                
                <!-- Divider -->
                <div class="mb-10 animate-on-scroll">
                    <div class="w-32 h-1 bg-gradient-to-r from-transparent via-accent-500 to-transparent mx-auto"></div>
                </div>
                
                <!-- CTA Button -->
                <div class="animate-on-scroll">
                    <a href="https://calendly.com/breakthrough101/1-on-1-coaching-session-with-jeff?month=2021-08" 
                       target="_blank"
                       rel="noopener noreferrer"
                       class="inline-flex items-center gap-3 px-10 md:px-12 py-5 md:py-6 bg-gradient-to-r from-accent-500 via-accent-400 to-accent-500 text-primary-900 font-bold text-lg md:text-xl rounded-xl hover:from-accent-400 hover:via-accent-300 hover:to-accent-400 transform hover:scale-105 active:scale-95 transition-all duration-300 shadow-2xl hover:shadow-accent-500/50 group uppercase tracking-wider">
                        <i class="fas fa-calendar-check text-2xl"></i>
                        <span>BOOK YOUR APPOINTMENT</span>
                        <i class="fas fa-arrow-right transform group-hover:translate-x-2 transition-transform duration-300"></i>
                    </a>
                </div>
                
                <!-- Decorative Elements -->
                <div class="absolute top-10 left-10 w-24 h-24 bg-accent-500/10 rounded-full blur-2xl hidden lg:block"></div>
                <div class="absolute bottom-10 right-10 w-24 h-24 bg-accent-400/10 rounded-full blur-2xl hidden lg:block"></div>
            </div>
        </div>
        
        <!-- Accent Border Bottom -->
        <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-transparent via-accent-500 to-transparent"></div>
    </section>

    <!-- Transform Your Life Section -->
    <section class="relative py-16 md:py-20 lg:py-24 bg-gradient-to-br from-white via-accent-50/20 to-primary-50/30 overflow-hidden">
        <!-- Decorative Background Elements -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-accent-500/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-primary-500/5 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2"></div>
        
        <div class="container relative z-10 px-4 sm:px-6 lg:px-8">
            <div class="max-w-5xl mx-auto text-center animate-on-scroll">
                <!-- Main Heading -->
                <h2 class="text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-bold text-primary-900 mb-6 leading-tight">
                    Transform Your Life with <span class="text-accent-500 font-accent italic">Certified Life Coaches</span> at Destiny Life Coaching Kenya:
                </h2>
                
                <!-- Subtitle -->
                <p class="text-xl md:text-2xl lg:text-3xl text-gray-700 leading-relaxed max-w-4xl mx-auto font-medium">
                    Empowering Change for a Better World and Delivering <span class="text-primary-700 font-semibold">Unmatched Transformational Coaching Services</span> in Kenya and Beyond!
                </p>
                
                <!-- Decorative Accent Line -->
                <div class="mt-10 flex justify-center">
                    <div class="w-32 h-1 bg-gradient-to-r from-transparent via-accent-500 to-transparent"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Video Testimonial Section -->
    <section class="relative py-16 md:py-24 lg:py-32 bg-gradient-to-br from-white via-primary-50/30 to-white overflow-hidden">
        <!-- Decorative Background Elements -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-accent-500/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-primary-500/5 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2"></div>
        
        <div class="container relative z-10 px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 xl:gap-16 items-center">
                <!-- Video Column -->
                <div class="animate-on-scroll">
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl group">
                        <!-- Video Container -->
                        <div class="relative aspect-video bg-primary-900" id="videoContainer">
                            <!-- Thumbnail Overlay -->
                            <div id="videoThumbnail" class="absolute inset-0 cursor-pointer" onclick="playVideo()">
                                <img src="https://dlc.co.ke/wp-content/uploads/2023/01/1166c6db-5521-4888-9ac8-389af4436c62-370x247-1.jpg" 
                                     alt="BECOME A LIFE COACH AS A CAREER" 
                                     class="w-full h-full object-cover"
                                     loading="lazy">
                                <!-- Play Button Overlay -->
                                <div class="absolute inset-0 flex items-center justify-center bg-black/30 group-hover:bg-black/40 transition-all duration-300">
                                    <div class="w-20 h-20 md:w-24 md:h-24 bg-accent-500 rounded-full flex items-center justify-center shadow-2xl transform group-hover:scale-110 transition-transform duration-300">
                                        <i class="fas fa-play text-white text-2xl md:text-3xl ml-1"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- YouTube iframe (hidden initially) -->
                            <iframe id="videoPlayer" 
                                    class="hidden w-full h-full" 
                                    src="" 
                                    frameborder="0" 
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                    allowfullscreen>
                            </iframe>
                        </div>
                    </div>
                </div>
                
                <!-- Content Column -->
                <div class="animate-on-scroll space-y-6">
                    <!-- Badge -->
                    <div>
                        <span class="inline-block px-4 py-2 bg-accent-500/10 border border-accent-500/30 rounded-full text-accent-600 font-semibold text-sm uppercase tracking-wider">
                            <i class="fas fa-video mr-2"></i>Video Content
                        </span>
                    </div>
                    
                    <!-- Main Heading -->
                    <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-primary-900 leading-tight">
                        Subscribe to <span class="text-accent-500 font-accent italic">Breakthrough coaching</span>
                    </h2>
                    
                    <!-- Subheading -->
                    <h3 class="text-2xl md:text-3xl font-semibold text-primary-700">
                        Video Testimonial
                    </h3>
                    
                    <!-- Description -->
                    <p class="text-lg text-gray-700 leading-relaxed">
                        Watch inspiring testimonials and coaching insights from our community. Subscribe to stay updated with the latest breakthrough coaching content.
                    </p>
                    
                    <!-- Subscribe Button -->
                    <div class="pt-4">
                        <a href="https://www.youtube.com/channel/UCcYXau-TIgy-1h9mK9m5V4A?sub_confirmation=1" 
                           target="_blank"
                           rel="noopener noreferrer"
                           class="inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-red-600 to-red-700 text-white font-bold rounded-xl hover:from-red-500 hover:to-red-600 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl group">
                            <i class="fab fa-youtube text-2xl"></i>
                            <span>Subscribe</span>
                            <i class="fas fa-long-arrow-alt-right transform group-hover:translate-x-2 transition-transform duration-300"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Us Now Section -->
    <section class="relative py-16 md:py-24 lg:py-32 bg-gradient-to-br from-primary-900 via-primary-800 to-primary-950 text-white overflow-hidden">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-0 left-0 w-96 h-96 bg-accent-500/10 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2 animate-pulse"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-accent-400/10 rounded-full blur-3xl translate-x-1/2 translate-y-1/2 animate-pulse" style="animation-delay: 2s;"></div>
        </div>
        
        <!-- Pattern Overlay -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0" style="background-image: radial-gradient(circle, white 1px, transparent 1px); background-size: 50px 50px;"></div>
        </div>
        
        <div class="container relative z-10 px-4 sm:px-6 lg:px-8">
            <div class="max-w-5xl mx-auto text-center">
                <!-- Main Heading -->
                <div class="mb-8 animate-on-scroll">
                    <h2 class="text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-bold mb-6 leading-tight">
                        Contact Us <span class="text-accent-400 font-accent italic">Now!</span>
                    </h2>
                </div>
                
                <!-- Description -->
                <div class="mb-10 animate-on-scroll">
                    <p class="text-lg md:text-xl lg:text-2xl text-gray-100 leading-relaxed max-w-4xl mx-auto">
                        <strong class="text-accent-400">Destiny Life Coaching in Kenya</strong> is here to enable agents of change to become world-class practitioners of transformative Life Coaching excellence who will positively influence Africa and the world using the results-based transformational approach to coaching.
                    </p>
                </div>
                
                <!-- Divider -->
                <div class="mb-12 animate-on-scroll">
                    <div class="w-32 h-1 bg-gradient-to-r from-transparent via-accent-500 to-transparent mx-auto"></div>
                </div>
                
                <!-- Contact Options -->
                <div class="grid md:grid-cols-2 gap-8 md:gap-12 items-center max-w-4xl mx-auto animate-on-scroll">
                    <!-- Phone Number -->
                    <div class="flex flex-col items-center md:items-end">
                        <a href="tel:+254722992111" 
                           class="inline-flex items-center gap-3 px-8 py-5 bg-gradient-to-r from-accent-500 to-accent-600 text-primary-900 font-bold text-lg md:text-xl rounded-xl hover:from-accent-400 hover:to-accent-500 transform hover:scale-105 transition-all duration-300 shadow-2xl hover:shadow-accent-500/50 group">
                            <i class="fas fa-phone text-2xl"></i>
                            <span>+254722992111</span>
                        </a>
                    </div>
                    
                    <!-- Social Media Icons -->
                    <div class="flex flex-col items-center md:items-start">
                        <div class="flex gap-4">
                            <a href="https://www.facebook.com/breakthroughwithjeff/" 
                               target="_blank"
                               rel="noopener noreferrer"
                               class="w-14 h-14 bg-gradient-to-br from-blue-600 to-blue-700 rounded-full flex items-center justify-center text-white hover:from-blue-500 hover:to-blue-600 transform hover:scale-110 transition-all duration-300 shadow-lg hover:shadow-xl">
                                <i class="fab fa-facebook-f text-xl"></i>
                            </a>
                            
                            <a href="https://www.linkedin.com/in/lifecoachkenya/" 
                               target="_blank"
                               rel="noopener noreferrer"
                               class="w-14 h-14 bg-gradient-to-br from-blue-700 to-blue-800 rounded-full flex items-center justify-center text-white hover:from-blue-600 hover:to-blue-700 transform hover:scale-110 transition-all duration-300 shadow-lg hover:shadow-xl">
                                <i class="fab fa-linkedin-in text-xl"></i>
                            </a>
                            
                            <a href="https://api.whatsapp.com/message/6YTRFNCLIQJPG1" 
                               target="_blank"
                               rel="noopener noreferrer"
                               class="w-14 h-14 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center text-white hover:from-green-400 hover:to-green-500 transform hover:scale-110 transition-all duration-300 shadow-lg hover:shadow-xl">
                                <i class="fab fa-whatsapp text-xl"></i>
                            </a>
                            
                            <a href="https://www.instagram.com/thelifemasterybootcamp" 
                               target="_blank"
                               rel="noopener noreferrer"
                               class="w-14 h-14 bg-gradient-to-br from-pink-600 via-purple-600 to-orange-500 rounded-full flex items-center justify-center text-white hover:opacity-90 transform hover:scale-110 transition-all duration-300 shadow-lg hover:shadow-xl">
                                <i class="fab fa-instagram text-xl"></i>
                            </a>
                            
                            <a href="https://www.youtube.com/channel/UCcYXau-TIgy-1h9mK9m5V4A?sub_confirmation=1" 
                               target="_blank"
                               rel="noopener noreferrer"
                               class="w-14 h-14 bg-gradient-to-br from-red-600 to-red-700 rounded-full flex items-center justify-center text-white hover:from-red-500 hover:to-red-600 transform hover:scale-110 transition-all duration-300 shadow-lg hover:shadow-xl">
                                <i class="fab fa-youtube text-xl"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Accent Border Bottom -->
        <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-transparent via-accent-500 to-transparent"></div>
    </section>

    <!-- Testimonials Section -->
    <section class="section bg-gray-50">
        <div class="container">
            <div class="text-center mb-12 animate-on-scroll">
                <span class="text-accent-600 font-semibold text-sm uppercase tracking-wider">Success Stories</span>
                <h2 class="text-3xl lg:text-4xl font-bold text-primary-900 mt-2 mb-4">What Our Clients Say</h2>
            </div>
            @php
                $testimonials = \App\Models\Testimonial::where('is_active', true)
                    ->orderBy('order')
                    ->orderBy('is_featured', 'desc')
                    ->orderBy('created_at', 'desc')
                    ->limit(3)
                    ->get();
            @endphp
            @if($testimonials->count() > 0)
                <div class="grid md:grid-cols-3 gap-8">
                    @foreach($testimonials as $testimonial)
                        <div class="card animate-on-scroll">
                            <div class="text-accent-500 text-4xl mb-4 opacity-30">
                                <i class="fas fa-quote-left"></i>
                            </div>
                            <p class="text-gray-700 italic mb-6 leading-relaxed">
                                "{{ $testimonial->content }}"
                            </p>
                            <div class="flex items-center gap-4">
                                @if($testimonial->photo)
                                    <img src="{{ asset('storage/' . $testimonial->photo) }}" alt="{{ $testimonial->name }}" class="w-12 h-12 rounded-full object-cover">
                                @else
                                    <div class="w-12 h-12 bg-primary-600 rounded-full flex items-center justify-center">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                @endif
                                <div>
                                    <div class="font-bold text-primary-900">{{ $testimonial->name }}</div>
                                    @if($testimonial->role)
                                        <div class="text-sm text-gray-600">{{ $testimonial->role }}{{ $testimonial->company ? ' at ' . $testimonial->company : '' }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="grid md:grid-cols-3 gap-8">
                    @for($i = 0; $i < 3; $i++)
                        <div class="card animate-on-scroll">
                            <div class="text-accent-500 text-4xl mb-4 opacity-30">
                                <i class="fas fa-quote-left"></i>
                            </div>
                            <p class="text-gray-700 italic mb-6 leading-relaxed">
                                "The coaching program transformed my career. I gained clarity on my goals and the confidence to pursue them. Highly recommended!"
                            </p>
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 bg-primary-600 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-white"></i>
                                </div>
                                <div>
                                    <div class="font-bold text-primary-900">Sarah Johnson</div>
                                    <div class="text-sm text-gray-600">Marketing Director</div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            @endif
        </div>
    </section>

   
@endsection

@push('scripts')
<style>
    @keyframes fadeOutAfter5s {
        0% {
            opacity: 1;
        }
        91% {
            opacity: 1;
        }
        100% {
            opacity: 0.3;
        }
    }

    .fade-out-after-5s {
        animation: fadeOutAfter5s 5.5s ease-in-out forwards;
    }

    @keyframes elegantBounce {
        0%, 100% {
            transform: translateY(0);
            opacity: 0.9;
        }
        50% {
            transform: translateY(8px);
            opacity: 1;
        }
    }

    @keyframes fadePulse {
        0%, 100% {
            opacity: 0.6;
        }
        50% {
            opacity: 1;
        }
    }

    .scroll-indicator {
        animation: elegantBounce 2s ease-in-out infinite;
    }

    .scroll-indicator .w-0\.5 {
        animation: fadePulse 2s ease-in-out infinite;
    }
</style>
<script>
    // Scroll animation observer
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, observerOptions);

    document.querySelectorAll('.animate-on-scroll').forEach(el => {
        observer.observe(el);
    });

    // Smooth scroll to next section
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
                // If no next section, scroll down by viewport height
                window.scrollBy({
                    top: window.innerHeight,
                    behavior: 'smooth'
                });
            }
        }
    }
    
    // Video play functionality
    function playVideo() {
        const thumbnail = document.getElementById('videoThumbnail');
        const player = document.getElementById('videoPlayer');
        
        if (thumbnail && player) {
            // Convert YouTube URL to embed URL
            const youtubeUrl = 'https://youtu.be/FzlHhrAnSiI';
            const videoId = youtubeUrl.split('/').pop().split('?')[0];
            const embedUrl = `https://www.youtube.com/embed/${videoId}?autoplay=1&start=10&end=20&modestbranding=1&rel=0`;
            
            // Hide thumbnail and show player
            thumbnail.classList.add('hidden');
            player.classList.remove('hidden');
            player.src = embedUrl;
        }
    }
    
    // Make thumbnail clickable with keyboard support
    document.addEventListener('DOMContentLoaded', function() {
        const thumbnail = document.getElementById('videoThumbnail');
        if (thumbnail) {
            thumbnail.addEventListener('keypress', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    playVideo();
                }
            });
        }
    });
</script>
@endpush

