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
        Sedang <span class="text-amber-700">Populer Saat Ini</span>
      </h2>
      <p class="font-secondary text-gray-500 mt-3 max-w-xl mx-auto text-base md:text-lg">
        Direkomedasikan secara cerdas berdasarkan tren dan preferensi pelanggan!
      </p>
    </div>


    <!-- Featured Menu dengan Flexbox -->
    <div class="flex flex-wrap justify-center gap-6 md:gap-8">
      <!-- Menu Item 1 -->
      <div
        class="flex-1 min-w-[280px] max-w-[320px] group bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden"
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
        class="flex-1 min-w-[280px] max-w-[320px] group bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden"
        data-aos="fade-up" data-aos-delay="200">
        <div class="relative overflow-hidden h-48">
          <img src="https://placehold.co/600x400/92400e/ffffff?text=Lungo+Coffee" alt="Lungo Coffee"
            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">

          <!-- Icon Love/Favorite dengan Alpine.js -->
          <div class="absolute top-4 right-4 z-20" @click.stop="toggleFavorite(2)">
            <i class="text-2xl drop-shadow-lg cursor-pointer transition-all duration-300 hover:scale-110"
              :class="isFavorite(2) ? 'fa-solid fa-heart text-red-500' : 'fa-regular fa-heart text-white'"></i>
          </div>

          <div class="absolute top-4 left-4">
            <span class="bg-amber-600 text-white text-xs font-semibold px-2.5 py-1 rounded-full shadow-md">
              Best Seller
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
        class="flex-1 min-w-[280px] max-w-[320px] group bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden"
        data-aos="fade-up" data-aos-delay="300">
        <div class="relative overflow-hidden h-48">
          <img src="https://placehold.co/600x400/b45309/ffffff?text=Lungo+Coffee" alt="Lungo Coffee"
            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">

          <!-- Icon Love/Favorite dengan Alpine.js -->
          <div class="absolute top-4 right-4 z-20" @click.stop="toggleFavorite(3)">
            <i class="text-2xl drop-shadow-lg cursor-pointer transition-all duration-300 hover:scale-110"
              :class="isFavorite(3) ? 'fa-solid fa-heart text-red-500' : 'fa-regular fa-heart text-white'"></i>
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
        class="flex-1 min-w-[280px] max-w-[320px] group bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden"
        data-aos="fade-up" data-aos-delay="400">
        <div class="relative overflow-hidden h-48">
          <img src="https://placehold.co/600x400/d97706/ffffff?text=Lungo+Coffee" alt="Lungo Coffee"
            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">

          <!-- Icon Love/Favorite dengan Alpine.js -->
          <div class="absolute top-4 right-4 z-20" @click.stop="toggleFavorite(4)">
            <i class="text-2xl drop-shadow-lg cursor-pointer transition-all duration-300 hover:scale-110"
              :class="isFavorite(4) ? 'fa-solid fa-heart text-red-500' : 'fa-regular fa-heart text-white'"></i>
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
  </div>
</section>

<!-- Flowbite Modals untuk Detail Produk (tetap sama) -->
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
        <h3 class="font-primary text-xl font-semibold text-gray-900 dark:text-white">Lungo Coffee</h3>
        <button type="button"
          class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
          data-modal-hide="product-modal-2">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <div class="p-4 md:p-5">
        <div class="flex flex-col md:flex-row gap-4">
          <div class="md:w-1/2">
            <img src="https://placehold.co/600x400/92400e/ffffff?text=Lungo+Coffee" alt="Lungo Coffee"
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

<!-- Modal 3 -->
<div id="product-modal-3" tabindex="-1"
  class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
  <div class="relative p-4 w-full max-w-2xl max-h-full">
    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
      <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
        <h3 class="font-primary text-xl font-semibold text-gray-900 dark:text-white">Lungo Coffee</h3>
        <button type="button"
          class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
          data-modal-hide="product-modal-3">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <div class="p-4 md:p-5">
        <div class="flex flex-col md:flex-row gap-4">
          <div class="md:w-1/2">
            <img src="https://placehold.co/600x400/b45309/ffffff?text=Lungo+Coffee" alt="Lungo Coffee"
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

<!-- Modal 4 -->
<div id="product-modal-4" tabindex="-1"
  class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
  <div class="relative p-4 w-full max-w-2xl max-h-full">
    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
      <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
        <h3 class="font-primary text-xl font-semibold text-gray-900 dark:text-white">Lungo Coffee</h3>
        <button type="button"
          class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
          data-modal-hide="product-modal-4">
          <i class="fas fa-times"></i>
        </button>
      </div>
      <div class="p-4 md:p-5">
        <div class="flex flex-col md:flex-row gap-4">
          <div class="md:w-1/2">
            <img src="https://placehold.co/600x400/d97706/ffffff?text=Lungo+Coffee" alt="Lungo Coffee"
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
