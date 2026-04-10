@php
  // Data Semua Menu
  $allMenus = [
      [
          'id' => 11,
          'name' => 'Lungo Coffee',
          'desc' => 'Ekstraksi espresso lebih panjang untuk rasa yang lebih mild.',
          'price' => 30000,
          'cat' => 'Espresso',
          'cal' => '120 kcal',
          'temp' => 'Panas / Dingin',
          'badgeTop' => 'Favorit',
          'badgeBot' => '🔥 Hot',
          'color' => '78350f',
      ],
      [
          'id' => 12,
          'name' => 'Iced Americano',
          'desc' => 'Kesegaran espresso dengan es batu, cocok untuk cuaca panas.',
          'price' => 28000,
          'cat' => 'Espresso',
          'cal' => '85 kcal',
          'temp' => 'Dingin',
          'badgeTop' => 'Best Seller',
          'badgeBot' => '🧊 Ice',
          'color' => '92400e',
      ],
      [
          'id' => 13,
          'name' => 'Matcha Latte',
          'desc' => 'Matcha premium dengan susu segar, creamy dan menenangkan.',
          'price' => 32000,
          'cat' => 'Non-Coffee',
          'cal' => '150 kcal',
          'temp' => 'Panas / Dingin',
          'badgeTop' => null,
          'badgeBot' => '🔥 Hot / 🧊 Ice',
          'color' => 'b45309',
      ],
      [
          'id' => 14,
          'name' => 'Cold Brew',
          'desc' => 'Kopi seduh dingin 12 jam, smooth dan low acid.',
          'price' => 35000,
          'cat' => 'Manual Brew',
          'cal' => '5 kcal',
          'temp' => 'Dingin',
          'badgeTop' => null,
          'badgeBot' => '🧊 Ice Only',
          'color' => 'd97706',
      ],
  ];
@endphp

