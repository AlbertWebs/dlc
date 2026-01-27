<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" itemscope itemtype="https://schema.org/WebSite">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php
        $siteName = config('app.name', 'Kenya Life Coach Certification');
        $siteUrl = config('app.url', url('/'));
        $currentUrl = url()->current();
        
        // Support both variable assignment and @section directives
        $sectionTitle = trim(view()->yieldContent('title', ''));
        $sectionDescription = trim(view()->yieldContent('description', ''));
        
        $pageTitle = $pageTitle ?? (!empty($sectionTitle) ? $sectionTitle . ' – ' . $siteName : ($siteName . ' – Kenya\'s top life coaching school offering internationally certified training, breakthrough coaching, and online programs to help you become a powerful coach.'));
        $pageDescription = $pageDescription ?? (!empty($sectionDescription) ? $sectionDescription : 'Kenya\'s top life coaching school offering internationally certified training, breakthrough coaching, and online programs to help you become a powerful coach.');
        $pageImage = $pageImage ?? asset('images/og-image.jpg');
        $pageType = $pageType ?? 'website';
    @endphp

    <!-- Primary Meta Tags -->
    <title>{{ $pageTitle }}</title>
    <meta name="title" content="{{ $pageTitle }}">
    <meta name="description" content="{{ $pageDescription }}">
    <meta name="keywords" content="{{ $pageKeywords ?? 'life coaching, Kenya, coach certification, life coach training, professional coaching, breakthrough coaching, online coaching programs, coaching certification Kenya, ICR accredited, certified life coach Kenya, life coaching courses, professional development, personal transformation, mindset coaching, executive coaching, career coaching, relationship coaching, wellness coaching, coaching school Kenya' }}">
    <meta name="author" content="{{ $siteName }}">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="googlebot" content="index, follow">
    <meta name="bingbot" content="index, follow">
    <meta name="language" content="English">
    <meta name="revisit-after" content="7 days">
    <meta name="rating" content="general">
    <meta name="distribution" content="global">
    <meta name="geo.region" content="KE">
    <meta name="geo.placename" content="Kenya">
    <link rel="canonical" href="{{ $currentUrl }}">
    <link rel="sitemap" type="application/xml" href="{{ url('/sitemap.xml') }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="{{ $pageType }}">
    <meta property="og:url" content="{{ $currentUrl }}">
    <meta property="og:title" content="{{ $pageTitle }}">
    <meta property="og:description" content="{{ $pageDescription }}">
    <meta property="og:image" content="{{ $pageImage }}">
    <meta property="og:image:secure_url" content="{{ $pageImage }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="{{ $pageTitle }}">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:site_name" content="{{ $siteName }}">
    <meta property="og:locale" content="en_KE">
    <meta property="og:locale:alternate" content="en_US">
    @if(isset($pagePublishedTime))
    <meta property="article:published_time" content="{{ $pagePublishedTime }}">
    @endif
    @if(isset($pageModifiedTime))
    <meta property="article:modified_time" content="{{ $pageModifiedTime }}">
    @endif
    @if(isset($pageAuthor))
    <meta property="article:author" content="{{ $pageAuthor }}">
    @endif
    @if(isset($pageSection))
    <meta property="article:section" content="{{ $pageSection }}">
    @endif
    @if(isset($pageTags))
    @foreach($pageTags as $tag)
    <meta property="article:tag" content="{{ $tag }}">
    @endforeach
    @endif

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ $currentUrl }}">
    <meta name="twitter:title" content="{{ $pageTitle }}">
    <meta name="twitter:description" content="{{ $pageDescription }}">
    <meta name="twitter:image" content="{{ $pageImage }}">
    <meta name="twitter:image:alt" content="{{ $pageTitle }}">
    <meta name="twitter:site" content="@{{ config('app.social.twitter_handle', 'dlckenya') }}">
    <meta name="twitter:creator" content="@{{ config('app.social.twitter_handle', 'dlckenya') }}">

    <!-- Favicon -->
    @php
        $faviconFile = \App\Models\Setting::get('favicon_file', '');
        $faviconUrl = \App\Models\Setting::get('favicon_url', '');
        $favicon = $faviconFile ? asset('storage/' . $faviconFile) : ($faviconUrl ?: asset('favicon-32x32.png'));
    @endphp
    <link rel="icon" type="image/png" href="{{ $favicon }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ $favicon }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">

    <!-- DNS Prefetch & Preconnect for Performance -->
    <link rel="dns-prefetch" href="//fonts.googleapis.com">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="dns-prefetch" href="//cdnjs.cloudflare.com">
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Structured Data (JSON-LD) -->
    @php
        $socialLinks = [];
        $facebookUrl = \App\Models\Setting::get('social_facebook', '');
        $twitterUrl = \App\Models\Setting::get('social_twitter', '');
        $linkedinUrl = \App\Models\Setting::get('social_linkedin', '');
        $instagramUrl = \App\Models\Setting::get('social_instagram', '');
        $youtubeUrl = \App\Models\Setting::get('social_youtube', '');
        
        if ($facebookUrl) $socialLinks[] = $facebookUrl;
        if ($twitterUrl) $socialLinks[] = $twitterUrl;
        if ($linkedinUrl) $socialLinks[] = $linkedinUrl;
        if ($instagramUrl) $socialLinks[] = $instagramUrl;
        if ($youtubeUrl) $socialLinks[] = $youtubeUrl;
        
        $logoUrl = \App\Models\Setting::get('logo_url', '');
        $logoFile = \App\Models\Setting::get('logo_file', '');
        $logo = $logoFile ? asset('storage/' . $logoFile) : ($logoUrl ?: asset('images/logo.png'));
        
        $organizationSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'EducationalOrganization',
            'name' => $siteName,
            'alternateName' => 'DLC Kenya',
            'url' => $siteUrl,
            'logo' => $logo,
            'description' => $pageDescription,
            'foundingDate' => '2006',
            'address' => [
                '@type' => 'PostalAddress',
                'addressCountry' => 'KE',
                'addressLocality' => 'Nairobi',
                'addressRegion' => 'Nairobi',
                'streetAddress' => 'Savelberg Retreat Center Muringa Rd'
            ],
            'contactPoint' => [
                '@type' => 'ContactPoint',
                'telephone' => '+254-722-992-111',
                'contactType' => 'Customer Service',
                'email' => \App\Models\Setting::get('email', 'info@dlc.co.ke'),
                'areaServed' => 'KE',
                'availableLanguage' => ['English']
            ],
            'offers' => [
                '@type' => 'Offer',
                'category' => 'Educational Services',
                'priceCurrency' => 'KES'
            ],
            'areaServed' => [
                '@type' => 'Country',
                'name' => 'Kenya'
            ]
        ];
        if (!empty($socialLinks)) {
            $organizationSchema['sameAs'] = $socialLinks;
        }
    @endphp
    <script type="application/ld+json">
    @verbatim
    {!! json_encode($organizationSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    @endverbatim
    </script>

    @php
        $websiteSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'name' => $siteName,
            'url' => $siteUrl,
            'description' => $pageDescription,
            'inLanguage' => 'en-KE',
            'potentialAction' => [
                '@type' => 'SearchAction',
                'target' => [
                    '@type' => 'EntryPoint',
                    'urlTemplate' => $siteUrl . '/search?q={search_term_string}'
                ],
                'query-input' => 'required name=search_term_string'
            ]
        ];
    @endphp
    <script type="application/ld+json">
    @verbatim
    {!! json_encode($websiteSchema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    @endverbatim
    </script>
    
    <!-- Page-Specific Schema Data -->
    @stack('schema')

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="font-sans antialiased bg-white text-gray-900">
    <!-- Header -->
    <x-header />

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <x-footer />

    <!-- Mobile Bottom Navigation -->
    <x-mobile-bottom-nav />

    <!-- Scripts -->
    @stack('scripts')
</body>
</html>

