@extends('admin.layouts.app')

@section('title', 'Who We Are')
@section('page-title', 'Who We Are Section')
@section('page-description', 'Manage the Who We Are section on the homepage')

@section('content')
    <div class="bg-white rounded-xl shadow-lg p-8">
        <form action="{{ route('admin.who-we-are.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Info Banner -->
            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-lg">
                <div class="flex items-start">
                    <i class="fas fa-info-circle text-blue-500 mt-1 mr-3"></i>
                    <div>
                        <p class="text-sm text-blue-700">
                            <strong>Who We Are Section:</strong> This section appears on the homepage and displays information about your organization. 
                            You can edit the title, description, image, stats card, and feature points.
                        </p>
                    </div>
                </div>
            </div>

          

            <!-- Text Content Section -->
            <div class="bg-gradient-to-r from-primary-50 to-accent-50 rounded-lg p-6 border border-primary-100">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-heading text-primary-600"></i>
                    Text Content
                </h3>
                
                <div class="space-y-4">
                    <div>
                        <label for="about_section_title" class="block text-sm font-medium text-gray-700 mb-2">
                            Main Heading (Title) *
                        </label>
                        <input type="text" id="about_section_title" name="about_section_title" 
                               value="{{ old('about_section_title', $settings['about_section_title'] ?? 'Empowering Lives Through Expert Coaching') }}" 
                               required
                               placeholder="Empowering Lives Through Expert Coaching"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                        <p class="mt-1 text-xs text-gray-500">
                            The main heading displayed in the section. If it contains "Expert Coaching", it will be styled with accent color.
                        </p>
                    </div>

                    <div>
                        <label for="about_section_subtitle" class="block text-sm font-medium text-gray-700 mb-2">
                            Subtitle / First Paragraph
                        </label>
                        <textarea id="about_section_subtitle" name="about_section_subtitle" rows="3" 
                                  placeholder="We are a leading coaching organization..."
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">{{ old('about_section_subtitle', $settings['about_section_subtitle'] ?? 'We are a leading coaching organization dedicated to helping individuals unlock their full potential through personalized guidance, proven methodologies, and comprehensive certification programs.') }}</textarea>
                        <p class="mt-1 text-xs text-gray-500">
                            The first paragraph displayed below the main heading.
                        </p>
                    </div>

                    <div>
                        <label for="about_section_description" class="block text-sm font-medium text-gray-700 mb-2">
                            Description / Second Paragraph
                        </label>
                        <textarea id="about_section_description" name="about_section_description" rows="3" 
                                  placeholder="Our mission is to transform lives..."
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">{{ old('about_section_description', $settings['about_section_description'] ?? 'Our mission is to transform lives by providing world-class coaching education and support. With years of experience and a commitment to excellence, we\'ve helped thousands of individuals achieve their personal and professional goals.') }}</textarea>
                        <p class="mt-1 text-xs text-gray-500">
                            The second paragraph displayed in the section.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Media Section -->
            <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-image text-primary-600"></i>
                    Section Media
                </h3>

                <div class="space-y-6">
                    <!-- Image Upload -->
                    <div>
                        <label for="about_image_file" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-upload mr-1"></i> Upload Image
                        </label>
                        <input type="file" id="about_image_file" name="about_image_file" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
                        <p class="mt-1 text-xs text-gray-500">
                            Upload an image for the "Who We Are" section. Max size: 5MB. Supported formats: JPEG, PNG, GIF, WebP. Recommended size: 800x600px or larger.
                        </p>
                        @if(isset($settings['about_section_image_file']) && $settings['about_section_image_file'])
                            <div class="mt-3 p-4 bg-blue-50 rounded-lg border border-blue-200">
                                <p class="text-sm font-medium text-gray-700 mb-2">Current Uploaded Image:</p>
                                <img src="{{ asset('storage/' . $settings['about_section_image_file']) }}" alt="Preview" class="w-48 h-36 object-cover rounded-lg border border-gray-200 mb-3">
                                <label class="flex items-center gap-2 text-sm text-gray-700">
                                    <input type="checkbox" name="delete_about_image" value="1" class="w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-500">
                                    <span>Delete current image</span>
                                </label>
                            </div>
                        @elseif(isset($settings['about_section_image']) && $settings['about_section_image'] && !str_starts_with($settings['about_section_image'], 'who-we-are/') && !isset($settings['about_section_video_file']))
                            <div class="mt-3">
                                <p class="text-sm text-gray-600 mb-2">Current Image (from URL):</p>
                                <img src="{{ $settings['about_section_image'] }}" alt="Preview" class="w-48 h-36 object-cover rounded-lg border border-gray-200">
                            </div>
                        @endif
                        @error('about_image_file')
                            <div class="mt-2 p-3 bg-red-50 border-l-4 border-red-500 rounded">
                                <p class="text-sm text-red-700 font-semibold">
                                    <i class="fas fa-exclamation-triangle mr-1"></i>
                                    {{ $message }}
                                </p>
                            </div>
                        @enderror
                    </div>

                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-gray-50 text-gray-500">OR</span>
                        </div>
                    </div>

                    <!-- Image URL -->
                    <div>
                        <label for="about_section_image" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-link mr-1"></i> Image URL
                        </label>
                        <input type="url" id="about_section_image" name="about_section_image" 
                               value="{{ old('about_section_image', (isset($settings['about_section_image']) && !str_starts_with($settings['about_section_image'] ?? '', 'who-we-are/')) ? $settings['about_section_image'] : '') }}" 
                               placeholder="https://example.com/image.jpg"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                        <p class="mt-1 text-xs text-gray-500">
                            Alternatively, provide a URL to an external image. This will replace any uploaded image.
                        </p>
                    </div>

                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-gray-50 text-gray-500">OR</span>
                        </div>
                    </div>

                    <!-- Video Upload -->
                    <div>
                        <label for="about_video_file" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-upload mr-1"></i> Upload Video File
                        </label>
                        <!-- Hidden input for MAX_FILE_SIZE (in bytes: 10MB = 10485760) -->
                        <input type="hidden" name="MAX_FILE_SIZE" value="10485760">
                        <input type="file" id="about_video_file" name="about_video_file" accept="video/mp4,video/webm,video/ogg"
                               onchange="if(this.files && this.files[0]) { document.getElementById('about_video_file_attempted').value = '1'; document.getElementById('about_video_file_size').value = this.files[0].size; } else { document.getElementById('about_video_file_attempted').value = '0'; document.getElementById('about_video_file_size').value = '0'; }"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
                        <input type="hidden" name="about_video_file_attempted" id="about_video_file_attempted" value="0">
                        <input type="hidden" name="about_video_file_size" id="about_video_file_size" value="0">
                        <p class="mt-1 text-xs text-gray-500">
                            Max file size: 10MB. Supported formats: MP4, WebM, OGG. Video will replace the image if uploaded.
                        </p>
                        @if(isset($settings['about_section_video_file']) && $settings['about_section_video_file'])
                            <div class="mt-3 p-4 bg-blue-50 rounded-lg border border-blue-200">
                                <p class="text-sm font-medium text-gray-700 mb-2">Current Video:</p>
                                <video src="{{ asset('storage/' . $settings['about_section_video_file']) }}" controls class="w-full max-w-md rounded-lg border border-gray-200 mb-3">
                                    Your browser does not support the video tag.
                                </video>
                                <label class="flex items-center gap-2 text-sm text-gray-700">
                                    <input type="checkbox" name="delete_about_video" value="1" class="w-4 h-4 text-red-600 border-gray-300 rounded focus:ring-red-500">
                                    <span>Delete current video</span>
                                </label>
                            </div>
                        @endif
                        @error('about_video_file')
                            <div class="mt-2 p-3 bg-red-50 border-l-4 border-red-500 rounded">
                                <p class="text-sm text-red-700 font-semibold">
                                    <i class="fas fa-exclamation-triangle mr-1"></i>
                                    {{ $message }}
                                </p>
                            </div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Stats Section -->
            <div class="bg-blue-50 rounded-lg p-6 border border-blue-200">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-chart-line text-blue-600"></i>
                    Statistics
                </h3>
                
                <p class="text-sm text-gray-600 mb-4">
                    Configure the statistics displayed on the homepage. The first stat appears in the floating card, and all four appear in the stats section.
                </p>

                <!-- Floating Stats Card (Single) -->
                <div class="bg-white rounded-lg p-4 border border-blue-200 mb-6">
                    <h4 class="text-sm font-semibold text-gray-700 mb-3">Floating Stats Card (Who We Are Section)</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="about_section_stats_number" class="block text-sm font-medium text-gray-700 mb-2">
                                Stats Number
                            </label>
                            <input type="text" id="about_section_stats_number" name="about_section_stats_number" 
                                   value="{{ old('about_section_stats_number', $settings['about_section_stats_number'] ?? '4,000+') }}" 
                                   placeholder="4,000+"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                        </div>

                        <div>
                            <label for="about_section_stats_label" class="block text-sm font-medium text-gray-700 mb-2">
                                Stats Label
                            </label>
                            <input type="text" id="about_section_stats_label" name="about_section_stats_label" 
                                   value="{{ old('about_section_stats_label', $settings['about_section_stats_label'] ?? 'CLIENTS') }}" 
                                   placeholder="CLIENTS"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                        </div>
                    </div>
                </div>

                <!-- Main Stats Grid (4 Stats) -->
                <div class="bg-white rounded-lg p-4 border border-blue-200">
                    <h4 class="text-sm font-semibold text-gray-700 mb-3">Main Stats Grid (4 Statistics)</h4>
                    <div class="space-y-4">
                        <!-- Stat 1 -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-3 bg-gray-50 rounded">
                            <div>
                                <label for="about_section_stat1_number" class="block text-sm font-medium text-gray-700 mb-2">
                                    Stat 1 Number
                                </label>
                                <input type="text" id="about_section_stat1_number" name="about_section_stat1_number" 
                                       value="{{ old('about_section_stat1_number', $settings['about_section_stat1_number'] ?? '500+') }}" 
                                       placeholder="500+"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                            </div>
                            <div>
                                <label for="about_section_stat1_label" class="block text-sm font-medium text-gray-700 mb-2">
                                    Stat 1 Label
                                </label>
                                <input type="text" id="about_section_stat1_label" name="about_section_stat1_label" 
                                       value="{{ old('about_section_stat1_label', $settings['about_section_stat1_label'] ?? 'COACHES TRAINED') }}" 
                                       placeholder="COACHES TRAINED"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                            </div>
                        </div>

                        <!-- Stat 2 -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-3 bg-gray-50 rounded">
                            <div>
                                <label for="about_section_stat2_number" class="block text-sm font-medium text-gray-700 mb-2">
                                    Stat 2 Number
                                </label>
                                <input type="text" id="about_section_stat2_number" name="about_section_stat2_number" 
                                       value="{{ old('about_section_stat2_number', $settings['about_section_stat2_number'] ?? '10+') }}" 
                                       placeholder="10+"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                            </div>
                            <div>
                                <label for="about_section_stat2_label" class="block text-sm font-medium text-gray-700 mb-2">
                                    Stat 2 Label
                                </label>
                                <input type="text" id="about_section_stat2_label" name="about_section_stat2_label" 
                                       value="{{ old('about_section_stat2_label', $settings['about_section_stat2_label'] ?? 'BOOKS WRITTEN') }}" 
                                       placeholder="BOOKS WRITTEN"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                            </div>
                        </div>

                        <!-- Stat 3 -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-3 bg-gray-50 rounded">
                            <div>
                                <label for="about_section_stat3_number" class="block text-sm font-medium text-gray-700 mb-2">
                                    Stat 3 Number
                                </label>
                                <input type="text" id="about_section_stat3_number" name="about_section_stat3_number" 
                                       value="{{ old('about_section_stat3_number', $settings['about_section_stat3_number'] ?? '18+') }}" 
                                       placeholder="18+"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                            </div>
                            <div>
                                <label for="about_section_stat3_label" class="block text-sm font-medium text-gray-700 mb-2">
                                    Stat 3 Label
                                </label>
                                <input type="text" id="about_section_stat3_label" name="about_section_stat3_label" 
                                       value="{{ old('about_section_stat3_label', $settings['about_section_stat3_label'] ?? 'YEARS Experience') }}" 
                                       placeholder="YEARS Experience"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                            </div>
                        </div>

                        <!-- Stat 4 -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-3 bg-gray-50 rounded">
                            <div>
                                <label for="about_section_stat4_number" class="block text-sm font-medium text-gray-700 mb-2">
                                    Stat 4 Number
                                </label>
                                <input type="text" id="about_section_stat4_number" name="about_section_stat4_number" 
                                       value="{{ old('about_section_stat4_number', $settings['about_section_stat4_number'] ?? '4,000+') }}" 
                                       placeholder="4,000+"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                            </div>
                            <div>
                                <label for="about_section_stat4_label" class="block text-sm font-medium text-gray-700 mb-2">
                                    Stat 4 Label
                                </label>
                                <input type="text" id="about_section_stat4_label" name="about_section_stat4_label" 
                                       value="{{ old('about_section_stat4_label', $settings['about_section_stat4_label'] ?? 'CLIENTS') }}" 
                                       placeholder="CLIENTS"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Feature Points Section -->
            <div class="bg-green-50 rounded-lg p-6 border border-green-200">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-check-circle text-green-600"></i>
                    Feature Points
                </h3>
                
                <div class="space-y-6">
                    <!-- Feature 1 -->
                    <div class="bg-white rounded-lg p-4 border border-green-200">
                        <h4 class="text-sm font-semibold text-gray-700 mb-3">Feature Point 1</h4>
                        <div class="space-y-3">
                            <div>
                                <label for="about_section_feature_1_title" class="block text-sm font-medium text-gray-700 mb-1">
                                    Title
                                </label>
                                <input type="text" id="about_section_feature_1_title" name="about_section_feature_1_title" 
                                       value="{{ old('about_section_feature_1_title', $settings['about_section_feature_1_title'] ?? 'Internationally Certified Programs') }}" 
                                       placeholder="Internationally Certified Programs"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                            </div>
                            <div>
                                <label for="about_section_feature_1_description" class="block text-sm font-medium text-gray-700 mb-1">
                                    Description
                                </label>
                                <textarea id="about_section_feature_1_description" name="about_section_feature_1_description" rows="2"
                                          placeholder="Globally recognized certifications..."
                                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">{{ old('about_section_feature_1_description', $settings['about_section_feature_1_description'] ?? 'Globally recognized certifications that open doors to new opportunities') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Feature 2 -->
                    <div class="bg-white rounded-lg p-4 border border-green-200">
                        <h4 class="text-sm font-semibold text-gray-700 mb-3">Feature Point 2</h4>
                        <div class="space-y-3">
                            <div>
                                <label for="about_section_feature_2_title" class="block text-sm font-medium text-gray-700 mb-1">
                                    Title
                                </label>
                                <input type="text" id="about_section_feature_2_title" name="about_section_feature_2_title" 
                                       value="{{ old('about_section_feature_2_title', $settings['about_section_feature_2_title'] ?? 'Expert Coaching Team') }}" 
                                       placeholder="Expert Coaching Team"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                            </div>
                            <div>
                                <label for="about_section_feature_2_description" class="block text-sm font-medium text-gray-700 mb-1">
                                    Description
                                </label>
                                <textarea id="about_section_feature_2_description" name="about_section_feature_2_description" rows="2"
                                          placeholder="Learn from experienced professionals..."
                                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">{{ old('about_section_feature_2_description', $settings['about_section_feature_2_description'] ?? 'Learn from experienced professionals with proven track records') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Feature 3 -->
                    <div class="bg-white rounded-lg p-4 border border-green-200">
                        <h4 class="text-sm font-semibold text-gray-700 mb-3">Feature Point 3</h4>
                        <div class="space-y-3">
                            <div>
                                <label for="about_section_feature_3_title" class="block text-sm font-medium text-gray-700 mb-1">
                                    Title
                                </label>
                                <input type="text" id="about_section_feature_3_title" name="about_section_feature_3_title" 
                                       value="{{ old('about_section_feature_3_title', $settings['about_section_feature_3_title'] ?? 'Proven Results & Success Stories') }}" 
                                       placeholder="Proven Results & Success Stories"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                            </div>
                            <div>
                                <label for="about_section_feature_3_description" class="block text-sm font-medium text-gray-700 mb-1">
                                    Description
                                </label>
                                <textarea id="about_section_feature_3_description" name="about_section_feature_3_description" rows="2"
                                          placeholder="Join thousands who have transformed..."
                                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">{{ old('about_section_feature_3_description', $settings['about_section_feature_3_description'] ?? 'Join thousands who have transformed their lives through our programs') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Button Section -->
            <div class="bg-purple-50 rounded-lg p-6 border border-purple-200">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-mouse-pointer text-purple-600"></i>
                    Call-to-Action Button
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="about_section_button_text" class="block text-sm font-medium text-gray-700 mb-2">
                            Button Text
                        </label>
                        <input type="text" id="about_section_button_text" name="about_section_button_text" 
                               value="{{ old('about_section_button_text', $settings['about_section_button_text'] ?? 'Learn More About Us') }}" 
                               placeholder="Learn More About Us"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                        <p class="mt-1 text-xs text-gray-500">
                            The text displayed on the button in the "Who We Are" section.
                        </p>
                    </div>

                    <div>
                        <label for="about_section_button_link" class="block text-sm font-medium text-gray-700 mb-2">
                            Button Link (URL)
                        </label>
                        <input type="text" id="about_section_button_link" name="about_section_button_link" 
                               value="{{ old('about_section_button_link', $settings['about_section_button_link'] ?? route('about')) }}" 
                               placeholder="{{ route('about') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                        <p class="mt-1 text-xs text-gray-500">
                            The URL the button links to. You can use routes like <code class="bg-purple-100 px-1 rounded">/about</code> or full URLs.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center gap-4 pt-6 border-t border-gray-200">
                <button type="submit" class="btn btn-primary shadow-md hover:shadow-lg">
                    <i class="fas fa-save mr-2"></i> Update Who We Are Section
                </button>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Cancel</a>
                <a href="{{ route('home') }}" target="_blank" class="btn bg-gray-100 text-gray-700 hover:bg-gray-200">
                    <i class="fas fa-external-link-alt mr-2"></i> Preview on Site
                </a>
            </div>
        </form>
    </div>
@endsection
