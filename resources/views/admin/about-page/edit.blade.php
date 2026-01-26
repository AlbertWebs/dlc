@extends('admin.layouts.app')

@section('title', 'About Page')
@section('page-title', 'About Page Content')
@section('page-description', 'Manage the About Us page content')

@section('content')
    <div class="bg-white rounded-xl shadow-lg p-8">
        <form action="{{ route('admin.about-page.update') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Info Banner -->
            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-lg">
                <div class="flex items-start">
                    <i class="fas fa-info-circle text-blue-500 mt-1 mr-3"></i>
                    <div>
                        <p class="text-sm text-blue-700">
                            <strong>About Page:</strong> This page displays information about DLC's mission, vision, and leadership academy. 
                            All content is editable from this panel.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Hero Section -->
            <div class="bg-gradient-to-r from-primary-50 to-accent-50 rounded-lg p-6 border border-primary-100">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-heading text-primary-600"></i>
                    Hero Section
                </h3>
                
                <div class="space-y-4">
                    <div>
                        <label for="about_page_hero_title" class="block text-sm font-medium text-gray-700 mb-2">
                            Hero Title
                        </label>
                        <input type="text" id="about_page_hero_title" name="about_page_hero_title" 
                               value="{{ old('about_page_hero_title', $settings['about_page_hero_title'] ?? 'ABOUT US') }}" 
                               placeholder="ABOUT US"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    </div>

                    <div>
                        <label for="about_page_hero_subtitle" class="block text-sm font-medium text-gray-700 mb-2">
                            Hero Subtitle
                        </label>
                        <textarea id="about_page_hero_subtitle" name="about_page_hero_subtitle" rows="2" 
                                  placeholder="Empowering lives through expert coaching..."
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">{{ old('about_page_hero_subtitle', $settings['about_page_hero_subtitle'] ?? 'Empowering lives through expert coaching and professional development') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Introduction Section -->
            <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-info-circle text-primary-600"></i>
                    Introduction
                </h3>
                
                <div class="space-y-4">
                    <div>
                        <label for="about_page_introduction_title" class="block text-sm font-medium text-gray-700 mb-2">
                            Title
                        </label>
                        <input type="text" id="about_page_introduction_title" name="about_page_introduction_title" 
                               value="{{ old('about_page_introduction_title', $settings['about_page_introduction_title'] ?? 'Introduction') }}" 
                               placeholder="Introduction"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    </div>

                    <div>
                        <label for="about_page_introduction_content" class="block text-sm font-medium text-gray-700 mb-2">
                            Content
                        </label>
                        <textarea id="about_page_introduction_content" name="about_page_introduction_content" rows="4" 
                                  placeholder="Destiny Life Coaching is here to enable agents of change..."
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">{{ old('about_page_introduction_content', $settings['about_page_introduction_content'] ?? 'Destiny Life Coaching is here to enable agents of change to become world-class practitioners of transformative coaching excellence who will positively influence Africa and the world using the results-based transformational approach to life coaching.') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Mission & Vision Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Mission -->
                <div class="bg-green-50 rounded-lg p-6 border border-green-200">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="fas fa-bullseye text-green-600"></i>
                        Mission
                    </h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="about_page_mission_title" class="block text-sm font-medium text-gray-700 mb-2">
                                Title
                            </label>
                            <input type="text" id="about_page_mission_title" name="about_page_mission_title" 
                                   value="{{ old('about_page_mission_title', $settings['about_page_mission_title'] ?? 'Mission') }}" 
                                   placeholder="Mission"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                        </div>

                        <div>
                            <label for="about_page_mission_content" class="block text-sm font-medium text-gray-700 mb-2">
                                Content
                            </label>
                            <textarea id="about_page_mission_content" name="about_page_mission_content" rows="5" 
                                      placeholder="Develop transformative soul-based practitioners..."
                                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">{{ old('about_page_mission_content', $settings['about_page_mission_content'] ?? 'Develop transformative soul-based practitioners of coaching and speaking excellence through soul-based immersion coaching experience, exposure to cutting-edge transformational tools, collaborative practice, research, and innovative contribution to humanity.') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Vision -->
                <div class="bg-purple-50 rounded-lg p-6 border border-purple-200">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="fas fa-eye text-purple-600"></i>
                        Vision
                    </h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label for="about_page_vision_title" class="block text-sm font-medium text-gray-700 mb-2">
                                Title
                            </label>
                            <input type="text" id="about_page_vision_title" name="about_page_vision_title" 
                                   value="{{ old('about_page_vision_title', $settings['about_page_vision_title'] ?? 'Vision') }}" 
                                   placeholder="Vision"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                        </div>

                        <div>
                            <label for="about_page_vision_content" class="block text-sm font-medium text-gray-700 mb-2">
                                Content
                            </label>
                            <textarea id="about_page_vision_content" name="about_page_vision_content" rows="5" 
                                      placeholder="DLC is a world class center..."
                                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">{{ old('about_page_vision_content', $settings['about_page_vision_content'] ?? 'DLC is a world class center for transformational life success. This is dedicated to excellence in life coaching, transformational Leadership Academy, and transformative speaker training which is distinguished by high-quality, value-based training that is also transformative.') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Leadership Academy Section -->
            <div class="bg-blue-50 rounded-lg p-6 border border-blue-200">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-users-cog text-blue-600"></i>
                    Leadership Academy
                </h3>
                
                <div class="space-y-4">
                    <div>
                        <label for="about_page_leadership_title" class="block text-sm font-medium text-gray-700 mb-2">
                            Title
                        </label>
                        <input type="text" id="about_page_leadership_title" name="about_page_leadership_title" 
                               value="{{ old('about_page_leadership_title', $settings['about_page_leadership_title'] ?? 'LEADERSHIP ACADEMY') }}" 
                               placeholder="LEADERSHIP ACADEMY"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    </div>

                    <div>
                        <label for="about_page_leadership_subtitle" class="block text-sm font-medium text-gray-700 mb-2">
                            Subtitle
                        </label>
                        <textarea id="about_page_leadership_subtitle" name="about_page_leadership_subtitle" rows="2" 
                                  placeholder="Destiny Life Coaching, Nairobi Leadership Academy..."
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">{{ old('about_page_leadership_subtitle', $settings['about_page_leadership_subtitle'] ?? 'Destiny Life Coaching, Nairobi Leadership Academy offers training that helps develop leaders from within your organization and facilitates a leadership pipeline that brings about peak performance for teams.') }}</textarea>
                    </div>

                    <div>
                        <label for="about_page_leadership_content" class="block text-sm font-medium text-gray-700 mb-2">
                            Content
                        </label>
                        <textarea id="about_page_leadership_content" name="about_page_leadership_content" rows="10" 
                                  placeholder="Learn how to make collaboration..."
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">{{ old('about_page_leadership_content', $settings['about_page_leadership_content'] ?? '') }}</textarea>
                        <p class="mt-1 text-xs text-gray-500">Full content for the Leadership Academy section. Use line breaks to separate paragraphs.</p>
                    </div>

                    <div>
                        <label for="about_page_leadership_image" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-link mr-1"></i> Image URL
                        </label>
                        <input type="url" id="about_page_leadership_image" name="about_page_leadership_image" 
                               value="{{ old('about_page_leadership_image', $settings['about_page_leadership_image'] ?? '') }}" 
                               placeholder="https://example.com/image.jpg"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                        <p class="mt-1 text-xs text-gray-500">URL to an image for the Leadership Academy section.</p>
                    </div>
                </div>
            </div>

            <!-- Accreditation Section -->
            <div class="bg-yellow-50 rounded-lg p-6 border border-yellow-200">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-certificate text-yellow-600"></i>
                    Accreditation
                </h3>
                
                <div class="space-y-4">
                    <div>
                        <label for="about_page_accreditation_title" class="block text-sm font-medium text-gray-700 mb-2">
                            Title
                        </label>
                        <input type="text" id="about_page_accreditation_title" name="about_page_accreditation_title" 
                               value="{{ old('about_page_accreditation_title', $settings['about_page_accreditation_title'] ?? 'Accreditation') }}" 
                               placeholder="Accreditation"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    </div>

                    <div>
                        <label for="about_page_accreditation_content" class="block text-sm font-medium text-gray-700 mb-2">
                            Content
                        </label>
                        <textarea id="about_page_accreditation_content" name="about_page_accreditation_content" rows="4" 
                                  placeholder="We are accredited by the International Coaches Register..."
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">{{ old('about_page_accreditation_content', $settings['about_page_accreditation_content'] ?? 'We are accredited by the International Coaches Register and we are in good standing with ICR. We are committed to providing professional and ethical services to our clients. We are dedicated to providing quality life coaching services.') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center gap-4 pt-6 border-t border-gray-200">
                <button type="submit" class="btn btn-primary shadow-md hover:shadow-lg cursor-pointer">
                    <i class="fas fa-save mr-2"></i> Update About Page
                </button>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Cancel</a>
                <a href="{{ route('about') }}" target="_blank" class="btn bg-gray-100 text-gray-700 hover:bg-gray-200">
                    <i class="fas fa-external-link-alt mr-2"></i> Preview on Site
                </a>
            </div>
        </form>
    </div>
@endsection
