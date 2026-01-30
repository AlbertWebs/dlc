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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
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
            border-right: 1px solid rgba(248, 176, 22, 0.2);
        }
        .admin-nav-item {
            transition: all 0.2s ease;
            border-left: 3px solid transparent;
        }
        .admin-nav-item:hover {
            transform: translateX(4px);
            border-left-color: rgba(248, 176, 22, 0.5);
            background: rgba(248, 176, 22, 0.1);
        }
        .admin-nav-item.active {
            border-left-color: #d4af37;
            background: rgba(248, 176, 22, 0.2);
        }
        .admin-card {
            transition: all 0.2s ease;
        }
        .admin-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .nav-group-title {
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            padding: 0.75rem 1rem;
            margin-top: 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
        .nav-group-title:first-child {
            border-top: none;
            margin-top: 0;
        }
        /* Ensure full height for scrolling */
        html, body {
            height: 100%;
            overflow: hidden;
        }
    </style>
</head>
<body class="bg-gray-50 font-sans antialiased">
    <div class="h-screen flex overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 admin-sidebar text-white flex-shrink-0 shadow-2xl h-screen flex flex-col">
            <div class="flex flex-col h-full">
                <!-- Logo & Brand Section -->
                <div class="p-6 border-b border-white/10">
                    @php
                        // Get logo from settings (same logic as header component)
                        $logoFile = \App\Models\Setting::get('logo_file', '');
                        $logoUrl = \App\Models\Setting::get('logo_url', config('app.logo_url', ''));
                        $logo = $logoFile ? asset('storage/' . $logoFile) : ($logoUrl ?: null);
                    @endphp
                    <div class="flex items-center gap-3 mb-2">
                        @if($logo)
                            <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center shadow-lg p-2">
                                <img src="{{ $logo }}" 
                                     alt="{{ config('app.name', 'DLC') }} Logo" 
                                     class="w-full h-full object-contain"
                                     onerror="this.onerror=null; this.src=''; this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                <div class="w-full h-full bg-gradient-to-br from-accent-500 to-accent-600 rounded-xl flex items-center justify-center hidden">
                                    <i class="fas fa-graduation-cap text-white text-xl"></i>
                                </div>
                            </div>
                        @else
                            <div class="w-12 h-12 bg-gradient-to-br from-accent-500 to-accent-600 rounded-xl flex items-center justify-center shadow-lg">
                                <i class="fas fa-graduation-cap text-white text-xl"></i>
                            </div>
                        @endif
                        <div>
                            <h1 class="text-xl font-bold text-white">DLC Admin</h1>
                            <p class="text-xs text-gray-300">Content Management</p>
                        </div>
                    </div>
                </div>
                
                <!-- Navigation -->
                <nav class="flex-1 overflow-y-auto py-4 px-3">
                    <!-- Dashboard -->
                    <a href="{{ route('admin.dashboard') }}" class="admin-nav-item flex items-center gap-3 px-4 py-3 rounded-lg mb-1 {{ request()->routeIs('admin.dashboard') ? 'active bg-accent-500/20 text-accent-300 shadow-lg font-semibold' : 'hover:bg-accent-500/10 hover:text-accent-300 text-gray-300' }}">
                        <i class="fas fa-home w-5 text-center"></i>
                        <span class="font-medium">Dashboard</span>
                    </a>

                    <!-- Content Management Group -->
                    <div class="nav-group-title">Content</div>
                    <a href="{{ route('admin.pages.index') }}" class="admin-nav-item flex items-center gap-3 px-4 py-3 rounded-lg mb-1 {{ request()->routeIs('admin.pages.*') ? 'active bg-accent-500/20 text-accent-300 shadow-lg font-semibold' : 'hover:bg-accent-500/10 hover:text-accent-300 text-gray-300' }}">
                        <i class="fas fa-file-alt w-5 text-center"></i>
                        <span class="font-medium">Pages</span>
                    </a>
                    <a href="{{ route('admin.programs.index') }}" class="admin-nav-item flex items-center gap-3 px-4 py-3 rounded-lg mb-1 {{ request()->routeIs('admin.programs.*') ? 'active bg-accent-500/20 text-accent-300 shadow-lg font-semibold' : 'hover:bg-accent-500/10 hover:text-accent-300 text-gray-300' }}">
                        <i class="fas fa-graduation-cap w-5 text-center"></i>
                        <span class="font-medium">Programs</span>
                    </a>
                    <a href="{{ route('admin.about-page.index') }}" class="admin-nav-item flex items-center gap-3 px-4 py-3 rounded-lg mb-1 {{ request()->routeIs('admin.about-page.*') ? 'active bg-accent-500/20 text-accent-300 shadow-lg font-semibold' : 'hover:bg-accent-500/10 hover:text-accent-300 text-gray-300' }}">
                        <i class="fas fa-info-circle w-5 text-center"></i>
                        <span class="font-medium">About Page</span>
                    </a>
                    <a href="{{ route('admin.who-we-are.index') }}" class="admin-nav-item flex items-center gap-3 px-4 py-3 rounded-lg mb-1 {{ request()->routeIs('admin.who-we-are.*') ? 'active bg-accent-500/20 text-accent-300 shadow-lg font-semibold' : 'hover:bg-accent-500/10 hover:text-accent-300 text-gray-300' }}">
                        <i class="fas fa-users w-5 text-center"></i>
                        <span class="font-medium">Who We Are</span>
                    </a>
                    <a href="{{ route('admin.testimonials.index') }}" class="admin-nav-item flex items-center gap-3 px-4 py-3 rounded-lg mb-1 {{ request()->routeIs('admin.testimonials.*') ? 'active bg-accent-500/20 text-accent-300 shadow-lg font-semibold' : 'hover:bg-accent-500/10 hover:text-accent-300 text-gray-300' }}">
                        <i class="fas fa-quote-left w-5 text-center"></i>
                        <span class="font-medium">Testimonials</span>
                    </a>
                    <a href="{{ route('admin.blogs.index') }}" class="admin-nav-item flex items-center gap-3 px-4 py-3 rounded-lg mb-1 {{ request()->routeIs('admin.blogs.*') ? 'active bg-accent-500/20 text-accent-300 shadow-lg font-semibold' : 'hover:bg-accent-500/10 hover:text-accent-300 text-gray-300' }}">
                        <i class="fas fa-newspaper w-5 text-center"></i>
                        <span class="font-medium">Blogs</span>
                    </a>

                    <!-- Media & Design Group -->
                    <div class="nav-group-title">Media & Design</div>
                    <a href="{{ route('admin.hero-banners.index') }}" class="admin-nav-item flex items-center gap-3 px-4 py-3 rounded-lg mb-1 {{ request()->routeIs('admin.hero-banners.*') ? 'active bg-accent-500/20 text-accent-300 shadow-lg font-semibold' : 'hover:bg-accent-500/10 hover:text-accent-300 text-gray-300' }}">
                        <i class="fas fa-image w-5 text-center"></i>
                        <span class="font-medium">Hero Banners</span>
                    </a>
                    <a href="{{ route('admin.full-width-video.index') }}" class="admin-nav-item flex items-center gap-3 px-4 py-3 rounded-lg mb-1 {{ request()->routeIs('admin.full-width-video.*') ? 'active bg-accent-500/20 text-accent-300 shadow-lg font-semibold' : 'hover:bg-accent-500/10 hover:text-accent-300 text-gray-300' }}">
                        <i class="fas fa-video w-5 text-center"></i>
                        <span class="font-medium">Full Width Video</span>
                    </a>
                    <a href="{{ route('admin.videos.index') }}" class="admin-nav-item flex items-center gap-3 px-4 py-3 rounded-lg mb-1 {{ request()->routeIs('admin.videos.*') ? 'active bg-accent-500/20 text-accent-300 shadow-lg font-semibold' : 'hover:bg-accent-500/10 hover:text-accent-300 text-gray-300' }}">
                        <i class="fas fa-film w-5 text-center"></i>
                        <span class="font-medium">Videos</span>
                    </a>

                    <!-- People Group -->
                    <div class="nav-group-title">People</div>
                    <a href="{{ route('admin.team.index') }}" class="admin-nav-item flex items-center gap-3 px-4 py-3 rounded-lg mb-1 {{ request()->routeIs('admin.team.*') ? 'active bg-accent-500/20 text-accent-300 shadow-lg font-semibold' : 'hover:bg-accent-500/10 hover:text-accent-300 text-gray-300' }}">
                        <i class="fas fa-users w-5 text-center"></i>
                        <span class="font-medium">Team Members</span>
                    </a>
                    <a href="{{ route('admin.coaches.index') }}" class="admin-nav-item flex items-center gap-3 px-4 py-3 rounded-lg mb-1 {{ request()->routeIs('admin.coaches.*') ? 'active bg-accent-500/20 text-accent-300 shadow-lg font-semibold' : 'hover:bg-accent-500/10 hover:text-accent-300 text-gray-300' }}">
                        <i class="fas fa-user-tie w-5 text-center"></i>
                        <span class="font-medium">Coaches</span>
                    </a>

                    <!-- Events & Activities Group -->
                    <div class="nav-group-title">Events</div>
                    <a href="{{ route('admin.events.index') }}" class="admin-nav-item flex items-center gap-3 px-4 py-3 rounded-lg mb-1 {{ request()->routeIs('admin.events.*') ? 'active bg-accent-500/20 text-accent-300 shadow-lg font-semibold' : 'hover:bg-accent-500/10 hover:text-accent-300 text-gray-300' }}">
                        <i class="fas fa-calendar-alt w-5 text-center"></i>
                        <span class="font-medium">Events</span>
                    </a>

                    <!-- Settings Group -->
                    <div class="nav-group-title">Settings</div>
                    <a href="{{ route('admin.legal-pages.index') }}" class="admin-nav-item flex items-center gap-3 px-4 py-3 rounded-lg mb-1 {{ request()->routeIs('admin.legal-pages.*') ? 'active bg-accent-500/20 text-accent-300 shadow-lg font-semibold' : 'hover:bg-accent-500/10 hover:text-accent-300 text-gray-300' }}">
                        <i class="fas fa-gavel w-5 text-center"></i>
                        <span class="font-medium">Legal Pages</span>
                    </a>
                    <a href="{{ route('admin.navigations.index') }}" class="admin-nav-item flex items-center gap-3 px-4 py-3 rounded-lg mb-1 {{ request()->routeIs('admin.navigations.*') ? 'active bg-accent-500/20 text-accent-300 shadow-lg font-semibold' : 'hover:bg-accent-500/10 hover:text-accent-300 text-gray-300' }}">
                        <i class="fas fa-bars w-5 text-center"></i>
                        <span class="font-medium">Navigation</span>
                    </a>
                    <a href="{{ route('admin.settings') }}" class="admin-nav-item flex items-center gap-3 px-4 py-3 rounded-lg mb-1 {{ request()->routeIs('admin.settings*') ? 'active bg-accent-500/20 text-accent-300 shadow-lg font-semibold' : 'hover:bg-accent-500/10 hover:text-accent-300 text-gray-300' }}">
                        <i class="fas fa-cog w-5 text-center"></i>
                        <span class="font-medium">Settings</span>
                    </a>
                    <a href="{{ route('admin.backup') }}" class="admin-nav-item flex items-center gap-3 px-4 py-3 rounded-lg mb-1 {{ request()->routeIs('admin.backup*') ? 'active bg-accent-500/20 text-accent-300 shadow-lg font-semibold' : 'hover:bg-accent-500/10 hover:text-accent-300 text-gray-300' }}">
                        <i class="fas fa-database w-5 text-center"></i>
                        <span class="font-medium">Backup</span>
                    </a>
                    
                    <!-- External Link -->
                    <div class="border-t border-white/10 mt-4 pt-4">
                        <a href="{{ route('home') }}" target="_blank" class="admin-nav-item flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-accent-500/10 hover:text-accent-300 text-gray-300">
                            <i class="fas fa-external-link-alt w-5 text-center"></i>
                            <span class="font-medium">View Site</span>
                        </a>
                    </div>
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
            <!-- Top Bar -->
            <header class="bg-white shadow-md border-b-2 border-accent-500/20 z-40 flex-shrink-0">
                <div class="px-6 py-4 flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-primary-600 to-primary-800 rounded-xl flex items-center justify-center shadow-lg">
                            <i class="fas fa-tachometer-alt text-white"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-primary-900">@yield('page-title', 'Dashboard')</h2>
                            <p class="text-sm text-gray-500 mt-0.5">@yield('page-description', 'Manage your content')</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <!-- Quick Actions -->
                        <div class="hidden md:flex items-center gap-2">
                            <a href="{{ route('home') }}" target="_blank" class="px-4 py-2 bg-primary-50 text-primary-700 rounded-lg hover:bg-primary-100 transition-colors text-sm font-medium flex items-center gap-2">
                                <i class="fas fa-external-link-alt text-xs"></i>
                                <span>View Site</span>
                            </a>
                        </div>
                        
                        <!-- User Dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center gap-3 px-4 py-2.5 bg-gradient-to-r from-primary-50 to-primary-100 rounded-xl hover:from-primary-100 hover:to-primary-200 transition-all focus:outline-none focus:ring-2 focus:ring-primary-500 shadow-sm">
                                <div class="w-9 h-9 bg-gradient-to-br from-primary-600 to-primary-800 rounded-lg flex items-center justify-center text-white text-sm font-bold shadow-md">
                                    {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                                </div>
                                <div class="text-left hidden md:block">
                                    <div class="text-sm font-semibold text-primary-900">{{ Auth::user()->name ?? 'Admin' }}</div>
                                    <div class="text-xs text-gray-600">{{ Auth::user()->email ?? 'Administrator' }}</div>
                                </div>
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
                                 class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-2xl border border-gray-200 py-2 z-50"
                                 style="display: none;">
                                <a href="{{ route('admin.settings') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-primary-50 transition-colors">
                                    <i class="fas fa-cog w-5 text-primary-600"></i>
                                    <span>Settings</span>
                                </a>
                                <a href="{{ route('admin.backup') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-primary-50 transition-colors">
                                    <i class="fas fa-database w-5 text-primary-600"></i>
                                    <span>Run Backup</span>
                                </a>
                                <div class="border-t border-gray-200 my-2"></div>
                                <form action="{{ route('logout') }}" method="POST" class="w-full">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 transition-colors text-left">
                                        <i class="fas fa-sign-out-alt w-5 text-gray-400"></i>
                                        <span>Logout</span>
                                    </button>
                                </form>
                                <div class="border-t border-red-200 my-2"></div>
                                <a href="{{ route('admin.danger-zone') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                    <i class="fas fa-exclamation-triangle w-5 text-red-500"></i>
                                    <span>Danger Zone</span>
                                    <span class="ml-auto text-xs bg-red-100 text-red-600 px-2 py-0.5 rounded font-medium">Purge</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 p-6 overflow-y-auto bg-gradient-to-br from-gray-50 to-white min-h-0">
                @if(session('success'))
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 text-green-800 px-4 py-3 rounded-lg mb-6 shadow-sm flex items-center gap-3">
                        <i class="fas fa-check-circle text-green-600"></i>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-gradient-to-r from-red-50 to-rose-50 border-l-4 border-red-500 text-red-800 px-4 py-3 rounded-lg mb-6 shadow-sm flex items-center gap-3">
                        <i class="fas fa-exclamation-circle text-red-600"></i>
                        <span class="font-medium">{{ session('error') }}</span>
                    </div>
                @endif

                @if($errors->any())
                    <div class="bg-gradient-to-r from-red-50 to-rose-50 border-l-4 border-red-500 text-red-800 px-4 py-3 rounded-lg mb-6 shadow-sm">
                        <div class="flex items-center gap-2 mb-3">
                            <i class="fas fa-exclamation-circle text-red-600"></i>
                            <strong class="text-lg font-bold">Exact Error Details:</strong>
                        </div>
                        <div class="space-y-2">
                            @foreach($errors->all() as $error)
                                <div class="bg-red-100 p-3 rounded-lg border border-red-300">
                                    <p class="font-semibold text-red-800 text-sm">{{ $error }}</p>
                                </div>
                            @endforeach
                        </div>
                        @if($errors->has('video_file'))
                            <div class="mt-3 p-4 bg-yellow-50 border border-yellow-300 rounded-lg">
                                <p class="text-xs font-semibold text-yellow-800 mb-2">🔧 Current PHP Configuration:</p>
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
