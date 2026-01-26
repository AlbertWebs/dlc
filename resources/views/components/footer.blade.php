@php
    try {
        $footerLinks = \App\Models\Navigation::where('is_visible', true)
            ->where('location', 'footer')
            ->orderBy('order')
            ->get();
        $programs = \App\Models\Program::where('is_published', true)->orderBy('order')->limit(5)->get();
        
        // Get settings from database
        $settings = [
            'site_name' => \App\Models\Setting::get('site_name', 'DLC'),
            'email' => \App\Models\Setting::get('email', 'info@dlc.co.ke'),
            'phone' => \App\Models\Setting::get('phone', '+254 722 992 111'),
            'address' => \App\Models\Setting::get('address', ''),
            'city' => \App\Models\Setting::get('city', 'Nairobi'),
            'country' => \App\Models\Setting::get('country', 'Kenya'),
            'location' => \App\Models\Setting::get('location', 'Nairobi, Kenya'),
            'social_facebook' => \App\Models\Setting::get('social_facebook', ''),
            'social_twitter' => \App\Models\Setting::get('social_twitter', ''),
            'social_linkedin' => \App\Models\Setting::get('social_linkedin', ''),
            'social_instagram' => \App\Models\Setting::get('social_instagram', ''),
            'social_youtube' => \App\Models\Setting::get('social_youtube', ''),
        ];
        
        // Get about section description for footer
        $aboutDescription = \App\Models\Setting::get('about_section_subtitle', 'We are dedicated to empowering individuals through professional coaching and certification programs that transform lives.');
    } catch (\Exception $e) {
        $footerLinks = collect([]);
        $programs = collect([]);
        $settings = [
            'site_name' => 'DLC',
            'email' => 'info@dlc.co.ke',
            'phone' => '+254 722 992 111',
            'address' => '',
            'city' => 'Nairobi',
            'country' => 'Kenya',
            'location' => 'Nairobi, Kenya',
            'social_facebook' => '',
            'social_twitter' => '',
            'social_linkedin' => '',
            'social_instagram' => '',
            'social_youtube' => '',
        ];
        $aboutDescription = 'We are dedicated to empowering individuals through professional coaching and certification programs that transform lives.';
    }
@endphp

