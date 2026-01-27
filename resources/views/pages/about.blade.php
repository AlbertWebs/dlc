@extends('layouts.app')

@php
    $pageTitle = 'About Us – Destiny Life Coaching Kenya | Mission, Vision & Leadership Academy';
    $pageDescription = 'Learn about DLC\'s mission, vision, and commitment to transforming lives through professional coaching. Discover our Leadership Academy and ICR-accredited programs in Kenya.';
    $pageKeywords = 'about DLC Kenya, life coaching mission, coaching vision, leadership academy Kenya, ICR accredited coaching, professional coaching Kenya, coaching organization';
    $pageImage = \App\Models\Setting::get('about_page_leadership_image_file', '') 
        ? asset('storage/' . \App\Models\Setting::get('about_page_leadership_image_file', '')) 
        : asset('images/og-image.jpg');
    $pageType = 'website';
@endphp

@push('schema')
@php
    $aboutPageSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'AboutPage',
        'name' => $pageTitle,
        'description' => $pageDescription,
        'url' => url('/about'),
        'inLanguage' => 'en-KE',
        'mainEntity' => [
            '@type' => 'Organization',
            'name' => 'Destiny Life Coaching Kenya',
            'alternateName' => 'DLC Kenya',
            'description' => $pageDescription,
            'url' => config('app.url'),
            'foundingDate' => '2006',
            'address' => [
                '@type' => 'PostalAddress',
                'addressCountry' => 'KE',
                'addressLocality' => 'Nairobi'
            ]
        ],
        'breadcrumb' => [
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                [
                    '@type' => 'ListItem',
                    'position' => 1,
                    'name' => 'Home',
                    'item' => url('/')
                ],
                [
                    '@type' => 'ListItem',
                    'position' => 2,
                    'name' => 'About Us',
                    'item' => url('/about')
                ]
            ]
        ]
    ];
