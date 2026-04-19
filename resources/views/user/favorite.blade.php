@extends('layouts.app')

@section('title', 'Menu Favorit')

@section('content')
  <x-favorite-manager :userFavorites="$userFavorites ?? []">

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
              <h2 class="text-2xl font-bold text-[#3E1E04] font-primary">Menu Favorit Kamu</h2>
              <p class="text-sm text-gray-500 mt-1 font-secondary">Daftar menu yang pernah kamu tandai sebagai favorit.</p>
            </header>

            {{-- GRID PRODUK --}}
            <div x-show="favorites.length > 0">
              <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 lg:gap-6 mb-8">

                @foreach ($favorites as $item)
                  <div x-show="isFavorite({{ $item->product->id_produk }})"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 transform scale-100"
                    x-transition:leave-end="opacity-0 transform scale-90"
                    class="fav-card bg-[#FBF8F5] rounded-2xl p-3 border border-[#3E1E04]/10 hover:border-[#BC430D]/30 transition-all duration-300 group hover:shadow-md flex flex-col h-full relative">

                    {{-- Area Gambar --}}
                    <div class="relative w-full aspect-square rounded-xl overflow-hidden mb-4">
                      <img
                        src="{{ $item->product && $item->product->main_image ? asset('storage/' . $item->product->main_image) : asset('images/default/Latte.jpg') }}"
                        alt="{{ $item->product->name ?? 'Produk' }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                        loading="lazy">

                      <button type="button" @click.prevent="toggleFavorite({{ $item->product->id_produk }})"
                        class="absolute top-3 right-3 text-red-500 hover:text-red-600 transition-colors bg-white/70 backdrop-blur-sm hover:bg-white w-8 h-8 rounded-full flex items-center justify-center shadow-sm"
                        title="Hapus dari favorit">
                        <i class="fa-solid fa-heart text-lg"></i>
                      </button>
                    </div>

                    {{-- Area Konten --}}
                    <div class="flex flex-col flex-1 px-1">
                      <h3 class="text-lg font-bold text-[#3E1E04] font-primary mb-1">
                        {{ $item->product->name ?? 'Produk tidak tersedia' }}</h3>
                      <p class="text-xs text-gray-500 font-secondary line-clamp-2 mb-4 flex-1 leading-relaxed">
                        {{ $item->product->description ?? 'Tidak ada deskripsi' }}
                      </p>

                      {{-- Footer Card --}}
                      <div class="flex items-center justify-between mt-auto">
                        <span class="font-bold text-[#3E1E04] font-secondary text-sm">
                          Rp {{ number_format($item->product->price ?? 0, 0, ',', '.') }}
                        </span>

                        <a href="#"
                          class="bg-[#3E1E04] hover:bg-[#BC430D] text-white text-xs font-semibold px-4 py-2 rounded-lg transition-colors duration-300 font-secondary">
                          Lihat
                        </a>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>

              {{-- Menampilkan Pagination Laravel --}}
              @if (method_exists($favorites, 'links'))
                <div class="mt-6">
                  {{ $favorites->links() }}
                </div>
              @endif
            </div>

            <div x-cloak x-show="favorites.length === 0" class="text-center py-16 px-4">
              <div class="w-24 h-24 bg-rose-50 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fa-regular fa-heart text-4xl text-rose-300"></i>
              </div>
              <h3 class="text-lg font-bold text-[#3E1E04] font-primary mb-2">Belum Ada Menu Favorit</h3>
              <p class="text-sm text-gray-500 font-secondary max-w-sm mx-auto mb-6">
                Kamu belum menandai satu pun menu sebagai favorit. Yuk, jelajahi menu kami dan temukan kopi kesukaanmu!
              </p>
              <a href="{{ route('menu.index') }}"
                class="inline-flex items-center gap-2 bg-[#BC430D] hover:bg-[#3E1E04] text-white px-6 py-2.5 rounded-lg transition-colors duration-300 font-secondary font-medium">
                <i class="fa-solid fa-mug-hot"></i>
                Jelajahi Menu
              </a>
            </div>

          </div>
        </div>
      </div>
    </div>

  </x-favorite-manager>
@endsection