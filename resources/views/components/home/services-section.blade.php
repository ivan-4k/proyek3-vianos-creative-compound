<section
  class="py-12 sm:py-16 lg:py-20 relative overflow-hidden bg-white home-section-title pb-10 sm:px-6 md:px-8 lg:px-12 xl:px-[8%] px-4">
  {{-- Header --}}
  <div class="container mx-auto relative z-10">
    {{-- Header dengan Flowbite --}}
    <div class="text-center mb-10 sm:mb-12 md:mb-16" data-aos="fade-up">
      <h2 class="font-semibold mb-3 relative inline-block text-3xl md:text-4xl font-primary text-[#4A2C1A]">
        Layanan Kami
      </h2>
      <p class="text-base sm:text-lg md:text-xl text-gray-600 font-secondary max-w-3xl mx-auto px-4 sm:px-0">
        Nikmati pengalaman terbaik bersama kami dengan berbagai layanan unggulan
      </p>
    </div>

    {{-- Services Grid dengan Flowbite Tooltip --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8 lg:gap-10 transition-all duration-300">

      {{-- Service 1: Kopi Berkualitas dengan Tooltip --}}
      <div
        class="group bg-gradient-to-br from-white to-gray-50 rounded-2xl p-6 sm:p-8 shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100 hover:border-[#BC430D]/20"
        data-aos="fade-up" data-aos-delay="100" data-tooltip-target="tooltip-coffee" data-tooltip-placement="top">

        {{-- Icon dengan Flowbite Badge --}}
        <div class="mb-5 sm:mb-6 relative">
          <div
            class="w-16 h-16 sm:w-20 sm:h-20 bg-[#BC430D]/10 rounded-2xl flex items-center justify-center group-hover:bg-[#BC430D] transition-colors duration-300">
            <i
              class="fa-solid fa-mug-hot text-3xl sm:text-4xl text-[#BC430D] group-hover:text-white transition-colors duration-300"></i>
          </div>
          {{-- Flowbite Badge --}}
          <span class="absolute -top-2 -right-2 bg-[#BC430D] text-white text-xs px-2 py-0.5 rounded-full">
            Best
          </span>
        </div>

        {{-- Title --}}
        <h4
          class="text-xl sm:text-2xl font-bold text-[#4A2C1A] mb-3 sm:mb-4 font-primary group-hover:text-[#BC430D] transition-colors duration-300">
          Kopi Berkualitas
        </h4>

        {{-- Description --}}
        <p class="text-sm sm:text-base text-gray-600 leading-relaxed font-secondary">
          Biji kopi pilihan dari petani lokal dan internasional, dipanggang dengan sempurna untuk menghasilkan cita rasa
          terbaik.
        </p>

        {{-- Decorative Line --}}
        <div class="mt-5 sm:mt-6 w-12 h-0.5 bg-[#BC430D]/30 group-hover:w-20 transition-all duration-300"></div>
      </div>

      {{-- Flowbite Tooltip Content --}}
      <div id="tooltip-coffee" role="tooltip"
        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white bg-[#4A2C1A] rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip">
        Kopi pilihan terbaik dari biji berkualitas
        <div class="tooltip-arrow" data-popper-arrow></div>
      </div>

      {{-- Service 2: Menu Lengkap --}}
      <div
        class="group bg-gradient-to-br from-white to-gray-50 rounded-2xl p-6 sm:p-8 shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100 hover:border-[#BC430D]/20"
        data-aos="fade-up" data-aos-delay="200">

        {{-- Icon --}}
        <div class="mb-5 sm:mb-6">
          <div
            class="w-16 h-16 sm:w-20 sm:h-20 bg-[#BC430D]/10 rounded-2xl flex items-center justify-center group-hover:bg-[#BC430D] transition-colors duration-300">
            <i
              class="fa-solid fa-utensils text-3xl sm:text-4xl text-[#BC430D] group-hover:text-white transition-colors duration-300"></i>
          </div>
        </div>

        {{-- Title --}}
        <h4
          class="text-xl sm:text-2xl font-bold text-[#4A2C1A] mb-3 sm:mb-4 font-primary group-hover:text-[#BC430D] transition-colors duration-300">
          Menu Lengkap
        </h4>

        {{-- Description --}}
        <p class="text-sm sm:text-base text-gray-600 leading-relaxed font-secondary mb-4 sm:mb-5">
          Dari kopi spesialti, minuman segar, pastry, hingga hidangan utama yang menggugah selera.
        </p>

        {{-- Link dengan Flowbite Modal Trigger --}}
        <button
          class="inline-flex items-center gap-2 text-[#BC430D] font-medium text-sm sm:text-base hover:gap-3 transition-all duration-300 group/link">
          Selengkapnya
          <i
            class="fa-solid fa-arrow-right text-xs transition-transform duration-300 group-hover/link:translate-x-1"></i>
        </button>

        {{-- Decorative Line --}}
        <div class="mt-4 w-12 h-0.5 bg-[#BC430D]/30 group-hover:w-20 transition-all duration-300"></div>
      </div>

      {{-- Service 3: Wi-fi Gratis dengan Flowbite Rating --}}
      <div
        class="group bg-gradient-to-br from-white to-gray-50 rounded-2xl p-6 sm:p-8 shadow-sm hover:shadow-md transition-all duration-300 border border-gray-100 hover:border-[#BC430D]/20"
        data-aos="fade-up" data-aos-delay="300">

        {{-- Icon dengan Flowbite Rating --}}
        <div class="mb-5 sm:mb-6">
          <div
            class="w-16 h-16 sm:w-20 sm:h-20 bg-[#BC430D]/10 rounded-2xl flex items-center justify-center group-hover:bg-[#BC430D] transition-colors duration-300">
            <i
              class="fa-solid fa-wifi text-3xl sm:text-4xl text-[#BC430D] group-hover:text-white transition-colors duration-300"></i>
          </div>
        </div>

        {{-- Title --}}
        <h4
          class="text-xl sm:text-2xl font-bold text-[#4A2C1A] mb-3 sm:mb-4 font-primary group-hover:text-[#BC430D] transition-colors duration-300">
          Wi-fi Gratis
        </h4>

        {{-- Description --}}
        <p class="text-sm sm:text-base text-gray-600 leading-relaxed font-secondary">
          Nikmati koneksi internet cepat dan stabil di seluruh area kafe, cocok untuk bekerja atau bersantai.
        </p>

        {{-- Flowbite Rating --}}
        <div class="flex items-center mt-3">
          <div class="flex items-center space-x-1 rtl:space-x-reverse">
            <i class="fa-solid fa-wifi text-xs text-[#BC430D]"></i>
            <i class="fa-solid fa-wifi text-xs text-[#BC430D]"></i>
            <i class="fa-solid fa-wifi text-xs text-[#BC430D]"></i>
            <i class="fa-solid fa-wifi text-xs text-[#BC430D]"></i>
            <i class="fa-solid fa-wifi text-xs text-gray-300"></i>
          </div>
          <span class="ml-2 text-xs text-gray-500">Kecepatan Tinggi</span>
        </div>

        {{-- Decorative Line --}}
        <div class="mt-4 w-12 h-0.5 bg-[#BC430D]/30 group-hover:w-20 transition-all duration-300"></div>
      </div>
    </div>
  </div>
</section>