@endphp
<script type="application/ld+json">
@verbatim
{!! json_encode($aboutPageSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
@endverbatim
</script>
@endpush

@section('content')
    <!-- Breadcrumb -->
    <x-breadcrumb :items="[
        ['label' => 'Home', 'url' => route('home')],
        ['label' => 'About Us', 'url' => route('about')]
    ]" />

    @php
        $heroTitle = \App\Models\Setting::get('about_page_hero_title', 'ABOUT US');
        $heroSubtitle = \App\Models\Setting::get('about_page_hero_subtitle', 'Empowering lives through expert coaching and professional development');
        $introTitle = \App\Models\Setting::get('about_page_introduction_title', 'Introduction');
        $introContent = \App\Models\Setting::get('about_page_introduction_content', 'Destiny Life Coaching is here to enable agents of change to become world-class practitioners of transformative coaching excellence who will positively influence Africa and the world using the results-based transformational approach to life coaching.');
        $missionTitle = \App\Models\Setting::get('about_page_mission_title', 'Mission');
        $missionContent = \App\Models\Setting::get('about_page_mission_content', 'Develop transformative soul-based practitioners of coaching and speaking excellence through soul-based immersion coaching experience, exposure to cutting-edge transformational tools, collaborative practice, research, and innovative contribution to humanity.');
        $visionTitle = \App\Models\Setting::get('about_page_vision_title', 'Vision');
        $visionContent = \App\Models\Setting::get('about_page_vision_content', 'DLC is a world class center for transformational life success. This is dedicated to excellence in life coaching, transformational Leadership Academy, and transformative speaker training which is distinguished by high-quality, value-based training that is also transformative.');
        $leadershipTitle = \App\Models\Setting::get('about_page_leadership_title', 'LEADERSHIP ACADEMY');
        $leadershipSubtitle = \App\Models\Setting::get('about_page_leadership_subtitle', 'Destiny Life Coaching, Nairobi Leadership Academy offers training that helps develop leaders from within your organization and facilitates a leadership pipeline that brings about peak performance for teams.');
        $leadershipContent = \App\Models\Setting::get('about_page_leadership_content', '');
        $leadershipImageFile = \App\Models\Setting::get('about_page_leadership_image_file', '');
        $leadershipImageUrl = \App\Models\Setting::get('about_page_leadership_image', '');
        // Use uploaded file if exists, otherwise use URL (if it's not a stored file path)
        $leadershipImage = $leadershipImageFile ? asset('storage/' . $leadershipImageFile) : ($leadershipImageUrl && !str_starts_with($leadershipImageUrl, 'about-page/') ? $leadershipImageUrl : ($leadershipImageUrl && str_starts_with($leadershipImageUrl, 'about-page/') ? asset('storage/' . $leadershipImageUrl) : ''));
        $accreditationTitle = \App\Models\Setting::get('about_page_accreditation_title', 'Accreditation');
        $accreditationContent = \App\Models\Setting::get('about_page_accreditation_content', 'We are accredited by the International Coaches Register and we are in good standing with ICR. We are committed to providing professional and ethical services to our clients. We are dedicated to providing quality life coaching services.');
    @endphp

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-primary-900 via-primary-800 to-primary-950 text-white py-16 md:py-24 lg:py-32 overflow-hidden">
        <!-- Enhanced Decorative Background Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-accent-500/20 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 animate-pulse"></div>
            <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-accent-500/20 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2 animate-pulse" style="animation-delay: 1s;"></div>
            <div class="absolute top-1/2 left-1/2 w-[300px] h-[300px] bg-primary-700/30 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
        </div>
        
        <!-- Accent Border Top -->
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-transparent via-accent-400 to-transparent"></div>
        
        <div class="container relative z-10 px-4 sm:px-6 lg:px-8">
            <div class="max-w-5xl mx-auto text-center">
                <!-- Badge -->
                <div class="inline-flex items-center gap-2 px-5 py-2.5 bg-white/10 backdrop-blur-md border border-white/20 rounded-full mb-6 shadow-lg animate-on-scroll hover:bg-white/15 transition-all duration-300">
                    <i class="fas fa-info-circle text-accent-400"></i>
                    <span class="text-accent-300 font-semibold text-sm uppercase tracking-wider">About Us</span>
                </div>
                
                <!-- Main Heading -->
                <h1 class="text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-bold mb-6 leading-tight animate-on-scroll">
                    <span class="block">{{ $heroTitle }}</span>
                </h1>
                
                <!-- Subtitle -->
                <p class="text-lg md:text-xl lg:text-2xl text-gray-200 max-w-3xl mx-auto leading-relaxed mb-8 animate-on-scroll">
                    {{ $heroSubtitle }}
                </p>
                
                <!-- Quick Stats or CTA -->
                <div class="flex flex-wrap items-center justify-center gap-6 mt-10 animate-on-scroll">
                    <div class="flex items-center gap-3 px-6 py-3 bg-white/10 backdrop-blur-md rounded-xl border border-white/20 hover:bg-white/15 transition-all duration-300">
                        <div class="w-10 h-10 bg-accent-500/20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-calendar-check text-accent-400"></i>
                        </div>
                        <div class="text-left">
                            <div class="text-xs text-gray-400 uppercase tracking-wider">Since</div>
                            <div class="text-lg font-bold text-white">2006</div>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-3 px-6 py-3 bg-white/10 backdrop-blur-md rounded-xl border border-white/20 hover:bg-white/15 transition-all duration-300">
                        <div class="w-10 h-10 bg-accent-500/20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-certificate text-accent-400"></i>
                        </div>
                        <div class="text-left">
                            <div class="text-xs text-gray-400 uppercase tracking-wider">Accredited</div>
                            <div class="text-lg font-bold text-white">ICR</div>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-3 px-6 py-3 bg-white/10 backdrop-blur-md rounded-xl border border-white/20 hover:bg-white/15 transition-all duration-300">
                        <div class="w-10 h-10 bg-accent-500/20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-users text-accent-400"></i>
                        </div>
                        <div class="text-left">
                            <div class="text-xs text-gray-400 uppercase tracking-wider">Location</div>
                            <div class="text-lg font-bold text-white">Kenya</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Bottom Wave Decoration -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg class="w-full h-12 text-white" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M0,0 C300,100 600,20 900,60 C1050,80 1150,40 1200,60 L1200,120 L0,120 Z" fill="currentColor" opacity="0.1"></path>
            </svg>
        </div>
    </section>

    <!-- Introduction Section -->
    <section class="relative py-16 md:py-20 lg:py-24 bg-white overflow-hidden">
        <!-- Subtle Background Pattern -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute top-20 right-10 w-72 h-72 bg-primary-500 rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 left-10 w-72 h-72 bg-accent-500 rounded-full blur-3xl"></div>
        </div>
        
        <div class="container max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-12 animate-on-scroll">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-primary-50 border border-primary-100 rounded-full mb-6">
                    <i class="fas fa-lightbulb text-accent-500"></i>
                    <span class="text-sm font-semibold text-primary-700 uppercase tracking-wider">{{ $introTitle }}</span>
                </div>
                <div class="w-20 h-1 bg-gradient-to-r from-transparent via-accent-500 to-transparent mx-auto rounded-full mb-8"></div>
            </div>
            
            <div class="bg-gradient-to-br from-gray-50 to-white rounded-3xl p-8 md:p-12 lg:p-16 shadow-xl border border-gray-100 animate-on-scroll hover:shadow-2xl transition-all duration-500">
                <div class="prose prose-lg max-w-none text-center">
                    <p class="text-lg md:text-xl lg:text-2xl text-gray-700 leading-relaxed font-medium">
                        {{ $introContent }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Vision Section -->
    <section class="section bg-gradient-to-br from-gray-50 to-white">
        <div class="container">
            <div class="grid md:grid-cols-2 gap-8 lg:gap-12">
                <!-- Mission Card -->
                <div class="bg-white rounded-2xl shadow-xl p-8 lg:p-10 border border-primary-100 transform hover:scale-[1.02] transition-all duration-300 animate-on-scroll">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center shadow-lg">
                            <i class="fas fa-bullseye text-white text-2xl"></i>
                        </div>
                        <div>
                            <span class="text-sm font-semibold text-green-600 uppercase tracking-wider">01. Mission</span>
                            <h3 class="text-2xl font-bold text-primary-900 mt-1">{{ $missionTitle }}</h3>
                        </div>
                    </div>
                    <p class="text-gray-700 leading-relaxed text-lg">
                        {{ $missionContent }}
                    </p>
                </div>

                <!-- Vision Card -->
                <div class="bg-white rounded-2xl shadow-xl p-8 lg:p-10 border border-primary-100 transform hover:scale-[1.02] transition-all duration-300 animate-on-scroll">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                            <i class="fas fa-eye text-white text-2xl"></i>
                        </div>
                        <div>
                            <span class="text-sm font-semibold text-purple-600 uppercase tracking-wider">02. Vision</span>
                            <h3 class="text-2xl font-bold text-primary-900 mt-1">{{ $visionTitle }}</h3>
                        </div>
                    </div>
                    <p class="text-gray-700 leading-relaxed text-lg">
                        {{ $visionContent }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Leadership Academy Section -->
    @if($leadershipTitle || $leadershipContent)
    <section class="section bg-white">
        <div class="container">
            <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                <!-- Content -->
                <div class="animate-on-scroll">
                    <div class="inline-block mb-4">
                        <span class="px-4 py-2 bg-primary-100 border border-primary-200 rounded-full text-primary-700 font-semibold text-sm uppercase tracking-wider">
                            Courses
                        </span>
                    </div>
                    <h2 class="text-3xl lg:text-4xl font-bold text-primary-900 mb-6">
                        {{ $leadershipTitle }}
                    </h2>
                    @if($leadershipSubtitle)
                        <p class="text-xl text-gray-700 mb-6 leading-relaxed">
                            {{ $leadershipSubtitle }}
                        </p>
                    @endif
                    @if($leadershipContent)
                        <div class="prose prose-lg max-w-none text-gray-700 space-y-4">
                            @foreach(explode("\n\n", $leadershipContent) as $paragraph)
                                @if(trim($paragraph))
                                    <p class="leading-relaxed">{{ trim($paragraph) }}</p>
                                @endif
                            @endforeach
                        </div>
                    @endif
                    <div class="mt-8">
                        <a href="{{ route('become-a-coach') }}" class="btn btn-primary btn-large inline-flex items-center gap-2">
                            <span>Learn More</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>

                <!-- Image -->
                <div class="animate-on-scroll">
                    <div class="relative">
                        <!-- Decorative Elements -->
                        <div class="absolute -top-6 -left-6 w-full h-full bg-gradient-to-br from-accent-400 to-accent-600 rounded-3xl transform rotate-3 opacity-20"></div>
                        <div class="absolute -bottom-6 -right-6 w-full h-full bg-gradient-to-br from-primary-600 to-primary-800 rounded-3xl transform -rotate-3 opacity-20"></div>
                        
                        <!-- Main Image Container -->
                        <div class="relative rounded-3xl overflow-hidden shadow-2xl transform hover:scale-[1.02] transition-transform duration-500">
                            <div class="aspect-[4/3] bg-gradient-to-br from-primary-700 to-primary-900">
                                @if($leadershipImage)
                                    <img src="{{ $leadershipImage }}" 
                                         alt="{{ $leadershipTitle }}" 
                                         class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-primary-700 via-primary-800 to-primary-900">
                                        <div class="text-center text-white p-8">
                                            <i class="fas fa-users-cog text-6xl lg:text-8xl mb-4 opacity-50"></i>
                                            <p class="text-lg font-medium opacity-75">Leadership Academy</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <!-- Overlay Gradient -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

     <!-- CTA Section -->
     <section class="section bg-gradient-to-r from-primary-900 via-primary-800 to-primary-950 text-white relative overflow-hidden">
        <!-- Decorative Background -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 right-0 w-96 h-96 bg-accent-500 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-accent-500 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2"></div>
        </div>
        
        <div class="container text-center relative z-10">
            <h2 class="text-3xl lg:text-4xl font-bold mb-4">Ready to Begin Your Journey?</h2>
            <p class="text-xl text-gray-200 mb-8 max-w-2xl mx-auto">
                Join thousands who have transformed their lives with our coaching programs.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('contact') }}" class="btn btn-accent btn-large shadow-lg hover:shadow-xl transform hover:scale-105 transition-all">
                    <i class="fas fa-paper-plane mr-2"></i> Get Started Today
                </a>
                <a href="{{ route('programs.index') }}" class="btn bg-white text-primary-900 hover:bg-gray-100 btn-large shadow-lg hover:shadow-xl transform hover:scale-105 transition-all">
                    <i class="fas fa-graduation-cap mr-2"></i> Explore Programs
                </a>
            </div>
        </div>
    </section>

    <!-- Accreditation Section -->
    <section class="section bg-gradient-to-br from-accent-50 via-white to-primary-50">
        <div class="container max-w-4xl">
            <div class="bg-white rounded-2xl shadow-xl p-8 lg:p-12 border-2 border-accent-200 animate-on-scroll">
                <div class="text-center mb-8">
                    <div class="w-20 h-20 bg-gradient-to-br from-accent-400 to-accent-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                        <i class="fas fa-certificate text-white text-3xl"></i>
                    </div>
                    <h2 class="text-3xl lg:text-4xl font-bold text-primary-900 mb-4">{{ $accreditationTitle }}</h2>
                    <div class="w-24 h-1 bg-gradient-to-r from-accent-400 to-accent-600 mx-auto rounded-full"></div>
                </div>
                <p class="text-lg text-gray-700 leading-relaxed text-center max-w-3xl mx-auto">
                    {{ $accreditationContent }}
                </p>
            </div>
        </div>
    </section>

    <!-- Google Reviews Section -->
    <x-google-reviews-section />

   
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
