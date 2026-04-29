<footer
  class="bg-[#3E1E04] border-t-4 border-[#BC430D] py-16 sm:py-20 lg:py-24 sm:px-6 md:px-8 lg:px-12 xl:px-[8%] px-4 relative overflow-hidden">

  <div class="absolute -top-40 -right-40 w-96 h-96 bg-white opacity-5 rounded-full blur-3xl pointer-events-none"></div>

  <div class="container mx-auto relative z-10">
    <div class="flex flex-wrap lg:justify-between gap-y-12">

      <div class="w-full lg:w-1/3 pr-0 lg:pr-12 text-center lg:text-left">
        <img src="{{ asset(Cache::get('logo', 'images/default/logo-light.png')) }}" alt="{{ Cache::get('store_name', 'Seven Coffee Company') }} Logo"
          class="mx-auto lg:mx-0 h-14 w-auto mb-6 object-contain" loading="lazy" decoding="async">
        <p class="text-amber-50/70 text-sm leading-relaxed font-secondary mb-6 max-w-sm mx-auto lg:mx-0">
          {{ Cache::get('store_description', 'Seven Coffee Company Indramayu adalah ruang nyaman di Jl. Veteran, menghadirkan seduhan kopi berkualitas dan hidangan terbaik untuk melengkapi hari Anda.') }}
        </p>

        <div class="flex items-center justify-center lg:justify-start gap-4">
          @if(Cache::get('instagram'))
            <a href="{{ Cache::get('instagram') }}" target="_blank"
              class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center text-amber-50 hover:bg-[#BC430D] hover:text-white transition-all duration-300 hover:-translate-y-1 shadow-sm">
              <i class="fab fa-instagram text-lg"></i>
            </a>
          @endif
          @if(Cache::get('tiktok'))
            <a href="{{ Cache::get('tiktok') }}" target="_blank"
              class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center text-amber-50 hover:bg-[#BC430D] hover:text-white transition-all duration-300 hover:-translate-y-1 shadow-sm">
              <i class="fab fa-tiktok text-lg"></i>
            </a>
          @endif
          @if(Cache::get('facebook'))
            <a href="{{ Cache::get('facebook') }}" target="_blank"
              class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center text-amber-50 hover:bg-[#BC430D] hover:text-white transition-all duration-300 hover:-translate-y-1 shadow-sm">
              <i class="fab fa-facebook-f text-lg"></i>
            </a>
          @endif
          @if(Cache::get('whatsapp'))
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', Cache::get('whatsapp')) }}" target="_blank"
              class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center text-amber-50 hover:bg-[#BC430D] hover:text-white transition-all duration-300 hover:-translate-y-1 shadow-sm">
              <i class="fab fa-whatsapp text-lg"></i>
            </a>
          @endif
        </div>
      </div>

      <div class="w-1/2 sm:w-1/3 lg:w-1/5 px-2 sm:px-4 text-left">
        <h3 class="text-lg font-bold text-white mb-6 inline-block font-primary relative group cursor-default">
          Tautan Cepat
          <span
            class="absolute -bottom-1.5 left-0 w-4 h-0.5 bg-[#BC430D] rounded-full transition-all duration-300 ease-out group-hover:w-full"></span>
        </h3>
        <ul class="space-y-4 font-secondary">
          <li>
            <a href="{{ url('/home') }}"
              class="text-amber-50/70 hover:text-white transition-all duration-300 flex items-center gap-2 group">
              <i
                class="fas fa-chevron-right text-[10px] text-[#BC430D] opacity-0 -ml-3 group-hover:opacity-100 group-hover:ml-0 transition-all duration-300"></i>
              <span class="group-hover:translate-x-1 transition-transform duration-300">Beranda</span>
            </a>
          </li>
          <li>
            <a href="{{ url('/menu') }}"
              class="text-amber-50/70 hover:text-white transition-all duration-300 flex items-center gap-2 group">
              <i
                class="fas fa-chevron-right text-[10px] text-[#BC430D] opacity-0 -ml-3 group-hover:opacity-100 group-hover:ml-0 transition-all duration-300"></i>
              <span class="group-hover:translate-x-1 transition-transform duration-300">Menu Kami</span>
            </a>
          </li>
          <li>
            <a href="{{ url('/about') }}"
              class="text-amber-50/70 hover:text-white transition-all duration-300 flex items-center gap-2 group">
              <i
                class="fas fa-chevron-right text-[10px] text-[#BC430D] opacity-0 -ml-3 group-hover:opacity-100 group-hover:ml-0 transition-all duration-300"></i>
              <span class="group-hover:translate-x-1 transition-transform duration-300">Tentang Kami</span>
            </a>
          </li>
          <li>
            <a href="{{ url('/home') }}#contact"
              class="text-amber-50/70 hover:text-white transition-all duration-300 flex items-center gap-2 group">
              <i
                class="fas fa-chevron-right text-[10px] text-[#BC430D] opacity-0 -ml-3 group-hover:opacity-100 group-hover:ml-0 transition-all duration-300"></i>
              <span class="group-hover:translate-x-1 transition-transform duration-300">Kontak</span>
            </a>
          </li>
        </ul>
      </div>

      <div class="w-1/2 sm:w-1/3 lg:w-1/5 px-2 sm:px-4 text-left">
        <h3 class="text-lg font-bold text-white mb-6 inline-block font-primary relative group cursor-default">
          Bantuan
          <span
            class="absolute -bottom-1.5 left-0 w-4 h-0.5 bg-[#BC430D] rounded-full transition-all duration-300 ease-out group-hover:w-full"></span>
        </h3>
        <ul class="space-y-4 font-secondary">
          <li>
            <a href="#"
              class="text-amber-50/70 hover:text-white transition-all duration-300 flex items-center gap-2 group">
              <i
                class="fas fa-chevron-right text-[10px] text-[#BC430D] opacity-0 -ml-3 group-hover:opacity-100 group-hover:ml-0 transition-all duration-300"></i>
              <span class="group-hover:translate-x-1 transition-transform duration-300">FAQ</span>
            </a>
          </li>
          <li>
            <a href="#"
              class="text-amber-50/70 hover:text-white transition-all duration-300 flex items-center gap-2 group">
              <i
                class="fas fa-chevron-right text-[10px] text-[#BC430D] opacity-0 -ml-3 group-hover:opacity-100 group-hover:ml-0 transition-all duration-300"></i>
              <span class="group-hover:translate-x-1 transition-transform duration-300">Cara Memesan</span>
            </a>
          </li>
          <li>
            <a href="#"
              class="text-amber-50/70 hover:text-white transition-all duration-300 flex items-center gap-2 group">
              <i
                class="fas fa-chevron-right text-[10px] text-[#BC430D] opacity-0 -ml-3 group-hover:opacity-100 group-hover:ml-0 transition-all duration-300"></i>
              <span class="group-hover:translate-x-1 transition-transform duration-300">Kebijakan Privasi</span>
            </a>
          </li>
          <li>
            <a href="#"
              class="text-amber-50/70 hover:text-white transition-all duration-300 flex items-center gap-2 group">
              <i
                class="fas fa-chevron-right text-[10px] text-[#BC430D] opacity-0 -ml-3 group-hover:opacity-100 group-hover:ml-0 transition-all duration-300"></i>
              <span class="group-hover:translate-x-1 transition-transform duration-300">Syarat & Ketentuan</span>
            </a>
          </li>
        </ul>
      </div>

      <div class="w-full sm:w-1/3 lg:w-1/4 px-2 sm:px-4 text-center sm:text-left mt-6 sm:mt-0">
        <h3 class="text-lg font-bold text-white mb-6 inline-block font-primary relative group cursor-default">
          Kunjungi Kami
          <span
            class="absolute -bottom-1.5 left-1/2 sm:left-0 transform -translate-x-1/2 sm:translate-x-0 w-4 h-0.5 bg-[#BC430D] rounded-full transition-all duration-300 ease-out group-hover:w-full"></span>
        </h3>
        <ul class="space-y-4 font-secondary">
          <li class="flex items-start justify-center sm:justify-start gap-3 text-amber-50/80 text-sm leading-relaxed">
            <i class="fas fa-map-marker-alt text-[#BC430D] text-base mt-1"></i>
            <span class="text-center sm:text-left">{{ Cache::get('store_address', 'Jl. Veteran No.88, Lemahabang, Kec. Indramayu, Kabupaten Indramayu, Jawa Barat 45212') }}</span>
          </li>
          <li class="flex items-center justify-center sm:justify-start gap-3 text-amber-50/80 text-sm">
            <i class="fas fa-phone-alt text-[#BC430D] text-base"></i>
            <span>{{ Cache::get('store_phone', '+62 812-3456-7890') }}</span>
          </li>
          <li class="flex items-center justify-center sm:justify-start gap-3 text-amber-50/80 text-sm">
            <i class="fas fa-envelope text-[#BC430D] text-base"></i>
            <span>{{ Cache::get('store_email', 'support@sevencoffee.com') }}</span>
          </li>
        </ul>
      </div>

    </div>

    <div
      class="border-t border-white/10 mt-16 pt-8 flex flex-col md:flex-row justify-between items-center gap-4 text-xs font-secondary text-amber-50/50">
      <p class="text-center md:text-left tracking-wide">
        &copy;
        <script>
          document.write(new Date().getFullYear())
        </script> {{ Cache::get('store_name', 'Seven Coffee Company') }}. All rights reserved.
      </p>
    </div>
  </div>
</footer>
