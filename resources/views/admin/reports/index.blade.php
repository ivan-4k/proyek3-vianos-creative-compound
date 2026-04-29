@extends('layouts.admin')

@section('content')
  <x-admin.card title="Laporan & Analitik" subtitle="Pantau performa bisnis Anda dengan berbagai laporan">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <!-- Laporan Penjualan -->
      <div
        class="bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/20 p-6 rounded-xl border border-blue-200 dark:border-blue-800">
        <div class="flex items-center justify-between mb-4">
          <div class="p-3 bg-blue-500 rounded-lg">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
            </svg>
          </div>
          <span class="text-sm font-medium text-blue-600 dark:text-blue-400">Penjualan</span>
        </div>
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Laporan Penjualan</h3>
        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Pantau pendapatan, jumlah pesanan, dan tren penjualan</p>
        <a href="{{ route('admin.reports.sales') }}"
          class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium">
          Lihat Laporan
          <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
          </svg>
        </a>
      </div>

      <!-- Menu Terlaris -->
      <div
        class="bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900/20 dark:to-green-800/20 p-6 rounded-xl border border-green-200 dark:border-green-800">
        <div class="flex items-center justify-between mb-4">
          <div class="p-3 bg-green-500 rounded-lg">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
            </svg>
          </div>
          <span class="text-sm font-medium text-green-600 dark:text-green-400">Menu</span>
        </div>
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Menu Terlaris</h3>
        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Lihat menu yang paling diminati pelanggan</p>
        <a href="{{ route('admin.reports.top-menus') }}"
          class="inline-flex items-center text-green-600 hover:text-green-700 font-medium">
          Lihat Laporan
          <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
          </svg>
        </a>
      </div>

      <!-- Aktivitas User -->
      <div
        class="bg-gradient-to-br from-purple-50 to-purple-100 dark:from-purple-900/20 dark:to-purple-800/20 p-6 rounded-xl border border-purple-200 dark:border-purple-800">
        <div class="flex items-center justify-between mb-4">
          <div class="p-3 bg-purple-500 rounded-lg">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
          </div>
          <span class="text-sm font-medium text-purple-600 dark:text-purple-400">Aktivitas</span>
        </div>
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Aktivitas User</h3>
        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Monitor aktivitas pengguna di platform</p>
        <a href="{{ route('admin.reports.user-activity') }}"
          class="inline-flex items-center text-purple-600 hover:text-purple-700 font-medium">
          Lihat Laporan
          <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
          </svg>
        </a>
      </div>
    </div>

    <!-- Quick Stats -->
    <div class="mt-8">
      <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-6">Ringkasan Cepat</h3>
      <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl border border-gray-200 dark:border-gray-700">
          <div class="flex items-center">
            <div class="p-2 bg-blue-100 dark:bg-blue-900/50 rounded-lg">
              <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
              </svg>
            </div>
            <div class="ml-4">
              <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Pendapatan</p>
              <p class="text-2xl font-bold text-gray-900 dark:text-white">Rp
                {{ number_format($totalRevenue, 0, ',', '.') }}</p>
            </div>
          </div>
        </div>

        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl border border-gray-200 dark:border-gray-700">
          <div class="flex items-center">
            <div class="p-2 bg-green-100 dark:bg-green-900/50 rounded-lg">
              <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <div class="ml-4">
              <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Pesanan Selesai</p>
              <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $completedOrders }}</p>
            </div>
          </div>
        </div>

        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl border border-gray-200 dark:border-gray-700">
          <div class="flex items-center">
            <div class="p-2 bg-yellow-100 dark:bg-yellow-900/50 rounded-lg">
              <svg class="w-6 h-6 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <div class="ml-4">
              <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Pesanan Pending</p>
              <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $pendingOrders }}</p>
            </div>
          </div>
        </div>

        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl border border-gray-200 dark:border-gray-700">
          <div class="flex items-center">
            <div class="p-2 bg-purple-100 dark:bg-purple-900/50 rounded-lg">
              <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
              </svg>
            </div>
            <div class="ml-4">
              <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total User</p>
              <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalUsers }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </x-admin.card>
@endsection
