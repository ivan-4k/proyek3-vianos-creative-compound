<section class="w-full bg-[#FDF6EE] py-16 lg:py-24 px-4 sm:px-6 lg:px-12 relative overflow-hidden home-section-title">
  @php
    $setting = \App\Models\CafeSetting::first();
    $now = \Carbon\Carbon::now('Asia/Jakarta');

    $isOpenNow = false;

    if ($setting) {
        $isWeekend = $now->isWeekend();
        $openStr = $isWeekend ? $setting->weekend_opening_time : $setting->weekday_opening_time;
        $closeStr = $isWeekend ? $setting->weekend_closing_time : $setting->weekday_closing_time;

        $startTime = \Carbon\Carbon::createFromFormat('H:i:s', $openStr, 'Asia/Jakarta');
        $endTime = \Carbon\Carbon::createFromFormat('H:i:s', $closeStr, 'Asia/Jakarta');

        // Logika Midnight Overlap (Tutup jam 02.00 pagi)
        if ($endTime->lt($startTime)) {
            if ($now->hour < $startTime->hour) {
                $startTime->subDay();
            } else {
                $endTime->addDay();
            }
        }
        $isOpenNow = $now->between($startTime, $endTime) && $setting->is_open;
    }
  @endphp

  <div class="absolute top-0 left-0 w-full h-full overflow-hidden opacity-40 pointer-events-none">
    <svg class="absolute -top-24 -left-24 w-96 h-96 text-[#e8d5c4]" fill="currentColor" viewBox="0 0 200 200"
      xmlns="http://www.w3.org/2000/svg">
      <path
        d="M44.7,-76.4C58.3,-69.2,70.1,-57.5,79.5,-43.8C88.9,-30.1,95.9,-15,96.3,0.2C96.7,15.5,90.4,30.9,81.1,44.7C71.8,58.5,59.5,70.6,44.8,77.7C30.2,84.7,15.1,86.6,0.5,85.8C-14.1,85.1,-28.3,81.7,-42.1,75C-55.9,68.2,-69.4,58.1,-77.9,44.7C-86.4,31.3,-89.9,15.7,-88.4,0.9C-86.9,-13.9,-80.4,-27.9,-71.8,-39.9C-63.2,-52,-52.5,-62.1,-39.9,-69.8C-27.4,-77.4,-13.7,-82.5,1.1,-84.3C15.9,-86.1,31.1,-83.7,44.7,-76.4Z"
        transform="translate(100 100)" />
    </svg>
  </div>

  <div class="max-w-7xl mx-auto relative z-10">
    {{-- Header --}}
    <div class="text-center max-w-3xl mx-auto mb-16 md:mb-20" data-aos="fade-up">
      <h2 class="font-primary text-3xl md:text-4xl font-semibold text-[#2c1a0e] mb-3 relative inline-block">Kunjungi
        Kedai Kami</h2>
      <p class="font-secondary text-base sm:text-lg md:text-xl text-[#6b4f3a] leading-relaxed">Temukan kami dan nikmati
        suasana ngopi yang nyaman
        secara langsung.</p>
    </div>

    {{-- Google Maps --}}
    <div
      class="w-full h-[350px] md:h-[500px] rounded-[2rem] overflow-hidden shadow-2xl mb-10 md:mb-16 border-[6px] border-white"
      data-aos="fade-up">
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.23456789!2d108.32456789!3d-6.32456789!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMTknMjguNCJTIDEwOMKwMTknMjguNCJF!5e0!3m2!1sid!2sid!4v1234567890"
        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" class="object-cover"></iframe>
    </div>

    {{-- Info Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
      <a href="#" target="_blank"
        class="group bg-white rounded-[1.5rem] p-8 shadow-lg hover:shadow-xl transition-all border border-[#e8d5c4]/50"
        data-aos="fade-up" data-aos-delay="200">
        <div
          class="w-12 h-12 bg-[#F5F9F6] text-[#BC430D] rounded-xl flex items-center justify-center text-2xl mb-5 group-hover:bg-[#BC430D] group-hover:text-white transition-all">
          <i class="fa-solid fa-map-location-dot"></i>
        </div>
        <h3 class="font-primary text-xl font-bold text-[#2c1a0e] mb-3">Alamat</h3>
        <p class="font-secondary text-sm md:text-base text-[#6b4f3a] leading-relaxed group-hover:text-[#BC430D]">
          Vianos Creative Compound, Jl. Veteran No.88, Lemahabang, Kec. Indramayu, Kabupaten Indramayu, Jawa Barat 45212
        </p>
      </a>

      <div class="bg-white rounded-[1.5rem] p-8 shadow-lg border border-[#e8d5c4]/50 flex flex-col" data-aos="fade-up"
        data-aos-delay="300">
        <div class="flex justify-between items-start mb-5">
          <div class="w-12 h-12 bg-[#F5F9F6] text-[#BC430D] rounded-xl flex items-center justify-center text-2xl">
            <i class="fa-regular fa-clock"></i>
          </div>

          @if ($isOpenNow)
            <span class="bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full border border-green-200">
              <i class="fa-solid fa-circle text-[8px] mr-1 mb-0.5 animate-pulse"></i> BUKA
            </span>
          @else
            <span class="bg-red-100 text-red-700 text-xs font-bold px-3 py-1 rounded-full border border-red-200">
              TUTUP
            </span>
          @endif
        </div>

        <h3 class="font-primary text-xl font-bold text-[#2c1a0e] mb-3">Jam Operasional</h3>
        <ul class="font-secondary text-sm md:text-base text-[#6b4f3a] flex flex-col gap-2">
          <li class="flex justify-between border-b border-gray-100 pb-2">
            <span>Senin - Jumat</span>
            <span class="font-semibold text-[#2c1a0e]">
              {{ $setting ? \Carbon\Carbon::parse($setting->weekday_opening_time)->format('H.i') : '09.00' }} -
              {{ $setting ? \Carbon\Carbon::parse($setting->weekday_closing_time)->format('H.i') : '02.00' }}
            </span>
          </li>
          <li class="flex justify-between pt-1">
            <span>Sabtu - Minggu</span>
            <span class="font-semibold text-[#2c1a0e]">
              {{ $setting ? \Carbon\Carbon::parse($setting->weekend_opening_time)->format('H.i') : '08.00' }} -
              {{ $setting ? \Carbon\Carbon::parse($setting->weekend_closing_time)->format('H.i') : '02.00' }}
            </span>
          </li>
        </ul>

        @if ($setting && $setting->is_open && !$setting->is_order_open)
          <div class="mt-4 p-3 bg-orange-50 rounded-lg border border-orange-100 flex items-start gap-2">
            <i class="fa-solid fa-circle-exclamation text-orange-500 mt-0.5"></i>
            <p class="text-xs text-orange-700 font-medium">Pemesanan online sedang ditutup sementara karena pesanan
              penuh.</p>
          </div>
        @endif
      </div>

      <a href="https://wa.me/6281234567890" target="_blank"
        class="group bg-white rounded-[1.5rem] p-8 shadow-lg hover:shadow-xl transition-all border border-[#e8d5c4]/50"
        data-aos="fade-up" data-aos-delay="400">
        <div
          class="w-12 h-12 bg-[#F5F9F6] text-[#25D366] rounded-xl flex items-center justify-center text-3xl mb-5 group-hover:bg-[#25D366] group-hover:text-white transition-all">
          <i class="fa-brands fa-whatsapp"></i>
        </div>
        <h3 class="font-primary text-xl font-bold text-[#2c1a0e] mb-3">WhatsApp</h3>
        <p class="font-secondary text-base text-[#6b4f3a] group-hover:text-[#25D366] transition-colors font-medium">+62
          812-3456-7890</p>
        <p class="text-xs text-gray-400 mt-2">Klik untuk chat reservasi atau pertanyaan.</p>
      </a>
    </div>
  </div>
</section>
