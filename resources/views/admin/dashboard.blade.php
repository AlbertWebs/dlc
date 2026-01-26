@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-description', 'Overview of your content and quick actions')

@section('content')
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="stat-card bg-white rounded-xl shadow-lg p-6 text-white admin-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm opacity-90 mb-1">Total Pages</p>
                    <p class="text-3xl font-bold">{{ \App\Models\Page::count() }}</p>
                </div>
                <div class="w-14 h-14 bg-white bg-opacity-20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                    <i class="fas fa-file-alt text-2xl"></i>
                </div>
            </div>
            <a href="{{ route('admin.pages.index') }}" class="text-sm opacity-90 mt-4 inline-block hover:underline">
                View all <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>

        <div class="stat-card bg-white rounded-xl shadow-lg p-6 text-white admin-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm opacity-90 mb-1">Programs</p>
                    <p class="text-3xl font-bold">{{ \App\Models\Program::count() }}</p>
                </div>
                <div class="w-14 h-14 bg-white bg-opacity-20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                    <i class="fas fa-graduation-cap text-2xl"></i>
                </div>
            </div>
            <a href="{{ route('admin.programs.index') }}" class="text-sm opacity-90 mt-4 inline-block hover:underline">
                View all <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>

        <div class="stat-card bg-white rounded-xl shadow-lg p-6 text-white admin-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm opacity-90 mb-1">Events</p>
                    <p class="text-3xl font-bold">{{ \App\Models\Event::count() }}</p>
                </div>
                <div class="w-14 h-14 bg-white bg-opacity-20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                    <i class="fas fa-calendar text-2xl"></i>
                </div>
            </div>
            <a href="{{ route('admin.events.index') }}" class="text-sm opacity-90 mt-4 inline-block hover:underline">
                View all <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>

        <div class="stat-card bg-white rounded-xl shadow-lg p-6 text-white admin-card">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm opacity-90 mb-1">Team Members</p>
                    <p class="text-3xl font-bold">{{ \App\Models\TeamMember::count() }}</p>
                </div>
                <div class="w-14 h-14 bg-white bg-opacity-20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                    <i class="fas fa-users text-2xl"></i>
                </div>
            </div>
            <a href="{{ route('admin.team.index') }}" class="text-sm opacity-90 mt-4 inline-block hover:underline">
                View all <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Quick Actions -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-lg p-6 admin-card">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-800">Quick Actions</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <a href="{{ route('admin.pages.create') }}" class="flex items-center gap-4 p-4 bg-gradient-to-r from-blue-50 to-blue-100 rounded-lg hover:from-blue-100 hover:to-blue-200 transition-all group">
                        <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center text-white group-hover:scale-110 transition-transform">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800">Create Page</p>
                            <p class="text-sm text-gray-600">Add a new page</p>
                        </div>
                    </a>
                    <a href="{{ route('admin.programs.create') }}" class="flex items-center gap-4 p-4 bg-gradient-to-r from-purple-50 to-purple-100 rounded-lg hover:from-purple-100 hover:to-purple-200 transition-all group">
                        <div class="w-12 h-12 bg-purple-600 rounded-lg flex items-center justify-center text-white group-hover:scale-110 transition-transform">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800">Add Program</p>
                            <p class="text-sm text-gray-600">Create new program</p>
                        </div>
                    </a>
                    <a href="{{ route('admin.events.create') }}" class="flex items-center gap-4 p-4 bg-gradient-to-r from-green-50 to-green-100 rounded-lg hover:from-green-100 hover:to-green-200 transition-all group">
                        <div class="w-12 h-12 bg-green-600 rounded-lg flex items-center justify-center text-white group-hover:scale-110 transition-transform">
                            <i class="fas fa-calendar-plus"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800">Add Event</p>
                            <p class="text-sm text-gray-600">Schedule new event</p>
                        </div>
                    </a>
                    <a href="{{ route('admin.team.create') }}" class="flex items-center gap-4 p-4 bg-gradient-to-r from-orange-50 to-orange-100 rounded-lg hover:from-orange-100 hover:to-orange-200 transition-all group">
                        <div class="w-12 h-12 bg-orange-600 rounded-lg flex items-center justify-center text-white group-hover:scale-110 transition-transform">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800">Add Team Member</p>
                            <p class="text-sm text-gray-600">Add to team</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Quick Links -->
        <div class="bg-white rounded-xl shadow-lg p-6 admin-card">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Quick Links</h3>
            <div class="space-y-3">
                <a href="{{ route('admin.navigations.index') }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition-colors">
                    <i class="fas fa-bars text-primary-600 w-5"></i>
                    <span class="text-gray-700">Navigation Menu</span>
                </a>
                <a href="{{ route('admin.hero-banners.index') }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition-colors">
                    <i class="fas fa-image text-primary-600 w-5"></i>
                    <span class="text-gray-700">Hero Banners</span>
                </a>
                <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition-colors">
                    <i class="fas fa-external-link-alt text-primary-600 w-5"></i>
                    <span class="text-gray-700">View Website</span>
                </a>
            </div>
        </div>
    </div>
@endsection
