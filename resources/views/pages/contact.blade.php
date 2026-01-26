@extends('layouts.app')

@section('title', 'Contact Us')
@section('description', 'Get in touch with DLC. Contact us for consultations, program inquiries, or general questions.')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-primary-50 to-white py-20 lg:py-24">
        <div class="container text-center">
            <h1 class="text-4xl lg:text-5xl font-bold text-primary-900 mb-4">Get In Touch</h1>
            <p class="text-xl text-gray-600">We're here to help you start your transformation journey</p>
        </div>
    </section>

    <!-- Contact Form & Info -->
    <section class="section">
        <div class="container max-w-6xl">
            <div class="grid lg:grid-cols-2 gap-12">
                <!-- Contact Form -->
                <div class="card animate-on-scroll">
                    <h2 class="text-2xl font-bold text-primary-900 mb-6">Send Us a Message</h2>
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
                        
                        <button type="submit" class="btn btn-accent w-full">Send Message</button>
                    </form>
                </div>
                
                <!-- Contact Info -->
                <div class="space-y-6 animate-on-scroll">
                    <div class="card">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-primary-600 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-envelope text-white"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-primary-900 mb-1">Email Us</h3>
                                <p class="text-gray-600">info@dlc.co.ke</p>
                                <p class="text-gray-600">support@dlc.co.ke</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-primary-600 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-phone text-white"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-primary-900 mb-1">Call Us</h3>
                                <p class="text-gray-600">+254 722 992 111</p>
                                <p class="text-gray-600">Mon - Fri: 9:00 AM - 6:00 PM</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-primary-600 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-map-marker-alt text-white"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-primary-900 mb-1">Visit Us</h3>
                                <p class="text-gray-600">Nairobi, Kenya</p>
                                <p class="text-gray-600">By appointment only</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-primary-600 rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-clock text-white"></i>
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
                        ['q' => 'How do I get started?', 'a' => 'Simply fill out the contact form above or call us to schedule a free consultation. We\'ll discuss your goals and recommend the best program for you.'],
                        ['q' => 'What is included in the coaching programs?', 'a' => 'Each program includes one-on-one sessions, personalized action plans, progress tracking, and ongoing support. Specific details vary by program.'],
                        ['q' => 'Do you offer online coaching?', 'a' => 'Yes, we offer both in-person and online coaching sessions to accommodate your preferences and location.'],
                        ['q' => 'Are your certifications recognized?', 'a' => 'Yes, our certification programs are accredited by leading coaching organizations including ICF (International Coach Federation).'],
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
</script>
@endpush

