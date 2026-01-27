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
            'social_whatsapp' => \App\Models\Setting::get('social_whatsapp', ''),
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
            'social_whatsapp' => '',
        ];
        $aboutDescription = 'We are dedicated to empowering individuals through professional coaching and certification programs that transform lives.';
    }
@endphp

<footer class="mt-20">
    <!-- Main Footer Section -->
    <div class="relative bg-gradient-to-br from-primary-900 via-primary-800 to-primary-950 text-white overflow-hidden">
        <!-- Decorative Background -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 right-0 w-96 h-96 bg-accent-500 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-accent-400 rounded-full blur-3xl"></div>
        </div>
        
        <!-- Accent Border Top -->
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-transparent via-accent-500 to-transparent"></div>
        
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-20 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12">
                <!-- Column 1: About -->
                <div class="lg:col-span-1">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-12 h-12 bg-gradient-to-br from-accent-500 to-accent-600 rounded-xl flex items-center justify-center shadow-lg">
                            <i class="fas fa-graduation-cap text-white text-xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-accent-400">{{ $settings['site_name'] }}</h3>
                    </div>
                    <p class="text-gray-300 text-sm leading-relaxed mb-6">
                        {{ \Illuminate\Support\Str::limit($aboutDescription, 140) }}
                    </p>
                    
                    <!-- Social Media Icons -->
                    <div class="flex flex-wrap gap-3">
                        @if($settings['social_facebook'])
                            <a href="{{ $settings['social_facebook'] }}" target="_blank" rel="noopener noreferrer" 
                               class="w-11 h-11 bg-gradient-to-br from-blue-600 to-blue-700 hover:from-blue-500 hover:to-blue-600 rounded-xl flex items-center justify-center transition-all duration-300 transform hover:scale-110 hover:shadow-xl shadow-lg" 
                               aria-label="Facebook">
                                <i class="fab fa-facebook-f text-white text-sm"></i>
                            </a>
                        @endif
                        @if($settings['social_twitter'])
                            <a href="{{ $settings['social_twitter'] }}" target="_blank" rel="noopener noreferrer" 
                               class="w-11 h-11 bg-gradient-to-br from-sky-500 to-sky-600 hover:from-sky-400 hover:to-sky-500 rounded-xl flex items-center justify-center transition-all duration-300 transform hover:scale-110 hover:shadow-xl shadow-lg" 
                               aria-label="Twitter">
                                <i class="fab fa-twitter text-white text-sm"></i>
                            </a>
                        @endif
                        @if($settings['social_linkedin'])
                            <a href="{{ $settings['social_linkedin'] }}" target="_blank" rel="noopener noreferrer" 
                               class="w-11 h-11 bg-gradient-to-br from-blue-700 to-blue-800 hover:from-blue-600 hover:to-blue-700 rounded-xl flex items-center justify-center transition-all duration-300 transform hover:scale-110 hover:shadow-xl shadow-lg" 
                               aria-label="LinkedIn">
                                <i class="fab fa-linkedin-in text-white text-sm"></i>
                            </a>
                        @endif
                        @if($settings['social_instagram'])
                            <a href="{{ $settings['social_instagram'] }}" target="_blank" rel="noopener noreferrer" 
                               class="w-11 h-11 bg-gradient-to-br from-pink-600 via-purple-600 to-orange-500 hover:opacity-90 rounded-xl flex items-center justify-center transition-all duration-300 transform hover:scale-110 hover:shadow-xl shadow-lg" 
                               aria-label="Instagram">
                                <i class="fab fa-instagram text-white text-sm"></i>
                            </a>
                        @endif
                        @if($settings['social_youtube'])
                            <a href="{{ $settings['social_youtube'] }}" target="_blank" rel="noopener noreferrer" 
                               class="w-11 h-11 bg-gradient-to-br from-red-600 to-red-700 hover:from-red-500 hover:to-red-600 rounded-xl flex items-center justify-center transition-all duration-300 transform hover:scale-110 hover:shadow-xl shadow-lg" 
                               aria-label="YouTube">
                                <i class="fab fa-youtube text-white text-sm"></i>
                            </a>
                        @endif
                        @if($settings['social_whatsapp'])
                            <a href="{{ $settings['social_whatsapp'] }}" target="_blank" rel="noopener noreferrer" 
                               class="w-11 h-11 bg-gradient-to-br from-green-500 to-green-600 hover:from-green-400 hover:to-green-500 rounded-xl flex items-center justify-center transition-all duration-300 transform hover:scale-110 hover:shadow-xl shadow-lg" 
                               aria-label="WhatsApp">
                                <i class="fab fa-whatsapp text-white text-sm"></i>
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Column 2: Quick Links -->
                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-1 h-8 bg-gradient-to-b from-accent-400 to-accent-600 rounded-full"></div>
                        <h3 class="text-xl font-bold text-accent-400">Quick Links</h3>
                    </div>
                    <ul class="space-y-3">
                        @forelse($footerLinks->where('category', 'quick_links') as $link)
                            <li>
                                <a href="{{ $link->url }}" class="text-gray-300 hover:text-accent-400 transition-colors text-sm flex items-center gap-2 group">
                                    <i class="fas fa-chevron-right text-xs text-accent-500/50 group-hover:text-accent-400 group-hover:translate-x-1 transition-all"></i>
                                    <span>{{ $link->label }}</span>
                                </a>
                            </li>
                        @empty
                            <li>
                                <a href="{{ route('home') }}" class="text-gray-300 hover:text-accent-400 transition-colors text-sm flex items-center gap-2 group">
                                    <i class="fas fa-chevron-right text-xs text-accent-500/50 group-hover:text-accent-400 group-hover:translate-x-1 transition-all"></i>
                                    <span>Home</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('about') }}" class="text-gray-300 hover:text-accent-400 transition-colors text-sm flex items-center gap-2 group">
                                    <i class="fas fa-chevron-right text-xs text-accent-500/50 group-hover:text-accent-400 group-hover:translate-x-1 transition-all"></i>
                                    <span>About Us</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('programs.index') }}" class="text-gray-300 hover:text-accent-400 transition-colors text-sm flex items-center gap-2 group">
                                    <i class="fas fa-chevron-right text-xs text-accent-500/50 group-hover:text-accent-400 group-hover:translate-x-1 transition-all"></i>
                                    <span>Programs</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('contact') }}" class="text-gray-300 hover:text-accent-400 transition-colors text-sm flex items-center gap-2 group">
                                    <i class="fas fa-chevron-right text-xs text-accent-500/50 group-hover:text-accent-400 group-hover:translate-x-1 transition-all"></i>
                                    <span>Contact</span>
                                </a>
                            </li>
                        @endforelse
                    </ul>
                </div>

                <!-- Column 3: Programs -->
                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-1 h-8 bg-gradient-to-b from-accent-400 to-accent-600 rounded-full"></div>
                        <h3 class="text-xl font-bold text-accent-400">Programs</h3>
                    </div>
                    <ul class="space-y-3">
                        @forelse($programs as $program)
                            <li>
                                <a href="{{ route('programs.show', $program->slug) }}" class="text-gray-300 hover:text-accent-400 transition-colors text-sm flex items-center gap-2 group">
                                    <i class="fas fa-chevron-right text-xs text-accent-500/50 group-hover:text-accent-400 group-hover:translate-x-1 transition-all"></i>
                                    <span class="line-clamp-1">{{ $program->title }}</span>
                                </a>
                            </li>
                        @empty
                            <li class="text-gray-400 text-sm italic">No programs available</li>
                        @endforelse
                        @if($programs->count() > 0)
                            <li class="pt-3 mt-3 border-t border-white/10">
                                <a href="{{ route('programs.index') }}" class="text-accent-400 hover:text-accent-300 font-semibold text-sm flex items-center gap-2 group">
                                    <span>View All Programs</span>
                                    <i class="fas fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>

                <!-- Column 4: Contact Info -->
                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-1 h-8 bg-gradient-to-b from-accent-400 to-accent-600 rounded-full"></div>
                        <h3 class="text-xl font-bold text-accent-400">Contact Us</h3>
                    </div>
                    <ul class="space-y-4">
                        @if($settings['email'])
                            <li class="flex items-start gap-3 group">
                                <div class="w-10 h-10 bg-gradient-to-br from-accent-500/20 to-accent-600/20 rounded-xl flex items-center justify-center group-hover:from-accent-500/30 group-hover:to-accent-600/30 transition-all flex-shrink-0">
                                    <i class="fas fa-envelope text-accent-400 text-sm"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <a href="mailto:{{ $settings['email'] }}" class="text-gray-300 hover:text-accent-400 transition-colors text-sm block break-all">
                                        {{ $settings['email'] }}
                                    </a>
                                </div>
                            </li>
                        @endif
                        @if($settings['phone'])
                            <li class="flex items-start gap-3 group">
                                <div class="w-10 h-10 bg-gradient-to-br from-accent-500/20 to-accent-600/20 rounded-xl flex items-center justify-center group-hover:from-accent-500/30 group-hover:to-accent-600/30 transition-all flex-shrink-0">
                                    <i class="fas fa-phone text-accent-400 text-sm"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $settings['phone']) }}" class="text-gray-300 hover:text-accent-400 transition-colors text-sm block">
                                        {{ $settings['phone'] }}
                                    </a>
                                </div>
                            </li>
                        @endif
                        @if($settings['address'] || $settings['location'])
                            <li class="flex items-start gap-3 group">
                                <div class="w-10 h-10 bg-gradient-to-br from-accent-500/20 to-accent-600/20 rounded-xl flex items-center justify-center group-hover:from-accent-500/30 group-hover:to-accent-600/30 transition-all flex-shrink-0">
                                    <i class="fas fa-map-marker-alt text-accent-400 text-sm"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <span class="text-gray-300 text-sm block leading-relaxed">
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
                            <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 px-5 py-3 bg-gradient-to-r from-accent-500 to-accent-600 hover:from-accent-400 hover:to-accent-500 text-primary-900 font-bold rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl text-sm">
                                <i class="fas fa-paper-plane"></i>
                                <span>Get In Touch</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Copyright Section -->
    <div class="relative bg-primary-950 border-t-2 border-accent-500/30 overflow-hidden">
        <!-- Decorative Pattern -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0" style="background-image: radial-gradient(circle, white 1px, transparent 1px); background-size: 20px 20px;"></div>
        </div>
        
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6 relative z-10">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="flex flex-col md:flex-row items-center gap-2 md:gap-6 text-sm">
                    <p class="text-gray-400 text-center md:text-left">
                        &copy; {{ date('Y') }} <span class="text-accent-400 font-semibold">{{ $settings['site_name'] }}</span> - Destiny Life Coaching. All rights reserved.
                    </p>
                </div>
                <div class="flex flex-wrap items-center justify-center gap-4 md:gap-6">
                    @php
                        $privacyPage = \App\Models\LegalPage::getPrivacyPolicy();
                        $termsPage = \App\Models\LegalPage::getTermsOfService();
                    @endphp
                    @if($privacyPage)
                        <a href="{{ route('legal.show', $privacyPage->slug) }}" class="text-gray-400 hover:text-accent-400 transition-colors text-sm flex items-center gap-2 group">
                            <i class="fas fa-shield-alt text-xs"></i>
                            <span>Privacy Policy</span>
                        </a>
                    @endif
                    @if($termsPage)
                        <a href="{{ route('legal.show', $termsPage->slug) }}" class="text-gray-400 hover:text-accent-400 transition-colors text-sm flex items-center gap-2 group">
                            <i class="fas fa-file-contract text-xs"></i>
                            <span>Terms of Service</span>
                        </a>
                    @endif
                    @if(!$privacyPage && !$termsPage)
                        <a href="#" class="text-gray-400 hover:text-accent-400 transition-colors text-sm flex items-center gap-2">
                            <i class="fas fa-shield-alt text-xs"></i>
                            <span>Privacy Policy</span>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-accent-400 transition-colors text-sm flex items-center gap-2">
                            <i class="fas fa-file-contract text-xs"></i>
                            <span>Terms of Service</span>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</footer>
