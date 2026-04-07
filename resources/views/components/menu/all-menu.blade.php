<section
  class="py-12 sm:py-16 lg:py-20 relative overflow-hidden home-section-title sm:px-6 md:px-8 lg:px-12 xl:px-[8%] px-4 font-secondary bg-white"
  x-data="{
      favorites: [],
      toastMsg: null,
      toastVisible: false,
      toggleFavorite(productId) {
          if (this.favorites.includes(productId)) {
              this.favorites = this.favorites.filter(id => id !== productId);
              this.showToast('✖ Dihapus dari favorit', 'remove');
          } else {
              this.favorites.push(productId);
              this.showToast('✓ Ditambahkan ke favorit', 'add');
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
              setTimeout(() => {
                  this.toastMsg = null;
              }, 300);
          }, 2000);
      }
  }">
  <div class="max-w-7xl mx-auto px-4">
    <!-- Header Section -->
    <div class="text-center mb-12 md:mb-16" data-aos="fade-up">
      <h2 class="font-semibold mb-3 relative inline-block text-3xl md:text-4xl font-primary text-gray-900">
        Semua <span class="text-amber-700">Menu Kami</span>
      </h2>
      <p class="font-secondary text-gray-500 mt-3 max-w-xl mx-auto text-base md:text-lg">
        Temukan menu favoritmu dari koleksi lengkap kami
      </p>
    </div>

    <!-- Filter Section - Dengan Flexbox -->
    <div class="mb-10" data-aos="fade-up" data-aos-delay="50">
      <!-- Search Bar -->
      <div class="mb-6">
        <div class="relative max-w-md mx-auto">
          <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
          <input type="text" placeholder="Cari menu favoritmu..."
            class="w-full pl-11 pr-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:border-amber-500 focus:ring-2 focus:ring-amber-200 transition-all font-secondary text-gray-700">
        </div>
      </div>

      <!-- Filter dengan Flexbox -->
      <div class="flex flex-wrap justify-center gap-3">
        <!-- Kategori Filter -->
        <div class="relative flex-1 min-w-[180px]">
          <select
            class="w-full appearance-none bg-white border border-gray-200 rounded-xl px-4 py-3 pr-10 font-secondary text-gray-700 focus:outline-none focus:border-amber-500 focus:ring-2 focus:ring-amber-200 cursor-pointer">
            <option value="">📂 Semua Kategori</option>
            <option value="espresso">☕ Espresso</option>
            <option value="non-coffee">🍵 Non-Coffee</option>
            <option value="latte">🥛 Latte</option>
            <option value="manual-brew">💧 Manual Brew</option>
            <option value="frappe">🍧 Frappe</option>
          </select>
          <i
            class="fas fa-chevron-down absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none"></i>
        </div>

        <!-- Harga Filter -->
        <div class="relative flex-1 min-w-[180px]">
          <select
            class="w-full appearance-none bg-white border border-gray-200 rounded-xl px-4 py-3 pr-10 font-secondary text-gray-700 focus:outline-none focus:border-amber-500 focus:ring-2 focus:ring-amber-200 cursor-pointer">
            <option value="">💰 Rentang Harga</option>
            <option value="0-20000">Rp 0 - Rp 20.000</option>
            <option value="20000-35000">Rp 20.000 - Rp 35.000</option>
            <option value="35000-50000">Rp 35.000 - Rp 50.000</option>
            <option value="50000+">Rp 50.000+</option>
          </select>
          <i
            class="fas fa-chevron-down absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none"></i>
        </div>

        <!-- Suhu Filter (Hot/Ice) -->
        <div class="relative flex-1 min-w-[180px]">
          <select
            class="w-full appearance-none bg-white border border-gray-200 rounded-xl px-4 py-3 pr-10 font-secondary text-gray-700 focus:outline-none focus:border-amber-500 focus:ring-2 focus:ring-amber-200 cursor-pointer">
            <option value="">🌡️ Semua Suhu</option>
            <option value="hot">🔥 Hot</option>
            <option value="ice">🧊 Ice</option>
            <option value="both">☕ Hot & Ice</option>
          </select>
          <i
            class="fas fa-chevron-down absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none"></i>
        </div>

        <!-- Popularitas Filter -->
        <div class="relative flex-1 min-w-[180px]">
          <select
            class="w-full appearance-none bg-white border border-gray-200 rounded-xl px-4 py-3 pr-10 font-secondary text-gray-700 focus:outline-none focus:border-amber-500 focus:ring-2 focus:ring-amber-200 cursor-pointer">
            <option value="">⭐ Urutkan</option>
            <option value="popular">Terpopuler</option>
            <option value="new">Terbaru</option>
            <option value="price-asc">Termurah</option>
            <option value="price-desc">Termahal</option>
            <option value="rating">Rating Tertinggi</option>
          </select>
          <i
            class="fas fa-chevron-down absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 pointer-events-none"></i>
        </div>
      </div>

      <!-- Active Filters (Static Display) -->
      <div class="flex flex-wrap justify-center gap-2 mt-4">
        <span
          class="inline-flex items-center gap-2 px-3 py-1.5 bg-amber-50 text-amber-700 rounded-full text-sm font-secondary">
          <span>Semua Kategori</span>
          <i class="fas fa-times text-xs cursor-pointer hover:text-amber-900"></i>
        </span>
        <span
          class="inline-flex items-center gap-2 px-3 py-1.5 bg-amber-50 text-amber-700 rounded-full text-sm font-secondary">
          <span>Semua Harga</span>
          <i class="fas fa-times text-xs cursor-pointer hover:text-amber-900"></i>
        </span>
        <span
          class="inline-flex items-center gap-2 px-3 py-1.5 bg-gray-100 text-gray-600 rounded-full text-sm font-secondary">
          <span>+ Filter Lainnya</span>
        </span>
      </div>
    </div>

    <!-- Menu dengan Flexbox -->
    <div class="flex flex-wrap justify-center gap-6 md:gap-8">
      <!-- Menu Item 1 -->
      <div
        class="flex-1 min-w-[280px] max-w-[320px] group bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden"
        data-aos="fade-up" data-aos-delay="100">
        <div class="relative overflow-hidden h-48">
          <img src="https://placehold.co/600x400/78350f/ffffff?text=Lungo+Coffee" alt="Lungo Coffee"
            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">

          <!-- Icon Love/Favorite dengan Alpine.js -->
          <div class="absolute top-4 right-4 z-20" @click.stop="toggleFavorite(1)">
            <i class="text-2xl drop-shadow-lg cursor-pointer transition-all duration-300 hover:scale-110"
              :class="isFavorite(1) ? 'fa-solid fa-heart text-red-500' : 'fa-regular fa-heart text-white'"></i>
          </div>

          <div class="absolute top-4 left-4">
            <span class="bg-amber-600 text-white text-xs font-semibold px-2.5 py-1 rounded-full shadow-md">
              Favorit
            </span>
          </div>

          <!-- Badge Hot/Ice -->
          <div class="absolute bottom-4 left-4">
            <span
              class="bg-white/90 backdrop-blur-sm text-amber-700 text-xs font-semibold px-2.5 py-1 rounded-full shadow-md">
              🔥 Hot
            </span>
          </div>
        </div>

        <div class="p-5">
          <h3 class="font-primary text-xl font-bold text-gray-800 mb-2 group-hover:text-amber-700 transition-colors">
            Lungo Coffee
          </h3>
          <p class="font-secondary text-gray-500 text-sm leading-relaxed mb-4">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.
          </p>

          <div class="flex items-center justify-between pt-3 border-t border-gray-100">
            <div class="flex flex-col">
              <span class="font-primary text-2xl font-bold text-amber-700">Rp 30.000</span>
              <span class="font-secondary text-xs text-gray-400">/ cup</span>
            </div>

            <button data-modal-target="product-modal-1" data-modal-toggle="product-modal-1"
              class="inline-flex items-center gap-2 bg-amber-50 hover:bg-amber-600 text-amber-700 hover:text-white font-semibold py-2 px-4 rounded-lg transition-all duration-300 group/btn">
              <span>Lihat</span>
              <i class="fas fa-arrow-right text-sm group-hover/btn:translate-x-1 transition-transform"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Menu Item 2 -->
      <div
        class="flex-1 min-w-[280px] max-w-[320px] group bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden"
        data-aos="fade-up" data-aos-delay="200">
        <div class="relative overflow-hidden h-48">
          <img src="https://placehold.co/600x400/92400e/ffffff?text=Iced+Coffee" alt="Iced Coffee"
            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">

          <div class="absolute top-4 right-4 z-20" @click.stop="toggleFavorite(2)">
            <i class="text-2xl drop-shadow-lg cursor-pointer transition-all duration-300 hover:scale-110"
              :class="isFavorite(2) ? 'fa-solid fa-heart text-red-500' : 'fa-regular fa-heart text-white'"></i>
          </div>

          <div class="absolute top-4 left-4">
            <span class="bg-amber-600 text-white text-xs font-semibold px-2.5 py-1 rounded-full shadow-md">
              Best Seller
            </span>
          </div>

          <div class="absolute bottom-4 left-4">
            <span
              class="bg-white/90 backdrop-blur-sm text-blue-500 text-xs font-semibold px-2.5 py-1 rounded-full shadow-md">
              🧊 Ice
            </span>
          </div>
        </div>

        <div class="p-5">
          <h3 class="font-primary text-xl font-bold text-gray-800 mb-2 group-hover:text-amber-700 transition-colors">
            Iced Americano
          </h3>
          <p class="font-secondary text-gray-500 text-sm leading-relaxed mb-4">
            Kesegaran espresso dengan es batu, cocok untuk cuaca panas.
          </p>

          <div class="flex items-center justify-between pt-3 border-t border-gray-100">
            <div class="flex flex-col">
              <span class="font-primary text-2xl font-bold text-amber-700">Rp 28.000</span>
              <span class="font-secondary text-xs text-gray-400">/ cup</span>
            </div>

            <button data-modal-target="product-modal-2" data-modal-toggle="product-modal-2"
              class="inline-flex items-center gap-2 bg-amber-50 hover:bg-amber-600 text-amber-700 hover:text-white font-semibold py-2 px-4 rounded-lg transition-all duration-300 group/btn">
              <span>Lihat</span>
              <i class="fas fa-arrow-right text-sm group-hover/btn:translate-x-1 transition-transform"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Menu Item 3 -->
      <div
        class="flex-1 min-w-[280px] max-w-[320px] group bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden"
        data-aos="fade-up" data-aos-delay="300">
        <div class="relative overflow-hidden h-48">
          <img src="https://placehold.co/600x400/b45309/ffffff?text=Matcha+Latte" alt="Matcha Latte"
            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">

          <div class="absolute top-4 right-4 z-20" @click.stop="toggleFavorite(3)">
            <i class="text-2xl drop-shadow-lg cursor-pointer transition-all duration-300 hover:scale-110"
              :class="isFavorite(3) ? 'fa-solid fa-heart text-red-500' : 'fa-regular fa-heart text-white'"></i>
          </div>

          <div class="absolute bottom-4 left-4">
            <span
              class="bg-white/90 backdrop-blur-sm text-amber-700 text-xs font-semibold px-2.5 py-1 rounded-full shadow-md">
              🔥 Hot / 🧊 Ice
            </span>
          </div>
        </div>

        <div class="p-5">
          <h3 class="font-primary text-xl font-bold text-gray-800 mb-2 group-hover:text-amber-700 transition-colors">
            Matcha Latte
          </h3>
          <p class="font-secondary text-gray-500 text-sm leading-relaxed mb-4">
            Matcha premium dengan susu segar, creamy dan menenangkan.
          </p>

          <div class="flex items-center justify-between pt-3 border-t border-gray-100">
            <div class="flex flex-col">
              <span class="font-primary text-2xl font-bold text-amber-700">Rp 32.000</span>
              <span class="font-secondary text-xs text-gray-400">/ cup</span>
            </div>

            <button data-modal-target="product-modal-3" data-modal-toggle="product-modal-3"
              class="inline-flex items-center gap-2 bg-amber-50 hover:bg-amber-600 text-amber-700 hover:text-white font-semibold py-2 px-4 rounded-lg transition-all duration-300 group/btn">
              <span>Lihat</span>
              <i class="fas fa-arrow-right text-sm group-hover/btn:translate-x-1 transition-transform"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Menu Item 4 -->
      <div
        class="flex-1 min-w-[280px] max-w-[320px] group bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden"
        data-aos="fade-up" data-aos-delay="400">
        <div class="relative overflow-hidden h-48">
          <img src="https://placehold.co/600x400/d97706/ffffff?text=Cold+Brew" alt="Cold Brew"
            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">

          <div class="absolute top-4 right-4 z-20" @click.stop="toggleFavorite(4)">
            <i class="text-2xl drop-shadow-lg cursor-pointer transition-all duration-300 hover:scale-110"
              :class="isFavorite(4) ? 'fa-solid fa-heart text-red-500' : 'fa-regular fa-heart text-white'"></i>
          </div>

          <div class="absolute bottom-4 left-4">
            <span
              class="bg-white/90 backdrop-blur-sm text-blue-500 text-xs font-semibold px-2.5 py-1 rounded-full shadow-md">
              🧊 Ice Only
            </span>
          </div>
        </div>

        <div class="p-5">
          <h3 class="font-primary text-xl font-bold text-gray-800 mb-2 group-hover:text-amber-700 transition-colors">
            Cold Brew
          </h3>
          <p class="font-secondary text-gray-500 text-sm leading-relaxed mb-4">
            Kopi seduh dingin 12 jam, smooth dan low acid.
          </p>

          <div class="flex items-center justify-between pt-3 border-t border-gray-100">
            <div class="flex flex-col">
              <span class="font-primary text-2xl font-bold text-amber-700">Rp 35.000</span>
              <span class="font-secondary text-xs text-gray-400">/ cup</span>
            </div>

            <button data-modal-target="product-modal-4" data-modal-toggle="product-modal-4"
              class="inline-flex items-center gap-2 bg-amber-50 hover:bg-amber-600 text-amber-700 hover:text-white font-semibold py-2 px-4 rounded-lg transition-all duration-300 group/btn">
              <span>Lihat</span>
              <i class="fas fa-arrow-right text-sm group-hover/btn:translate-x-1 transition-transform"></i>
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Toast Notification -->
    <div x-cloak x-show="toastVisible" x-transition:enter="transition ease-out duration-300"
      x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
      x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0"
      x-transition:leave-end="opacity-0 translate-y-2"
      class="fixed bottom-6 left-1/2 transform -translate-x-1/2 z-50">
      <div
        class="bg-gray-800 text-white px-5 py-3 rounded-full shadow-lg flex items-center gap-2 text-sm font-medium backdrop-blur-sm">
        <i class="fas"
          :class="toastMsg?.includes('Ditambahkan') ? 'fa-heart text-red-500' : 'fa-times-circle text-gray-400'"></i>
        <span x-text="toastMsg"></span>
      </div>
    </div>

    <!-- View All Button -->
    <div class="text-center mt-12" data-aos="fade-up">
      <a href="#"
        class="inline-flex items-center gap-2 bg-amber-700 hover:bg-amber-800 text-white font-semibold py-3 px-8 rounded-lg transition-all duration-300 shadow-md hover:shadow-lg group">
        <span>Lihat Semua Menu</span>
        <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
      </a>
    </div>
  </div>
