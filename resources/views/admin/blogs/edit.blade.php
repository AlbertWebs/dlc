@extends('admin.layouts.app')

@section('title', 'Edit Blog Post')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Edit Blog Post</h1>
        <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Back to List
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.blogs.update', $blog) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="title" class="form-label">Title *</label>
                    <input type="text" 
                           class="form-control @error('title') is-invalid @enderror" 
                           id="title" 
                           name="title" 
                           value="{{ old('title', $blog->title) }}" 
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
                              rows="3">{{ old('excerpt', $blog->excerpt) }}</textarea>
                    @error('excerpt')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea class="form-control @error('content') is-invalid @enderror" 
                              id="content" 
                              name="content" 
                              rows="15">{{ old('content', $blog->content) }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="source_url" class="form-label">Source URL</label>
                        <input type="url" 
                               class="form-control @error('source_url') is-invalid @enderror" 
                               id="source_url" 
                               name="source_url" 
                               value="{{ old('source_url', $blog->source_url) }}">
                        @error('source_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="published_at" class="form-label">Published Date</label>
                        <input type="date" 
                               class="form-control @error('published_at') is-invalid @enderror" 
                               id="published_at" 
                               name="published_at" 
                               value="{{ old('published_at', $blog->published_at ? $blog->published_at->format('Y-m-d') : '') }}">
                        @error('published_at')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="featured_image" class="form-label">Featured Image</label>
                    @if($blog->featured_image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $blog->featured_image) }}" 
                                 alt="{{ $blog->title }}" 
                                 class="img-thumbnail" 
                                 style="max-width: 200px;">
                            <p class="text-muted small mt-1">Current image</p>
                        </div>
                    @endif
                    <input type="file" 
                           class="form-control @error('featured_image') is-invalid @enderror" 
                           id="featured_image" 
                           name="featured_image" 
                           accept="image/*">
                    @error('featured_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">Leave empty to keep current image</small>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" 
                           class="form-check-input" 
                           id="is_published" 
                           name="is_published" 
                           value="1"
                           {{ old('is_published', $blog->is_published) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_published">
                        Published
                    </label>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Blog Post
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
