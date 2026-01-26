@extends('layouts.app')

@section('title', $program->title)
@section('description', $program->excerpt ?? Str::limit($program->description, 160))

@section('content')
    @php
        $siteEmail = \App\Models\Setting::get('email', 'info@dlc.co.ke');
    @endphp

    <!-- Breadcrumb -->
    <section class="bg-gradient-to-r from-primary-900 via-primary-800 to-primary-900 text-white py-3 md:py-4 border-b-2 border-accent-500/30 shadow-lg">
        <div class="container">
            <nav class="flex items-center gap-2 text-xs md:text-sm overflow-x-auto scrollbar-hide" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-accent-400 transition-colors flex items-center gap-1.5 whitespace-nowrap px-2 py-1 rounded-md hover:bg-white/10">
                    <i class="fas fa-home text-xs"></i>
                    <span class="hidden sm:inline">Home</span>
                </a>
                <i class="fas fa-chevron-right text-xs text-primary-300 flex-shrink-0"></i>
                <a href="{{ route('programs.index') }}" class="hover:text-accent-400 transition-colors whitespace-nowrap px-2 py-1 rounded-md hover:bg-white/10">
                    <span class="hidden sm:inline">Programs</span>
                    <span class="sm:hidden">Programs</span>
                </a>
                <i class="fas fa-chevron-right text-xs text-primary-300 flex-shrink-0"></i>
                <span class="text-accent-400 font-semibold px-2 py-1 rounded-md bg-accent-500/10 border border-accent-500/30 truncate max-w-[200px] sm:max-w-none">
                    {{ $program->title }}
                </span>
            </nav>
        </div>
    </section>

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-primary-50 via-white to-accent-50/30 py-12 md:py-16 lg:py-24 overflow-hidden">
        <!-- Decorative Background -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-accent-500/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-primary-500/5 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2"></div>
        
        <div class="container relative z-10">
            <div class="max-w-4xl">
                <div class="flex flex-col md:flex-row items-start md:items-center gap-6 mb-8">
                    @if($program->image)
                        @php
                            $imageUrl = str_starts_with($program->image, 'http') 
                                ? $program->image 
                                : asset('storage/' . $program->image);
                        @endphp
                        <div class="w-24 h-24 md:w-32 md:h-32 rounded-2xl overflow-hidden shadow-xl border-4 border-white flex-shrink-0">
                            <img src="{{ $imageUrl }}" 
                                 alt="{{ $program->title }}" 
                                 class="w-full h-full object-cover"
                                 onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            <div class="w-full h-full bg-gradient-to-br from-primary-600 to-primary-800 flex items-center justify-center hidden">
                                <i class="fas {{ $program->icon ?? 'fa-briefcase' }} text-4xl text-white"></i>
                            </div>
                        </div>
                    @else
                        <div class="w-24 h-24 md:w-32 md:h-32 bg-gradient-to-br from-primary-600 to-primary-800 rounded-2xl flex items-center justify-center shadow-xl border-4 border-white flex-shrink-0">
                            <i class="fas {{ $program->icon ?? 'fa-briefcase' }} text-4xl md:text-5xl text-white"></i>
                        </div>
                    @endif
                    
                    <div class="flex-1">
                        <div class="inline-block mb-3">
                            <span class="px-3 py-1.5 bg-accent-500/10 border border-accent-500/30 rounded-full text-accent-600 font-semibold text-xs uppercase tracking-wider">
                                Coaching Program
                            </span>
                        </div>
                        <h1 class="text-3xl md:text-4xl lg:text-5xl xl:text-6xl font-bold text-primary-900 mb-4 leading-tight">
                            {{ $program->title }}
                        </h1>
                        @if($program->excerpt)
                            <p class="text-lg md:text-xl text-gray-600 leading-relaxed">{{ strip_tags($program->excerpt) }}</p>
                        @elseif($program->description)
                            <p class="text-lg md:text-xl text-gray-600 leading-relaxed">{{ Str::limit(strip_tags($program->description), 200) }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Program Details -->
    <section class="section bg-white">
        <div class="container max-w-7xl">
            <div class="grid lg:grid-cols-3 gap-6 lg:gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2 animate-on-scroll space-y-8">
                    <!-- Program Image (if available) -->
                    @if($program->image)
                        @php
                            $imageUrl = str_starts_with($program->image, 'http') 
                                ? $program->image 
                                : asset('storage/' . $program->image);
                        @endphp
                        <div class="rounded-3xl overflow-hidden shadow-2xl border-4 border-white">
                            <img src="{{ $imageUrl }}" 
                                 alt="{{ $program->title }}" 
                                 class="w-full h-64 md:h-96 lg:h-[500px] object-cover"
                                 onerror="this.onerror=null; this.style.display='none';">
                        </div>
                    @endif

                    <!-- Description Section -->
                    <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 lg:p-10 border border-gray-100">
                        <h2 class="text-2xl md:text-3xl font-bold text-primary-900 mb-6 flex items-center gap-3">
                            <div class="w-1 h-8 bg-gradient-to-b from-accent-400 to-accent-600 rounded-full"></div>
                            Program Overview
                        </h2>
                        
                        <!-- Description (from CKEditor) -->
                        @if($program->description)
                            <div class="ckeditor-content text-gray-700 leading-relaxed mb-8">
                                {!! $program->description !!}
                            </div>
                        @endif

                        <!-- Full Content (from CKEditor) -->
                        @if($program->content)
                            <div class="ckeditor-content text-gray-700 leading-relaxed mb-8">
                                {!! $program->content !!}
                            </div>
                        @endif
                    </div>

                    <!-- Features Section -->
                    @if($program->features && count($program->features) > 0)
                        <div class="bg-gradient-to-br from-primary-50 to-accent-50/30 rounded-2xl shadow-lg p-6 md:p-8 lg:p-10 border border-primary-100">
                            <h3 class="text-xl md:text-2xl font-bold text-primary-900 mb-6 flex items-center gap-3">
                                <div class="w-12 h-12 bg-gradient-to-br from-accent-400 to-accent-600 rounded-xl flex items-center justify-center shadow-lg">
                                    <i class="fas fa-check-circle text-white text-xl"></i>
                                </div>
                                What You'll Learn
                            </h3>
                            <div class="grid md:grid-cols-2 gap-4">
                                @foreach($program->features as $feature)
                                    <div class="flex items-start gap-3 p-4 bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow">
                                        <i class="fas fa-check-circle text-accent-500 text-lg mt-0.5 flex-shrink-0"></i>
                                        <span class="text-gray-700 leading-relaxed">{{ $feature }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Program Details Meta -->
                    @if($program->meta)
                        <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 lg:p-10 border border-gray-100">
                            <h3 class="text-xl md:text-2xl font-bold text-primary-900 mb-6 flex items-center gap-3">
                                <div class="w-12 h-12 bg-gradient-to-br from-primary-600 to-primary-800 rounded-xl flex items-center justify-center shadow-lg">
                                    <i class="fas fa-info-circle text-white text-xl"></i>
                                </div>
                                Program Details
                            </h3>
                            <div class="grid md:grid-cols-2 gap-4">
                                @if(isset($program->meta['duration']))
                                    <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl">
                                        <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-clock text-primary-600 text-lg"></i>
                                        </div>
                                        <div>
                                            <div class="text-sm text-gray-500 font-medium">Duration</div>
                                            <div class="text-lg font-semibold text-primary-900">{{ $program->meta['duration'] }}</div>
                                        </div>
                                    </div>
                                @endif
                                @if(isset($program->meta['sessions']))
                                    <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl">
                                        <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-users text-primary-600 text-lg"></i>
                                        </div>
                                        <div>
                                            <div class="text-sm text-gray-500 font-medium">Sessions</div>
                                            <div class="text-lg font-semibold text-primary-900">{{ $program->meta['sessions'] }}</div>
                                        </div>
                                    </div>
                                @endif
                                @if(isset($program->meta['format']))
                                    <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl">
                                        <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-laptop text-primary-600 text-lg"></i>
                                        </div>
                                        <div>
                                            <div class="text-sm text-gray-500 font-medium">Format</div>
                                            <div class="text-lg font-semibold text-primary-900">{{ $program->meta['format'] }}</div>
                                        </div>
                                    </div>
                                @endif
                                @if(isset($program->meta['certificate']))
                                    <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-xl">
                                        <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-certificate text-primary-600 text-lg"></i>
                                        </div>
                                        <div>
                                            <div class="text-sm text-gray-500 font-medium">Certificate</div>
                                            <div class="text-lg font-semibold text-primary-900">{{ $program->meta['certificate'] }}</div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <div class="sticky top-6 space-y-6">
                        <!-- Pricing Card -->
                        <div class="bg-gradient-to-br from-primary-900 via-primary-800 to-primary-900 rounded-2xl shadow-2xl p-6 md:p-8 text-white border-4 border-accent-500/30 animate-on-scroll">
                            @if($program->price)
                                <div class="text-center mb-6">
                                    <div class="text-sm text-primary-200 mb-2">Investment</div>
                                    <div class="text-4xl md:text-5xl font-bold mb-1">
                                        {{ $program->currency ?? 'KES' }} {{ number_format($program->price) }}
                                    </div>
                                </div>
                            @else
                                <div class="text-center mb-6">
                                    <div class="text-2xl md:text-3xl font-bold">Contact for Pricing</div>
                                </div>
                            @endif
                            
                            <div class="space-y-4 mb-6 pb-6 border-b border-white/20">
                                @if($program->meta)
                                    @if(isset($program->meta['duration']))
                                        <div class="flex items-center gap-3 text-white/90">
                                            <i class="fas fa-clock text-accent-400"></i>
                                            <span>{{ $program->meta['duration'] }}</span>
                                        </div>
                                    @endif
                                    @if(isset($program->meta['sessions']))
                                        <div class="flex items-center gap-3 text-white/90">
                                            <i class="fas fa-users text-accent-400"></i>
                                            <span>{{ $program->meta['sessions'] }}</span>
                                        </div>
                                    @endif
                                    @if(isset($program->meta['certificate']))
                                        <div class="flex items-center gap-3 text-white/90">
                                            <i class="fas fa-certificate text-accent-400"></i>
                                            <span>{{ $program->meta['certificate'] }}</span>
                                        </div>
                                    @endif
                                @endif
                            </div>
                            
                            <button onclick="openEnrollModal()" class="w-full mb-3 px-6 py-4 bg-gradient-to-r from-accent-500 to-accent-600 text-primary-900 font-bold rounded-xl hover:from-accent-400 hover:to-accent-500 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl flex items-center justify-center gap-2">
                                <i class="fas fa-user-plus"></i>
                                <span>Enroll Now</span>
                            </button>
                            <button onclick="openRequestInfoModal()" class="w-full px-6 py-4 bg-white/10 backdrop-blur-sm text-white border-2 border-white/30 font-semibold rounded-xl hover:bg-white/20 transform hover:scale-105 transition-all duration-300 flex items-center justify-center gap-2">
                                <i class="fas fa-info-circle"></i>
                                <span>Request Info</span>
                            </button>
                        </div>

                        <!-- Quick Contact Card -->
                        <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 animate-on-scroll">
                            <h4 class="font-bold text-primary-900 mb-4 flex items-center gap-2">
                                <i class="fas fa-phone text-accent-500"></i>
                                Quick Contact
                            </h4>
                            <div class="space-y-3 text-sm">
                                <a href="tel:{{ \App\Models\Setting::get('phone', '+254722992111') }}" class="flex items-center gap-3 text-gray-700 hover:text-primary-600 transition-colors">
                                    <i class="fas fa-phone text-accent-500"></i>
                                    <span>{{ \App\Models\Setting::get('phone', '+254722992111') }}</span>
                                </a>
                                <a href="mailto:{{ $siteEmail }}" class="flex items-center gap-3 text-gray-700 hover:text-primary-600 transition-colors">
                                    <i class="fas fa-envelope text-accent-500"></i>
                                    <span class="break-all">{{ $siteEmail }}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section bg-gradient-to-r from-primary-900 via-primary-800 to-primary-950 text-white relative overflow-hidden">
        <!-- Decorative Background -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 right-0 w-96 h-96 bg-accent-500 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-accent-500 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2"></div>
        </div>
        
        <div class="container text-center relative z-10">
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-4">Ready to Get Started?</h2>
            <p class="text-xl text-gray-200 mb-8 max-w-2xl mx-auto">
                Contact us today to learn more about this program or enroll now.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <button onclick="openEnrollModal()" class="btn btn-accent btn-large shadow-lg hover:shadow-xl transform hover:scale-105 transition-all">
                    <i class="fas fa-user-plus mr-2"></i> Enroll Now
                </button>
                <a href="{{ route('programs.index') }}" class="btn bg-white text-primary-900 hover:bg-gray-100 btn-large shadow-lg hover:shadow-xl transform hover:scale-105 transition-all">
                    <i class="fas fa-list mr-2"></i> View All Programs
                </a>
            </div>
        </div>
    </section>

    <!-- Enroll Now Modal -->
    <div id="enrollModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 backdrop-blur-sm p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full transform transition-all animate-modal-in">
            <div class="p-6 border-b border-gray-200 flex items-center justify-between">
                <h3 class="text-2xl font-bold text-primary-900">Enroll Now</h3>
                <button onclick="closeEnrollModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <form id="enrollForm" action="{{ route('contact') }}" method="POST" class="p-6 space-y-4">
                @csrf
                <input type="hidden" name="subject" value="Enrollment Request: {{ $program->title }}">
                <input type="hidden" name="program" value="{{ $program->title }}">
                
                @if(session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-4">
                        <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                    </div>
                @endif
                
                <div>
                    <label for="enroll_name" class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                    <input type="text" id="enroll_name" name="name" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                </div>
                
                <div>
                    <label for="enroll_email" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                    <input type="email" id="enroll_email" name="email" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                </div>
                
                <div>
                    <label for="enroll_phone" class="block text-sm font-medium text-gray-700 mb-2">Phone *</label>
                    <input type="tel" id="enroll_phone" name="phone" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                </div>
                
                <div>
                    <label for="enroll_message" class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                    <textarea id="enroll_message" name="message" rows="4"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                              placeholder="I would like to enroll in {{ $program->title }}...">I would like to enroll in {{ $program->title }}.</textarea>
                </div>
                
                <div class="flex gap-3 pt-4">
                    <button type="submit" class="flex-1 btn btn-primary">
                        <i class="fas fa-paper-plane mr-2"></i> Send Request
                    </button>
                    <button type="button" onclick="closeEnrollModal()" class="px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Request Info Modal -->
    <div id="requestInfoModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 backdrop-blur-sm p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full transform transition-all animate-modal-in">
            <div class="p-6 border-b border-gray-200 flex items-center justify-between">
                <h3 class="text-2xl font-bold text-primary-900">Request Information</h3>
                <button onclick="closeRequestInfoModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <form id="requestInfoForm" action="{{ route('contact') }}" method="POST" class="p-6 space-y-4">
                @csrf
                <input type="hidden" name="subject" value="Information Request: {{ $program->title }}">
                <input type="hidden" name="program" value="{{ $program->title }}">
                
                @if(session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-4">
                        <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                    </div>
                @endif
                
                <div>
                    <label for="info_name" class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                    <input type="text" id="info_name" name="name" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                </div>
                
                <div>
                    <label for="info_email" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                    <input type="email" id="info_email" name="email" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                </div>
                
                <div>
                    <label for="info_phone" class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                    <input type="tel" id="info_phone" name="phone"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                </div>
                
                <div>
                    <label for="info_message" class="block text-sm font-medium text-gray-700 mb-2">What information would you like? *</label>
                    <textarea id="info_message" name="message" rows="4" required
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"
                              placeholder="I would like more information about {{ $program->title }}..."></textarea>
                </div>
                
                <div class="flex gap-3 pt-4">
                    <button type="submit" class="flex-1 btn btn-primary">
                        <i class="fas fa-paper-plane mr-2"></i> Send Request
                    </button>
                    <button type="button" onclick="closeRequestInfoModal()" class="px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('styles')
<style>
    @keyframes modal-in {
        from {
            opacity: 0;
            transform: scale(0.9) translateY(-20px);
        }
        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }
    
    .animate-modal-in {
        animation: modal-in 0.3s ease-out;
    }
    
    #enrollModal,
    #requestInfoModal {
        display: none;
    }
    
    #enrollModal.show,
    #requestInfoModal.show {
        display: flex !important;
    }
    
    /* Ensure modals are scrollable on mobile */
    @media (max-height: 600px) {
        #enrollModal.show > div,
        #requestInfoModal.show > div {
            max-height: 90vh;
            overflow-y: auto;
        }
    }
    
    /* Breadcrumb scrollbar hide */
    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
</style>
@endpush

@push('scripts')
<script>
    function openEnrollModal() {
        document.getElementById('enrollModal').classList.add('show');
        document.body.style.overflow = 'hidden';
    }
    
    function closeEnrollModal() {
        document.getElementById('enrollModal').classList.remove('show');
        document.body.style.overflow = '';
    }
    
    function openRequestInfoModal() {
        document.getElementById('requestInfoModal').classList.add('show');
        document.body.style.overflow = 'hidden';
    }
    
    function closeRequestInfoModal() {
        document.getElementById('requestInfoModal').classList.remove('show');
        document.body.style.overflow = '';
    }
    
    // Close modals on backdrop click
    document.getElementById('enrollModal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeEnrollModal();
        }
    });
    
    document.getElementById('requestInfoModal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeRequestInfoModal();
        }
    });
    
    // Close modals on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeEnrollModal();
            closeRequestInfoModal();
        }
    });
    
    // Handle form submissions
    document.getElementById('enrollForm')?.addEventListener('submit', function(e) {
        // Form will submit normally, modal will close on redirect
    });
    
    document.getElementById('requestInfoForm')?.addEventListener('submit', function(e) {
        // Form will submit normally, modal will close on redirect
    });
    
    // Close modal if success message is shown
    @if(session('success'))
        setTimeout(function() {
            closeEnrollModal();
            closeRequestInfoModal();
        }, 3000);
    @endif
    
    // Scroll animations
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

    document.querySelectorAll('.animate-on-scroll').forEach(el => {
        observer.observe(el);
    });
</script>
@endpush
