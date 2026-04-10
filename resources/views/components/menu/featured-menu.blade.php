@php
  // Data simulasi
  $featuredMenus = [
      [
          'id' => 1,
          'name' => 'Lungo Coffee',
          'desc' => 'Ekstraksi espresso lebih panjang untuk rasa yang lebih mild.',
          'price' => 30000,
          'badge' => 'Favorit',
          'color' => '78350f',
      ],
      [
          'id' => 2,
          'name' => 'Caramel Macchiato',
          'desc' => 'Perpaduan sempurna espresso, susu vanilla, dan saus karamel.',
          'price' => 35000,
          'badge' => 'Best Seller',
          'color' => '92400e',
      ],
      [
          'id' => 3,
          'name' => 'Matcha Espresso',
          'desc' => 'Matcha premium Jepang berpadu dengan ketegasan espresso.',
          'price' => 38000,
          'badge' => null,
          'color' => 'b45309',
      ],
      [
          'id' => 4,
          'name' => 'Hazelnut Latte',
          'desc' => 'Latte lembut dengan sirup hazelnut panggang yang harum.',
          'price' => 32000,
          'badge' => null,
          'color' => 'd97706',
      ],
  ];
@endphp

<section
  class="py-12 sm:py-16 lg:py-20 relative overflow-hidden bg-gray-50/50 sm:px-6 md:px-8 lg:px-12 xl:px-[8%] px-4 font-secondary home-section-title"
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

    <div class="text-center mb-12 lg:mb-16" data-aos="fade-up">
      <h2 class="font-bold mb-3 relative inline-block text-3xl md:text-4xl font-primary text-gray-900">
        Menu <span class="text-amber-600">Unggulan</span>
      </h2>
      <p class="font-secondary text-gray-500 max-w-xl mx-auto text-base md:text-lg leading-relaxed">
        Produk pilihan yang selalu jadi favorit pelanggan setia kami.
      </p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">

      @foreach ($featuredMenus as $index => $menu)
        <div
          class="group bg-white border border-gray-100 rounded-2xl shadow-sm hover:shadow-md hover:border-amber-300/40 transition-all duration-300 ease-in-out overflow-hidden flex flex-col"
          data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">

          <div class="relative overflow-hidden aspect-[4/3] bg-gray-100 m-2 rounded-xl">
            <img src="https://placehold.co/600x400/{{ $menu['color'] }}/ffffff?text={{ urlencode($menu['name']) }}"
              alt="{{ $menu['name'] }}"
              class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-in-out">

            <button type="button"
              class="absolute top-3 right-3 z-20 w-9 h-9 rounded-full bg-white/70 backdrop-blur-md flex items-center justify-center hover:bg-white transition-all shadow-sm"
              @click.stop="toggleFavorite({{ $menu['id'] }})">
              <i class="text-lg transition-transform duration-300"
                :class="isFavorite({{ $menu['id'] }}) ? 'fa-solid fa-heart text-red-500 scale-110' :
                    'fa-regular fa-heart text-gray-500'"></i>
            </button>

            @if ($menu['badge'])
              <div class="absolute top-3 left-3 z-20">
                <span
                  class="bg-amber-600/90 backdrop-blur-sm text-white text-[10px] uppercase tracking-wider font-bold px-3 py-1.5 rounded-md shadow-sm">
                  {{ $menu['badge'] }}
                </span>
              </div>
            @endif
          </div>

          <div class="p-5 flex flex-col flex-1">
            <h3
              class="font-primary text-xl font-bold text-gray-800 mb-1.5 group-hover:text-amber-600 transition-colors">
              {{ $menu['name'] }}
            </h3>
            <p class="font-secondary text-gray-500 text-sm leading-relaxed mb-4 line-clamp-2 flex-1">
              {{ $menu['desc'] }}
            </p>

            <div class="flex items-center justify-between pt-4 border-t border-gray-100 mt-auto">
              <div class="flex flex-col">
                <span class="font-primary text-lg font-bold text-gray-900">Rp
                  {{ number_format($menu['price'], 0, ',', '.') }}</span>
              </div>

              <button data-modal-target="featured-modal-{{ $menu['id'] }}"
                data-modal-toggle="featured-modal-{{ $menu['id'] }}"
                class="inline-flex items-center justify-center w-10 h-10 bg-amber-50 hover:bg-amber-600 text-amber-700 hover:text-white rounded-xl transition-all duration-300 group/btn shadow-sm">
                <i class="fas fa-plus text-lg group-hover/btn:rotate-90 transition-transform duration-300"></i>
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
        class="bg-gray-900 text-white px-6 py-3 rounded-2xl shadow-2xl flex items-center gap-3 text-sm font-secondary border border-gray-700">
        <div class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center">
          <i class="fas"
            :class="toastMsg?.includes('Ditambahkan') ? 'fa-heart text-red-400' : 'fa-trash text-gray-300'"></i>
        </div>
        <span x-text="toastMsg" class="font-medium"></span>
      </div>
    </div>
  </div>
</section>

@foreach ($featuredMenus as $menu)
  <div id="featured-modal-{{ $menu['id'] }}" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
      <div class="relative bg-white rounded-2xl shadow-xl border border-gray-100">

        <div class="flex items-center justify-between p-5 border-b border-gray-100 bg-gray-50/50 rounded-t-2xl">
          <h3 class="font-primary text-xl font-bold text-gray-900">{{ $menu['name'] }}</h3>
          <button type="button"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center transition-colors"
            data-modal-hide="featured-modal-{{ $menu['id'] }}">
            <i class="fas fa-times text-lg"></i>
          </button>
        </div>

        <div class="p-5">
          <div class="flex flex-col md:flex-row gap-6">
            <div class="md:w-1/2">
              <div class="aspect-square rounded-xl overflow-hidden bg-gray-100">
                <img
                  src="https://placehold.co/600x400/{{ $menu['color'] }}/ffffff?text={{ urlencode($menu['name']) }}"
                  alt="{{ $menu['name'] }}" class="w-full h-full object-cover">
              </div>
            </div>

            <div class="md:w-1/2 flex flex-col">
              <h4 class="font-primary text-lg font-bold text-gray-800 mb-2">Detail Produk</h4>
              <p class="font-secondary text-gray-500 text-sm mb-6 leading-relaxed">
                {{ $menu['desc'] }}
              </p>

              <div class="space-y-3 mb-6 bg-gray-50 p-3 rounded-xl">
                <div class="flex items-center gap-3 text-sm font-secondary">
                  <i class="fas fa-mug-hot text-amber-500 w-4"></i>
                  <span class="text-gray-700">Kategori: Espresso Base</span>
                </div>
                <div class="flex items-center gap-3 text-sm font-secondary">
                  <i class="fas fa-fire text-amber-500 w-4"></i>
                  <span class="text-gray-700">Kalori: 120 kcal</span>
                </div>
                <div class="flex items-center gap-3 text-sm font-secondary">
                  <i class="fas fa-temperature-half text-amber-500 w-4"></i>
                  <span class="text-gray-700">Tersedia: Panas & Dingin</span>
                </div>
              </div>

              <div class="mt-auto pt-4 border-t border-gray-100">
                <div class="font-primary text-2xl font-bold text-gray-900 mb-4">Rp
                  {{ number_format($menu['price'], 0, ',', '.') }}</div>
                <button
                  class="w-full bg-amber-600 hover:bg-amber-700 text-white font-medium py-3 px-4 rounded-xl flex items-center justify-center gap-2 transition-colors shadow-sm font-secondary">
                  <i class="fas fa-shopping-cart text-lg"></i> Tambah ke Keranjang
                </button>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
@endforeach
