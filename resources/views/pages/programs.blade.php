@extends('layouts.app')

@php
    $pageTitle = 'Coaching Programs – Life Coach Training & Certification | DLC Kenya';
    $pageDescription = 'Explore our comprehensive ICR-accredited coaching programs: Life Coach Certification, Group Coaching, Breakthrough Coaching, and more. Transform your career with professional coaching training in Kenya.';
    $pageKeywords = 'coaching programs Kenya, life coach training, coaching courses, certification programs, group coaching, breakthrough coaching, professional coaching programs';
    $pageImage = asset('images/og-image.jpg');
    $pageType = 'website';
@endphp

@push('schema')
@php
    $programsPageSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'CollectionPage',
        'name' => $pageTitle,
        'description' => $pageDescription,
        'url' => url('/programs'),
        'inLanguage' => 'en-KE',
        'about' => [
            '@type' => 'Thing',
            'name' => 'Coaching Programs and Training'
        ]
    ];
@endphp
<script type="application/ld+json">
@verbatim
{!! json_encode($programsPageSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
@endverbatim
</script>
@endpush

@section('content')
    <!-- Breadcrumb -->
    <x-breadcrumb :items="[
        ['label' => 'Home', 'url' => route('home')],
        ['label' => 'Programs', 'url' => route('programs.index')]
    ]" />

    <!-- Hero Section -->
    <section class="relative min-h-[70vh] flex items-center justify-center overflow-hidden bg-gradient-to-br from-primary-900 via-primary-800 to-primary-950 text-white">
        <!-- Animated Background -->
        <div class="absolute inset-0">
            <div class="absolute top-0 left-0 w-full h-full bg-[radial-gradient(circle_at_20%_30%,rgba(248,176,22,0.15),transparent_50%)]"></div>
            <div class="absolute bottom-0 right-0 w-full h-full bg-[radial-gradient(circle_at_80%_70%,rgba(248,176,22,0.1),transparent_50%)]"></div>
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-20 left-20 w-96 h-96 bg-accent-500 rounded-full blur-3xl animate-pulse"></div>
                <div class="absolute bottom-20 right-20 w-96 h-96 bg-primary-600 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
            </div>
        </div>

        <div class="container relative z-10 px-4 sm:px-6 lg:px-8 py-20">
            <div class="max-w-4xl mx-auto text-center animate-on-scroll">
                <!-- Badge -->
                <div class="inline-block mb-6">
                    <span class="px-6 py-3 bg-accent-500/20 border-2 border-accent-400/50 rounded-full text-accent-300 font-bold text-sm uppercase tracking-widest backdrop-blur-sm shadow-xl">
                        <i class="fas fa-graduation-cap mr-2"></i>Transform Your Life
                    </span>
                </div>

                <!-- Main Heading -->
                <h1 class="text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-bold mb-6 leading-tight">
                    Our <span class="text-accent-400 font-accent italic">Coaching Programs</span>
                </h1>

                <!-- Subtitle -->
                <p class="text-xl md:text-2xl text-gray-200 mb-8 leading-relaxed max-w-3xl mx-auto">
                    Comprehensive programs designed to transform your life and career through proven methodologies and expert guidance.
                </p>

                <!-- Stats -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 max-w-3xl mx-auto mt-12">
                    <div class="bg-white/10 backdrop-blur-md rounded-xl p-6 border border-white/20">
                        <div class="text-3xl md:text-4xl font-bold text-accent-400 mb-2">{{ $programs->count() }}+</div>
                        <div class="text-sm text-gray-300">Programs</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-md rounded-xl p-6 border border-white/20">
                        <div class="text-3xl md:text-4xl font-bold text-accent-400 mb-2">500+</div>
                        <div class="text-sm text-gray-300">Coaches Trained</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-md rounded-xl p-6 border border-white/20">
                        <div class="text-3xl md:text-4xl font-bold text-accent-400 mb-2">4,000+</div>
                        <div class="text-sm text-gray-300">Lives Changed</div>
                    </div>
                    <div class="bg-white/10 backdrop-blur-md rounded-xl p-6 border border-white/20">
                        <div class="text-3xl md:text-4xl font-bold text-accent-400 mb-2">18+</div>
                        <div class="text-sm text-gray-300">Years Experience</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-10">
            <button type="button" onclick="scrollToPrograms()" class="flex flex-col items-center gap-2 animate-bounce cursor-pointer focus:outline-none focus:ring-2 focus:ring-white/50 rounded-full p-2 group">
                <div class="w-10 h-10 rounded-full bg-white/10 backdrop-blur-sm border border-white/20 flex items-center justify-center shadow-lg group-hover:bg-white/20 group-active:bg-white/30 transition-all duration-300">
                    <i class="fas fa-chevron-down text-white text-sm group-hover:translate-y-0.5 transition-transform duration-300"></i>
                </div>
                <div class="w-0.5 h-8 bg-gradient-to-b from-white/60 to-transparent"></div>
            </button>
        </div>
    </section>

    <!-- Programs Grid Section -->
    <section class="relative py-20 lg:py-32 bg-gradient-to-br from-white via-primary-50/30 to-white overflow-hidden">
        <!-- Decorative Background -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-accent-500/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-primary-500/5 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2"></div>

        <div class="container relative z-10 px-4 sm:px-6 lg:px-8">
            @if($programs->count() > 0)
                <!-- Programs Grid -->
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-10 max-w-7xl mx-auto">
                    @foreach($programs as $index => $program)
                        @php
                            // Get image URL
                            $imageUrl = null;
                            if ($program->image) {
                                $imageUrl = str_starts_with($program->image, 'http') 
                                    ? $program->image 
                                    : asset('storage/' . $program->image);
                            }
                            
                            // Clean slug
                            $slug = $program->slug;
                            if (str_contains($slug, 'httplocalhost') || str_contains($slug, 'http://') || str_contains($slug, 'https://')) {
                                $slug = \Illuminate\Support\Str::slug($program->title);
                            }
                            
                            // Get excerpt
                            $excerpt = $program->excerpt ?? strip_tags($program->description ?? '');
                            $excerpt = \Illuminate\Support\Str::limit($excerpt, 150);
                            
                            // Animation delay
                            $delay = ($index % 3) * 100;
                        @endphp
                        
                        <div class="group relative animate-on-scroll" style="animation-delay: {{ $delay }}ms;">
                            <!-- Card Container -->
                            <div class="relative h-full bg-white rounded-3xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-4 border border-gray-100 flex flex-col">
                                <!-- Image Section -->
                                <div class="relative h-64 overflow-hidden bg-gradient-to-br from-primary-600 to-primary-800">
                                    @if($imageUrl)
                                        <img src="{{ $imageUrl }}" 
                                             alt="{{ $program->title }}" 
                                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                             onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                        <div class="w-full h-full bg-gradient-to-br from-primary-600 to-primary-800 flex items-center justify-center hidden">
                                            <i class="fas {{ $program->icon ?? 'fa-briefcase' }} text-6xl text-white opacity-50"></i>
                                        </div>
                                    @else
                                        <div class="w-full h-full bg-gradient-to-br from-primary-600 via-primary-700 to-primary-800 flex items-center justify-center relative">
                                            <i class="fas {{ $program->icon ?? 'fa-briefcase' }} text-6xl text-white opacity-50 group-hover:opacity-70 transition-opacity"></i>
                                            <!-- Decorative Pattern -->
                                            <div class="absolute inset-0 opacity-10">
                                                <div class="absolute top-4 left-4 w-24 h-24 border-2 border-white rounded-lg rotate-12"></div>
                                                <div class="absolute bottom-4 right-4 w-20 h-20 border-2 border-white rounded-full"></div>
                                            </div>
                                        </div>
                                    @endif
                                    
                                    <!-- Overlay Gradient -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                                    
                                    <!-- Icon Badge -->
                                    <div class="absolute top-6 right-6 w-14 h-14 bg-white/95 backdrop-blur-sm rounded-xl flex items-center justify-center shadow-lg transform group-hover:scale-110 group-hover:rotate-6 transition-all duration-300">
                                        <i class="fas {{ $program->icon ?? 'fa-briefcase' }} text-primary-600 text-xl"></i>
                                    </div>
                                    
                                    <!-- Price Badge -->
                                    @if($program->price)
                                        <div class="absolute bottom-6 left-6 px-5 py-2.5 bg-gradient-to-r from-accent-500 to-accent-600 text-primary-900 font-bold rounded-xl shadow-xl transform group-hover:scale-105 transition-transform">
                                            {{ $program->currency ?? 'KES' }} {{ number_format($program->price) }}
                                        </div>
                                    @else
                                        <div class="absolute bottom-6 left-6 px-5 py-2.5 bg-white/95 backdrop-blur-sm text-primary-900 font-bold rounded-xl shadow-xl">
                                            Contact for Pricing
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- Content Section -->
                                <div class="p-8 flex-1 flex flex-col">
                                    <!-- Title -->
                                    <h3 class="text-2xl md:text-3xl font-bold text-primary-900 mb-4 group-hover:text-primary-700 transition-colors line-clamp-2 leading-tight">
                                        {{ $program->title }}
                                    </h3>
                                    
                                    <!-- Excerpt -->
                                    @if($excerpt)
                                        <p class="text-gray-600 mb-6 flex-1 leading-relaxed text-base line-clamp-3">
                                            {{ $excerpt }}
                                        </p>
                                    @endif
                                    
                                    <!-- Features Preview -->
                                    @if($program->features && count($program->features) > 0)
                                        <div class="mb-6 pb-6 border-b border-gray-100">
                                            <ul class="space-y-2.5">
                                                @foreach(array_slice($program->features, 0, 3) as $feature)
                                                    <li class="flex items-start gap-3 text-sm text-gray-700">
                                                        <i class="fas fa-check-circle text-accent-500 text-base mt-0.5 flex-shrink-0"></i>
                                                        <span class="line-clamp-2">{{ $feature }}</span>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    
                                    <!-- Meta Info -->
                                    @if($program->meta)
                                        <div class="flex flex-wrap gap-4 mb-6 text-sm text-gray-600">
                                            @if(isset($program->meta['duration']))
                                                <div class="flex items-center gap-2">
                                                    <i class="fas fa-clock text-accent-500"></i>
                                                    <span>{{ $program->meta['duration'] }}</span>
                                                </div>
                                            @endif
                                            @if(isset($program->meta['sessions']))
                                                <div class="flex items-center gap-2">
                                                    <i class="fas fa-users text-accent-500"></i>
                                                    <span>{{ $program->meta['sessions'] }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                    
                                    <!-- CTA Button -->
                                    <a href="{{ route('programs.show', $slug) }}" 
                                       class="inline-flex items-center justify-center gap-3 px-6 py-4 bg-gradient-to-r from-primary-600 to-primary-700 text-white font-bold rounded-xl hover:from-primary-700 hover:to-primary-800 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl group/btn text-base">
                                        <span>Learn More</span>
                                        <i class="fas fa-arrow-right transform group-hover/btn:translate-x-2 transition-transform"></i>
                                    </a>
                                </div>
                                
                                <!-- Hover Border Effect -->
                                <div class="absolute inset-0 border-2 border-accent-500 rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none"></div>
                                
                                <!-- Shine Effect -->
                                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000 pointer-events-none"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="max-w-2xl mx-auto text-center py-20 animate-on-scroll">
                    <div class="inline-block p-12 bg-gradient-to-br from-primary-50 to-accent-50/30 rounded-3xl border-2 border-dashed border-primary-300 shadow-lg">
                        <div class="w-24 h-24 bg-gradient-to-br from-primary-600 to-primary-800 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-graduation-cap text-white text-5xl"></i>
                        </div>
                        <h3 class="text-3xl font-bold text-primary-900 mb-4">No Programs Available</h3>
                        <p class="text-xl text-gray-600 mb-6">We're currently updating our program offerings.</p>
                        <p class="text-gray-500">Check back soon for exciting new programs!</p>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="relative py-20 lg:py-32 bg-gradient-to-br from-primary-900 via-primary-800 to-primary-950 text-white overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 right-0 w-96 h-96 bg-accent-500 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-accent-400 rounded-full blur-3xl"></div>
        </div>
        
        <div class="container relative z-10 px-4 sm:px-6 lg:px-8">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-16 animate-on-scroll">
                    <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6">
                        Why Choose Our <span class="text-accent-400 font-accent italic">Programs?</span>
                    </h2>
                    <div class="w-32 h-1 bg-gradient-to-r from-transparent via-accent-500 to-transparent mx-auto"></div>
                </div>
                
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div class="bg-white/5 backdrop-blur-md rounded-2xl p-8 border border-white/10 shadow-xl hover:bg-white/10 transition-all duration-300 transform hover:-translate-y-2 animate-on-scroll">
                        <div class="w-16 h-16 bg-gradient-to-br from-accent-400 to-accent-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                            <i class="fas fa-certificate text-white text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-4">Internationally Certified</h3>
                        <p class="text-gray-300 leading-relaxed">Globally recognized certifications that open doors to new opportunities worldwide.</p>
                    </div>
                    
                    <div class="bg-white/5 backdrop-blur-md rounded-2xl p-8 border border-white/10 shadow-xl hover:bg-white/10 transition-all duration-300 transform hover:-translate-y-2 animate-on-scroll">
                        <div class="w-16 h-16 bg-gradient-to-br from-primary-600 to-primary-800 rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                            <i class="fas fa-users text-white text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-4">Expert Coaches</h3>
                        <p class="text-gray-300 leading-relaxed">Learn from experienced professionals with proven track records of success.</p>
                    </div>
                    
                    <div class="bg-white/5 backdrop-blur-md rounded-2xl p-8 border border-white/10 shadow-xl hover:bg-white/10 transition-all duration-300 transform hover:-translate-y-2 animate-on-scroll">
                        <div class="w-16 h-16 bg-gradient-to-br from-accent-400 to-accent-600 rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                            <i class="fas fa-chart-line text-white text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-4">Proven Results</h3>
                        <p class="text-gray-300 leading-relaxed">Join thousands who have transformed their lives through our programs.</p>
                    </div>
                    
                    <div class="bg-white/5 backdrop-blur-md rounded-2xl p-8 border border-white/10 shadow-xl hover:bg-white/10 transition-all duration-300 transform hover:-translate-y-2 animate-on-scroll">
                        <div class="w-16 h-16 bg-gradient-to-br from-primary-600 to-primary-800 rounded-2xl flex items-center justify-center mb-6 shadow-lg">
                            <i class="fas fa-handshake text-white text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-4">Lifetime Support</h3>
                        <p class="text-gray-300 leading-relaxed">Ongoing support and community access even after program completion.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="relative py-20 lg:py-32 bg-gradient-to-br from-white via-accent-50/20 to-primary-50/30 overflow-hidden">
        <div class="absolute top-0 right-0 w-96 h-96 bg-accent-500/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-primary-500/5 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2"></div>
        
        <div class="container relative z-10 px-4 sm:px-6 lg:px-8">
            <div class="max-w-4xl mx-auto text-center animate-on-scroll">
                <div class="bg-white rounded-3xl p-12 md:p-16 shadow-2xl border border-primary-100">
                    <h2 class="text-4xl md:text-5xl font-bold text-primary-900 mb-6">
                        Not Sure Which Program Is <span class="text-accent-500 font-accent italic">Right For You?</span>
                    </h2>
                    <p class="text-xl text-gray-700 mb-10 leading-relaxed max-w-2xl mx-auto">
                        Contact us for a free consultation to discuss your goals and find the perfect program tailored to your needs.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('contact') }}" 
                           class="inline-flex items-center gap-3 px-10 py-5 bg-gradient-to-r from-accent-500 to-accent-600 text-primary-900 font-bold text-lg rounded-xl hover:from-accent-400 hover:to-accent-500 transform hover:scale-105 transition-all duration-300 shadow-2xl hover:shadow-accent-500/50">
                            <i class="fas fa-calendar-check text-xl"></i>
                            <span>Schedule Consultation</span>
                        </a>
                        <a href="{{ route('about') }}" 
                           class="inline-flex items-center gap-3 px-10 py-5 bg-white border-2 border-primary-600 text-primary-600 font-semibold text-lg rounded-xl hover:bg-primary-600 hover:text-white transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                            <i class="fas fa-users text-xl"></i>
                            <span>Meet Our Coaches</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
    @keyframes shimmer {
        0% {
            transform: translateX(-100%);
        }
        100% {
            transform: translateX(100%);
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Scroll to programs section
    function scrollToPrograms() {
        const programsSection = document.querySelector('section:nth-of-type(2)');
        if (programsSection) {
            programsSection.scrollIntoView({ 
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
