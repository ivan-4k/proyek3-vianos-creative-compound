<section id="about-hero" class="w-full pt-24 md:pt-20 pb-8 px-4 sm:px-6 lg:px-12 flex justify-center">
  <div
    class="relative w-full max-w-7xl h-[400px] sm:h-[500px] md:h-[600px] rounded-[2rem] sm:rounded-[2.5rem] overflow-hidden shadow-2xl flex items-center justify-center">

    <picture class="absolute inset-0 w-full h-full">
      <source srcset="/images/default/herobg.webp" type="image/webp">
      <img src="/images/default/herobg.png" class="w-full h-full object-cover" fetchpriority="high" alt="Hero Background">
    </picture>
    <div class="absolute inset-0 bg-black/40"></div>

    <div class="relative z-10 text-center px-4 sm:px-6 max-w-3xl flex flex-col items-center">

      <h1
        class="font-primary text-3xl sm:text-4xl md:text-5xl lg:text-6xl text-white font-bold mb-4 sm:mb-5 leading-tight tracking-wide"
        data-aos="fade-up" data-aos-duration="800">
        Lebih dari Sekadar<br>Secangkir Kopi
      </h1>

      <p class="font-secondary text-sm sm:text-base md:text-lg text-white/90 mb-6 sm:mb-8 max-w-xl mx-auto leading-relaxed"
        data-aos="fade-up" data-aos-delay="150" data-aos-duration="800">
        Kami percaya setiap tegukan punya cerita. Dari biji kopi pilihan hingga racikan terbaik, semua disajikan untuk
        menemani harimu.
      </p>

      <div data-aos="fade-up" data-aos-delay="300" data-aos-duration="800">
        <a href="{{ route('menu.index') }}"
          class="font-secondary inline-flex items-center justify-center px-6 sm:px-8 py-3 sm:py-3.5 bg-white text-gray-900 hover:text-[#BC430D] rounded-full transition-all duration-300 hover:scale-105 hover:bg-gray-50 shadow-lg text-sm sm:text-base font-medium focus:ring-4 focus:ring-white/50">
          Lihat Menu
          <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
          </svg>
        </a>
      </div>

    </div>
  </div>
</section>
