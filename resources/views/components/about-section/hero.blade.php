<div class="w-full p-24 bg-[#2c1a0e]">
    {{-- CARD: rounded dark dengan gambar kopi sebagai background --}}
    <div class="relative w-full overflow-hidden rounded-2xl flex items-center"
        style="min-width: 610px; min-height: 720px;">
        {{-- Gambar kopi --}}
        <img
            src="{{ asset('images/about/herobg.png') }}"
            alt="Biji Kopi"
            class="absolute inset-0 w-full h-full object-cover"
            style="object-position: center right;"
        >
        
        {{-- Teks --}}
<div class="relative z-10 w-full flex flex-col items-center justify-center text-center px-12 py-16">
    <h1 class="text-white leading-tight"
        style="font-family: 'Playfair Display', serif;
            font-size: 4rem;
            font-weight: 700;
            text-shadow: 0 2px 20px rgba(0,0,0,0.5);">
        {{ $title ?? 'Lebih dari Sekadar' }}<br>
        {{ $subtitle ?? 'Secangkir Kopi' }}
    </h1>
    <p class="mt-4 text-sm"
    style="font-family: 'Lato', sans-serif;
            font-weight: 300;
            color: rgba(245,230,211,0.78);
            line-height: 1.8;
            max-width: 380px;">
        {{ $description ?? 'Kami percaya setiap tegukan punya cerita. Dari biji kopi pilihan hingga racikan terbaik, semua disajikan untuk menemani harimu.' }}
    </p>
    <div class="mt-8">
        <a href="{{ $ctaUrl ?? route('menu') }}"
        class="inline-flex items-center gap-3 px-8 py-3 rounded-full
                border text-white text-xs font-light tracking-widest uppercase
                hover:bg-white hover:text-stone-900
                transition-all duration-300 group"
            style="border-color: rgba(255,255,255,0.75);
                font-family: 'Lato', sans-serif;">
            {{ $ctaLabel ?? 'Lihat Menu' }}
            <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover:translate-x-1"
                fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3"/>
            </svg>
        </a>
        </div>
        </div>
    </div>
</div>