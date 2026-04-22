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

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8 max-w-6xl mx-auto">

    {{-- Membatasi maksimal 6 kategori yang tampil di Beranda --}}
    @forelse ($categories->take(6) as $index => $category)
      <a href="{{ route('menu.index', ['category' => $category->id_kategori]) }}#all-menu-section"
        class="group relative bg-white rounded-[2rem] p-3 shadow-[0_15px_40px_-15px_rgba(62,30,4,0.3)] hover:shadow-[0_25px_50px_-20px_rgba(62,30,4,0.5)] hover:-translate-y-2 transition-all duration-300 block"
        data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">

        <div class="relative overflow-hidden rounded-3xl aspect-[4/3] mb-5 bg-gray-100">
          <img src="{{ $category->image ? asset('storage/' . $category->image) : asset('images/default/herobg.png') }}"
            alt="{{ $category->name }}"
            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out"
            loading="lazy">

          <div
            class="absolute inset-0 bg-[#3E1E04]/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
          </div>

          {{-- Glassmorphism Icon --}}
          <div
            class="absolute top-4 left-4 bg-white/80 backdrop-blur-lg border border-white/50 w-12 h-12 rounded-2xl flex items-center justify-center text-[#BC430D] shadow-sm transform group-hover:-translate-y-1 transition-transform duration-300">
            <i class="fas {{ $category->icon ?? 'fa-coffee' }} text-xl"></i>
          </div>
        </div>

        <div class="px-4 pb-4">
          <h3 class="text-2xl font-bold text-[#3E1E04] font-primary mb-2 group-hover:text-[#BC430D] transition-colors">
            {{ $category->name }}
          </h3>
          <p class="text-gray-500 text-sm leading-relaxed mb-6 line-clamp-2">
            {{ $category->description ?? 'Eksplorasi rasa terbaik dari kategori ini untuk menemani harimu.' }}
          </p>

          <div class="flex items-center justify-between border-t border-gray-100 pt-4 mt-auto">
            <span
              class="text-sm font-bold text-gray-400 group-hover:text-[#BC430D] transition-colors flex items-center gap-2">
              <span class="w-1.5 h-1.5 rounded-full bg-orange-200 group-hover:bg-[#BC430D] transition-colors"></span>
              Lihat Kategori
            </span>
            <div
              class="w-10 h-10 rounded-full bg-orange-50 flex items-center justify-center text-[#BC430D] group-hover:bg-[#BC430D] group-hover:text-white transition-colors duration-300">
              <i class="fas fa-arrow-right -rotate-45 group-hover:rotate-0 transition-transform duration-300"></i>
            </div>
          </div>
        </div>
      </a>
    @empty
      <div class="col-span-full flex flex-col items-center justify-center py-10" data-aos="fade-up">
        <div class="w-16 h-16 bg-white/10 rounded-full flex items-center justify-center mb-4">
          <i class="fas fa-box-open text-2xl text-orange-200"></i>
        </div>
        <p class="text-orange-100 font-secondary text-lg">Kategori menu sedang dipersiapkan.</p>
      </div>
    @endforelse

  </div>

  {{-- Lihat Semua HANYA jika lebih dari 6 --}}
  @if (count($categories) > 6)
    <div class="text-center mt-12" data-aos="fade-up">
      <a href="{{ route('menu.index') }}#all-menu-section"
        class="inline-flex items-center justify-center gap-3 px-8 py-4 bg-white/10 hover:bg-white text-white hover:text-[#BC430D] rounded-full font-secondary font-bold transition-all duration-300 border border-white/20 hover:shadow-lg hover:-translate-y-1 group">
        Lihat Semua Kategori
        <i class="fas fa-arrow-right transform group-hover:translate-x-1 transition-transform"></i>
      </a>
    </div>
  @endif

</section>
