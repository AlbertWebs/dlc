@extends('admin.layouts.app')

@section('title', 'Edit Coach')
@section('page-title', 'Edit Coach: ' . $coach->name)

@section('content')
    <div class="space-y-6">
        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
                <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
            </div>
        @endif

        <!-- Quick Actions -->
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-primary-600">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                <div>
                    <h3 class="text-lg font-bold text-primary-900 mb-1">Quick Actions</h3>
                    <p class="text-sm text-gray-600">View the coach profile or manage settings</p>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('coach.show', $coach->slug) }}" target="_blank" 
                       class="inline-flex items-center gap-2 px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors">
                        <i class="fas fa-external-link-alt"></i>
                        <span>View Profile</span>
                    </a>
                    <a href="{{ route('admin.coaches.index') }}" 
                       class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                        <i class="fas fa-arrow-left"></i>
                        <span>Back to List</span>
                    </a>
                </div>
            </div>
        </div>

        <form action="{{ route('admin.coaches.update', $coach) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Basic Information Section -->
            <div class="bg-white rounded-xl shadow-lg p-8 border border-gray-100">
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-200">
                    <div class="w-10 h-10 bg-gradient-to-br from-primary-600 to-primary-800 rounded-lg flex items-center justify-center">
                        <i class="fas fa-user text-white"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-primary-900">Basic Information</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            Full Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name', $coach->name) }}" required
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                               placeholder="e.g., Jeff Israel Nthiwa">
                    </div>

                    <div>
                        <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">
                            URL Slug
                            <button type="button" onclick="generateSlug()" class="ml-2 text-xs text-primary-600 hover:text-primary-700">
                                <i class="fas fa-magic"></i> Auto-generate
                            </button>
                        </label>
                        <input type="text" id="slug" name="slug" value="{{ old('slug', $coach->slug) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                               placeholder="jeff-israel-nthiwa">
                        <p class="mt-1 text-xs text-gray-500">URL: /coach/<span id="slug-preview">{{ $coach->slug }}</span></p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Professional Title</label>
                        <input type="text" id="title" name="title" value="{{ old('title', $coach->title) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                               placeholder="e.g., Founder & Master Certified Life Coach">
                    </div>

                    <div>
                        <label for="coaching_style" class="block text-sm font-medium text-gray-700 mb-2">Coaching Style</label>
                        <input type="text" id="coaching_style" name="coaching_style" value="{{ old('coaching_style', $coach->coaching_style) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                               placeholder="e.g., Results-based transformational approach">
                    </div>
                </div>

                <div class="mt-6">
                    <label for="bio" class="block text-sm font-medium text-gray-700 mb-2">Short Bio</label>
                    <textarea id="bio" name="bio" rows="3"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                              placeholder="A brief introduction that appears in the hero section...">{{ old('bio', $coach->bio) }}</textarea>
                    <p class="mt-1 text-xs text-gray-500">This appears in the hero section below the name</p>
                </div>
            </div>

            <!-- Photo Section -->
            <div class="bg-white rounded-xl shadow-lg p-8 border border-gray-100">
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-200">
                    <div class="w-10 h-10 bg-gradient-to-br from-accent-500 to-accent-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-image text-white"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-primary-900">Profile Photo</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @if($coach->photo)
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Current Photo</label>
                            <div class="relative inline-block">
                                <img src="{{ asset('storage/' . $coach->photo) }}" alt="{{ $coach->name }}" 
                                     class="w-48 h-48 rounded-xl object-cover border-4 border-gray-200 shadow-lg">
                            </div>
                        </div>
                    @endif

                    <div>
                        <label for="photo" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ $coach->photo ? 'Replace Photo' : 'Upload Photo' }}
                        </label>
                        <input type="file" id="photo" name="photo" accept="image/*"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
                        <p class="mt-2 text-xs text-gray-500">
                            <i class="fas fa-info-circle"></i> Max file size: 5MB. Formats: JPEG, PNG, JPG, GIF, WebP
                        </p>
                        @if($coach->photo)
                            <div class="mt-4">
                                <label class="flex items-center gap-2 text-sm text-gray-700">
                                    <input type="checkbox" name="delete_photo" value="1" class="w-4 h-4 text-primary-600 border-gray-300 rounded">
                                    <span>Delete current photo</span>
                                </label>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Contact Information Section -->
            <div class="bg-white rounded-xl shadow-lg p-8 border border-gray-100">
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-200">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-blue-800 rounded-lg flex items-center justify-center">
                        <i class="fas fa-address-card text-white"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-primary-900">Contact Information</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $coach->email) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                               placeholder="info@dlc.co.ke">
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone', $coach->phone) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                               placeholder="+254722992111">
                    </div>

                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                        <input type="text" id="location" name="location" value="{{ old('location', $coach->location) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                               placeholder="Nairobi, Kenya">
                    </div>
                </div>
            </div>

            <!-- Full Description Section -->
            <div class="bg-white rounded-xl shadow-lg p-8 border border-gray-100">
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-200">
                    <div class="w-10 h-10 bg-gradient-to-br from-purple-600 to-purple-800 rounded-lg flex items-center justify-center">
                        <i class="fas fa-file-alt text-white"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-primary-900">Full Description</h2>
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        Detailed Biography
                    </label>
                    <textarea id="description" name="description" class="ckeditor w-full">{{ old('description', $coach->description) }}</textarea>
                    <p class="mt-2 text-xs text-gray-500">
                        <i class="fas fa-info-circle"></i> Use the rich text editor to format your content. This appears in the "About" section.
                    </p>
                </div>
            </div>

            <!-- Credentials & Specializations Section -->
            <div class="bg-white rounded-xl shadow-lg p-8 border border-gray-100">
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-200">
                    <div class="w-10 h-10 bg-gradient-to-br from-green-600 to-green-800 rounded-lg flex items-center justify-center">
                        <i class="fas fa-certificate text-white"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-primary-900">Credentials & Specializations</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="credentials" class="block text-sm font-medium text-gray-700 mb-2">
                            Credentials <span class="text-xs text-gray-500">(one per line)</span>
                        </label>
                        <textarea id="credentials" name="credentials" rows="6"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent font-mono text-sm"
                                  placeholder="Master Certified Life Coach (ICR)&#10;Certified Breakthrough Intervention Coach&#10;Certified Life Coach Trainer">{{ old('credentials') ? (is_array(old('credentials')) ? implode("\n", old('credentials')) : old('credentials')) : ($coach->credentials ? implode("\n", $coach->credentials) : '') }}</textarea>
                        <p class="mt-1 text-xs text-gray-500">Enter each credential on a new line</p>
                    </div>

                    <div>
                        <label for="specializations" class="block text-sm font-medium text-gray-700 mb-2">
                            Specializations <span class="text-xs text-gray-500">(one per line)</span>
                        </label>
                        <textarea id="specializations" name="specializations" rows="6"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent font-mono text-sm"
                                  placeholder="Breakthrough Intervention Coaching&#10;Life Coaching Certification Training&#10;Personal Transformation&#10;Mindset Mastery">{{ old('specializations') ? (is_array(old('specializations')) ? implode("\n", old('specializations')) : old('specializations')) : ($coach->specializations ? implode("\n", $coach->specializations) : '') }}</textarea>
                        <p class="mt-1 text-xs text-gray-500">Enter each specialization on a new line</p>
                    </div>
                </div>
            </div>

            <!-- Social Media Links Section -->
            <div class="bg-white rounded-xl shadow-lg p-8 border border-gray-100">
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-200">
                    <div class="w-10 h-10 bg-gradient-to-br from-pink-600 to-pink-800 rounded-lg flex items-center justify-center">
                        <i class="fas fa-share-alt text-white"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-primary-900">Social Media Links</h2>
                </div>

                <div>
                    <label for="social_links" class="block text-sm font-medium text-gray-700 mb-2">
                        Social Links <span class="text-xs text-gray-500">(format: platform:url, one per line)</span>
                    </label>
                    <textarea id="social_links" name="social_links" rows="6"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent font-mono text-sm"
                              placeholder="facebook:https://www.facebook.com/breakthroughwithjeff/&#10;linkedin:https://www.linkedin.com/in/lifecoachkenya/&#10;instagram:https://www.instagram.com/thelifemasterybootcamp&#10;youtube:https://www.youtube.com/channel/UCcYXau-TIgy-1h9mK9m5V4A">{{ old('social_links') ? (is_array(old('social_links')) ? implode("\n", array_map(function($k, $v) { return $k . ':' . $v; }, array_keys(old('social_links')), old('social_links'))) : old('social_links')) : ($coach->social_links ? implode("\n", array_map(function($k, $v) { return $k . ':' . $v; }, array_keys($coach->social_links), $coach->social_links)) : '') }}</textarea>
                    <p class="mt-2 text-xs text-gray-500">
                        <i class="fas fa-info-circle"></i> Format: <code>platform:url</code> (e.g., facebook:https://facebook.com/username)
                    </p>
                    <div class="mt-3 p-3 bg-blue-50 rounded-lg border border-blue-200">
                        <p class="text-xs text-blue-800">
                            <strong>Supported platforms:</strong> facebook, linkedin, twitter, instagram, youtube, whatsapp
                        </p>
                    </div>
                </div>
            </div>

            <!-- Experience, Education & Certifications Section -->
            <div class="bg-white rounded-xl shadow-lg p-8 border border-gray-100">
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-200">
                    <div class="w-10 h-10 bg-gradient-to-br from-orange-600 to-orange-800 rounded-lg flex items-center justify-center">
                        <i class="fas fa-briefcase text-white"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-primary-900">Professional Background</h2>
                </div>

                <div class="space-y-6">
                    <div>
                        <label for="experience" class="block text-sm font-medium text-gray-700 mb-2">Experience</label>
                        <textarea id="experience" name="experience" rows="6"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                                  placeholder="Describe the coach's professional experience...">{{ old('experience', $coach->experience) }}</textarea>
                    </div>

                    <div>
                        <label for="education" class="block text-sm font-medium text-gray-700 mb-2">Education</label>
                        <textarea id="education" name="education" rows="4"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                                  placeholder="List educational background...">{{ old('education', $coach->education) }}</textarea>
                    </div>

                    <div>
                        <label for="certifications" class="block text-sm font-medium text-gray-700 mb-2">Certifications</label>
                        <textarea id="certifications" name="certifications" rows="4"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                                  placeholder="List certifications...">{{ old('certifications', $coach->certifications) }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Testimonials Section -->
            <div class="bg-white rounded-xl shadow-lg p-8 border border-gray-100">
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-200">
                    <div class="w-10 h-10 bg-gradient-to-br from-yellow-600 to-yellow-800 rounded-lg flex items-center justify-center">
                        <i class="fas fa-quote-left text-white"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-primary-900">Testimonials</h2>
                </div>

                <div>
                    <label for="testimonials" class="block text-sm font-medium text-gray-700 mb-2">Client Testimonials</label>
                    <textarea id="testimonials" name="testimonials" rows="6"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                              placeholder="Enter client testimonials, one per line or paragraph...">{{ old('testimonials', $coach->testimonials) }}</textarea>
                    <p class="mt-1 text-xs text-gray-500">You can enter multiple testimonials separated by paragraphs</p>
                </div>
            </div>

            <!-- Settings Section -->
            <div class="bg-white rounded-xl shadow-lg p-8 border border-gray-100">
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-200">
                    <div class="w-10 h-10 bg-gradient-to-br from-gray-600 to-gray-800 rounded-lg flex items-center justify-center">
                        <i class="fas fa-cog text-white"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-primary-900">Settings</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="order" class="block text-sm font-medium text-gray-700 mb-2">Display Order</label>
                        <input type="number" id="order" name="order" value="{{ old('order', $coach->order) }}" min="0"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                               placeholder="0">
                        <p class="mt-1 text-xs text-gray-500">Lower numbers appear first</p>
                    </div>

                    <div class="flex items-center pt-8">
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $coach->is_active) ? 'checked' : '' }}
                                   class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                            <div>
                                <span class="block text-sm font-medium text-gray-700">Active</span>
                                <span class="text-xs text-gray-500">Show on website</span>
                            </div>
                        </label>
                    </div>

                    <div class="flex items-center pt-8">
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured', $coach->is_featured) ? 'checked' : '' }}
                                   class="w-5 h-5 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                            <div>
                                <span class="block text-sm font-medium text-gray-700">Featured</span>
                                <span class="text-xs text-gray-500">Highlight on homepage</span>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Submit Buttons -->
            <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="text-sm text-gray-600">
                        <i class="fas fa-info-circle mr-2"></i>
                        All changes will be saved when you click "Update Coach"
                    </div>
                    <div class="flex gap-3">
                        <a href="{{ route('admin.coaches.index') }}" 
                           class="px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors font-medium">
                            <i class="fas fa-times mr-2"></i>Cancel
                        </a>
                        <button type="submit" class="px-6 py-3 bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-lg hover:from-primary-700 hover:to-primary-800 transition-all duration-300 shadow-lg hover:shadow-xl font-bold">
                            <i class="fas fa-save mr-2"></i>Update Coach
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
<script>
    // Auto-generate slug from name
    function generateSlug() {
        const name = document.getElementById('name').value;
        if (name) {
            const slug = name.toLowerCase()
                .trim()
                .replace(/[^\w\s-]/g, '')
                .replace(/[\s_-]+/g, '-')
                .replace(/^-+|-+$/g, '');
            document.getElementById('slug').value = slug;
            document.getElementById('slug-preview').textContent = slug;
        }
    }

    // Update slug preview on input
    document.getElementById('slug')?.addEventListener('input', function() {
        document.getElementById('slug-preview').textContent = this.value || '{{ $coach->slug }}';
    });

    // Update slug preview when name changes
    document.getElementById('name')?.addEventListener('input', function() {
        if (!document.getElementById('slug').value) {
            generateSlug();
        }
    });
</script>
@endpush