<section
  class="py-12 sm:py-16 lg:py-24 relative overflow-hidden bg-white sm:px-6 md:px-8 lg:px-12 xl:px-[8%] px-4 font-secondary home-section-title"
  x-data="{
      favorites: [],
      toastMsg: null,
      toastVisible: false,
      toggleFavorite(productId) {
          if (this.favorites.includes(productId)) {
              this.favorites = this.favorites.filter(id => id !== productId);
              this.showToast('Dihapus dari favorit', 'remove');
          } else {
              this.favorites.push(productId);
              this.showToast('Ditambahkan ke favorit', 'add');
          }
      },
      isFavorite(productId) {
          return this.favorites.includes(productId);
      },
      showToast(message, type) {
          this.toastMsg = message;
          this.toastVisible = true;
          setTimeout(() => {
              this.toastVisible = false;
              setTimeout(() => { this.toastMsg = null; }, 300);
          }, 2500);
      }
  }">

  <div class="max-w-7xl mx-auto px-4">

    <div class="text-center mb-12 lg:mb-16" data-aos="fade-up">
      <h2 class="font-bold mb-3 relative inline-block text-3xl md:text-4xl font-primary text-gray-900">
        Semua <span class="text-amber-600">Menu Kami</span>
      </h2>
      <p class="font-secondary text-gray-500 max-w-xl mx-auto text-base md:text-lg leading-relaxed">
        Eksplorasi koleksi lengkap minuman kami dan temukan rasa favoritmu.
      </p>
    </div>

    <div class="mb-12" data-aos="fade-up" data-aos-delay="50">

      <div class="mb-6 max-w-2xl mx-auto relative group">
        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
          <i class="fas fa-search text-gray-400 group-focus-within:text-amber-500 transition-colors"></i>
        </div>
        <input type="text" placeholder="Cari menu favoritmu..."
          class="w-full pl-11 pr-4 py-3.5 bg-gray-50/50 border border-gray-200 rounded-2xl focus:outline-none focus:bg-white focus:border-amber-400 focus:ring-4 focus:ring-amber-500/10 transition-all font-secondary text-gray-700 shadow-sm">
      </div>

      <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-4 max-w-5xl mx-auto">

        <div class="relative">
          <select
            class="w-full appearance-none bg-white border border-gray-200 rounded-xl px-4 py-3 pr-10 font-secondary text-gray-700 text-sm focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-500/20 cursor-pointer shadow-sm hover:border-amber-300 transition-colors">
            <option value="">📂 Semua Kategori</option>
            <option value="espresso">☕ Espresso</option>
            <option value="non-coffee">🍵 Non-Coffee</option>
            <option value="latte">🥛 Latte</option>
            <option value="manual-brew">💧 Manual Brew</option>
            <option value="frappe">🍧 Frappe</option>
          </select>
          <i
            class="fas fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none text-xs"></i>
        </div>

        <div class="relative">
          <select
            class="w-full appearance-none bg-white border border-gray-200 rounded-xl px-4 py-3 pr-10 font-secondary text-gray-700 text-sm focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-500/20 cursor-pointer shadow-sm hover:border-amber-300 transition-colors">
            <option value="">💰 Rentang Harga</option>
            <option value="0-20000">Rp 0 - Rp 20.000</option>
            <option value="20000-35000">Rp 20.000 - Rp 35.000</option>
            <option value="35000-50000">Rp 35.000 - Rp 50.000</option>
            <option value="50000+">Rp 50.000+</option>
          </select>
          <i
            class="fas fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none text-xs"></i>
        </div>

        <div class="relative">
          <select
            class="w-full appearance-none bg-white border border-gray-200 rounded-xl px-4 py-3 pr-10 font-secondary text-gray-700 text-sm focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-500/20 cursor-pointer shadow-sm hover:border-amber-300 transition-colors">
            <option value="">🌡️ Semua Suhu</option>
            <option value="hot">🔥 Hot</option>
            <option value="ice">🧊 Ice</option>
            <option value="both">☕ Hot & Ice</option>
          </select>
          <i
            class="fas fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none text-xs"></i>
        </div>

        <div class="relative">
          <select
            class="w-full appearance-none bg-white border border-gray-200 rounded-xl px-4 py-3 pr-10 font-secondary text-gray-700 text-sm focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-500/20 cursor-pointer shadow-sm hover:border-amber-300 transition-colors">
            <option value="">⭐ Urutkan</option>
            <option value="popular">Terpopuler</option>
            <option value="new">Terbaru</option>
            <option value="price-asc">Termurah</option>
            <option value="price-desc">Termahal</option>
            <option value="rating">Rating Tertinggi</option>
          </select>
          <i
            class="fas fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none text-xs"></i>
        </div>

      </div>

      <div class="flex flex-wrap justify-center gap-2 mt-5">
        <span
          class="inline-flex items-center gap-2 px-3 py-1.5 bg-amber-50 text-amber-700 border border-amber-100 rounded-full text-sm font-secondary transition-colors hover:bg-amber-100 cursor-pointer">
          <span>Semua Kategori</span>
          <i class="fas fa-times opacity-60 hover:opacity-100 text-xs"></i>
        </span>
        <span
          class="inline-flex items-center gap-2 px-3 py-1.5 bg-amber-50 text-amber-700 border border-amber-100 rounded-full text-sm font-secondary transition-colors hover:bg-amber-100 cursor-pointer">
          <span>Semua Harga</span>
          <i class="fas fa-times opacity-60 hover:opacity-100 text-xs"></i>
        </span>
        <span
          class="inline-flex items-center gap-2 px-3 py-1.5 bg-gray-50 text-gray-600 border border-gray-200 rounded-full text-sm font-secondary hover:bg-gray-100 cursor-pointer transition-colors">
          <span>+ Filter Lainnya</span>
        </span>
      </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8 mb-12">

      @foreach ($allMenus as $menu)
        <div
          class="group bg-white border border-gray-100 rounded-2xl shadow-sm hover:shadow-2xl hover:shadow-amber-900/10 hover:-translate-y-2 hover:border-amber-200 transition-all duration-500 ease-out overflow-hidden flex flex-col">

          <div class="relative overflow-hidden aspect-[4/3] bg-gray-100 m-2 rounded-xl">
            <img src="https://placehold.co/600x400/{{ $menu['color'] }}/ffffff?text={{ urlencode($menu['name']) }}"
              alt="{{ $menu['name'] }}"
              class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-in-out">

            <button type="button"
              class="absolute top-3 right-3 z-20 w-8 h-8 rounded-full bg-white/70 backdrop-blur-md flex items-center justify-center hover:bg-white transition-all shadow-sm"
              @click.stop="toggleFavorite({{ $menu['id'] }})">
              <i class="text-base transition-transform duration-300"
                :class="isFavorite({{ $menu['id'] }}) ? 'fa-solid fa-heart text-red-500 scale-110' :
                    'fa-regular fa-heart text-gray-500'"></i>
            </button>

            @if ($menu['badgeTop'])
              <div class="absolute top-3 left-3 z-20">
                <span
                  class="bg-amber-600/90 backdrop-blur-sm text-white text-[10px] font-bold px-2.5 py-1 rounded-md shadow-sm">
                  {{ $menu['badgeTop'] }}
                </span>
              </div>
            @endif

            @if ($menu['badgeBot'])
              <div class="absolute bottom-3 left-3 z-20">
                <span
                  class="bg-white/90 backdrop-blur-sm text-gray-800 text-[10px] font-bold px-2.5 py-1 rounded-md shadow-sm">
                  {{ $menu['badgeBot'] }}
                </span>
              </div>
            @endif
          </div>

          <div class="p-5 flex flex-col flex-1">
            <h3 class="font-primary text-lg font-bold text-gray-800 mb-1 group-hover:text-amber-600 transition-colors">
              {{ $menu['name'] }}
            </h3>
            <p class="font-secondary text-gray-500 text-sm leading-relaxed mb-4 line-clamp-2 flex-1">
              {{ $menu['desc'] }}
            </p>

            <div class="flex items-center justify-between pt-4 border-t border-gray-100 mt-auto">
              <span class="font-primary text-xl font-bold text-gray-900">Rp
                {{ number_format($menu['price'], 0, ',', '.') }}</span>
              <button data-modal-target="menu-modal-{{ $menu['id'] }}"
                data-modal-toggle="menu-modal-{{ $menu['id'] }}"
                class="inline-flex items-center justify-center w-10 h-10 bg-amber-50 hover:bg-amber-600 text-amber-700 hover:text-white rounded-xl transition-all duration-300 group/btn shadow-sm">
                <i class="fas fa-plus text-lg group-hover/btn:rotate-90 transition-transform duration-300"></i>
              </button>
            </div>
          </div>
        </div>
      @endforeach

    </div>

    <div class="text-center" data-aos="fade-up">
      <a href="#"
        class="inline-flex items-center justify-center gap-3 bg-[#3E1E04] hover:bg-[#BC430D] text-white font-secondary font-bold py-3.5 px-8 rounded-full transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-1 group">
        <span>Muat Lebih Banyak</span>
        <i class="fas fa-rotate-right group-hover:rotate-180 transition-transform duration-500"></i>
      </a>
    </div>

    <div x-cloak x-show="toastVisible" x-transition:enter="transition ease-out duration-300"
      x-transition:enter-start="opacity-0 translate-y-10 scale-95"
      x-transition:enter-end="opacity-100 translate-y-0 scale-100" x-transition:leave="transition ease-in duration-200"
      x-transition:leave-start="opacity-100 translate-y-0 scale-100"
      x-transition:leave-end="opacity-0 translate-y-10 scale-95"
      class="fixed bottom-8 left-1/2 transform -translate-x-1/2 z-[100]">
      <div
        class="bg-gray-900 text-white px-6 py-3 rounded-2xl shadow-2xl flex items-center gap-3 text-sm font-secondary border border-gray-700">
        <div class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center">
          <i class="fas"
            :class="toastMsg?.includes('Ditambahkan') ? 'fa-heart text-red-400' : 'fa-trash text-gray-300'"></i>
        </div>
        <span x-text="toastMsg" class="font-medium"></span>
      </div>
    </div>

  </div>
