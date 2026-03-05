<!-- Navbar Start -->
@php
  $theme = $theme ?? 'dark';
@endphp

<nav id="main-navbar"
  class="w-full fixed top-0 z-50 font-medium font-secondary {{ $theme === 'light' ? 'page-light' : 'bg-transparent text-white' }} transition-colors duration-300"
  x-data="{ isOpen: false }">
  <div class="container mx-auto px-4">
    <div class="flex items-center justify-between py-3">
      <!-- Logo -->
      <a class="flex items-center" href="{{ url('/home') }}#">
        <img id="navbar-logo" src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10 mr-2">
      </a>

      <!-- Mobile menu button -->
      <button @click="isOpen = !isOpen" class="lg:hidden text-2xl focus:outline-none">
        <i class="fa-solid fa-bars" x-show="!isOpen"></i>
        <i class="fa-solid fa-xmark" x-show="isOpen"></i>
      </button>

      <!-- Desktop & Mobile Menu -->
      <div class="hidden lg:flex lg:items-center lg:justify-between lg:flex-1 lg:ml-10"
        :class="{
            'hidden lg:flex': !
                isOpen,
            'block absolute top-full left-0 right-0 bg-white text-black p-4 shadow-lg': isOpen
        }"
        x-show="isOpen || window.innerWidth >= 1024" x-transition>

        <!-- Menu Tengah + Search -->
        <ul class="flex flex-col lg:flex-row lg:items-center space-y-2 lg:space-y-0 lg:space-x-6 font-secondary navbar-nav">
          <li>
            <a class="block py-2 lg:py-0 hover:text-[#BC430D] transition {{ request()->is('home') ? 'text-[#BC430D] font-semibold' : '' }}"
              href="{{ url('/home') }}#">Beranda</a>
          </li>
          <li>
            <a class="block py-2 lg:py-0 hover:text-[#BC430D] transition {{ request()->is('menu*') ? 'text-[#BC430D] font-semibold' : '' }}"
              href="{{ url('/menu') }}">Menu</a>
          </li>
          <li>
            <a class="block py-2 lg:py-0 hover:text-[#BC430D] transition {{ request()->is('tentang') ? 'text-[#BC430D] font-semibold' : '' }}"
              href="{{ url('/') }}#tentang">Tentang Kami</a>
          </li>

          <!-- Search box -->
          <li class="lg:ml-4">
            {{-- {{ route('menu') }} --}}
            <form id="global-search-form" action="" method="GET" class="relative">
              <input type="text" name="search" id="nav-search-input"
                class="w-full lg:w-64 bg-white bg-opacity-10 border border-gray-300 rounded-full py-2 pl-4 pr-10 text-sm focus:outline-none focus:ring-2 focus:ring-[#BC430D]"
                placeholder="Cari..." value="{{ request('search') }}">
              <button type="submit"
                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-[#BC430D]">
                <i class="fas fa-search"></i>
              </button>
            </form>
          </li>
        </ul>

        <!-- Icons kanan -->
        <div class="flex items-center space-x-4 mt-4 lg:mt-0 lg:ml-auto">
          <!-- cart Icon -->
          @livewire('navbar-cart')

          <!-- notification Icon -->
          @livewire('navbar-notification')

          <!-- User dropdown untuk SUDAH VERIFIKASI -->
          @auth
            @if (Auth::user()->hasVerifiedEmail())
              <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                <a class="flex items-center space-x-2 text-white hover:text-[#BC430D] transition"
                  href="{{ route('profile.edit') }}">
                  <i class="fa-solid fa-user"></i>
                </a>

                <div x-show="open"
                  class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 border border-[#BC430D]"
                  x-transition>
                  <a href="{{ route('profile.edit') }}"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Akun saya</a>
                  {{-- {{ route('profile.pesanan') }} --}}
                  <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Pesanan saya</a>
                  <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                      class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Keluar</button>
                  </form>
                </div>
              </div>
            @else
              <!-- User untuk BELUM VERIFIKASI -->
              <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                <div
                  class="flex items-center justify-center w-8 h-8 bg-yellow-500 rounded-full border-2 border-white cursor-default">
                  <i class="fas fa-envelope text-dark text-sm"></i>
                </div>

                <div x-show="open"
                  class="absolute right-0 mt-2 w-64 bg-white rounded-md shadow-lg py-3 px-4 z-50 border border-[#BC430D]"
                  x-transition>
                  <div class="text-center">
                    <i class="fas fa-envelope text-2xl text-yellow-500 mb-2"></i>
                    <p class="text-sm text-gray-600 mb-3">Email belum terverifikasi</p>
                    <form method="POST" action="{{ route('verification.send') }}" class="mb-2">
                      @csrf
                      <button type="submit"
                        class="w-full bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium py-2 px-4 rounded-md transition">
                        Kirim Ulang Verifikasi
                      </button>
                    </form>
                    <form method="POST" action="{{ route('logout') }}">
                      @csrf
                      <button type="submit" class="text-sm text-gray-600 hover:text-gray-900">Keluar</button>
                    </form>
                  </div>
                </div>
              </div>
            @endif
          @else
            <!-- User untuk guest -->
            <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
              <button class="text-white hover:text-[#BC430D] transition">
                <i class="fa-solid fa-user text-xl"></i>
              </button>

              <div x-show="open"
                class="absolute right-0 mt-2 w-64 bg-white rounded-md shadow-lg py-4 px-4 z-50 border border-[#BC430D]"
                x-transition>
                <div class="text-center">
                  <i class="fa-solid fa-user text-3xl text-gray-400 mb-3"></i>
                  <p class="text-sm text-gray-600 mb-4">Silakan Masuk Untuk Melanjutkan</p>
                  <div class="flex flex-col sm:flex-row gap-2">
                    <a href="{{ route('login') }}"
                      class="flex-1 bg-[#BC430D] hover:[#BC430D] text-white text-sm font-medium py-2 px-4 rounded-md transition text-center">
                      Masuk
                    </a>
                    <a href="{{ route('register') }}"
                      class="flex-1 border border-[#BC430D] text-[#BC430D] hover:bg-green-50 text-sm font-medium py-2 px-4 rounded-md transition text-center">
                      Daftar
                    </a>
                  </div>
                </div>
              </div>
            </div>
          @endauth
        </div>
      </div>
    </div>
  </div>
</nav>
<!-- Navbar End -->
