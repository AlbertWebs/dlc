@extends('layouts.app')

@php
    $pageTitle = 'Life Mastery Bootcamp – ' . config('app.name');
    $pageDescription = 'An intensive, transformative program designed to unlock your full potential and master every area of your life. Join hundreds of successful graduates.';
@endphp

@section('content')
    <!-- Breadcrumb -->
    <x-breadcrumb :items="[
        ['label' => 'Home', 'url' => route('home')],
        ['label' => 'Life Mastery Bootcamp', 'url' => route('life-mastery-bootcamp')]
    ]" />

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-primary-600 via-primary-700 to-primary-800 text-white py-16 lg:py-20 overflow-hidden">
        <div class="container mx-auto px-4 text-center relative z-10">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4 leading-tight">
                Life Mastery <span class="text-accent-400 italic">Bootcamp</span>
            </h1>
            <p class="text-xl text-gray-100 max-w-2xl mx-auto leading-relaxed">
                An intensive, transformative program designed to unlock your full potential and master every area of your life. Join hundreds of successful graduates who have transformed their lives.
            </p>
        </div>
    </section>

    <!-- Content Section -->
    <section class="section">
        <div class="container max-w-4xl">
            <div class="prose prose-lg max-w-none">
                <p class="text-lg text-gray-700 mb-6">
                    The Life Mastery Bootcamp is a comprehensive intensive program that combines proven coaching methodologies, practical exercises, and personalized guidance to help you achieve mastery in all areas of your life.
                </p>
                <p class="text-lg text-gray-700 mb-8">
                    This bootcamp is designed for individuals who are serious about creating lasting change. Whether you want to improve your career, relationships, health, finances, or overall life satisfaction, this program provides the tools and support you need to succeed.
                </p>
            </div>
            
            <div class="mt-8 text-center">
                <a href="{{ route('contact') }}?program=Life Mastery Bootcamp" class="btn btn-accent btn-large">
                    <i class="fas fa-user-plus mr-2"></i> Register Now
                </a>
            </div>
        </div>
    </section>
@endsection
