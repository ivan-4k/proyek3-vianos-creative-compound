@props(['categories'])

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

    @forelse ($categories as $index => $category)
      <a href="{{ route('menu.index', ['category' => $category->id_kategori]) }}"
        class="group relative bg-white rounded-[2rem] p-3 shadow-xl hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 block"
        data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">

        <div class="relative overflow-hidden rounded-3xl aspect-[4/3] mb-5 bg-gray-100">
          <img src="{{ $category->image ? asset('storage/' . $category->image) : asset('images/default/herobg.png') }}"
            alt="{{ $category->name }}"
            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out"
            loading="lazy">

          <div
            class="absolute inset-0 bg-[#3E1E04]/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
          </div>

          <div
            class="absolute top-4 left-4 bg-white/90 backdrop-blur-md w-12 h-12 rounded-2xl flex items-center justify-center text-[#BC430D] shadow-sm transform group-hover:-translate-y-1 transition-transform duration-300">
            <i class="fas {{ $category->icon ?? 'fa-coffee' }} text-xl"></i>
          </div>
        </div>

        <div class="px-3 pb-4">
          <h3 class="text-2xl font-bold text-[#3E1E04] font-primary mb-2 group-hover:text-[#BC430D] transition-colors">
            {{ $category->name }}
          </h3>
          <p class="text-gray-500 text-sm leading-relaxed mb-6 line-clamp-2">
            {{ $category->description ?? 'Eksplorasi rasa terbaik dari kategori ini untuk menemani harimu.' }}
          </p>

          <div class="flex items-center justify-between border-t border-gray-100 pt-4">
            <span
              class="text-sm font-bold text-[#3E1E04] uppercase tracking-wider group-hover:text-[#BC430D] transition-colors">
              Lihat Menu
            </span>
            <div
              class="w-10 h-10 rounded-full bg-orange-50 flex items-center justify-center text-[#BC430D] group-hover:bg-[#BC430D] group-hover:text-white transition-colors duration-300">
              <i class="fas fa-arrow-right -rotate-45 group-hover:rotate-0 transition-transform duration-300"></i>
            </div>
          </div>
        </div>
      </a>
    @empty
      <div class="col-span-full text-center py-10">
        <p class="text-orange-100 font-secondary">Kategori menu sedang dipersiapkan.</p>
      </div>
    @endforelse

  </div>
</section>