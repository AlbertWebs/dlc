@extends('layouts.app')

@php
    $pageTitle = 'My Account – ' . config('app.name');
    $pageDescription = 'Access your courses, certificates, and account information at Destiny Life Coaching Kenya.';
@endphp

@section('content')
    <!-- Breadcrumb -->
    <x-breadcrumb :items="[
        ['label' => 'Home', 'url' => route('home')],
        ['label' => 'My Account', 'url' => route('my-account')]
    ]" />

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-primary-600 via-primary-700 to-primary-800 text-white py-16 lg:py-20 overflow-hidden">
        <div class="container mx-auto px-4 text-center relative z-10">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4 leading-tight">
                My Account
            </h1>
            <p class="text-xl text-gray-100 max-w-2xl mx-auto leading-relaxed">
                Access your courses, certificates, and account information
            </p>
        </div>
    </section>

    <!-- Content Section -->
    <section class="section">
        <div class="container max-w-4xl">
            <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
                <p class="text-lg text-gray-700 mb-6 text-center">
                    Account features are coming soon. For now, please contact us for assistance with your account or course access.
                </p>
                <div class="text-center">
                    <a href="{{ route('contact') }}" class="btn btn-primary">
                        <i class="fas fa-envelope mr-2"></i> Contact Us
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
