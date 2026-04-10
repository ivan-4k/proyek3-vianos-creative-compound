@php
  // Data Kategori lebih rapi
  $categories = [
      [
          'title' => 'Espresso Base',
          'desc' => 'Kopi pekat dengan krema tebal, fondasi kuat untuk hari yang produktif.',
          'icon' => 'fa-mug-hot',
          'img' =>
              'https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
      ],
      [
          'title' => 'Non-Coffee',
          'desc' => 'Pilihan segar, manis, dan creamy untuk kamu yang sedang rehat ngopi.',
          'icon' => 'fa-leaf',
          'img' =>
              'https://images.unsplash.com/photo-1544145945-f90425340c7e?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
      ],
      [
          'title' => 'Latte & Milk',
          'desc' => 'Perpaduan sempurna antara ketegasan espresso dan kelembutan susu.',
          'icon' => 'fa-coffee',
          'img' =>
              'https://images.unsplash.com/photo-1551030173-122aabc4489c?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80',
      ],
  ];
@endphp

<section
  class="py-16 lg:py-24 relative overflow-hidden font-secondary bg-[#BC430D] text-white sm:px-6 md:px-8 lg:px-12 xl:px-[8%] px-4 z-0">

  <div class="text-center mb-12 lg:mb-16" data-aos="fade-down">
    <h2 class="font-bold mb-3 relative inline-block text-3xl md:text-4xl font-primary">
      Jelajahi Kategori
    </h2>
    <p class="text-orange-100 font-secondary max-w-xl mx-auto text-base md:text-lg leading-relaxed">
      Temukan berbagai pilihan kopi dan minuman segar yang diracik khusus sesuai mood dan waktu kamu hari ini.
    </p>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">

    @foreach ($categories as $index => $category)
      <a href="#"
        class="group relative bg-white rounded-[2rem] p-3 shadow-xl hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 block"
        data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">

        <div class="relative overflow-hidden rounded-3xl aspect-[4/3] mb-5">
          <img src="{{ $category['img'] }}" alt="{{ $category['title'] }}"
            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out">

          <div
            class="absolute inset-0 bg-[#3E1E04]/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
          </div>

          <div
            class="absolute top-4 left-4 bg-white/90 backdrop-blur-md w-12 h-12 rounded-2xl flex items-center justify-center text-[#BC430D] shadow-sm transform group-hover:-translate-y-1 transition-transform duration-300">
            <i class="fas {{ $category['icon'] }} text-xl"></i>
          </div>
        </div>

        <div class="px-3 pb-4">
          <h3 class="text-2xl font-bold text-[#3E1E04] font-primary mb-2 group-hover:text-[#BC430D] transition-colors">
            {{ $category['title'] }}
          </h3>
          <p class="text-gray-500 text-sm leading-relaxed mb-6 line-clamp-2">
            {{ $category['desc'] }}
          </p>

          <div class="flex items-center justify-between border-t border-gray-100 pt-4">
            <span
              class="text-sm font-bold text-[#3E1E04] uppercase tracking-wider group-hover:text-[#BC430D] transition-colors">
              Eksplorasi
            </span>
            <div
              class="w-10 h-10 rounded-full bg-orange-50 flex items-center justify-center text-[#BC430D] group-hover:bg-[#BC430D] group-hover:text-white transition-colors duration-300">
              <i class="fas fa-arrow-right -rotate-45 group-hover:rotate-0 transition-transform duration-300"></i>
            </div>
          </div>
        </div>
      </a>
    @endforeach

  </div>
</section>
