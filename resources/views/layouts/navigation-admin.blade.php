<nav
  class="fixed top-0 z-50 w-full bg-white/80 border-b border-gray-200 dark:bg-gray-800/80 dark:border-gray-700 backdrop-blur-md">
  <div class="px-3 py-3 lg:px-5 lg:pl-3">
    <div class="flex items-center justify-between">

      {{-- Bagian Kiri: Toggle & Logo --}}
      <div class="flex items-center justify-start rtl:justify-end overflow-hidden">
        {{-- Tombol Toggle Sidebar (Mobile) --}}
        <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
          type="button"
          class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600 shrink-0">
          <span class="sr-only">Open sidebar</span>
          <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd"
              d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
            </path>
          </svg>
        </button>

        <a href="{{ route('admin.dashboard') }}" class="flex ms-2 md:me-24 min-w-0">
          <span
            class="self-center text-lg sm:text-xl md:text-2xl font-bold truncate bg-gradient-to-r from-blue-600 to-indigo-500 bg-clip-text text-transparent">
            {{ strtoupper(Cache::get('store_name', 'VIANOS')) }}
            <span
              class="text-gray-900 dark:text-white font-medium hidden xs:inline-block sm:inline-block ml-1">ADMIN</span>
          </span>
        </a>
      </div>

      {{-- Bagian Kanan: Theme Toggle & User Dropdown --}}
      <div class="flex items-center gap-1 sm:gap-3 shrink-0">
        {{-- Theme Switcher (Dark/Light Mode) --}}
        <button id="theme-toggle" type="button"
          class="hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2 sm:p-2.5 transition-all duration-300">

          {{-- Icon Bulan --}}
          <svg id="theme-toggle-dark-icon"
            class="hidden w-5 h-5 text-indigo-600 drop-shadow-sm transition-transform hover:-rotate-12"
            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
          </svg>

          {{-- Icon Matahari --}}
          <svg id="theme-toggle-light-icon"
            class="hidden w-5 h-5 text-amber-400 drop-shadow-md transition-transform hover:rotate-45"
            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path
              d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
              fill-rule="evenodd" clip-rule="evenodd"></path>
          </svg>
        </button>

        {{-- User Dropdown --}}
        <div class="flex items-center ms-1">
          <div>
            <button type="button"
              class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800"
              aria-expanded="false" data-dropdown-toggle="dropdown-user">
              <span class="sr-only">Open user menu</span>
              <div
                class="w-8 h-8 sm:w-9 sm:h-9 rounded-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold shadow-lg shadow-blue-500/30 text-sm sm:text-base">
                {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
              </div>
            </button>
          </div>

          <div
            class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-xl shadow-2xl dark:bg-gray-700 dark:divide-gray-600 border border-gray-100 dark:border-gray-600"
            id="dropdown-user">
            <div class="px-4 py-3" role="none">
              <p class="text-sm font-semibold text-gray-900 dark:text-white" role="none">
                {{ Auth::user()->name ?? 'User' }}</p>
              <p class="text-xs font-medium text-gray-500 truncate dark:text-gray-400" role="none">
                {{ Auth::user()->email ?? 'email@example.com' }}</p>
            </div>
            <ul class="py-1" role="none">
              <li>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit"
                    class="flex items-center w-full gap-2 px-4 py-2 text-sm text-red-600 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-900/20 transition-colors text-left">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                      </path>
                    </svg>
                    Sign out
                  </button>
                </form>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</nav>
