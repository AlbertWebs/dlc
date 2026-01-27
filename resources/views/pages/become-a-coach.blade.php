@extends('layouts.app')

@php
    $pageTitle = 'Become a Certified Life Coach in Kenya | ICR Accredited Training Program – DLC Kenya';
    $pageDescription = 'Become a certified life coach with DLC\'s comprehensive ICR-accredited certification program. Ksh 90,000 for 6 months of training with lifetime access to our online platform. Transform lives and build a rewarding coaching career.';
    $pageKeywords = 'become a life coach, life coach certification Kenya, ICR accredited coach training, certified life coach program, coach training course, professional coaching certification, life coach certification cost Kenya, coaching school Kenya';
    $pageImage = asset('images/og-image.jpg');
    $pageType = 'website';
@endphp

@push('schema')
@php
    $becomeCoachSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'Course',
        'name' => 'Certified Life Coach Certification Program',
        'description' => 'Comprehensive 6-month ICR-accredited life coach certification program in Kenya. Includes 60+ training hours, mentorship, and lifetime access to online collaborative platform.',
        'provider' => [
            '@type' => 'EducationalOrganization',
            'name' => 'Destiny Life Coaching Kenya',
            'url' => config('app.url')
        ],
        'educationalCredentialAwarded' => 'ICR Accredited Life Coach Certification',
        'courseCode' => 'CLC-KE',
        'timeRequired' => 'P6M',
        'offers' => [
            '@type' => 'Offer',
            'price' => '90000',
            'priceCurrency' => 'KES',
            'availability' => 'https://schema.org/InStock',
            'url' => url('/become-a-coach')
        ],
        'aggregateRating' => [
            '@type' => 'AggregateRating',
            'ratingValue' => '4.8',
            'reviewCount' => '150'
        ]
    ];
