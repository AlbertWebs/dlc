@extends('layouts.app')

@php
    $pageTitle = 'Contact Us – Destiny Life Coaching Kenya | Get in Touch';
    $pageDescription = 'Get in touch with DLC Kenya. Contact us for consultations, program inquiries, or general questions. Call +254 722 992 111 or email info@dlc.co.ke. Located in Nairobi, Kenya.';
    $pageKeywords = 'contact DLC Kenya, life coaching contact, coaching consultation Kenya, DLC phone number, coaching inquiry, book coaching session';
    $pageImage = asset('images/og-image.jpg');
    $pageType = 'website';
@endphp

@push('schema')
@php
    $contactPageSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'ContactPage',
        'name' => $pageTitle,
        'description' => $pageDescription,
        'url' => url('/contact'),
        'inLanguage' => 'en-KE',
        'mainEntity' => [
            '@type' => 'Organization',
            'name' => 'Destiny Life Coaching Kenya',
            'contactPoint' => [
                '@type' => 'ContactPoint',
                'telephone' => '+254-722-992-111',
                'contactType' => 'Customer Service',
                'email' => \App\Models\Setting::get('email', 'info@dlc.co.ke'),
                'areaServed' => 'KE',
                'availableLanguage' => ['English']
            ],
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => 'Savelberg Retreat Center Muringa Rd',
                'addressLocality' => 'Nairobi',
                'addressRegion' => 'Nairobi',
                'addressCountry' => 'KE'
            ]
        ]
    ];
