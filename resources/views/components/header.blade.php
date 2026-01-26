@php
    try {
        $navigations = \App\Models\Navigation::where('is_visible', true)
            ->where('location', 'header')
            ->orderBy('order')
            ->get();
    } catch (\Exception $e) {
        // Fallback if migrations haven't run yet
        $navigations = collect([
            (object)['label' => 'Home', 'url' => route('home')],
            (object)['label' => 'About Us', 'url' => route('about')],
            (object)['label' => 'Events', 'url' => route('events')],
            (object)['label' => 'Videos', 'url' => route('videos.index')],
            (object)['label' => 'Become a Coach', 'url' => route('become-a-coach')],
            (object)['label' => 'Contact', 'url' => route('contact')],
        ]);
    }
    
    // Contact information - get from database settings, fallback to config
    $phone = \App\Models\Setting::get('phone', config('app.phone', '+254 722 992 111'));
    $email = \App\Models\Setting::get('email', config('app.email', 'info@dlc.co.ke'));
    $location = \App\Models\Setting::get('location', config('app.location', 'Nairobi, Kenya'));
    
    // Social media links - get from database settings, fallback to config
    $facebook = \App\Models\Setting::get('social_facebook', config('app.social.facebook', ''));
    $linkedin = \App\Models\Setting::get('social_linkedin', config('app.social.linkedin', ''));
    $instagram = \App\Models\Setting::get('social_instagram', config('app.social.instagram', ''));
    $twitter = \App\Models\Setting::get('social_twitter', config('app.social.twitter', ''));
    $youtube = \App\Models\Setting::get('social_youtube', config('app.social.youtube', ''));
    
    // Logo URL - get from database settings, fallback to config
    $logoUrl = \App\Models\Setting::get('logo_url', config('app.logo_url', ''));
@endphp

