<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin') - {{ config('app.name', 'DLC Admin') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- CKEditor 5 Classic Build (Free) -->
    <script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    
    <style>
        /* Admin Panel Custom Styles */
        .admin-sidebar {
            background: linear-gradient(180deg, #1e3a5f 0%, #0f1f35 100%);
        }
        .admin-nav-item {
            transition: all 0.2s ease;
        }
        .admin-nav-item:hover {
            transform: translateX(4px);
        }
        .admin-card {
            transition: all 0.2s ease;
        }
        .admin-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .btn {
            transition: all 0.2s ease;
        }
        .btn:hover {
            transform: translateY(-1px);
        }
        .stat-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .stat-card:nth-child(2) {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }
        .stat-card:nth-child(3) {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }
        .stat-card:nth-child(4) {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }
    </style>
</head>
<body class="bg-gray-50 font-sans antialiased">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 admin-sidebar text-white flex-shrink-0 shadow-xl">
            <div class="p-6 h-full flex flex-col">
                <div class="mb-8">
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center">
                            <i class="fas fa-graduation-cap text-xl"></i>
                        </div>
                        <div>
                            <h1 class="text-xl font-bold">DLC Admin</h1>
                            <p class="text-xs text-gray-300">Content Management</p>
                        </div>
                    </div>
                </div>
                
                <nav class="flex-1 space-y-1">
                    <a href="{{ route('admin.dashboard') }}" class="admin-nav-item flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-accent-500 text-primary-900 shadow-lg font-semibold' : 'hover:bg-accent-500 hover:bg-opacity-20 hover:text-accent-300' }}">
                        <i class="fas fa-home w-5 text-center"></i>
                        <span class="font-medium">Dashboard</span>
                    </a>
                    <a href="{{ route('admin.pages.index') }}" class="admin-nav-item flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.pages.*') ? 'bg-accent-500 text-primary-900 shadow-lg font-semibold' : 'hover:bg-accent-500 hover:bg-opacity-20 hover:text-accent-300' }}">
                        <i class="fas fa-file-alt w-5 text-center"></i>
                        <span class="font-medium">Pages</span>
                    </a>
                    <a href="{{ route('admin.navigations.index') }}" class="admin-nav-item flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.navigations.*') ? 'bg-accent-500 text-primary-900 shadow-lg font-semibold' : 'hover:bg-accent-500 hover:bg-opacity-20 hover:text-accent-300' }}">
                        <i class="fas fa-bars w-5 text-center"></i>
                        <span class="font-medium">Navigation</span>
                    </a>
                    <a href="{{ route('admin.programs.index') }}" class="admin-nav-item flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.programs.*') ? 'bg-accent-500 text-primary-900 shadow-lg font-semibold' : 'hover:bg-accent-500 hover:bg-opacity-20 hover:text-accent-300' }}">
                        <i class="fas fa-graduation-cap w-5 text-center"></i>
                        <span class="font-medium">Programs</span>
                    </a>
                    <a href="{{ route('admin.team.index') }}" class="admin-nav-item flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.team.*') ? 'bg-accent-500 text-primary-900 shadow-lg font-semibold' : 'hover:bg-accent-500 hover:bg-opacity-20 hover:text-accent-300' }}">
                        <i class="fas fa-users w-5 text-center"></i>
                        <span class="font-medium">Team</span>
                    </a>
                    <a href="{{ route('admin.events.index') }}" class="admin-nav-item flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.events.*') ? 'bg-accent-500 text-primary-900 shadow-lg font-semibold' : 'hover:bg-accent-500 hover:bg-opacity-20 hover:text-accent-300' }}">
                        <i class="fas fa-calendar w-5 text-center"></i>
                        <span class="font-medium">Events</span>
                    </a>
                    <a href="{{ route('admin.hero-banners.index') }}" class="admin-nav-item flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.hero-banners.*') ? 'bg-accent-500 text-primary-900 shadow-lg font-semibold' : 'hover:bg-accent-500 hover:bg-opacity-20 hover:text-accent-300' }}">
                        <i class="fas fa-image w-5 text-center"></i>
                        <span class="font-medium">Hero Banners</span>
                    </a>
                    <a href="{{ route('admin.coaches.index') }}" class="admin-nav-item flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.coaches.*') ? 'bg-accent-500 text-primary-900 shadow-lg font-semibold' : 'hover:bg-accent-500 hover:bg-opacity-20 hover:text-accent-300' }}">
                        <i class="fas fa-user-tie w-5 text-center"></i>
                        <span class="font-medium">Coaches</span>
                    </a>
                    <a href="{{ route('admin.videos.index') }}" class="admin-nav-item flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.videos.*') ? 'bg-accent-500 text-primary-900 shadow-lg font-semibold' : 'hover:bg-accent-500 hover:bg-opacity-20 hover:text-accent-300' }}">
                        <i class="fas fa-video w-5 text-center"></i>
                        <span class="font-medium">Videos</span>
                    </a>
                    <a href="{{ route('admin.full-width-video.index') }}" class="admin-nav-item flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.full-width-video.*') ? 'bg-accent-500 text-primary-900 shadow-lg font-semibold' : 'hover:bg-accent-500 hover:bg-opacity-20 hover:text-accent-300' }}">
                        <i class="fas fa-expand-arrows-alt w-5 text-center"></i>
                        <span class="font-medium">Full Width Video</span>
                    </a>
                    <a href="{{ route('admin.who-we-are.index') }}" class="admin-nav-item flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.who-we-are.*') ? 'bg-accent-500 text-primary-900 shadow-lg font-semibold' : 'hover:bg-accent-500 hover:bg-opacity-20 hover:text-accent-300' }}">
                        <i class="fas fa-info-circle w-5 text-center"></i>
                        <span class="font-medium">Who We Are</span>
                    </a>
                    <a href="{{ route('admin.testimonials.index') }}" class="admin-nav-item flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.testimonials.*') ? 'bg-accent-500 text-primary-900 shadow-lg font-semibold' : 'hover:bg-accent-500 hover:bg-opacity-20 hover:text-accent-300' }}">
                        <i class="fas fa-quote-left w-5 text-center"></i>
                        <span class="font-medium">Testimonials</span>
                    </a>
                    <a href="{{ route('admin.about-page.index') }}" class="admin-nav-item flex items-center gap-3 px-4 py-3 rounded-lg {{ request()->routeIs('admin.about-page.*') ? 'bg-accent-500 text-primary-900 shadow-lg font-semibold' : 'hover:bg-accent-500 hover:bg-opacity-20 hover:text-accent-300' }}">
                        <i class="fas fa-file-alt w-5 text-center"></i>
                        <span class="font-medium">About Page</span>
                    </a>
                    
                    <div class="border-t border-white border-opacity-20 mt-6 pt-4">
                        <a href="{{ route('home') }}" target="_blank" class="admin-nav-item flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-accent-500 hover:bg-opacity-20 hover:text-accent-300">
                            <i class="fas fa-external-link-alt w-5 text-center"></i>
                            <span class="font-medium">View Site</span>
                        </a>
                    </div>
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-w-0">
            <!-- Top Bar -->
            <header class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-40">
                <div class="px-6 py-4 flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-800">@yield('page-title', 'Dashboard')</h2>
                        <p class="text-sm text-gray-500 mt-1">@yield('page-description', 'Manage your content')</p>
                    </div>
                    <div class="flex items-center gap-4">
                        <!-- User Dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center gap-2 px-4 py-2 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors focus:outline-none focus:ring-2 focus:ring-primary-500">
                                <div class="w-8 h-8 bg-primary-600 rounded-full flex items-center justify-center text-white text-sm font-semibold">
                                    A
                                </div>
                                <span class="text-sm font-medium text-gray-700">Admin</span>
                                <i class="fas fa-chevron-down text-xs text-gray-500 transition-transform" :class="{ 'rotate-180': open }"></i>
                            </button>
                            
                            <!-- Dropdown Menu -->
                            <div x-show="open" 
                                 @click.away="open = false"
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-xl border border-gray-200 py-2 z-50"
                                 style="display: none;">
                                <a href="{{ route('admin.settings') }}" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                    <i class="fas fa-cog w-5 text-gray-400"></i>
                                    <span>Settings</span>
                                </a>
                                <a href="{{ route('admin.backup') }}" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                    <i class="fas fa-database w-5 text-gray-400"></i>
                                    <span>Run Backup</span>
                                </a>
                                <div class="border-t border-gray-200 my-2"></div>
                                <form action="{{ route('admin.logout') }}" method="POST" class="w-full">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors text-left">
                                        <i class="fas fa-sign-out-alt w-5 text-gray-400"></i>
                                        <span>Logout</span>
                                    </button>
                                </form>
                                <div class="border-t border-red-200 my-2"></div>
                                <a href="{{ route('admin.danger-zone') }}" class="flex items-center gap-3 px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                    <i class="fas fa-exclamation-triangle w-5 text-red-500"></i>
                                    <span>Danger Zone</span>
                                    <span class="ml-auto text-xs bg-red-100 text-red-600 px-2 py-0.5 rounded">Purge Data</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 p-6 overflow-y-auto">
                @if(session('success'))
                    <div class="bg-green-50 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded-lg mb-6 shadow-sm flex items-center gap-3">
                        <i class="fas fa-check-circle"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded-lg mb-6 shadow-sm">
                        <div class="flex items-center gap-2 mb-3">
                            <i class="fas fa-exclamation-circle text-red-600"></i>
                            <strong class="text-lg">Exact Error Details:</strong>
                        </div>
                        <div class="space-y-2">
                            @foreach($errors->all() as $error)
                                <div class="bg-red-100 p-3 rounded border border-red-300">
                                    <p class="font-semibold text-red-800 text-sm">{{ $error }}</p>
                                </div>
                            @endforeach
                        </div>
                        @if($errors->has('video_file'))
                            <div class="mt-3 p-3 bg-yellow-50 border border-yellow-300 rounded">
                                <p class="text-xs font-semibold text-yellow-800 mb-1">🔧 Current PHP Configuration:</p>
                                <ul class="text-xs text-yellow-700 space-y-1">
                                    <li>• upload_max_filesize: <strong>{{ ini_get('upload_max_filesize') }}</strong></li>
                                    <li>• post_max_size: <strong>{{ ini_get('post_max_size') }}</strong></li>
                                    <li>• max_execution_time: <strong>{{ ini_get('max_execution_time') }}s</strong></li>
                                </ul>
                                <p class="text-xs text-yellow-800 mt-2 font-semibold">💡 Quick Fix: Update php.ini and set upload_max_filesize = 10M, post_max_size = 12M, then restart your web server.</p>
                            </div>
                        @endif
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <!-- Alpine.js for dropdown -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- CKEditor Initialization Script -->
    <script>
        // Initialize CKEditor for all textareas with class 'ckeditor'
        document.addEventListener('DOMContentLoaded', function() {
            const editors = document.querySelectorAll('.ckeditor');
            editors.forEach(function(textarea) {
                ClassicEditor
                    .create(textarea, {
                        toolbar: {
                            items: [
                                'heading', '|',
                                'bold', 'italic', 'underline', 'strikethrough', '|',
                                'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', '|',
                                'bulletedList', 'numberedList', '|',
                                'alignment', '|',
                                'link', 'blockQuote', 'insertTable', '|',
                                'undo', 'redo', '|',
                                'sourceEditing'
                            ],
                            shouldNotGroupWhenFull: true
                        },
                        fontSize: {
                            options: [9, 11, 13, 'default', 17, 19, 21, 27, 35]
                        },
                        fontFamily: {
                            options: [
                                'default',
                                'Inter, sans-serif',
                                'Arial, Helvetica, sans-serif',
                                'Courier New, Courier, monospace',
                                'Georgia, serif',
                                'Lucida Sans Unicode, Lucida Grande, sans-serif',
                                'Tahoma, Geneva, sans-serif',
                                'Times New Roman, Times, serif',
                                'Trebuchet MS, Helvetica, sans-serif',
                                'Verdana, Geneva, sans-serif'
                            ]
                        },
                        link: {
                            decorators: {
                                openInNewTab: {
                                    mode: 'manual',
                                    label: 'Open in a new tab',
                                    attributes: {
                                        target: '_blank',
                                        rel: 'noopener noreferrer'
                                    }
                                }
                            }
                        },
                        table: {
                            contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells']
                        },
                        heading: {
                            options: [
                                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                                { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                                { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' }
                            ]
                        }
                    })
                    .catch(error => {
                        console.error('Error initializing CKEditor:', error);
                    });
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
