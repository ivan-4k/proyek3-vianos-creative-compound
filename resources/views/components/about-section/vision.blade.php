<section class="w-full bg-[#F3DEC5] py-16 lg:py-24 px-4 sm:px-6 lg:px-12">
  <div class="max-w-6xl mx-auto">

    {{-- Judul Gambar --}}
    <div class="flex justify-center mb-12 lg:mb-16" data-aos="fade-down" data-aos-duration="800">
      <img src="{{ asset('images/about/title.png') }}" alt="Visi & Misi" class="h-24 md:h-24 lg:h-32 object-contain">
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-10 items-stretch">
      <div
        class="bg-[#fdf6ee] rounded-[2rem] p-8 lg:p-12 flex flex-col items-center text-center shadow-lg transition-transform duration-300 hover:-translate-y-2 border border-[#e8d5c4]/50"
        data-aos="fade-up" data-aos-delay="100" data-aos-duration="800">

        {{-- Gambar Icon --}}
        <div class="mb-6 md:mb-8">
          <img src="{{ asset('images/about/visi.png') }}" alt="Icon Visi"
            class="w-24 h-24 md:w-28 md:h-28 object-contain">
        </div>

        {{-- Judul dengan Ornamen Garis Dotted --}}
        <div class="flex items-center justify-center gap-4 mb-6">
          <div class="border-t-[3px] border-dotted border-[#b8956a] w-8 md:w-12"></div>
          <h3 class="font-primary text-3xl md:text-4xl font-bold text-[#2c1a0e]">
            Visi
          </h3>
          <div class="border-t-[3px] border-dotted border-[#b8956a] w-8 md:w-12"></div>
        </div>

        {{-- Teks Deskripsi --}}
        <p class="font-secondary text-base md:text-lg text-[#5a3e28] leading-relaxed max-w-sm">
          Menjadi coffee shop terpercaya yang menghadirkan kualitas rasa konsisten dengan pengalaman pemesanan yang
          praktis dan modern.
        </p>
      </div>

      {{-- CARD MISI --}}
      <div
        class="bg-[#fdf6ee] rounded-[2rem] p-8 lg:p-12 flex flex-col items-center shadow-lg transition-transform duration-300 hover:-translate-y-2 border border-[#e8d5c4]/50"
        data-aos="fade-up" data-aos-delay="250" data-aos-duration="800">

        <div class="mb-6 md:mb-8">
          <img src="{{ asset('images/about/misi.png') }}" alt="Icon Misi"
            class="w-24 h-24 md:w-28 md:h-28 object-contain">
        </div>

        <div class="flex items-center justify-center gap-4 mb-6">
          <div class="border-t-[3px] border-dotted border-[#b8956a] w-8 md:w-12"></div>
          <h3 class="font-primary text-3xl md:text-4xl font-bold text-[#2c1a0e]">
            Misi
          </h3>
          <div class="border-t-[3px] border-dotted border-[#b8956a] w-8 md:w-12"></div>
        </div>

        <ul class="w-full flex flex-col gap-4 font-secondary text-base md:text-lg text-[#5a3e28] leading-relaxed">
          @foreach (['Menyajikan kopi berkualitas dari biji pilihan terbaik.', 'Menjaga konsistensi rasa dalam setiap sajian.', 'Memberikan pelayanan cepat dan responsif melalui WhatsApp.', 'Menghadirkan rekomendasi menu yang relevan sesuai waktu dan kebutuhan pelanggan.'] as $item)
            <li class="flex items-start gap-4 text-left">
              <span class="mt-2 flex-shrink-0 w-2.5 h-2.5 rounded-full bg-[#8b5e3c]"></span>
              <span>{{ $item }}</span>
            </li>
          @endforeach
        </ul>
      </div>

    </div>
  </div>
</section>
