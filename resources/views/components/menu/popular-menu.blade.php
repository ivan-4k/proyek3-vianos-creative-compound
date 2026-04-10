@php
  // Simulasi Data Menu Populer
  $popularMenus = [
      [
          'id' => 'p1',
          'rank' => 1,
          'name' => 'Caramel Macchiato',
          'desc' => 'Perpaduan sempurna espresso, susu vanilla, dan saus karamel.',
          'price' => 35000,
          'trend' => 'Naik 24% minggu ini',
          'color' => '92400e',
      ],
      [
          'id' => 'p2',
          'rank' => 2,
          'name' => 'Lungo Coffee',
          'desc' => 'Ekstraksi espresso lebih panjang untuk rasa yang lebih mild.',
          'price' => 30000,
          'trend' => 'Paling stabil',
          'color' => '78350f',
      ],
      [
          'id' => 'p3',
          'rank' => 3,
          'name' => 'Matcha Espresso',
          'desc' => 'Matcha premium Jepang berpadu dengan ketegasan espresso.',
          'price' => 38000,
          'trend' => 'Favorit Gen Z',
          'color' => 'b45309',
      ],
      [
          'id' => 'p4',
          'rank' => 4,
          'name' => 'Hazelnut Latte',
          'desc' => 'Latte lembut dengan sirup hazelnut panggang yang harum.',
          'price' => 32000,
          'trend' => 'Cocok untuk sore hari',
          'color' => 'd97706',
      ],
  ];
@endphp

<section
  class="py-12 sm:py-16 lg:py-20 relative overflow-hidden bg-white sm:px-6 md:px-8 lg:px-12 xl:px-[8%] px-4 font-secondary home-section-title"
  x-data="{
      favorites: [],
      toastMsg: null,
      toastVisible: false,
      toggleFavorite(productId) {
          if (this.favorites.includes(productId)) {
              this.favorites = this.favorites.filter(id => id !== productId);
              this.showToast('Dihapus dari favorit', 'remove');
          } else {
              this.favorites.push(productId);
              this.showToast('Ditambahkan ke favorit', 'add');
          }
      },
      isFavorite(productId) {
          return this.favorites.includes(productId);
      },
      showToast(message, type) {
          this.toastMsg = message;
          this.toastVisible = true;
          setTimeout(() => {
              this.toastVisible = false;
              setTimeout(() => { this.toastMsg = null; }, 300);
          }, 2500);
      }
  }">

  <div class="max-w-7xl mx-auto px-4">

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

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">

      @foreach ($popularMenus as $index => $menu)
        <div
          class="group relative bg-[#FBF8F5] border border-[#3E1E04]/5 rounded-2xl shadow-sm hover:shadow-md hover:border-[#BC430D]/30 transition-all duration-300 overflow-hidden flex flex-col"
          data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">

          <div
            class="absolute -right-4 -bottom-6 text-9xl font-black text-[#3E1E04]/5 font-primary pointer-events-none group-hover:scale-110 transition-transform duration-500">
            {{ $menu['rank'] }}
          </div>

          <div class="relative overflow-hidden aspect-[4/3] bg-gray-100 mx-2 mt-2 rounded-xl">
            <img src="https://placehold.co/600x400/{{ $menu['color'] }}/ffffff?text={{ urlencode($menu['name']) }}"
              alt="{{ $menu['name'] }}"
              class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-in-out">

            <button type="button"
              class="absolute top-3 right-3 z-20 w-8 h-8 rounded-full bg-white/70 backdrop-blur-md flex items-center justify-center hover:bg-white transition-all shadow-sm"
              @click.stop="toggleFavorite('{{ $menu['id'] }}')">
              <i class="text-base transition-transform duration-300"
                :class="isFavorite('{{ $menu['id'] }}') ? 'fa-solid fa-heart text-red-500 scale-110' :
                    'fa-regular fa-heart text-gray-600'"></i>
            </button>

            <div class="absolute top-3 left-3 z-20">
              <span
                class="bg-[#3E1E04]/90 backdrop-blur-sm text-white text-[10px] uppercase font-bold px-2.5 py-1 rounded-md shadow-sm flex items-center gap-1.5">
                <i class="fa-solid fa-medal text-amber-400"></i> Top {{ $menu['rank'] }}
              </span>
            </div>
          </div>

          <div class="p-5 flex flex-col flex-1 relative z-10">
            <h3 class="font-primary text-lg font-bold text-[#3E1E04] mb-1 group-hover:text-[#BC430D] transition-colors">
              {{ $menu['name'] }}
            </h3>

            <div class="text-[11px] text-[#BC430D] font-bold mb-3 flex items-center gap-1">
              <i class="fa-solid fa-fire text-orange-500"></i> {{ $menu['trend'] }}
            </div>

            <p class="font-secondary text-gray-500 text-sm leading-relaxed mb-4 line-clamp-2 flex-1">
              {{ $menu['desc'] }}
            </p>

            <div class="flex items-center justify-between pt-4 border-t border-[#3E1E04]/10 mt-auto">
              <span class="font-primary text-lg font-bold text-[#3E1E04]">Rp
                {{ number_format($menu['price'], 0, ',', '.') }}</span>

              <button data-modal-target="popular-modal-{{ $menu['id'] }}"
                data-modal-toggle="popular-modal-{{ $menu['id'] }}"
                class="text-sm font-bold text-[#BC430D] hover:text-[#3E1E04] flex items-center gap-1 transition-colors group/btn">
                Detail <i class="fas fa-arrow-right text-xs group-hover/btn:translate-x-1 transition-transform"></i>
              </button>
            </div>
          </div>
        </div>
      @endforeach

    </div>

    <div x-cloak x-show="toastVisible" x-transition:enter="transition ease-out duration-300"
      x-transition:enter-start="opacity-0 translate-y-10 scale-95"
      x-transition:enter-end="opacity-100 translate-y-0 scale-100" x-transition:leave="transition ease-in duration-200"
      x-transition:leave-start="opacity-100 translate-y-0 scale-100"
      x-transition:leave-end="opacity-0 translate-y-10 scale-95"
      class="fixed bottom-8 left-1/2 transform -translate-x-1/2 z-[100]">
      <div
        class="bg-[#3E1E04] text-white px-6 py-3 rounded-2xl shadow-2xl flex items-center gap-3 text-sm font-secondary">
        <div class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center">
          <i class="fas"
            :class="toastMsg?.includes('Ditambahkan') ? 'fa-heart text-red-400' : 'fa-trash text-gray-300'"></i>
        </div>
        <span x-text="toastMsg" class="font-medium"></span>
      </div>
    </div>
  </div>
