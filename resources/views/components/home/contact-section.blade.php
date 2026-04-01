<section class="py-12 sm:py-16 lg:py-20 relative overflow-hidden bg-white sm:px-6 md:px-8 lg:px-12 xl:px-[8%] px-4"
  id="contact">

  <div class="container mx-auto relative z-10">
    <!-- Flex Layout: 2 columns on desktop, 1 column on mobile -->
    <div class="flex flex-col lg:flex-row gap-10 lg:gap-2 xl:gap-16 items-start">

      <!-- LEFT COLUMN: Text & Image -->
      <div class="flex-1 space-y-5 sm:space-y-6 lg:space-y-7 text-center sm:text-left order-1 lg:order-1 group">
        <!-- Badge -->
        <div class="flex justify-center sm:justify-start">
          <div
            class="inline-flex items-center gap-2 bg-amber-50 text-amber-700 px-4 py-1.5 rounded-full text-sm font-semibold tracking-wide shadow-sm font-secondary">
            <i class="fas fa-headset text-xs"></i>
            <span>KONTAK KAMI</span>
          </div>
        </div>

        <!-- Heading with Playfair Display -->
        <h2
          class="relative text-3xl sm:text-4xl md:text-5xl lg:text-4xl xl:text-6xl text-gray-900 font-primary font-bold tracking-tight leading-tight inline-block sm:inline-block mx-auto sm:mx-0"
          data-aos="fade-right">
          Hubungi kami <br class="hidden sm:block">hari ini
          <span
            class="absolute bottom-0 left-1/2 sm:left-0 transform -translate-x-1/2 sm:transform-none w-0 h-0.5 bg-[#BC430D] transition-all duration-300 ease-out group-hover:w-1/2 sm:group-hover:w-1/2"></span>
        </h2>

        <!-- Description with Inter font -->
        <p class="text-gray-600 text-base sm:text-lg max-w-md mx-auto lg:mx-0 leading-relaxed font-secondary"
          data-aos="fade-right">
          Kami siap membantu Anda. Hubungi tim kami untuk pertanyaan lebih lanjut, konsultasi gratis, atau informasi
          produk.
        </p>

        <!-- Quick contact info -->
        <div class="flex flex-col sm:flex-row gap-3 sm:gap-6 justify-center lg:justify-start pt-2 font-secondary">
          <div class="flex items-center gap-2 text-gray-700 text-sm sm:text-base" data-aos="fade-right">
            <i class="fas fa-phone-alt text-amber-600 text-base"></i>
            <span>+62 812 3456 7890</span>
          </div>
          <div class="flex items-center gap-2 text-gray-700 text-sm sm:text-base" data-aos="fade-right">
            <i class="fas fa-envelope text-amber-600 text-base"></i>
            <span>hello@kopi.co.id</span>
          </div>
        </div>

        <!-- Image Card -->
        <div class="group rounded-2xl overflow-hidden shadow-xl max-w-md mx-auto lg:mx-0 mt-4 sm:mt-6 bg-gray-100"
          data-aos="fade-up">
          <div class="overflow-hidden">
            <picture>
              <source srcset="{{ asset('images/default/Latte.webp') }}" type="image/webp">
              <img src="{{ asset('images/default/Latte.jpg') }}" alt="Fresh brewed coffee experience"
                class="w-full h-56 sm:h-64 md:h-72 lg:h-80 object-cover transition-transform duration-700 ease-out group-hover:scale-105"
                loading="lazy" decoding="async" aria-hidden="true">
            </picture>
          </div>
          <div
            class="bg-white/90 backdrop-blur-sm py-2 text-center text-xs text-gray-500 border-t border-gray-100 font-secondary">
            <i class="fas fa-mug-hot mr-1 text-amber-600"></i> Nikmati pengalaman kopi terbaik
          </div>
        </div>
      </div>

      <!-- RIGHT COLUMN: Form Card -->
      <div class="flex-1 order-2 lg:order-2" data-aos="fade-up">
        <div
          class="bg-gradient-to-br from-orange-700 via-orange-800 to-orange-900 rounded-2xl sm:rounded-3xl p-6 sm:p-8 lg:p-10 shadow-2xl transition-all duration-300 hover:shadow-orange-900/20">

          <!-- Form Header -->
          <div class="mb-5 sm:mb-6 text-center">
            <h4 class="text-white text-xl sm:text-2xl font-bold flex items-center justify-center gap-2 font-primary">
              <i class="fas fa-paper-plane text-orange-300 text-lg"></i>
              Kirim pesan cepat
            </h4>
            <p class="text-orange-100 text-sm mt-1 opacity-90 font-secondary">Isi formulir di bawah, tim kami akan
              segera menghubungi Anda.</p>
          </div>

          <form action="#" method="POST" class="space-y-5 sm:space-y-6">
            @csrf

            <!-- Row 1: Nama & Email -->
            <div class="flex flex-col sm:flex-row gap-4 sm:gap-5">
              <div class="flex-1">
                <label for="fullname"
                  class="text-white text-sm sm:text-base font-medium mb-1.5 flex items-center gap-1 font-secondary">
                  <i class="fas fa-user text-orange-300 text-xs"></i> Nama Lengkap <span
                    class="text-orange-300">*</span>
                </label>
                <input type="text" id="fullname" name="fullname" autocomplete="name"
                  class="w-full rounded-full px-5 py-3 text-gray-800 bg-white border border-transparent focus:border-orange-300 focus:ring-2 focus:ring-orange-400 placeholder-gray-500 focus:outline-none transition-all text-sm sm:text-base shadow-sm font-secondary"
                  placeholder="John Carter" required aria-required="true">
              </div>
              <div class="flex-1">
                <label for="email"
                  class="text-white text-sm sm:text-base font-medium mb-1.5 flex items-center gap-1 font-secondary">
                  <i class="fas fa-envelope text-orange-300 text-xs"></i> Alamat Email <span
                    class="text-orange-300">*</span>
                </label>
                <input type="email" id="email" name="email" autocomplete="email"
                  class="w-full rounded-full px-5 py-3 text-gray-800 bg-white border border-transparent focus:border-orange-300 focus:ring-2 focus:ring-orange-400 placeholder-gray-500 focus:outline-none transition-all text-sm sm:text-base shadow-sm font-secondary"
                  placeholder="example@email.com" required aria-required="true">
              </div>
            </div>

            <!-- Row 2: Nomor HP & Perusahaan -->
            <div class="flex flex-col sm:flex-row gap-4 sm:gap-5">
              <div class="flex-1">
                <label for="phone"
                  class="text-white text-sm sm:text-base font-medium mb-1.5 flex items-center gap-1 font-secondary">
                  <i class="fas fa-phone-alt text-orange-300 text-xs"></i> Nomor HP / WA
                </label>
                <input type="tel" id="phone" name="phone" autocomplete="tel"
                  class="w-full rounded-full px-5 py-3 text-gray-800 bg-white border border-transparent focus:border-orange-300 focus:ring-2 focus:ring-orange-400 placeholder-gray-500 focus:outline-none transition-all text-sm sm:text-base shadow-sm font-secondary"
                  placeholder="+62 812 3456 7890" aria-label="Nomor telepon atau WhatsApp">
              </div>
              <div class="flex-1">
                <label for="company"
                  class="text-white text-sm sm:text-base font-medium mb-1.5 flex items-center gap-1 font-secondary">
                  <i class="fas fa-building text-orange-300 text-xs"></i> Perusahaan / Instansi
                </label>
                <input type="text" id="company" name="company" autocomplete="organization"
                  class="w-full rounded-full px-5 py-3 text-gray-800 bg-white border border-transparent focus:border-orange-300 focus:ring-2 focus:ring-orange-400 placeholder-gray-500 focus:outline-none transition-all text-sm sm:text-base shadow-sm font-secondary"
                  placeholder="Nama perusahaan (opsional)" aria-label="Nama perusahaan atau instansi">
              </div>
            </div>

            <!-- Message area -->
            <div>
              <label for="message"
                class="text-white text-sm sm:text-base font-medium mb-1.5 flex items-center gap-1 font-secondary">
                <i class="fas fa-comment-dots text-orange-300 text-xs"></i> Pesan <span
                  class="text-orange-300">*</span>
              </label>
              <textarea id="message" name="message" rows="4" autocomplete="off"
                class="w-full rounded-2xl px-5 py-3 text-gray-800 bg-white border border-transparent focus:border-orange-300 focus:ring-2 focus:ring-orange-400 placeholder-gray-500 focus:outline-none transition-all text-sm sm:text-base resize-y shadow-sm font-secondary"
                placeholder="Tulis pesan atau pertanyaan Anda di sini..." required aria-required="true"></textarea>
            </div>

            <!-- Submit Button -->
            <div class="pt-2 flex flex-col sm:flex-row gap-3 items-center sm:items-start">
              <button type="submit"
                class="group relative bg-orange-400 hover:bg-orange-500 text-white font-bold px-8 py-3.5 rounded-full transition-all duration-300 shadow-lg hover:shadow-orange-500/40 inline-flex items-center gap-2 text-base sm:text-lg w-full sm:w-auto justify-center transform hover:-translate-y-0.5 active:translate-y-0 font-secondary"
                aria-label="Kirim pesan sekarang">
                <i
                  class="fas fa-paper-plane text-sm transition-transform group-hover:translate-x-1 group-hover:-translate-y-0.5"></i>
                Kirim Pesan Sekarang
              </button>
              <span class="text-orange-100 text-xs sm:text-sm hidden sm:inline-block opacity-80 font-secondary">*Respon
                < 24 jam</span>
            </div>
            <p class="text-orange-100/70 text-xs text-center sm:text-left mt-2 sm:hidden font-secondary">*Respon cepat
              dalam 24 jam</p>

            <!-- Hidden honeypot -->
            <input type="text" name="website" autocomplete="off" style="display:none" tabindex="-1">
          </form>

          <!-- Additional contact details -->
          <div
            class="mt-6 pt-4 border-t border-orange-600/50 flex flex-wrap justify-center lg:justify-start gap-4 text-xs text-orange-100 font-secondary">
            <div class="flex items-center gap-1"><i class="fas fa-map-marker-alt"></i> <span>Jakarta, Indonesia</span>
            </div>
            <div class="flex items-center gap-1"><i class="far fa-clock"></i> <span>Senin - Jumat: 09.00 -
                17.00</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