<footer class="mt-20">
    <!-- Main Footer Section -->
    <div class="bg-gradient-to-br from-primary-900 via-primary-800 to-primary-950 text-white">
        <div class="container mx-auto px-4 lg:px-6 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12">
                <!-- Column 1: About -->
                <div class="lg:col-span-1">
                    <h3 class="text-xl font-bold mb-4 text-accent-400">About {{ $settings['site_name'] }}</h3>
                    <p class="text-gray-300 text-sm leading-relaxed mb-6">
                        {{ \Illuminate\Support\Str::limit($aboutDescription, 120) }}
                    </p>
                    <!-- Social Media Icons -->
                    <div class="flex flex-wrap gap-3">
                        @if($settings['social_facebook'])
                            <a href="{{ $settings['social_facebook'] }}" target="_blank" rel="noopener noreferrer" 
                               class="w-10 h-10 bg-gradient-to-br from-primary-700 to-primary-800 hover:from-accent-500 hover:to-accent-600 rounded-lg flex items-center justify-center transition-all duration-300 transform hover:scale-110 hover:shadow-lg shadow-md" 
                               aria-label="Facebook">
                                <i class="fab fa-facebook-f text-sm"></i>
                            </a>
                        @endif
                        @if($settings['social_twitter'])
                            <a href="{{ $settings['social_twitter'] }}" target="_blank" rel="noopener noreferrer" 
                               class="w-10 h-10 bg-gradient-to-br from-primary-700 to-primary-800 hover:from-accent-500 hover:to-accent-600 rounded-lg flex items-center justify-center transition-all duration-300 transform hover:scale-110 hover:shadow-lg shadow-md" 
                               aria-label="Twitter">
                                <i class="fab fa-twitter text-sm"></i>
                            </a>
                        @endif
                        @if($settings['social_linkedin'])
                            <a href="{{ $settings['social_linkedin'] }}" target="_blank" rel="noopener noreferrer" 
                               class="w-10 h-10 bg-gradient-to-br from-primary-700 to-primary-800 hover:from-accent-500 hover:to-accent-600 rounded-lg flex items-center justify-center transition-all duration-300 transform hover:scale-110 hover:shadow-lg shadow-md" 
                               aria-label="LinkedIn">
                                <i class="fab fa-linkedin-in text-sm"></i>
                            </a>
                        @endif
                        @if($settings['social_instagram'])
                            <a href="{{ $settings['social_instagram'] }}" target="_blank" rel="noopener noreferrer" 
                               class="w-10 h-10 bg-gradient-to-br from-primary-700 to-primary-800 hover:from-accent-500 hover:to-accent-600 rounded-lg flex items-center justify-center transition-all duration-300 transform hover:scale-110 hover:shadow-lg shadow-md" 
                               aria-label="Instagram">
                                <i class="fab fa-instagram text-sm"></i>
                            </a>
                        @endif
                        @if($settings['social_youtube'])
                            <a href="{{ $settings['social_youtube'] }}" target="_blank" rel="noopener noreferrer" 
                               class="w-10 h-10 bg-gradient-to-br from-primary-700 to-primary-800 hover:from-accent-500 hover:to-accent-600 rounded-lg flex items-center justify-center transition-all duration-300 transform hover:scale-110 hover:shadow-lg shadow-md" 
                               aria-label="YouTube">
                                <i class="fab fa-youtube text-sm"></i>
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Column 2: Quick Links -->
                <div>
                    <h3 class="text-xl font-bold mb-4 text-accent-400">Quick Links</h3>
                    <ul class="space-y-3">
                        @forelse($footerLinks->where('category', 'quick_links') as $link)
                            <li>
                                <a href="{{ $link->url }}" class="text-gray-300 hover:text-accent-400 transition-colors text-sm flex items-center gap-2 group">
                                    <i class="fas fa-chevron-right text-xs text-accent-500/50 group-hover:text-accent-400 group-hover:translate-x-1 transition-all"></i>
                                    {{ $link->label }}
                                </a>
                            </li>
                        @empty
                            <li>
                                <a href="{{ route('home') }}" class="text-gray-300 hover:text-accent-400 transition-colors text-sm flex items-center gap-2 group">
                                    <i class="fas fa-chevron-right text-xs text-accent-500/50 group-hover:text-accent-400 group-hover:translate-x-1 transition-all"></i>
                                    Home
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('about') }}" class="text-gray-300 hover:text-accent-400 transition-colors text-sm flex items-center gap-2 group">
                                    <i class="fas fa-chevron-right text-xs text-accent-500/50 group-hover:text-accent-400 group-hover:translate-x-1 transition-all"></i>
                                    About Us
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('programs.index') }}" class="text-gray-300 hover:text-accent-400 transition-colors text-sm flex items-center gap-2 group">
                                    <i class="fas fa-chevron-right text-xs text-accent-500/50 group-hover:text-accent-400 group-hover:translate-x-1 transition-all"></i>
                                    Programs
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('contact') }}" class="text-gray-300 hover:text-accent-400 transition-colors text-sm flex items-center gap-2 group">
                                    <i class="fas fa-chevron-right text-xs text-accent-500/50 group-hover:text-accent-400 group-hover:translate-x-1 transition-all"></i>
                                    Contact
                                </a>
                            </li>
                        @endforelse
                    </ul>
                </div>

                <!-- Column 3: Programs -->
                <div>
                    <h3 class="text-xl font-bold mb-4 text-accent-400">Programs</h3>
                    <ul class="space-y-3">
                        @forelse($programs as $program)
                            <li>
                                <a href="{{ route('programs.show', $program->slug) }}" class="text-gray-300 hover:text-accent-400 transition-colors text-sm flex items-center gap-2 group">
                                    <i class="fas fa-chevron-right text-xs text-accent-500/50 group-hover:text-accent-400 group-hover:translate-x-1 transition-all"></i>
                                    {{ $program->title }}
                                </a>
                            </li>
                        @empty
                            <li class="text-gray-400 text-sm italic">No programs available</li>
                        @endforelse
                        @if($programs->count() > 0)
                            <li class="pt-2">
                                <a href="{{ route('programs.index') }}" class="text-accent-400 hover:text-accent-300 font-semibold text-sm flex items-center gap-2 group">
                                    View All Programs
                                    <i class="fas fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>

                <!-- Column 4: Contact Info -->
                <div>
                    <h3 class="text-xl font-bold mb-4 text-accent-400">Contact Us</h3>
                    <ul class="space-y-4">
                        @if($settings['email'])
                            <li class="flex items-start gap-3 group">
                                <div class="w-10 h-10 bg-gradient-to-br from-accent-500/20 to-accent-600/20 rounded-lg flex items-center justify-center group-hover:from-accent-500/30 group-hover:to-accent-600/30 transition-all">
                                    <i class="fas fa-envelope text-accent-400"></i>
                                </div>
                                <div>
                                    <a href="mailto:{{ $settings['email'] }}" class="text-gray-300 hover:text-accent-400 transition-colors text-sm block">
                                        {{ $settings['email'] }}
                                    </a>
                                </div>
                            </li>
                        @endif
                        @if($settings['phone'])
                            <li class="flex items-start gap-3 group">
                                <div class="w-10 h-10 bg-gradient-to-br from-accent-500/20 to-accent-600/20 rounded-lg flex items-center justify-center group-hover:from-accent-500/30 group-hover:to-accent-600/30 transition-all">
                                    <i class="fas fa-phone text-accent-400"></i>
                                </div>
                                <div>
                                    <a href="tel:{{ $settings['phone'] }}" class="text-gray-300 hover:text-accent-400 transition-colors text-sm block">
                                        {{ $settings['phone'] }}
                                    </a>
                                </div>
                            </li>
                        @endif
                        @if($settings['address'] || $settings['location'])
                            <li class="flex items-start gap-3 group">
                                <div class="w-10 h-10 bg-gradient-to-br from-accent-500/20 to-accent-600/20 rounded-lg flex items-center justify-center group-hover:from-accent-500/30 group-hover:to-accent-600/30 transition-all">
                                    <i class="fas fa-map-marker-alt text-accent-400"></i>
                                </div>
                                <div>
                                    <span class="text-gray-300 text-sm block">
                                        @if($settings['address'])
                                            {{ $settings['address'] }}<br>
                                        @endif
                                        @if($settings['city'] && $settings['country'])
                                            {{ $settings['city'] }}, {{ $settings['country'] }}
                                        @else
                                            {{ $settings['location'] }}
                                        @endif
                                    </span>
                                </div>
                            </li>
                        @endif
                        <li class="pt-2">
                            <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-accent-500 to-accent-600 hover:from-accent-400 hover:to-accent-500 text-primary-900 font-semibold rounded-lg transition-all duration-300 transform hover:scale-105 shadow-md hover:shadow-lg text-sm">
                                <i class="fas fa-paper-plane"></i>
                                Get In Touch
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Copyright Section -->
    <div class="bg-primary-950 border-t-2 border-accent-500/20">
        <div class="container mx-auto px-4 lg:px-6 py-6">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="flex flex-col md:flex-row items-center gap-2 md:gap-6 text-sm">
                    <p class="text-gray-400">
                        &copy; {{ date('Y') }} <span class="text-accent-400 font-semibold">{{ $settings['site_name'] }}</span> - Destiny Life Coaching. All rights reserved.
                    </p>
                </div>
                <div class="flex flex-wrap items-center gap-4 md:gap-6">
                    @php
                        $privacyLink = $footerLinks->firstWhere('label', 'Privacy Policy');
                        $termsLink = $footerLinks->firstWhere('label', 'Terms of Service');
                    @endphp
                    @if($privacyLink)
                        <a href="{{ $privacyLink->url }}" class="text-gray-400 hover:text-accent-400 transition-colors text-sm flex items-center gap-1">
                            <i class="fas fa-shield-alt text-xs"></i>
                            Privacy Policy
                        </a>
                    @endif
                    @if($termsLink)
                        <a href="{{ $termsLink->url }}" class="text-gray-400 hover:text-accent-400 transition-colors text-sm flex items-center gap-1">
                            <i class="fas fa-file-contract text-xs"></i>
                            Terms of Service
                        </a>
                    @endif
                    @if(!$privacyLink && !$termsLink)
                        <a href="#" class="text-gray-400 hover:text-accent-400 transition-colors text-sm">Privacy Policy</a>
                        <a href="#" class="text-gray-400 hover:text-accent-400 transition-colors text-sm">Terms of Service</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</footer>


