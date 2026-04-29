<aside id="logo-sidebar"
  class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-900 dark:border-gray-800"
  aria-label="Sidebar navigasi admin">
  <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-900 scrollbar-hide">
    <ul class="space-y-1.5 font-medium">

      {{-- SECTION: UTAMA --}}
      <div class="px-3 py-3 mb-4">
        <p class="text-[11px] font-extrabold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Menu Utama</p>
      </div>

      {{-- Dashboard --}}
      <li>
        <a href="{{ route('admin.dashboard') }}"
          class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg transition-all duration-200 group
          {{ request()->routeIs('admin.dashboard')
              ? 'bg-gradient-to-r from-blue-50 to-blue-100/50 dark:from-blue-900/40 dark:to-blue-800/30 text-blue-700 dark:text-blue-300 shadow-sm'
              : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/50' }}"
          title="Halaman Dashboard">
          <svg
            class="w-5 h-5 flex-shrink-0 transition-colors duration-200
            {{ request()->routeIs('admin.dashboard')
                ? 'text-blue-600 dark:text-blue-400'
                : 'text-gray-400 dark:text-gray-500 group-hover:text-gray-600 dark:group-hover:text-gray-400' }}"
            aria-hidden="true" fill="currentColor" viewBox="0 0 22 21">
            <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
            <path
              d="M12.5 0c-.157 0-.311.01-.465.03A1 1 0 0 0 11 1.07V9h7.93c.517 0 .934-.403.969-.916A8.5 8.5 0 0 0 12.5 0Z" />
          </svg>
          <span class="text-sm font-semibold">Dashboard</span>
        </a>
      </li>

      {{-- SECTION: OPERASIONAL --}}
      <div class="my-5 border-t border-gray-200 dark:border-gray-700/50"></div>
      <div class="px-3 py-3 mb-3">
        <p class="text-[11px] font-extrabold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Operasional Kafe
        </p>
      </div>

      {{-- Manajemen Pesanan --}}
      <li>
        <a href="{{ route('admin.orders.index') }}"
          class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg transition-all duration-200 group relative
          {{ request()->routeIs('admin.orders.*')
              ? 'bg-gradient-to-r from-amber-50 to-amber-100/50 dark:from-amber-900/40 dark:to-amber-800/30 text-amber-700 dark:text-amber-300 shadow-sm'
              : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/50' }}"
          title="Kelola pesanan pelanggan">
          <svg
            class="w-5 h-5 flex-shrink-0 transition-colors duration-200
            {{ request()->routeIs('admin.orders.*')
                ? 'text-amber-600 dark:text-amber-400'
                : 'text-gray-400 dark:text-gray-500 group-hover:text-gray-600 dark:group-hover:text-gray-400' }}"
            fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
          </svg>
          <span class="text-sm font-semibold flex-1">Manajemen Pesanan</span>
          @php $pendingCount = \App\Models\Order::where('order_status', 'pending_confirmation')->count(); @endphp
          @if ($pendingCount > 0)
            <span
              class="inline-flex items-center justify-center min-w-[24px] h-6 px-2 text-xs font-bold text-white bg-gradient-to-r from-red-500 to-red-600 rounded-full shadow-md animate-pulse">
              {{ $pendingCount }}
            </span>
          @endif
        </a>
      </li>

      {{-- Katalog Produk Dropdown --}}
      <li>
        @php $isMenuOpen = request()->routeIs('admin.menu.*') || request()->routeIs('admin.categories.*'); @endphp
        <button type="button"
          class="flex items-center justify-between w-full gap-3 px-3.5 py-2.5 text-sm font-semibold transition-all duration-200 rounded-lg group
          {{ $isMenuOpen
              ? 'bg-gradient-to-r from-purple-50 to-purple-100/50 dark:from-purple-900/40 dark:to-purple-800/30 text-purple-700 dark:text-purple-300 shadow-sm'
              : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/50' }}"
          aria-controls="dropdown-menu" data-collapse-toggle="dropdown-menu" title="Kelola katalog produk">
          <div class="flex items-center gap-3">
            <svg
              class="w-5 h-5 flex-shrink-0 transition-colors duration-200
              {{ $isMenuOpen
                  ? 'text-purple-600 dark:text-purple-400'
                  : 'text-gray-400 dark:text-gray-500 group-hover:text-gray-600 dark:group-hover:text-gray-400' }}"
              fill="currentColor" viewBox="0 0 18 20">
              <path
                d="M17 5.923A1 1 0 0 0 16 5h-3V4a4 4 0 1 0-8 0v1H2a1 1 0 0 0-1 .923L.086 17.846A2 2 0 0 0 2.08 20h13.84a2 2 0 0 0 1.994-2.153L17 5.923ZM7 9a1 1 0 0 1-2 0V7h2v2Zm6 0a1 1 0 1 1-2 0V7h2v2Z" />
            </svg>
            <span>Katalog Produk</span>
          </div>
          <svg class="w-4 h-4 transition-transform duration-300 {{ $isMenuOpen ? 'rotate-180' : '' }}" fill="none"
            viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
              d="m1 1 4 4 4-4" />
          </svg>
        </button>
        <ul id="dropdown-menu" class="{{ $isMenuOpen ? '' : 'hidden' }} py-2 space-y-1 ml-2 mt-1">
          <li>
            <a href="{{ route('admin.menu.index') }}"
              class="flex items-center gap-3 px-3.5 py-2 text-sm rounded-lg transition-all duration-200
              {{ request()->routeIs('admin.menu.index')
                  ? 'text-purple-700 dark:text-purple-300 bg-purple-100/50 dark:bg-purple-900/30 font-semibold'
                  : 'text-gray-700 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/30' }}">
              <span
                class="w-1.5 h-1.5 rounded-full {{ request()->routeIs('admin.menu.index') ? 'bg-purple-600 dark:bg-purple-400' : 'bg-gray-300 dark:bg-gray-600' }}"></span>
              Semua Menu
            </a>
          </li>
          <li>
            <a href="{{ route('admin.categories.index') }}"
              class="flex items-center gap-3 px-3.5 py-2 text-sm rounded-lg transition-all duration-200
              {{ request()->routeIs('admin.categories.index')
                  ? 'text-purple-700 dark:text-purple-300 bg-purple-100/50 dark:bg-purple-900/30 font-semibold'
                  : 'text-gray-700 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/30' }}">
              <span
                class="w-1.5 h-1.5 rounded-full {{ request()->routeIs('admin.categories.index') ? 'bg-purple-600 dark:bg-purple-400' : 'bg-gray-300 dark:bg-gray-600' }}"></span>
              Kategori Menu
            </a>
          </li>
          <li>
            <a href="{{ route('admin.menu.index', ['filter' => 'featured']) }}"
              class="flex items-center gap-3 px-3.5 py-2 text-sm rounded-lg transition-all duration-200
              {{ request()->fullUrlIs(route('admin.menu.index', ['filter' => 'featured']))
                  ? 'text-purple-700 dark:text-purple-300 bg-purple-100/50 dark:bg-purple-900/30 font-semibold'
                  : 'text-gray-700 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/30' }}">
              <span
                class="w-1.5 h-1.5 rounded-full {{ request()->fullUrlIs(route('admin.menu.index', ['filter' => 'featured'])) ? 'bg-purple-600 dark:bg-purple-400' : 'bg-gray-300 dark:bg-gray-600' }}"></span>
              Menu Unggulan
            </a>
          </li>
        </ul>
      </li>

      {{-- Stok Harian --}}
      <li>
        <a href="#"
          class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg transition-all duration-200 group text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/50 opacity-60 cursor-not-allowed"
          title="Fitur Stok Harian sedang dalam pengembangan" onclick="event.preventDefault()">
          <svg
            class="w-5 h-5 flex-shrink-0 text-gray-400 dark:text-gray-500 group-hover:text-gray-600 dark:group-hover:text-gray-400 transition-colors duration-200"
            fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
          </svg>
          <span class="text-sm font-semibold">Stok Harian</span>
          <span
            class="ml-auto text-xs bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-400 px-2 py-0.5 rounded">Soon</span>
        </a>
      </li>

      {{-- SECTION: MANAJEMEN SISTEM --}}
      <div class="my-5 border-t border-gray-200 dark:border-gray-700/50"></div>
      <div class="px-3 py-3 mb-3">
        <p class="text-[11px] font-extrabold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Sistem & Tim</p>
      </div>

      {{-- Manajemen Tim --}}
      <li>
        <a href="{{ route('admin.users.index') }}"
          class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg transition-all duration-200 group
          {{ request()->routeIs('admin.users.*')
              ? 'bg-gradient-to-r from-green-50 to-green-100/50 dark:from-green-900/40 dark:to-green-800/30 text-green-700 dark:text-green-300 shadow-sm'
              : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/50' }}"
          title="Kelola tim dan pengguna">
          <svg
            class="w-5 h-5 flex-shrink-0 transition-colors duration-200
            {{ request()->routeIs('admin.users.*')
                ? 'text-green-600 dark:text-green-400'
                : 'text-gray-400 dark:text-gray-500 group-hover:text-gray-600 dark:group-hover:text-gray-400' }}"
            fill="currentColor" viewBox="0 0 20 20">
            <path
              d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a7 7 0 00-7 7v1h11v-1a6.97 6.97 0 00-1.5-4.33A5 5 0 016 11z" />
          </svg>
          <span class="text-sm font-semibold">Manajemen Tim</span>
        </a>
      </li>

      <li>
        <a href="{{ route('admin.notifications.index') }}"
          class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg transition-all duration-200 group
          {{ request()->routeIs('admin.notifications.*')
              ? 'bg-gradient-to-r from-cyan-50 to-cyan-100/50 dark:from-cyan-900/40 dark:to-cyan-800/30 text-cyan-700 dark:text-cyan-300 shadow-sm'
              : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/50' }}"
          title="Kelola notifikasi pengguna">
          <svg
            class="w-5 h-5 flex-shrink-0 transition-colors duration-200
            {{ request()->routeIs('admin.notifications.*')
                ? 'text-cyan-600 dark:text-cyan-400'
                : 'text-gray-400 dark:text-gray-500 group-hover:text-gray-600 dark:group-hover:text-gray-400' }}"
            fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 2a6 6 0 00-6 6v3.586l-1.707 1.707A1 1 0 003 15h14a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6z" />
            <path d="M7 18a3 3 0 006 0H7z" />
          </svg>
          <span class="text-sm font-semibold">Notifikasi User</span>
        </a>
      </li>

      {{-- Log & Laporan Dropdown --}}
      <li>
        @php $isLogsOpen = request()->routeIs('admin.activity-logs.*') || request()->routeIs('admin.whatsapp-logs.*') || request()->routeIs('admin.reports.*'); @endphp
        <button type="button"
          class="flex items-center justify-between w-full gap-3 px-3.5 py-2.5 text-sm font-semibold transition-all duration-200 rounded-lg group
          {{ $isLogsOpen
              ? 'bg-gradient-to-r from-cyan-50 to-cyan-100/50 dark:from-cyan-900/40 dark:to-cyan-800/30 text-cyan-700 dark:text-cyan-300 shadow-sm'
              : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/50' }}"
          aria-controls="dropdown-logs" data-collapse-toggle="dropdown-logs" title="Lihat log dan laporan sistem">
          <div class="flex items-center gap-3">
            <svg
              class="w-5 h-5 flex-shrink-0 transition-colors duration-200
              {{ $isLogsOpen
                  ? 'text-cyan-600 dark:text-cyan-400'
                  : 'text-gray-400 dark:text-gray-500 group-hover:text-gray-600 dark:group-hover:text-gray-400' }}"
              fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <span>Log & Laporan</span>
          </div>
          <svg class="w-4 h-4 transition-transform duration-300 {{ $isLogsOpen ? 'rotate-180' : '' }}" fill="none"
            viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
              d="m1 1 4 4 4-4" />
          </svg>
        </button>
        <ul id="dropdown-logs" class="{{ $isLogsOpen ? '' : 'hidden' }} py-2 space-y-1 ml-2 mt-1">
          <li>
            <a href="{{ route('admin.activity-logs.index') }}"
              class="flex items-center gap-3 px-3.5 py-2 text-sm rounded-lg transition-all duration-200
              {{ request()->routeIs('admin.activity-logs.*')
                  ? 'text-cyan-700 dark:text-cyan-300 bg-cyan-100/50 dark:bg-cyan-900/30 font-semibold'
                  : 'text-gray-700 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/30' }}">
              <span
                class="w-1.5 h-1.5 rounded-full {{ request()->routeIs('admin.activity-logs.*') ? 'bg-cyan-600 dark:bg-cyan-400' : 'bg-gray-300 dark:bg-gray-600' }}"></span>
              Log Aktivitas
            </a>
          </li>
          <li>
            <a href="{{ route('admin.whatsapp-logs.index') }}"
              class="flex items-center gap-3 px-3.5 py-2 text-sm rounded-lg transition-all duration-200
              {{ request()->routeIs('admin.whatsapp-logs.*')
                  ? 'text-cyan-700 dark:text-cyan-300 bg-cyan-100/50 dark:bg-cyan-900/30 font-semibold'
                  : 'text-gray-700 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/30' }}">
              <span
                class="w-1.5 h-1.5 rounded-full {{ request()->routeIs('admin.whatsapp-logs.*') ? 'bg-cyan-600 dark:bg-cyan-400' : 'bg-gray-300 dark:bg-gray-600' }}"></span>
              Log WhatsApp
            </a>
          </li>
          <li>
            <a href="{{ route('admin.reports.index') }}"
              class="flex items-center gap-3 px-3.5 py-2 text-sm rounded-lg transition-all duration-200
              {{ request()->routeIs('admin.reports.*')
                  ? 'text-cyan-700 dark:text-cyan-300 bg-cyan-100/50 dark:bg-cyan-900/30 font-semibold'
                  : 'text-gray-700 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/30' }}">
              <span
                class="w-1.5 h-1.5 rounded-full {{ request()->routeIs('admin.reports.*') ? 'bg-cyan-600 dark:bg-cyan-400' : 'bg-gray-300 dark:bg-gray-600' }}"></span>
              Laporan
            </a>
          </li>
        </ul>
      </li>

      {{-- Pengaturan --}}
      <li>
        <a href="{{ route('admin.settings.index') }}"
          class="flex items-center gap-3 px-3.5 py-2.5 rounded-lg transition-all duration-200 group
          {{ request()->routeIs('admin.settings.*')
              ? 'bg-gradient-to-r from-orange-50 to-orange-100/50 dark:from-orange-900/40 dark:to-orange-800/30 text-orange-700 dark:text-orange-300 shadow-sm'
              : 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800/50' }}"
          title="Kelola pengaturan kafe">
          <svg
            class="w-5 h-5 flex-shrink-0 transition-colors duration-200
            {{ request()->routeIs('admin.settings.*')
                ? 'text-orange-600 dark:text-orange-400'
                : 'text-gray-400 dark:text-gray-500 group-hover:text-gray-600 dark:group-hover:text-gray-400' }}"
            fill="currentColor" viewBox="0 0 20 20">
            <path
              d="M10.5 1.5H5.75A4.75 4.75 0 0 0 1 6.25v7.5A4.75 4.75 0 0 0 5.75 18.5h8.5A4.75 4.75 0 0 0 19 13.75v-2.5m0-7.5a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z"
              fill="currentColor" stroke="currentColor" stroke-width="1.5" />
          </svg>
          <span class="text-sm font-semibold">Pengaturan Kafe</span>
        </a>
      </li>

    </ul>
  </div>
</aside>