</section>

@foreach ($allMenus as $menu)
  <div id="menu-modal-{{ $menu['id'] }}" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
      <div class="relative bg-white rounded-2xl shadow-xl border border-gray-100">

        <div class="flex items-center justify-between p-5 border-b border-gray-100 bg-gray-50/50 rounded-t-2xl">
          <h3 class="font-primary text-xl font-bold text-gray-900">{{ $menu['name'] }}</h3>
          <button type="button"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center transition-colors"
            data-modal-hide="menu-modal-{{ $menu['id'] }}">
            <i class="fas fa-times text-lg"></i>
          </button>
        </div>

        <div class="p-5">
          <div class="flex flex-col md:flex-row gap-6">
            <div class="md:w-1/2">
              <div class="aspect-square rounded-xl overflow-hidden bg-gray-100">
                <img
                  src="https://placehold.co/600x400/{{ $menu['color'] }}/ffffff?text={{ urlencode($menu['name']) }}"
                  alt="{{ $menu['name'] }}" class="w-full h-full object-cover">
              </div>
            </div>

            <div class="md:w-1/2 flex flex-col">
              <h4 class="font-primary text-lg font-bold text-gray-800 mb-2">Detail Produk</h4>
              <p class="font-secondary text-gray-500 text-sm mb-6 leading-relaxed">
                {{ $menu['desc'] }}
              </p>

              <div class="space-y-3 mb-6 bg-gray-50 p-3 rounded-xl">
                <div class="flex items-center gap-3 text-sm font-secondary">
                  <i class="fas fa-mug-hot text-amber-500 w-4"></i>
                  <span class="text-gray-700">Kategori: {{ $menu['cat'] }}</span>
                </div>
                <div class="flex items-center gap-3 text-sm font-secondary">
                  <i class="fas fa-fire text-amber-500 w-4"></i>
                  <span class="text-gray-700">Kalori: {{ $menu['cal'] }}</span>
                </div>
                <div class="flex items-center gap-3 text-sm font-secondary">
                  <i class="fas fa-temperature-half text-amber-500 w-4"></i>
                  <span class="text-gray-700">Suhu: {{ $menu['temp'] }}</span>
                </div>
              </div>

              <div class="mt-auto pt-4 border-t border-gray-100">
                <div class="font-primary text-2xl font-bold text-gray-900 mb-4">Rp
                  {{ number_format($menu['price'], 0, ',', '.') }}</div>
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
@endforeach
