<section
  class="py-12 sm:py-16 lg:py-20 text-center overflow-hidden bg-white home-section-title pb-10 sm:px-6 md:px-8 lg:px-12 xl:px-[8%] px-4">

  {{-- Header Section --}}
  <div class="container mx-auto text-center relative z-10 mb-3" data-aos="fade-down">
    <h2 class="font-semibold mb-3 relative inline-block text-3xl md:text-4xl font-primary text-gray-800 ">
      Banyak Spot Menarik Disini
    </h2>
    <p class="text-gray-600 font-secondary mx-auto text-lg md:text-xl">
      Jelajahi berbagai sudut caffee yang nyaman, estetik, dan instagramable
    </p>
  </div>

  {{-- Gallery Layout --}}
  <div class="container mx-auto">

    {{-- Mobile Version (grid 2 kolom) --}}
    <div class="grid grid-cols-2 gap-4 lg:hidden">
      {{-- Kolom Kiri Mobile --}}
      <div class="flex flex-col gap-4">
        <figure class="text-center group cursor-pointer" data-aos="fade-right">
          <a href="{{ asset('images/highlight/indoor.jpg') }}"
            class="block overflow-hidden rounded-lg shadow-lg hover:shadow-xl transition-all duration-300">
            <img src="{{ asset('images/highlight/indoor.jpg') }}" alt="Mini"
              class="w-full aspect-square object-cover transition-transform duration-300 group-hover:scale-105"
              loading="lazy" decoding="async">
          </a>
          <figcaption class="mt-2 font-semibold text-gray-700">Indoor</figcaption>
        </figure>
        <figure class="text-center group cursor-pointer" data-aos="fade-right">
          <a href="{{ asset('images/highlight/instagramable.jpg') }}"
            class="block overflow-hidden rounded-lg shadow-lg hover:shadow-xl transition-all duration-300">
            <img src="{{ asset('images/highlight/instagramable.jpg') }}" alt="Besar"
              class="w-full aspect-square object-cover transition-transform duration-300 group-hover:scale-105"
              loading="lazy" decoding="async">
          </a>
          <figcaption class="mt-2 font-semibold text-gray-700">Instagramable</figcaption>
        </figure>
      </div>

      {{-- Kolom Kanan Mobile --}}
      <div class="flex flex-col gap-4">
        <figure class="text-center group cursor-pointer" data-aos="fade-left">
          <a href="{{ asset('images/highlight/outdoor.jpg') }}"
            class="block overflow-hidden rounded-lg shadow-lg hover:shadow-xl transition-all duration-300">
            <img src="{{ asset('images/highlight/outdoor.jpg') }}" alt="Sedang"
              class="w-full aspect-square object-cover transition-transform duration-300 group-hover:scale-105"
              loading="lazy" decoding="async">
          </a>
          <figcaption class="mt-2 font-semibold text-gray-700">Outdoor</figcaption>
        </figure>
        <figure class="text-center group cursor-pointer" data-aos="fade-left">
          <a href="{{ asset('images/highlight/area-kerja.jpg') }}"
            class="block overflow-hidden rounded-lg shadow-lg hover:shadow-xl transition-all duration-300">
            <img src="{{ asset('images/highlight/area-kerja.jpg') }}" alt="Ekstra Besar"
              class="w-full aspect-square object-cover transition-transform duration-300 group-hover:scale-105"
              loading="lazy" decoding="async">
          </a>
          <figcaption class="mt-2 font-semibold text-gray-700">Area Kerja</figcaption>
        </figure>
      </div>

      {{-- Gambar Koleksi di Mobile (full width) --}}
      <div class="col-span-2 mt-4">
        <figure class="text-center group cursor-pointer w-full" data-aos="fade-up">
          <a href="{{ asset('images/highlight/suasana.jpg') }}"
            class="block overflow-hidden rounded-lg shadow-lg hover:shadow-xl transition-all duration-300">
            <img src="{{ asset('images/highlight/suasana.jpg') }}" alt="Koleksi"
              class="w-full aspect-[4/5] object-cover transition-transform duration-300 group-hover:scale-105"
              loading="lazy" decoding="async">
          </a>
          <figcaption class="mt-2 font-semibold text-gray-700">Suasana Utama Caffee</figcaption>
        </figure>
      </div>
    </div>

    {{-- Desktop Version (grid 4 kolom dengan CSS Grid spesifik) --}}
    <div class="hidden lg:block">
      <div class="desktop-grid">
        {{-- div1: Mini --}}
        <div class="desktop-grid-item area-1">
          <figure class="text-center group cursor-pointer h-full" data-aos="fade-right">
            <a href="{{ asset('images/highlight/indoor.jpg') }}"
              class="block overflow-hidden rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 h-full">
              <img src="{{ asset('images/highlight/indoor.jpg') }}" alt="Mini"
                class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                loading="lazy" decoding="async">
            </a>
            <figcaption class="mt-2 font-semibold text-gray-700">Indoor</figcaption>
          </figure>
        </div>

        {{-- div2: Sedang --}}
        <div class="desktop-grid-item area-2">
          <figure class="text-center group cursor-pointer h-full" data-aos="fade-left">
            <a href="{{ asset('images/highlight/outdoor.jpg') }}"
              class="block overflow-hidden rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 h-full">
              <img src="{{ asset('images/highlight/outdoor.jpg') }}" alt="Sedang"
                class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                loading="lazy" decoding="async">
            </a>
            <figcaption class="mt-2 font-semibold text-gray-700">Outdoor</figcaption>
          </figure>
        </div>

        {{-- div3: Besar --}}
        <div class="desktop-grid-item area-3">
          <figure class="text-center group cursor-pointer h-full" data-aos="fade-right">
            <a href="{{ asset('images/highlight/instagramable.jpg') }}"
              class="block overflow-hidden rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 h-full">
              <img src="{{ asset('images/highlight/instagramable.jpg') }}" alt="Besar"
                class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                loading="lazy" decoding="async">
            </a>
            <figcaption class="mt-2 font-semibold text-gray-700">Instagramable</figcaption>
          </figure>
        </div>

        {{-- div4: Ekstra Besar --}}
        <div class="desktop-grid-item area-4">
          <figure class="text-center group cursor-pointer h-full" data-aos="fade-left">
            <a href="{{ asset('images/highlight/area-kerja.jpg') }}"
              class="block overflow-hidden rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 h-full">
              <img src="{{ asset('images/highlight/area-kerja.jpg') }}" alt="Ekstra Besar"
                class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                loading="lazy" decoding="async">
            </a>
            <figcaption class="mt-2 font-semibold text-gray-700">Area Kerja</figcaption>
          </figure>
        </div>

        {{-- div5: Koleksi (gambar besar) --}}
        <div class="desktop-grid-item area-5">
          <figure class="text-center group cursor-pointer h-full" data-aos="fade-up">
            <a href="{{ asset('images/highlight/suasana.jpg') }}"
              class="block overflow-hidden rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 h-full">
              <img src="{{ asset('images/highlight/suasana.jpg') }}" alt="Koleksi"
                class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                loading="lazy" decoding="async">
            </a>
            <figcaption class="mt-2 font-semibold text-gray-700">Suasana Utama Caffee</figcaption>
          </figure>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- Custom CSS untuk Desktop Grid --}}
<style>
  .desktop-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    grid-template-rows: repeat(2, 1fr);
    gap: 20px;
    min-height: 600px;
  }

  .area-1 {
    grid-area: 1 / 1 / 2 / 2;
  }

  .area-2 {
    grid-area: 1 / 2 / 2 / 3;
  }

  .area-3 {
    grid-area: 2 / 1 / 3 / 2;
  }

  .area-4 {
    grid-area: 2 / 2 / 3 / 3;
  }

  .area-5 {
    grid-area: 1 / 3 / 3 / 5;
  }


  .desktop-grid-item {
    width: 100%;
    height: 100%;
  }

  .desktop-grid-item figure,
  .desktop-grid-item a {
    height: 100%;
    display: flex;
    flex-direction: column;
  }

  .desktop-grid-item img {
    flex: 1;
    min-height: 0;
    width: 100%;
    height: calc(100% - 40px);
    object-fit: cover;
  }

  @media (max-width: 1023px) {
    .desktop-grid {
      display: none;
    }
  }
</style>

{{-- Tambahkan CSS untuk PhotoSwipe --}}
<style>
  .pswp__img {
    border-radius: 8px;
  }
</style>