@endphp
<script type="application/ld+json">
@verbatim
{!! json_encode($contactPageSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
@endverbatim
</script>
@endpush

@section('content')
    <!-- Breadcrumb -->
    <x-breadcrumb :items="[
        ['label' => 'Home', 'url' => route('home')],
        ['label' => 'Contact Us', 'url' => route('contact')]
    ]" />

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-primary-600 via-primary-700 to-primary-800 text-white py-16 lg:py-20 overflow-hidden">
        <!-- Decorative Background -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 right-0 w-96 h-96 bg-accent-400 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-accent-500 rounded-full blur-3xl"></div>
        </div>
        
        <!-- Accent Border Top -->
        <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-transparent via-accent-400 to-transparent"></div>
        
        <div class="container mx-auto px-4 text-center relative z-10">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full mb-6 border border-white/20">
                <i class="fas fa-envelope text-accent-400"></i>
                <span class="text-sm font-semibold text-accent-300">Get In Touch</span>
            </div>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4 leading-tight">
                Let's Start Your <span class="text-accent-400 italic">Transformation</span>
            </h1>
            <p class="text-xl text-gray-100 max-w-2xl mx-auto leading-relaxed">
                We're here to help you start your transformation journey. Reach out and let's discuss how we can support your growth.
            </p>
        </div>
    </section>

    <!-- Contact Form & Info -->
    <section class="section">
        <div class="container max-w-6xl">
            <div class="grid lg:grid-cols-2 gap-12">
                <!-- Contact Form -->
                <div class="bg-white rounded-2xl shadow-xl p-8 border border-gray-100 animate-on-scroll hover:shadow-2xl transition-shadow">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-12 h-12 bg-gradient-to-br from-primary-600 to-primary-800 rounded-xl flex items-center justify-center shadow-lg">
                            <i class="fas fa-paper-plane text-white"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-primary-900">Send Us a Message</h2>
                    </div>
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
                            <ul class="list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('contact') }}" method="POST" class="space-y-6">
                        @csrf
                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Full Name *</label>
                            <input type="text" id="name" name="name" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                        </div>
                        
                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email Address *</label>
                            <input type="email" id="email" name="email" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                        </div>
                        
                        <div>
                            <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">Phone Number</label>
                            <input type="tel" id="phone" name="phone"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                        </div>
                        
                        <div>
                            <label for="subject" class="block text-sm font-semibold text-gray-700 mb-2">Subject *</label>
                            <select id="subject" name="subject" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                                <option value="">Select a subject</option>
                                <option value="consultation">Free Consultation</option>
                                <option value="program">Program Inquiry</option>
                                <option value="certification">Certification Program</option>
                                <option value="corporate">Corporate Coaching</option>
                                <option value="general">General Inquiry</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="message" class="block text-sm font-semibold text-gray-700 mb-2">Message *</label>
                            <textarea id="message" name="message" rows="5" required
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"></textarea>
                        </div>
                        
                        <button type="submit" class="w-full px-6 py-4 bg-gradient-to-r from-accent-500 to-accent-600 hover:from-accent-400 hover:to-accent-500 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 flex items-center justify-center gap-2">
                            <i class="fas fa-paper-plane"></i>
                            <span>Send Message</span>
                        </button>
                    </form>
                </div>
                
                <!-- Contact Info -->
                <div class="space-y-6 animate-on-scroll">
                    <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-all hover:-translate-y-1">
                        <div class="flex items-start gap-4">
                            <div class="w-14 h-14 bg-gradient-to-br from-primary-600 to-primary-800 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg">
                                <i class="fas fa-envelope text-white text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-primary-900 mb-1">Email Us</h3>
                                <p class="text-gray-600">info@dlc.co.ke</p>
                                <p class="text-gray-600">support@dlc.co.ke</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-all hover:-translate-y-1">
                        <div class="flex items-start gap-4">
                            <div class="w-14 h-14 bg-gradient-to-br from-accent-500 to-accent-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg">
                                <i class="fas fa-phone text-white text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-primary-900 mb-1">Call Us</h3>
                                <p class="text-gray-600">+254 722 992 111</p>
                                <p class="text-gray-600">Mon - Fri: 9:00 AM - 6:00 PM</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-all hover:-translate-y-1">
                        <div class="flex items-start gap-4">
                            <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg">
                                <i class="fas fa-map-marker-alt text-white text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-primary-900 mb-1">Visit Us</h3>
                                <p class="text-gray-600">Nairobi, Kenya</p>
                                <p class="text-gray-600">By appointment only</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-all hover:-translate-y-1">
                        <div class="flex items-start gap-4">
                            <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg">
                                <i class="fas fa-clock text-white text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-primary-900 mb-1">Office Hours</h3>
                                <p class="text-gray-600">Monday - Friday: 9:00 AM - 6:00 PM</p>
                                <p class="text-gray-600">Saturday: 10:00 AM - 2:00 PM</p>
                                <p class="text-gray-600">Sunday: Closed</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="section bg-gray-50">
        <div class="container max-w-4xl">
            <div class="text-center mb-12 animate-on-scroll">
                <span class="text-accent-600 font-semibold text-sm uppercase tracking-wider">Frequently Asked Questions</span>
                <h2 class="text-3xl lg:text-4xl font-bold text-primary-900 mt-2 mb-4">Have Questions?</h2>
            </div>
            <div class="space-y-4">
                @php
                    $faqs = [
                        ['q' => 'What is Destiny Life Coaching?', 'a' => 'Destiny Life Coaching is a transformational coaching service designed to help you clarify your purpose, shift limiting patterns, and step confidently into your next level of life and impact.'],
                        ['q' => 'Who do you coach?', 'a' => 'We work with individuals ready for breakthrough growth, high-achievers seeking clarity, professionals navigating life transitions, and anyone committed to leveling up their identity, results, and fulfillment.'],
                        ['q' => 'Is the coaching course globally accredited?', 'a' => 'Yes. Our coaching courses are accredited by recognized international coaching bodies, ensuring global standards and credibility so you can use your certification with confidence worldwide.'],
                        ['q' => 'What coaching styles do you use?', 'a' => 'Our coaching blends breakthrough intervention, strategic intervention tools, embodiment practices, and identity activation frameworks to create deep, lasting change.'],
                        ['q' => 'How long is a coaching session?', 'a' => 'Standard sessions are 60 minutes. Some specialized programs and immersion experiences may include longer or multiple session formats.'],
                        ['q' => 'Do you offer programs or only one-on-one coaching?', 'a' => 'We offer both tailored one-on-one coaching and structured programs designed for personal growth, leadership development, and destiny activation.'],
                        ['q' => 'What results can I expect?', 'a' => 'Clients commonly experience greater clarity of purpose, mindset shifts, breakthroughs in relationships or career, increased confidence, and a stronger sense of direction.'],
                        ['q' => 'Is coaching the same as therapy?', 'a' => 'No. Coaching is future-focused and action-oriented. It helps you create forward momentum, overcome obstacles, and achieve specific outcomes. It does not diagnose or treat mental health conditions.'],
                        ['q' => 'How do I know if coaching is right for me?', 'a' => 'If you are ready to take responsibility for your growth and want tangible results, coaching can be a powerful catalyst. You can also book a clarity call to explore fit before you commit.'],
                        ['q' => 'How do I book a session?', 'a' => 'Click the Book Now button or schedule through our Calendly links to select a time that works for you.'],
                        ['q' => 'What are your rates?', 'a' => 'Investment varies by program and coaching package. Contact us or book a clarity call for details tailored to your goals.'],
                        ['q' => 'Do you offer virtual coaching?', 'a' => 'Yes. Coaching is available online globally, making it easy to work with us from anywhere.'],
                        ['q' => 'What if I need to reschedule?', 'a' => 'Please refer to our session policies or contact support for assistance rescheduling your appointment.'],
                        ['q' => 'Can I get a refund if I change my mind?', 'a' => 'Refund policies depend on the program you purchase. Please review the specific terms or contact us for clarification.'],
                        ['q' => 'How is destiny coaching different?', 'a' => 'Destiny coaching focuses on uncovering your unique identity, aligning your life with your highest purpose, and activating your gifts for impact.'],
                        ['q' => 'I still have questions. Who can I contact?', 'a' => 'Reach out via our Contact Us page or email support and we\'ll be happy to assist.'],
                    ];
                @endphp
                @foreach($faqs as $faq)
                    <div class="card animate-on-scroll">
                        <h3 class="text-lg font-bold text-primary-900 mb-2">{{ $faq['q'] }}</h3>
                        <p class="text-gray-600">{{ $faq['a'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Google Reviews Section -->
    <x-google-reviews-section />
@endsection

@push('scripts')
<script>
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
    
    // Replace footer copyright text on contact page
    document.addEventListener('DOMContentLoaded', function() {
        // Find the copyright paragraph in the footer
        const copyrightSection = document.querySelector('.relative.bg-primary-950');
        if (copyrightSection) {
            const copyrightText = copyrightSection.querySelector('p.text-gray-400');
            if (copyrightText) {
                copyrightText.innerHTML = '&copy; 2026 DLC Kenya - Destiny Life Coaching. All rights reserved | Powered By <a href="https://designekta.com" target="_blank" rel="noopener noreferrer" class="text-accent-400 hover:text-accent-300 transition-colors underline">Designekta Studios</a>';
            }
        }
    });
</script>
@endpush

