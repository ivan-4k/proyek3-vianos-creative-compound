<section
  class="py-12 sm:py-16 lg:py-20 bg-[#BC430D] relative overflow-hidden home-section-title sm:px-6 md:px-8 lg:px-12 xl:px-[8%] px-4 text-white font-secondary">

  <!-- Background -->
  <div class="absolute inset-0 opacity-20 pointer-events-none">
    <div
      class="absolute top-0 left-0 w-72 h-72 bg-[radial-gradient(circle,_#fff_1px,_transparent_1px)] bg-[length:20px_20px]">
    </div>
  </div>

  <!-- Header -->
  <div class="text-center max-w-2xl mx-auto mb-12" data-aos="fade-down">
    <h2 class="font-semibold mb-3 relative inline-block text-3xl md:text-4xl font-primary">
      Jelajahi Kategori
    </h2>
    <p class="text-orange-100 font-secondary text-lg md:text-xl">
      Temukan berbagai pilihan kopi dan minuman sesuai mood dan waktu kamu.
    </p>
  </div>

  <!-- Cards - Flexbox -->
  <div class="flex flex-wrap justify-center gap-6 md:gap-8 max-w-6xl mx-auto px-4">
    
    <!-- Espresso -->
    <div class="flex-1 min-w-[280px] max-w-[320px] rounded-2xl shadow-lg hover:scale-[1.02] transition-transform duration-300" 
      data-aos="fade-up">
      <div class="bg-white rounded-xl p-4">
        <img src="/images/default/herobg.webp" class="rounded-lg w-full h-48 object-cover mb-4" alt="Espresso coffee">

        <h3 class="text-xl font-bold text-gray-800 font-primary">Espresso</h3>
        <p class="text-gray-600 text-sm mt-1 mb-4">
          Lorem ipsum dolor sit amet, consectetur adipisicing elit.
        </p>

        <button data-tooltip-target="tooltip-espresso"
          class="w-full bg-[#4b0d06] hover:bg-[#2e0804] text-white py-2 rounded-lg text-sm font-semibold flex items-center justify-center gap-2 transition-colors duration-200">
          <i class="fas fa-mug-hot"></i>
          Lihat
        </button>

        <!-- Tooltip -->
        <div id="tooltip-espresso" role="tooltip"
          class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-gray-900 rounded-lg shadow-sm opacity-0 transition-opacity duration-200 tooltip">
          Lihat menu Espresso
          <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
      </div>
    </div>

    <!-- Non Coffee -->
    <div class="flex-1 min-w-[280px] max-w-[320px] rounded-2xl shadow-lg hover:scale-[1.02] transition-transform duration-300" 
      data-aos="fade-up" data-aos-delay="100">
      <div class="bg-white rounded-xl p-4">
        <img src="/images/default/herobg.webp" class="rounded-lg w-full h-48 object-cover mb-4" alt="Non-coffee drink">

        <h3 class="text-xl font-bold text-gray-800 font-primary">Non-Coffee</h3>
        <p class="text-gray-600 text-sm mt-1 mb-4">
          Lorem ipsum dolor sit amet, consectetur adipisicing elit.
        </p>

        <button data-tooltip-target="tooltip-non"
          class="w-full bg-[#4b0d06] hover:bg-[#2e0804] text-white py-2 rounded-lg text-sm font-semibold flex items-center justify-center gap-2 transition-colors duration-200">
          <i class="fas fa-leaf"></i>
          Lihat
        </button>

        <!-- Tooltip -->
        <div id="tooltip-non" role="tooltip"
          class="absolute z-10 invisible px-3 py-2 text-sm text-white bg-gray-900 rounded-lg opacity-0 transition-opacity duration-200 tooltip">
          Minuman segar non-coffee
          <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
      </div>
    </div>

    <!-- Latte -->
    <div class="flex-1 min-w-[280px] max-w-[320px] rounded-2xl shadow-lg hover:scale-[1.02] transition-transform duration-300" 
      data-aos="fade-up" data-aos-delay="200">
      <div class="bg-white rounded-xl p-4">
        <img src="/images/default/herobg.webp" class="rounded-lg w-full h-48 object-cover mb-4" alt="Latte coffee">

        <h3 class="text-xl font-bold text-gray-800 font-primary">Latte</h3>
        <p class="text-gray-600 text-sm mt-1 mb-4">
          Lorem ipsum dolor sit amet, consectetur adipisicing elit.
        </p>

        <button data-tooltip-target="tooltip-latte"
          class="w-full bg-[#4b0d06] hover:bg-[#2e0804] text-white py-2 rounded-lg text-sm font-semibold flex items-center justify-center gap-2 transition-colors duration-200">
          <i class="fas fa-coffee"></i>
          Lihat
        </button>

        <!-- Tooltip -->
        <div id="tooltip-latte" role="tooltip"
          class="absolute z-10 invisible px-3 py-2 text-sm text-white bg-gray-900 rounded-lg opacity-0 transition-opacity duration-200 tooltip">
          Menu latte creamy
          <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
      </div>
    </div>
  </div>
</section>