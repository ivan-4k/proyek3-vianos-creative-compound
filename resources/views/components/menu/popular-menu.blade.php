@props(['popularMenus', 'userFavorites'])

<section
  class="py-12 sm:py-16 lg:py-20 relative overflow-hidden bg-white sm:px-6 md:px-8 lg:px-12 xl:px-[8%] px-4 font-secondary home-section-title">

  <div class="max-w-7xl mx-auto px-4">

    {{-- HEADER JUDUL --}}
    <div class="flex flex-col items-center text-center mb-12 lg:mb-16" data-aos="fade-up">
      <div
        class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-orange-50 text-[#BC430D] text-sm font-bold mb-3 border border-orange-100">
        <i class="fa-solid fa-arrow-trend-up"></i> Top Trending
      </div>
      <h2 class="font-bold mb-3 inline-block relative text-3xl md:text-4xl font-primary text-[#3E1E04]">
        Sedang <span class="text-[#BC430D]">Populer Saat Ini</span>
      </h2>
      <p class="font-secondary text-gray-500 max-w-xl mx-auto text-base md:text-lg leading-relaxed">
        Pilihan terbaik yang paling sering dipesan oleh pelanggan minggu ini. Jangan sampai kelewatan!
      </p>
    </div>

    {{-- GRID PRODUK --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">

      @forelse ($popularMenus as $menu)
        <div
          class="group relative bg-[#FBF8F5] border border-[#3E1E04]/5 rounded-2xl shadow-sm hover:shadow-md hover:border-[#BC430D]/30 transition-all duration-300 overflow-hidden flex flex-col"
          data-aos="fade-up" data-aos-delay="{{ ($loop->iteration - 1) * 100 }}">

          {{-- Angka Background Besar --}}
          <div
            class="absolute -right-4 -bottom-6 text-9xl font-black text-[#3E1E04]/5 font-primary pointer-events-none group-hover:scale-110 transition-transform duration-500">
            {{ $loop->iteration }}
          </div>

          <div class="relative overflow-hidden aspect-[4/3] bg-gray-100 mx-2 mt-2 rounded-xl">
            <img
              src="{{ $menu->main_image ? asset('storage/' . $menu->main_image) : asset('images/default/herobg.png') }}"
              alt="{{ $menu->name }}"
              class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-in-out"
              loading="lazy">

            {{-- TOMBOL FAVORIT --}}
            <button type="button"
              class="absolute top-3 right-3 z-20 w-8 h-8 rounded-full bg-white/70 backdrop-blur-md flex items-center justify-center hover:bg-white transition-all shadow-sm"
              @click.stop="toggleFavorite({{ $menu->id_produk }})">
              <i class="text-base transition-transform duration-300"
                :class="isFavorite({{ $menu->id_produk }}) ? 'fa-solid fa-heart text-red-500 scale-110' :
                    'fa-regular fa-heart text-gray-600 hover:scale-110'"></i>
            </button>

            <div class="absolute top-3 left-3 z-20">
              <span
                class="bg-[#3E1E04]/90 backdrop-blur-sm text-white text-[10px] uppercase font-bold px-2.5 py-1 rounded-md shadow-sm flex items-center gap-1.5">
                <i class="fa-solid fa-medal text-amber-400"></i> Top {{ $loop->iteration }}
              </span>
            </div>
          </div>

          <div class="p-5 flex flex-col flex-1 relative z-10">
            <h3 class="font-primary text-lg font-bold text-[#3E1E04] mb-1 group-hover:text-[#BC430D] transition-colors">
              {{ $menu->name }}
            </h3>

            <div class="text-[11px] text-[#BC430D] font-bold mb-3 flex items-center gap-1">
              <i class="fa-solid fa-fire text-orange-500"></i> Hot Item
            </div>

            <p class="font-secondary text-gray-500 text-sm leading-relaxed mb-4 line-clamp-2 flex-1">
              {{ $menu->description ?? 'Produk populer dengan kualitas terbaik.' }}
            </p>

            <div class="flex items-center justify-between pt-4 border-t border-[#3E1E04]/10 mt-auto">
              <span class="font-primary text-lg font-bold text-[#3E1E04]">Rp
                {{ number_format($menu->price, 0, ',', '.') }}</span>

              <button data-modal-target="popular-modal-{{ $menu->id_produk }}"
                data-modal-toggle="popular-modal-{{ $menu->id_produk }}"
                class="text-sm font-bold text-[#BC430D] hover:text-[#3E1E04] flex items-center gap-1 transition-colors group/btn">
                Detail <i class="fas fa-arrow-right text-xs group-hover/btn:translate-x-1 transition-transform"></i>
              </button>
            </div>
          </div>
        </div>
      @empty
        {{-- TAMPILAN JIKA BELUM ADA MENU POPULER --}}
        <div class="col-span-1 sm:col-span-2 lg:col-span-4 flex flex-col items-center justify-center py-16 text-center"
          data-aos="fade-up">
          <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mb-6 border border-gray-100">
            <i class="fas fa-chart-line text-4xl text-gray-300"></i>
          </div>
          <h3 class="font-primary text-2xl font-bold text-gray-800 mb-2">Belum Ada Tren Saat Ini</h3>
          <p class="font-secondary text-gray-500 max-w-md mx-auto">
            Data pesanan sedang dikumpulkan. Jadilah yang pertama menentukan tren dengan memesan menu favorit Anda!
          </p>
        </div>
      @endforelse

    </div>

  </div>
</section>

{{-- MODAL DETAIL PRODUK --}}
@foreach ($popularMenus as $menu)
  <div id="popular-modal-{{ $menu->id_produk }}" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
      <div class="relative bg-white rounded-2xl shadow-xl border border-gray-100">

        <div class="flex items-center justify-between p-5 border-b border-gray-100">
          <div class="flex items-center gap-3">
            <span class="bg-[#BC430D] text-white text-xs font-bold px-2 py-1 rounded-md">{{ $loop->iteration }}</span>
            <h3 class="font-primary text-xl font-bold text-[#3E1E04]">{{ $menu->name }}</h3>
          </div>
          <button type="button"
            class="text-gray-400 bg-transparent hover:bg-gray-100 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
            data-modal-hide="popular-modal-{{ $menu->id_produk }}">
            <i class="fas fa-times text-lg"></i>
          </button>
        </div>

        <div class="p-5">
          <div class="flex flex-col md:flex-row gap-6">
            <div class="md:w-1/2">
              <div class="aspect-[4/3] rounded-xl overflow-hidden">
                <img
                  src="{{ $menu->main_image ? asset('storage/' . $menu->main_image) : asset('images/default/herobg.png') }}"
                  alt="{{ $menu->name }}" class="w-full h-full object-cover" loading="lazy">
              </div>
            </div>

            <div class="md:w-1/2 flex flex-col">
              <p class="font-secondary text-gray-500 text-sm mb-4 leading-relaxed">
                {{ $menu->description ?? 'Produk populer dengan kualitas terbaik.' }}
              </p>

              <div class="space-y-2 mb-6">
                <div class="flex items-center gap-2 text-sm font-secondary">
                  <i class="fas fa-fire text-orange-500 w-5"></i>
                  <span class="text-gray-700 font-medium">Hot Item - Paling Banyak Dipesan</span>
                </div>
                <div class="flex items-center gap-2 text-sm font-secondary">
                  <i class="fas fa-temperature-half text-[#BC430D] w-5"></i>
                  <span class="text-gray-700">Tersedia: Panas & Dingin</span>
                </div>
              </div>

              <div class="mt-auto pt-4 border-t border-gray-100">
                <div class="font-primary text-2xl font-bold text-[#3E1E04] mb-4">Rp
                  {{ number_format($menu->price, 0, ',', '.') }}</div>
                <button
                  class="w-full bg-[#3C6B3E] hover:bg-[#2A4D2B] text-white font-medium py-2.5 px-4 rounded-xl flex items-center justify-center gap-2 transition-colors shadow-sm font-secondary">
                  <i class="fa-brands fa-whatsapp text-lg"></i> Pesan Sekarang
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endforeach