<!-- Top Header Bar -->
<div class="hidden lg:block bg-gradient-to-r from-primary-900 via-primary-800 to-primary-900 text-white text-[10px] md:text-xs py-1 md:py-1.5 border-b border-primary-700/50 shadow-sm">
    <div class="container mx-auto px-3 md:px-4 lg:px-6">
        <div class="flex flex-col md:flex-row items-center justify-between gap-1.5 md:gap-2">
            <!-- Contact Information - Mobile Optimized -->
            <div class="flex flex-wrap items-center justify-center md:justify-start gap-1.5 md:gap-2 w-full md:w-auto">
                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}" 
                   class="group relative flex items-center gap-1 md:gap-1.5 px-2 md:px-2.5 py-1 md:py-1 rounded-md bg-primary-800/20 border-2 hover:bg-primary-800/40 hover:border-accent-500 hover:text-accent-400 transition-all duration-300 active:scale-95"
                   style="border-color: rgba(248, 176, 22, 0.4);">
                    <div class="w-4 h-4 md:w-5 md:h-5 flex items-center justify-center rounded-full bg-accent-500/20 border border-accent-500/40 group-hover:bg-accent-500 group-hover:border-accent-500 group-hover:text-primary-900 transition-all duration-300 flex-shrink-0">
                        <i class="fas fa-phone text-[8px] md:text-[10px] group-hover:scale-110 transition-transform"></i>
                    </div>
                    <span class="font-medium text-[10px] md:text-xs tracking-wide whitespace-nowrap">{{ $phone }}</span>
                </a>
                
                <div class="hidden md:block w-px h-4 bg-primary-700/40"></div>
                
                <a href="mailto:{{ $email }}" 
                   class="group relative flex items-center gap-1 md:gap-1.5 px-2 md:px-2.5 py-1 md:py-1 rounded-md bg-primary-800/20 border-2 hover:bg-primary-800/40 hover:border-accent-500 hover:text-accent-400 transition-all duration-300 active:scale-95"
                   style="border-color: rgba(248, 176, 22, 0.4);">
                    <div class="w-4 h-4 md:w-5 md:h-5 flex items-center justify-center rounded-full bg-accent-500/20 border border-accent-500/40 group-hover:bg-accent-500 group-hover:border-accent-500 group-hover:text-primary-900 transition-all duration-300 flex-shrink-0">
                        <i class="fas fa-envelope text-[8px] md:text-[10px] group-hover:scale-110 transition-transform"></i>
                    </div>
                    <span class="font-medium text-[10px] md:text-xs tracking-wide truncate max-w-[100px] md:max-w-none">{{ $email }}</span>
                </a>
                
                <div class="hidden md:block w-px h-4 bg-primary-700/40"></div>
                
                <div class="group hidden md:flex items-center gap-1 md:gap-1.5 px-2 md:px-2.5 py-1 md:py-1 rounded-md bg-primary-800/20 border-2 hover:bg-primary-800/40 hover:border-accent-500 hover:text-accent-400 transition-all duration-300 active:scale-95"
                     style="border-color: rgba(248, 176, 22, 0.4);">
                    <div class="w-4 h-4 md:w-5 md:h-5 flex items-center justify-center rounded-full bg-accent-500/20 border border-accent-500/40 group-hover:bg-accent-500 group-hover:border-accent-500 group-hover:text-primary-900 transition-all duration-300 flex-shrink-0">
                        <i class="fas fa-map-marker-alt text-[8px] md:text-[10px] group-hover:scale-110 transition-transform"></i>
                    </div>
                    <span class="font-medium text-[10px] md:text-xs tracking-wide">{{ $location }}</span>
                </div>
            </div>
            
            <!-- Social Media Links - Mobile Optimized -->
            <div class="flex items-center gap-1 md:gap-1.5 flex-shrink-0">
                @if($linkedin)
                <a href="{{ $linkedin }}" target="_blank" rel="noopener noreferrer" 
                   class="w-6 h-6 md:w-7 md:h-7 flex items-center justify-center rounded-full bg-primary-800/30 border-2 border-accent-500/50 hover:border-accent-500 hover:bg-accent-500 hover:text-primary-900 transition-all duration-300 active:scale-95 hover:scale-110 hover:shadow-lg hover:shadow-accent-500/30 group"
                   aria-label="LinkedIn">
                    <i class="fab fa-linkedin-in text-[10px] md:text-xs group-hover:scale-110 transition-transform"></i>
                </a>
                @endif
                @if($facebook)
                <a href="{{ $facebook }}" target="_blank" rel="noopener noreferrer" 
                   class="w-6 h-6 md:w-7 md:h-7 flex items-center justify-center rounded-full bg-primary-800/30 border-2 border-accent-500/50 hover:border-accent-500 hover:bg-accent-500 hover:text-primary-900 transition-all duration-300 active:scale-95 hover:scale-110 hover:shadow-lg hover:shadow-accent-500/30 group"
                   aria-label="Facebook">
                    <i class="fab fa-facebook-f text-[10px] md:text-xs group-hover:scale-110 transition-transform"></i>
                </a>
                @endif
                @if($instagram)
                <a href="{{ $instagram }}" target="_blank" rel="noopener noreferrer" 
                   class="w-6 h-6 md:w-7 md:h-7 flex items-center justify-center rounded-full bg-primary-800/30 border-2 border-accent-500/50 hover:border-accent-500 hover:bg-accent-500 hover:text-primary-900 transition-all duration-300 active:scale-95 hover:scale-110 hover:shadow-lg hover:shadow-accent-500/30 group"
                   aria-label="Instagram">
                    <i class="fab fa-instagram text-[10px] md:text-xs group-hover:scale-110 transition-transform"></i>
                </a>
                @endif
                @if($twitter)
                <a href="{{ $twitter }}" target="_blank" rel="noopener noreferrer" 
                   class="w-6 h-6 md:w-7 md:h-7 flex items-center justify-center rounded-full bg-primary-800/30 border-2 border-accent-500/50 hover:border-accent-500 hover:bg-accent-500 hover:text-primary-900 transition-all duration-300 active:scale-95 hover:scale-110 hover:shadow-lg hover:shadow-accent-500/30 group"
                   aria-label="Twitter/X">
                    <i class="fab fa-twitter text-[10px] md:text-xs group-hover:scale-110 transition-transform"></i>
                </a>
                @endif
                @if($youtube)
                <a href="{{ $youtube }}" target="_blank" rel="noopener noreferrer" 
                   class="w-6 h-6 md:w-7 md:h-7 flex items-center justify-center rounded-full bg-primary-800/30 border-2 border-accent-500/50 hover:border-accent-500 hover:bg-accent-500 hover:text-primary-900 transition-all duration-300 active:scale-95 hover:scale-110 hover:shadow-lg hover:shadow-accent-500/30 group"
                   aria-label="YouTube">
                    <i class="fab fa-youtube text-[10px] md:text-xs group-hover:scale-110 transition-transform"></i>
                </a>
                @endif
            </div>
        </div>
    </div>
</div>

