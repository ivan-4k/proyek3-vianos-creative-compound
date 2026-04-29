@extends('layouts.admin')

@section('content')
  <div class="mb-8">
    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Selamat Datang, {{ auth()->user()->name }}! 👋</h1>
    <p class="text-gray-500 dark:text-gray-400">Berikut adalah ringkasan operasional Vianos hari ini,
      {{ now()->translatedFormat('d F Y') }}.</p>
  </div>

  {{-- Statistik Cards --}}
  <div class="grid grid-cols-1 gap-6 mb-8 sm:grid-cols-2 lg:grid-cols-4">
    {{-- 1. Total Menu --}}
    <div
      class="p-6 bg-white border border-gray-100 rounded-2xl shadow-sm dark:bg-gray-800 dark:border-gray-700 hover:shadow-lg transition-shadow">
      <div class="flex items-center justify-between mb-4">
        <div class="p-3 bg-blue-100 rounded-xl dark:bg-blue-900/30">
          <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
          </svg>
        </div>
        <span class="text-xs font-bold text-green-500 bg-green-100 px-2 py-1 rounded-lg">+{{ $newThisWeek }} Baru</span>
      </div>
      <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Total Menu</h3>
      <span class="text-3xl font-black text-gray-900 dark:text-white">{{ $totalProducts }}</span>
    </div>

    {{-- 2. Pesanan Aktif --}}
    <div
      class="p-6 bg-white border border-gray-100 rounded-2xl shadow-sm dark:bg-gray-800 dark:border-gray-700 hover:shadow-lg transition-shadow">
      <div class="flex items-center justify-between mb-4">
        <div class="p-3 bg-amber-100 rounded-xl dark:bg-amber-900/30">
          <svg class="w-6 h-6 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
          </svg>
        </div>
        <span id="stat-today-orders"
          class="text-xs font-bold text-amber-500 bg-amber-100 px-2 py-1 rounded-lg">{{ $todayOrders }} Hari Ini</span>
      </div>
      <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Pesanan Aktif</h3>
      <span id="stat-active-orders" class="text-3xl font-black text-gray-900 dark:text-white">{{ $activeOrders }}</span>
    </div>

    {{-- 3. Total Kategori --}}
    <div
      class="p-6 bg-white border border-gray-100 rounded-2xl shadow-sm dark:bg-gray-800 dark:border-gray-700 hover:shadow-lg transition-shadow">
      <div class="flex items-center justify-between mb-4">
        <div class="p-3 bg-indigo-100 rounded-xl dark:bg-indigo-900/30">
          <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
          </svg>
        </div>
      </div>
      <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Kategori</h3>
      <span class="text-3xl font-black text-gray-900 dark:text-white">{{ $totalCategories }}</span>
    </div>

    {{-- 4. Tim Vianos (User) --}}
    <div
      class="p-6 bg-white border border-gray-100 rounded-2xl shadow-sm dark:bg-gray-800 dark:border-gray-700 hover:shadow-lg transition-shadow">
      <div class="flex items-center justify-between mb-4">
        <div class="p-3 bg-purple-100 rounded-xl dark:bg-purple-900/30">
          <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
          </svg>
        </div>
      </div>
      <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Tim Vianos</h3>
      <span class="text-3xl font-black text-gray-900 dark:text-white">{{ $totalUsers }}</span>
    </div>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    {{-- Card Pendapatan --}}
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
      <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Pendapatan</h3>
      <div class="grid grid-cols-2 gap-4">
        <div class="text-center p-4 bg-green-50 dark:bg-green-900/20 rounded-xl">
          <p class="text-sm text-gray-500 dark:text-gray-400">Hari Ini</p>
          <p id="stat-today-revenue" class="text-2xl font-bold text-green-600 dark:text-green-400">Rp
            {{ number_format($todayRevenue, 0, ',', '.') }}</p>
        </div>
        <div class="text-center p-4 bg-blue-50 dark:bg-blue-900/20 rounded-xl">
          <p class="text-sm text-gray-500 dark:text-gray-400">Bulan Ini</p>
          <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">Rp
            {{ number_format($monthRevenue, 0, ',', '.') }}</p>
        </div>
      </div>
    </div>

    {{-- Quick Actions --}}
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
      <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Aksi Cepat</h3>
      <div class="grid grid-cols-2 gap-3">
        <a href="{{ route('admin.menu.create') }}"
          class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
          </svg>
          Tambah Menu
        </a>
        <a href="{{ route('admin.orders.index') }}"
          class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-amber-600 text-white rounded-xl hover:bg-amber-700 transition">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
          </svg>
          Lihat Pesanan
        </a>
      </div>
    </div>
  </div>

  {{-- Charts --}}
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
      <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Trend Pesanan (7 Hari)</h3>
      <div id="orders-chart" class="h-80"></div>
    </div>
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
      <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Trend Pendapatan (7 Hari)</h3>
      <div id="revenue-chart" class="h-80"></div>
    </div>
  </div>

  {{-- Pesanan Terbaru --}}
  <div
    class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center">
      <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Pesanan Terbaru</h3>
      <a href="{{ route('admin.orders.index') }}" class="text-sm text-blue-600 hover:underline">Lihat Semua</a>
    </div>
    <div class="overflow-x-auto">
      <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 datatable">
        <thead class="bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider">
          <tr>
            <th class="px-6 py-4 font-semibold">ID</th>
            <th class="px-6 py-4 font-semibold">Pelanggan</th>
            <th class="px-6 py-4 font-semibold">Total</th>
            <th class="px-6 py-4 font-semibold">Status</th>
            <th class="px-6 py-4 font-semibold">Tanggal</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 dark:divide-gray-700 bg-white dark:bg-transparent">
          @foreach ($recentOrders as $order)
            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-200">

              <td class="px-6 py-4 font-medium text-blue-600 dark:text-blue-400">
                #{{ $order->order_code ?? ($order->id_pesanan ?? $order->id) }}
              </td>

              {{-- Kolom Pelanggan --}}
              <td class="px-6 py-4 text-gray-900 dark:text-gray-300 font-medium">
                {{ $order->user->name ?? 'Guest' }}
              </td>

              {{-- Kolom Total --}}
              <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                Rp {{ number_format($order->total_price ?? $order->total, 0, ',', '.') }}
              </td>

              <td class="px-6 py-4">
                @php
                  $status = $order->order_status ?? 'pending';

                  $badge = match ($status) {
                      'pending_confirmation',
                      'pending'
                          => 'bg-amber-50 text-amber-700 border-amber-200 dark:bg-amber-900/30 dark:text-amber-400 dark:border-amber-800',
                      'processing'
                          => 'bg-blue-50 text-blue-700 border-blue-200 dark:bg-blue-900/30 dark:text-blue-400 dark:border-blue-800',
                      'completed'
                          => 'bg-green-50 text-green-700 border-green-200 dark:bg-green-900/30 dark:text-green-400 dark:border-green-800',
                      'cancelled'
                          => 'bg-red-50 text-red-700 border-red-200 dark:bg-red-900/30 dark:text-red-400 dark:border-red-800',
                      default
                          => 'bg-gray-50 text-gray-700 border-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600',
                  };

                  // Logika label bahasa Indonesia
                  $label = match ($status) {
                      'pending_confirmation' => 'Menunggu Konfirmasi',
                      'processing' => 'Diproses',
                      'completed' => 'Selesai',
                      'cancelled' => 'Dibatalkan',
                      default => ucfirst(str_replace('_', ' ', $status)),
                  };
                @endphp

                <span
                  class="inline-flex items-center px-2.5 py-1 text-xs font-semibold rounded-full border {{ $badge }}">
                  {{ $label }}
                </span>
              </td>

              {{-- Kolom Tanggal --}}
              <td class="px-6 py-4 text-xs text-gray-500 dark:text-gray-400">
                {{ $order->created_at->format('d M Y') }} <br>
                <span class="text-gray-400 dark:text-gray-500">{{ $order->created_at->format('H:i') }} WIB</span>
              </td>

            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection

