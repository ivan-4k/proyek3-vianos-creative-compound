@extends('layouts.app')

@section('title', 'Sedang Populer')

@section('content')
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">
    <div class="flex flex-col lg:flex-row gap-6 lg:gap-8 mt-12">

      {{-- Sidebar Component --}}
      <div class="w-full lg:w-80 flex-shrink-0">
        <x-sidebar />
      </div>

      {{-- Main Content --}}
      <div class="flex-1 space-y-6">
        <div class="bg-white rounded-xl shadow-sm border border-[#3E1E04]/10 p-6 lg:p-8">

          {{-- Header --}}
          <header class="mb-6 lg:mb-8 border-b border-[#3E1E04]/10 pb-4">
            <div class="flex items-center gap-3 mb-1">
              <h2 class="text-2xl font-bold text-[#3E1E04] font-primary">Sedang Populer</h2>
              <span
                class="bg-orange-100 text-orange-700 text-xs font-bold px-2.5 py-0.5 rounded-full flex items-center gap-1.5 font-secondary shadow-sm">
                <i class="fa-solid fa-arrow-trend-up text-[10px]"></i> Trending
              </span>
            </div>
            <p class="text-sm text-gray-500 mt-1 font-secondary">Menu yang paling banyak dipesan pelanggan saat ini
              berdasarkan tren pemesanan terbaru.</p>
          </header>

          {{-- Grid Menu Populer --}}
          @if (true)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 lg:gap-6">

              {{-- Looping Item Populer --}}
              {{-- @foreach ($popularItems as $index => $item) --}}
              @for ($i = 0; $i < 6; $i++)
                <div
                  class="bg-[#FBF8F5] rounded-2xl p-3 border border-[#3E1E04]/10 hover:border-orange-300 transition-all duration-300 group hover:shadow-md flex flex-col h-full relative">

                  {{-- Area Gambar --}}
                  <div class="relative w-full aspect-square rounded-xl overflow-hidden mb-4 bg-gray-100">
                    <img src="{{ asset('images/default/Latte.jpg') }}" alt="Lungo coffee"
                      class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

                    {{-- Badge Fire / Popular (Kiri Atas) --}}
                    <div
                      class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm px-2.5 py-1.5 rounded-lg flex items-center justify-center shadow-sm border border-white/20">
                      <i class="fa-solid fa-fire-flame-curved text-orange-500 text-sm group-hover:animate-pulse"></i>
                    </div>

                    {{-- Tombol Favorit (Kanan Atas) --}}
                    {{-- Simulasi: Item pertama di-favoritkan, sisanya belum --}}
                    <button type="button"
                      class="absolute top-3 right-3 transition-colors bg-white/70 backdrop-blur-sm hover:bg-white w-8 h-8 rounded-full flex items-center justify-center shadow-sm {{ $i === 0 ? 'text-red-500' : 'text-gray-400 hover:text-red-500' }}"
                      title="Tambah ke favorit">
                      @if ($i === 0)
                        <i class="fa-solid fa-heart text-lg"></i> {{-- Filled Heart --}}
                      @else
                        <i class="fa-regular fa-heart text-lg"></i> {{-- Outline Heart --}}
                      @endif
                    </button>
                  </div>

                  {{-- Area Konten --}}
                  <div class="flex flex-col flex-1 px-1">
                    <h3 class="text-lg font-bold text-[#3E1E04] font-primary mb-1">Lungo coffee</h3>
                    <p class="text-xs text-gray-500 font-secondary line-clamp-2 mb-4 flex-1 leading-relaxed">
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                      labore.
                    </p>

                    {{-- Footer Card (Harga & Tombol) --}}
                    <div class="flex items-center justify-between mt-auto pt-2 border-t border-[#3E1E04]/5">
                      <span class="font-bold text-[#3E1E04] font-secondary text-sm">Rp 30.000</span>
                      <a href="#"
                        class="bg-[#2A1502] hover:bg-[#BC430D] text-white text-xs font-semibold px-4 py-2.5 rounded-lg transition-colors font-secondary shadow-sm">
                        Lihat
                      </a>
                    </div>
                  </div>
                </div>
              @endfor
              {{-- @endforeach --}}
            </div>
          @else
            {{-- Empty State (Jika belum ada data tren) --}}
            <div class="text-center py-16 px-4">
              <div class="w-24 h-24 bg-orange-50 rounded-full flex items-center justify-center mx-auto mb-4 relative">
                <i class="fa-solid fa-arrow-trend-up text-4xl text-orange-300"></i>
              </div>
              <h3 class="text-lg font-bold text-[#3E1E04] font-primary mb-2">Belum Ada Tren Saat Ini</h3>
              <p class="text-sm text-gray-500 font-secondary max-w-sm mx-auto mb-6">
                Daftar menu populer sedang diperbarui. Silakan cek kembali nanti atau lihat menu lengkap kami.
              </p>
              <a href="{{ route('menu.index') }}"
                class="inline-flex items-center gap-2 bg-[#BC430D] hover:bg-[#3E1E04] text-white px-6 py-2.5 rounded-lg transition-colors font-secondary font-medium shadow-sm">
                <i class="fa-solid fa-mug-hot"></i>
                Lihat Semua Menu
              </a>
            </div>
          @endif

        </div>
      </div>

    </div>
  </div>
@endsection