<header class="hidden lg:block sticky top-0 z-50 bg-white/95 backdrop-blur-sm shadow-sm border-b border-gray-100" id="header">
    <nav class="container mx-auto px-4 lg:px-6">
        <div class="flex items-center justify-between h-20">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-2 hover:opacity-80 transition-opacity duration-300 group">
                @if($logoUrl)
                    <img src="{{ $logoUrl }}" 
                         alt="{{ config('app.name', 'DLC') }} Logo" 
                         class="h-10 md:h-12 lg:h-14 w-auto object-contain max-w-[200px] group-hover:scale-105 transition-transform duration-300"
                         onerror="this.onerror=null; this.src=''; this.style.display='none'; this.nextElementSibling.classList.remove('hidden');">
                    <div class="hidden flex-col">
                        <span class="text-xl md:text-2xl font-bold text-primary-600">DLC</span>
                        <span class="text-[10px] md:text-xs text-gray-600">Destiny Life Coaching</span>
                    </div>
                @else
                    <div class="flex flex-col">
                        <span class="text-xl md:text-2xl font-bold text-primary-600">DLC</span>
                        <span class="text-[10px] md:text-xs text-gray-600">Destiny Life Coaching</span>
                    </div>
                @endif
            </a>

            <!-- Desktop Navigation -->
            <div class="hidden lg:flex items-center gap-3">
                @foreach($navigations as $nav)
                    @php
                        // Check if current URL matches navigation URL
                        $currentUrl = request()->url();
                        $navUrl = $nav->url;
                        $isActive = false;
                        
                        // Check exact match
                        if ($currentUrl === $navUrl) {
                            $isActive = true;
                        } else {
                            // Check if current URL starts with navigation URL (for sub-pages)
                            $parsedNavUrl = parse_url($navUrl);
                            $parsedCurrentUrl = parse_url($currentUrl);
                            
                            if (isset($parsedNavUrl['path']) && isset($parsedCurrentUrl['path'])) {
                                $navPath = rtrim($parsedNavUrl['path'], '/');
                                $currentPath = rtrim($parsedCurrentUrl['path'], '/');
                                
                                // Match if paths are the same or current path starts with nav path
                                if ($navPath === $currentPath || ($navPath !== '/' && str_starts_with($currentPath, $navPath))) {
                                    $isActive = true;
                                }
                            }
                        }
                    @endphp
                    <a href="{{ $nav->url }}" 
                       class="relative group px-4 py-2.5 rounded-lg transition-all duration-300 ease-in-out border
                              {{ $isActive 
                                  ? 'text-primary-600 bg-primary-50 shadow-sm scale-100' 
                                  : 'text-gray-700 hover:text-primary-600 hover:bg-gradient-to-br hover:from-gray-50 hover:to-primary-50/30 hover:shadow-md hover:-translate-y-0.5 hover:scale-105' }}"
                       style="border-color: {{ $isActive ? '#f8b016' : 'rgba(248, 176, 22, 0.3)' }};">
                        <span class="relative z-10 font-medium transition-all duration-300 group-hover:tracking-wide">{{ $nav->label }}</span>
                        @if($isActive)
                            <span class="absolute inset-0 rounded-lg bg-gradient-to-r from-primary-50 to-transparent opacity-50"></span>
                            <span class="absolute bottom-0 left-0 right-0 h-0.5 bg-accent-500 rounded-full"></span>
                        @endif
                        <!-- Hover effect overlay -->
                        <span class="absolute inset-0 rounded-lg bg-gradient-to-r from-transparent via-primary-100/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                    </a>
                @endforeach
                <a href="{{ route('contact') }}" 
                   class="relative group px-4 py-2.5 rounded-lg transition-all duration-300 ease-in-out border text-white font-medium ml-2 hover:bg-primary-800 hover:shadow-md hover:-translate-y-0.5 hover:scale-105" 
                   style="background-color: #1e3a5f; border-color: #f8b016; filter: none !important; -webkit-filter: none !important;">
                    <span class="relative z-10 transition-all duration-300 group-hover:tracking-wide">Get Started</span>
                    <!-- Hover effect overlay -->
                    <span class="absolute inset-0 rounded-lg bg-gradient-to-r from-transparent via-primary-700/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                </a>
            </div>

            <!-- Mobile Menu Toggle -->
            <button id="mobile-menu-toggle" class="lg:hidden text-gray-700 focus:outline-none">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>

        <!-- Mobile Navigation -->
        <div id="mobile-menu" class="lg:hidden fixed inset-0 top-20 bg-white z-40 transform transition-transform duration-300 ease-in-out -translate-x-full">
            <div class="h-full overflow-y-auto pb-20">
                <div class="flex flex-col gap-1 p-4">
                    @foreach($navigations as $nav)
                        @php
                            // Check if current URL matches navigation URL
                            $currentUrl = request()->url();
                            $navUrl = $nav->url;
                            $isActive = false;
                            
                            // Check exact match
                            if ($currentUrl === $navUrl) {
                                $isActive = true;
                            } else {
                                // Check if current URL starts with navigation URL (for sub-pages)
                                $parsedNavUrl = parse_url($navUrl);
                                $parsedCurrentUrl = parse_url($currentUrl);
                                
                                if (isset($parsedNavUrl['path']) && isset($parsedCurrentUrl['path'])) {
                                    $navPath = rtrim($parsedNavUrl['path'], '/');
                                    $currentPath = rtrim($parsedCurrentUrl['path'], '/');
                                    
                                    // Match if paths are the same or current path starts with nav path
                                    if ($navPath === $currentPath || ($navPath !== '/' && str_starts_with($currentPath, $navPath))) {
                                        $isActive = true;
                                    }
                                }
                            }
                        @endphp
                        <a href="{{ $nav->url }}" 
                           class="relative group px-4 py-4 rounded-xl font-semibold text-base transition-all duration-300 ease-in-out border-2 active:scale-98
                                  {{ $isActive 
                                      ? 'text-primary-600 bg-primary-50 shadow-md' 
                                      : 'text-gray-700 hover:text-primary-600 hover:bg-gradient-to-r hover:from-gray-50 hover:to-primary-50/30 hover:shadow-md active:bg-primary-50' }}"
                           style="border-color: {{ $isActive ? '#f8b016' : 'rgba(248, 176, 22, 0.3)' }};">
                            <div class="flex items-center justify-between">
                                <span class="relative z-10 transition-all duration-300">{{ $nav->label }}</span>
                                <i class="fas fa-chevron-right text-xs text-gray-400 group-hover:text-primary-600 group-hover:translate-x-1 transition-all duration-300"></i>
                            </div>
                            @if($isActive)
                                <div class="absolute left-0 top-0 bottom-0 w-1 bg-accent-500 rounded-l-xl"></div>
                                <div class="absolute right-4 top-1/2 -translate-y-1/2 w-2 h-2 bg-accent-500 rounded-full"></div>
                            @endif
                        </a>
                    @endforeach
                    <a href="{{ route('contact') }}" 
                       class="btn btn-primary w-full text-center mt-4 py-4 text-base font-semibold shadow-lg hover:shadow-xl active:scale-98 transition-all duration-300" 
                       style="filter: none !important; -webkit-filter: none !important;">
                        <i class="fas fa-rocket mr-2"></i> Get Started
                    </a>
                </div>
            </div>
            <!-- Backdrop -->
            <div id="mobile-menu-backdrop" class="absolute inset-0 bg-black/20 backdrop-blur-sm -z-10"></div>
        </div>
    </nav>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuToggle = document.getElementById('mobile-menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        const backdrop = document.getElementById('mobile-menu-backdrop');
        const body = document.body;
        
        if (menuToggle && mobileMenu) {
            menuToggle.addEventListener('click', function() {
                const icon = this.querySelector('i');
                const isOpen = !mobileMenu.classList.contains('-translate-x-full');
                
                if (isOpen) {
                    // Close menu
                    mobileMenu.classList.add('-translate-x-full');
                    icon.classList.remove('fa-times');
                    icon.classList.add('fa-bars');
                    body.style.overflow = '';
                } else {
                    // Open menu
                    mobileMenu.classList.remove('-translate-x-full');
                    mobileMenu.classList.remove('hidden');
                    icon.classList.remove('fa-bars');
                    icon.classList.add('fa-times');
                    body.style.overflow = 'hidden';
                }
            });
            
            // Close menu when clicking backdrop
            if (backdrop) {
                backdrop.addEventListener('click', function() {
                    mobileMenu.classList.add('-translate-x-full');
                    const icon = menuToggle.querySelector('i');
                    icon.classList.remove('fa-times');
                    icon.classList.add('fa-bars');
                    body.style.overflow = '';
                });
            }
            
            // Close menu when clicking a link
            mobileMenu.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', function() {
                    setTimeout(() => {
                        mobileMenu.classList.add('-translate-x-full');
                        const icon = menuToggle.querySelector('i');
                        icon.classList.remove('fa-times');
                        icon.classList.add('fa-bars');
                        body.style.overflow = '';
                    }, 300);
                });
            });
        }
    });
</script>

