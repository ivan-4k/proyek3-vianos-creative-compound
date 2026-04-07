<section
  class="py-12 sm:py-16 lg:py-20 relative overflow-hidden text-center home-section-title bg-[#965015] sm:px-6 md:px-8 lg:px-12 xl:px-[8%] px-4">
  {{-- Header --}}
  <div class="container mx-auto text-center relative z-10">
    <div class="text-center mb-8 md:mb-12" data-aos="fade-up">
      <h2 class="font-semibold mb-3 relative inline-block text-3xl md:text-4xl font-primary text-white">
        Signature Menu
      </h2>
      <p class="text-[#FFE1C6] text-lg md:text-xl font-secondary">
        Tempat Di Mana Setiap Cangkir Kopi Membawa Cerita Baru
      </p>
    </div>

    {{-- Flex Container: Slider Produk dan Story --}}
    <div class="flex flex-col lg:flex-row gap-8 lg:gap-14 items-start max-w-7xl mx-auto">

      {{-- KOLOM KIRI: Slider Produk dengan Swiper JS --}}
      <div class="w-full lg:w-1/2 relative mb-4 lg:mb-0" data-aos="fade-right">
        <div class="swiper mySwiper overflow-hidden relative w-full">
          <div class="swiper-wrapper">
            {{-- Slide 1: Cappuccino --}}
            <div class="swiper-slide">
              <div
                class="bg-white/95 backdrop-blur-sm border border-white/20 rounded-2xl p-6 sm:p-8 lg:p-5 h-auto min-h-[380px] sm:min-h-[420px] md:min-h-[480px] lg:min-h-[490px] flex flex-col justify-between shadow-xl">
                <div class="space-y-4 sm:space-y-5 lg:space-y-6 h-full flex flex-col">
                  <!-- Gambar -->
                  <div
                    class="w-20 h-20 sm:w-24 sm:h-24 lg:w-28 lg:h-28 bg-[#FFE1C6] rounded-full mx-auto overflow-hidden border-4 border-[#BC430D]/30">
                    <img src="{{ asset('images/default/herobg.png') }}" alt="Cappuccino" class="w-full h-full object-cover"
                      loading="lazy" decoding="async">
                  </div>

                  <!-- Judul dan Harga -->
                  <div class="text-center border-b border-[#965015]/20 pb-4 sm:pb-5 lg:pb-6">
                    <h4 class="text-2xl sm:text-2xl lg:text-3xl font-bold text-[#4A2C1A] font-primary mb-2 sm:mb-3">
                      Cappuccino
                    </h4>
                    <span
                      class="text-xl sm:text-2xl lg:text-3xl font-bold text-[#BC430D] bg-[#BC430D]/10 px-4 sm:px-6 lg:px-8 py-1 sm:py-2 lg:py-2 rounded-full inline-block">
                      Rp 30.000
                    </span>
                  </div>

                  <!-- Deskripsi -->
                  <p
                    class="text-sm sm:text-base lg:text-base text-[#4A2C1A]/80 leading-relaxed font-secondary text-center line-clamp-3 lg:px-0 flex-grow">
                    Espresso berkelas berpadu dengan susu creamy dan busa halus,
                    menciptakan cappuccino yang jadi favorit banyak orang.
                  </p>

                  <!-- Tombol -->
                  <div class="pt-4 sm:pt-1 text-center mt-auto">
                    <button type="button"
                      class="text-white bg-[#BC430D] hover:bg-[#8B2E0A] focus:ring-4 focus:ring-[#FFE1C6]/50 font-medium rounded-lg text-sm sm:text-base lg:text-base px-4 sm:px-6 lg:px-8 py-2 sm:py-3 lg:py-3 text-center inline-flex items-center gap-2 sm:gap-3 transition-all duration-300 shadow-lg hover:shadow-xl group w-full sm:w-auto justify-center">
                      Pesan Sekarang
                      <i
                        class="fa-solid fa-arrow-right transition-transform duration-300 group-hover:translate-x-2 text-xs sm:text-sm"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>

            {{-- Slide 2: Latte --}}
            <div class="swiper-slide">
              <div
                class="bg-white/95 backdrop-blur-sm border border-white/20 rounded-2xl p-6 sm:p-8 lg:p-5 h-auto min-h-[380px] sm:min-h-[420px] md:min-h-[480px] lg:min-h-[490px] flex flex-col justify-between shadow-xl">
                <div class="space-y-4 sm:space-y-5 lg:space-y-6 h-full flex flex-col">
                  <!-- Gambar -->
                  <div
                    class="w-20 h-20 sm:w-24 sm:h-24 lg:w-28 lg:h-28 bg-[#FFE1C6] rounded-full mx-auto overflow-hidden border-4 border-[#BC430D]/30">
                    <img src="{{ asset('images/default/herobg.png') }}" alt="Latte" class="w-full h-full object-cover"
                      loading="lazy" decoding="async">
                  </div>

                  <!-- Judul dan Harga -->
                  <div class="text-center border-b border-[#965015]/20 pb-4 sm:pb-5 lg:pb-6">
                    <h4 class="text-2xl sm:text-2xl lg:text-3xl font-bold text-[#4A2C1A] font-primary mb-2 sm:mb-3">
                      Latte
                    </h4>
                    <span
                      class="text-xl sm:text-2xl lg:text-3xl font-bold text-[#BC430D] bg-[#BC430D]/10 px-4 sm:px-6 lg:px-8 py-1 sm:py-2 lg:py-2 rounded-full inline-block">
                      Rp 32.000
                    </span>
                  </div>

                  <!-- Deskripsi -->
                  <p
                    class="text-sm sm:text-base lg:text-base text-[#4A2C1A]/80 leading-relaxed font-secondary text-center line-clamp-3 lg:px-0 flex-grow">
                    Perpaduan sempurna antara espresso dan susu steamed dengan foam tipis,
                    menghasilkan rasa yang creamy dan lembut di setiap tegukan.
                  </p>

                  <!-- Tombol -->
                  <div class="pt-4 sm:pt-1 text-center mt-auto">
                    <button type="button"
                      class="text-white bg-[#BC430D] hover:bg-[#8B2E0A] focus:ring-4 focus:ring-[#FFE1C6]/50 font-medium rounded-lg text-sm sm:text-base lg:text-base px-4 sm:px-6 lg:px-8 py-2 sm:py-3 lg:py-3 text-center inline-flex items-center gap-2 sm:gap-3 transition-all duration-300 shadow-lg hover:shadow-xl group w-full sm:w-auto justify-center">
                      Pesan Sekarang
                      <i
                        class="fa-solid fa-arrow-right transition-transform duration-300 group-hover:translate-x-2 text-xs sm:text-sm"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>

            {{-- Slide 3: Espresso --}}
            <div class="swiper-slide">
              <div
                class="bg-white/95 backdrop-blur-sm border border-white/20 rounded-2xl p-6 sm:p-8 lg:p-5 h-auto min-h-[380px] sm:min-h-[420px] md:min-h-[480px] lg:min-h-[490px] flex flex-col justify-between shadow-xl">
                <div class="space-y-4 sm:space-y-5 lg:space-y-6 h-full flex flex-col">
                  <!-- Gambar -->
                  <div
                    class="w-20 h-20 sm:w-24 sm:h-24 lg:w-28 lg:h-28 bg-[#FFE1C6] rounded-full mx-auto overflow-hidden border-4 border-[#BC430D]/30">
                    <img src="{{ asset('images/default/herobg.png') }}" alt="Espresso" class="w-full h-full object-cover"
                      loading="lazy" decoding="async">
                  </div>

                  <!-- Judul dan Harga -->
                  <div class="text-center border-b border-[#965015]/20 pb-4 sm:pb-5 lg:pb-6">
                    <h4 class="text-2xl sm:text-2xl lg:text-3xl font-bold text-[#4A2C1A] font-primary mb-2 sm:mb-3">
                      Espresso
                    </h4>
                    <span
                      class="text-xl sm:text-2xl lg:text-3xl font-bold text-[#BC430D] bg-[#BC430D]/10 px-4 sm:px-6 lg:px-8 py-1 sm:py-2 lg:py-2 rounded-full inline-block">
                      Rp 25.000
                    </span>
                  </div>

                  <!-- Deskripsi -->
                  <p
                    class="text-sm sm:text-base lg:text-base text-[#4A2C1A]/80 leading-relaxed font-secondary text-center line-clamp-3 lg:px-0 flex-grow">
                    Ekstraksi sempurna dari biji kopi pilihan menghasilkan espresso
                    dengan crema tebal dan rasa yang kuat namun seimbang.
                  </p>

                  <!-- Tombol -->
                  <div class="pt-4 sm:pt-1 text-center mt-auto">
                    <button type="button"
                      class="text-white bg-[#BC430D] hover:bg-[#8B2E0A] focus:ring-4 focus:ring-[#FFE1C6]/50 font-medium rounded-lg text-sm sm:text-base lg:text-base px-4 sm:px-6 lg:px-8 py-2 sm:py-3 lg:py-3 text-center inline-flex items-center gap-2 sm:gap-3 transition-all duration-300 shadow-lg hover:shadow-xl group w-full sm:w-auto justify-center">
                      Pesan Sekarang
                      <i
                        class="fa-solid fa-arrow-right transition-transform duration-300 group-hover:translate-x-2 text-xs sm:text-sm"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>

          {{-- Pagination/Indicators --}}
          <div class="swiper-pagination !relative !bottom-0 mt-4 sm:mt-6"></div>

          {{-- Navigation Buttons dengan Font Awesome --}}
          <button class="swiper-nav-btn swiper-nav-prev">
            <i class="fa-solid fa-chevron-left"></i>
          </button>
          <button class="swiper-nav-btn swiper-nav-next">
            <i class="fa-solid fa-chevron-right"></i>
          </button>
        </div>
      </div>

      {{-- KOLOM KANAN: Story Statis --}}
      <div
        class="w-full lg:w-1/2 bg-white/95 backdrop-blur-sm p-6 sm:p-8 lg:p-10 rounded-2xl sm:rounded-3xl shadow-xl h-fit lg:sticky lg:top-24 border border-white/20"
        data-aos="fade-left">
        <div class="mb-4 sm:mb-6">
          <i class="fa-solid fa-quote-left text-3xl sm:text-4xl text-[#BC430D]/40"></i>
        </div>

        <h4
          class="text-xl sm:text-xl lg:text-2xl font-semibold text-[#4A2C1A]/90 mb-4 sm:mb-6 font-primary leading-tight">
          Tempat Di Mana Setiap Cangkir Kopi Membawa Cerita Baru
        </h4>

        <p class="text-sm sm:text-base lg:text-lg text-[#4A2C1A]/80 leading-relaxed mb-6 sm:mb-8 font-secondary">
          Seven adalah tempat di mana rasa, suasana, dan cerita bertemu dalam satu ruang.
          Dengan konsep modern namun tetap hangat, kafe ini menghadirkan pengalaman ngopi
          yang lebih dari sekadar minum kopi.
        </p>

        <div class="flex flex-wrap gap-2 sm:gap-3 pt-4 border-t border-[#965015]/20 justify-center sm:justify-start">
          <span
            class="bg-[#BC430D]/10 text-[#BC430D] text-xs sm:text-sm font-medium px-3 sm:px-4 py-1.5 sm:py-2 rounded-full whitespace-nowrap backdrop-blur-sm">✨
            Suasana Hangat</span>
          <span
            class="bg-[#BC430D]/10 text-[#BC430D] text-xs sm:text-sm font-medium px-3 sm:px-4 py-1.5 sm:py-2 rounded-full whitespace-nowrap backdrop-blur-sm">☕
            Kopi Berkualitas</span>
          <span
            class="bg-[#BC430D]/10 text-[#BC430D] text-xs sm:text-sm font-medium px-3 sm:px-4 py-1.5 sm:py-2 rounded-full whitespace-nowrap backdrop-blur-sm">🏠
            Konsep Modern</span>
        </div>
      </div>
    </div>
  </div>
</section>