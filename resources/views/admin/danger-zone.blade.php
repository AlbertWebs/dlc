@extends('admin.layouts.app')

@section('title', 'Danger Zone')
@section('page-title', 'Danger Zone')
@section('page-description', 'Irreversible actions - proceed with caution')

@section('content')
    <div class="bg-white rounded-xl shadow-lg p-8">
        <div class="max-w-4xl">
            <div class="mb-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-red-800">Danger Zone</h3>
                        <p class="text-sm text-gray-600">These actions are irreversible. Please proceed with extreme caution.</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded">
                <div class="flex items-start gap-3">
                    <i class="fas fa-exclamation-circle text-red-600 mt-0.5"></i>
                    <div>
                        <p class="text-sm text-red-800 font-medium mb-1">Warning</p>
                        <p class="text-sm text-red-700">Purging data will permanently delete all content from your database. This action cannot be undone. Make sure you have a backup before proceeding.</p>
                    </div>
                </div>
            </div>
            
            <div class="space-y-6">
                <!-- Purge All Data -->
                <div class="border-2 border-red-200 rounded-lg p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h4 class="text-lg font-semibold text-red-800 mb-2">Purge All Data</h4>
                            <p class="text-sm text-gray-600">This will permanently delete all pages, programs, events, team members, navigation items, and hero banners.</p>
                        </div>
                    </div>
                    
                    <div class="bg-gray-50 p-4 rounded mb-4">
                        <p class="text-xs font-medium text-gray-700 mb-2">This will delete:</p>
                        <ul class="text-xs text-gray-600 space-y-1 list-disc list-inside">
                            <li>All Pages ({{ \App\Models\Page::count() }} items)</li>
                            <li>All Programs ({{ \App\Models\Program::count() }} items)</li>
                            <li>All Events ({{ \App\Models\Event::count() }} items)</li>
                            <li>All Team Members ({{ \App\Models\TeamMember::count() }} items)</li>
                            <li>All Navigation Items ({{ \App\Models\Navigation::count() }} items)</li>
                            <li>All Hero Banners ({{ \App\Models\HeroBanner::count() }} items)</li>
                        </ul>
                    </div>
                    
                    <form action="{{ route('admin.danger-zone.purge') }}" method="POST" 
                          onsubmit="return confirm('Are you absolutely sure? This will PERMANENTLY delete ALL data. Type DELETE to confirm.');">
                        @csrf
                        @method('DELETE')
                        
                        <div class="mb-4">
                            <label for="confirm_text" class="block text-sm font-medium text-gray-700 mb-2">
                                Type <strong class="text-red-600">DELETE</strong> to confirm:
                            </label>
                            <input type="text" id="confirm_text" name="confirm_text" required
                                   placeholder="Type DELETE"
                                   class="w-full px-4 py-2 border-2 border-red-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
                                   pattern="DELETE">
                        </div>
                        
                        <button type="submit" class="btn bg-red-600 text-white hover:bg-red-700 shadow-md hover:shadow-lg">
                            <i class="fas fa-trash mr-2"></i> Purge All Data
                        </button>
                    </form>
                </div>
                
                <!-- Reset Navigation -->
                <div class="border-2 border-orange-200 rounded-lg p-6">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h4 class="text-lg font-semibold text-orange-800 mb-2">Reset Navigation</h4>
                            <p class="text-sm text-gray-600">Reset navigation menu to default items.</p>
                        </div>
                    </div>
                    
                    <form action="{{ route('admin.danger-zone.reset-navigation') }}" method="POST"
                          onsubmit="return confirm('This will reset navigation to defaults. Continue?');">
                        @csrf
                        @method('POST')
                        <button type="submit" class="btn bg-orange-600 text-white hover:bg-orange-700 shadow-md hover:shadow-lg">
                            <i class="fas fa-undo mr-2"></i> Reset Navigation
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.getElementById('confirm_text')?.addEventListener('input', function() {
        const submitBtn = this.closest('form').querySelector('button[type="submit"]');
        if (this.value === 'DELETE') {
            submitBtn.disabled = false;
            submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
        } else {
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
        }
    });
</script>
@endpush

