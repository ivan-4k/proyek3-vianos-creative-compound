@props(['totalMenus' => 35])

@php
  $aboutFeatures = [
      [
          'icon' => 'fa-mug-hot',
          'title' => 'Kopi Berkualitas',
          'desc' => 'Biji kopi pilihan dari petani lokal dan internasional, dipanggang dengan sempurna.',
      ],
      [
          'icon' => 'fa-utensils',
          'title' => $totalMenus . '+ Menu Pilihan',
          'desc' => 'Kopi spesialti, minuman segar, pastry, hingga hidangan utama.',
      ],
      [
          'icon' => 'fa-wifi',
          'title' => 'Wi-Fi Gratis',
          'desc' => 'Koneksi internet cepat dan stabil di seluruh area kafe.',
      ],
      [
          'icon' => 'fa-face-smile',
          'title' => 'Layanan Ramah',
          'desc' => 'Tim profesional yang siap melayani dengan senyuman dan keramahan.',
      ],
      [
          'icon' => 'fa-tree',
          'title' => 'Suasana Hangat',
          'desc' => 'Ruang nyaman dengan desain interior yang menenangkan.',
      ],
  ];
@endphp

<section
  class="py-12 sm:py-16 lg:py-24 relative overflow-hidden text-center home-section-title bg-gradient-to-br from-[#965015] to-[#783E0E] sm:px-6 md:px-8 lg:px-12 xl:px-[8%] px-4">

  <div class="container mx-auto relative z-10">

    <div class="text-center mb-10 sm:mb-12 md:mb-16" data-aos="fade-up">
      <div
        class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-md text-white text-sm font-bold px-4 py-1.5 rounded-full mb-4 shadow-sm border border-white/20 font-secondary tracking-wide">
        <i class="fa-solid fa-heart text-amber-300 text-xs" aria-hidden="true"></i>
        <span>Tentang Kami</span>
      </div>
      <h2 class="font-bold mb-4 text-3xl md:text-4xl font-primary text-white tracking-wide">
        Mengenal Kami Lebih Dekat
      </h2>
      <p
        class="text-base sm:text-lg md:text-xl text-amber-100/90 font-secondary max-w-3xl mx-auto px-4 sm:px-0 leading-relaxed">
        Tempat di mana setiap cangkir kopi menjadi cerita, dan setiap kunjungan menjadi kenangan.
      </p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-14 items-center text-left">

      <div data-aos="fade-right" data-aos-duration="800">
        <div class="space-y-6">
          <p class="text-amber-50/90 leading-relaxed text-base sm:text-lg font-secondary text-justify sm:text-left">
            Kami hadir sebagai <span class="text-amber-300 font-bold font-primary">ruang nyaman</span> bagi setiap
            pengunjung yang ingin menikmati kopi berkualitas, hidangan beragam, dan suasana hangat. Dengan lebih dari
            <span class="text-amber-300 font-bold font-primary">{{ $totalMenus }} pilihan menu</span>, kami
            berkomitmen menghadirkan
            cita rasa terbaik yang diracik dari bahan pilihan.
          </p>

          <p class="text-amber-50/90 leading-relaxed text-base sm:text-lg font-secondary text-justify sm:text-left">
            Selain itu, kami menyediakan fasilitas modern seperti <span
              class="text-amber-300 font-bold font-primary">Wi-Fi gratis</span> agar setiap kunjungan tidak hanya
            menyenangkan, tetapi juga produktif. Filosofi kami
            sederhana: menyajikan pengalaman kafe yang lengkap—mulai dari secangkir kopi yang sempurna, hidangan yang
            memanjakan selera, hingga layanan yang ramah dan profesional.
          </p>

          <div class="flex flex-wrap gap-3 pt-4 justify-center sm:justify-start">
            <div
              class="flex items-center gap-2 bg-white/10 backdrop-blur-md px-4 py-2 rounded-xl border border-white/20 font-secondary shadow-sm hover:bg-white/20 transition-colors cursor-default">
              <i class="fa-solid fa-check-circle text-amber-300 text-sm" aria-hidden="true"></i>
              <span class="text-sm font-medium text-white">{{ $totalMenus }}+ Menu Pilihan</span>
            </div>
            <div
              class="flex items-center gap-2 bg-white/10 backdrop-blur-md px-4 py-2 rounded-xl border border-white/20 font-secondary shadow-sm hover:bg-white/20 transition-colors cursor-default">
              <i class="fa-solid fa-wifi text-amber-300 text-sm" aria-hidden="true"></i>
              <span class="text-sm font-medium text-white">Wi-Fi Gratis</span>
            </div>
            <div
              class="flex items-center gap-2 bg-white/10 backdrop-blur-md px-4 py-2 rounded-xl border border-white/20 font-secondary shadow-sm hover:bg-white/20 transition-colors cursor-default">
              <i class="fa-solid fa-mug-hot text-amber-300 text-sm" aria-hidden="true"></i>
              <span class="text-sm font-medium text-white">Kopi Berkualitas</span>
            </div>
            <div
              class="flex items-center gap-2 bg-white/10 backdrop-blur-md px-4 py-2 rounded-xl border border-white/20 font-secondary shadow-sm hover:bg-white/20 transition-colors cursor-default">
              <i class="fa-solid fa-face-smile text-amber-300 text-sm" aria-hidden="true"></i>
              <span class="text-sm font-medium text-white">Layanan Ramah</span>
            </div>
          </div>

          <div class="pt-6 text-center sm:text-left">
            <a href="{{ route('about') }}"
              class="inline-flex items-center gap-3 bg-white hover:bg-amber-50 text-[#965015] font-bold px-8 py-3.5 rounded-full transition-all duration-300 shadow-xl hover:shadow-2xl hover:-translate-y-1 group font-secondary">
              <span>Cerita Lengkap Kami</span>
              <div class="w-6 h-6 rounded-full bg-[#965015]/10 flex items-center justify-center">
                <i class="fa-solid fa-arrow-right text-sm transition-transform duration-300 group-hover:translate-x-1"
                  aria-hidden="true"></i>
              </div>
            </a>
          </div>
        </div>
      </div>

      {{-- SISI KANAN: SWIPER SLIDER --}}
      <div data-aos="fade-left" data-aos-duration="800" data-aos-delay="200">
        <div class="relative px-2 pb-8">

          <div class="swiper mySwiper rounded-3xl overflow-hidden shadow-2xl border border-white/10 group/swiper">
            <div class="swiper-wrapper">

              @foreach ($aboutFeatures as $feature)
                <div class="swiper-slide">
                  <div
                    class="relative bg-white/5 backdrop-blur-xl h-full group-hover/swiper:bg-white/10 transition-colors duration-500">
                    <div class="aspect-[4/3] relative">
                      <div class="absolute inset-0 bg-gradient-to-t from-[#3E1E04]/80 via-[#3E1E04]/20 to-transparent">
                      </div>

                      <div class="absolute inset-0 flex flex-col items-center justify-center p-8 text-center">
                        <div
                          class="w-20 h-20 sm:w-24 sm:h-24 bg-white rounded-3xl shadow-2xl flex items-center justify-center mb-6 transform -rotate-3 hover:rotate-0 transition-transform duration-300">
                          <i class="fa-solid {{ $feature['icon'] }} text-4xl sm:text-5xl text-[#965015]"
                            aria-hidden="true"></i>
                        </div>
                        <h4 class="text-xl sm:text-2xl font-bold text-white font-primary mb-3">{{ $feature['title'] }}
                        </h4>
                        <p class="text-sm sm:text-base text-amber-50/90 font-secondary max-w-xs leading-relaxed">
                          {{ $feature['desc'] }}
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach

            </div>

            {{-- TOMBOL NAVIGASI SWIPER --}}
            <button aria-label="Previous Slide"
              class="swiper-nav-prev absolute left-4 top-1/2 -translate-y-1/2 z-10 w-10 h-10 bg-white/20 backdrop-blur-md hover:bg-white rounded-full flex items-center justify-center transition-all duration-300 text-white hover:text-[#965015] shadow-lg border border-white/30">
              <i class="fa-solid fa-chevron-left text-sm" aria-hidden="true"></i>
            </button>
            <button aria-label="Next Slide"
              class="swiper-nav-next absolute right-4 top-1/2 -translate-y-1/2 z-10 w-10 h-10 bg-white/20 backdrop-blur-md hover:bg-white rounded-full flex items-center justify-center transition-all duration-300 text-white hover:text-[#965015] shadow-lg border border-white/30">
              <i class="fa-solid fa-chevron-right text-sm" aria-hidden="true"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
