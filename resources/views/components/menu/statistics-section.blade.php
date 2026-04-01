<section
  class="py-12 sm:py-16 lg:py-20 relative overflow-hidden home-section-title sm:px-6 md:px-8 lg:px-12 xl:px-[8%] px-4 text-white font-secondary bg-gradient-to-br from-amber-50 via-white to-amber-50">
  {{-- Header --}}
  <div class="container mx-auto relative">
    <!-- Header dengan Flowbite -->
    <div class="text-center mb-3" data-aos="fade-up">
      <h2 class="font-semibold mb-3 relative inline-block text-3xl md:text-4xl font-primary text-gray-900">
        Dipercaya <span class="text-amber-700">Banyak Pelanggan</span>
      </h2>
      <p class="text-gray-600 font-secondary text-lg md:text-xl">
        Dari jumlah menu hingga kepuasan pelanggan, semuanya kami jaga dengan konsisten.
      </p>
    </div>

    <!-- Stats dengan Flexbox -->
    <div class="flex flex-wrap justify-center gap-6 md:gap-8">
      <!-- Stat 1 -->
      <div
        class="flex-1 min-w-[200px] max-w-[280px] text-center p-6 bg-white rounded-2xl shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100"
        data-aos="fade-up" data-aos-delay="100" data-tooltip-target="tooltip-produk" data-tooltip-placement="bottom">
        <i class="fas fa-mug-hot text-4xl text-amber-600 mb-3"></i>
        <div class="text-4xl md:text-5xl font-black text-amber-700 mb-2">50+</div>
        <div class="font-secondary text-lg font-semibold text-gray-800">Produk</div>
        <p class="font-secondary text-sm text-gray-500 mt-1">Pilihan menu lengkap</p>
      </div>
      <!-- Tooltip -->
      <div id="tooltip-produk" role="tooltip"
        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
        Lebih dari 50 pilihan menu tersedia
        <div class="tooltip-arrow" data-popper-arrow></div>
      </div>

      <!-- Stat 2 -->
      <div
        class="flex-1 min-w-[200px] max-w-[280px] text-center p-6 bg-white rounded-2xl shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100"
        data-aos="fade-up" data-aos-delay="200" data-tooltip-target="tooltip-kategori" data-tooltip-placement="bottom">
        <i class="fas fa-tags text-4xl text-amber-600 mb-3"></i>
        <div class="text-4xl md:text-5xl font-black text-amber-700 mb-2">10+</div>
        <div class="font-secondary text-lg font-semibold text-gray-800">Kategori</div>
        <p class="font-secondary text-sm text-gray-500 mt-1">Espresso, Non-Coffee, & banyak lagi</p>
      </div>
      <!-- Tooltip -->
      <div id="tooltip-kategori" role="tooltip"
        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
        10+ kategori minuman untuk semua selera
        <div class="tooltip-arrow" data-popper-arrow></div>
      </div>

      <!-- Stat 3 -->
      <div
        class="flex-1 min-w-[200px] max-w-[280px] text-center p-6 bg-white rounded-2xl shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100"
        data-aos="fade-up" data-aos-delay="300" data-tooltip-target="tooltip-cangkir" data-tooltip-placement="bottom">
        <i class="fas fa-coffee text-4xl text-amber-600 mb-3"></i>
        <div class="text-4xl md:text-5xl font-black text-amber-700 mb-2">1.000+</div>
        <div class="font-secondary text-lg font-semibold text-gray-800">Cangkir Disajikan</div>
        <p class="font-secondary text-sm text-gray-500 mt-1">Setiap bulan</p>
      </div>
      <!-- Tooltip -->
      <div id="tooltip-cangkir" role="tooltip"
        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
        Lebih dari 1000 cangkir setiap bulan
        <div class="tooltip-arrow" data-popper-arrow></div>
      </div>

      <!-- Stat 4 -->
      <div
        class="flex-1 min-w-[200px] max-w-[280px] text-center p-6 bg-white rounded-2xl shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100"
        data-aos="fade-up" data-aos-delay="400" data-tooltip-target="tooltip-biji" data-tooltip-placement="bottom">
        <i class="fas fa-seedling text-4xl text-amber-600 mb-3"></i>
        <div class="text-4xl md:text-5xl font-black text-amber-700 mb-2">100%</div>
        <div class="font-secondary text-lg font-semibold text-gray-800">Biji Kopi Pilihan</div>
        <p class="font-secondary text-sm text-gray-500 mt-1">Single origin & fair trade</p>
      </div>
      <!-- Tooltip -->
      <div id="tooltip-biji" role="tooltip"
        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
        100% biji kopi pilihan berkualitas
        <div class="tooltip-arrow" data-popper-arrow></div>
      </div>
    </div>

    <!-- Gallery Grid dengan Flowbite Lightbox (tetap menggunakan grid untuk gallery) -->
    <div class="mt-16">
      <h3 class="font-primary text-2xl font-bold text-center text-gray-800 mb-8" data-aos="fade-up">
        Galeri <span class="text-amber-700">Kopi Kami</span>
      </h3>

      <div class="flex flex-wrap justify-center gap-4" data-aos="fade-up">
        <!-- Gallery Item 1 - menggunakan Flowbite Modal -->
        <div class="relative group cursor-pointer w-[calc(50%-8px)] md:w-[calc(25%-12px)] min-w-[160px] max-w-[280px]"
          data-modal-target="gallery-modal-1" data-modal-toggle="gallery-modal-1" data-aos="fade-up"
          data-aos-delay="100">
          <img src="/images/default/herobg.webp" alt="Espresso"
            class="rounded-lg w-full h-48 object-cover transition-transform group-hover:scale-105 duration-300">
          <div
            class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-300 rounded-lg flex items-center justify-center">
            <i class="fas fa-search-plus text-white text-2xl opacity-0 group-hover:opacity-100 transition-opacity"></i>
          </div>
        </div>

        <!-- Gallery Item 2 -->
        <div class="relative group cursor-pointer w-[calc(50%-8px)] md:w-[calc(25%-12px)] min-w-[160px] max-w-[280px]"
          data-modal-target="gallery-modal-2" data-modal-toggle="gallery-modal-2" data-aos="fade-up"
          data-aos-delay="200">
          <img src="/images/default/herobg.webp" alt="Latte"
            class="rounded-lg w-full h-48 object-cover transition-transform group-hover:scale-105 duration-300">
          <div
            class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-300 rounded-lg flex items-center justify-center">
            <i class="fas fa-search-plus text-white text-2xl opacity-0 group-hover:opacity-100 transition-opacity"></i>
          </div>
        </div>

        <!-- Gallery Item 3 -->
        <div class="relative group cursor-pointer w-[calc(50%-8px)] md:w-[calc(25%-12px)] min-w-[160px] max-w-[280px]"
          data-modal-target="gallery-modal-3" data-modal-toggle="gallery-modal-3" data-aos="fade-up"
          data-aos-delay="300">
          <img src="/images/default/herobg.webp" alt="Non-Coffee"
            class="rounded-lg w-full h-48 object-cover transition-transform group-hover:scale-105 duration-300">
          <div
            class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-300 rounded-lg flex items-center justify-center">
            <i class="fas fa-search-plus text-white text-2xl opacity-0 group-hover:opacity-100 transition-opacity"></i>
          </div>
        </div>

        <!-- Gallery Item 4 -->
        <div class="relative group cursor-pointer w-[calc(50%-8px)] md:w-[calc(25%-12px)] min-w-[160px] max-w-[280px]"
          data-modal-target="gallery-modal-4" data-modal-toggle="gallery-modal-4" data-aos="fade-up"
          data-aos-delay="400">
          <img src="/images/default/herobg.webp" alt="Coffee Beans"
            class="rounded-lg w-full h-48 object-cover transition-transform group-hover:scale-105 duration-300">
          <div
            class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all duration-300 rounded-lg flex items-center justify-center">
            <i class="fas fa-search-plus text-white text-2xl opacity-0 group-hover:opacity-100 transition-opacity"></i>
          </div>
        </div>
      </div>
    </div>

    <!-- Flowbite Modals untuk Gallery (tetap sama) -->
    <!-- Modal 1 -->
    <div id="gallery-modal-1" tabindex="-1"
      class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
      <div class="relative p-4 w-full max-w-4xl max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
          <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Espresso</h3>
            <button type="button"
              class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
              data-modal-hide="gallery-modal-1">
              <i class="fas fa-times"></i>
            </button>
          </div>
          <div class="p-4 md:p-5">
            <img src="/images/default/herobg.webp" alt="Espresso" class="rounded-lg w-full">
            <p class="mt-4 text-gray-600 dark:text-gray-300">Espresso murni dengan aroma yang kuat dan aftertaste yang
              panjang. Cocok untuk penikmat kopi sejati.</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal 2 -->
    <div id="gallery-modal-2" tabindex="-1"
      class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
      <div class="relative p-4 w-full max-w-4xl max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
          <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Latte</h3>
            <button type="button"
              class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
              data-modal-hide="gallery-modal-2">
              <i class="fas fa-times"></i>
            </button>
          </div>
          <div class="p-4 md:p-5">
            <img src="/images/default/herobg.webp" alt="Latte" class="rounded-lg w-full">
            <p class="mt-4 text-gray-600 dark:text-gray-300">Perpaduan sempurna antara espresso dan susu dengan tekstur
              creamy yang lembut dan foam yang cantik.</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal 3 -->
    <div id="gallery-modal-3" tabindex="-1"
      class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
      <div class="relative p-4 w-full max-w-4xl max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
          <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Non-Coffee</h3>
            <button type="button"
              class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
              data-modal-hide="gallery-modal-3">
              <i class="fas fa-times"></i>
            </button>
          </div>
          <div class="p-4 md:p-5">
            <img src="/images/default/herobg.webp" alt="Non-Coffee" class="rounded-lg w-full">
            <p class="mt-4 text-gray-600 dark:text-gray-300">Alternatif segar tanpa kopi, cocok untuk kamu yang ingin
              menikmati minuman dengan rasa unik dan menyegarkan.</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal 4 -->
    <div id="gallery-modal-4" tabindex="-1"
      class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
      <div class="relative p-4 w-full max-w-4xl max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
          <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Biji Kopi Pilihan</h3>
            <button type="button"
              class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
              data-modal-hide="gallery-modal-4">
              <i class="fas fa-times"></i>
            </button>
          </div>
          <div class="p-4 md:p-5">
            <img src="/images/default/herobg.webp" alt="Coffee Beans" class="rounded-lg w-full">
            <p class="mt-4 text-gray-600 dark:text-gray-300">100% biji kopi pilihan single origin yang dipetik langsung
              dari perkebunan terbaik di Indonesia.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
