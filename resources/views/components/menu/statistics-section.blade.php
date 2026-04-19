@props(['totalProducts' => 0, 'totalCategories' => 0, 'recentGallery' => collect()])

@php
  $stats = [
      [
          'icon' => 'fa-mug-hot',
          'number' => $totalProducts . '+',
          'title' => 'Produk',
          'desc' => 'Pilihan menu lengkap tersedia',
      ],
      [
          'icon' => 'fa-tags',
          'number' => $totalCategories . '+',
          'title' => 'Kategori',
          'desc' => 'Dari klasik hingga modern',
      ],
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
          'desc' => 'Kualitas single origin premium',
      ],
  ];
@endphp

<section
  class="py-16 lg:py-24 relative overflow-hidden bg-gradient-to-br from-amber-50/50 via-white to-orange-50/50 font-secondary sm:px-6 md:px-8 lg:px-12 xl:px-[8%] px-4 home-section-title">

  <div class="max-w-7xl mx-auto relative z-10">

    {{--  HEADER  --}}
    <div class="text-center mb-12 lg:mb-16" data-aos="fade-up">
      <h2 class="font-bold mb-3 relative inline-block text-3xl md:text-4xl font-primary text-[#3E1E04]">
        Dipercaya <span class="text-[#BC430D]">Banyak Pelanggan</span>
      </h2>
      <p class="font-secondary text-gray-500 max-w-xl mx-auto text-base md:text-lg leading-relaxed">
        Dari keberagaman menu hingga kepuasan pelanggan, kami selalu menjaga standar dan konsistensi di setiap tegukan.
      </p>
    </div>

    {{--  STATS SECTION  --}}
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
              <i class="fas {{ $stat['icon'] }} text-3xl text-[#BC430D] group-hover:text-white transition-colors duration-500"
                aria-hidden="true"></i>
            </div>
            <div class="text-4xl md:text-5xl font-black text-[#3E1E04] mb-2 tracking-tight">{{ $stat['number'] }}</div>
            <div class="font-primary text-lg font-bold text-gray-800 mb-1">{{ $stat['title'] }}</div>
            <p class="font-secondary text-sm text-gray-500 leading-relaxed">{{ $stat['desc'] }}</p>
          </div>
        </div>
      @endforeach
    </div>

    {{--  GALLERY SECTION  --}}
    <div class="mt-10">
      <h3 class="font-primary text-2xl md:text-3xl font-bold text-center text-[#3E1E04] mb-10" data-aos="fade-up">
        Galeri <span class="text-[#BC430D]">Kopi Kami</span>
      </h3>

      <div class="grid grid-cols-2 md:grid-cols-4 gap-4 lg:gap-6">

        @forelse ($recentGallery as $index => $item)
          <div
            class="relative group cursor-pointer rounded-2xl overflow-hidden aspect-square md:aspect-[4/5] shadow-sm hover:shadow-xl transition-all duration-500 bg-gray-100"
            data-modal-target="gallery-modal-{{ $item->id_produk }}"
            data-modal-toggle="gallery-modal-{{ $item->id_produk }}" data-aos="fade-up"
            data-aos-delay="{{ $index * 100 }}">

            <img src="{{ asset('storage/' . $item->main_image) }}" alt="{{ $item->name }}"
              class="w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-110"
              loading="lazy">

            <div
              class="absolute inset-0 bg-[#3E1E04]/40 backdrop-blur-[2px] opacity-0 group-hover:opacity-100 transition-all duration-500 flex items-center justify-center">
              <div
                class="w-12 h-12 rounded-full border border-white/50 flex items-center justify-center transform scale-50 opacity-0 group-hover:scale-100 group-hover:opacity-100 transition-all duration-500 delay-100">
                <i class="fas fa-expand text-white text-lg" aria-hidden="true"></i>
              </div>
            </div>

            <div
              class="absolute bottom-0 left-0 w-full p-4 bg-gradient-to-t from-black/80 to-transparent translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-500">
              <span class="text-white font-bold font-primary">{{ $item->name }}</span>
            </div>
          </div>
        @empty
          <div class="col-span-4 text-center text-gray-500 py-10 font-secondary">
            Belum ada gambar yang tersedia di galeri.
          </div>
        @endforelse

      </div>
    </div>

  </div>
</section>

{{--  FLOWBITE MODALS  --}}
@foreach ($recentGallery as $item)
  <div id="gallery-modal-{{ $item->id_produk }}" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-3xl max-h-full">

      <div class="relative bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 bg-gray-50/50">
          <h3 class="text-xl font-bold text-[#3E1E04] font-primary">{{ $item->name }}</h3>
          <button type="button"
            class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 flex justify-center items-center transition-colors"
            data-modal-hide="gallery-modal-{{ $item->id_produk }}">
            <i class="fas fa-times text-lg" aria-hidden="true"></i>
            <span class="sr-only">Tutup modal</span>
          </button>
        </div>

        <div class="p-6">
          <div class="rounded-xl overflow-hidden mb-5 bg-gray-100 flex justify-center">
            <img src="{{ asset('storage/' . $item->main_image) }}" alt="{{ $item->name }}"
              class="h-auto max-h-[60vh] object-contain rounded-xl" loading="lazy">
          </div>
          <p class="text-gray-600 font-secondary leading-relaxed text-center max-w-xl mx-auto">
            {{ $item->description ?? 'Nikmati kesegaran dan kenikmatan minuman spesial dari kami.' }}
          </p>
        </div>
      </div>

    </div>
  </div>
@endforeach