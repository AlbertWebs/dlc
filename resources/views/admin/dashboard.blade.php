@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-description', 'Overview of your content and quick actions')

@section('content')
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Pages Card -->
        <div class="bg-gradient-to-br from-blue-600 via-blue-600 to-blue-700 rounded-xl shadow-lg p-6 text-white admin-card hover:shadow-xl transition-shadow border-2 border-blue-500/40">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-blue-100 mb-1">Total Pages</p>
                    <p class="text-3xl font-bold text-white drop-shadow-sm">{{ \App\Models\Page::count() }}</p>
                </div>
                <div class="w-14 h-14 bg-white/30 rounded-xl flex items-center justify-center backdrop-blur-sm border-2 border-white/40 shadow-lg">
                    <i class="fas fa-file-alt text-2xl text-white drop-shadow-sm"></i>
                </div>
            </div>
            <a href="{{ route('admin.pages.index') }}" class="text-sm font-semibold text-blue-100 mt-4 inline-flex items-center hover:text-white transition-colors">
                View all <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>

        <!-- Programs Card -->
        <div class="bg-gradient-to-br from-purple-600 via-purple-600 to-purple-700 rounded-xl shadow-lg p-6 text-white admin-card hover:shadow-xl transition-shadow border-2 border-purple-500/40">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-purple-100 mb-1">Programs</p>
                    <p class="text-3xl font-bold text-white drop-shadow-sm">{{ \App\Models\Program::count() }}</p>
                </div>
                <div class="w-14 h-14 bg-white/30 rounded-xl flex items-center justify-center backdrop-blur-sm border-2 border-white/40 shadow-lg">
                    <i class="fas fa-graduation-cap text-2xl text-white drop-shadow-sm"></i>
                </div>
            </div>
            <a href="{{ route('admin.programs.index') }}" class="text-sm font-semibold text-purple-100 mt-4 inline-flex items-center hover:text-white transition-colors">
                View all <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>

        <!-- Events Card -->
        <div class="bg-gradient-to-br from-green-600 via-green-600 to-green-700 rounded-xl shadow-lg p-6 text-white admin-card hover:shadow-xl transition-shadow border-2 border-green-500/40">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-green-100 mb-1">Events</p>
                    <p class="text-3xl font-bold text-white drop-shadow-sm">{{ \App\Models\Event::count() }}</p>
                </div>
                <div class="w-14 h-14 bg-white/30 rounded-xl flex items-center justify-center backdrop-blur-sm border-2 border-white/40 shadow-lg">
                    <i class="fas fa-calendar text-2xl text-white drop-shadow-sm"></i>
                </div>
            </div>
            <a href="{{ route('admin.events.index') }}" class="text-sm font-semibold text-green-100 mt-4 inline-flex items-center hover:text-white transition-colors">
                View all <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>

        <!-- Blog Posts Card -->
        <div class="bg-gradient-to-br from-violet-600 via-violet-600 to-violet-700 rounded-xl shadow-lg p-6 text-white admin-card hover:shadow-xl transition-shadow border-2 border-violet-500/40">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-violet-100 mb-1">Blog Posts</p>
                    <p class="text-3xl font-bold text-white drop-shadow-sm">{{ \App\Models\BlogPost::count() }}</p>
                </div>
                <div class="w-14 h-14 bg-white/30 rounded-xl flex items-center justify-center backdrop-blur-sm border-2 border-white/40 shadow-lg">
                    <i class="fas fa-newspaper text-2xl text-white drop-shadow-sm"></i>
                </div>
            </div>
            <a href="{{ route('admin.blogs.index') }}" class="text-sm font-semibold text-violet-100 mt-4 inline-flex items-center hover:text-white transition-colors">
                View all <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
    </div>

    <!-- Second Row Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Team Members Card -->
        <div class="bg-gradient-to-br from-orange-600 via-orange-600 to-orange-700 rounded-xl shadow-lg p-6 text-white admin-card hover:shadow-xl transition-shadow border-2 border-orange-500/40">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-orange-100 mb-1">Team Members</p>
                    <p class="text-3xl font-bold text-white drop-shadow-sm">{{ \App\Models\TeamMember::count() }}</p>
                </div>
                <div class="w-14 h-14 bg-white/30 rounded-xl flex items-center justify-center backdrop-blur-sm border-2 border-white/40 shadow-lg">
                    <i class="fas fa-users text-2xl text-white drop-shadow-sm"></i>
                </div>
            </div>
            <a href="{{ route('admin.team.index') }}" class="text-sm font-semibold text-orange-100 mt-4 inline-flex items-center hover:text-white transition-colors">
                View all <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>

        <!-- Coaches Card -->
        <div class="bg-gradient-to-br from-teal-600 via-teal-600 to-teal-700 rounded-xl shadow-lg p-6 text-white admin-card hover:shadow-xl transition-shadow border-2 border-teal-500/40">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-teal-100 mb-1">Coaches</p>
                    <p class="text-3xl font-bold text-white drop-shadow-sm">{{ \App\Models\Coach::count() }}</p>
                </div>
                <div class="w-14 h-14 bg-white/30 rounded-xl flex items-center justify-center backdrop-blur-sm border-2 border-white/40 shadow-lg">
                    <i class="fas fa-user-tie text-2xl text-white drop-shadow-sm"></i>
                </div>
            </div>
            <a href="{{ route('admin.coaches.index') }}" class="text-sm font-semibold text-teal-100 mt-4 inline-flex items-center hover:text-white transition-colors">
                View all <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>

        <!-- Testimonials Card -->
        <div class="bg-gradient-to-br from-pink-600 via-pink-600 to-pink-700 rounded-xl shadow-lg p-6 text-white admin-card hover:shadow-xl transition-shadow border-2 border-pink-500/40">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-pink-100 mb-1">Testimonials</p>
                    <p class="text-3xl font-bold text-white drop-shadow-sm">{{ \App\Models\Testimonial::count() }}</p>
                </div>
                <div class="w-14 h-14 bg-white/30 rounded-xl flex items-center justify-center backdrop-blur-sm border-2 border-white/40 shadow-lg">
                    <i class="fas fa-quote-left text-2xl text-white drop-shadow-sm"></i>
                </div>
            </div>
            <a href="{{ route('admin.testimonials.index') }}" class="text-sm font-semibold text-pink-100 mt-4 inline-flex items-center hover:text-white transition-colors">
                View all <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>

        <!-- Videos Card -->
        <div class="bg-gradient-to-br from-red-600 via-red-600 to-red-700 rounded-xl shadow-lg p-6 text-white admin-card hover:shadow-xl transition-shadow border-2 border-red-500/40">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-semibold text-red-100 mb-1">Videos</p>
                    <p class="text-3xl font-bold text-white drop-shadow-sm">{{ \App\Models\Video::count() }}</p>
                </div>
                <div class="w-14 h-14 bg-white/30 rounded-xl flex items-center justify-center backdrop-blur-sm border-2 border-white/40 shadow-lg">
                    <i class="fas fa-video text-2xl text-white drop-shadow-sm"></i>
                </div>
            </div>
            <a href="{{ route('admin.videos.index') }}" class="text-sm font-semibold text-red-100 mt-4 inline-flex items-center hover:text-white transition-colors">
                View all <i class="fas fa-arrow-right ml-1"></i>
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Quick Actions -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-lg p-6 admin-card">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Quick Actions</h3>
                        <p class="text-sm text-gray-500 mt-1">Common tasks and shortcuts</p>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <a href="{{ route('admin.pages.create') }}" class="flex items-center gap-4 p-4 bg-gradient-to-r from-blue-50 to-blue-100 rounded-lg hover:from-blue-100 hover:to-blue-200 transition-all group border border-blue-200">
                        <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center text-white group-hover:scale-110 transition-transform shadow-md">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800">Create Page</p>
                            <p class="text-sm text-gray-600">Add a new page</p>
                        </div>
                    </a>
                    <a href="{{ route('admin.programs.create') }}" class="flex items-center gap-4 p-4 bg-gradient-to-r from-purple-50 to-purple-100 rounded-lg hover:from-purple-100 hover:to-purple-200 transition-all group border border-purple-200">
                        <div class="w-12 h-12 bg-purple-600 rounded-lg flex items-center justify-center text-white group-hover:scale-110 transition-transform shadow-md">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800">Add Program</p>
                            <p class="text-sm text-gray-600">Create new program</p>
                        </div>
                    </a>
                    <a href="{{ route('admin.events.create') }}" class="flex items-center gap-4 p-4 bg-gradient-to-r from-green-50 to-green-100 rounded-lg hover:from-green-100 hover:to-green-200 transition-all group border border-green-200">
                        <div class="w-12 h-12 bg-green-600 rounded-lg flex items-center justify-center text-white group-hover:scale-110 transition-transform shadow-md">
                            <i class="fas fa-calendar-plus"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800">Add Event</p>
                            <p class="text-sm text-gray-600">Schedule new event</p>
                        </div>
                    </a>
                    <a href="{{ route('admin.blogs.create') }}" class="flex items-center gap-4 p-4 bg-gradient-to-r from-violet-50 to-violet-100 rounded-lg hover:from-violet-100 hover:to-violet-200 transition-all group border border-violet-200">
                        <div class="w-12 h-12 bg-violet-700 rounded-lg flex items-center justify-center text-white group-hover:scale-110 transition-transform shadow-lg">
                            <i class="fas fa-newspaper text-lg drop-shadow-sm"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800">New Blog Post</p>
                            <p class="text-sm text-gray-600">Write a new article</p>
                        </div>
                    </a>
                    <a href="{{ route('admin.team.create') }}" class="flex items-center gap-4 p-4 bg-gradient-to-r from-orange-50 to-orange-100 rounded-lg hover:from-orange-100 hover:to-orange-200 transition-all group border border-orange-200">
                        <div class="w-12 h-12 bg-orange-600 rounded-lg flex items-center justify-center text-white group-hover:scale-110 transition-transform shadow-md">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800">Add Team Member</p>
                            <p class="text-sm text-gray-600">Add to team</p>
                        </div>
                    </a>
                    <a href="{{ route('admin.coaches.create') }}" class="flex items-center gap-4 p-4 bg-gradient-to-r from-teal-50 to-teal-100 rounded-lg hover:from-teal-100 hover:to-teal-200 transition-all group border border-teal-200">
                        <div class="w-12 h-12 bg-teal-700 rounded-lg flex items-center justify-center text-white group-hover:scale-110 transition-transform shadow-lg">
                            <i class="fas fa-user-tie text-lg drop-shadow-sm"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800">Add Coach</p>
                            <p class="text-sm text-gray-600">Register new coach</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Quick Links -->
        <div class="bg-white rounded-xl shadow-lg p-6 admin-card">
            <div class="mb-4">
                <h3 class="text-lg font-semibold text-gray-800">Quick Links</h3>
                <p class="text-sm text-gray-500 mt-1">Navigation shortcuts</p>
            </div>
            <div class="space-y-2">
                <a href="{{ route('admin.navigations.index') }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition-colors border border-transparent hover:border-gray-200">
                    <i class="fas fa-bars text-primary-600 w-5"></i>
                    <span class="text-gray-700 font-medium">Navigation Menu</span>
                    <i class="fas fa-chevron-right text-gray-400 ml-auto text-xs"></i>
                </a>
                <a href="{{ route('admin.hero-banners.index') }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition-colors border border-transparent hover:border-gray-200">
                    <i class="fas fa-image text-primary-600 w-5"></i>
                    <span class="text-gray-700 font-medium">Hero Banners</span>
                    <i class="fas fa-chevron-right text-gray-400 ml-auto text-xs"></i>
                </a>
                <a href="{{ route('admin.testimonials.index') }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition-colors border border-transparent hover:border-gray-200">
                    <i class="fas fa-quote-left text-primary-600 w-5"></i>
                    <span class="text-gray-700 font-medium">Testimonials</span>
                    <i class="fas fa-chevron-right text-gray-400 ml-auto text-xs"></i>
                </a>
                <a href="{{ route('admin.videos.index') }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition-colors border border-transparent hover:border-gray-200">
                    <i class="fas fa-video text-primary-600 w-5"></i>
                    <span class="text-gray-700 font-medium">Videos</span>
                    <i class="fas fa-chevron-right text-gray-400 ml-auto text-xs"></i>
                </a>
                <a href="{{ route('admin.settings') }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition-colors border border-transparent hover:border-gray-200">
                    <i class="fas fa-cog text-primary-600 w-5"></i>
                    <span class="text-gray-700 font-medium">Settings</span>
                    <i class="fas fa-chevron-right text-gray-400 ml-auto text-xs"></i>
                </a>
                <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition-colors border border-transparent hover:border-gray-200">
                    <i class="fas fa-external-link-alt text-primary-600 w-5"></i>
                    <span class="text-gray-700 font-medium">View Website</span>
                    <i class="fas fa-chevron-right text-gray-400 ml-auto text-xs"></i>
                </a>
            </div>
        </div>
    </div>
@endsection
