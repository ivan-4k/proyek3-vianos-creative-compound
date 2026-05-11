@extends('layouts.admin')

@section('content')

  {{-- ═══════════════════════════════════════════
       BREADCRUMB + HEADER
       [REF] Breadcrumb & header actions section
  ════════════════════════════════════════════ --}}
  <div class="mb-8">
    <p class="text-xs text-gray-400 dark:text-gray-500 mb-1">
      <a href="#" class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors">Dashboard</a>
      <span class="mx-1">/</span>
      <span>Laporan Penjualan</span>
    </p>
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
      <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Laporan Penjualan</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400">Analisis performa penjualan dalam periode tertentu.</p>
      </div>
      {{-- [REF] Period filter dropdown + export button di header --}}
      <div class="flex items-center gap-3 text-sm">
        <form method="GET" id="quickPeriodForm" class="contents">
          <select name="period" onchange="document.getElementById('quickPeriodForm').submit()"
            class="text-xs px-4 py-2 rounded-xl border border-gray-200 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-700 dark:text-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            <option value="7"  {{ request('period') == '7'  ? 'selected' : '' }}>7 Hari Terakhir</option>
            <option value="30" {{ request('period', '30') == '30' ? 'selected' : '' }}>30 Hari Terakhir</option>
            <option value="90" {{ request('period') == '90' ? 'selected' : '' }}>3 Bulan Terakhir</option>
          </select>
        </form>
        @if ($orders->count())
          <a href="{{ route('admin.reports.export-sales', request()->query()) }}"
            class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 text-white rounded-xl hover:bg-green-700 transition text-xs font-medium">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            Export CSV
          </a>
        @endif
      </div>
    </div>
  </div>

  {{-- ═══════════════════════════════════════════
       FILTER FORM (tetap, lebih rapi)
  ════════════════════════════════════════════ --}}
  <form method="GET" class="mb-8 p-5 bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
      <div>
        <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">Tanggal Mulai</label>
        <input type="date" name="from" value="{{ $startDate }}"
          class="w-full px-3 py-2 border border-gray-200 dark:border-gray-600 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white">
      </div>
      <div>
        <label class="block text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-2">Tanggal Akhir</label>
        <input type="date" name="to" value="{{ $endDate }}"
          class="w-full px-3 py-2 border border-gray-200 dark:border-gray-600 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white">
      </div>
      <button type="submit"
        class="w-full inline-flex items-center justify-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition text-sm font-medium">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
        Terapkan Filter
      </button>
    </div>
  </form>

  {{-- ═══════════════════════════════════════════
       SUMMARY CARDS
       [REF] Tambah growth indicator (%) per card
  ════════════════════════════════════════════ --}}
  <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">

    <div class="bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/20 p-6 rounded-2xl border border-blue-200 dark:border-blue-800">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-xs font-semibold text-blue-600 dark:text-blue-400 uppercase tracking-wider">Total Pendapatan</p>
          <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
          {{-- [REF] Growth indicator --}}
          @if(isset($revenueGrowth))
            <p class="text-xs mt-2 {{ $revenueGrowth >= 0 ? 'text-green-600' : 'text-red-500' }}">
              <svg class="w-3 h-3 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $revenueGrowth >= 0 ? 'M5 10l7-7m0 0l7 7m-7-7v18' : 'M19 14l-7 7m0 0l-7-7m7 7V3' }}" />
              </svg>
              {{ abs($revenueGrowth) }}% vs periode lalu
            </p>
          @endif
        </div>
        <div class="p-3 bg-blue-500 rounded-xl">
          <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
          </svg>
        </div>
      </div>
    </div>

    <div class="bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900/20 dark:to-green-800/20 p-6 rounded-2xl border border-green-200 dark:border-green-800">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-xs font-semibold text-green-600 dark:text-green-400 uppercase tracking-wider">Total Pesanan</p>
          <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">{{ $totalOrders }}</p>
          @if(isset($ordersGrowth))
            <p class="text-xs mt-2 {{ $ordersGrowth >= 0 ? 'text-green-600' : 'text-red-500' }}">
              <svg class="w-3 h-3 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $ordersGrowth >= 0 ? 'M5 10l7-7m0 0l7 7m-7-7v18' : 'M19 14l-7 7m0 0l-7-7m7 7V3' }}" />
              </svg>
              {{ abs($ordersGrowth) }}% vs periode lalu
            </p>
          @endif
        </div>
        <div class="p-3 bg-green-500 rounded-xl">
          <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
          </svg>
        </div>
      </div>
    </div>

    <div class="bg-gradient-to-br from-purple-50 to-purple-100 dark:from-purple-900/20 dark:to-purple-800/20 p-6 rounded-2xl border border-purple-200 dark:border-purple-800">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-xs font-semibold text-purple-600 dark:text-purple-400 uppercase tracking-wider">Rata-rata Pesanan</p>
          <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">Rp {{ number_format($avgOrder, 0, ',', '.') }}</p>
          @if(isset($avgOrderGrowth))
            <p class="text-xs mt-2 {{ $avgOrderGrowth >= 0 ? 'text-green-600' : 'text-red-500' }}">
              <svg class="w-3 h-3 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $avgOrderGrowth >= 0 ? 'M5 10l7-7m0 0l7 7m-7-7v18' : 'M19 14l-7 7m0 0l-7-7m7 7V3' }}" />
              </svg>
              {{ abs($avgOrderGrowth) }}% vs periode lalu
            </p>
          @endif
        </div>
        <div class="p-3 bg-purple-500 rounded-xl">
          <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
          </svg>
        </div>
      </div>
    </div>

    <div class="bg-gradient-to-br from-orange-50 to-orange-100 dark:from-orange-900/20 dark:to-orange-800/20 p-6 rounded-2xl border border-orange-200 dark:border-orange-800">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-xs font-semibold text-orange-600 dark:text-orange-400 uppercase tracking-wider">Periode</p>
          <p class="text-lg font-bold text-gray-900 dark:text-white mt-1">
            {{ \Carbon\Carbon::parse($startDate)->format('d/m') }} –
            {{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}
          </p>
        </div>
        <div class="p-3 bg-orange-500 rounded-xl">
          <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
          </svg>
        </div>
      </div>
    </div>

  </div>

  {{-- ═══════════════════════════════════════════
       CHARTS ROW 1: Trend + Doughnut
       [REF] Tambah doughnut chart distribusi kategori
  ════════════════════════════════════════════ --}}
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">

    {{-- Trend Chart (dual-axis dari project cafe, layout dari referensi) --}}
    <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm p-6">
      <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-6">
        <h3 class="text-base font-semibold text-gray-900 dark:text-white">Tren Penjualan Harian</h3>
        {{-- [REF] Legend label --}}
        <div class="flex items-center gap-4 text-xs text-gray-500 dark:text-gray-400">
          <span class="flex items-center gap-1.5">
            <span class="w-3 h-3 rounded-full bg-blue-500 inline-block"></span> Pendapatan
          </span>
          <span class="flex items-center gap-1.5">
            <span class="w-3 h-3 rounded-full bg-green-500 inline-block"></span> Pesanan
          </span>
        </div>
      </div>
      <div class="h-72">
        <canvas id="salesChart" class="w-full h-full"></canvas>
      </div>
    </div>

    {{-- [REF] Doughnut Chart: Distribusi Kategori --}}
    {{-- Controller: $categoryDistribution = [['label'=>'Minuman','count'=>120,'color'=>'#3B82F6'], ...] --}}
    <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm p-6">
      <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-6">Distribusi Kategori</h3>
      <div class="h-48 flex items-center justify-center">
        <canvas id="doughnutChart"></canvas>
      </div>
      {{-- Legend distribusi --}}
      <div class="mt-5 space-y-2.5">
        @if(isset($categoryDistribution))
          @foreach($categoryDistribution as $cat)
            <div class="flex items-center justify-between text-sm">
              <div class="flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full flex-shrink-0" style="background-color: {{ $cat['color'] }}"></span>
                <span class="text-gray-600 dark:text-gray-400 text-xs">{{ $cat['label'] }}</span>
              </div>
              <span class="font-bold text-gray-900 dark:text-white text-xs">{{ $cat['pct'] }}%</span>
            </div>
          @endforeach
        @else
          {{-- Fallback jika $categoryDistribution belum ada di controller --}}
          <p class="text-xs text-center text-gray-400 dark:text-gray-500">Data kategori belum tersedia.<br>Tambahkan <code>$categoryDistribution</code> di controller.</p>
        @endif
      </div>
    </div>

  </div>

  {{-- ═══════════════════════════════════════════
       CHARTS ROW 2: Bar Bulanan + Menu Terpopuler
       [REF] Keduanya baru dari referensi
  ════════════════════════════════════════════ --}}
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">

    {{-- [REF] Bar Chart: Perbandingan Bulanan --}}
    {{-- Controller: $monthlyComparison = ['labels'=>[...], 'revenue'=>[...], 'orders'=>[...]] --}}
    <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm p-6">
      <div class="flex items-center justify-between mb-6">
        <h3 class="text-base font-semibold text-gray-900 dark:text-white">Perbandingan Bulanan</h3>
        <span class="text-xs text-gray-400 dark:text-gray-500">6 bulan terakhir</span>
      </div>
      <div class="h-64">
        <canvas id="barChart"></canvas>
      </div>
    </div>

    {{-- [REF] Menu Terpopuler dengan progress bar --}}
    {{-- Controller: $topProducts = [['name'=>'Kopi Susu','count'=>120,'pct'=>85], ...] --}}
    <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm p-6">
      <h3 class="text-base font-semibold text-gray-900 dark:text-white mb-6">Menu Terpopuler</h3>
      <div class="space-y-4">
        @if(isset($topProducts) && count($topProducts))
          @foreach($topProducts as $product)
            <div>
              <div class="flex items-center justify-between mb-1.5">
                <span class="text-sm text-gray-700 dark:text-gray-300">{{ $product['name'] }}</span>
                <span class="text-xs font-bold text-gray-500 dark:text-gray-400">{{ $product['count'] }} terjual</span>
              </div>
              <div class="w-full h-2 bg-gray-100 dark:bg-gray-700 rounded-full overflow-hidden">
                <div class="h-full bg-blue-500 rounded-full transition-all duration-700"
                  style="width: {{ $product['pct'] }}%"></div>
              </div>
            </div>
          @endforeach
        @else
          {{-- Fallback jika $topProducts belum ada --}}
          <p class="text-xs text-center text-gray-400 dark:text-gray-500 py-8">Data menu belum tersedia.<br>Tambahkan <code>$topProducts</code> di controller.</p>
        @endif
      </div>
    </div>

  </div>

  {{-- ═══════════════════════════════════════════
       ORDERS TABLE (tetap dari project cafe)
  ════════════════════════════════════════════ --}}
  <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
      <h3 class="text-base font-semibold text-gray-900 dark:text-white">Detail Pesanan</h3>
      <span class="text-xs text-gray-400 dark:text-gray-500">{{ $orders->count() }} pesanan ditemukan</span>
    </div>

    @if ($orders->count())
      <div class="overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 datatable">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 tracking-wider">
            <tr>
              <th class="px-6 py-4 font-semibold">ID Pesanan</th>
              <th class="px-6 py-4 font-semibold">Pelanggan</th>
              <th class="px-6 py-4 font-semibold">Tanggal</th>
              <th class="px-6 py-4 font-semibold">Status</th>
              <th class="px-6 py-4 font-semibold">Total</th>
              <th class="px-6 py-4 font-semibold">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
            @foreach ($orders as $order)
              <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                <td class="px-6 py-4 font-medium text-blue-600 dark:text-blue-400">#{{ $order->id_pesanan }}</td>
                <td class="px-6 py-4 text-gray-900 dark:text-white">{{ $order->user->name ?? 'N/A' }}</td>
                <td class="px-6 py-4 text-xs text-gray-500 dark:text-gray-400">
                  {{ $order->created_at->format('d M Y') }}<br>
                  <span class="text-gray-400">{{ $order->created_at->format('H:i') }} WIB</span>
                </td>
                <td class="px-6 py-4">
                  @php
                    $badge = match($order->order_status) {
                      'completed'  => 'bg-green-50 text-green-700 border-green-200 dark:bg-green-900/30 dark:text-green-400 dark:border-green-800',
                      'processing' => 'bg-blue-50 text-blue-700 border-blue-200 dark:bg-blue-900/30 dark:text-blue-400 dark:border-blue-800',
                      'pending','pending_confirmation'
                                   => 'bg-amber-50 text-amber-700 border-amber-200 dark:bg-amber-900/30 dark:text-amber-400 dark:border-amber-800',
                      'cancelled'  => 'bg-red-50 text-red-700 border-red-200 dark:bg-red-900/30 dark:text-red-400 dark:border-red-800',
                      default      => 'bg-gray-50 text-gray-700 border-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600',
                    };
                    $label = match($order->order_status) {
                      'completed'             => 'Selesai',
                      'processing'            => 'Diproses',
                      'pending_confirmation'  => 'Menunggu Konfirmasi',
                      'pending'               => 'Pending',
                      'cancelled'             => 'Dibatalkan',
                      default => ucfirst(str_replace('_',' ',$order->order_status)),
                    };
                  @endphp
                  <span class="inline-flex items-center px-2.5 py-1 text-xs font-semibold rounded-full border {{ $badge }}">
                    {{ $label }}
                  </span>
                </td>
                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                  Rp {{ number_format($order->total, 0, ',', '.') }}
                </td>
                <td class="px-6 py-4">
                  <a href="{{ route('admin.orders.show', $order) }}"
                    class="inline-flex items-center gap-1.5 text-xs font-medium text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    Lihat Detail
                  </a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @else
      <div class="px-6 py-16 text-center">
        <svg class="w-12 h-12 text-gray-300 dark:text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
        </svg>
        <p class="text-gray-500 dark:text-gray-400">Tidak ada pesanan dalam periode ini.</p>
      </div>
    @endif
  </div>

@endsection

@push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {

      // ── Konfigurasi global Chart.js ──
      // [REF] Dark/light mode aware seperti referensi bengkel
      const isLight  = !document.documentElement.classList.contains('dark');
      const mutedColor = isLight ? '#64748b' : '#94a3b8';
      const gridColor  = isLight ? 'rgba(0,0,0,0.05)' : 'rgba(255,255,255,0.05)';

      Chart.defaults.color       = mutedColor;
      Chart.defaults.borderColor = gridColor;

      const tooltipConfig = {
        backgroundColor : isLight ? '#fff'    : '#1e293b',
        titleColor      : isLight ? '#111'    : '#f1f5f9',
        bodyColor       : isLight ? '#555'    : '#cbd5e1',
        borderColor     : gridColor,
        borderWidth     : 1,
        padding         : 12,
        cornerRadius    : 10,
      };

      // ════════════════════════════════════════
      // 1. Trend Chart (dual-axis, dari project cafe)
      // ════════════════════════════════════════
      const dailyData   = @json($daily);
      const labels      = Object.keys(dailyData);
      const revenueData = labels.map(d => dailyData[d].revenue || 0);
      const orderData   = labels.map(d => dailyData[d].count   || 0);

      const salesCtx   = document.getElementById('salesChart').getContext('2d');
      const blueGrad   = salesCtx.createLinearGradient(0, 0, 0, 300);
      blueGrad.addColorStop(0, 'rgba(59,130,246,0.25)');
      blueGrad.addColorStop(1, 'rgba(59,130,246,0)');

      const greenGrad  = salesCtx.createLinearGradient(0, 0, 0, 300);
      greenGrad.addColorStop(0, 'rgba(16,185,129,0.20)');
      greenGrad.addColorStop(1, 'rgba(16,185,129,0)');

      new Chart(salesCtx, {
        type: 'line',
        data: {
          labels,
          datasets: [
            {
              label          : 'Pendapatan (Rp)',
              data           : revenueData,
              borderColor    : '#3B82F6',
              backgroundColor: blueGrad,
              tension        : 0.4,
              fill           : true,
              borderWidth    : 2.5,
              pointRadius    : 0,
              pointHoverRadius: 6,
              yAxisID        : 'y-revenue',
            },
            {
              label          : 'Jumlah Pesanan',
              data           : orderData,
              borderColor    : '#10B981',
              backgroundColor: greenGrad,
              tension        : 0.4,
              fill           : true,
              borderWidth    : 2.5,
              pointRadius    : 0,
              pointHoverRadius: 6,
              yAxisID        : 'y-orders',
            },
          ],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          interaction: { intersect: false, mode: 'index' },
          plugins: {
            legend: { display: false },
            tooltip: {
              ...tooltipConfig,
              callbacks: {
                label: ctx => ctx.dataset.label === 'Pendapatan (Rp)'
                  ? `Pendapatan: Rp ${new Intl.NumberFormat('id-ID').format(ctx.parsed.y)}`
                  : `Pesanan: ${ctx.parsed.y}`,
              },
            },
          },
          scales: {
            x         : { grid: { display: false }, ticks: { color: mutedColor } },
            'y-revenue': {
              type    : 'linear',
              position: 'left',
              ticks   : {
                color   : '#3B82F6',
                callback: v => 'Rp ' + new Intl.NumberFormat('id-ID', { notation: 'compact' }).format(v),
              },
              grid: { color: gridColor },
            },
            'y-orders': {
              type    : 'linear',
              position: 'right',
              grid    : { drawOnChartArea: false },
              ticks   : { color: '#10B981' },
            },
          },
        },
      });

      // ════════════════════════════════════════
      // 2. [REF] Doughnut Chart: Distribusi Kategori
      // ════════════════════════════════════════
      @if(isset($categoryDistribution))
        const catLabels = @json(collect($categoryDistribution)->pluck('label'));
        const catData   = @json(collect($categoryDistribution)->pluck('count'));
        const catColors = @json(collect($categoryDistribution)->pluck('color'));

        new Chart(document.getElementById('doughnutChart'), {
          type: 'doughnut',
          data: {
            labels  : catLabels,
            datasets: [{
              data           : catData,
              backgroundColor: catColors,
              borderWidth    : 0,
              hoverOffset    : 8,
            }],
          },
          options: {
            responsive         : true,
            maintainAspectRatio: false,
            cutout             : '72%',
            plugins: {
              legend : { display: false },
              tooltip: tooltipConfig,
            },
          },
        });
      @endif

      // ════════════════════════════════════════
      // 3. [REF] Bar Chart: Perbandingan Bulanan
      // ════════════════════════════════════════
      @if(isset($monthlyComparison))
        new Chart(document.getElementById('barChart'), {
          type: 'bar',
          data: {
            labels  : @json($monthlyComparison['labels']),
            datasets: [
              {
                label          : 'Pendapatan',
                data           : @json($monthlyComparison['revenue']),
                backgroundColor: 'rgba(59,130,246,0.7)',
                borderRadius   : 6,
              },
              {
                label          : 'Pesanan',
                data           : @json($monthlyComparison['orders']),
                backgroundColor: 'rgba(16,185,129,0.7)',
                borderRadius   : 6,
              },
            ],
          },
          options: {
            responsive         : true,
            maintainAspectRatio: false,
            plugins: {
              legend: {
                position: 'bottom',
                labels  : { boxWidth: 12, padding: 16, usePointStyle: true, pointStyle: 'circle', color: mutedColor },
              },
              tooltip: {
                ...tooltipConfig,
                callbacks: {
                  label: ctx => ctx.dataset.label === 'Pendapatan'
                    ? `Pendapatan: Rp ${new Intl.NumberFormat('id-ID').format(ctx.parsed.y)}`
                    : `Pesanan: ${ctx.parsed.y}`,
                },
              },
            },
            scales: {
              x: { grid: { display: false }, ticks: { color: mutedColor } },
              y: {
                ticks: {
                  color   : mutedColor,
                  callback: v => new Intl.NumberFormat('id-ID', { notation: 'compact' }).format(v),
                },
                grid: { color: gridColor },
              },
            },
          },
        });
      @endif

    });
  </script>
@endpush