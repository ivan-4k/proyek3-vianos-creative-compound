<section id="hero" class="relative h-screen flex items-center text-white px-4 sm:px-6 md:px-8 lg:px-12 xl:px-[8%]">
  <!-- Background Image dengan overlay -->
  <picture>
    <source srcset="/images/default/herobg.webp" type="image/webp">
    <img src="/images/default/herobg.png" class="absolute inset-0 w-full h-full object-cover" fetchpriority="high"
      alt="Hero Background">
  </picture>

  <!-- KONTEN HERO -->
  <div class="relative z-10 w-full text-center">
    <!-- Judul Utama -->
    <h1 class="font-primary text-3xl sm:text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-bold leading-tight mb-4"
      data-aos="fade-down">
      Temukan Kopi<br>
      Favoritmu Hari Ini
    </h1>

    <!-- Deskripsi -->
    <p class="font-secondary text-base sm:text-lg md:text-xl text-white/90 max-w-2xl mx-auto mb-8 leading-relaxed"
      data-aos="fade-down" data-aos-delay="150">
      Dari espresso klasik hingga signature latte, semua diracik dari biji kopi<br>
      pilihan dengan rasa yang konsisten di setiap tegukan.
    </p>

    <!-- Search Bar -->
    <div class="relative max-w-md mx-auto" data-aos="fade-down" data-aos-delay="300">
      <input type="text" placeholder="Search for..."
        class="font-secondary w-full bg-white/20 backdrop-blur-sm rounded-full py-3 px-5 pr-12 text-white placeholder-white/70 focus:outline-none focus:ring-2 focus:ring-[#BC430D] focus:bg-white/30 transition-all border border-white/30">
      <button
        class="absolute right-2 top-1/2 -translate-y-1/2 bg-[#BC430D] hover:bg-[#9e370b] transition rounded-full w-8 h-8 flex items-center justify-center">
        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
        </svg>
      </button>
    </div>
  </div>
  <!-- AKHIR KONTEN HERO -->

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
