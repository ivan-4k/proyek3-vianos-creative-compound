{{-- Sidebar Container dengan x-data di parent --}}
<div x-data="{ mobileSidebarOpen: false }" class="w-full lg:w-80 flex-shrink-0">

  {{-- Mobile Menu Toggle Button (Hanya tampil di HP/Tablet) --}}
  <div class="lg:hidden mb-3 mt-5">
    <button @click="mobileSidebarOpen = !mobileSidebarOpen" type="button"
      class="flex items-center gap-2 px-5 py-3 bg-white border border-[#3E1E04]/10 rounded-xl shadow-sm hover:bg-[#FBF8F5] transition-all w-full justify-between focus:ring-2 focus:ring-[#BC430D]/20">
      <div class="flex items-center gap-3">
        <div class="w-8 h-8 rounded-full bg-[#BC430D]/10 flex items-center justify-center text-[#BC430D]">
          <i class="fa-solid fa-bars text-sm"></i>
        </div>
        <span class="text-sm font-bold text-[#3E1E04] font-primary">Menu Navigasi</span>
      </div>
      <i class="fa-solid fa-chevron-down text-[#BC430D] text-sm transition-transform duration-300"
        :class="{ 'rotate-180': mobileSidebarOpen }"></i>
    </button>
  </div>

  {{-- UNIFIED SIDEBAR (Satu kode untuk Mobile & Desktop) --}}
  <div x-show="mobileSidebarOpen" x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 -translate-y-4" class="lg:!block mb-4 lg:mb-0" x-cloak>

    <div class="bg-white rounded-2xl shadow-lg border border-[#3E1E04]/10 p-5 lg:sticky lg:top-6">

      <div class="text-center mb-6 pb-6 border-b border-[#3E1E04]/10">
        <div class="relative inline-block">
          @php
            $user = Auth::user();
          @endphp

          @if ($user && $user->avatar)
            <img src="{{ Storage::url($user->avatar) }}"
              class="w-20 h-20 mx-auto rounded-full ring-4 ring-[#BC430D]/10 shadow-md object-cover transition-transform hover:scale-105 duration-300">
          @else
            <img src="{{ asset('images/default/default-avatar.png') }}"
              class="w-20 h-20 rounded-full mx-auto object-cover ring-4 ring-gray-100 shadow-sm transition-transform hover:scale-105 duration-300">
          @endif
          <span
            class="absolute bottom-1 right-1 w-4 h-4 bg-emerald-500 border-2 border-white rounded-full animate-pulse shadow-sm"></span>
        </div>
        <h3 class="mt-4 font-bold text-[#3E1E04] text-lg font-primary">{{ auth()->user()->name ?? 'Pengguna' }}</h3>
        <p class="text-xs text-gray-400 font-secondary mt-1">Member Setia</p>
      </div>

      <div class="space-y-6 text-sm">

        <div>
          <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest mb-3 px-3 font-secondary">Akun Saya
          </p>
          <ul class="space-y-1.5">
            <a href="{{ route('profile.edit') }}"
              class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-300 cursor-pointer group {{ request()->routeIs('profile.edit') ? 'bg-gradient-to-r from-[#BC430D]/10 to-transparent text-[#3E1E04] font-bold border-l-4 border-[#BC430D]' : 'text-gray-500 hover:bg-[#FBF8F5] hover:text-[#3E1E04]' }}">
              <i
                class="fa-solid fa-user w-5 text-center transition-colors duration-300 {{ request()->routeIs('profile.edit') ? 'text-[#BC430D]' : 'text-gray-400 group-hover:text-[#BC430D]' }}"></i>
              <span class="font-secondary transition-transform duration-300 group-hover:translate-x-1">Profil</span>
            </a>
            <a href="{{ route('user.address') }}"
              class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-300 cursor-pointer group {{ request()->routeIs('user.address') ? 'bg-gradient-to-r from-[#BC430D]/10 to-transparent text-[#3E1E04] font-bold border-l-4 border-[#BC430D]' : 'text-gray-500 hover:bg-[#FBF8F5] hover:text-[#3E1E04]' }}">
              <i
                class="fa-solid fa-location-dot w-5 text-center transition-colors duration-300 {{ request()->routeIs('user.address') ? 'text-[#BC430D]' : 'text-gray-400 group-hover:text-[#BC430D]' }}"></i>
              <span class="font-secondary transition-transform duration-300 group-hover:translate-x-1">Alamat</span>
            </a>
          </ul>
        </div>

        <div>
          <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest mb-3 px-3 font-secondary">Belanja</p>
          <ul class="space-y-1.5">
            <a href="{{ route('user.cart') }}"
              class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-300 cursor-pointer group {{ request()->routeIs('user.cart') ? 'bg-gradient-to-r from-[#BC430D]/10 to-transparent text-[#3E1E04] font-bold border-l-4 border-[#BC430D]' : 'text-gray-500 hover:bg-[#FBF8F5] hover:text-[#3E1E04]' }}">
              <i
                class="fa-solid fa-cart-shopping w-5 text-center transition-colors duration-300 {{ request()->routeIs('user.cart') ? 'text-[#BC430D]' : 'text-gray-400 group-hover:text-[#BC430D]' }}"></i>
              <span class="font-secondary transition-transform duration-300 group-hover:translate-x-1">Keranjang</span>
              <span
                class="ml-auto bg-[#BC430D] text-white text-[10px] font-bold px-2 py-0.5 rounded-full shadow-sm">3</span>
            </a>
            <a href="{{ route('user.favorite') }}"
              class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-300 cursor-pointer group {{ request()->routeIs('user.favorite') ? 'bg-gradient-to-r from-rose-500/10 to-transparent text-rose-700 font-bold border-l-4 border-rose-500' : 'text-gray-500 hover:bg-rose-50 hover:text-rose-600' }}">
              <i
                class="fa-solid fa-heart w-5 text-center transition-colors duration-300 {{ request()->routeIs('user.favorite') ? 'text-rose-500' : 'text-gray-400 group-hover:text-rose-500' }}"></i>
              <span class="font-secondary transition-transform duration-300 group-hover:translate-x-1">Favorit</span>
            </a>
            <a href="{{ route('user.history') }}"
              class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-300 cursor-pointer group {{ request()->routeIs('user.history') ? 'bg-gradient-to-r from-emerald-500/10 to-transparent text-emerald-700 font-bold border-l-4 border-emerald-500' : 'text-gray-500 hover:bg-emerald-50 hover:text-emerald-700' }}">
              <i
                class="fa-solid fa-clock-rotate-left w-5 text-center transition-colors duration-300 {{ request()->routeIs('user.history') ? 'text-emerald-600' : 'text-gray-400 group-hover:text-emerald-600' }}"></i>
              <span class="font-secondary transition-transform duration-300 group-hover:translate-x-1">Riwayat</span>
            </a>
          </ul>
        </div>

        <div>
          <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest mb-3 px-3 font-secondary">Smart For
            You</p>
          <ul class="space-y-1.5">
            <a href="{{ route('user.recommendation') }}"
              class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-300 cursor-pointer group {{ request()->routeIs('user.recommendation') ? 'bg-gradient-to-r from-purple-500/10 to-transparent text-purple-700 font-bold border-l-4 border-purple-500' : 'text-gray-500 hover:bg-purple-50 hover:text-purple-700' }}">
              <i
                class="fa-solid fa-microchip w-5 text-center transition-colors duration-300 {{ request()->routeIs('user.recommendation') ? 'text-purple-600' : 'text-gray-400 group-hover:text-purple-600' }}"></i>
              <span
                class="font-secondary transition-transform duration-300 group-hover:translate-x-1">Rekomendasi</span>
              <span
                class="ml-auto text-[9px] font-black text-white bg-gradient-to-r from-purple-500 to-indigo-500 px-2 py-0.5 rounded-full shadow-sm">AI</span>
            </a>
            <a href="{{ route('user.popular') }}"
              class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-300 cursor-pointer group {{ request()->routeIs('user.popular') ? 'bg-gradient-to-r from-orange-500/10 to-transparent text-orange-600 font-bold border-l-4 border-orange-500' : 'text-gray-500 hover:bg-orange-50 hover:text-orange-600' }}">
              <i
                class="fa-solid fa-fire-flame-curved w-5 text-center transition-colors duration-300 {{ request()->routeIs('user.popular') ? 'text-orange-500' : 'text-gray-400 group-hover:text-orange-500' }}"></i>
              <span class="font-secondary transition-transform duration-300 group-hover:translate-x-1">Menu
                Populer</span>
            </a>
          </ul>
        </div>

        <div>
          <p class="text-gray-400 text-[10px] font-bold uppercase tracking-widest mb-3 px-3 font-secondary">Notifikasi
          </p>
          <ul class="space-y-1.5">
            <a href="{{ route('user.promo') }}"
              class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-300 cursor-pointer group {{ request()->routeIs('user.promo') ? 'bg-gradient-to-r from-amber-500/10 to-transparent text-amber-700 font-bold border-l-4 border-amber-500' : 'text-gray-500 hover:bg-amber-50 hover:text-amber-700' }}">
              <i
                class="fa-solid fa-tag w-5 text-center transition-colors duration-300 {{ request()->routeIs('user.promo') ? 'text-amber-600' : 'text-gray-400 group-hover:text-amber-600' }}"></i>
              <span class="font-secondary transition-transform duration-300 group-hover:translate-x-1">Promo</span>
              <span
                class="ml-auto bg-amber-500 text-white text-[9px] font-bold px-2 py-0.5 rounded-full animate-bounce shadow-sm">NEW</span>
            </a>
            <a href="{{ route('user.system') }}"
              class="flex items-center gap-3 px-3 py-2.5 rounded-xl transition-all duration-300 cursor-pointer group {{ request()->routeIs('user.system') ? 'bg-gradient-to-r from-blue-500/10 to-transparent text-blue-700 font-bold border-l-4 border-blue-500' : 'text-gray-500 hover:bg-blue-50 hover:text-blue-700' }}">
              <i
                class="fa-solid fa-bell w-5 text-center transition-colors duration-300 {{ request()->routeIs('user.system') ? 'text-blue-600' : 'text-gray-400 group-hover:text-blue-600' }}"></i>
              <span class="font-secondary transition-transform duration-300 group-hover:translate-x-1">Sistem</span>
            </a>
          </ul>
        </div>

      </div>

      <div class="mt-8 pt-4 border-t border-[#3E1E04]/10">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit"
            class="w-full flex items-center justify-center gap-3 px-4 py-3 rounded-xl text-red-500 hover:text-white hover:bg-red-500 transition-all duration-300 cursor-pointer group border border-transparent hover:border-red-600 hover:shadow-md">
            <i
              class="fa-solid fa-right-from-bracket text-sm transition-transform duration-300 group-hover:-translate-x-1"></i>
            <span class="text-sm font-bold font-secondary">Keluar dari Akun</span>
          </button>
        </form>
      </div>

    </div>
  </div>
</div>
