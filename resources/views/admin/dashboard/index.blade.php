@extends('layouts.admin')

@section('content')

  {{-- Header --}}
  <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
    <div>
      <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Selamat Datang, {{ auth()->user()->name }}! 👋</h1>
      <p class="text-gray-500 dark:text-gray-400">Ringkasan operasional Vianos hari ini.</p>
    </div>
    {{-- [REF] Date pill + CTA di header --}}
    <div class="flex items-center gap-3 text-sm">
      <span class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 rounded-xl font-medium">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
        {{ now()->translatedFormat('d F Y') }}
      </span>
      <a href="{{ route('admin.menu.create') }}"
        class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition text-sm font-medium">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        Tambah Menu
      </a>
    </div>
  </div>

  {{-- Statistik Cards --}}
  <div class="grid grid-cols-1 gap-6 mb-8 sm:grid-cols-2 lg:grid-cols-4">

    {{-- 1. Total Menu --}}
    {{-- [REF] group hover:scale-110 pada icon, link "Lihat Detail" --}}
    <div class="group p-6 bg-white border border-gray-100 rounded-2xl shadow-sm dark:bg-gray-800 dark:border-gray-700 hover:shadow-lg transition-shadow">
      <div class="flex items-center justify-between mb-4">
        <div class="p-3 bg-blue-100 rounded-xl dark:bg-blue-900/30 group-hover:scale-110 transition-transform duration-300">
          <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
          </svg>
        </div>
        <span class="text-xs font-bold text-green-500 bg-green-100 dark:bg-green-900/30 px-2 py-1 rounded-lg">+{{ $newThisWeek }} Baru</span>
      </div>
      <h3 class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Total Menu</h3>
      <span class="text-3xl font-black text-gray-900 dark:text-white">{{ $totalProducts }}</span>
      <a href="{{ route('admin.menu.index') }}" class="text-xs text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 mt-2 inline-block transition-colors">Lihat Semua Menu →</a>
    </div>

    {{-- 2. Pesanan Aktif --}}
    <div class="group p-6 bg-white border border-gray-100 rounded-2xl shadow-sm dark:bg-gray-800 dark:border-gray-700 hover:shadow-lg transition-shadow">
      <div class="flex items-center justify-between mb-4">
        <div class="p-3 bg-amber-100 rounded-xl dark:bg-amber-900/30 group-hover:scale-110 transition-transform duration-300">
          <svg class="w-6 h-6 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
          </svg>
        </div>
        <span id="stat-today-orders" class="text-xs font-bold text-amber-500 bg-amber-100 dark:bg-amber-900/30 px-2 py-1 rounded-lg">{{ $todayOrders }} Hari Ini</span>
      </div>
      <h3 class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Pesanan Aktif</h3>
      <span id="stat-active-orders" class="text-3xl font-black text-gray-900 dark:text-white">{{ $activeOrders }}</span>
      <a href="{{ route('admin.orders.index') }}" class="text-xs text-gray-400 hover:text-amber-600 dark:hover:text-amber-400 mt-2 inline-block transition-colors">Kelola Pesanan →</a>
    </div>

    {{-- 3. Total Kategori --}}
    <div class="group p-6 bg-white border border-gray-100 rounded-2xl shadow-sm dark:bg-gray-800 dark:border-gray-700 hover:shadow-lg transition-shadow">
      <div class="flex items-center justify-between mb-4">
        <div class="p-3 bg-indigo-100 rounded-xl dark:bg-indigo-900/30 group-hover:scale-110 transition-transform duration-300">
          <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
          </svg>
        </div>
      </div>
      <h3 class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Kategori</h3>
      <span class="text-3xl font-black text-gray-900 dark:text-white">{{ $totalCategories }}</span>
      <a href="{{ route('admin.categories.index') }}" class="text-xs text-gray-400 hover:text-indigo-600 dark:hover:text-indigo-400 mt-2 inline-block transition-colors">Atur Kategori →</a>
    </div>

    {{-- 4. Tim Vianos --}}
    <div class="group p-6 bg-white border border-gray-100 rounded-2xl shadow-sm dark:bg-gray-800 dark:border-gray-700 hover:shadow-lg transition-shadow">
      <div class="flex items-center justify-between mb-4">
        <div class="p-3 bg-purple-100 rounded-xl dark:bg-purple-900/30 group-hover:scale-110 transition-transform duration-300">
          <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
          </svg>
        </div>
      </div>
      <h3 class="text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">Tim Vianos</h3>
      <span class="text-3xl font-black text-gray-900 dark:text-white">{{ $totalUsers }}</span>
      <a href="{{ route('admin.users.index') }}" class="text-xs text-gray-400 hover:text-purple-600 dark:hover:text-purple-400 mt-2 inline-block transition-colors">Kelola Tim →</a>
    </div>

  </div>

  {{-- Pendapatan + Quick Actions --}}
  {{-- [REF] Quick Actions diubah jadi layout icon + title + subtitle per item --}}
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

    {{-- Card Pendapatan --}}
    <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
      <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Pendapatan</h3>
      <div class="grid grid-cols-2 gap-4">
        <div class="text-center p-4 bg-green-50 dark:bg-green-900/20 rounded-xl">
          <p class="text-sm text-gray-500 dark:text-gray-400">Hari Ini</p>
          <p id="stat-today-revenue" class="text-2xl font-bold text-green-600 dark:text-green-400">
            Rp {{ number_format($todayRevenue, 0, ',', '.') }}
          </p>
        </div>
        <div class="text-center p-4 bg-blue-50 dark:bg-blue-900/20 rounded-xl">
          <p class="text-sm text-gray-500 dark:text-gray-400">Bulan Ini</p>
          <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">
            Rp {{ number_format($monthRevenue, 0, ',', '.') }}
          </p>
        </div>
      </div>
    </div>

    {{-- Quick Actions (improved) --}}
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 space-y-3">
      <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Aksi Cepat</h3>

      <a href="{{ route('admin.menu.create') }}"
        class="flex items-center gap-4 p-4 rounded-xl bg-blue-50 dark:bg-blue-900/20 hover:bg-blue-100 dark:hover:bg-blue-900/40 transition-colors group">
        <div class="w-10 h-10 rounded-lg bg-blue-100 dark:bg-blue-900/40 flex items-center justify-center text-blue-600 dark:text-blue-400 group-hover:scale-110 transition-transform flex-shrink-0">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
          </svg>
        </div>
        <div>
          <p class="font-semibold text-sm text-gray-900 dark:text-white">Tambah Menu</p>
          <p class="text-xs text-gray-500 dark:text-gray-400">Buat item menu baru</p>
        </div>
      </a>

      <a href="{{ route('admin.orders.index') }}"
        class="flex items-center gap-4 p-4 rounded-xl bg-amber-50 dark:bg-amber-900/20 hover:bg-amber-100 dark:hover:bg-amber-900/40 transition-colors group">
        <div class="w-10 h-10 rounded-lg bg-amber-100 dark:bg-amber-900/40 flex items-center justify-center text-amber-600 dark:text-amber-400 group-hover:scale-110 transition-transform flex-shrink-0">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
          </svg>
        </div>
        <div>
          <p class="font-semibold text-sm text-gray-900 dark:text-white">Kelola Pesanan</p>
          <p class="text-xs text-gray-500 dark:text-gray-400">Lihat & proses pesanan masuk</p>
        </div>
      </a>

      <a href="{{ route('admin.categories.index') }}"
        class="flex items-center gap-4 p-4 rounded-xl bg-gray-50 dark:bg-gray-700/50 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors group border border-gray-100 dark:border-gray-600">
        <div class="w-10 h-10 rounded-lg bg-indigo-100 dark:bg-indigo-900/40 flex items-center justify-center text-indigo-600 dark:text-indigo-400 group-hover:scale-110 transition-transform flex-shrink-0">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
          </svg>
        </div>
        <div>
          <p class="font-semibold text-sm text-gray-900 dark:text-white">Atur Kategori</p>
          <p class="text-xs text-gray-500 dark:text-gray-400">Kelola kategori menu</p>
        </div>
      </a>
    </div>

  </div>

  {{-- Charts (improved) --}}
  {{-- [REF] Combined chart dengan gradient + label legend + filter period --}}
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
      <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Trend Pesanan (7 Hari)</h3>
        <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
          <span class="w-2.5 h-2.5 rounded-full bg-blue-500 inline-block"></span> Pesanan
        </div>
      </div>
      <div id="orders-chart" class="h-72"></div>
    </div>
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
      <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Trend Pendapatan (7 Hari)</h3>
        <div class="flex items-center gap-2 text-xs text-gray-500 dark:text-gray-400">
          <span class="w-2.5 h-2.5 rounded-full bg-green-500 inline-block"></span> Pendapatan
        </div>
      </div>
      <div id="revenue-chart" class="h-72"></div>
    </div>
  </div>

  {{-- Pesanan Terbaru --}}
  {{-- [REF] Tambah kolom Aksi dengan tombol edit/delete per baris --}}
  <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center">
      <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Pesanan Terbaru</h3>
      <a href="{{ route('admin.orders.index') }}" class="text-sm text-blue-600 dark:text-blue-400 font-bold hover:underline">Lihat Semua</a>
    </div>
    <div class="overflow-x-auto">
      <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider">
          <tr>
            <th class="px-6 py-4 font-semibold">ID</th>
            <th class="px-6 py-4 font-semibold">Pelanggan</th>
            <th class="px-6 py-4 font-semibold">Total</th>
            <th class="px-6 py-4 font-semibold">Status</th>
            <th class="px-6 py-4 font-semibold">Tanggal</th>
            {{-- [REF] Kolom Aksi baru --}}
            <th class="px-6 py-4 font-semibold text-center">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 dark:divide-gray-700 bg-white dark:bg-transparent">
          @forelse ($recentOrders as $order)
            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-200 group">

              <td class="px-6 py-4 font-medium text-blue-600 dark:text-blue-400">
                #{{ $order->order_code ?? ($order->id_pesanan ?? $order->id) }}
              </td>

              <td class="px-6 py-4 text-gray-900 dark:text-gray-300 font-medium">
                {{ $order->user->name ?? 'Guest' }}
              </td>

              <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                Rp {{ number_format($order->total_price ?? $order->total, 0, ',', '.') }}
              </td>

              <td class="px-6 py-4">
                @php
                  $status = $order->order_status ?? 'pending';

                  $badge = match ($status) {
                      'pending_confirmation', 'pending'
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

                  $label = match ($status) {
                      'pending_confirmation' => 'Menunggu Konfirmasi',
                      'processing' => 'Diproses',
                      'completed' => 'Selesai',
                      'cancelled' => 'Dibatalkan',
                      default => ucfirst(str_replace('_', ' ', $status)),
                  };
                @endphp
                <span class="inline-flex items-center px-2.5 py-1 text-xs font-semibold rounded-full border {{ $badge }}">
                  @if(in_array($status, ['pending', 'pending_confirmation']))
                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mr-1.5 animate-pulse"></span>
                  @endif
                  {{ $label }}
                </span>
              </td>

              <td class="px-6 py-4 text-xs text-gray-500 dark:text-gray-400">
                {{ $order->created_at->format('d M Y') }}<br>
                <span class="text-gray-400 dark:text-gray-500">{{ $order->created_at->format('H:i') }} WIB</span>
              </td>

              {{-- [REF] Tombol aksi per baris --}}
              <td class="px-6 py-4">
                <div class="flex justify-center gap-2 duration-200">
                  <a href="{{ route('admin.orders.show', $order->id_pesanan ?? $order->id) }}"
                    class="w-8 h-8 flex items-center justify-center rounded-lg bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 hover:bg-blue-600 hover:text-white dark:hover:bg-blue-600 transition-all"
                    title="Detail">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                  </a>
                  <form action="{{ route('admin.orders.destroy', $order->id_pesanan ?? $order->id) }}" method="POST"
                    onsubmit="return confirm('Yakin hapus pesanan ini?')">
                    @csrf @method('DELETE')
                    <button type="submit"
                      class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-50 dark:bg-red-900/20 text-red-500 dark:text-red-400 hover:bg-red-500 hover:text-white dark:hover:bg-red-500 transition-all"
                      title="Hapus">
                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                      </svg>
                    </button>
                  </form>
                </div>
              </td>

            </tr>
          @empty
            <tr>
              <td colspan="6" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                <div class="flex flex-col items-center justify-center">
                  <div class="p-4 rounded-full bg-gray-50 dark:bg-gray-800 mb-3">
                    <svg class="w-8 h-8 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                  </div>
                  <p class="text-sm font-medium text-gray-900 dark:text-white mb-1">Belum ada pesanan terbaru</p>
                  <p class="text-xs">Pesanan yang masuk akan otomatis muncul di sini.</p>
                </div>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

@endsection

@push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {

      // [REF] Gradient warna seperti referensi, diterapkan ke ApexCharts
      var isDark = document.documentElement.classList.contains('dark');
      var gridColor = isDark ? 'rgba(255,255,255,0.05)' : 'rgba(0,0,0,0.05)';
      var labelColor = isDark ? '#94a3b8' : '#64748b';

      // 1. Chart Pesanan
      var orderChart = new ApexCharts(document.querySelector("#orders-chart"), {
        chart: {
          type: 'area',
          height: '100%',
          toolbar: { show: false },
          background: 'transparent',
        },
        series: [{
          name: 'Jumlah Pesanan',
          data: @json($orderChart['data'])
        }],
        xaxis: {
          categories: @json($orderChart['labels']),
          labels: { style: { colors: labelColor, fontSize: '12px' } },
          axisBorder: { show: false },
          axisTicks: { show: false },
        },
        yaxis: {
          labels: { style: { colors: labelColor, fontSize: '12px' } }
        },
        grid: {
          borderColor: gridColor,
          strokeDashArray: 4,
        },
        stroke: {
          curve: 'smooth',
          width: 2.5,
        },
        fill: {
          type: 'gradient',
          gradient: {
            shadeIntensity: 1,
            opacityFrom: 0.35,
            opacityTo: 0.0,
            stops: [0, 100]
          }
        },
        colors: ['#3B82F6'],
        dataLabels: { enabled: false },
        tooltip: {
          theme: isDark ? 'dark' : 'light',
        },
      });
      orderChart.render();

      // 2. Chart Pendapatan (area gradient juga)
      var revenueChart = new ApexCharts(document.querySelector("#revenue-chart"), {
        chart: {
          type: 'area',
          height: '100%',
          toolbar: { show: false },
          background: 'transparent',
        },
        series: [{
          name: 'Pendapatan (Rp)',
          data: @json($revenueChart['data'])
        }],
        xaxis: {
          categories: @json($revenueChart['labels']),
          labels: { style: { colors: labelColor, fontSize: '12px' } },
          axisBorder: { show: false },
          axisTicks: { show: false },
        },
        yaxis: {
          labels: {
            style: { colors: labelColor, fontSize: '12px' },
            formatter: (val) => 'Rp ' + new Intl.NumberFormat('id-ID', { notation: 'compact' }).format(val)
          }
        },
        grid: {
          borderColor: gridColor,
          strokeDashArray: 4,
        },
        stroke: {
          curve: 'smooth',
          width: 2.5,
        },
        fill: {
          type: 'gradient',
          gradient: {
            shadeIntensity: 1,
            opacityFrom: 0.35,
            opacityTo: 0.0,
            stops: [0, 100]
          }
        },
        colors: ['#10B981'],
        dataLabels: { enabled: false },
        tooltip: {
          theme: isDark ? 'dark' : 'light',
          y: {
            formatter: (val) => 'Rp ' + new Intl.NumberFormat('id-ID').format(val)
          }
        },
      });
      revenueChart.render();

      // 3. Auto-Refresh (tetap seperti semula)
      function fetchLatestStatistics() {
        fetch('{{ route('admin.statistics') }}')
          .then(response => response.json())
          .then(data => {
            let todayOrdersEl  = document.getElementById('stat-today-orders');
            let activeOrdersEl = document.getElementById('stat-active-orders');
            let todayRevenueEl = document.getElementById('stat-today-revenue');

            if (todayOrdersEl)  todayOrdersEl.innerText  = data.today_orders + ' Hari Ini';
            if (activeOrdersEl) activeOrdersEl.innerText = data.active_orders;
            if (todayRevenueEl) {
              let formatted = new Intl.NumberFormat('id-ID').format(data.today_revenue);
              todayRevenueEl.innerText = 'Rp ' + formatted;
            }
          })
          .catch(error => console.error('Error fetching stats:', error));
      }

      setInterval(fetchLatestStatistics, 30000);
    });
  </script>
@endpush