@push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // 1. Chart Pesanan
      var orderChart = new ApexCharts(document.querySelector("#orders-chart"), {
        chart: {
          type: 'line',
          height: '100%',
          toolbar: {
            show: false
          }
        },
        series: [{
          name: 'Jumlah Pesanan',
          data: @json($orderChart['data'])
        }],
        xaxis: {
          categories: @json($orderChart['labels'])
        },
        stroke: {
          curve: 'smooth',
          width: 3
        },
        colors: ['#3B82F6'],
        title: {
          text: undefined
        }
      });
      orderChart.render();

      // 2. Chart Pendapatan
      var revenueChart = new ApexCharts(document.querySelector("#revenue-chart"), {
        chart: {
          type: 'bar',
          height: '100%',
          toolbar: {
            show: false
          }
        },
        series: [{
          name: 'Pendapatan (Rp)',
          data: @json($revenueChart['data'])
        }],
        xaxis: {
          categories: @json($revenueChart['labels'])
        },
        colors: ['#10B981'],
        plotOptions: {
          bar: {
            borderRadius: 4
          }
        },
        tooltip: {
          y: {
            formatter: (val) => 'Rp ' + new Intl.NumberFormat('id-ID').format(val)
          }
        }
      });
      revenueChart.render();

      // 3. --- Fitur Auto-Refresh Dashboard (AJAX) ---
      function fetchLatestStatistics() {
        fetch('{{ route('admin.statistics') }}')
          .then(response => response.json())
          .then(data => {
            // Cek elemen ada sebelum diupdate (mencegah error console)
            let todayOrdersEl = document.getElementById('stat-today-orders');
            let activeOrdersEl = document.getElementById('stat-active-orders');
            let todayRevenueEl = document.getElementById('stat-today-revenue');

            if (todayOrdersEl) todayOrdersEl.innerText = data.today_orders + ' Hari Ini';
            if (activeOrdersEl) activeOrdersEl.innerText = data.active_orders;

            if (todayRevenueEl) {
              let formattedRevenue = new Intl.NumberFormat('id-ID').format(data.today_revenue);
              todayRevenueEl.innerText = 'Rp ' + formattedRevenue;
            }
          })
          .catch(error => console.error('Error fetching stats:', error));
      }

      // Jalankan fungsi auto-refresh setiap 30 detik (30000 ms)
      setInterval(fetchLatestStatistics, 30000);

    });
  </script>
@endpush
