@extends('layouts.app')

@section('title', 'Offline - DLC Kenya')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-primary-900 via-primary-800 to-primary-950 px-4">
    <div class="max-w-md w-full text-center">
        <!-- Icon -->
        <div class="mb-8">
            <div class="w-24 h-24 mx-auto bg-accent-500/20 rounded-full flex items-center justify-center border-4 border-accent-500/50">
                <i class="fas fa-wifi-slash text-accent-400 text-4xl"></i>
            </div>
        </div>
        
        <!-- Title -->
        <h1 class="text-4xl font-bold text-white mb-4">You're Offline</h1>
        <p class="text-gray-300 text-lg mb-8">
            It looks like you've lost your internet connection. Don't worry, you can still browse some content that was previously cached.
        </p>
        
        <!-- Actions -->
        <div class="space-y-4">
            <button onclick="window.location.reload()" 
                    class="w-full px-6 py-3 bg-gradient-to-r from-accent-500 to-accent-600 hover:from-accent-400 hover:to-accent-500 text-primary-900 font-bold rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                <i class="fas fa-sync-alt mr-2"></i>
                Try Again
            </button>
            <a href="{{ route('home') }}" 
               class="block w-full px-6 py-3 bg-white/10 hover:bg-white/20 text-white font-semibold rounded-xl transition-all duration-300 border-2 border-white/20">
                <i class="fas fa-home mr-2"></i>
                Go to Home
            </a>
        </div>
        
        <!-- Info -->
        <p class="mt-8 text-sm text-gray-400">
            <i class="fas fa-info-circle mr-2"></i>
            Some features may be limited while offline
        </p>
    </div>
</div>
@endsection
