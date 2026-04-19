@props(['allMenus', 'categories', 'userFavorites'])

<section id="all-menu-section"
  class="py-12 sm:py-16 lg:py-24 relative overflow-hidden bg-white sm:px-6 md:px-8 lg:px-12 xl:px-[8%] px-4 font-secondary home-section-title"
  @hero-search.window="
      searchQuery = $event.detail; 
      fetchFilteredMenus();
  " x-data="{
      // STATE UNTUK FILTER AJAX & LOAD MORE SAJA
      nextPageUrl: '{{ $allMenus->nextPageUrl() ?? '' }}',
      hasMore: {{ $allMenus->hasMorePages() ? 'true' : 'false' }},
      isLoading: false,
      isFiltering: false,
      searchQuery: '{{ request('search') }}',
      selectedCategory: '{{ request('category') }}',
      selectedPrice: '{{ request('price') }}',
      selectedSort: '{{ request('sort') }}',
      typingTimer: null,
  
      get hasActiveFilters() {
          return this.searchQuery !== '' || this.selectedCategory !== '' || this.selectedPrice !== '' || this.selectedSort !== '';
      },
  
      resetFilters() {
          this.searchQuery = '';
          this.selectedCategory = '';
          this.selectedPrice = '';
          this.selectedSort = '';
          this.fetchFilteredMenus();
      },
  
      handleSearchInput() {
          clearTimeout(this.typingTimer);
          this.typingTimer = setTimeout(() => {
              this.fetchFilteredMenus();
          }, 500);
      },
  
      async fetchFilteredMenus() {
          this.isFiltering = true;
          const url = new URL('{{ route('menu.index') }}');
          if (this.searchQuery) url.searchParams.set('search', this.searchQuery);
          if (this.selectedCategory) url.searchParams.set('category', this.selectedCategory);
          if (this.selectedPrice) url.searchParams.set('price', this.selectedPrice);
          if (this.selectedSort) url.searchParams.set('sort', this.selectedSort);
  
          try {
              const response = await fetch(url, {
                  headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
              });
  
              if (response.ok) {
                  const data = await response.json();
                  document.getElementById('product-grid').innerHTML = data.html;
                  this.nextPageUrl = data.next_page_url;
                  this.hasMore = data.has_more;
                  window.history.pushState({}, '', url);
                  if (typeof initFlowbite === 'function') setTimeout(() => { initFlowbite(); }, 100);
              }
          } catch (error) { console.error(error); } finally { this.isFiltering = false; }
      },
  
      async loadMore() {
          if (!this.nextPageUrl || this.isLoading) return;
          this.isLoading = true;
          try {
              const response = await fetch(this.nextPageUrl, {
                  headers: { 'X-Requested-With': 'XMLHttpRequest' }
              });
              if (response.ok) {
                  const data = await response.json();
                  document.getElementById('product-grid').insertAdjacentHTML('beforeend', data.html);
                  this.nextPageUrl = data.next_page_url;
                  this.hasMore = data.has_more;
                  if (typeof initFlowbite === 'function') setTimeout(() => { initFlowbite(); }, 100);
              }
          } catch (error) { console.error(error); } finally { this.isLoading = false; }
      }
  }">

  <div class="max-w-7xl mx-auto px-4">

    {{-- HEADER JUDUL --}}
    <div class="text-center mb-12 lg:mb-16" data-aos="fade-up">
      <h2 class="font-bold mb-3 relative inline-block text-3xl md:text-4xl font-primary text-gray-900">
        Semua <span class="text-amber-600">Menu Kami</span>
      </h2>
      <p class="font-secondary text-gray-500 max-w-xl mx-auto text-base md:text-lg leading-relaxed">
        Eksplorasi koleksi lengkap minuman kami dan temukan rasa favoritmu.
      </p>
    </div>

    {{-- FORM FILTER --}}
    <div class="mb-12" data-aos="fade-up" data-aos-delay="50">
      <form @submit.prevent="fetchFilteredMenus" class="space-y-6">

        {{-- Search Bar (DENGAN DEBOUNCE x-on:input) --}}
        <div class="mb-6 max-w-2xl mx-auto relative group">
          <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
            <i class="fas fa-search text-gray-400 group-focus-within:text-amber-500 transition-colors"></i>
          </div>
          <input type="text" x-model="searchQuery" @input="handleSearchInput" placeholder="Cari menu favoritmu..."
            class="w-full pl-11 pr-4 py-3.5 bg-gray-50/50 border border-gray-200 rounded-2xl focus:outline-none focus:bg-white focus:border-amber-400 focus:ring-4 focus:ring-amber-500/10 transition-all font-secondary text-gray-700 shadow-sm">
        </div>

        {{-- Dropdowns (DENGAN x-model & @change) --}}
        <div class="grid grid-cols-2 md:grid-cols-3 gap-3 md:gap-4 max-w-4xl mx-auto">

          {{-- Kategori --}}
          <div class="relative">
            <select x-model="selectedCategory" @change="fetchFilteredMenus"
              class="w-full appearance-none bg-white border border-gray-200 rounded-xl px-4 py-3 pr-10 font-secondary text-gray-700 text-sm focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-500/20 cursor-pointer shadow-sm hover:border-amber-300 transition-colors">
              <option value="">📂 Semua Kategori</option>
              @foreach ($categories as $cat)
                <option value="{{ $cat->id_kategori }}">{{ $cat->name }}</option>
              @endforeach
            </select>
            <i
              class="fas fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none text-xs"></i>
          </div>

          {{-- Harga --}}
          <div class="relative">
            <select x-model="selectedPrice" @change="fetchFilteredMenus"
              class="w-full appearance-none bg-white border border-gray-200 rounded-xl px-4 py-3 pr-10 font-secondary text-gray-700 text-sm focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-500/20 cursor-pointer shadow-sm hover:border-amber-300 transition-colors">
              <option value="">💰 Rentang Harga</option>
              <option value="0-20000">Rp 0 - Rp 20.000</option>
              <option value="20000-35000">Rp 20.000 - Rp 35.000</option>
              <option value="35000-50000">Rp 35.000 - Rp 50.000</option>
              <option value="50000+">Rp 50.000+</option>
            </select>
            <i
              class="fas fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none text-xs"></i>
          </div>

          {{-- Sort --}}
          <div class="relative">
            <select x-model="selectedSort" @change="fetchFilteredMenus"
              class="w-full appearance-none bg-white border border-gray-200 rounded-xl px-4 py-3 pr-10 font-secondary text-gray-700 text-sm focus:outline-none focus:border-amber-400 focus:ring-2 focus:ring-amber-500/20 cursor-pointer shadow-sm hover:border-amber-300 transition-colors">
              <option value="">⭐ Urutkan</option>
              <option value="popular">Terpopuler</option>
              <option value="new">Terbaru</option>
              <option value="price-asc">Termurah</option>
              <option value="price-desc">Termahal</option>
            </select>
            <i
              class="fas fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none text-xs"></i>
          </div>
        </div>
      </form>

      {{-- BADGE FILTER AKTIF --}}
      <template x-if="hasActiveFilters">
        <div class="flex flex-wrap justify-center items-center gap-2 mt-5">
          <span class="text-sm text-gray-500 font-secondary mr-2"><i class="fas fa-filter text-amber-500 mr-1"></i>
            Filter Aktif:</span>

          <template x-if="searchQuery">
            <span
              class="inline-flex items-center gap-2 px-3 py-1 bg-amber-50 text-amber-700 border border-amber-100 rounded-full text-sm font-secondary"
              x-text="`Pencarian: '${searchQuery}'`"></span>
          </template>

          <template x-if="selectedCategory">
            <span
              class="inline-flex items-center gap-2 px-3 py-1 bg-amber-50 text-amber-700 border border-amber-100 rounded-full text-sm font-secondary">Kategori
              Terpilih</span>
          </template>

          <template x-if="selectedPrice">
            <span
              class="inline-flex items-center gap-2 px-3 py-1 bg-amber-50 text-amber-700 border border-amber-100 rounded-full text-sm font-secondary">Harga
              Difilter</span>
          </template>

          <template x-if="selectedSort">
            <span
              class="inline-flex items-center gap-2 px-3 py-1 bg-amber-50 text-amber-700 border border-amber-100 rounded-full text-sm font-secondary">Sedang
              Diurutkan</span>
          </template>

          <button @click="resetFilters"
            class="inline-flex items-center gap-2 px-3 py-1 bg-red-50 hover:bg-red-100 text-red-600 border border-red-100 rounded-full text-sm font-secondary transition-colors cursor-pointer ml-1">
            <span>Reset</span> <i class="fas fa-times text-xs"></i>
          </button>
        </div>
      </template>
    </div>

    {{-- GRID PRODUK (DENGAN EFEK OPACITY SAAT LOADING) --}}
    <div id="product-grid" :class="{ 'opacity-50 pointer-events-none': isFiltering }"
      class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8 mb-12 transition-opacity duration-300">
      @include('components.menu.all-menu-items', ['allMenus' => $allMenus])
    </div>

    {{-- TOMBOL LOAD MORE --}}
    <template x-if="hasMore">
      <div class="text-center" data-aos="fade-up">
        <button @click="loadMore" :disabled="isLoading"
          class="inline-flex items-center justify-center gap-3 bg-[#3E1E04] hover:bg-[#BC430D] text-white font-secondary font-bold py-3.5 px-8 rounded-full transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-1 group disabled:opacity-50 disabled:cursor-not-allowed">
          <span x-text="isLoading ? 'Memuat...' : 'Muat Lebih Banyak'"></span>
          <i class="fas fa-rotate-right transition-transform duration-500"
            :class="{ 'animate-spin': isLoading, 'group-hover:rotate-180': !isLoading }"></i>
        </button>
      </div>
    </template>

  </div>
</section>
