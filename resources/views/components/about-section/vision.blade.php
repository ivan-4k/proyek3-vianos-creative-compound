<section class="w-full px-16 py-16" style="background-color: #F3DEC5;">
    <div class="max-w-4xl mx-auto">
        {{-- Judul --}}
        <div class="flex items-center justify-center gap-3 mb-4">
            <img src="{{ asset('images/about/title.png') }}" alt="Title" class="w-50 h-50 object-contain">
        </div>
        {{-- Card Grid --}}
        <div class="grid grid-cols-2 gap-6">
            {{-- CARD VISI --}}
            <div class="rounded-2xl px-10 py-10 flex flex-col items-center text-center" style="background-color: #fdf6ee;">
                <img src="{{ asset('images/about/visi.png') }}" alt="Visi"
                    style="width: 100px; height: 100px;" class="object-contain mb-4">
                {{-- Judul Visi --}}
                <div class="flex items-center gap-3 mb-5">
                    <div style="border-top: 1.5px dotted #b8956a; width: 36px;"></div>
                    <h3 style="font-family: 'Playfair Display', serif;
                               font-size: 2rem;
                               font-weight: 700;
                               color: #2c1a0e;">
                        Visi
                    </h3>
                    <div style="border-top: 1.5px dotted #b8956a; width: 36px;"></div>
                </div>
                <p style="font-size: 1rem;
                          color: #5a3e28;
                          line-height: 1.85;">
                    Menjadi coffee shop terpercaya yang menghadirkan kualitas rasa konsisten
                    dengan pengalaman pemesanan yang praktis dan modern.
                </p>
            </div>
            {{-- CARD MISI --}}
            <div class="rounded-2xl px-10 py-10 flex flex-col items-center" style="background-color: #fdf6ee;">
                <img src="{{ asset('images/about/misi.png') }}" alt="Misi"
                     style="width: 100px; height: 100px;" class="object-contain mb-4">
                {{-- Judul Misi --}}
                <div class="flex items-center gap-3 mb-5">
                    <div style="border-top: 1.5px dotted #b8956a; width: 36px;"></div>
                    <h3 style="font-family: 'Playfair Display', serif;
                               font-size: 2rem;
                               font-weight: 700;
                               color: #2c1a0e;">
                        Misi
                    </h3>
                    <div style="border-top: 1.5px dotted #b8956a; width: 36px;"></div>
                </div>
                <ul class="flex flex-col gap-3 w-full"
                    style="font-size: 1rem;
                           color: #5a3e28;
                           line-height: 1.85;">
                    @foreach ([
                        'Menyajikan kopi berkualitas dari biji pilihan terbaik.',
                        'Menjaga konsistensi rasa dalam setiap sajian.',
                        'Memberikan pelayanan cepat dan responsif melalui WhatsApp.',
                        'Menghadirkan rekomendasi menu yang relevan sesuai waktu dan kebutuhan pelanggan.',
                    ] as $item)
                    <li class="flex items-start gap-3">
                        <span class="mt-1 flex-shrink-0 w-2.5 h-2.5 rounded-full"
                              style="background-color: #8b5e3c;"></span>
                        <span>{{ $item }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>