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
            (object)['label' => 'Events', 'url' => route('events.index')],
            (object)['label' => 'Coaches', 'url' => route('coaches.index')],
            (object)['label' => 'Videos', 'url' => route('videos.index')],
            (object)['label' => 'Become a Coach', 'url' => route('become-a-coach')],
            (object)['label' => 'Blogs', 'url' => route('blog.index')],
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
    
    // Logo - prioritize uploaded file, then URL, then fallback
    $logoFile = \App\Models\Setting::get('logo_file', '');
    $logoUrl = \App\Models\Setting::get('logo_url', config('app.logo_url', ''));
    $logo = $logoFile ? asset('storage/' . $logoFile) : ($logoUrl ?: null);
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
            <a href="{{ route('home') }}" class="flex items-center h-full gap-2 hover:opacity-80 transition-opacity duration-300 group">
                @if($logo)
                    <img src="{{ $logo }}" 
                         alt="{{ config('app.name', 'DLC') }} Logo" 
                         class="h-20 w-auto object-contain max-w-[200px] group-hover:scale-105 transition-transform duration-300"
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
                        $isExternal = str_starts_with($navUrl, 'http://') || str_starts_with($navUrl, 'https://');
                        
                        // Check exact match (only for internal links)
                        if (!$isExternal && $currentUrl === $navUrl) {
                            $isActive = true;
                        } else if (!$isExternal) {
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
                    <a href="{{ $nav->url }}" @if($isExternal) target="_blank" rel="noopener noreferrer" @endif 
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
                    <span class="relative z-10 transition-all duration-300 group-hover:tracking-wide">Contact Us</span>
                    <!-- Hover effect overlay -->
                    <span class="absolute inset-0 rounded-lg bg-gradient-to-r from-transparent via-primary-700/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></span>
                </a>
            </div>

            <!-- Mobile Menu Toggle Button -->
            <button type="button" id="mobile-menu-btn" class="lg:hidden w-10 h-10 flex items-center justify-center text-gray-700 hover:text-primary-600 rounded-lg">
                <i class="fas fa-bars text-2xl" id="menu-icon"></i>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="lg:hidden" style="display: none; position: fixed; top: 80px; left: 0; right: 0; bottom: 0; z-index: 9999;">
            <!-- Backdrop -->
            <div id="menu-backdrop" style="position: fixed; top: 80px; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5);"></div>
            
            <!-- Menu Panel -->
            <div id="menu-panel" style="position: fixed; top: 80px; left: 0; bottom: 0; width: 320px; max-width: 90%; background: #ffffff; box-shadow: 2px 0 10px rgba(0,0,0,0.2); overflow-y: auto; z-index: 10000;">
                <div style="padding: 24px;">
                    <h3 style="font-size: 18px; font-weight: 700; color: #1e3a5f; margin-bottom: 20px; padding-bottom: 12px; border-bottom: 2px solid #f8b016;">Menu</h3>
                    @foreach($navigations as $nav)
                        @php
                            $currentUrl = request()->url();
                            $navUrl = $nav->url;
                            $isActive = false;
                            $isExternal = str_starts_with($navUrl, 'http://') || str_starts_with($navUrl, 'https://');
                            
                            if (!$isExternal && $currentUrl === $navUrl) {
                                $isActive = true;
                            } else if (!$isExternal) {
                                $parsedNavUrl = parse_url($navUrl);
                                $parsedCurrentUrl = parse_url($currentUrl);
                                
                                if (isset($parsedNavUrl['path']) && isset($parsedCurrentUrl['path'])) {
                                    $navPath = rtrim($parsedNavUrl['path'], '/');
                                    $currentPath = rtrim($parsedCurrentUrl['path'], '/');
                                    
                                    if ($navPath === $currentPath || ($navPath !== '/' && str_starts_with($currentPath, $navPath))) {
                                        $isActive = true;
                                    }
                                }
                            }
                        @endphp
                        <a href="{{ $nav->url }}" 
                           @if($isExternal) target="_blank" rel="noopener noreferrer" @endif
                           class="mobile-menu-link"
                           style="display: block; padding: 16px; margin-bottom: 8px; border-radius: 8px; font-weight: 600; color: #1f2937; text-decoration: none; background: {{ $isActive ? '#eff6ff' : '#ffffff' }}; border: 2px solid {{ $isActive ? '#f8b016' : 'rgba(248, 176, 22, 0.3)' }};">
                            <div style="display: flex; align-items: center; justify-content: space-between;">
                                <span style="color: {{ $isActive ? '#1e40af' : '#1f2937' }};">{{ $nav->label }}</span>
                                @if($isExternal)
                                    <i class="fas fa-external-link-alt" style="font-size: 12px; color: #9ca3af;"></i>
                                @else
                                    <i class="fas fa-chevron-right" style="font-size: 12px; color: #9ca3af;"></i>
                                @endif
                            </div>
                        </a>
                    @endforeach
                    <a href="{{ route('contact') }}" 
                       class="mobile-menu-link"
                       style="display: block; width: 100%; margin-top: 16px; padding: 16px; background-color: #1e3a5f; color: #ffffff; text-align: center; border-radius: 8px; font-weight: 600; text-decoration: none; border: 2px solid #f8b016;">
                        Contact Us
                    </a>
                </div>
            </div>
        </div>
    </nav>
</header>

<script>
(function() {
    'use strict';
    
    function initMobileMenu() {
        var menuBtn = document.getElementById('mobile-menu-btn');
        var mobileMenu = document.getElementById('mobile-menu');
        var menuIcon = document.getElementById('menu-icon');
        var backdrop = document.getElementById('menu-backdrop');
        var menuPanel = document.getElementById('menu-panel');
        
        if (!menuBtn || !mobileMenu || !menuIcon) {
            return;
        }
        
        var isOpen = false;
        
        function showMenu() {
            mobileMenu.style.display = 'block';
            menuIcon.className = 'fas fa-times text-2xl';
            document.body.style.overflow = 'hidden';
            isOpen = true;
        }
        
        function hideMenu() {
            mobileMenu.style.display = 'none';
            menuIcon.className = 'fas fa-bars text-2xl';
            document.body.style.overflow = '';
            isOpen = false;
        }
        
        // Toggle button
        menuBtn.onclick = function(e) {
            e.preventDefault();
            e.stopPropagation();
            if (isOpen) {
                hideMenu();
            } else {
                showMenu();
            }
        };
        
        // Backdrop click
        if (backdrop) {
            backdrop.onclick = function(e) {
                e.stopPropagation();
                if (isOpen) {
                    hideMenu();
                }
            };
        }
        
        // Prevent panel clicks from closing
        if (menuPanel) {
            menuPanel.onclick = function(e) {
                e.stopPropagation();
            };
        }
        
        // Close on link click
        var links = mobileMenu.querySelectorAll('a');
        for (var i = 0; i < links.length; i++) {
            links[i].onclick = function() {
                setTimeout(hideMenu, 150);
            };
        }
    }
    
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initMobileMenu);
    } else {
        initMobileMenu();
    }
})();
</script>

