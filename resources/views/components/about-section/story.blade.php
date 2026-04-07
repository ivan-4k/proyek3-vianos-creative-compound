<section class="w-full bg-[#F5F9F6] px-16 py-16">
    <div class="max-w-6xl mx-auto">
        {{-- ROW 1: Gambar hati + Judul & subtitle --}}
        <div class="flex items-start justify-between mb-10">
            {{-- Gambar hati biji kopi --}}
            <div class="w-34 flex-shrink-0">
                <img src="{{ asset('images/about/heart.png') }}"
                    alt="Heart Coffee Beans"
                    class="w-full object-contain">
            </div>
            {{-- Judul kanan --}}
            <div class="flex flex-col items-end text-right">
                <h2 style="font-family: 'Playfair Display', serif;
                        font-size: 3rem;
                        font-weight: 700;
                        color: #2c1a0e;">
                    Cerita Kami
                </h2>
                <p style="font-size: 1rem;
                        color: #6b4f3a;
                        margin-top: 0.25rem;">
                    Kopi terbaik adalah kopi yang selalu ingin kamu ulang.
                </p>
            </div>
        </div>
        {{-- ROW 2: Grid foto kiri + Paragraf kanan --}}
        <div class="flex gap-12 items-start">
            {{-- KIRI: Grid foto --}}
            <div class="flex-shrink-0 w-96 flex flex-col gap-3">
                {{-- Foto besar atas --}}
                <div class="w-full rounded-xl overflow-hidden" style="height: 220px;">
                    <img src="{{ asset('images/about/coffee1.png') }}"
                        alt="Kopi 1"
                        class="w-full h-full object-cover">
                </div>
                {{-- Dua foto kecil bawah --}}
                <div class="flex gap-3">
                    <div class="flex-1 rounded-xl overflow-hidden" style="height: 160px;">
                        <img src="{{ asset('images/about/coffee2.png') }}"
                            alt="Kopi 2"
                            class="w-full h-full object-cover">
                    </div>
                    <div class="flex-1 rounded-xl overflow-hidden" style="height: 160px;">
                        <img src="{{ asset('images/about/coffee3.png') }}"
                            alt="Kopi 3"
                            class="w-full h-full object-cover">
                    </div>
                </div>
            </div>
            {{-- KANAN: Paragraf --}}
            <div class="flex-1 flex flex-col justify-center gap-5 pt-12"
                style="font-size: 1rem;
                        color: #3b2a1a;
                        line-height: 1.5;">
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