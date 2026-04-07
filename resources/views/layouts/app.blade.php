<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="theme-color" content="#BC430D">

  <!-- SEO Meta Tags -->
  <meta name="description" content="@yield('meta_description', 'Seven Coffee - Nikmati pengalaman kopi terbaik dengan cita rasa autentik dari biji pilihan. Temukan berbagai varian kopi spesialti kami.')">

  <title>@yield('title', config('app.name', 'Seven Coffee'))</title>

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="/logo.ico">

  <!-- Preconnect Google Fonts Start-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,100..900;1,100..900&family=Playfair+Display:wght@400..900&display=swap"
    rel="stylesheet">
  <!-- Preconnect Google Fonts End-->

  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <!-- CSS per halaman -->
  @stack('styles')
</head>

<body class="font-sans antialiased">
  <div class="min-h-screen bg-gray-100 dark:bg-gray-900">

    {{-- Navbar --}}
    @include('layouts.navigation')

    {{-- Content --}}
    <main>
      @yield('content')
    </main>

    {{-- Footer --}}
    <x-footer />
  </div>

  <!-- JS tambahan per halaman -->
  @stack('scripts')

</body>

</html>






{{-- SEO (optimization) --}}
{{-- <div>
  <!DOCTYPE html>
  <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#BC430D">

    <!-- SEO Meta Tags -->
    <meta name="description" content="@yield('meta_description', 'Seven Coffee - Nikmati pengalaman kopi terbaik dengan cita rasa autentik dari biji pilihan. Temukan berbagai varian kopi spesialti kami.')">
    <meta name="keywords" content="@yield('meta_keywords', 'kopi, coffee, seven coffee, kopi spesialti, coffee shop, kopi indonesia, biji kopi, roasted coffee')">
    <meta name="author" content="Seven Coffee">
    <meta name="robots" content="index, follow">
    <meta name="googlebot" content="index, follow">
    <meta name="language" content="Indonesian">

    <!-- Canonical URL -->
    <link rel="canonical" href="@yield('canonical_url', url()->current())">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="@yield('og_url', url()->current())">
    <meta property="og:title" content="@yield('og_title', config('app.name', 'Seven Coffee'))">
    <meta property="og:description" content="@yield('og_description', 'Seven Coffee - Nikmati pengalaman kopi terbaik dengan cita rasa autentik dari biji pilihan.')">
    <meta property="og:image" content="@yield('og_image', asset('images/og-image.jpg'))">
    <meta property="og:site_name" content="{{ config('app.name', 'Seven Coffee') }}">
    <meta property="og:locale" content="id_ID">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="@yield('twitter_url', url()->current())">
    <meta name="twitter:title" content="@yield('twitter_title', config('app.name', 'Seven Coffee'))">
    <meta name="twitter:description" content="@yield('twitter_description', 'Seven Coffee - Nikmati pengalaman kopi terbaik dengan cita rasa autentik dari biji pilihan.')">
    <meta name="twitter:image" content="@yield('twitter_image', asset('images/og-image.jpg'))">

    <!-- Favicon dan Icons -->
    <link rel="icon" type="image/x-icon" href="/logo.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    <!-- Preconnect untuk meningkatkan performa -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://images.unsplash.com">

    <!-- Structured Data / JSON-LD -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "{{ config('app.name', 'Seven Coffee') }}",
      "url": "{{ url('/') }}",
      "logo": "{{ asset('logo.png') }}",
      "description": "Seven Coffee - Nikmati pengalaman kopi terbaik dengan cita rasa autentik dari biji pilihan.",
      "sameAs": [
        "https://www.instagram.com/sevencoffee",
        "https://www.facebook.com/sevencoffee",
        "https://twitter.com/sevencoffee"
      ],
      "address": {
        "@type": "PostalAddress",
        "addressLocality": "Jakarta",
        "addressRegion": "DKI Jakarta",
        "addressCountry": "ID"
      },
      "contactPoint": {
        "@type": "ContactPoint",
        "telephone": "+62 812 3456 7890",
        "contactType": "customer service",
        "availableLanguage": ["Indonesian", "English"]
      }
    }
  </script>

    <!-- Additional SEO Meta Tags -->
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

    <title>@yield('title', config('app.name', 'Seven Coffee'))</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Additional CSS for performance -->
    @stack('styles')
  </head>

  <body class="font-sans antialiased">
    <!-- Skip to main content link untuk aksesibilitas -->
    <a href="#main-content"
      class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 bg-orange-600 text-white px-4 py-2 rounded-md z-50">
      Skip to main content
    </a>

    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
      @include('layouts.navigation')

      <!-- Page Content -->
      <main id="main-content">
        @yield('content')
      </main>

      <!-- Footer -->
      <x-footer />
    </div>

    <!-- Scripts -->
    @stack('scripts')
  </body>

  </html>
</div> --}}