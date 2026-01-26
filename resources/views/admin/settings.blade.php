@extends('admin.layouts.app')

@section('title', 'Settings')
@section('page-title', 'Settings')
@section('page-description', 'Configure your site settings, contact information, and social media links')

@section('content')
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-6">
            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.settings.store') }}" method="POST" class="space-y-6">
        @csrf
        
        <!-- General Settings -->
        <div class="bg-white rounded-xl shadow-lg p-8">
            <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-200">
                <i class="fas fa-cog text-primary-600 text-xl"></i>
                <h3 class="text-xl font-semibold text-gray-800">General Settings</h3>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="site_name" class="block text-sm font-medium text-gray-700 mb-2">
                        Site Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="site_name" name="site_name" 
                           value="{{ old('site_name', $settings['site_name'] ?? config('app.name')) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                           required>
                    @error('site_name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="site_url" class="block text-sm font-medium text-gray-700 mb-2">
                        Site URL <span class="text-red-500">*</span>
                    </label>
                    <input type="url" id="site_url" name="site_url" 
                           value="{{ old('site_url', $settings['site_url'] ?? config('app.url')) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                           required>
                    @error('site_url')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="site_email" class="block text-sm font-medium text-gray-700 mb-2">
                        Site Email <span class="text-red-500">*</span>
                    </label>
                    <input type="email" id="site_email" name="site_email" 
                           value="{{ old('site_email', $settings['site_email'] ?? config('app.email', 'info@dlc.co.ke')) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                           required>
                    @error('site_email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="timezone" class="block text-sm font-medium text-gray-700 mb-2">
                        Timezone
                    </label>
                    <select id="timezone" name="timezone"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                        <option value="Africa/Nairobi" {{ ($settings['timezone'] ?? config('app.timezone')) === 'Africa/Nairobi' ? 'selected' : '' }}>Africa/Nairobi</option>
                        <option value="UTC" {{ ($settings['timezone'] ?? config('app.timezone')) === 'UTC' ? 'selected' : '' }}>UTC</option>
                        <option value="America/New_York" {{ ($settings['timezone'] ?? config('app.timezone')) === 'America/New_York' ? 'selected' : '' }}>America/New_York</option>
                        <option value="Europe/London" {{ ($settings['timezone'] ?? config('app.timezone')) === 'Europe/London' ? 'selected' : '' }}>Europe/London</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Contact Information -->
        <div class="bg-white rounded-xl shadow-lg p-8">
            <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-200">
                <i class="fas fa-address-book text-primary-600 text-xl"></i>
                <h3 class="text-xl font-semibold text-gray-800">Contact Information</h3>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                        Phone Number <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="phone" name="phone" 
                           value="{{ old('phone', $settings['phone'] ?? config('app.phone', '+254 722 992 111')) }}"
                           placeholder="+254 722 992 111"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                           required>
                    @error('phone')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        Email Address <span class="text-red-500">*</span>
                    </label>
                    <input type="email" id="email" name="email" 
                           value="{{ old('email', $settings['email'] ?? config('app.email', 'info@dlc.co.ke')) }}"
                           placeholder="info@dlc.co.ke"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                           required>
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700 mb-2">
                        Location <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="location" name="location" 
                           value="{{ old('location', $settings['location'] ?? config('app.location', 'Nairobi, Kenya')) }}"
                           placeholder="Nairobi, Kenya"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                           required>
                    @error('location')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="city" class="block text-sm font-medium text-gray-700 mb-2">
                        City
                    </label>
                    <input type="text" id="city" name="city" 
                           value="{{ old('city', $settings['city'] ?? config('app.city', 'Nairobi')) }}"
                           placeholder="Nairobi"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                </div>
                
                <div>
                    <label for="country" class="block text-sm font-medium text-gray-700 mb-2">
                        Country
                    </label>
                    <input type="text" id="country" name="country" 
                           value="{{ old('country', $settings['country'] ?? config('app.country', 'Kenya')) }}"
                           placeholder="Kenya"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                </div>
                
                <div>
                    <label for="postal_code" class="block text-sm font-medium text-gray-700 mb-2">
                        Postal Code
                    </label>
                    <input type="text" id="postal_code" name="postal_code" 
                           value="{{ old('postal_code', $settings['postal_code'] ?? config('app.postal_code', '')) }}"
                           placeholder="00100"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                </div>
                
                <div class="md:col-span-2">
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                        Full Address
                    </label>
                    <textarea id="address" name="address" rows="3"
                              placeholder="Enter full street address"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">{{ old('address', $settings['address'] ?? config('app.address', '')) }}</textarea>
                </div>
            </div>
        </div>

        <!-- Social Media Links -->
        <div class="bg-white rounded-xl shadow-lg p-8">
            <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-200">
                <i class="fas fa-share-alt text-primary-600 text-xl"></i>
                <h3 class="text-xl font-semibold text-gray-800">Social Media Links</h3>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="social_facebook" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fab fa-facebook-f text-blue-600 mr-2"></i> Facebook URL
                    </label>
                    <input type="url" id="social_facebook" name="social_facebook" 
                           value="{{ old('social_facebook', $settings['social_facebook'] ?? config('app.social.facebook', '')) }}"
                           placeholder="https://www.facebook.com/yourpage"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    @error('social_facebook')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="social_linkedin" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fab fa-linkedin-in text-blue-700 mr-2"></i> LinkedIn URL
                    </label>
                    <input type="url" id="social_linkedin" name="social_linkedin" 
                           value="{{ old('social_linkedin', $settings['social_linkedin'] ?? config('app.social.linkedin', '')) }}"
                           placeholder="https://www.linkedin.com/company/yourcompany"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    @error('social_linkedin')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="social_instagram" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fab fa-instagram text-pink-600 mr-2"></i> Instagram URL
                    </label>
                    <input type="url" id="social_instagram" name="social_instagram" 
                           value="{{ old('social_instagram', $settings['social_instagram'] ?? config('app.social.instagram', '')) }}"
                           placeholder="https://www.instagram.com/yourprofile"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    @error('social_instagram')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="social_twitter" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fab fa-twitter text-blue-400 mr-2"></i> Twitter/X URL
                    </label>
                    <input type="url" id="social_twitter" name="social_twitter" 
                           value="{{ old('social_twitter', $settings['social_twitter'] ?? config('app.social.twitter', '')) }}"
                           placeholder="https://www.twitter.com/yourhandle"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    @error('social_twitter')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="social_youtube" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fab fa-youtube text-red-600 mr-2"></i> YouTube URL
                    </label>
                    <input type="url" id="social_youtube" name="social_youtube" 
                           value="{{ old('social_youtube', $settings['social_youtube'] ?? config('app.social.youtube', '')) }}"
                           placeholder="https://www.youtube.com/channel/yourchannel"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    @error('social_youtube')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- SEO Settings -->
        <div class="bg-white rounded-xl shadow-lg p-8">
            <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-200">
                <i class="fas fa-search text-primary-600 text-xl"></i>
                <h3 class="text-xl font-semibold text-gray-800">SEO Settings</h3>
            </div>
            
            <div class="space-y-6">
                <div>
                    <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-2">
                        Meta Description
                    </label>
                    <textarea id="meta_description" name="meta_description" rows="3"
                              placeholder="Enter a brief description for search engines (150-160 characters recommended)"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">{{ old('meta_description', $settings['meta_description'] ?? config('app.meta.description', '')) }}</textarea>
                    <p class="text-xs text-gray-500 mt-1">Recommended: 150-160 characters</p>
                </div>
                
                <div>
                    <label for="meta_keywords" class="block text-sm font-medium text-gray-700 mb-2">
                        Meta Keywords
                    </label>
                    <input type="text" id="meta_keywords" name="meta_keywords" 
                           value="{{ old('meta_keywords', $settings['meta_keywords'] ?? config('app.meta.keywords', '')) }}"
                           placeholder="life coaching, certification, Kenya"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    <p class="text-xs text-gray-500 mt-1">Separate keywords with commas</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="google_analytics" class="block text-sm font-medium text-gray-700 mb-2">
                            Google Analytics ID
                        </label>
                        <input type="text" id="google_analytics" name="google_analytics" 
                               value="{{ old('google_analytics', $settings['google_analytics'] ?? config('app.google.analytics', '')) }}"
                               placeholder="G-XXXXXXXXXX"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    </div>
                    
                    <div>
                        <label for="google_tag_manager" class="block text-sm font-medium text-gray-700 mb-2">
                            Google Tag Manager ID
                        </label>
                        <input type="text" id="google_tag_manager" name="google_tag_manager" 
                               value="{{ old('google_tag_manager', $settings['google_tag_manager'] ?? config('app.google.tag_manager', '')) }}"
                               placeholder="GTM-XXXXXXX"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    </div>
                </div>
            </div>
        </div>

        <!-- Appearance Settings -->
        <div class="bg-white rounded-xl shadow-lg p-8">
            <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-200">
                <i class="fas fa-palette text-primary-600 text-xl"></i>
                <h3 class="text-xl font-semibold text-gray-800">Appearance Settings</h3>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="logo_url" class="block text-sm font-medium text-gray-700 mb-2">
                        Logo URL
                    </label>
                    <input type="url" id="logo_url" name="logo_url" 
                           value="{{ old('logo_url', $settings['logo_url'] ?? config('app.logo_url', '')) }}"
                           placeholder="https://example.com/logo.png"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    <p class="text-xs text-gray-500 mt-1">URL to your site logo image</p>
                </div>
                
                <div>
                    <label for="favicon_url" class="block text-sm font-medium text-gray-700 mb-2">
                        Favicon URL
                    </label>
                    <input type="url" id="favicon_url" name="favicon_url" 
                           value="{{ old('favicon_url', $settings['favicon_url'] ?? config('app.favicon_url', '')) }}"
                           placeholder="https://example.com/favicon.ico"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    <p class="text-xs text-gray-500 mt-1">URL to your favicon image</p>
                </div>
            </div>
        </div>

        <!-- Hero Section Settings -->
        <div class="bg-white rounded-xl shadow-lg p-8">
            <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-200">
                <i class="fas fa-video text-primary-600 text-xl"></i>
                <h3 class="text-xl font-semibold text-gray-800">Hero Section Settings</h3>
            </div>
            
            <div>
                <label for="hero_type" class="block text-sm font-medium text-gray-700 mb-2">
                    Hero Type
                </label>
                <select id="hero_type" name="hero_type"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    <option value="slider" {{ ($settings['hero_type'] ?? 'slider') === 'slider' ? 'selected' : '' }}>Normal Slider (Image/Video Side by Side)</option>
                    <option value="fullwidth-video" {{ ($settings['hero_type'] ?? 'slider') === 'fullwidth-video' ? 'selected' : '' }}>Full Width Video Hero</option>
                </select>
                <p class="text-xs text-gray-500 mt-1">Choose between normal slider layout or full-width video hero with text overlay</p>
            </div>
        </div>

        <!-- Who We Are Section Settings -->
        <div class="bg-white rounded-xl shadow-lg p-8">
            <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-200">
                <i class="fas fa-info-circle text-primary-600 text-xl"></i>
                <h3 class="text-xl font-semibold text-gray-800">Who We Are Section</h3>
            </div>
            
            <div class="space-y-6">
                <div>
                    <label for="about_section_title" class="block text-sm font-medium text-gray-700 mb-2">
                        Section Title
                    </label>
                    <input type="text" id="about_section_title" name="about_section_title" 
                           value="{{ old('about_section_title', $settings['about_section_title'] ?? 'Empowering Lives Through Expert Coaching') }}"
                           placeholder="Empowering Lives Through Expert Coaching"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    <p class="text-xs text-gray-500 mt-1">Main heading for the "Who We Are" section</p>
                </div>
                
                <div>
                    <label for="about_section_subtitle" class="block text-sm font-medium text-gray-700 mb-2">
                        Subtitle / First Paragraph
                    </label>
                    <textarea id="about_section_subtitle" name="about_section_subtitle" rows="3"
                              placeholder="We are a leading coaching organization..."
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">{{ old('about_section_subtitle', $settings['about_section_subtitle'] ?? 'We are a leading coaching organization dedicated to helping individuals unlock their full potential through personalized guidance, proven methodologies, and comprehensive certification programs.') }}</textarea>
                    <p class="text-xs text-gray-500 mt-1">First paragraph displayed in the section</p>
                </div>
                
                <div>
                    <label for="about_section_description" class="block text-sm font-medium text-gray-700 mb-2">
                        Description / Second Paragraph
                    </label>
                    <textarea id="about_section_description" name="about_section_description" rows="3"
                              placeholder="Our mission is to transform lives..."
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">{{ old('about_section_description', $settings['about_section_description'] ?? 'Our mission is to transform lives by providing world-class coaching education and support. With years of experience and a commitment to excellence, we\'ve helped thousands of individuals achieve their personal and professional goals.') }}</textarea>
                    <p class="text-xs text-gray-500 mt-1">Second paragraph displayed in the section</p>
                </div>
                
                <div>
                    <label for="about_section_image" class="block text-sm font-medium text-gray-700 mb-2">
                        Section Image URL
                    </label>
                    <input type="url" id="about_section_image" name="about_section_image" 
                           value="{{ old('about_section_image', $settings['about_section_image'] ?? '') }}"
                           placeholder="https://example.com/image.jpg"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    <p class="text-xs text-gray-500 mt-1">URL to the image displayed in the "Who We Are" section. Recommended size: 800x600px or larger.</p>
                    @if(isset($settings['about_section_image']) && $settings['about_section_image'])
                        <div class="mt-3">
                            <img src="{{ $settings['about_section_image'] }}" alt="Preview" class="w-48 h-36 object-cover rounded-lg border border-gray-200">
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Submit Buttons -->
        <div class="flex items-center justify-end gap-4 pt-6">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                <i class="fas fa-times mr-2"></i> Cancel
            </a>
            <button type="submit" class="btn btn-primary shadow-md hover:shadow-lg">
                <i class="fas fa-save mr-2"></i> Save All Settings
            </button>
        </div>
    </form>
@endsection
