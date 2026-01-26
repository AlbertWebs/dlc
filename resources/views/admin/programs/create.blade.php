@extends('admin.layouts.app')

@section('title', 'Create Program')
@section('page-title', 'Create New Program')

@section('content')
    <div class="bg-white rounded-xl shadow-lg p-8">
        <!-- Display All Errors -->
        @if($errors->any())
            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-lg">
                <div class="flex items-start">
                    <i class="fas fa-exclamation-circle text-red-500 mt-1 mr-3"></i>
                    <div class="flex-1">
                        <h3 class="text-sm font-semibold text-red-800 mb-2">Please fix the following errors:</h3>
                        <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <!-- Debug Info -->
        <div class="mb-6 p-4 bg-blue-50 border-l-4 border-blue-500 rounded-lg">
            <p class="text-sm text-blue-700">
                <strong>Debug:</strong> This is a simplified form to test submission. Check browser console (F12) for any errors.
            </p>
        </div>

        <form action="{{ route('admin.programs.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6" id="program-form">
            @csrf

            <!-- Only Essential Fields -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                @error('title')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description *</label>
                <textarea id="description" name="description" rows="5" required
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                          placeholder="Enter program description...">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-xs text-gray-500">Using simple textarea for testing. CKEditor removed temporarily.</p>
            </div>

            <div>
                <label for="currency" class="block text-sm font-medium text-gray-700 mb-2">Currency</label>
                <select id="currency" name="currency" 
                       class="w-full md:w-32 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                    <option value="KES" selected>KES</option>
                    <option value="USD">USD</option>
                    <option value="EUR">EUR</option>
                    <option value="GBP">GBP</option>
                </select>
            </div>

            <div class="flex items-center gap-4 pt-6 border-t border-gray-200">
                <button type="submit" id="submit-btn" class="btn btn-primary shadow-md hover:shadow-lg cursor-pointer">
                    <i class="fas fa-save mr-2"></i> Create Program
                </button>
                <a href="{{ route('admin.programs.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
<script>
    console.log('=== PROGRAM FORM DEBUG ===');
    console.log('Form element:', document.getElementById('program-form'));
    console.log('Submit button:', document.getElementById('submit-btn'));
    console.log('Form action:', document.getElementById('program-form')?.action);
    
    // Test button click
    document.getElementById('submit-btn')?.addEventListener('click', function(e) {
        console.log('Submit button clicked!');
        console.log('Event:', e);
        console.log('Button type:', this.type);
        console.log('Form valid:', document.getElementById('program-form')?.checkValidity());
    });
    
    // Test form submit
    document.getElementById('program-form')?.addEventListener('submit', function(e) {
        console.log('Form submit event triggered!');
        console.log('Form data:', new FormData(this));
        
        // Don't prevent default - let it submit
        const title = document.getElementById('title').value;
        const description = document.getElementById('description').value;
        
        if (!title || !title.trim()) {
            e.preventDefault();
            alert('Title is required!');
            return false;
        }
        
        if (!description || !description.trim()) {
            e.preventDefault();
            alert('Description is required!');
            return false;
        }
        
        console.log('Form validation passed, allowing submission...');
        return true;
    });
    
    // Check if button is disabled
    const submitBtn = document.getElementById('submit-btn');
    if (submitBtn) {
        console.log('Button disabled?', submitBtn.disabled);
        console.log('Button style:', window.getComputedStyle(submitBtn));
        console.log('Button pointer-events:', window.getComputedStyle(submitBtn).pointerEvents);
        console.log('Button opacity:', window.getComputedStyle(submitBtn).opacity);
    }
</script>
@endpush