</section>

@foreach ($popularMenus as $menu)
  <div id="popular-modal-{{ $menu['id'] }}" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
      <div class="relative bg-white rounded-2xl shadow-xl border border-gray-100">

        <div class="flex items-center justify-between p-5 border-b border-gray-100">
          <div class="flex items-center gap-3">
            <span class="bg-[#BC430D] text-white text-xs font-bold px-2 py-1 rounded-md">Top {{ $menu['rank'] }}</span>
            <h3 class="font-primary text-xl font-bold text-[#3E1E04]">{{ $menu['name'] }}</h3>
          </div>
          <button type="button"
            class="text-gray-400 bg-transparent hover:bg-gray-100 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
            data-modal-hide="popular-modal-{{ $menu['id'] }}">
            <i class="fas fa-times text-lg"></i>
          </button>
        </div>

        <div class="p-5">
          <div class="flex flex-col md:flex-row gap-6">
            <div class="md:w-1/2">
              <div class="aspect-[4/3] rounded-xl overflow-hidden">
                <img
                  src="https://placehold.co/600x400/{{ $menu['color'] }}/ffffff?text={{ urlencode($menu['name']) }}"
                  alt="{{ $menu['name'] }}" class="w-full h-full object-cover">
              </div>
            </div>

            <div class="md:w-1/2 flex flex-col">
              <p class="font-secondary text-gray-500 text-sm mb-4 leading-relaxed">
                {{ $menu['desc'] }}
              </p>

              <div class="space-y-2 mb-6">
                <div class="flex items-center gap-2 text-sm font-secondary">
                  <i class="fas fa-fire text-orange-500 w-5"></i>
                  <span class="text-gray-700 font-medium">{{ $menu['trend'] }}</span>
                </div>
                <div class="flex items-center gap-2 text-sm font-secondary">
                  <i class="fas fa-temperature-half text-[#BC430D] w-5"></i>
                  <span class="text-gray-700">Tersedia: Panas & Dingin</span>
                </div>
              </div>

              <div class="mt-auto pt-4 border-t border-gray-100">
                <div class="font-primary text-2xl font-bold text-[#3E1E04] mb-4">Rp
                  {{ number_format($menu['price'], 0, ',', '.') }}</div>
                <button
                  class="w-full bg-[#3C6B3E] hover:bg-[#2A4D2B] text-white font-medium py-2.5 px-4 rounded-xl flex items-center justify-center gap-2 transition-colors shadow-sm font-secondary">
                  <i class="fa-brands fa-whatsapp text-lg"></i> Pesan Sekarang
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endforeach
