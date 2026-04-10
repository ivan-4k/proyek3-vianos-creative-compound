<section class="py-12 sm:py-16 lg:py-24 relative overflow-hidden bg-[#FBF8F5] sm:px-6 md:px-8 lg:px-12 xl:px-[8%] px-4"
  id="contact">

  <div class="container mx-auto relative z-10">
    <div class="flex flex-col lg:flex-row gap-12 lg:gap-8 xl:gap-16 items-center">

      <div class="flex-1 space-y-6 sm:space-y-8 text-center sm:text-left order-1 group w-full">

        <div class="flex justify-center sm:justify-start">
          <div
            class="inline-flex items-center gap-2 bg-[#BC430D]/10 text-[#BC430D] px-4 py-1.5 rounded-full text-xs font-bold tracking-widest uppercase shadow-sm font-secondary">
            <i class="fas fa-headset"></i>
            <span>Kontak Kami</span>
          </div>
        </div>

        <h2
          class="relative text-3xl sm:text-4xl md:text-5xl lg:text-5xl xl:text-6xl text-[#3E1E04] font-primary font-bold tracking-tight leading-tight inline-block mx-auto sm:mx-0"
          data-aos="fade-right">
          Hubungi kami <br class="hidden sm:block">hari ini.
          <span
            class="absolute -bottom-2 left-1/2 sm:left-0 transform -translate-x-1/2 sm:transform-none w-12 h-1.5 rounded-full bg-[#BC430D] transition-all duration-500 ease-out group-hover:w-full"></span>
        </h2>

        <p class="text-gray-600 text-base sm:text-lg max-w-md mx-auto lg:mx-0 leading-relaxed font-secondary"
          data-aos="fade-right" data-aos-delay="100">
          Kami siap membantu Anda. Hubungi tim kami untuk pertanyaan lebih lanjut, konsultasi, atau informasi produk
          terbaru kami.
        </p>

        <div class="flex flex-col sm:flex-row gap-4 sm:gap-8 justify-center lg:justify-start pt-2 font-secondary">
          <div class="flex items-center gap-3 text-[#3E1E04] font-medium" data-aos="fade-up" data-aos-delay="200">
            <div class="w-10 h-10 rounded-full bg-white shadow-sm flex items-center justify-center text-[#BC430D]">
              <i class="fas fa-phone-alt"></i>
            </div>
            <span>+62 812 3456 7890</span>
          </div>
          <div class="flex items-center gap-3 text-[#3E1E04] font-medium" data-aos="fade-up" data-aos-delay="300">
            <div class="w-10 h-10 rounded-full bg-white shadow-sm flex items-center justify-center text-[#BC430D]">
              <i class="fas fa-envelope"></i>
            </div>
            <span>hello@kopi.co.id</span>
          </div>
        </div>

        <div class="relative max-w-md mx-auto lg:mx-0 mt-8" data-aos="fade-up" data-aos-delay="400">
          <div
            class="absolute inset-0 bg-[#965015] rounded-3xl transform rotate-3 scale-105 opacity-20 transition-transform duration-500 group-hover:rotate-6">
          </div>

          <div class="relative bg-white rounded-3xl overflow-hidden shadow-xl border border-white">
            <picture>
              <source srcset="{{ asset('images/default/Latte.webp') }}" type="image/webp">
              <img src="{{ asset('images/default/Latte.jpg') }}" alt="Fresh brewed coffee experience"
                class="w-full h-56 sm:h-64 md:h-72 object-cover transition-transform duration-700 ease-out hover:scale-110"
                loading="lazy" decoding="async" aria-hidden="true">
            </picture>
            <div
              class="absolute bottom-0 inset-x-0 bg-white/90 backdrop-blur-md py-3 text-center text-sm font-bold text-[#3E1E04] font-secondary">
              <i class="fas fa-mug-hot mr-2 text-[#BC430D]"></i> Nikmati pengalaman kopi terbaik
            </div>
          </div>
        </div>
      </div>

      <div class="flex-1 order-2 w-full lg:max-w-xl" data-aos="fade-left">
        <div
          class="bg-gradient-to-br from-[#965015] to-[#3E1E04] rounded-3xl p-6 sm:p-8 lg:p-10 shadow-2xl relative overflow-hidden">

          <div
            class="absolute -top-20 -right-20 w-64 h-64 bg-[#BC430D] rounded-full mix-blend-multiply filter blur-3xl opacity-50">
          </div>

          <div class="mb-8 text-center relative z-10">
            <h4 class="text-white text-2xl sm:text-3xl font-bold flex items-center justify-center gap-3 font-primary">
              <i class="fas fa-paper-plane text-amber-300"></i>
              Kirim Pesan
            </h4>
            <p class="text-amber-100/80 text-sm mt-2 font-secondary">Isi formulir di bawah, tim kami akan segera
              membalas.</p>
          </div>

          <form action="#" method="POST" class="space-y-5 relative z-10">
            @csrf

            <div class="flex flex-col sm:flex-row gap-5">
              <div class="flex-1">
                <label for="fullname"
                  class="text-amber-50 text-sm font-semibold mb-2 flex items-center gap-2 font-secondary">
                  <i class="fas fa-user text-amber-300/70 text-xs"></i> Nama Lengkap
                </label>
                <input type="text" id="fullname" name="fullname" autocomplete="name"
                  class="w-full rounded-xl px-4 py-3.5 bg-white/10 border border-white/20 text-white placeholder-white/40 focus:bg-white/20 focus:border-amber-300 focus:ring-2 focus:ring-amber-300/30 outline-none transition-all text-sm font-secondary backdrop-blur-sm"
                  placeholder="John Doe" required aria-required="true">
              </div>
              <div class="flex-1">
                <label for="email"
                  class="text-amber-50 text-sm font-semibold mb-2 flex items-center gap-2 font-secondary">
                  <i class="fas fa-envelope text-amber-300/70 text-xs"></i> Alamat Email
                </label>
                <input type="email" id="email" name="email" autocomplete="email"
                  class="w-full rounded-xl px-4 py-3.5 bg-white/10 border border-white/20 text-white placeholder-white/40 focus:bg-white/20 focus:border-amber-300 focus:ring-2 focus:ring-amber-300/30 outline-none transition-all text-sm font-secondary backdrop-blur-sm"
                  placeholder="hello@email.com" required aria-required="true">
              </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-5">
              <div class="flex-1">
                <label for="phone"
                  class="text-amber-50 text-sm font-semibold mb-2 flex items-center gap-2 font-secondary">
                  <i class="fas fa-phone-alt text-amber-300/70 text-xs"></i> Nomor HP / WA
                </label>
                <input type="tel" id="phone" name="phone" autocomplete="tel"
                  class="w-full rounded-xl px-4 py-3.5 bg-white/10 border border-white/20 text-white placeholder-white/40 focus:bg-white/20 focus:border-amber-300 focus:ring-2 focus:ring-amber-300/30 outline-none transition-all text-sm font-secondary backdrop-blur-sm"
                  placeholder="+62 812..." aria-label="Nomor telepon atau WhatsApp">
              </div>
              <div class="flex-1">
                <label for="company"
                  class="text-amber-50 text-sm font-semibold mb-2 flex items-center gap-2 font-secondary">
                  <i class="fas fa-building text-amber-300/70 text-xs"></i> Perusahaan <span
                    class="text-white/40 text-xs font-normal">(Opsional)</span>
                </label>
                <input type="text" id="company" name="company" autocomplete="organization"
                  class="w-full rounded-xl px-4 py-3.5 bg-white/10 border border-white/20 text-white placeholder-white/40 focus:bg-white/20 focus:border-amber-300 focus:ring-2 focus:ring-amber-300/30 outline-none transition-all text-sm font-secondary backdrop-blur-sm"
                  placeholder="Nama Instansi" aria-label="Nama perusahaan atau instansi">
              </div>
            </div>

            <div>
              <label for="message"
                class="text-amber-50 text-sm font-semibold mb-2 flex items-center gap-2 font-secondary">
                <i class="fas fa-comment-dots text-amber-300/70 text-xs"></i> Pesan
              </label>
              <textarea id="message" name="message" rows="4" autocomplete="off"
                class="w-full rounded-xl px-4 py-3.5 bg-white/10 border border-white/20 text-white placeholder-white/40 focus:bg-white/20 focus:border-amber-300 focus:ring-2 focus:ring-amber-300/30 outline-none transition-all text-sm resize-y font-secondary backdrop-blur-sm"
                placeholder="Tulis pesan atau pertanyaan Anda di sini..." required aria-required="true"></textarea>
            </div>

            <div class="pt-4 flex flex-col sm:flex-row gap-4 items-center justify-between">
              <button type="submit"
                class="group bg-[#BC430D] hover:bg-white text-white hover:text-[#3E1E04] font-bold px-8 py-3.5 rounded-xl transition-all duration-300 shadow-lg inline-flex items-center gap-3 w-full sm:w-auto justify-center font-secondary">
                Kirim Pesan
                <i class="fas fa-arrow-right text-sm transition-transform group-hover:translate-x-1"></i>
              </button>
              <span class="text-amber-100/60 text-xs font-secondary"><i class="fas fa-bolt text-amber-300 mr-1"></i>
                Respon cepat < 24 jam</span>
            </div>

            <input type="text" name="website" autocomplete="off" style="display:none" tabindex="-1">
          </form>

        </div>
      </div>

    </div>
  </div>
</section>
