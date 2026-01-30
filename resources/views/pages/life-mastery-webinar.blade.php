@extends('layouts.app')

@php
    $pageTitle = 'Life Mastery Webinar – ' . config('app.name');
    $pageDescription = 'Powerful strategies for personal and professional growth in an interactive online session. Join our Life Mastery Webinar.';
@endphp

@section('content')
    <!-- Breadcrumb -->
    <x-breadcrumb :items="[
        ['label' => 'Home', 'url' => route('home')],
        ['label' => 'Life Mastery Webinar', 'url' => route('life-mastery-webinar')]
    ]" />

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-primary-600 via-primary-700 to-primary-800 text-white py-16 lg:py-20 overflow-hidden">
        <div class="container mx-auto px-4 text-center relative z-10">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4 leading-tight">
                Life Mastery <span class="text-accent-400 italic">Webinar</span>
            </h1>
            <p class="text-xl text-gray-100 max-w-2xl mx-auto leading-relaxed">
                Powerful strategies for personal and professional growth in an interactive online session.
            </p>
        </div>
    </section>

    <!-- Content Section -->
    <section class="section">
        <div class="container max-w-4xl">
            <div class="prose prose-lg max-w-none">
                <p class="text-lg text-gray-700 mb-6">
                    Join our Life Mastery Webinar for an interactive online session designed to help you unlock your potential and create lasting transformation in your personal and professional life.
                </p>
                <p class="text-lg text-gray-700 mb-8">
                    This webinar provides powerful strategies and insights that you can apply immediately to start seeing results in your life.
                </p>
            </div>
            
            <div class="mt-8 text-center">
                <a href="{{ route('contact') }}?program=Life Mastery Webinar" class="btn btn-accent btn-large">
                    <i class="fas fa-calendar mr-2"></i> Register Now
                </a>
            </div>
        </div>
    </section>
@endsection
