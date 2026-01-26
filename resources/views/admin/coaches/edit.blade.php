@extends('admin.layouts.app')

@section('title', 'Edit Coach')
@section('page-title', 'Edit Coach: ' . $coach->name)

@section('content')
    <div class="bg-white rounded-xl shadow-lg p-8">
        <form action="{{ route('admin.coaches.update', $coach) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name *</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $coach->name) }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                </div>

                <div>
                    <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">Slug</label>
                    <input type="text" id="slug" name="slug" value="{{ old('slug', $coach->slug) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    <p class="mt-1 text-xs text-gray-500">URL-friendly identifier</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $coach->title) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                </div>

                <div>
                    <label for="coaching_style" class="block text-sm font-medium text-gray-700 mb-2">Coaching Style</label>
                    <input type="text" id="coaching_style" name="coaching_style" value="{{ old('coaching_style', $coach->coaching_style) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                </div>
            </div>

            <div>
                <label for="bio" class="block text-sm font-medium text-gray-700 mb-2">Short Bio</label>
                <textarea id="bio" name="bio" rows="3"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">{{ old('bio', $coach->bio) }}</textarea>
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Full Description</label>
                <textarea id="description" name="description" class="ckeditor">{{ old('description', $coach->description) }}</textarea>
            </div>

            <div>
                <label for="photo" class="block text-sm font-medium text-gray-700 mb-2">Photo</label>
                @if($coach->photo)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $coach->photo) }}" alt="{{ $coach->name }}" class="w-24 h-24 rounded-lg object-cover">
                    </div>
                @endif
                <input type="file" id="photo" name="photo" accept="image/*"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100">
                <p class="mt-1 text-xs text-gray-500">Max file size: 5MB. Supported formats: JPEG, PNG, JPG, GIF, WebP</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $coach->email) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone', $coach->phone) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                </div>

                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                    <input type="text" id="location" name="location" value="{{ old('location', $coach->location) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                </div>
            </div>

            <div>
                <label for="credentials" class="block text-sm font-medium text-gray-700 mb-2">Credentials (one per line)</label>
                <textarea id="credentials" name="credentials" rows="3"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">{{ old('credentials') ? (is_array(old('credentials')) ? implode("\n", old('credentials')) : old('credentials')) : ($coach->credentials ? implode("\n", $coach->credentials) : '') }}</textarea>
            </div>

            <div>
                <label for="specializations" class="block text-sm font-medium text-gray-700 mb-2">Specializations (one per line)</label>
                <textarea id="specializations" name="specializations" rows="3"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">{{ old('specializations') ? (is_array(old('specializations')) ? implode("\n", old('specializations')) : old('specializations')) : ($coach->specializations ? implode("\n", $coach->specializations) : '') }}</textarea>
            </div>

            <div>
                <label for="social_links" class="block text-sm font-medium text-gray-700 mb-2">Social Links (format: platform:url, one per line)</label>
                <textarea id="social_links" name="social_links" rows="3"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">{{ old('social_links') ? (is_array(old('social_links')) ? implode("\n", array_map(function($k, $v) { return $k . ':' . $v; }, array_keys(old('social_links')), old('social_links'))) : old('social_links')) : ($coach->social_links ? implode("\n", array_map(function($k, $v) { return $k . ':' . $v; }, array_keys($coach->social_links), $coach->social_links)) : '') }}</textarea>
            </div>

            <div>
                <label for="experience" class="block text-sm font-medium text-gray-700 mb-2">Experience</label>
                <textarea id="experience" name="experience" rows="4"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">{{ old('experience', $coach->experience) }}</textarea>
            </div>

            <div>
                <label for="education" class="block text-sm font-medium text-gray-700 mb-2">Education</label>
                <textarea id="education" name="education" rows="3"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">{{ old('education', $coach->education) }}</textarea>
            </div>

            <div>
                <label for="certifications" class="block text-sm font-medium text-gray-700 mb-2">Certifications</label>
                <textarea id="certifications" name="certifications" rows="3"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">{{ old('certifications', $coach->certifications) }}</textarea>
            </div>

            <div>
                <label for="testimonials" class="block text-sm font-medium text-gray-700 mb-2">Testimonials</label>
                <textarea id="testimonials" name="testimonials" rows="4"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">{{ old('testimonials', $coach->testimonials) }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="order" class="block text-sm font-medium text-gray-700 mb-2">Order</label>
                    <input type="number" id="order" name="order" value="{{ old('order', $coach->order) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                </div>

                <div class="flex items-center pt-8">
                    <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $coach->is_active) ? 'checked' : '' }}
                           class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                    <label for="is_active" class="ml-2 text-sm text-gray-700">Active</label>
                </div>

                <div class="flex items-center pt-8">
                    <input type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured', $coach->is_featured) ? 'checked' : '' }}
                           class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                    <label for="is_featured" class="ml-2 text-sm text-gray-700">Featured</label>
                </div>
            </div>

            <div class="flex items-center gap-4 pt-6 border-t border-gray-200">
                <button type="submit" class="btn btn-primary shadow-md hover:shadow-lg">
                    <i class="fas fa-save mr-2"></i> Update Coach
                </button>
                <a href="{{ route('admin.coaches.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
