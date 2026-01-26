@extends('layouts.app')

@section('title', 'Become a Coach')
@section('description', 'Become a certified life coach with DLC\'s comprehensive certification program. Transform lives and build a rewarding coaching career.')

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
                            <span class="text-gray-700">ICF accreditation preparation and requirements</span>
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
                        <div class="text-4xl font-bold text-primary-600 mb-6">KES 120,000</div>
                        <div class="space-y-4 mb-6">
                            <div class="flex items-center gap-3 text-gray-700">
                                <i class="fas fa-clock text-accent-500"></i>
                                <span>6 Months Duration</span>
                            </div>
                            <div class="flex items-center gap-3 text-gray-700">
                                <i class="fas fa-certificate text-accent-500"></i>
                                <span>ICF Accredited</span>
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
                                <i class="fas fa-headset text-accent-500"></i>
                                <span>Ongoing Support</span>
                            </div>
                        </div>
                        <a href="{{ route('contact') }}" class="btn btn-accent w-full mb-3">Apply Now</a>
                        <a href="{{ route('contact') }}" class="btn btn-secondary w-full">Request Info</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="section bg-gray-50">
        <div class="container">
            <div class="text-center mb-12 animate-on-scroll">
                <span class="text-accent-600 font-semibold text-sm uppercase tracking-wider">Success Stories</span>
                <h2 class="text-3xl lg:text-4xl font-bold text-primary-900 mt-2 mb-4">Hear From Our Certified Coaches</h2>
            </div>
            <div class="grid md:grid-cols-2 gap-8">
                @for($i = 0; $i < 2; $i++)
                    <div class="card animate-on-scroll">
                        <div class="text-accent-500 text-4xl mb-4 opacity-30">
                            <i class="fas fa-quote-left"></i>
                        </div>
                        <p class="text-gray-700 italic mb-6 leading-relaxed">
                            "The certification program gave me everything I needed to start my coaching practice. The mentorship was invaluable, and I'm now running a successful coaching business."
                        </p>
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-primary-600 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-white"></i>
                            </div>
                            <div>
                                <div class="font-bold text-primary-900">Amina Hassan</div>
                                <div class="text-sm text-gray-600">Certified Life Coach</div>
                            </div>
                        </div>
                    </div>
                @endfor
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
                <a href="{{ route('contact') }}" class="btn btn-accent btn-large">Apply Now</a>
                <a href="{{ route('contact') }}" class="btn bg-white text-primary-900 hover:bg-gray-100 btn-large">Request More Info</a>
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

