@extends('admin.layouts.app')

@section('title', 'Testimonials')
@section('page-title', 'Manage Testimonials')

@section('content')
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="p-6 border-b border-gray-200 flex items-center justify-between bg-gradient-to-r from-primary-50 to-white">
            <div>
                <h3 class="text-xl font-bold text-gray-800">All Testimonials</h3>
                <p class="text-sm text-gray-600 mt-1">Manage client testimonials</p>
            </div>
            <div class="flex items-center gap-3">
                <form action="{{ route('admin.testimonials.sync-google-reviews') }}" method="POST" class="inline" onsubmit="return confirm('This will sync Google Reviews from your Google Business Profile. Continue?');">
                    @csrf
                    <button type="submit" class="btn bg-blue-600 hover:bg-blue-700 text-white shadow-md hover:shadow-lg">
                        <i class="fab fa-google mr-2"></i> Refresh Google Reviews
                    </button>
                </form>
                <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary shadow-md hover:shadow-lg">
                    <i class="fas fa-plus mr-2"></i> Add Testimonial
                </a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Photo</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Role/Company</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Content</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Order</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($testimonials as $testimonial)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($testimonial->photo)
                                    <img src="{{ $testimonial->is_from_google ? $testimonial->photo : asset('storage/' . $testimonial->photo) }}" alt="{{ $testimonial->name }}" class="w-12 h-12 rounded-full object-cover">
                                @else
                                    <div class="w-12 h-12 bg-primary-600 rounded-full flex items-center justify-center">
                                        <i class="fas fa-user text-white"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <span class="text-sm font-medium text-gray-900">{{ $testimonial->name }}</span>
                                    @if($testimonial->is_from_google)
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 bg-blue-100 text-blue-700 text-xs rounded-full font-semibold">
                                            <i class="fab fa-google text-xs"></i>
                                            Google
                                        </span>
                                    @endif
                                </div>
                                @if($testimonial->rating)
                                    <div class="flex items-center gap-1 mt-1">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $testimonial->rating ? 'text-yellow-400' : 'text-gray-300' }} text-xs"></i>
                                        @endfor
                                        <span class="text-xs text-gray-500 ml-1">({{ $testimonial->rating }}/5)</span>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                @if($testimonial->role)
                                    {{ $testimonial->role }}
                                    @if($testimonial->company)
                                        <br><span class="text-gray-400">{{ $testimonial->company }}</span>
                                    @endif
                                @else
                                    <span class="text-gray-400">—</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                <div class="max-w-xs truncate">{{ Str::limit(strip_tags($testimonial->content), 80) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex flex-col gap-1">
                                    @if($testimonial->is_active)
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                    @else
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">Inactive</span>
                                    @endif
                                    @if($testimonial->is_featured)
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Featured</span>
                                    @endif
                                    @if($testimonial->is_from_google)
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800 flex items-center gap-1">
                                            <i class="fab fa-google text-xs"></i>
                                            Google
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $testimonial->order }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="px-3 py-1.5 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-colors" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this testimonial?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1.5 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                No testimonials found. <a href="{{ route('admin.testimonials.create') }}" class="text-primary-600 hover:underline">Create one</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
