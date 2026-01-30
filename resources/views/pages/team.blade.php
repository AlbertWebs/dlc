@extends('layouts.app')

@php
    $pageTitle = 'Our Team – ' . config('app.name');
    $pageDescription = 'Meet the dedicated team of certified coaches and professionals at Destiny Life Coaching Kenya.';
@endphp

@section('content')
    <!-- Breadcrumb -->
    <x-breadcrumb :items="[
        ['label' => 'Home', 'url' => route('home')],
        ['label' => 'About Us', 'url' => route('about')],
        ['label' => 'Our Team', 'url' => route('team')]
    ]" />

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-primary-600 via-primary-700 to-primary-800 text-white py-16 lg:py-20 overflow-hidden">
        <div class="container mx-auto px-4 text-center relative z-10">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4 leading-tight">
                Our <span class="text-accent-400 italic">Team</span>
            </h1>
            <p class="text-xl text-gray-100 max-w-2xl mx-auto leading-relaxed">
                Meet the dedicated team of certified coaches and professionals dedicated to your transformation
            </p>
        </div>
    </section>

    <!-- Team Members Section -->
    <section class="section">
        <div class="container max-w-7xl">
            @if($teamMembers->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($teamMembers as $member)
                        <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-all hover:-translate-y-2">
                            @if($member->photo)
                                <img src="{{ asset('storage/' . $member->photo) }}" 
                                     alt="{{ $member->name }}" 
                                     class="w-32 h-32 rounded-full mx-auto mb-4 object-cover border-4 border-accent-500/30">
                            @else
                                <div class="w-32 h-32 rounded-full mx-auto mb-4 bg-gradient-to-br from-primary-600 to-primary-800 flex items-center justify-center border-4 border-accent-500/30">
                                    <i class="fas fa-user text-white text-4xl"></i>
                                </div>
                            @endif
                            <h3 class="text-xl font-bold text-primary-900 text-center mb-2">{{ $member->name }}</h3>
                            @if($member->role)
                                <p class="text-accent-600 font-semibold text-center mb-4">{{ $member->role }}</p>
                            @endif
                            @if($member->bio)
                                <p class="text-gray-600 text-center text-sm leading-relaxed">{{ Str::limit($member->bio, 150) }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <p class="text-gray-600 text-lg">Team information will be displayed here.</p>
                    <a href="{{ route('about') }}" class="btn btn-primary mt-4">
                        <i class="fas fa-arrow-left mr-2"></i> Back to About Us
                    </a>
                </div>
            @endif
        </div>
    </section>
@endsection
