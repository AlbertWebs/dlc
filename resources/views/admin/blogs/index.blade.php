@extends('admin.layouts.app')

@section('title', 'Blog Posts')
@section('page-title', 'Manage Blog Posts')
@section('page-description', 'Create, edit, and manage your blog content')

@section('content')
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Total Posts</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $posts->total() }}</p>
                </div>
                <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-newspaper text-blue-600 text-2xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Published</p>
                    <p class="text-3xl font-bold text-gray-900">{{ \App\Models\BlogPost::where('is_published', true)->count() }}</p>
                </div>
                <div class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-check-circle text-green-600 text-2xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-yellow-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Drafts</p>
                    <p class="text-3xl font-bold text-gray-900">{{ \App\Models\BlogPost::where('is_published', false)->count() }}</p>
                </div>
                <div class="w-14 h-14 bg-yellow-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-file-alt text-yellow-600 text-2xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-purple-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">This Month</p>
                    <p class="text-3xl font-bold text-gray-900">{{ \App\Models\BlogPost::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count() }}</p>
                </div>
                <div class="w-14 h-14 bg-purple-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-calendar-alt text-purple-600 text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Card -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <!-- Header with Search and Actions -->
        <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-primary-50 to-white">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h3 class="text-xl font-bold text-gray-800">All Blog Posts</h3>
                    <p class="text-sm text-gray-600 mt-1">Manage your blog content and articles</p>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.blogs.create') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-lg shadow-md hover:shadow-lg hover:from-primary-700 hover:to-primary-800 transition-all duration-200 font-medium">
                        <i class="fas fa-plus mr-2"></i> New Blog Post
                    </a>
                </div>
            </div>
        </div>

        <!-- Blog Posts Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Featured Image</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Published Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($posts as $post)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <!-- Featured Image -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($post->featured_image)
                                    @php
                                        $imageUrl = str_starts_with($post->featured_image, 'http') 
                                            ? $post->featured_image 
                                            : asset('storage/' . $post->featured_image);
                                    @endphp
                                    <img src="{{ $imageUrl }}" 
                                         alt="{{ $post->title }}" 
                                         class="w-20 h-20 object-cover rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-shadow cursor-pointer"
                                         onerror="this.onerror=null; this.src=''; this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                    <div class="w-20 h-20 bg-gradient-to-br from-primary-100 to-primary-200 rounded-lg border border-gray-200 flex items-center justify-center hidden">
                                        <i class="fas fa-image text-primary-400 text-xl"></i>
                                    </div>
                                @else
                                    <div class="w-20 h-20 bg-gradient-to-br from-gray-100 to-gray-200 rounded-lg border border-gray-200 flex items-center justify-center">
                                        <i class="fas fa-image text-gray-400 text-xl"></i>
                                    </div>
                                @endif
                            </td>

                            <!-- Title -->
                            <td class="px-6 py-4">
                                <div class="flex flex-col">
                                    <div class="text-sm font-semibold text-gray-900 mb-1">
                                        {{ Str::limit($post->title, 60) }}
                                    </div>
                                    @if($post->excerpt)
                                        <div class="text-xs text-gray-500 line-clamp-2">
                                            {{ Str::limit(strip_tags($post->excerpt), 80) }}
                                        </div>
                                    @endif
                                    @if($post->source_url)
                                        <a href="{{ $post->source_url }}" 
                                           target="_blank" 
                                           class="text-xs text-primary-600 hover:text-primary-800 hover:underline mt-1 inline-flex items-center gap-1">
                                            <i class="fas fa-external-link-alt text-xs"></i>
                                            View Source
                                        </a>
                                    @endif
                                </div>
                            </td>

                            <!-- Published Date -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($post->published_at)
                                    <div class="text-sm text-gray-900 font-medium">
                                        {{ $post->published_at->format('M d, Y') }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        {{ $post->published_at->format('g:i A') }}
                                    </div>
                                @else
                                    <span class="text-sm text-gray-400 italic">Not set</span>
                                @endif
                            </td>

                            <!-- Status -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($post->is_published)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-1.5"></i>
                                        Published
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-800">
                                        <i class="fas fa-file-alt mr-1.5"></i>
                                        Draft
                                    </span>
                                @endif
                            </td>

                            <!-- Created Date -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $post->created_at->format('M d, Y') }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    {{ $post->created_at->diffForHumans() }}
                                </div>
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('blog.show', $post->slug) }}" 
                                       target="_blank"
                                       class="px-3 py-1.5 bg-green-50 text-green-600 rounded-lg hover:bg-green-100 transition-colors" 
                                       title="View on Site">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.blogs.edit', $post) }}" 
                                       class="px-3 py-1.5 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-colors" 
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.blogs.destroy', $post) }}" 
                                          method="POST" 
                                          class="inline" 
                                          onsubmit="return confirm('Are you sure you want to delete this blog post? This action cannot be undone.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="px-3 py-1.5 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors" 
                                                title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                        <i class="fas fa-newspaper text-gray-400 text-3xl"></i>
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-2">No blog posts yet</h3>
                                    <p class="text-sm text-gray-500 mb-6 max-w-sm">
                                        Get started by creating your first blog post to share your insights and engage with your audience.
                                    </p>
                                    <a href="{{ route('admin.blogs.create') }}" 
                                       class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-primary-600 to-primary-700 text-white rounded-lg shadow-md hover:shadow-lg hover:from-primary-700 hover:to-primary-800 transition-all duration-200 font-medium">
                                        <i class="fas fa-plus mr-2"></i>
                                        Create Your First Blog Post
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($posts->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                <div class="flex items-center justify-between flex-wrap gap-4">
                    <div class="text-sm text-gray-700">
                        Showing 
                        <span class="font-medium">{{ $posts->firstItem() }}</span>
                        to 
                        <span class="font-medium">{{ $posts->lastItem() }}</span>
                        of 
                        <span class="font-medium">{{ $posts->total() }}</span>
                        results
                    </div>
                    <div class="flex items-center">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        @endif
    </div>

    @push('styles')
    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        /* Custom Pagination Styles */
        .pagination {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0;
            gap: 0.5rem;
        }
        
        .pagination li {
            display: inline-block;
        }
        
        .pagination a,
        .pagination span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 0.75rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.2s;
            text-decoration: none;
        }
        
        .pagination a {
            color: #4b5563;
            background-color: white;
            border: 1px solid #e5e7eb;
        }
        
        .pagination a:hover {
            background-color: #f3f4f6;
            border-color: #d1d5db;
            color: #111827;
        }
        
        .pagination .active span {
            background-color: #2563eb;
            color: white;
            border-color: #2563eb;
        }
        
        .pagination .disabled span {
            color: #9ca3af;
            background-color: #f9fafb;
            border-color: #e5e7eb;
            cursor: not-allowed;
        }
    </style>
    @endpush
@endsection
