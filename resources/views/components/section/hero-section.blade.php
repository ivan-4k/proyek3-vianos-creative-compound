<section id="hero"
  class="relative h-screen flex items-center text-white px-4 sm:px-6 md:px-8 lg:px-12 xl:px-[8%] hero-overlay">
  <!-- Background Image dengan overlay -->
  <div class="absolute inset-0 bg-cover bg-center bg-no-repeat"
    style="background-image: url('images/default/herobg.png'); background-position: 60% center;">
  </div>

  <!-- Konten -->
  <div
    class="relative z-10 w-full lg:w-1/2 hero-content text-center lg:text-left flex flex-col items-center lg:items-start">
    <h1 class="text-5xl lg:text-7xl font-bold mb-4 text-white font-primary" data-aos="fade-down">
      SEVEN COFFEE
    </h1>

    <p class="text-lg lg:text-xl mb-3 leading-relaxed text-white/90 font-secondary" data-aos="fade-right"
      style="animation-delay: 200ms">
      Nikmati kopi terbaik dengan suasana nyaman di Seven Coffee Indramayu.
    </p>

    <p class="text-lg lg:text-xl mb-6 leading-relaxed text-white/90 font-secondary" data-aos="fade-right"
      style="animation-delay: 400ms">
      Tempat nongkrong asik untuk bersantai, bekerja, dan menikmati kopi pilihan.
    </p>

    <!-- BUTTON GROUP dengan Flowbite -->
    <div class="flex flex-wrap gap-4" data-aos="fade-up" style="animation-delay: 600ms">
      <!-- Button 1 -->
      <div class="flowbite-border-animation">
        <a href="#paling-laris" data-tooltip-target="menu-tooltip"
          class="text-white bg-[#BC430D] hover:bg-[#a3370b] focus:ring-4 focus:ring-[#BC430D]/50 font-medium rounded-lg text-base px-6 py-3.5 text-center inline-flex items-center shadow-lg transition-all duration-300 hover:scale-105">
          <i class="fa-solid fa-cart-shopping mr-2"></i>
          Jelajahi Menu
        </a>
      </div>

      <!-- Tooltip -->
      <div id="menu-tooltip" role="tooltip"
        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
        Lihat menu terbaru kami!
        <div class="tooltip-arrow" data-popper-arrow></div>
      </div>

      <!-- Button 2 -->
      <div class="flowbite-border-animation">
        <a href="#"
          class="text-white bg-transparent hover:bg-[#BC430D] border-2 border-[#BC430D] focus:ring-4 focus:ring-[#BC430D]/50 font-medium rounded-lg text-base px-6 py-3.5 text-center inline-flex items-center shadow-lg transition-all duration-300 hover:scale-105">
          <i class="fa-solid fa-circle-info mr-2"></i>
          Cerita Kami
        </a>
      </div>
    </div>
  </div>

  <!-- Wave -->
  <div class="absolute bottom-0 left-0 w-full z-3">
    <div class="absolute inset-x-0 bottom-full flex justify-center">
      <svg class="w-full h-auto" viewBox="0 0 1440 145" preserveAspectRatio="xMidYMid meet">
        <g transform="translate(0.000000,145.000000) scale(0.100000,-0.100000)" fill="#BC430D" stroke="none">
          <path
            d="M8340 1444 c-343 -30 -643 -83 -1308 -229 -1208 -265 -1499 -282 -2832 -165 -683 60 -978 73 -1321 59 -770 -31 -1508 -193 -2802 -615 l-77 -26 0 -234 0 -234 7200 0 7200 0 0 570 c0 330 -4 570 -9 570 -5 0 -166 -25 -357 -55 -876 -137 -1271 -172 -1868 -162 -572 9 -891 54 -1681 238 -692 161 -1012 224 -1335 265 -128 16 -690 28 -810 18z" />
        </g>
      </svg>
    </div>
  </div>
</section>