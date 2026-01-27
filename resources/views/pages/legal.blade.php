@extends('layouts.app')

@php
    $pageTitle = $page->meta_title ?? $page->title . ' | ' . config('app.name');
    $pageDescription = $page->meta_description ?? 'Read our ' . strtolower($page->title);
    $pageKeywords = $page->type === 'privacy' ? 'privacy policy, data protection, privacy' : 'terms of service, terms and conditions, legal terms';
    $pageImage = asset('images/og-image.jpg');
    $pageType = 'website';
@endphp

@section('content')
    <!-- Breadcrumb -->
    <x-breadcrumb :items="[
        ['label' => 'Home', 'url' => route('home')],
        ['label' => $page->title, 'url' => route('legal.show', $page->slug)]
    ]" />

    <!-- Legal Page Content -->
    <section class="section py-12 lg:py-16">
        <div class="container max-w-4xl">
            <div class="bg-white rounded-2xl shadow-lg p-8 lg:p-12">
                <div class="mb-8">
                    <h1 class="text-4xl lg:text-5xl font-bold text-primary-900 mb-4">{{ $page->title }}</h1>
                    <div class="flex items-center gap-4 text-sm text-gray-600">
                        <span class="px-3 py-1 bg-primary-100 text-primary-800 rounded-full font-semibold">
                            {{ ucfirst($page->type) }}
                        </span>
                        <span>Last updated: {{ $page->updated_at->format('F d, Y') }}</span>
                    </div>
                </div>

                <div class="prose prose-lg max-w-none">
                    {!! $page->content !!}
                </div>

                <div class="mt-12 pt-8 border-t border-gray-200">
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('home') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left mr-2"></i> Back to Home
                        </a>
                        @if($page->type === 'privacy')
                            @php
                                $termsPage = \App\Models\LegalPage::where('type', 'terms')->where('is_published', true)->first();
                            @endphp
                            @if($termsPage)
                                <a href="{{ route('legal.show', $termsPage->slug) }}" class="btn btn-primary">
                                    View Terms of Service <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            @endif
                        @else
                            @php
                                $privacyPage = \App\Models\LegalPage::where('type', 'privacy')->where('is_published', true)->first();
                            @endphp
                            @if($privacyPage)
                                <a href="{{ route('legal.show', $privacyPage->slug) }}" class="btn btn-primary">
                                    View Privacy Policy <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
    .prose {
        color: #374151;
    }
    .prose h2 {
        color: #1e3a8a;
        font-size: 1.875rem;
        font-weight: 700;
        margin-top: 2rem;
        margin-bottom: 1rem;
    }
    .prose h3 {
        color: #1e40af;
        font-size: 1.5rem;
        font-weight: 600;
        margin-top: 1.5rem;
        margin-bottom: 0.75rem;
    }
    .prose p {
        margin-bottom: 1rem;
        line-height: 1.75;
    }
    .prose ul, .prose ol {
        margin-bottom: 1rem;
        padding-left: 1.5rem;
    }
    .prose li {
        margin-bottom: 0.5rem;
    }
    .prose strong {
        color: #1e3a8a;
        font-weight: 600;
    }
    .prose a {
        color: #3b82f6;
        text-decoration: underline;
    }
    .prose a:hover {
        color: #2563eb;
    }
</style>
@endpush
