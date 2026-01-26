@extends('admin.layouts.app')

@section('title', 'Edit Hero Banner')
@section('page-title', 'Edit Hero Banner: ' . $heroBanner->title)

@section('content')
    <div class="bg-white rounded-xl shadow-lg p-8">
        <form action="{{ route('admin.hero-banners.update', $heroBanner) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Main Heading (Title) *</label>
                <input type="text" id="title" name="title" value="{{ old('title', $heroBanner->title ?? 'Transform Your Life Through Professional Coaching') }}" required
                       placeholder="Transform Your Life Through Professional Coaching"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                <p class="mt-1 text-xs text-gray-500">The main heading displayed in the hero section. If it contains "Professional Coaching", it will be styled with accent color.</p>
            </div>

            <div>
                <label for="subtitle" class="block text-sm font-medium text-gray-700 mb-2">Description (Subtitle)</label>
                <textarea id="subtitle" name="subtitle" rows="2" placeholder="Unlock your potential with certified coaching programs designed to help you achieve your personal and professional goals."
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">{{ old('subtitle', $heroBanner->subtitle ?? 'Unlock your potential with certified coaching programs designed to help you achieve your personal and professional goals.') }}</textarea>
                <p class="mt-1 text-xs text-gray-500">The description text displayed below the main heading.</p>
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea id="description" name="description" class="ckeditor">{{ old('description', $heroBanner->description) }}</textarea>
            </div>

            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <h3 class="text-sm font-semibold text-gray-700 mb-4">Primary Button (CTA)</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="cta_text" class="block text-sm font-medium text-gray-700 mb-2">Button Text</label>
                        <input type="text" id="cta_text" name="cta_text" value="{{ old('cta_text', $heroBanner->cta_text ?? 'Start Your Journey') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    </div>

                    <div>
                        <label for="cta_link" class="block text-sm font-medium text-gray-700 mb-2">Button Link</label>
                        <input type="text" id="cta_link" name="cta_link" value="{{ old('cta_link', $heroBanner->cta_link ?? route('contact')) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                <h3 class="text-sm font-semibold text-gray-700 mb-4">Secondary Button</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="secondary_cta_text" class="block text-sm font-medium text-gray-700 mb-2">Button Text</label>
                        <input type="text" id="secondary_cta_text" name="secondary_cta_text" value="{{ old('secondary_cta_text', $heroBanner->secondary_cta_text ?? 'Learn More') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    </div>

                    <div>
                        <label for="secondary_cta_link" class="block text-sm font-medium text-gray-700 mb-2">Button Link</label>
                        <input type="text" id="secondary_cta_link" name="secondary_cta_link" value="{{ old('secondary_cta_link', $heroBanner->secondary_cta_link ?? route('programs.index')) }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Location *</label>
                    <input type="text" id="location" name="location" value="{{ old('location', $heroBanner->location) }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                </div>

                <div>
                    <label for="order" class="block text-sm font-medium text-gray-700 mb-2">Order</label>
                    <input type="number" id="order" name="order" value="{{ old('order', $heroBanner->order) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                </div>
            </div>

            <!-- Media Type Toggle -->
            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                <label class="block text-sm font-medium text-gray-700 mb-3">Media Type *</label>
                <div class="flex gap-4">
                    <label class="flex items-center cursor-pointer">
                        <input type="radio" name="media_type" value="image" id="media_type_image" 
                               {{ old('media_type', $heroBanner->media_type ?? 'image') === 'image' ? 'checked' : '' }}
                               class="w-4 h-4 text-primary-600 border-gray-300 focus:ring-primary-500" 
                               onchange="toggleMediaType()">
                        <span class="ml-2 text-sm text-gray-700">
                            <i class="fas fa-image mr-1"></i> Image
                        </span>
                    </label>
                    <label class="flex items-center cursor-pointer">
                        <input type="radio" name="media_type" value="video" id="media_type_video"
                               {{ old('media_type', $heroBanner->media_type ?? 'image') === 'video' ? 'checked' : '' }}
                               class="w-4 h-4 text-primary-600 border-gray-300 focus:ring-primary-500"
                               onchange="toggleMediaType()">
                        <span class="ml-2 text-sm text-gray-700">
                            <i class="fas fa-video mr-1"></i> Video
                        </span>
                    </label>
                </div>
            </div>

            <!-- Image Section -->
            <div id="image-section" class="space-y-4">
                @if($heroBanner->image && $heroBanner->media_type !== 'video')
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Current Image</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 bg-gray-50">
                        @php
                            $currentImageUrl = $heroBanner->image;
                            if (strpos($currentImageUrl, 'http') !== 0 && strpos($currentImageUrl, '/') !== 0) {
                                $currentImageUrl = asset('storage/' . $currentImageUrl);
                            }
                        @endphp
                        <img src="{{ $currentImageUrl }}" 
                             alt="Current image" class="max-w-full h-auto max-h-64 mx-auto rounded-lg">
                    </div>
                </div>
                @endif

                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-upload mr-1"></i> Upload New Image
                    </label>
                    <input type="file" id="image" name="image" accept="image/*"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
                    <p class="mt-1 text-xs text-gray-500">Max file size: 5MB. Supported formats: JPEG, PNG, JPG, GIF, WebP</p>
                </div>

                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-gray-500">OR</span>
                    </div>
                </div>

                <div>
                    <label for="image_url" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-link mr-1"></i> Image URL
                    </label>
                    <input type="text" id="image_url" name="image_url" 
                           value="{{ old('image_url', $heroBanner->media_type === 'image' && !Storage::disk('public')->exists($heroBanner->image) ? $heroBanner->image : '') }}" 
                           placeholder="https://example.com/image.jpg"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    <p class="mt-1 text-xs text-gray-500">Enter a direct URL to an image</p>
                </div>

                <!-- Image Preview -->
                <div id="image-preview" class="hidden">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Preview</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 bg-gray-50">
                        <img id="preview-img" src="" alt="Preview" class="max-w-full h-auto max-h-64 mx-auto rounded-lg">
                    </div>
                </div>
            </div>

            <!-- Video Section -->
            <div id="video-section" class="hidden space-y-4">
                @if(($heroBanner->video_file || $heroBanner->video_url) && $heroBanner->media_type === 'video')
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Current Video</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 bg-gray-50">
                        <div class="aspect-video rounded-lg">
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

                <div>
                    <label for="video_file" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-upload mr-1"></i> Upload Video File (MP4)
                    </label>
                    <input type="file" id="video_file" name="video_file" accept="video/mp4,video/webm,video/ogg"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
                    <p class="mt-1 text-xs text-gray-500">Max file size: 10MB. Supported formats: MP4, WebM, OGG. Recommended for full-width video hero.</p>
                </div>

                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-gray-500">OR</span>
                    </div>
                </div>

                <div>
                    <label for="video_url" class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-link mr-1"></i> Video URL
                    </label>
                    <input type="url" id="video_url" name="video_url" 
                           value="{{ old('video_url', $heroBanner->video_url) }}" 
                           placeholder="https://www.youtube.com/watch?v=... or https://vimeo.com/..."
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    <p class="mt-1 text-xs text-gray-500">Enter YouTube, Vimeo, or direct video URL</p>
                </div>

                <!-- Video Preview -->
                <div id="video-preview" class="hidden mt-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Preview</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4 bg-gray-50">
                        <div id="preview-video" class="aspect-video rounded-lg"></div>
                    </div>
                </div>
            </div>

            <div class="flex items-center">
                <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $heroBanner->is_active) ? 'checked' : '' }}
                       class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                <label for="is_active" class="ml-2 text-sm text-gray-700">Active</label>
            </div>

            <div class="flex items-center gap-4 pt-6 border-t border-gray-200">
                <button type="submit" class="btn btn-primary shadow-md hover:shadow-lg">
                    <i class="fas fa-save mr-2"></i> Update Hero Banner
                </button>
                <a href="{{ route('admin.hero-banners.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>

    @push('scripts')
    <script>
        function toggleMediaType() {
            const mediaType = document.querySelector('input[name="media_type"]:checked').value;
            const imageSection = document.getElementById('image-section');
            const videoSection = document.getElementById('video-section');
            const imageInput = document.getElementById('image');
            const videoInput = document.getElementById('video_url');

            if (mediaType === 'image') {
                imageSection.classList.remove('hidden');
                videoSection.classList.add('hidden');
                videoInput.removeAttribute('required');
            } else {
                imageSection.classList.add('hidden');
                videoSection.classList.remove('hidden');
                imageInput.removeAttribute('required');
                videoInput.setAttribute('required', 'required');
            }
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            toggleMediaType();

            // Image preview
            const imageInput = document.getElementById('image');
            const imageUrlInput = document.getElementById('image_url');
            const imagePreview = document.getElementById('image-preview');
            const previewImg = document.getElementById('preview-img');

            imageInput.addEventListener('change', function(e) {
                if (e.target.files && e.target.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImg.src = e.target.result;
                        imagePreview.classList.remove('hidden');
                    };
                    reader.readAsDataURL(e.target.files[0]);
                }
            });

            imageUrlInput.addEventListener('input', function(e) {
                if (e.target.value) {
                    previewImg.src = e.target.value;
                    previewImg.onload = function() {
                        imagePreview.classList.remove('hidden');
                    };
                    previewImg.onerror = function() {
                        imagePreview.classList.add('hidden');
                    };
                } else {
                    imagePreview.classList.add('hidden');
                }
            });

            // Video preview
            const videoInput = document.getElementById('video_url');
            const videoPreview = document.getElementById('video-preview');
            const previewVideo = document.getElementById('preview-video');

            videoInput.addEventListener('input', function(e) {
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
                } else {
                    videoPreview.classList.add('hidden');
                }
            });
        });
    </script>
    @endpush
@endsection