@endphp
<script type="application/ld+json">
@verbatim
{!! json_encode($becomeCoachSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
@endverbatim
</script>
@endpush

@section('content')
    <!-- Breadcrumb -->
    <x-breadcrumb :items="[
        ['label' => 'Home', 'url' => route('home')],
        ['label' => 'Become a Coach', 'url' => route('become-a-coach')]
    ]" />

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-primary-50 to-white py-20 lg:py-24">
        <div class="container text-center">
            <h1 class="text-4xl lg:text-5xl font-bold text-primary-900 mb-4">Become a Certified Life Coach</h1>
            <p class="text-xl text-gray-600">Transform lives and build a rewarding career in professional coaching</p>
        </div>
    </section>

    <!-- Program Overview -->
    <section class="section">
        <div class="container max-w-6xl">
            <div class="text-center mb-12 animate-on-scroll">
                <span class="text-accent-600 font-semibold text-sm uppercase tracking-wider">Coach Certification Program</span>
                <h2 class="text-3xl lg:text-4xl font-bold text-primary-900 mt-2 mb-4">Start Your Journey as a Professional Coach</h2>
                <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                    Join our comprehensive certification program designed to equip you with the skills, knowledge, and credentials needed to become a successful professional life coach.
                </p>
            </div>

            <div class="grid lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 animate-on-scroll">
                    <h3 class="text-2xl font-bold text-primary-900 mb-4">Why Become a Certified Coach?</h3>
                    <p class="text-gray-700 mb-6">Coaching is one of the fastest-growing professions globally. As a certified coach, you'll have the opportunity to:</p>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-start gap-3">
                            <i class="fas fa-check-circle text-accent-500 mt-1"></i>
                            <span class="text-gray-700">Make a meaningful impact on people's lives</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fas fa-check-circle text-accent-500 mt-1"></i>
                            <span class="text-gray-700">Build a flexible, rewarding career</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fas fa-check-circle text-accent-500 mt-1"></i>
                            <span class="text-gray-700">Work independently or with organizations</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fas fa-check-circle text-accent-500 mt-1"></i>
                            <span class="text-gray-700">Earn competitive income while helping others</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fas fa-check-circle text-accent-500 mt-1"></i>
                            <span class="text-gray-700">Join a growing community of professional coaches</span>
                        </li>
                    </ul>

                    <h3 class="text-2xl font-bold text-primary-900 mb-4 mt-8">What You'll Learn</h3>
                    <ul class="space-y-3 mb-8">
                        <li class="flex items-start gap-3">
                            <i class="fas fa-check text-accent-500 mt-1"></i>
                            <span class="text-gray-700">Core coaching competencies and methodologies</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fas fa-check text-accent-500 mt-1"></i>
                            <span class="text-gray-700">Effective communication and powerful questioning techniques</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fas fa-check text-accent-500 mt-1"></i>
                            <span class="text-gray-700">Coaching ethics and professional standards</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fas fa-check text-accent-500 mt-1"></i>
                            <span class="text-gray-700">Business development and marketing for coaches</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fas fa-check text-accent-500 mt-1"></i>
                            <span class="text-gray-700">Specialized coaching niches and approaches</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fas fa-check text-accent-500 mt-1"></i>
                            <span class="text-gray-700">Practice coaching sessions with expert feedback</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fas fa-check text-accent-500 mt-1"></i>
                            <span class="text-gray-700">ICR accreditation preparation and requirements</span>
                        </li>
                    </ul>

                    <h3 class="text-2xl font-bold text-primary-900 mb-4 mt-8">Program Structure</h3>
                    <p class="text-gray-700 mb-4">Our comprehensive certification program includes:</p>
                    <ul class="space-y-2 mb-8">
                        <li class="text-gray-700"><strong>60+ Hours of Training:</strong> Intensive workshops and interactive sessions</li>
                        <li class="text-gray-700"><strong>Supervised Practice:</strong> Real coaching sessions with mentor feedback</li>
                        <li class="text-gray-700"><strong>Written Assessments:</strong> Comprehensive evaluations of your knowledge</li>
                        <li class="text-gray-700"><strong>Mentorship:</strong> One-on-one guidance from experienced coaches</li>
                        <li class="text-gray-700"><strong>Business Development:</strong> Strategies to launch your coaching practice</li>
                        <li class="text-gray-700"><strong>Ongoing Support:</strong> Continued resources and community access</li>
                    </ul>
                </div>

                <div class="lg:col-span-1">
                    <div class="card bg-gray-50 sticky top-24 animate-on-scroll">
                        <div class="text-4xl font-bold text-primary-600 mb-6">Ksh 90,000</div>
                        <div class="space-y-4 mb-6">
                            <div class="flex items-center gap-3 text-gray-700">
                                <i class="fas fa-clock text-accent-500"></i>
                                <span>6 Months Duration</span>
                            </div>
                            <div class="flex items-center gap-3 text-gray-700">
                                <i class="fas fa-certificate text-accent-500"></i>
                                <span>ICR Accredited</span>
                            </div>
                            <div class="flex items-center gap-3 text-gray-700">
                                <i class="fas fa-users text-accent-500"></i>
                                <span>60+ Training Hours</span>
                            </div>
                            <div class="flex items-center gap-3 text-gray-700">
                                <i class="fas fa-user-tie text-accent-500"></i>
                                <span>Mentorship Included</span>
                            </div>
                            <div class="flex items-center gap-3 text-gray-700">
                                <i class="fas fa-globe text-accent-500"></i>
                                <span>Lifetime access to our online collaborative platform</span>
                            </div>
                        </div>
                        <button onclick="openApplyModal()" class="btn btn-accent w-full mb-3">Apply Now</button>
                        <a href="{{ route('contact') }}" class="btn btn-secondary w-full">Request Info</a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- CTA Section -->
    <section class="section bg-gradient-to-r from-primary-900 to-primary-800 text-white">
        <div class="container text-center">
            <h2 class="text-3xl lg:text-4xl font-bold mb-4">Ready to Start Your Coaching Journey?</h2>
            <p class="text-xl text-gray-200 mb-8 max-w-2xl mx-auto">
                Take the first step towards becoming a certified professional coach. Contact us today to learn more or apply now.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <button onclick="openApplyModal()" class="btn btn-accent btn-large">Apply Now</button>
                <a href="{{ route('contact') }}" class="btn bg-white text-primary-900 hover:bg-gray-100 btn-large">Request More Info</a>
            </div>
        </div>
    </section>
    <!-- Google Reviews Section -->
    <x-google-reviews-section />



    <!-- Apply Now Modal -->
    <div id="applyModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 backdrop-blur-sm p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-lg w-full transform transition-all animate-modal-in">
            <div class="p-6 border-b border-gray-200 flex items-center justify-between">
                <div>
                    <h3 class="text-2xl font-bold text-primary-900">Apply for Coach Certification</h3>
                    <p class="text-sm text-gray-600 mt-1">Start your journey to become a certified life coach</p>
                </div>
                <button onclick="closeApplyModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <form id="applyForm" class="p-6 space-y-4">
                @csrf
                <input type="hidden" name="subject" value="Coach Certification Application">
                <input type="hidden" name="program" value="Become A Certified Life Coach">
                
                <!-- Success Message -->
                <div id="applySuccess" class="hidden bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-4">
                    <i class="fas fa-check-circle mr-2"></i>
                    <span>Thank you for your application! We will get back to you soon.</span>
                </div>
                
                <!-- Error Message -->
                <div id="applyError" class="hidden bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg mb-4">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    <span id="applyErrorText">Something went wrong. Please try again.</span>
                </div>
                
                <div>
                    <label for="apply_name" class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                    <input type="text" id="apply_name" name="name" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                </div>
                
                <div>
                    <label for="apply_email" class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                    <input type="email" id="apply_email" name="email" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                </div>
                
                <div>
                    <label for="apply_phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number *</label>
                    <input type="tel" id="apply_phone" name="phone" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                </div>
                
                <div>
                    <label for="apply_experience" class="block text-sm font-medium text-gray-700 mb-2">Coaching Experience</label>
                    <select id="apply_experience" name="experience"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                        <option value="">Select your experience level</option>
                        <option value="beginner">Beginner - No prior experience</option>
                        <option value="some">Some experience in helping others</option>
                        <option value="experienced">Experienced in coaching/mentoring</option>
                        <option value="professional">Professional coach seeking certification</option>
                    </select>
                </div>
                
                <div>
                    <label for="apply_message" class="block text-sm font-medium text-gray-700 mb-2">Why do you want to become a certified coach? *</label>
                    <textarea id="apply_message" name="message" rows="4" required
                              placeholder="Tell us about your motivation and goals..."
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent"></textarea>
                </div>
                
                <div class="flex items-center gap-2 pt-2">
                    <input type="checkbox" id="apply_consent" name="consent" required
                           class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                    <label for="apply_consent" class="text-sm text-gray-600">
                        I agree to be contacted about the certification program *
                    </label>
                </div>
                
                <div class="pt-4">
                    <button type="submit" id="applySubmitBtn" class="btn btn-accent w-full">
                        <span id="applySubmitText">Submit Application</span>
                        <span id="applySubmitSpinner" class="hidden">
                            <i class="fas fa-spinner fa-spin mr-2"></i>Submitting...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('styles')
<style>
    #applyModal {
        display: none;
    }
    
    #applyModal.show {
        display: flex;
    }
    
    @keyframes modal-in {
        from {
            opacity: 0;
            transform: scale(0.95) translateY(-20px);
        }
        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }
    
    .animate-modal-in {
        animation: modal-in 0.3s ease-out;
    }
