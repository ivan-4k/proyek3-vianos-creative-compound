@extends('layouts.admin')

@section('content')
  <x-admin.card title="Laporan Penjualan" subtitle="Analisis performa penjualan dalam periode tertentu">
    <!-- Filter Form -->
    <form method="GET" class="mb-6 p-4 bg-gray-50 dark:bg-gray-800 rounded-xl">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tanggal Mulai</label>
          <input type="date" name="from" value="{{ $startDate }}"
            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tanggal Akhir</label>
          <input type="date" name="to" value="{{ $endDate }}"
            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white">
        </div>
        <div class="flex items-end">
          <button type="submit"
            class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            Filter
          </button>
        </div>
      </div>
    </form>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
      <div
        class="bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/20 p-6 rounded-xl border border-blue-200 dark:border-blue-800">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-sm font-medium text-blue-600 dark:text-blue-400">Total Pendapatan</p>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">Rp {{ number_format($totalRevenue, 0, ',', '.') }}
            </p>
          </div>
          <div class="p-3 bg-blue-500 rounded-lg">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
            </svg>
          </div>
        </div>
      </div>

      <div
        class="bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900/20 dark:to-green-800/20 p-6 rounded-xl border border-green-200 dark:border-green-800">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-sm font-medium text-green-600 dark:text-green-400">Total Pesanan</p>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalOrders }}</p>
          </div>
          <div class="p-3 bg-green-500 rounded-lg">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
          </div>
        </div>
      </div>

      <div
        class="bg-gradient-to-br from-purple-50 to-purple-100 dark:from-purple-900/20 dark:to-purple-800/20 p-6 rounded-xl border border-purple-200 dark:border-purple-800">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-sm font-medium text-purple-600 dark:text-purple-400">Rata-rata Pesanan</p>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">Rp {{ number_format($avgOrder, 0, ',', '.') }}</p>
          </div>
          <div class="p-3 bg-purple-500 rounded-lg">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
            </svg>
          </div>
        </div>
      </div>

      <div
        class="bg-gradient-to-br from-orange-50 to-orange-100 dark:from-orange-900/20 dark:to-orange-800/20 p-6 rounded-xl border border-orange-200 dark:border-orange-800">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-sm font-medium text-orange-600 dark:text-orange-400">Periode</p>
            <p class="text-lg font-bold text-gray-900 dark:text-white">
              {{ \Carbon\Carbon::parse($startDate)->format('d/m') }} -
              {{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}</p>
          </div>
          <div class="p-3 bg-orange-500 rounded-lg">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
          </div>
        </div>
      </div>
    </div>

    <!-- Sales Chart -->
    <div class="bg-white dark:bg-gray-800 p-6 rounded-xl border border-gray-200 dark:border-gray-700 mb-8">
      <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Tren Penjualan Harian</h3>
      <div class="h-80">
        <canvas id="salesChart" class="w-full h-full"></canvas>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const dailyData = @json($daily);
        const labels = Object.keys(dailyData);
        const revenueData = labels.map(date => dailyData[date].revenue || 0);
        const orderCountData = labels.map(date => dailyData[date].count || 0);

        const ctx = document.getElementById('salesChart');
        if (!ctx) return;

        new Chart(ctx, {
          type: 'line',
          data: {
            labels: labels,
            datasets: [{
                label: 'Pendapatan (Rp)',
                data: revenueData,
                borderColor: '#2563eb',
                backgroundColor: 'rgba(59, 130, 246, 0.16)',
                tension: 0.25,
                fill: true,
                pointRadius: 3,
                pointHoverRadius: 5,
                yAxisID: 'y-revenue'
              },
              {
                label: 'Jumlah Pesanan',
                data: orderCountData,
                borderColor: '#10b981',
                backgroundColor: 'rgba(16, 185, 129, 0.16)',
                tension: 0.25,
                fill: true,
                pointRadius: 3,
                pointHoverRadius: 5,
                yAxisID: 'y-orders'
              }
            ]
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
              legend: {
                labels: {
                  color: '#374151'
                }
              },
              tooltip: {
                callbacks: {
                  label: function(context) {
                    if (context.dataset.label === 'Pendapatan (Rp)') {
                      return context.dataset.label + ': Rp ' + new Intl.NumberFormat('id-ID').format(context
                        .parsed.y);
                    }
                    return context.dataset.label + ': ' + context.parsed.y;
                  }
                }
              }
            },
            scales: {
              x: {
                ticks: {
                  color: '#6b7280'
                },
                grid: {
                  display: false
                }
              },
              'y-revenue': {
                type: 'linear',
                position: 'left',
                ticks: {
                  color: '#2563eb',
                  callback: function(value) {
                    return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                  }
                }
              },
              'y-orders': {
                type: 'linear',
                position: 'right',
                grid: {
                  drawOnChartArea: false
                },
                ticks: {
                  color: '#10b981'
                }
              }
            }
          }
        });
      });
    </script>

    <!-- Orders Table -->
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
      <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Detail Pesanan</h3>
      </div>

      @if ($orders->count())
        <div class="overflow-x-auto">
          <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 datatable">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
              <tr>
                <th class="px-6 py-3">ID Pesanan</th>
                <th class="px-6 py-3">Pelanggan</th>
                <th class="px-6 py-3">Tanggal</th>
                <th class="px-6 py-3">Status</th>
                <th class="px-6 py-3">Total</th>
                <th class="px-6 py-3">Aksi</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
              @foreach ($orders as $order)
                <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700">
                  <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">#{{ $order->id_pesanan }}</td>
                  <td class="px-6 py-4">{{ $order->user->name ?? 'N/A' }}</td>
                  <td class="px-6 py-4">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                  <td class="px-6 py-4">
                    <span
                      class="px-2 py-1 text-xs font-medium rounded-full
                      @if ($order->order_status == 'completed') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300
                      @elseif($order->order_status == 'pending') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300
                      @elseif($order->order_status == 'processing') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300
                      @else bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-300 @endif">
                      {{ ucfirst($order->order_status) }}
                    </span>
                  </td>
                  <td class="px-6 py-4 font-medium">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                  <td class="px-6 py-4">
                    <a href="{{ route('admin.orders.show', $order) }}"
                      class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                      Lihat Detail
                    </a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @else
        <div class="px-6 py-12 text-center">
          <svg class="w-12 h-12 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
          </svg>
          <p class="text-gray-500 dark:text-gray-400">Tidak ada pesanan dalam periode ini</p>
        </div>
      @endif
    </div>

    <!-- Export Button -->
    @if ($orders->count())
      <div class="mt-6 flex justify-end">
        <a href="{{ route('admin.reports.export-sales', request()->query()) }}"
          class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors">
          <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
          </svg>
          Export CSV
        </a>
      </div>
    @endif
  </x-admin.card>
@endsection
