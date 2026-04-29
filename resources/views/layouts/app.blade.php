<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="theme-color" content="#BC430D">

  <!-- SEO Meta Tags -->
  <meta name="description" content="@yield('meta_description', Cache::get('store_description', 'Seven Coffee - Nikmati pengalaman kopi terbaik dengan cita rasa autentik dari biji pilihan.'))">

  <title>@yield('title', Cache::get('store_name', config('app.name', 'Seven Coffee')))</title>

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{ asset(Cache::get('favicon', 'logo.ico')) }}">

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
  <div class="min-h-screen bg-gray-100 ">
    {{-- dark:bg-gray-900 --}}
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