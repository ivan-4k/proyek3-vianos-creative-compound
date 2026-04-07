{{-- Menu Unggulan Section --}}
<section
  class="py-12 sm:py-16 lg:py-20 bg-[#BC430D] relative overflow-hidden home-section-title sm:px-6 md:px-8 lg:px-12 xl:px-[8%] px-4">
  <div class="absolute inset-0 z-0 flex items-start justify-start pointer-events-none rotate-45 mt-20 overflow-hidden">
    <picture>
      <source srcset="{{ asset('images/default/paper-plane.webp') }}" type="image/webp">
      <img src="{{ asset('images/default/paper-plane.png') }}" alt="" aria-hidden="true"
        class="w-2/3 h-full object-cover object-left-top" loading="lazy" decoding="async" />
    </picture>
  </div>
  {{-- Content --}}
  <div class="container mx-auto relative z-10">
    <div class="text-center mb-3" data-aos="fade-up">
      <h2 class="text-3xl md:text-4xl font-semibold text-white mb-3 font-primary">
        Menu Unggulan
      </h2>
      <p class="text-lg md:text-xl text-white/90 font-secondary">
        Favorit banyak orang, wajib kamu coba
      </p>
    </div>

    {{-- Card Grid - 3 columns --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto">
      {{-- Card 1: Cloud Seven dengan Alpine.js untuk toggle heart --}}
      <div x-data="{ isFavorite: false }"
        class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 overflow-hidden group cursor-pointer relative"
        data-aos="fade-right">
        <div class="relative">
          <img class="w-full h-64 object-cover rounded-t-lg transition-transform duration-300 group-hover:scale-110"
            src="{{ asset('images/default/bg1.webp') }}" alt="Cloud Seven" loading="lazy" decoding="async" />

          {{-- Heart Icon yang bisa diklik --}}
          <div class="absolute top-4 right-4 z-20" @click.stop="isFavorite = !isFavorite">
            <i class="fa-regular fa-heart text-2xl text-white drop-shadow-lg cursor-pointer transition-all duration-300 hover:scale-110"
              :class="{ 'fa-solid text-red-500': isFavorite, 'fa-regular text-white': !isFavorite }"></i>
          </div>

          <div
            class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6">
            <h5 class="mb-3 text-2xl font-bold tracking-tight text-white">
              Cloud Seven
            </h5>

            <button type="button"
              class="text-white bg-[#BC430D] hover:bg-[#a3370b] focus:ring-4 focus:ring-[#BC430D]/50 font-medium rounded-lg text-sm px-5 py-3 text-center inline-flex items-center w-fit transition-all duration-300">
              Detail
              <i class="fa-solid fa-arrow-right ms-3"></i>
            </button>
          </div>
        </div>
      </div>

      {{-- Card 2: Caramel Macchiato dengan Alpine.js untuk toggle heart --}}
      <div x-data="{ isFavorite: false }"
        class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 overflow-hidden group cursor-pointer relative"
        data-aos="fade-up">
        <div class="relative">
          <img class="w-full h-64 object-cover rounded-t-lg transition-transform duration-300 group-hover:scale-110"
            src="{{ asset('images/default/bg1.webp') }}" alt="Caramel Macchiato" loading="lazy" decoding="async" />

          {{-- Heart Icon yang bisa diklik --}}
          <div class="absolute top-4 right-4 z-20" @click.stop="isFavorite = !isFavorite">
            <i class="fa-regular fa-heart text-2xl text-white drop-shadow-lg cursor-pointer transition-all duration-300 hover:scale-110"
              :class="{ 'fa-solid text-red-500': isFavorite, 'fa-regular text-white': !isFavorite }"></i>
          </div>

          <div
            class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6">
            <h5 class="mb-3 text-2xl font-bold tracking-tight text-white">
              Caramel Macchiato
            </h5>

            <button type="button"
              class="text-white bg-[#BC430D] hover:bg-[#a3370b] focus:ring-4 focus:ring-[#BC430D]/50 font-medium rounded-lg text-sm px-5 py-3 text-center inline-flex items-center w-fit transition-all duration-300">
              Detail
              <i class="fa-solid fa-arrow-right ms-3"></i>
            </button>
          </div>
        </div>
      </div>

      {{-- Card 3: Tiramisu Cake dengan Alpine.js untuk toggle heart --}}
      <div x-data="{ isFavorite: false }"
        class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 overflow-hidden group cursor-pointer relative"
        data-aos="fade-left">
        <div class="relative">
          <img class="w-full h-64 object-cover rounded-t-lg transition-transform duration-300 group-hover:scale-110"
            src="{{ asset('images/default/bg1.webp') }}" alt="Tiramisu Cake" loading="lazy" decoding="async" />

          {{-- Heart Icon yang bisa diklik --}}
          <div class="absolute top-4 right-4 z-20" @click.stop="isFavorite = !isFavorite">
            <i class="fa-regular fa-heart text-2xl text-white drop-shadow-lg cursor-pointer transition-all duration-300 hover:scale-110"
              :class="{ 'fa-solid text-red-500': isFavorite, 'fa-regular text-white': !isFavorite }"></i>
          </div>

          <div
            class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6">
            <h5 class="mb-3 text-2xl font-bold tracking-tight text-white">
              Tiramisu Cake
            </h5>

            <button type="button"
              class="text-white bg-[#BC430D] hover:bg-[#a3370b] focus:ring-4 focus:ring-[#BC430D]/50 font-medium rounded-lg text-sm px-5 py-3 text-center inline-flex items-center w-fit transition-all duration-300">
              Detail
              <i class="fa-solid fa-arrow-right ms-3"></i>
            </button>
          </div>
        </div>
      </div>
    </div>

    {{-- Flowbite Button Lihat Semua --}}
    <div class="flex justify-center items-center mt-12">
      <button type="button"
        class="text-white bg-[#BC430D] focus:ring-4 focus:ring-[#BC430D]/50 font-medium rounded-lg text-sm px-8 py-3 text-center border-2 border-white shadow-lg transition-all duration-300 hover:bg-white hover:text-[#BC430D]">
        Lihat Semua Menu
        <i class="fa-solid fa-arrow-right ms-3"></i>
      </button>
    </div>
  </div>
</section>