</style>
@endpush

@push('scripts')
<script>
    // Modal Functions
    function openApplyModal() {
        document.getElementById('applyModal').classList.add('show');
        document.body.style.overflow = 'hidden';
        // Reset form
        document.getElementById('applyForm').reset();
        document.getElementById('applySuccess').classList.add('hidden');
        document.getElementById('applyError').classList.add('hidden');
    }
    
    function closeApplyModal() {
        document.getElementById('applyModal').classList.remove('show');
        document.body.style.overflow = '';
    }
    
    // Close modal on backdrop click
    document.getElementById('applyModal')?.addEventListener('click', function(e) {
        if (e.target === this) {
            closeApplyModal();
        }
    });
    
    // Close modal on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeApplyModal();
        }
    });
    
    // Handle AJAX form submission
    document.getElementById('applyForm')?.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const form = this;
        const submitBtn = document.getElementById('applySubmitBtn');
        const submitText = document.getElementById('applySubmitText');
        const submitSpinner = document.getElementById('applySubmitSpinner');
        const successDiv = document.getElementById('applySuccess');
        const errorDiv = document.getElementById('applyError');
        const errorText = document.getElementById('applyErrorText');
        
        // Hide previous messages
        successDiv.classList.add('hidden');
        errorDiv.classList.add('hidden');
        
        // Show loading state
        submitBtn.disabled = true;
        submitText.classList.add('hidden');
        submitSpinner.classList.remove('hidden');
        
        // Get form data
        const formData = new FormData(form);
        
        // Submit via AJAX
        fetch('{{ route("contact") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(data => {
                    throw new Error(data.message || 'Validation failed');
                });
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                // Show success message
                successDiv.classList.remove('hidden');
                form.reset();
                
                // Scroll to top of modal
                form.scrollIntoView({ behavior: 'smooth', block: 'start' });
                
                // Close modal after 3 seconds
                setTimeout(() => {
                    closeApplyModal();
                }, 3000);
            } else {
                // Show error message
                errorText.textContent = data.message || 'Something went wrong. Please try again.';
                errorDiv.classList.remove('hidden');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            errorText.textContent = 'Network error. Please check your connection and try again.';
            errorDiv.classList.remove('hidden');
        })
        .finally(() => {
            // Reset button state
            submitBtn.disabled = false;
            submitText.classList.remove('hidden');
            submitSpinner.classList.add('hidden');
        });
    });
    
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

