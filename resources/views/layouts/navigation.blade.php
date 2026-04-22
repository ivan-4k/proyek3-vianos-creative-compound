@php
  $theme = $theme ?? 'dark';

  // Ambil data awal dari database saat halaman pertama kali dimuat
  $initialCartCount = auth()->check() ? auth()->user()->carts()->count() : 0;
  $initialNotifCount = auth()->check() ? auth()->user()->notifications()->where('is_read', false)->count() : 0;
@endphp

<nav id="main-navbar" class="w-full fixed top-0 z-[100] font-medium font-secondary transition-all duration-300"
  x-data="{
      isOpen: false,
      scrolled: false,
      scrollPercent: 0,
      cartCount: {{ $initialCartCount }},
      notifCount: {{ $initialNotifCount }},
  
      getTextClass() {
          if (this.scrolled) return 'text-[#3E1E04]';
          return '{{ $theme === 'light' ? 'text-[#3E1E04]' : 'text-white' }}';
      },
      updateScroll() {
          this.scrolled = (window.pageYOffset > 100);
          let winScroll = document.body.scrollTop || document.documentElement.scrollTop;
          let height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
          this.scrollPercent = (winScroll / height) * 100;
      }
  }" @scroll.window="updateScroll()" @cart-updated.window="cartCount = $event.detail.count"
  :class="{
      'bg-white/90 backdrop-blur-lg shadow-sm py-2': scrolled || isOpen,
      'bg-transparent py-4': !scrolled && !isOpen && '{{ $theme }}'
      === 'dark',
      'bg-white py-4': !scrolled && !isOpen && '{{ $theme }}'
      === 'light'
  }">

  {{-- Progress Bar Bawah Navbar --}}
  <div class="absolute bottom-0 left-0 w-full h-[2px] bg-transparent z-[999]">
    <div class="h-full bg-[#BC430D] transition-all duration-75 ease-out shadow-[0_0_8px_#BC430D]"
      :style="'width: ' + scrollPercent + '%'">
    </div>
  </div>

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between">

      {{-- LOGO --}}
      <a class="flex items-center gap-2 z-50 relative shrink-0" href="{{ url('/home') }}"
        aria-label="Beranda Seven Coffee">
        <img id="navbar-logo" src="{{ asset('images/default/logo.png') }}" alt="Logo Seven Coffee"
          class="h-9 md:h-10 transition-transform duration-300 hover:scale-105">
      </a>

      {{-- MENU DESKTOP --}}
      <div class="hidden lg:flex items-center justify-center flex-1 mx-8">
        <ul class="flex items-center space-x-8">
          <li>
            <a class="relative py-2 group transition-colors" :class="getTextClass()" href="{{ url('/home') }}">
              <span
                class="{{ request()->is('home') ? 'font-bold text-[#BC430D]' : 'group-hover:text-[#BC430D]' }}">Beranda</span>
              <span
                class="absolute bottom-0 left-0 w-full h-0.5 bg-[#BC430D] transform origin-left transition-transform duration-300 {{ request()->is('home') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
            </a>
          </li>
          <li>
            <a class="relative py-2 group transition-colors" :class="getTextClass()" href="{{ url('/menu') }}">
              <span
                class="{{ request()->is('menu*') ? 'font-bold text-[#BC430D]' : 'group-hover:text-[#BC430D]' }}">Menu</span>
              <span
                class="absolute bottom-0 left-0 w-full h-0.5 bg-[#BC430D] transform origin-left transition-transform duration-300 {{ request()->is('menu*') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
            </a>
          </li>
          <li>
            <a class="relative py-2 group transition-colors" :class="getTextClass()" href="{{ url('/about') }}">
              <span
                class="{{ request()->is('about') ? 'font-bold text-[#BC430D]' : 'group-hover:text-[#BC430D]' }}">Tentang
                Kami</span>
              <span
                class="absolute bottom-0 left-0 w-full h-0.5 bg-[#BC430D] transform origin-left transition-transform duration-300 {{ request()->is('about') ? 'scale-x-100' : 'scale-x-0 group-hover:scale-x-100' }}"></span>
            </a>
          </li>
        </ul>
      </div>

      {{-- ICON & AUTH DESKTOP --}}
      <div class="hidden lg:flex items-center space-x-6">

        {{-- Form Pencarian --}}
        <form id="global-search-form" action="{{ url('/menu') }}" method="GET" class="relative group"
          aria-label="Form pencarian menu">
          <label for="nav-search-input" class="sr-only">Cari menu</label>
          <input type="text" name="search" id="nav-search-input"
            class="w-48 xl:w-64 bg-gray-500/10 border border-gray-400 rounded-full py-2 pl-4 pr-10 text-sm focus:outline-none focus:bg-white focus:text-[#3E1E04] focus:placeholder-gray-400 focus:border-[#BC430D] focus:ring-2 focus:ring-[#BC430D]/20 transition-all duration-300 placeholder-current opacity-70 focus:opacity-100"
            :class="getTextClass()" placeholder="Cari menu..." value="{{ request('search') }}"
            aria-label="Kata kunci pencarian menu">
          <button type="submit" aria-label="Mulai pencarian"
            class="absolute right-3 top-1/2 transform -translate-y-1/2 opacity-70 group-focus-within:text-[#BC430D] group-hover:text-[#BC430D] transition-colors"
            :class="getTextClass()">
            <i class="fas fa-search" aria-hidden="true"></i>
          </button>
        </form>

        <div class="flex items-center space-x-5">
          {{-- Ikon Keranjang (Dinamis Real-time) --}}
          <a href="{{ route('user.cart') ?? '#' }}" aria-label="Keranjang belanja"
            class="relative hover:text-[#BC430D] transition-transform hover:scale-110" :class="getTextClass()">
            <i class="fa-solid fa-cart-shopping text-xl" aria-hidden="true"></i>
            <template x-if="cartCount > 0">
              <span
                class="absolute -top-1.5 -right-2 bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full border-2 border-white shadow-sm"
                x-text="cartCount > 99 ? '99+' : cartCount"></span>
            </template>
          </a>

          {{-- Ikon Notifikasi (Dinamis) --}}
          <a href="{{ route('user.promo') ?? '#' }}" aria-label="Notifikasi baru"
            class="relative hover:text-[#BC430D] transition-transform hover:scale-110" :class="getTextClass()">
            <i class="fa-solid fa-bell text-xl" aria-hidden="true"></i>
            <template x-if="notifCount > 0">
              <span
                class="absolute top-0 right-0 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-white animate-pulse"></span>
            </template>
          </a>
        </div>

        <div class="w-px h-6 bg-gray-300/50"></div>

        {{-- Auth Section --}}
        @auth
          @if (Auth::user()->hasVerifiedEmail())
            <div class="relative" x-data="{ openProfile: false }">
              <button @click="openProfile = !openProfile" @click.outside="openProfile = false"
                aria-label="Buka menu profil pengguna"
                class="flex items-center gap-2 hover:text-[#BC430D] transition-colors focus:outline-none"
                :class="getTextClass()">
                <div
                  class="w-8 h-8 rounded-full bg-gradient-to-tr from-[#3E1E04] to-[#BC430D] text-white flex items-center justify-center border-2 border-transparent hover:border-[#BC430D] transition-all shadow-sm">
                  <span class="text-sm font-bold" aria-hidden="true">{{ substr(Auth::user()->name, 0, 1) }}</span>
                </div>
                <i class="fa-solid fa-chevron-down text-xs transition-transform"
                  :class="openProfile ? 'rotate-180' : ''"></i>
              </button>

              {{-- Dropdown Profile --}}
              <div x-show="openProfile" x-cloak x-transition.opacity.duration.200ms
                class="absolute right-0 mt-3 w-56 bg-white rounded-xl shadow-xl py-2 z-50 border border-gray-100 font-secondary">
                <div class="px-4 py-3 border-b border-gray-100">
                  <p class="text-sm font-bold text-gray-900 truncate">{{ Auth::user()->name }}</p>
                  <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                </div>
                <a href="{{ route('profile.edit') }}"
                  class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-orange-50 hover:text-[#BC430D] transition-colors">
                  <i class="fa-regular fa-user w-4"></i> Akun Saya
                </a>
                <a href="{{ route('user.history') }}"
                  class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-orange-50 hover:text-[#BC430D] transition-colors">
                  <i class="fa-solid fa-receipt w-4"></i> Pesanan Saya
                </a>
                <div class="border-t border-gray-100 mt-1 pt-1">
                  <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                      class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors">
                      <i class="fa-solid fa-right-from-bracket w-4"></i> Keluar
                    </button>
                  </form>
                </div>
              </div>
            </div>
          @else
            {{-- Dropdown Unverified Email --}}
            <div class="relative" x-data="{ openVerify: false }">
              <button @click="openVerify = !openVerify" @click.outside="openVerify = false"
                class="relative focus:outline-none">
                <div
                  class="flex items-center justify-center w-8 h-8 bg-amber-500 hover:bg-amber-600 text-white rounded-full transition-colors shadow-sm">
                  <i class="fas fa-envelope-open-text text-sm"></i>
                </div>
                <span class="absolute -top-1 -right-1 flex h-3 w-3">
                  <span
                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500 border-2 border-white"></span>
                </span>
              </button>

              <div x-show="openVerify" x-cloak x-transition.opacity
                class="absolute right-0 mt-3 w-72 bg-white rounded-xl shadow-xl p-5 z-50 border border-amber-200">
                <div class="text-center font-secondary">
                  <div class="w-12 h-12 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-3">
                    <i class="fas fa-envelope text-xl text-amber-600"></i>
                  </div>
                  <h4 class="font-bold text-gray-900 mb-1 font-primary">Verifikasi Email</h4>
                  <p class="text-xs text-gray-500 mb-4">Silakan cek inbox email kamu untuk mengaktifkan akun sepenuhnya.
                  </p>
                  <form method="POST" action="{{ route('verification.send') }}" class="mb-3">
                    @csrf
                    <button type="submit"
                      class="w-full bg-amber-500 hover:bg-amber-600 text-white text-sm font-semibold py-2 px-4 rounded-lg transition-colors shadow-sm">
                      Kirim Ulang Verifikasi
                    </button>
                  </form>
                  <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                      class="text-xs font-medium text-gray-400 hover:text-red-500 underline transition-colors">
                      Keluar dari akun
                    </button>
                  </form>
                </div>
              </div>
            </div>
          @endif
        @else
          {{-- Guest / Belum Login --}}
          <div class="flex items-center gap-3">
            <a href="{{ route('login') }}" class="text-sm font-bold hover:text-[#BC430D] transition-colors"
              :class="getTextClass()">Masuk</a>
            <a href="{{ route('register') }}"
              class="bg-[#BC430D] hover:bg-[#9e380b] text-white text-sm font-bold py-2 px-5 rounded-full transition-all duration-300 shadow-sm hover:shadow-md hover:-translate-y-0.5">
              Daftar
            </a>
          </div>
        @endauth
      </div>

      {{-- HAMBURGER BUTTON MOBILE --}}
      <button @click="isOpen = !isOpen" class="lg:hidden relative z-50 p-2 focus:outline-none transition-colors"
        :class="getTextClass()">
        <i class="fa-solid fa-bars text-2xl transition-transform duration-300" x-show="!isOpen"></i>
        <i class="fa-solid fa-xmark text-2xl text-[#3E1E04] transition-transform duration-300 rotate-90"
          x-show="isOpen" x-cloak></i>
      </button>

    </div>
  </div>

  {{-- MENU MOBILE (Muncul dari atas) --}}
  <div x-show="isOpen" x-cloak x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="-translate-y-full opacity-0" x-transition:enter-end="translate-y-0 opacity-100"
    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-y-0 opacity-100"
    x-transition:leave-end="-translate-y-full opacity-0"
    class="absolute top-0 left-0 w-full bg-white/95 backdrop-blur-xl border-b border-gray-200 shadow-xl lg:hidden pt-20 pb-6 px-4 z-40 h-screen overflow-y-auto flex flex-col font-secondary">

    {{-- Form Pencarian Mobile --}}
    <form action="{{ url('/menu') }}" method="GET" class="relative mb-6">
      <input type="text" name="search"
        class="w-full bg-gray-100 border-none rounded-xl py-3 pl-4 pr-10 text-sm focus:ring-2 focus:ring-[#BC430D] text-gray-800"
        placeholder="Cari menu..." value="{{ request('search') }}">
      <button type="submit" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-500">
        <i class="fas fa-search"></i>
      </button>
    </form>

    {{-- Link Navigasi Mobile --}}
    <ul class="flex flex-col space-y-2 mb-6">
      <li><a href="{{ url('/home') }}"
          class="block px-4 py-3 rounded-xl text-base font-bold transition-colors {{ request()->is('home') ? 'bg-orange-50 text-[#BC430D]' : 'text-gray-800 hover:bg-gray-50' }}">Beranda</a>
      </li>
      <li><a href="{{ url('/menu') }}"
          class="block px-4 py-3 rounded-xl text-base font-bold transition-colors {{ request()->is('menu*') ? 'bg-orange-50 text-[#BC430D]' : 'text-gray-800 hover:bg-gray-50' }}">Menu</a>
      </li>
      <li><a href="{{ url('/about') }}"
          class="block px-4 py-3 rounded-xl text-base font-bold transition-colors {{ request()->is('about') ? 'bg-orange-50 text-[#BC430D]' : 'text-gray-800 hover:bg-gray-50' }}">Tentang
          Kami</a></li>
    </ul>

    {{-- Info & Aksi User Mobile --}}
    <div class="mt-auto pt-6 border-t border-gray-200">
      @auth
        @if (Auth::user()->hasVerifiedEmail())
          <div class="flex items-center gap-4 mb-6 px-2">
            <div
              class="w-12 h-12 rounded-full bg-[#3E1E04] text-white flex items-center justify-center text-lg font-bold">
              {{ substr(Auth::user()->name, 0, 1) }}
            </div>
            <div>
              <p class="font-bold text-gray-900">{{ Auth::user()->name }}</p>
              <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
            </div>
          </div>

          <div class="grid grid-cols-2 gap-3 mb-6">
            {{-- Keranjang Mobile (Dinamis Real-time) --}}
            <a href="{{ route('user.cart') ?? '#' }}"
              class="flex flex-col items-center justify-center gap-2 p-3 rounded-xl bg-gray-50 text-gray-700 hover:text-[#BC430D] transition-colors">
              <i class="fa-solid fa-cart-shopping text-xl"></i>
              <span class="text-xs font-bold">Keranjang <template x-if="cartCount > 0"><span
                    x-text="`(${cartCount})`"></span></template></span>
            </a>

            {{-- Notifikasi Mobile (Dinamis) --}}
            <a href="{{ route('user.promo') ?? '#' }}"
              class="relative flex flex-col items-center justify-center gap-2 p-3 rounded-xl bg-gray-50 text-gray-700 hover:text-[#BC430D] transition-colors">
              <i class="fa-solid fa-bell text-xl"></i>
              <span class="text-xs font-bold">
                Notifikasi <template x-if="notifCount > 0"><span x-text="`(${notifCount})`"></span></template>
              </span>
              <template x-if="notifCount > 0">
                <span class="absolute top-3 right-8 w-2 h-2 bg-red-500 rounded-full animate-pulse"></span>
              </template>
            </a>
          </div>

          <div class="space-y-2">
            <a href="{{ route('profile.edit') }}"
              class="block w-full text-center bg-gray-100 hover:bg-gray-200 transition-colors text-gray-800 font-bold py-3 rounded-xl">Akun
              Saya</a>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit"
                class="w-full text-center bg-red-50 hover:bg-red-100 transition-colors text-red-600 font-bold py-3 rounded-xl">Keluar</button>
            </form>
          </div>
        @else
          {{-- Unverified Email Mobile --}}
          <div class="bg-amber-50 rounded-xl p-5 mb-4 text-center border border-amber-200">
            <i class="fas fa-envelope-open-text text-3xl text-amber-500 mb-2"></i>
            <h4 class="font-bold text-gray-900 mb-1">Verifikasi Email</h4>
            <p class="text-xs text-gray-600 mb-4">Cek email kamu untuk verifikasi akun.</p>
            <form method="POST" action="{{ route('verification.send') }}" class="mb-2">
              @csrf
              <button type="submit"
                class="w-full bg-amber-500 hover:bg-amber-600 text-white text-sm font-bold py-2.5 rounded-lg shadow-sm transition-colors">Kirim
                Ulang</button>
            </form>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit"
                class="w-full text-center text-red-600 text-sm font-bold py-2 hover:underline">Keluar</button>
            </form>
          </div>
        @endif
      @else
        {{-- Guest Mobile --}}
        <div class="grid grid-cols-2 gap-3 mb-6">
          <a href="{{ route('login') }}"
            class="w-full bg-gray-100 hover:bg-gray-200 text-gray-800 font-bold py-3 rounded-xl text-center transition-colors">Masuk</a>
          <a href="{{ route('register') }}"
            class="w-full bg-[#BC430D] hover:bg-[#9e380b] text-white font-bold py-3 rounded-xl text-center shadow-md transition-colors">Daftar</a>
        </div>
      @endauth
    </div>
  </div>
</nav>
