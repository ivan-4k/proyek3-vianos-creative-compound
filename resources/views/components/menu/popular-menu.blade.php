@props(['popularMenus', 'userFavorites'])

<section
  class="py-12 sm:py-16 lg:py-20 relative overflow-hidden bg-white sm:px-6 md:px-8 lg:px-12 xl:px-[8%] px-4 font-secondary home-section-title">

  <div class="max-w-7xl mx-auto px-4">

    {{-- HEADER JUDUL --}}
    <div class="flex flex-col items-center text-center mb-12 lg:mb-16" data-aos="fade-up">
      <div
        class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-orange-50 text-[#BC430D] text-sm font-bold mb-3 border border-orange-100">
        <i class="fa-solid fa-arrow-trend-up"></i> Top Trending
      </div>
      <h2 class="font-bold mb-3 inline-block relative text-3xl md:text-4xl font-primary text-[#3E1E04]">
        Sedang <span class="text-[#BC430D]">Populer Saat Ini</span>
      </h2>
      <p class="font-secondary text-gray-500 max-w-xl mx-auto text-base md:text-lg leading-relaxed">
        Pilihan terbaik yang paling sering dipesan oleh pelanggan minggu ini. Jangan sampai kelewatan!
      </p>
    </div>

    {{-- GRID PRODUK --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">

      @forelse ($popularMenus as $menu)
        <div
          class="group relative bg-[#FBF8F5] border border-[#3E1E04]/5 rounded-2xl shadow-sm hover:shadow-md hover:border-[#BC430D]/30 transition-all duration-300 overflow-hidden flex flex-col"
          data-aos="fade-up" data-aos-delay="{{ ($loop->iteration - 1) * 100 }}">

          {{-- Angka Background Besar --}}
          <div
            class="absolute -right-4 -bottom-6 text-9xl font-black text-[#3E1E04]/5 font-primary pointer-events-none group-hover:scale-110 transition-transform duration-500">
            {{ $loop->iteration }}
          </div>

          <div class="relative overflow-hidden aspect-[4/3] bg-gray-100 mx-2 mt-2 rounded-xl">
            <img
              src="{{ $menu->main_image ? asset('storage/' . $menu->main_image) : asset('images/default/herobg.png') }}"
              alt="{{ $menu->name }}"
              class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-in-out"
              loading="lazy">

            {{-- TOMBOL FAVORIT --}}
            <button type="button"
              class="absolute top-3 right-3 z-20 w-8 h-8 rounded-full bg-white/70 backdrop-blur-md flex items-center justify-center hover:bg-white transition-all shadow-sm"
              @click.stop="toggleFavorite({{ $menu->id_produk }})">
              <i class="text-base transition-transform duration-300"
                :class="isFavorite({{ $menu->id_produk }}) ? 'fa-solid fa-heart text-red-500 scale-110' :
                    'fa-regular fa-heart text-gray-600 hover:scale-110'"></i>
            </button>

            <div class="absolute top-3 left-3 z-20">
              <span
                class="bg-[#3E1E04]/90 backdrop-blur-sm text-white text-[10px] uppercase font-bold px-2.5 py-1 rounded-md shadow-sm flex items-center gap-1.5">
                <i class="fa-solid fa-medal text-amber-400"></i> Top {{ $loop->iteration }}
              </span>
            </div>
          </div>

          <div class="p-5 flex flex-col flex-1 relative z-10">
            <h3 class="font-primary text-lg font-bold text-[#3E1E04] mb-1 group-hover:text-[#BC430D] transition-colors">
              {{ $menu->name }}
            </h3>

            <div class="text-[11px] text-[#BC430D] font-bold mb-3 flex items-center gap-1">
              <i class="fa-solid fa-fire text-orange-500"></i> Hot Item
            </div>

            <p class="font-secondary text-gray-500 text-sm leading-relaxed mb-4 line-clamp-2 flex-1">
              {{ $menu->description ?? 'Produk populer dengan kualitas terbaik.' }}
            </p>

            <div class="flex items-center justify-between pt-4 border-t border-[#3E1E04]/10 mt-auto">
              <span class="font-primary text-lg font-bold text-[#3E1E04]">Rp
                {{ number_format($menu->price, 0, ',', '.') }}</span>

              <button data-modal-target="popular-modal-{{ $menu->id_produk }}"
                data-modal-toggle="popular-modal-{{ $menu->id_produk }}"
                class="text-sm font-bold text-[#BC430D] hover:text-[#3E1E04] flex items-center gap-1 transition-colors group/btn">
                Detail <i class="fas fa-arrow-right text-xs group-hover/btn:translate-x-1 transition-transform"></i>
              </button>
            </div>
          </div>
        </div>
      @empty
        {{-- TAMPILAN JIKA BELUM ADA MENU POPULER --}}
        <div class="col-span-1 sm:col-span-2 lg:col-span-4 flex flex-col items-center justify-center py-16 text-center"
          data-aos="fade-up">
          <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mb-6 border border-gray-100">
            <i class="fas fa-chart-line text-4xl text-gray-300"></i>
          </div>
          <h3 class="font-primary text-2xl font-bold text-gray-800 mb-2">Belum Ada Tren Saat Ini</h3>
          <p class="font-secondary text-gray-500 max-w-md mx-auto">
            Data pesanan sedang dikumpulkan. Jadilah yang pertama menentukan tren dengan memesan menu favorit Anda!
          </p>
        </div>
      @endforelse

    </div>

  </div>
</section>

{{-- MODAL DETAIL PRODUK --}}
@foreach ($popularMenus as $menu)
  <div id="popular-modal-{{ $menu->id_produk }}" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-[110] justify-center items-end md:items-center w-full h-full bg-gray-900/70 backdrop-blur-sm transition-opacity">

    <div
      class="relative w-full max-w-4xl h-[95vh] md:h-auto md:max-h-[90vh] md:p-4 flex items-end md:items-center justify-center transition-transform">
      <div
        class="relative bg-white rounded-t-3xl md:rounded-2xl shadow-2xl border border-[#3E1E04]/10 w-full h-full md:h-auto md:max-h-full overflow-hidden flex flex-col">

        {{-- HEADER --}}
        <div
          class="sticky top-0 bg-white/95 backdrop-blur-md z-20 flex items-center justify-between p-4 md:px-6 border-b border-[#3E1E04]/10">
          <div class="flex items-center gap-3">
            <span
              class="bg-[#BC430D] text-white text-sm font-black px-2.5 py-1 rounded-lg shadow-sm flex items-center gap-1">
              <i class="fa-solid fa-medal text-amber-300 text-xs"></i> #{{ $loop->iteration }}
            </span>
            <h3 class="font-primary text-lg md:text-xl font-bold text-[#3E1E04] line-clamp-1">{{ $menu->name }}</h3>
          </div>
          <button type="button"
            class="text-gray-400 bg-gray-50 hover:bg-red-50 hover:text-red-500 rounded-full text-sm w-9 h-9 flex items-center justify-center transition-all shrink-0"
            data-modal-hide="popular-modal-{{ $menu->id_produk }}">
            <i class="fas fa-times text-lg"></i>
          </button>
        </div>

        {{-- CONTENT: 1 Kolom Mobile, 2 Kolom Desktop --}}
        <div class="flex-1 overflow-y-auto flex flex-col md:flex-row">

          {{-- Kiri: Gambar Produk --}}
          <div
            class="w-full md:w-1/2 md:border-r border-[#3E1E04]/5 bg-[#FBF8F5] p-4 md:p-6 flex flex-col justify-center">
            <div class="relative aspect-square md:aspect-[4/3] rounded-2xl overflow-hidden bg-gray-100 shadow-inner">
              <img
                src="{{ $menu->main_image ? asset('storage/' . $menu->main_image) : asset('images/default/herobg.png') }}"
                alt="{{ $menu->name }}"
                class="w-full h-full object-cover hover:scale-105 transition-transform duration-700" loading="lazy">

              {{-- Overlay Hot Item di dalam gambar khusus Desktop --}}
              <div
                class="hidden md:block absolute bottom-3 left-3 bg-white/90 backdrop-blur-sm px-3 py-1.5 rounded-lg shadow-sm">
                <span class="text-xs font-bold text-[#BC430D] flex items-center gap-1.5">
                  <i class="fa-solid fa-fire text-orange-500"></i> Paling Diminati
                </span>
              </div>
            </div>
          </div>

          {{-- Kanan: Informasi Produk --}}
          <div class="w-full md:w-1/2 p-5 md:p-6 flex flex-col gap-6">

            {{-- Badge Mobile --}}
            <div class="md:hidden flex flex-wrap gap-2 mb-[-10px]">
              <span
                class="bg-orange-50 text-[#BC430D] border border-orange-100 text-xs font-bold px-2.5 py-1 rounded-md flex items-center gap-1.5">
                <i class="fa-solid fa-fire text-orange-500"></i> Hot Item
              </span>
            </div>

            {{-- Deskripsi --}}
            <div>
              <h4 class="font-primary text-sm uppercase tracking-wider font-bold text-gray-400 mb-2">Deskripsi</h4>
              <p class="font-secondary text-gray-600 text-sm md:text-base leading-relaxed">
                {{ $menu->description ?? 'Produk populer dengan kualitas terbaik dan rasa yang tak terlupakan.' }}
              </p>
            </div>

            {{-- Spesifikasi --}}
            <div class="space-y-3 bg-[#FBF8F5] border border-[#3E1E04]/5 p-4 rounded-xl">
              <div class="flex items-center gap-3 text-sm font-secondary">
                <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center shadow-sm shrink-0">
                  <i class="fas fa-fire text-orange-500"></i>
                </div>
                <span class="text-[#3E1E04] font-medium flex-1">Hot Item <span
                    class="font-normal text-gray-500 block text-xs">Paling Banyak Dipesan Minggu Ini</span></span>
              </div>

              <div class="flex items-center gap-3 text-sm font-secondary">
                <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center shadow-sm shrink-0">
                  <i class="fas fa-temperature-half text-[#BC430D]"></i>
                </div>
                <span class="text-[#3E1E04] font-medium flex-1">Sajian <span
                    class="font-normal text-gray-500 block text-xs">Tersedia Panas & Dingin</span></span>
              </div>
            </div>

          </div>
        </div>

        {{-- FOOTER --}}
        <div
          class="sticky bottom-0 bg-white border-t border-gray-100 p-4 md:px-6 md:py-5 z-20 shadow-[0_-10px_20px_-10px_rgba(0,0,0,0.05)]">
          <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">

            <div class="flex items-center justify-between md:justify-start md:gap-4">
              <span class="text-sm text-gray-500 font-secondary md:hidden">Harga Spesial</span>
              <div class="flex flex-col">
                <span
                  class="text-xs text-gray-400 font-secondary hidden md:block uppercase font-bold tracking-wider mb-1">Harga
                  Spesial</span>
                <div class="font-primary text-2xl font-bold text-amber-600">Rp
                  {{ number_format($menu->price, 0, ',', '.') }}</div>
              </div>
            </div>

            <div class="flex gap-3 md:w-auto">
              <button
                class="px-5 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-xl flex items-center justify-center gap-2 transition-colors font-secondary"
                data-modal-hide="popular-modal-{{ $menu->id_produk }}">
                Kembali
              </button>

              <button type="button" x-data="{ isAdding: false, added: false }"
                @click.prevent="
      @auth
if(isAdding || {{ !$menu->is_available ? 'true' : 'false' }}) return;
          
          isAdding = true;
          
          fetch('{{ route('cart.add') }}', {
              method: 'POST',
              headers: {
                  'Content-Type': 'application/json',
                  'X-CSRF-TOKEN': '{{ csrf_token() }}',
                  'Accept': 'application/json'
              },
              body: JSON.stringify({ 
                  id_produk: {{ $menu->id_produk }}, 
                  quantity: 1 
              })
          })
          .then(response => response.json())
          .then(data => {
              isAdding = false;
              if(data.success) {
                  added = true;
                  // Trigger event agar Navbar otomatis update angkanya
                  window.dispatchEvent(new CustomEvent('cart-updated', { detail: { count: data.cart_count } }));
                  
                  // Kembalikan tombol ke kondisi semula setelah 2 detik
                  setTimeout(() => { added = false; }, 2000);
              }
          })
          .catch(error => {
              isAdding = false;
              alert('Terjadi kesalahan pada server.');
              console.error('Error:', error);
          });
      @else
          // Arahkan ke halaman login jika user belum masuk
          window.location.href = '{{ route('login') }}'; @endauth
        "
                class="flex-1
                md:w-64 text-white font-bold py-3 px-6 rounded-xl flex items-center justify-center gap-2 transition-all
                shadow-md font-secondary {{ !$menu->is_available ? 'bg-gray-400 opacity-50 cursor-not-allowed' : '' }}"
                :class="{
                    'bg-[#BC430D] hover:bg-[#9e380b] shadow-[#BC430D]/20 hover:-translate-y-0.5': !isAdding && !added &&
                        {{ $menu->is_available ? 'true' : 'false' }},
                    'bg-[#9e380b] opacity-75 cursor-wait': isAdding,
                    'bg-green-600': added
                }"
                {{ !$menu->is_available ? 'disabled' : '' }}>

                {{-- State Default --}}
                <template x-if="!isAdding && !added">
                  <div class="flex items-center gap-2">
                    <i class="fas fa-shopping-cart text-lg"></i>
                    <span>{{ $menu->is_available ? 'Tambah Keranjang' : 'Stok Habis' }}</span>
                  </div>
                </template>

                {{-- State Loading --}}
                <template x-if="isAdding">
                  <div class="flex items-center gap-2">
                    <i class="fas fa-spinner fa-spin text-lg"></i>
                    <span>Memproses...</span>
                  </div>
                </template>

                {{-- State Sukses --}}
                <template x-if="added">
                  <div class="flex items-center gap-2">
                    <i class="fas fa-check text-lg"></i>
                    <span>Berhasil!</span>
                  </div>
                </template>
              </button>
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>
@endforeach
