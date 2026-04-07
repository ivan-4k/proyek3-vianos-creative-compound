<section class="w-full bg-[#F5F9F6] px-16 py-16">
    <div class="max-w-6xl mx-auto">

        {{-- Header --}}
        <div class="text-center mb-14">
            <h2 style="font-family: 'Playfair Display', serif;
                       font-size: 2.2rem;
                       font-weight: 700;
                       color: #2c1a0e;">
                Kenapa Memilih Kami?
            </h2>
            <p class="mt-3 mx-auto"
               style="font-size: 0.9rem;
                      color: #6b4f3a;
                      max-width: 420px;
                      line-height: 1.5;">
                Komitmen kami dalam menghadirkan kualitas, konsistensi, dan
                pengalaman terbaik untuk setiap pelanggan.
            </p>
        </div>

        {{-- Grid 4 fitur --}}
        <div class="grid grid-cols-4 gap-10">

            {{-- 1. Premium Beans --}}
            <div class="flex flex-col gap-4">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center"
                    style="background-color: #e8f5e9;">
                    <img src="{{ asset('images/about/beans.png') }}" alt="Premium Beans" class="w-20 h-20 object-contain">
                </div>
                <div>
                    <h3 style="font-family: 'Playfair Display', serif;
                               font-size: 1.05rem;
                               font-bold: 700;
                               font-weight: 800;
                               color: #2c1a0e;">
                        Premium Beans
                    </h3>
                    <p class="mt-2"
                       style="font-size: 0.85rem;
                              color: #6b4f3a;
                              line-height: 1.75;">
                        Menggunakan biji kopi pilihan dengan kualitas terjaga untuk rasa yang autentik.
                    </p>
                </div>
            </div>

            {{-- 2. Fresh Brew Daily --}}
            <div class="flex flex-col gap-4">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center"
                    style="background-color: #e8f5e9;">
                    <img src="{{ asset('images/about/cup.png') }}" alt="Fresh Brew" class="w-8 h-8 object-contain">
                </div>
                <div>
                    <h3 style="font-family: 'Playfair Display', serif;
                               font-size: 1.05rem;
                               font-bold: 700;
                               font-weight: 800;
                               color: #2c1a0e;">
                        Fresh Brew Daily
                    </h3>
                    <p class="mt-2"
                       style="font-size: 0.85rem;
                              color: #6b4f3a;
                              line-height: 1.75;">
                        Setiap menu diracik segar setiap hari dengan standar penyeduhan yang konsisten.
                    </p>
                </div>
            </div>

            {{-- 3. Smart Recommendation --}}
            <div class="flex flex-col gap-4">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center"
                     style="background-color: #e8f5e9;">
                    <img src="{{ asset('images/about/sparkle.png') }}" alt="Smart Recommendation" class="w-8 h-8 object-contain">
                </div>
                <div>
                    <h3 style="font-family: 'Playfair Display', serif;
                               font-size: 1.05rem;
                               font-bold: 700;
                               font-weight: 800;
                               color: #2c1a0e;">
                        Smart Recommendation
                    </h3>
                    <p class="mt-2"
                       style="font-size: 0.85rem;
                              color: #6b4f3a;
                              line-height: 1.75;">
                        Sistem rekomendasi membantu menemukan menu terbaik sesuai waktu dan tren.
                    </p>
                </div>
            </div>

            {{-- 4. Fast & Easy Order --}}
            <div class="flex flex-col gap-4">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center"
                     style="background-color: #e8f5e9;">
                    <img src="{{ asset('images/about/whatsapp.png') }}" alt="Fast Order" class="w-9 h-9 object-contain">
                </div>
                <div>
                    <h3 style="font-family: 'Playfair Display', serif;
                               font-size: 1.05rem;
                               font-bold: 700;
                               font-weight: 800;
                               color: #2c1a0e;">
                        Fast & Easy Order
                    </h3>
                    <p class="mt-2"
                       style="font-size: 0.85rem;
                              color: #6b4f3a;
                              line-height: 1.75;">
                        Pesan dengan mudah melalui WhatsApp, cepat dan responsif.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>