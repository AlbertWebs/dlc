@extends('admin.layouts.app')

@section('title', 'Edit Legal Page')
@section('page-title', 'Edit Legal Page')

@section('content')
    <div class="bg-white rounded-xl shadow-lg p-8">
        <form action="{{ route('admin.legal-pages.update', $legalPage) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Type *</label>
                <select id="type" name="type" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    <option value="">Select type</option>
                    <option value="privacy" {{ old('type', $legalPage->type) === 'privacy' ? 'selected' : '' }}>Privacy Policy</option>
                    <option value="terms" {{ old('type', $legalPage->type) === 'terms' ? 'selected' : '' }}>Terms of Service</option>
                </select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $legalPage->title) }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                </div>

                <div>
                    <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">Slug</label>
                    <input type="text" id="slug" name="slug" value="{{ old('slug', $legalPage->slug) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                           placeholder="Auto-generated from title">
                    <p class="mt-1 text-xs text-gray-500">Leave empty to auto-generate from title</p>
                </div>
            </div>

            <div>
                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Content *</label>
                <textarea id="content" name="content" class="tinymce" required>{{ old('content', $legalPage->content) }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-2">Meta Title</label>
                    <input type="text" id="meta_title" name="meta_title" value="{{ old('meta_title', $legalPage->meta_title) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                </div>

                <div>
                    <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-2">Meta Description</label>
                    <textarea id="meta_description" name="meta_description" rows="3"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">{{ old('meta_description', $legalPage->meta_description) }}</textarea>
                </div>
            </div>

            <div class="flex items-center">
                <input type="checkbox" id="is_published" name="is_published" value="1" {{ old('is_published', $legalPage->is_published) ? 'checked' : '' }}
                       class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                <label for="is_published" class="ml-2 text-sm text-gray-700">Publish immediately</label>
            </div>

            <div class="flex items-center gap-4 pt-6 border-t border-gray-200">
                <button type="submit" class="btn btn-primary shadow-md hover:shadow-lg">
                    <i class="fas fa-save mr-2"></i> Update Legal Page
                </button>
                <a href="{{ route('admin.legal-pages.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
<script>
    // Auto-generate slug from title
    document.getElementById('title')?.addEventListener('input', function() {
        const slugInput = document.getElementById('slug');
        if (slugInput && !slugInput.value) {
            slugInput.value = this.value.toLowerCase()
                .replace(/[^\w\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .trim();
        }
    });
</script>
@endpush
