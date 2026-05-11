@extends('layouts.admin')

@section('title', 'AI Analitik Cerdas - Vianos Creative Compound')

@section('content')
  <div class="space-y-8 animate-fade-in">
    {{-- Header with Enhanced Design --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
      <div>
        <div class="flex items-center gap-2 mb-1">
          <span
            class="relative px-2.5 py-0.5 rounded-full bg-gradient-to-r from-cyan-500/10 to-cyan-400/10 dark:from-cyan-400/20 dark:to-cyan-500/20 text-cyan-600 dark:text-cyan-400 text-[10px] font-black uppercase tracking-wider border border-cyan-200/50 dark:border-cyan-500/30 shadow-sm">
            <span class="relative inline-flex h-1.5 w-1.5 rounded-full bg-cyan-500 mr-1.5 animate-pulse"></span>
            AI Engine Active
          </span>
        </div>
        <h1 class="text-3xl font-black tracking-tight uppercase text-gray-900 dark:text-white">Analitik <span class="bg-gradient-to-r from-cyan-500 to-cyan-600 bg-clip-text text-transparent">Cerdas</span></h1>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Prediksi pendapatan dan rekomendasi stok berbasis pola penjualan historis Vianos.</p>
      </div>
      <div class="flex items-center gap-4">
        <div class="text-right hidden sm:block">
          <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Last Sync</p>
          <p class="text-sm font-bold text-gray-900 dark:text-white flex items-center gap-1">
            <svg class="w-3 h-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            Baru saja
          </p>
        </div>
        <button
          class="group w-10 h-10 rounded-xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 shadow-sm flex items-center justify-center text-cyan-500 hover:scale-105 hover:border-cyan-500 transition-all duration-300 hover:shadow-md hover:shadow-cyan-500/20">
          <i class="fa-solid fa-rotate group-hover:rotate-180 transition-transform duration-500"></i>
        </button>
      </div>
    </div>

    {{-- Enhanced AI Insights Grid with Glassmorphic Cards --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

      {{-- Revenue Prediction Card - Indigo Theme --}}
      <div class="group relative bg-white dark:bg-gray-800 rounded-2xl p-6 border border-indigo-100 dark:border-indigo-800/50 shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-indigo-50/50 to-transparent dark:from-indigo-900/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
        <div class="absolute -right-10 -top-10 w-32 h-32 bg-indigo-400/20 rounded-full blur-2xl group-hover:bg-indigo-400/30 transition-all duration-500"></div>
        <div class="relative z-10 space-y-4">
          <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-indigo-500 to-indigo-600 shadow-lg shadow-indigo-500/25 flex items-center justify-center text-white">
              <i class="fa-solid fa-bolt-lightning text-xl"></i>
            </div>
            <div>
              <h3 class="text-xs font-black uppercase tracking-wider text-gray-500 dark:text-gray-400">Prediksi Pendapatan</h3>
              <p class="text-[11px] text-gray-400 dark:text-gray-500 font-medium">AI Forecast • Confidence 94%</p>
            </div>
          </div>
          <div>
            <p class="text-4xl font-black bg-gradient-to-r from-indigo-600 to-indigo-500 bg-clip-text text-transparent">{{ $predictedRevenueText }}</p>
            <p class="text-[11px] text-gray-500 dark:text-gray-400 mt-1 uppercase font-bold tracking-wider">Estimasi akhir bulan ini</p>
          </div>
          <div class="flex items-center gap-2 text-sm">
            <span class="{{ $revenueGrowth >= 0 ? 'text-green-500 bg-green-100 dark:bg-green-900/30' : 'text-red-500 bg-red-100 dark:bg-red-900/30' }} font-bold px-2 py-0.5 rounded-full flex items-center gap-1">
              <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $revenueGrowth >= 0 ? 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6' : 'M13 17h8m0 0v-8m0 8l-8-8-4 4-6-6' }}"></path></svg>
              {{ $revenueGrowth >= 0 ? '+' : '' }}{{ round($revenueGrowth, 1) }}%
            </span>
            <span class="text-gray-400 text-xs">vs bulan lalu</span>
          </div>
        </div>
      </div>

      {{-- Stock Health Card - Emerald Theme --}}
      <div class="group relative bg-white dark:bg-gray-800 rounded-2xl p-6 border border-emerald-100 dark:border-emerald-800/50 shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-emerald-50/50 to-transparent dark:from-emerald-900/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
        <div class="absolute -right-10 -top-10 w-32 h-32 bg-emerald-400/20 rounded-full blur-2xl group-hover:bg-emerald-400/30 transition-all duration-500"></div>
        <div class="relative z-10 space-y-4">
          <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-500 to-emerald-600 shadow-lg shadow-emerald-500/25 flex items-center justify-center text-white">
              <i class="fa-solid fa-box-open text-xl"></i>
            </div>
            <div>
              <h3 class="text-xs font-black uppercase tracking-wider text-gray-500 dark:text-gray-400">Peringatan Bahan Baku</h3>
              <p class="text-[11px] text-gray-400 dark:text-gray-500 font-medium">Restock Alert • AI Monitoring</p>
            </div>
          </div>
          <div>
            <p class="text-4xl font-black bg-gradient-to-r from-emerald-600 to-emerald-500 bg-clip-text text-transparent">{{ $restockCount }} Item</p>
            <p class="text-[11px] text-gray-500 dark:text-gray-400 mt-1 uppercase font-bold tracking-wider">Beresiko habis 14 hari ke depan</p>
          </div>
          <div class="flex items-center gap-2 text-sm">
            <span class="text-emerald-600 dark:text-emerald-400 font-bold bg-emerald-100 dark:bg-emerald-900/30 px-2 py-0.5 rounded-full">Prioritas Tinggi</span>
            <span class="text-gray-400 text-xs">• Berdasarkan tren kafe</span>
          </div>
        </div>
      </div>

      {{-- Customer Retention Card - Rose Theme --}}
      <div class="group relative bg-white dark:bg-gray-800 rounded-2xl p-6 border border-rose-100 dark:border-rose-800/50 shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-rose-50/50 to-transparent dark:from-rose-900/20 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
        <div class="absolute -right-10 -top-10 w-32 h-32 bg-rose-400/20 rounded-full blur-2xl group-hover:bg-rose-400/30 transition-all duration-500"></div>
        <div class="relative z-10 space-y-4">
          <div class="flex items-center gap-3">
            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-rose-500 to-rose-600 shadow-lg shadow-rose-500/25 flex items-center justify-center text-white">
              <i class="fa-solid fa-users text-xl"></i>
            </div>
            <div>
              <h3 class="text-xs font-black uppercase tracking-wider text-gray-500 dark:text-gray-400">Retensi Pelanggan</h3>
              <p class="text-[11px] text-gray-400 dark:text-gray-500 font-medium">Loyalty Score</p>
            </div>
          </div>
          <div>
            <p class="text-4xl font-black bg-gradient-to-r from-rose-600 to-rose-500 bg-clip-text text-transparent">{{ round($retentionRate, 1) }}%</p>
            <p class="text-[11px] text-gray-500 dark:text-gray-400 mt-1 uppercase font-bold tracking-wider">Probabilitas order kembali</p>
          </div>
          <div class="flex items-center gap-2 text-sm">
            <span class="text-green-600 dark:text-green-400 font-bold bg-green-100 dark:bg-green-900/30 px-2 py-0.5 rounded-full flex items-center gap-1">
              <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
              Stabil
            </span>
            <span class="text-gray-400 text-xs">• Mayoritas waktu santai</span>
          </div>
        </div>
      </div>
    </div>

    {{-- Prediction Charts Section --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

      {{-- Revenue Forecast Chart --}}
      <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-100 dark:border-gray-700 shadow-lg hover:shadow-xl transition-all duration-300">
        <div class="flex items-center justify-between mb-8">
          <div>
            <h4 class="text-lg font-bold text-gray-900 dark:text-white flex items-center gap-2">
              <i class="fa-solid fa-chart-line text-cyan-500"></i>
              Forecast Pendapatan
            </h4>
            <p class="text-[10px] text-gray-500 dark:text-gray-400 uppercase font-bold tracking-wider">Proyeksi 6 Bulan Kedepan</p>
          </div>
          <div class="flex gap-4 text-[10px] uppercase font-bold text-gray-600 dark:text-gray-300">
            <span class="flex items-center gap-2"><span class="w-3 h-3 rounded-full bg-cyan-500 shadow-sm"></span> Prediksi AI</span>
            <span class="flex items-center gap-2"><span class="w-3 h-3 rounded-full bg-blue-400/60 border border-blue-500/30"></span> Historis</span>
          </div>
        </div>
        <div class="h-72 relative">
          <canvas id="forecastChart"></canvas>
        </div>
        <div class="mt-4 text-center text-[10px] text-gray-400 flex justify-center gap-6">
          <span class="flex items-center gap-1"><span class="w-4 h-px bg-cyan-500"></span> Data Aktual</span>
          <span class="flex items-center gap-1"><span class="w-4 h-px border-t-2 border-dashed border-cyan-500/60"></span> Area Prediksi</span>
        </div>
      </div>

      {{-- Smart Inventory List --}}
      <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-100 dark:border-gray-700 shadow-lg hover:shadow-xl transition-all duration-300">
        <div class="flex items-center justify-between mb-8">
          <div>
            <h4 class="text-lg font-bold text-gray-900 dark:text-white flex items-center gap-2">
              <i class="fa-solid fa-clipboard-list text-amber-500"></i>
              Rekomendasi Restok
            </h4>
            <p class="text-[10px] text-gray-500 dark:text-gray-400 uppercase font-bold tracking-wider">Analisis Kecepatan Habis</p>
          </div>
          <button class="group text-[11px] font-black text-cyan-500 uppercase hover:text-cyan-600 transition-all flex items-center gap-1">Lihat Semua <svg class="w-3 h-3 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></button>
        </div>
        <div class="space-y-4">
          @forelse ($restockItems as $item)
            <div
              class="group/item p-4 rounded-xl bg-gray-50 dark:bg-gray-700/30 border border-gray-100 dark:border-gray-600 hover:border-cyan-500/40 hover:shadow-md transition-all duration-300">
              <div class="flex items-center justify-between mb-3">
                <div class="flex items-center gap-3">
                  <div
                    class="w-9 h-9 rounded-lg bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-800 flex items-center justify-center text-gray-500 group-hover/item:text-cyan-500 transition-colors shadow-sm">
                    <i class="fa-solid fa-box text-sm"></i>
                  </div>
                  <div>
                    <span class="text-sm font-extrabold text-gray-900 dark:text-white">{{ $item['item'] }}</span>
                    <p class="text-[9px] text-gray-400 uppercase tracking-wider">Kebutuhan mendesak</p>
                  </div>
                </div>
                <span class="text-[11px] font-black uppercase px-2 py-1 rounded-full {{ $item['color'] === 'text-red-500' ? 'bg-red-100 text-red-600 dark:bg-red-900/40 dark:text-red-400' : ($item['color'] === 'text-amber-500' ? 'bg-amber-100 text-amber-600 dark:bg-amber-900/40 dark:text-amber-400' : 'bg-green-100 text-green-600 dark:bg-green-900/40 dark:text-green-400') }}">{{ $item['time'] }}</span>
              </div>
              <div class="relative w-full h-2 bg-gray-200 dark:bg-gray-600 rounded-full overflow-hidden">
                <div class="absolute h-full bg-gradient-to-r from-cyan-500 to-cyan-400 {{ $item['width'] }} rounded-full shadow-sm shadow-cyan-500/30"></div>
              </div>
            </div>
          @empty
            <div class="p-8 text-center text-sm text-gray-500 dark:text-gray-400 flex flex-col items-center gap-2">
              <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
              <span>Stok bahan baku sangat aman.</span>
            </div>
          @endforelse
        </div>
      </div>
    </div>

    {{-- AI Traffic Prediction --}}
    <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 border border-gray-100 dark:border-gray-700 shadow-lg hover:shadow-xl transition-all duration-300">
      <div class="flex items-center justify-between mb-8">
        <div>
          <h4 class="text-lg font-bold text-gray-900 dark:text-white flex items-center gap-2">
            <i class="fa-solid fa-clock text-purple-500"></i>
            Prediksi Jam Ramai
          </h4>
          <p class="text-[10px] text-gray-500 dark:text-gray-400 uppercase font-bold tracking-wider">Analisis Trafik Berdasarkan Waktu Transaksi</p>
        </div>
        <div class="px-3 py-1 rounded-lg bg-purple-50 dark:bg-purple-900/20 text-purple-600 dark:text-purple-400 text-[10px] font-black uppercase">
          AI Analysis • Peak Hour Prediction
        </div>
      </div>
      <div class="h-64 relative">
        <canvas id="trafficChart"></canvas>
      </div>
      <div class="mt-6 p-4 rounded-xl bg-purple-50/50 dark:bg-purple-900/10 border border-purple-100 dark:border-purple-800/30">
        <div class="flex items-start gap-3">
          <div class="w-8 h-8 rounded-lg bg-purple-500 flex items-center justify-center text-white shrink-0 shadow-lg shadow-purple-500/20">
            <i class="fa-solid fa-circle-info text-sm"></i>
          </div>
          <p class="text-xs text-purple-800 dark:text-purple-300 leading-relaxed font-medium">
            Data menunjukkan lonjakan trafik tertinggi biasanya terjadi pada jam-jam tertentu. Gunakan informasi ini untuk mengoptimalkan jumlah staf dan ketersediaan menu signature.
          </p>
        </div>
      </div>
    </div>

    {{-- AI Strategy Card --}}
    <div class="relative group bg-gradient-to-r from-gray-50 via-white to-gray-50 dark:from-gray-800/80 dark:via-gray-800 dark:to-gray-800/80 rounded-2xl p-8 border border-cyan-200 dark:border-cyan-800/60 shadow-xl hover:shadow-2xl transition-all duration-500 overflow-hidden">
      <div class="absolute inset-0 bg-gradient-to-r from-cyan-500/0 via-cyan-500/10 to-cyan-500/0 opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
      <div class="absolute -inset-1 bg-gradient-to-r from-cyan-500/20 to-purple-500/20 blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>

      <div class="relative flex flex-col md:flex-row items-center gap-8">
        <div
          class="relative w-24 h-24 shrink-0 rounded-2xl bg-gradient-to-br from-cyan-500 to-cyan-600 flex items-center justify-center text-white shadow-xl shadow-cyan-500/30 group-hover:scale-105 transition-transform duration-300">
          <i class="fa-solid fa-lightbulb text-4xl"></i>
          <div class="absolute -top-1 -right-1 w-5 h-5 bg-cyan-300 rounded-full blur-sm"></div>
        </div>
        <div class="flex-1 text-center md:text-left space-y-2">
          <h4 class="text-xl font-black uppercase tracking-tight text-gray-900 dark:text-white flex items-center justify-center md:justify-start gap-2">
            AI Strategy <span class="bg-gradient-to-r from-cyan-500 to-cyan-600 bg-clip-text text-transparent">Insight</span>
            <span class="inline-flex items-center rounded-full bg-cyan-100 dark:bg-cyan-900/50 px-2 py-0.5 text-[10px] font-bold text-cyan-700 dark:text-cyan-300">RECOMMENDED</span>
          </h4>
          <p class="text-sm text-gray-600 dark:text-gray-300 leading-relaxed mx-auto md:mx-0">
            {!! $aiInsightText !!}
          </p>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    (function() {
      const forecastCtx = document.getElementById('forecastChart').getContext('2d');

      const isDark     = document.documentElement.classList.contains('dark');
      const gridColor  = isDark ? 'rgba(255,255,255,0.05)' : 'rgba(0,0,0,0.05)';
      const labelColor = isDark ? '#9ca3af' : '#6b7280';

      const cyanGradient = forecastCtx.createLinearGradient(0, 0, 0, 300);
      cyanGradient.addColorStop(0, 'rgba(6, 182, 212, 0.25)');
      cyanGradient.addColorStop(0.5, 'rgba(6, 182, 212, 0.1)');
      cyanGradient.addColorStop(1, 'rgba(6, 182, 212, 0)');

      {{-- FIX: Simpan chartUnitLabel penuh ke variabel JS, tidak pakai substr() --}}
      const chartUnitLabel = '{{ $chartUnitLabel }}';

      new Chart(forecastCtx, {
        type: 'line',
        data: {
          labels: @json($chartLabels),
          datasets: [{
            label: 'Pendapatan (' + chartUnitLabel + ')',
            data: @json($chartData),
            borderColor: '#06b6d4',
            backgroundColor: cyanGradient,
            fill: true,
            tension: 0.4,
            borderWidth: 3,
            pointBackgroundColor: '#06b6d4',
            pointBorderColor: '#ffffff',
            pointBorderWidth: 2,
            pointRadius: 4,
            pointHoverRadius: 6,
            pointHoverBackgroundColor: '#0891b2',
            segment: {
              borderDash: ctx => ctx.p0DataIndex >= 4 ? [8, 6] : [],
              borderColor: ctx => ctx.p0DataIndex >= 4 ? 'rgba(6, 182, 212, 0.6)' : '#06b6d4',
              backgroundColor: ctx => ctx.p0DataIndex >= 4 ? 'rgba(6, 182, 212, 0.05)' : cyanGradient,
            }
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          interaction: { mode: 'index', intersect: false },
          plugins: {
            legend: { display: false },
            tooltip: {
              backgroundColor: isDark ? '#1f2937' : '#ffffff',
              titleColor: isDark ? '#f3f4f6' : '#111827',
              bodyColor: isDark ? '#d1d5db' : '#4b5563',
              borderColor: '#06b6d4',
              borderWidth: 1,
              padding: 10,
              callbacks: {
                label: function(context) {
                  return 'Rp ' + context.parsed.y.toLocaleString('id-ID') + ' ' + chartUnitLabel;
                }
              }
            }
          },
          scales: {
            x: {
              grid: { display: false },
              ticks: { color: labelColor, font: { size: 10, weight: 'bold' } }
            },
            y: {
              grid: { color: gridColor, drawBorder: false },
              ticks: {
                color: labelColor,
                font: { size: 10 },
                callback: function(value) {
                  {{-- FIX: Pakai chartUnitLabel penuh, bukan substr --}}
                  return 'Rp ' + value + (value > 0 ? ' ' + chartUnitLabel : '');
                }
              }
            }
          },
          elements: { line: { borderJoin: 'round' } }
        }
      });

      // --- Peak Hour Traffic Chart ---
      const trafficCtx     = document.getElementById('trafficChart').getContext('2d');
      const purpleGradient = trafficCtx.createLinearGradient(0, 0, 0, 300);
      purpleGradient.addColorStop(0, 'rgba(168, 85, 247, 0.4)');
      purpleGradient.addColorStop(1, 'rgba(168, 85, 247, 0)');

      new Chart(trafficCtx, {
        type: 'bar',
        data: {
          labels: @json($peakHourLabels),
          datasets: [{
            label: 'Total Transaksi',
            data: @json($peakHourData),
            backgroundColor: purpleGradient,
            borderColor: '#a855f7',
            borderWidth: 2,
            borderRadius: 6,
            hoverBackgroundColor: '#9333ea',
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: { display: false },
            tooltip: {
              backgroundColor: isDark ? '#1f2937' : '#ffffff',
              titleColor: isDark ? '#f3f4f6' : '#111827',
              bodyColor: isDark ? '#d1d5db' : '#4b5563',
              borderColor: '#a855f7',
              borderWidth: 1,
            }
          },
          scales: {
            x: {
              grid: { display: false },
              ticks: { color: labelColor, font: { size: 9, weight: 'bold' } }
            },
            y: {
              beginAtZero: true,
              grid: { color: gridColor, drawBorder: false },
              ticks: { color: labelColor, font: { size: 9 } }
            }
          }
        }
      });
    })();
  </script>
@endpush