</section>

<!-- Flowbite Modals untuk Detail Produk -->
<!-- Modal 1 -->
<div id="product-modal-1" tabindex="-1"
  class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
  <div class="relative p-4 w-full max-w-2xl max-h-full">
    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
      <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
        <h3 class="font-primary text-xl font-semibold text-gray-900 dark:text-white">Lungo Coffee</h3>
        <button type="button"
          class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
          data-modal-hide="product-modal-1">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <div class="p-4 md:p-5">
        <div class="flex flex-col md:flex-row gap-4">
          <div class="md:w-1/2">
            <img src="https://placehold.co/600x400/78350f/ffffff?text=Lungo+Coffee" alt="Lungo Coffee"
              class="rounded-lg w-full h-full object-cover">
          </div>
          <div class="md:w-1/2">
            <h4 class="font-primary text-lg font-bold text-gray-800 mb-2">Detail Produk</h4>
            <p class="font-secondary text-gray-600 text-sm mb-4">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et
              dolore magna aliqua.
            </p>
            <div class="space-y-2">
              <div class="flex items-center gap-2">
                <i class="fas fa-mug-hot text-amber-600"></i>
                <span class="font-secondary text-sm text-gray-600">Kategori: Espresso</span>
              </div>
              <div class="flex items-center gap-2">
                <i class="fas fa-fire text-amber-600"></i>
                <span class="font-secondary text-sm text-gray-600">Kalori: 120 kcal</span>
              </div>
              <div class="flex items-center gap-2">
                <i class="fas fa-temperature-high text-amber-600"></i>
                <span class="font-secondary text-sm text-gray-600">Suhu: Panas / Dingin</span>
              </div>
            </div>
            <div class="mt-4 pt-4 border-t">
              <span class="font-primary text-2xl font-bold text-amber-700">Rp 30.000</span>
            </div>
            <button
              class="mt-4 w-full bg-amber-600 hover:bg-amber-700 text-white font-semibold py-2 px-4 rounded-lg transition-all duration-300">
              <i class="fas fa-shopping-cart mr-2"></i>
              Tambah ke Keranjang
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal 2 -->
<div id="product-modal-2" tabindex="-1"
  class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
  <div class="relative p-4 w-full max-w-2xl max-h-full">
    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
      <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
        <h3 class="font-primary text-xl font-semibold text-gray-900 dark:text-white">Iced Americano</h3>
        <button type="button"
          class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
          data-modal-hide="product-modal-2">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <div class="p-4 md:p-5">
        <div class="flex flex-col md:flex-row gap-4">
          <div class="md:w-1/2">
            <img src="https://placehold.co/600x400/92400e/ffffff?text=Iced+Coffee" alt="Iced Americano"
              class="rounded-lg w-full h-full object-cover">
          </div>
          <div class="md:w-1/2">
            <h4 class="font-primary text-lg font-bold text-gray-800 mb-2">Detail Produk</h4>
            <p class="font-secondary text-gray-600 text-sm mb-4">
              Kesegaran espresso dengan es batu, cocok untuk cuaca panas.
            </p>
            <div class="space-y-2">
              <div class="flex items-center gap-2">
                <i class="fas fa-mug-hot text-amber-600"></i>
                <span class="font-secondary text-sm text-gray-600">Kategori: Espresso</span>
              </div>
              <div class="flex items-center gap-2">
                <i class="fas fa-fire text-amber-600"></i>
                <span class="font-secondary text-sm text-gray-600">Kalori: 85 kcal</span>
              </div>
              <div class="flex items-center gap-2">
                <i class="fas fa-temperature-high text-amber-600"></i>
                <span class="font-secondary text-sm text-gray-600">Suhu: Dingin</span>
              </div>
            </div>
            <div class="mt-4 pt-4 border-t">
              <span class="font-primary text-2xl font-bold text-amber-700">Rp 28.000</span>
            </div>
            <button
              class="mt-4 w-full bg-amber-600 hover:bg-amber-700 text-white font-semibold py-2 px-4 rounded-lg transition-all duration-300">
              <i class="fas fa-shopping-cart mr-2"></i>
              Tambah ke Keranjang
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal 3 -->
<div id="product-modal-3" tabindex="-1"
  class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
  <div class="relative p-4 w-full max-w-2xl max-h-full">
    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
      <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
        <h3 class="font-primary text-xl font-semibold text-gray-900 dark:text-white">Matcha Latte</h3>
        <button type="button"
          class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
          data-modal-hide="product-modal-3">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <div class="p-4 md:p-5">
        <div class="flex flex-col md:flex-row gap-4">
          <div class="md:w-1/2">
            <img src="https://placehold.co/600x400/b45309/ffffff?text=Matcha+Latte" alt="Matcha Latte"
              class="rounded-lg w-full h-full object-cover">
          </div>
          <div class="md:w-1/2">
            <h4 class="font-primary text-lg font-bold text-gray-800 mb-2">Detail Produk</h4>
            <p class="font-secondary text-gray-600 text-sm mb-4">
              Matcha premium dengan susu segar, creamy dan menenangkan.
            </p>
            <div class="space-y-2">
              <div class="flex items-center gap-2">
                <i class="fas fa-mug-hot text-amber-600"></i>
                <span class="font-secondary text-sm text-gray-600">Kategori: Non-Coffee</span>
              </div>
              <div class="flex items-center gap-2">
                <i class="fas fa-fire text-amber-600"></i>
                <span class="font-secondary text-sm text-gray-600">Kalori: 150 kcal</span>
              </div>
              <div class="flex items-center gap-2">
                <i class="fas fa-temperature-high text-amber-600"></i>
                <span class="font-secondary text-sm text-gray-600">Suhu: Panas / Dingin</span>
              </div>
            </div>
            <div class="mt-4 pt-4 border-t">
              <span class="font-primary text-2xl font-bold text-amber-700">Rp 32.000</span>
            </div>
            <button
              class="mt-4 w-full bg-amber-600 hover:bg-amber-700 text-white font-semibold py-2 px-4 rounded-lg transition-all duration-300">
              <i class="fas fa-shopping-cart mr-2"></i>
              Tambah ke Keranjang
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal 4 -->
<div id="product-modal-4" tabindex="-1"
  class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
  <div class="relative p-4 w-full max-w-2xl max-h-full">
    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
      <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
        <h3 class="font-primary text-xl font-semibold text-gray-900 dark:text-white">Cold Brew</h3>
        <button type="button"
          class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
          data-modal-hide="product-modal-4">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <div class="p-4 md:p-5">
        <div class="flex flex-col md:flex-row gap-4">
          <div class="md:w-1/2">
            <img src="https://placehold.co/600x400/d97706/ffffff?text=Cold+Brew" alt="Cold Brew"
              class="rounded-lg w-full h-full object-cover">
          </div>
          <div class="md:w-1/2">
            <h4 class="font-primary text-lg font-bold text-gray-800 mb-2">Detail Produk</h4>
            <p class="font-secondary text-gray-600 text-sm mb-4">
              Kopi seduh dingin 12 jam, smooth dan low acid.
            </p>
            <div class="space-y-2">
              <div class="flex items-center gap-2">
                <i class="fas fa-mug-hot text-amber-600"></i>
                <span class="font-secondary text-sm text-gray-600">Kategori: Manual Brew</span>
              </div>
              <div class="flex items-center gap-2">
                <i class="fas fa-fire text-amber-600"></i>
                <span class="font-secondary text-sm text-gray-600">Kalori: 5 kcal</span>
              </div>
              <div class="flex items-center gap-2">
                <i class="fas fa-temperature-high text-amber-600"></i>
                <span class="font-secondary text-sm text-gray-600">Suhu: Dingin</span>
              </div>
            </div>
            <div class="mt-4 pt-4 border-t">
              <span class="font-primary text-2xl font-bold text-amber-700">Rp 35.000</span>
            </div>
            <button
              class="mt-4 w-full bg-amber-600 hover:bg-amber-700 text-white font-semibold py-2 px-4 rounded-lg transition-all duration-300">
              <i class="fas fa-shopping-cart mr-2"></i>
              Tambah ke Keranjang
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>