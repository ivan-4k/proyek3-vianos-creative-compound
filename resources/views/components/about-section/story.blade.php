<section class="w-full bg-[#F5F9F6] py-16 lg:py-24 px-4 sm:px-6 lg:px-12 home-section-title">
  <div class="max-w-7xl mx-auto">

    {{-- ROW 1 --}}
    <div class="flex flex-col-reverse md:flex-row justify-between items-center md:items-start mb-12 lg:mb-16 gap-8">

      <div class="w-28 md:w-36 flex-shrink-0" data-aos="fade-right" data-aos-duration="800">
        <img src="{{ asset('images/about/heart.png') }}" alt="Heart Coffee Beans"
          class="w-full object-contain drop-shadow-sm">
      </div>

      {{-- Judul kanan --}}
      <div class="text-center md:text-right" data-aos="fade-left" data-aos-duration="800">
        <h2 class="font-primary text-3xl md:text-4xl font-semibold text-[#2c1a0e] mb-3 relative inline-block">
          <span class="text-[#BC430D]">Cerita</span> Kami
        </h2>
        <p class="font-secondary text-base sm:text-lg md:text-xl text-[#6b4f3a]">
          Kopi terbaik adalah kopi yang selalu ingin kamu ulang.
        </p>
      </div>
    </div>

    {{-- ROW 2 --}}
    <div class="flex flex-col lg:flex-row gap-10 lg:gap-16 items-center lg:items-start">

      {{-- Grid foto --}}
      <div class="w-full lg:w-[400px] xl:w-[450px] flex-shrink-0 flex flex-col gap-3 lg:gap-4" data-aos="fade-up"
        data-aos-duration="1000">

        <div class="w-full h-[200px] md:h-[220px] rounded-2xl overflow-hidden shadow-lg">
          <img src="{{ asset('images/about/coffee1.png') }}" alt="Kopi 1"
            class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
        </div>

        <div class="grid grid-cols-2 gap-3 lg:gap-4">
          <div class="h-[140px] md:h-[160px] rounded-2xl overflow-hidden shadow-lg">
            <img src="{{ asset('images/about/coffee2.png') }}" alt="Kopi 2"
              class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
          </div>
          <div class="h-[140px] md:h-[160px] rounded-2xl overflow-hidden shadow-lg">
            <img src="{{ asset('images/about/coffee3.png') }}" alt="Kopi 3"
              class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
          </div>
        </div>
      </div>

      {{-- KANAN --}}
      <div class="flex-1 font-secondary text-base md:text-lg text-[#3b2a1a] leading-relaxed flex flex-col gap-6 lg:pt-8"
        data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000">
        <p>
          Berawal dari kecintaan terhadap kopi dan momen sederhana di baliknya,
          kami membangun coffee shop ini dengan satu tujuan: menghadirkan rasa
          yang konsisten dan pengalaman yang menyenangkan di setiap tegukan.
        </p>
        <p>
          Kami percaya bahwa kopi bukan sekadar minuman, tetapi bagian dari cerita
          harian — menemani bekerja, berdiskusi, atau sekadar menikmati waktu
          sendiri. Karena itu, setiap menu diracik dari biji kopi pilihan dengan standar
          kualitas yang kami jaga sepenuh hati.
        </p>
        <p>
          Hari ini, kami terus berinovasi, menghadirkan sistem rekomendasi yang
          membantu pelanggan menemukan menu terbaik sesuai waktu dan selera
          mereka.
        </p>
      </div>

    </div>
  </div>
</section>
