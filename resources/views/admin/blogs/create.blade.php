@extends('admin.layouts.app')

@section('title', 'Create Blog Post')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Create Blog Post</h1>
        <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">Title *</label>
                    <input type="text" 
                           class="form-control @error('title') is-invalid @enderror" 
                           id="title" 
                           name="title" 
                           value="{{ old('title') }}" 
                           required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="excerpt" class="form-label">Excerpt</label>
                    <textarea class="form-control @error('excerpt') is-invalid @enderror" 
                              id="excerpt" 
                              name="excerpt" 
                              rows="3">{{ old('excerpt') }}</textarea>
                    @error('excerpt')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">A short summary of the blog post (optional)</small>
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea class="form-control @error('content') is-invalid @enderror" 
                              id="content" 
                              name="content" 
                              rows="15">{{ old('content') }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">Full blog post content (HTML allowed)</small>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="source_url" class="form-label">Source URL</label>
                        <input type="url" 
                               class="form-control @error('source_url') is-invalid @enderror" 
                               id="source_url" 
                               name="source_url" 
                               value="{{ old('source_url') }}" 
                               placeholder="https://dlc.co.ke/blog-2/...">
                        @error('source_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Original blog post URL (optional)</small>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="published_at" class="form-label">Published Date</label>
                        <input type="date" 
                               class="form-control @error('published_at') is-invalid @enderror" 
                               id="published_at" 
                               name="published_at" 
                               value="{{ old('published_at') }}">
                        @error('published_at')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="featured_image" class="form-label">Featured Image</label>
                    <input type="file" 
                           class="form-control @error('featured_image') is-invalid @enderror" 
                           id="featured_image" 
                           name="featured_image" 
                           accept="image/*">
                    @error('featured_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">Max size: 5MB. Recommended: 1200x630px</small>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" 
                           class="form-check-input" 
                           id="is_published" 
                           name="is_published" 
                           value="1"
                           {{ old('is_published', true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_published">
                        Publish immediately
                    </label>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Create Blog Post
                    </button>
                    <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
