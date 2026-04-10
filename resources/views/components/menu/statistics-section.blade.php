@php
  // Data Statistik
  $stats = [
      ['icon' => 'fa-mug-hot', 'number' => '50+', 'title' => 'Produk', 'desc' => 'Pilihan menu lengkap tersedia'],
      ['icon' => 'fa-tags', 'number' => '10+', 'title' => 'Kategori', 'desc' => 'Espresso, Latte, Non-Coffee, dll'],
      [
          'icon' => 'fa-coffee',
          'number' => '1K+',
          'title' => 'Cangkir/Bulan',
          'desc' => 'Disajikan & dinikmati setiap bulan',
      ],
      [
          'icon' => 'fa-seedling',
          'number' => '100%',
          'title' => 'Biji Pilihan',
          'desc' => 'Kualitas single origin & fair trade',
      ],
  ];

  // Data Gallery
  $galleries = [
      [
          'id' => '1',
          'title' => 'Espresso',
          'img' => '/images/default/herobg.webp',
          'desc' => 'Espresso murni dengan aroma kuat dan aftertaste panjang. Cocok untuk penikmat kopi sejati.',
      ],
      [
          'id' => '2',
          'title' => 'Latte',
          'img' => '/images/default/herobg.webp',
          'desc' => 'Perpaduan sempurna espresso dan susu dengan tekstur creamy lembut dan foam cantik.',
      ],
      [
          'id' => '3',
          'title' => 'Non-Coffee',
          'img' => '/images/default/herobg.webp',
          'desc' => 'Alternatif segar tanpa kopi, menikmati minuman dengan rasa unik dan menyegarkan.',
      ],
      [
          'id' => '4',
          'title' => 'Biji Kopi Pilihan',
          'img' => '/images/default/herobg.webp',
          'desc' => '100% biji kopi pilihan single origin yang dipetik langsung dari perkebunan terbaik.',
      ],
  ];
@endphp

<section
  class="py-16 lg:py-24 relative overflow-hidden bg-gradient-to-br from-amber-50/50 via-white to-orange-50/50 font-secondary sm:px-6 md:px-8 lg:px-12 xl:px-[8%] px-4 home-section-title">

  <div class="max-w-7xl mx-auto relative z-10">

    {{-- ================= HEADER ================= --}}
    <div class="text-center mb-12 lg:mb-16" data-aos="fade-up">
      <h2 class="font-bold mb-3 relative inline-block text-3xl md:text-4xl font-primary text-[#3E1E04]">
        Dipercaya <span class="text-[#BC430D]">Banyak Pelanggan</span>
      </h2>
      <p class="font-secondary text-gray-500 max-w-xl mx-auto text-base md:text-lg leading-relaxed">
        Dari keberagaman menu hingga kepuasan pelanggan, kami selalu menjaga standar dan konsistensi di setiap tegukan.
      </p>
    </div>

    {{-- ================= STATS SECTION ================= --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8 mb-20 lg:mb-28">
      @foreach ($stats as $index => $stat)
        <div
          class="group bg-white p-8 rounded-3xl border border-orange-100/50 transition-all duration-500 ease-out hover:shadow-2xl hover:shadow-[#BC430D]/10 hover:-translate-y-2 relative overflow-hidden text-center"
          data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">

          <div
            class="absolute top-0 right-0 -mr-8 -mt-8 w-24 h-24 rounded-full bg-orange-50 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
          </div>

          <div class="relative z-10">
            <div
              class="w-16 h-16 mx-auto bg-orange-50 rounded-2xl flex items-center justify-center mb-5 group-hover:bg-[#BC430D] transition-colors duration-500">
              <i
                class="fas {{ $stat['icon'] }} text-3xl text-[#BC430D] group-hover:text-white transition-colors duration-500"></i>
            </div>
            <div class="text-4xl md:text-5xl font-black text-[#3E1E04] mb-2 tracking-tight">{{ $stat['number'] }}</div>
            <div class="font-primary text-lg font-bold text-gray-800 mb-1">{{ $stat['title'] }}</div>
            <p class="font-secondary text-sm text-gray-500 leading-relaxed">{{ $stat['desc'] }}</p>
          </div>
        </div>
      @endforeach
    </div>

    {{-- ================= GALLERY SECTION ================= --}}
    <div class="mt-10">
      <h3 class="font-primary text-2xl md:text-3xl font-bold text-center text-[#3E1E04] mb-10" data-aos="fade-up">
        Galeri <span class="text-[#BC430D]">Kopi Kami</span>
      </h3>

      <div class="grid grid-cols-2 md:grid-cols-4 gap-4 lg:gap-6">

        @foreach ($galleries as $index => $item)
          <div
            class="relative group cursor-pointer rounded-2xl overflow-hidden aspect-square md:aspect-[4/5] shadow-sm hover:shadow-xl transition-all duration-500"
            data-modal-target="gallery-modal-{{ $item['id'] }}" data-modal-toggle="gallery-modal-{{ $item['id'] }}"
            data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">

            <img src="{{ $item['img'] }}" alt="{{ $item['title'] }}"
              class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-110">

            <div
              class="absolute inset-0 bg-[#3E1E04]/40 backdrop-blur-[2px] opacity-0 group-hover:opacity-100 transition-all duration-500 flex items-center justify-center">
              <div
                class="w-12 h-12 rounded-full border border-white/50 flex items-center justify-center transform scale-50 opacity-0 group-hover:scale-100 group-hover:opacity-100 transition-all duration-500 delay-100">
                <i class="fas fa-expand text-white text-lg"></i>
              </div>
            </div>

            <div
              class="absolute bottom-0 left-0 w-full p-4 bg-gradient-to-t from-black/80 to-transparent translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500">
              <span class="text-white font-bold font-primary">{{ $item['title'] }}</span>
            </div>
          </div>
        @endforeach

      </div>
    </div>

  </div>
</section>

{{-- ================= FLOWBITE MODALS (Digenerate via Loop) ================= --}}
@foreach ($galleries as $item)
  <div id="gallery-modal-{{ $item['id'] }}" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-3xl max-h-full">

      <div class="relative bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 bg-gray-50/50">
          <h3 class="text-xl font-bold text-[#3E1E04] font-primary">{{ $item['title'] }}</h3>
          <button type="button"
            class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 flex justify-center items-center transition-colors"
            data-modal-hide="gallery-modal-{{ $item['id'] }}">
            <i class="fas fa-times text-lg"></i>
          </button>
        </div>

        <div class="p-6">
          <div class="rounded-xl overflow-hidden mb-5">
            <img src="{{ $item['img'] }}" alt="{{ $item['title'] }}" class="w-full h-auto max-h-[60vh] object-cover">
          </div>
          <p class="text-gray-600 font-secondary leading-relaxed text-center max-w-xl mx-auto">
            {{ $item['desc'] }}
          </p>
        </div>
      </div>

    </div>
  </div>
@endforeach