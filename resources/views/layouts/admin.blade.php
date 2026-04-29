<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="antialiased">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ Cache::get('store_name', config('app.name', 'Laravel')) }} - Admin Dashboard</title>

  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

  @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/pages/admin/admin.js'])

  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

  <script>
    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia(
        '(prefers-color-scheme: dark)').matches)) {
      document.documentElement.classList.add('dark');
    } else {
      document.documentElement.classList.remove('dark')
    }
  </script>
</head>

<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white transition-colors duration-200 font-secondary">

  <div class="antialiased bg-gray-50 dark:bg-gray-900 transition-colors duration-200">
    @include('layouts.navigation-admin')
    @include('components.sidebar-admin')

    <main class="p-4 md:ml-64 h-auto pt-20">
      @if (session('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
          role="alert">
          {{ session('success') }}
        </div>
      @endif

      @if (session('error'))
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
          role="alert">
          {{ session('error') }}
        </div>
      @endif

      {{ $slot ?? '' }}
      @yield('content')
    </main>
  </div>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

  @stack('scripts')
</body>

</html>
