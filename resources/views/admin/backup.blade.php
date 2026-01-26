@extends('admin.layouts.app')

@section('title', 'Backup')
@section('page-title', 'Database Backup')
@section('page-description', 'Create a backup of your database')

@section('content')
    <div class="bg-white rounded-xl shadow-lg p-8">
        <div class="max-w-4xl">
            <div class="mb-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-database text-blue-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Database Backup</h3>
                        <p class="text-sm text-gray-600">Create a backup of your database to restore later if needed.</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6 rounded">
                <div class="flex items-start gap-3">
                    <i class="fas fa-info-circle text-blue-600 mt-0.5"></i>
                    <div>
                        <p class="text-sm text-blue-800 font-medium mb-1">Backup Information</p>
                        <p class="text-sm text-blue-700">This will create a complete backup of your database including all pages, programs, events, team members, and navigation items.</p>
                    </div>
                </div>
            </div>
            
            <form action="{{ route('admin.backup') }}" method="POST" class="space-y-6">
                @csrf
                
                <div>
                    <label for="backup_name" class="block text-sm font-medium text-gray-700 mb-2">Backup Name (Optional)</label>
                    <input type="text" id="backup_name" name="backup_name" 
                           placeholder="Auto-generated if left empty"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                </div>
                
                <div class="flex items-center gap-4 pt-6 border-t border-gray-200">
                    <button type="submit" class="btn btn-primary shadow-md hover:shadow-lg">
                        <i class="fas fa-download mr-2"></i> Create Backup
                    </button>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
            
            @if(session('backup_success'))
                <div class="mt-6 bg-green-50 border-l-4 border-green-500 p-4 rounded">
                    <p class="text-sm text-green-800">
                        <i class="fas fa-check-circle mr-2"></i>
                        {{ session('backup_success') }}
                    </p>
                </div>
            @endif
        </div>
    </div>
@endsection

