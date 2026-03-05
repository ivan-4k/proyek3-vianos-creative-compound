@props(['title' => config('app.name', 'Seven Coffee')])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ $title }}</title>
  <link rel="icon" type="image/x-icon" href="logo.ico">

  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
  {{-- navbar --}}
  @include('layouts.navigation')

  <div class="min-h-screen flex flex-col justify-center items-center py-1 bgauth">
    {{ $slot }}
  </div>
</body>

</html>
