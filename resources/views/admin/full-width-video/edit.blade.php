@extends('admin.layouts.app')

@section('title', 'Full Width Video')
@section('page-title', 'Full Width Video Hero')
@section('page-description', 'Manage the full width video hero section on the homepage')

@section('content')
    <div class="bg-white rounded-xl shadow-lg p-8">
        <form action="{{ route('admin.full-width-video.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Info Banner -->
            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-lg">
                <div class="flex items-start">
                    <i class="fas fa-info-circle text-blue-500 mt-1 mr-3"></i>
                    <div>
                        <p class="text-sm text-blue-700">
                            <strong>Full Width Video Hero:</strong> This section appears on the homepage when the hero type is set to "Full Width Video Hero" in Settings. 
                            The video will display as a full-width background with text overlay.
                        </p>
                    </div>
                </div>
            </div>

            <!-- PHP Upload Limits Info -->
            <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded-lg">
                <div class="flex items-start">
                    <i class="fas fa-exclamation-triangle text-yellow-500 mt-1 mr-3"></i>
                    <div>
                        <p class="text-sm text-yellow-700 mb-2">
                            <strong>PHP Upload Limits:</strong>
                        </p>
                        <ul class="text-xs text-yellow-700 space-y-1">
                            <li>• <strong>upload_max_filesize:</strong> {{ ini_get('upload_max_filesize') }}</li>
                            <li>• <strong>post_max_size:</strong> {{ ini_get('post_max_size') }}</li>
                            <li>• <strong>max_execution_time:</strong> {{ ini_get('max_execution_time') }} seconds</li>
                            <li>• <strong>max_input_time:</strong> {{ ini_get('max_input_time') }} seconds</li>
                        </ul>
                        <p class="text-xs text-yellow-600 mt-2">
                            If uploads fail, you may need to increase these values in your php.ini file.
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
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                            Main Heading (Title) *
                        </label>
                        <input type="text" id="title" name="title" 
                               value="{{ old('title', $heroBanner->title ?? 'Transform Your Life Through Professional Coaching') }}" 
                               required
                               placeholder="Transform Your Life Through Professional Coaching"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                        <p class="mt-1 text-xs text-gray-500">
                            The main heading displayed over the video. If it contains "Professional Coaching", it will be styled with accent color.
                        </p>
                    </div>

                    <div>
                        <label for="subtitle" class="block text-sm font-medium text-gray-700 mb-2">
                            Description (Subtitle)
                        </label>
                        <textarea id="subtitle" name="subtitle" rows="3" 
                                  placeholder="Unlock your potential with certified coaching programs designed to help you achieve your personal and professional goals."
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">{{ old('subtitle', $heroBanner->subtitle ?? 'Unlock your potential with certified coaching programs designed to help you achieve your personal and professional goals.') }}</textarea>
                        <p class="mt-1 text-xs text-gray-500">
                            The description text displayed below the main heading.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Video Section -->
            <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-video text-primary-600"></i>
                    Video
                </h3>

                @if(($heroBanner->video_file || $heroBanner->video_url) && $heroBanner->media_type === 'video')
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Current Video</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 bg-white">
                        <div class="aspect-video rounded-lg overflow-hidden">
                            @if($heroBanner->video_file)
                                <video src="{{ asset('storage/' . $heroBanner->video_file) }}" controls class="w-full h-full rounded-lg"></video>
                            @elseif($heroBanner->video_url)
                                @php
                                    $videoUrl = $heroBanner->video_url;
                                    $embedUrl = '';
                                    if (strpos($videoUrl, 'youtube.com/watch') !== false || strpos($videoUrl, 'youtu.be/') !== false) {
                                        preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&\n?#]+)/', $videoUrl, $matches);
                                        if (isset($matches[1])) {
                                            $embedUrl = 'https://www.youtube.com/embed/' . $matches[1];
                                        }
                                    } elseif (strpos($videoUrl, 'vimeo.com/') !== false) {
                                        preg_match('/vimeo\.com\/(\d+)/', $videoUrl, $matches);
                                        if (isset($matches[1])) {
                                            $embedUrl = 'https://player.vimeo.com/video/' . $matches[1];
                                        }
                                    }
                                @endphp
                                @if($embedUrl)
                                    <iframe src="{{ $embedUrl }}" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen class="w-full h-full rounded-lg"></iframe>
                                @else
                                    <video src="{{ $videoUrl }}" controls class="w-full h-full rounded-lg"></video>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
                @endif

                <div class="space-y-4">
                    <div>
                        <label for="video_file" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-upload mr-1"></i> Upload Video File (MP4)
                        </label>
                        <!-- Hidden input for MAX_FILE_SIZE (in bytes: 10MB = 10485760) -->
                        <input type="hidden" name="MAX_FILE_SIZE" value="10485760">
                        <input type="file" id="video_file" name="video_file" accept="video/mp4,video/webm,video/ogg"
                               onchange="document.getElementById('video_file_attempted').value = '1'; if(this.files[0]) { document.getElementById('video_file_size').value = this.files[0].size; }"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
                        <input type="hidden" name="video_file_attempted" id="video_file_attempted" value="0">
                        <input type="hidden" name="video_file_size" id="video_file_size" value="0">
                        @error('video_file')
                            <div class="mt-2 p-3 bg-red-50 border-l-4 border-red-500 rounded">
                                <p class="text-sm text-red-700 font-semibold">
                                    <i class="fas fa-exclamation-triangle mr-1"></i>
                                    {{ $message }}
                                </p>
                            </div>
                        @else
                            <p class="mt-1 text-xs text-gray-500">
                                Max file size: 10MB. Supported formats: MP4, WebM, OGG. Recommended for full-width video hero.
                            </p>
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

                    <div>
                        <label for="video_url" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-link mr-1"></i> Video URL
                        </label>
                        <input type="url" id="video_url" name="video_url" 
                               value="{{ old('video_url', $heroBanner->video_url) }}" 
                               placeholder="https://example.com/video.mp4 or https://www.youtube.com/watch?v=..."
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                        <p class="mt-1 text-xs text-gray-500">
                            Enter a direct video URL (MP4, WebM, OGG) or YouTube/Vimeo URL. Note: YouTube/Vimeo URLs may not work as background videos.
                        </p>
                    </div>

                    <!-- Video Preview -->
                    <div id="video-preview" class="hidden mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Preview</label>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 bg-white">
                            <div id="preview-video" class="aspect-video rounded-lg"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CTAs Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Primary CTA -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                    <h3 class="text-sm font-semibold text-gray-700 mb-4 flex items-center gap-2">
                        <i class="fas fa-mouse-pointer text-blue-600"></i>
                        Primary Button (CTA)
                    </h3>
                    <div class="space-y-4">
                        <div>
                            <label for="cta_text" class="block text-sm font-medium text-gray-700 mb-2">Button Text</label>
                            <input type="text" id="cta_text" name="cta_text" 
                                   value="{{ old('cta_text', $heroBanner->cta_text ?? 'Start Your Journey') }}"
                                   placeholder="Start Your Journey"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                        </div>

                        <div>
                            <label for="cta_link" class="block text-sm font-medium text-gray-700 mb-2">Button Link</label>
                            <input type="text" id="cta_link" name="cta_link" 
                                   value="{{ old('cta_link', $heroBanner->cta_link ?? route('contact')) }}"
                                   placeholder="{{ route('contact') }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                        </div>
                    </div>
                </div>

                <!-- Secondary CTA -->
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-6">
                    <h3 class="text-sm font-semibold text-gray-700 mb-4 flex items-center gap-2">
                        <i class="fas fa-hand-pointer text-gray-600"></i>
                        Secondary Button
                    </h3>
                    <div class="space-y-4">
                        <div>
                            <label for="secondary_cta_text" class="block text-sm font-medium text-gray-700 mb-2">Button Text</label>
                            <input type="text" id="secondary_cta_text" name="secondary_cta_text" 
                                   value="{{ old('secondary_cta_text', $heroBanner->secondary_cta_text ?? 'Learn More') }}"
                                   placeholder="Learn More"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                        </div>

                        <div>
                            <label for="secondary_cta_link" class="block text-sm font-medium text-gray-700 mb-2">Button Link</label>
                            <input type="text" id="secondary_cta_link" name="secondary_cta_link" 
                                   value="{{ old('secondary_cta_link', $heroBanner->secondary_cta_link ?? route('programs.index')) }}"
                                   placeholder="{{ route('programs.index') }}"
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Active Toggle -->
            <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-lg border border-gray-200">
                <input type="checkbox" id="is_active" name="is_active" value="1" 
                       {{ old('is_active', $heroBanner->is_active ?? true) ? 'checked' : '' }}
                       class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                <label for="is_active" class="text-sm font-medium text-gray-700">
                    Active (Show this section on the homepage)
                </label>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center gap-4 pt-6 border-t border-gray-200">
                <button type="submit" class="btn btn-primary shadow-md hover:shadow-lg">
                    <i class="fas fa-save mr-2"></i> Update Full Width Video
                </button>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Cancel</a>
                <a href="{{ route('home') }}" target="_blank" class="btn bg-gray-100 text-gray-700 hover:bg-gray-200">
                    <i class="fas fa-external-link-alt mr-2"></i> Preview on Site
                </a>
            </div>
        </form>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Video preview
            const videoFileInput = document.getElementById('video_file');
            const videoUrlInput = document.getElementById('video_url');
            const videoPreview = document.getElementById('video-preview');
            const previewVideo = document.getElementById('preview-video');

            // Handle video file upload preview
            videoFileInput.addEventListener('change', function(e) {
                if (e.target.files && e.target.files[0]) {
                    const file = e.target.files[0];
                    const url = URL.createObjectURL(file);
                    previewVideo.innerHTML = `<video src="${url}" controls class="w-full h-full rounded-lg"></video>`;
                    videoPreview.classList.remove('hidden');
                    // Clear video URL input
                    videoUrlInput.value = '';
                }
            });

            // Handle video URL preview
            videoUrlInput.addEventListener('input', function(e) {
                const url = e.target.value;
                if (url) {
                    let embedUrl = '';
                    if (url.includes('youtube.com/watch') || url.includes('youtu.be/')) {
                        const videoId = url.match(/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&\n?#]+)/);
                        if (videoId) {
                            embedUrl = `https://www.youtube.com/embed/${videoId[1]}`;
                        }
                    } else if (url.includes('vimeo.com/')) {
                        const videoId = url.match(/vimeo\.com\/(\d+)/);
                        if (videoId) {
                            embedUrl = `https://player.vimeo.com/video/${videoId[1]}`;
                        }
                    } else if (url.match(/\.(mp4|webm|ogg)$/i)) {
                        embedUrl = url;
                    }

                    if (embedUrl) {
                        if (embedUrl.includes('youtube.com/embed') || embedUrl.includes('vimeo.com/video')) {
                            previewVideo.innerHTML = `<iframe src="${embedUrl}" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen class="w-full h-full rounded-lg"></iframe>`;
                        } else {
                            previewVideo.innerHTML = `<video src="${embedUrl}" controls class="w-full h-full rounded-lg"></video>`;
                        }
                        videoPreview.classList.remove('hidden');
                    } else {
                        videoPreview.classList.add('hidden');
                    }
                    // Clear video file input
                    videoFileInput.value = '';
                } else {
                    videoPreview.classList.add('hidden');
                }
            });
        });
    </script>
    @endpush
@endsection
