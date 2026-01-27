@extends('admin.layouts.app')

@section('title', 'View Legal Page')
@section('page-title', 'View Legal Page')

@section('content')
    <div class="bg-white rounded-xl shadow-lg p-8">
        <div class="space-y-6">
            <div class="flex items-center justify-between pb-4 border-b border-gray-200">
                <div>
                    <span class="px-3 py-1 text-sm font-semibold rounded-full 
                        {{ $legalPage->type === 'privacy' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                        {{ ucfirst($legalPage->type) }}
                    </span>
                </div>
                <div class="flex items-center gap-3">
                    @if($legalPage->is_published)
                        <span class="px-3 py-1 text-sm font-semibold rounded-full bg-green-100 text-green-800">Published</span>
                    @else
                        <span class="px-3 py-1 text-sm font-semibold rounded-full bg-gray-100 text-gray-800">Draft</span>
                    @endif
                    <a href="{{ route('legal.show', $legalPage->slug) }}" target="_blank" class="btn btn-secondary">
                        <i class="fas fa-external-link-alt mr-2"></i> View Page
                    </a>
                    <a href="{{ route('admin.legal-pages.edit', $legalPage) }}" class="btn btn-primary">
                        <i class="fas fa-edit mr-2"></i> Edit
                    </a>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
                <p class="text-lg font-semibold text-gray-900">{{ $legalPage->title }}</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Slug</label>
                <p class="text-gray-600">{{ $legalPage->slug }}</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Content</label>
                <div class="prose max-w-none border border-gray-200 rounded-lg p-6 bg-gray-50">
                    {!! $legalPage->content !!}
                </div>
            </div>

            @if($legalPage->meta_title || $legalPage->meta_description)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-gray-200">
                    @if($legalPage->meta_title)
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Meta Title</label>
                            <p class="text-gray-600">{{ $legalPage->meta_title }}</p>
                        </div>
                    @endif
                    @if($legalPage->meta_description)
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Meta Description</label>
                            <p class="text-gray-600">{{ $legalPage->meta_description }}</p>
                        </div>
                    @endif
                </div>
            @endif

            <div class="pt-4 border-t border-gray-200">
                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.legal-pages.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left mr-2"></i> Back to List
                    </a>
                    <a href="{{ route('admin.legal-pages.edit', $legalPage) }}" class="btn btn-primary">
                        <i class="fas fa-edit mr-2"></i> Edit
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
