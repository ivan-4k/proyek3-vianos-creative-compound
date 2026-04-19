@forelse ($allMenus as $menu)
  {{-- KARTU PRODUK --}}
  <div
    class="group bg-white border border-gray-100 rounded-2xl shadow-sm hover:shadow-2xl hover:shadow-amber-900/10 hover:-translate-y-2 hover:border-amber-200 transition-all duration-500 ease-out overflow-hidden flex flex-col">
    <div class="relative overflow-hidden aspect-[4/3] bg-gray-100 m-2 rounded-xl">
      <img src="{{ $menu->main_image ? asset('storage/' . $menu->main_image) : asset('images/default/herobg.png') }}"
        alt="{{ $menu->name }}"
        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-in-out"
        loading="lazy">

      <button type="button"
        class="absolute top-3 right-3 z-20 w-8 h-8 rounded-full bg-white/70 backdrop-blur-md flex items-center justify-center hover:bg-white transition-all shadow-sm"
        @click.stop="toggleFavorite({{ $menu->id_produk }})">
        <i class="text-base transition-transform duration-300"
          :class="isFavorite({{ $menu->id_produk }}) ? 'fa-solid fa-heart text-red-500 scale-110' :
              'fa-regular fa-heart text-gray-500'"></i>
      </button>

      @if ($menu->is_signature)
        <div class="absolute top-3 left-3 z-20">
          <span
            class="bg-amber-600/90 backdrop-blur-sm text-white text-[10px] font-bold px-2.5 py-1 rounded-md shadow-sm">
            Signature
          </span>
        </div>
      @endif
    </div>

    <div class="p-5 flex flex-col flex-1">
      <h3 class="font-primary text-lg font-bold text-gray-800 mb-1 group-hover:text-amber-600 transition-colors">
        {{ $menu->name }}
      </h3>
      <p class="font-secondary text-gray-500 text-sm leading-relaxed mb-4 line-clamp-2 flex-1">
        {{ $menu->description ?? 'Produk berkualitas dengan rasa istimewa.' }}
      </p>

      <div class="flex items-center justify-between pt-4 border-t border-gray-100 mt-auto">
        <span class="font-primary text-xl font-bold text-gray-900">Rp
          {{ number_format($menu->price, 0, ',', '.') }}</span>
        <button data-modal-target="menu-modal-{{ $menu->id_produk }}"
          data-modal-toggle="menu-modal-{{ $menu->id_produk }}"
          class="inline-flex items-center justify-center w-10 h-10 bg-amber-50 hover:bg-amber-600 text-amber-700 hover:text-white rounded-xl transition-all duration-300 group/btn shadow-sm">
          <i class="fas fa-plus text-lg group-hover/btn:rotate-90 transition-transform duration-300"></i>
        </button>
      </div>
    </div>
  </div>

  {{-- MODAL DETAIL PRODUK (Berada di dalam loop agar ikut ter-load AJAX) --}}
  <div id="menu-modal-{{ $menu->id_produk }}" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
      <div class="relative bg-white rounded-2xl shadow-xl border border-gray-100">
        <div class="flex items-center justify-between p-5 border-b border-gray-100 bg-gray-50/50 rounded-t-2xl">
          <h3 class="font-primary text-xl font-bold text-gray-900">{{ $menu->name }}</h3>
          <button type="button"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center transition-colors"
            data-modal-hide="menu-modal-{{ $menu->id_produk }}">
            <i class="fas fa-times text-lg"></i>
          </button>
        </div>
        <div class="p-5">
          <div class="flex flex-col md:flex-row gap-6">
            <div class="md:w-1/2">
              <div class="aspect-square rounded-xl overflow-hidden bg-gray-100">
                <img
                  src="{{ $menu->main_image ? asset('storage/' . $menu->main_image) : asset('images/default/herobg.png') }}"
                  alt="{{ $menu->name }}" class="w-full h-full object-cover" loading="lazy">
              </div>
            </div>
            <div class="md:w-1/2 flex flex-col">
              <h4 class="font-primary text-lg font-bold text-gray-800 mb-2">Detail Produk</h4>
              <p class="font-secondary text-gray-500 text-sm mb-6 leading-relaxed">
                {{ $menu->description ?? 'Produk berkualitas dengan rasa istimewa.' }}
              </p>
              <div class="space-y-3 mb-6 bg-gray-50 p-3 rounded-xl">
                <div class="flex items-center gap-3 text-sm font-secondary">
                  <i class="fas fa-mug-hot text-amber-500 w-4"></i>
                  <span class="text-gray-700">Kategori: {{ $menu->category?->name ?? 'Umum' }}</span>
                </div>
                <div class="flex items-center gap-3 text-sm font-secondary">
                  <i class="fas fa-fire text-amber-500 w-4"></i>
                  <span class="text-gray-700">Stok: {{ $menu->stock }} unit</span>
                </div>
                <div class="flex items-center gap-3 text-sm font-secondary">
                  <i class="fas fa-tag text-amber-500 w-4"></i>
                  <span class="text-gray-700">Tersedia: {{ $menu->is_available ? 'Ya' : 'Tidak' }}</span>
                </div>
              </div>
              <div class="mt-auto pt-4 border-t border-gray-100">
                <div class="font-primary text-2xl font-bold text-gray-900 mb-4">Rp
                  {{ number_format($menu->price, 0, ',', '.') }}</div>
                <button
                  class="w-full bg-[#3C6B3E] hover:bg-[#2A4D2B] text-white font-medium py-3 px-4 rounded-xl flex items-center justify-center gap-2 transition-colors shadow-sm font-secondary">
                  <i class="fas fa-shopping-cart text-lg"></i> Tambah ke Keranjang
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@empty
  <div class="col-span-1 sm:col-span-2 lg:col-span-4 flex flex-col items-center justify-center py-16 px-4 text-center">
    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-6">
      <i class="fas fa-search text-4xl text-gray-400"></i>
    </div>
    <h3 class="font-primary text-2xl font-bold text-gray-800 mb-2">Oops! Menu tidak ditemukan</h3>
    <p class="font-secondary text-gray-500 max-w-md mx-auto">Kami tidak dapat menemukan menu yang cocok dengan filter
      atau pencarian Anda. Coba gunakan kata kunci lain.</p>
    <button @click="resetFilters"
      class="mt-6 inline-flex items-center gap-2 px-6 py-2.5 bg-amber-600 hover:bg-amber-700 text-white rounded-full font-secondary font-bold transition-colors shadow-md">
      <span>Reset Pencarian</span> <i class="fas fa-rotate-left"></i>
    </button>
  </div>
@endforelse
