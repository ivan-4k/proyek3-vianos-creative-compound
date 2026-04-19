@props(['menus', 'userFavorites'])

<section id="signature-menu-section"
  class="py-12 sm:py-16 lg:py-20 bg-[#BC430D] relative overflow-hidden home-section-title sm:px-6 md:px-8 lg:px-12 xl:px-[8%] px-4">
  <div class="absolute inset-0 z-0 flex items-start justify-start pointer-events-none rotate-45 mt-20 overflow-hidden">
    <picture>
      <source srcset="{{ asset('images/default/paper-plane.webp') }}" type="image/webp">
      <img src="{{ asset('images/default/paper-plane.png') }}" alt="" aria-hidden="true"
        class="w-2/3 h-full object-cover object-left-top" loading="lazy" decoding="async" />
    </picture>
  </div>
  {{-- Content --}}
  <div class="container mx-auto relative z-10">
    <div class="text-center mb-3" data-aos="fade-up">
      <h2 class="text-3xl md:text-4xl font-semibold text-white mb-3 font-primary">
        Menu Unggulan
      </h2>
      <p class="text-lg md:text-xl text-white/90 font-secondary">
        Favorit banyak orang, wajib kamu coba
      </p>
    </div>

    {{-- Card Grid - 3 columns --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto">
      @forelse ($menus as $menu)
        {{-- Card Menu Unggulan --}}
        <div
          class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 overflow-hidden group cursor-pointer relative @if ($loop->first) data-aos="fade-right" @elseif($loop->iteration == 2) data-aos="fade-up" @else data-aos="fade-left" @endif"
          {{ $loop->iteration <= 3 ? 'data-aos="' . ($loop->first ? 'fade-right' : ($loop->iteration == 2 ? 'fade-up' : 'fade-left')) . '"' : '' }}>

          <div class="relative">
            <img class="w-full h-64 object-cover rounded-t-lg transition-transform duration-300 group-hover:scale-110"
              src="{{ $menu->main_image ? asset('storage/' . $menu->main_image) : asset('images/default/bg1.webp') }}"
              alt="{{ $menu->name }}" loading="lazy" decoding="async" />

            {{-- TOMBOL FAVORIT --}}
            <button type="button"
              class="absolute top-4 right-4 z-20 w-10 h-10 rounded-full bg-white/70 backdrop-blur-md flex items-center justify-center hover:bg-white transition-all shadow-sm"
              @click.stop="toggleFavorite({{ $menu->id_produk ?? $menu->id }})"
              :class="{
                  'opacity-50 pointer-events-none animate-pulse': processing.includes(
                      {{ $menu->id_produk ?? $menu->id }})
              }">

              <i class="text-xl transition-all duration-300"
                :class="{
                    'fa-solid fa-heart text-red-500 scale-110': isFavorite({{ $menu->id_produk ?? $menu->id }}),
                    'fa-regular fa-heart text-gray-600 hover:scale-110': !isFavorite(
                        {{ $menu->id_produk ?? $menu->id }})
                }">
              </i>
            </button>

            <div
              class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6">
              <h5 class="mb-3 text-2xl font-bold tracking-tight text-white">
                {{ $menu->name }}
              </h5>

              <button type="button"
                class="text-white bg-[#BC430D] hover:bg-[#a3370b] focus:ring-4 focus:ring-[#BC430D]/50 font-medium rounded-lg text-sm px-5 py-3 text-center inline-flex items-center w-fit transition-all duration-300">
                Detail
                <i class="fa-solid fa-arrow-right ms-3"></i>
              </button>
            </div>
          </div>
        </div>
      @empty
        <div class="col-span-full text-center py-12">
          <p class="text-white text-lg font-secondary">Menu unggulan tidak tersedia saat ini.</p>
        </div>
      @endforelse
    </div>

    {{-- Flowbite Button Lihat Semua --}}
    <div class="flex justify-center items-center mt-12">
      <a href="{{ route('menu.index') }}"
        class="text-white bg-[#BC430D] focus:ring-4 focus:ring-[#BC430D]/50 font-medium rounded-lg text-sm px-8 py-3 text-center border-2 border-white shadow-lg transition-all duration-300 hover:bg-white hover:text-[#BC430D] inline-flex items-center gap-3">
        Lihat Semua Menu
        <i class="fa-solid fa-arrow-right"></i>
      </a>
    </div>
  </div>
</section>
