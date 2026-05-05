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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

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

  <style>
    .toast-item {
      display: flex;
      align-items: flex-start;
      gap: 12px;
      padding: 14px 18px;
      border-radius: 14px;
      min-width: 300px;
      max-width: 420px;
      font-size: 14px;
      font-weight: 500;
      color: #fff;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.20);
      pointer-events: all;
      transform: translateX(110%);
      opacity: 0;
      transition: transform 0.38s cubic-bezier(0.34, 1.56, 0.64, 1), opacity 0.3s ease;
      position: relative;
      overflow: hidden;
    }

    .toast-item.toast-visible {
      transform: translateX(0);
      opacity: 1;
    }

    .toast-item.toast-hide {
      transform: translateX(110%);
      opacity: 0;
      transition: transform 0.3s ease, opacity 0.3s ease;
    }

    .toast-success {
      background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    }

    .toast-error {
      background: linear-gradient(135deg, #f43f5e 0%, #e11d48 100%);
    }

    .toast-warning {
      background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    }

    .toast-info {
      background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    }

    .toast-icon {
      flex-shrink: 0;
      margin-top: 1px;
      font-size: 20px;
      /* Tambahan untuk menyamakan ukuran dengan SVG sebelumnya */
    }

    .toast-body {
      flex: 1;
      line-height: 1.45;
      word-break: break-word;
    }

    .toast-close {
      flex-shrink: 0;
      background: none;
      border: none;
      color: rgba(255, 255, 255, 0.7);
      cursor: pointer;
      padding: 0;
      line-height: 1;
      margin-left: 4px;
      transition: color 0.2s;
      margin-top: 1px;
      font-size: 18px;
      /* Ukuran ikon close */
    }

    .toast-close:hover {
      color: #fff;
    }

    .toast-progress {
      position: absolute;
      bottom: 0;
      left: 0;
      height: 3px;
      background: rgba(255, 255, 255, 0.4);
      border-radius: 0 0 14px 0;
    }
  </style>
</head>

<body class="bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-white transition-colors duration-200 font-secondary">

  {{-- GLOBAL TOAST CONTAINER (pojok kanan atas)  --}}
  <div id="toast-container"
    style="position:fixed;top:80px;right:20px;z-index:99999;display:flex;flex-direction:column;gap:10px;pointer-events:none;">
  </div>

  {{-- Flash session data untuk dipicu otomatis --}}
  @if (session('success'))
    <meta name="flash-success" content="{{ addslashes(session('success')) }}">
  @endif
  @if (session('error'))
    <meta name="flash-error" content="{{ addslashes(session('error')) }}">
  @endif
  @if (session('warning'))
    <meta name="flash-warning" content="{{ addslashes(session('warning')) }}">
  @endif
  @if (session('info'))
    <meta name="flash-info" content="{{ addslashes(session('info')) }}">
  @endif

  <div class="antialiased bg-gray-50 dark:bg-gray-900 transition-colors duration-200">
    @include('layouts.navigation-admin')
    @include('components.sidebar-admin')

    <main class="p-4 md:ml-64 h-auto pt-20">
      {{ $slot ?? '' }}
      @yield('content')
    </main>
  </div>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

  {{--  GLOBAL TOAST SCRIPT  --}}
  <script>
    /**
     * showToast — Toast Notification global
     * Muncul di kanan atas layar, bertahan selama `duration` ms lalu hilang otomatis.
     *
     * @param {string} message   Pesan yang ditampilkan
     * @param {string} type      'success' | 'error' | 'warning' | 'info'
     * @param {number} duration  Durasi dalam ms (default: 3000)
     */
    function showToast(message, type, duration) {
      type = type || 'success';
      duration = duration || 3000;

      var container = document.getElementById('toast-container');
      if (!container || !message) return;

      var icons = {
        success: '<i class="fa-solid fa-circle-check toast-icon"></i>',
        error: '<i class="fa-solid fa-circle-xmark toast-icon"></i>',
        warning: '<i class="fa-solid fa-triangle-exclamation toast-icon"></i>',
        info: '<i class="fa-solid fa-circle-info toast-icon"></i>',
      };

      var toast = document.createElement('div');
      toast.className = 'toast-item toast-' + type;
      toast.innerHTML =
        (icons[type] || icons.info) +
        '<span class="toast-body">' + message + '</span>' +
        '<button class="toast-close" onclick="dismissToast(this.parentElement)" aria-label="Tutup">' +
        '<i class="fa-solid fa-xmark"></i>' +
        '</button>' +
        '<div class="toast-progress" style="animation: toast-progress ' + (duration / 1000) +
        's linear forwards;"></div>';

      // Inject progress keyframes jika belum ada
      if (!document.getElementById('toast-keyframes')) {
        var style = document.createElement('style');
        style.id = 'toast-keyframes';
        style.textContent = '@keyframes toast-progress { from { width: 100%; } to { width: 0%; } }';
        document.head.appendChild(style);
      }

      container.appendChild(toast);

      // Slide-in animation
      requestAnimationFrame(function() {
        requestAnimationFrame(function() {
          toast.classList.add('toast-visible');
        });
      });

      // Auto-dismiss
      var timer = setTimeout(function() {
        dismissToast(toast);
      }, duration);

      // Pause on hover
      toast.addEventListener('mouseenter', function() {
        clearTimeout(timer);
      });
      toast.addEventListener('mouseleave', function() {
        timer = setTimeout(function() {
          dismissToast(toast);
        }, 1500);
      });
    }

    function dismissToast(toast) {
      if (!toast || !toast.parentNode) return;
      toast.classList.remove('toast-visible');
      toast.classList.add('toast-hide');
      setTimeout(function() {
        if (toast && toast.parentNode) toast.parentNode.removeChild(toast);
      }, 350);
    }

    // Auto-trigger dari flash session Laravel
    document.addEventListener('DOMContentLoaded', function() {
      ['success', 'error', 'warning', 'info'].forEach(function(type) {
        var meta = document.querySelector('meta[name="flash-' + type + '"]');
        if (meta && meta.getAttribute('content')) {
          showToast(meta.getAttribute('content'), type);
        }
      });
    });
  </script>

  @stack('scripts')
</body>

</html>
