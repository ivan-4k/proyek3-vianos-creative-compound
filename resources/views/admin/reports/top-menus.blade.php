@extends('layouts.admin')

@section('content')
  <x-admin.card title="Menu Terlaris" subtitle="Analisis produk yang paling diminati oleh pelanggan">

    {{-- Filter Form --}}
    <form method="GET"
      class="mb-8 p-4 bg-gray-50 dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
          <label class="block text-xs font-bold text-gray-500 uppercase mb-2 dark:text-gray-400">Tanggal Mulai</label>
          <input type="date" name="from" value="{{ $startDate }}"
            class="w-full px-3 py-2 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white transition-all">
        </div>
        <div>
          <label class="block text-xs font-bold text-gray-500 uppercase mb-2 dark:text-gray-400">Tanggal Akhir</label>
          <input type="date" name="to" value="{{ $endDate }}"
            class="w-full px-3 py-2 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:text-white transition-all">
        </div>
        <div class="flex items-end">
          <button type="submit"
            class="w-full px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 transition-all font-semibold shadow-lg shadow-blue-500/25">
            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            Perbarui Laporan
          </button>
        </div>
      </div>
    </form>

    @if ($topMenus->count())
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
        {{-- Visualisasi Chart --}}
        <div
          class="lg:col-span-2 bg-white dark:bg-gray-800 p-6 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm">
          <h4 class="text-sm font-bold text-gray-700 dark:text-gray-300 mb-6 uppercase tracking-wider">Perbandingan Volume
            Penjualan</h4>
          <div class="h-80">
            <canvas id="topMenusChart"></canvas>
          </div>
        </div>

        {{-- Top 3 Spotlight --}}
        <div class="space-y-4">
          <h4 class="text-sm font-bold text-gray-700 dark:text-gray-300 mb-4 uppercase tracking-wider">Juara Penjualan
          </h4>
          @foreach ($topMenus->take(3) as $index => $menu)
            <div
              class="p-4 rounded-2xl border flex items-center gap-4 {{ $index == 0 ? 'bg-yellow-50 border-yellow-100 dark:bg-yellow-900/10 dark:border-yellow-900/30' : 'bg-white dark:bg-gray-800 border-gray-100 dark:border-gray-700' }}">
              <span class="text-2xl">{{ $index == 0 ? '🥇' : ($index == 1 ? '🥈' : '🥉') }}</span>
              <div class="flex-1">
                <p class="text-sm font-bold text-gray-900 dark:text-white">{{ $menu->name }}</p>
                <p class="text-xs text-gray-500">{{ $menu->total_quantity }} Porsi Terjual</p>
              </div>
              <div class="text-right">
                <p class="text-xs font-bold text-blue-600 dark:text-blue-400">Rp
                  {{ number_format($menu->total_revenue, 0, ',', '.') }}</p>
              </div>
            </div>
          @endforeach
        </div>
      </div>

      {{-- Table Section --}}
      <div
        class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
          <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-300">
              <tr>
                <th class="px-6 py-4 font-bold">Rank</th>
                <th class="px-6 py-4 font-bold">Menu</th>
                <th class="px-6 py-4 font-bold text-center">Terjual</th>
                <th class="px-6 py-4 font-bold">Pendapatan</th>
                <th class="px-6 py-4 font-bold">Kontribusi</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
              @php $totalRevenue = $topMenus->sum('total_revenue'); @endphp
              @foreach ($topMenus as $index => $menu)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                  <td class="px-6 py-4">
                    <span
                      class="font-bold {{ $index < 3 ? 'text-blue-600 dark:text-blue-400' : 'text-gray-400' }}">#{{ $index + 1 }}</span>
                  </td>
                  <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                      <div
                        class="h-10 w-10 rounded-lg bg-gray-100 dark:bg-gray-700 flex items-center justify-center overflow-hidden">
                        @if ($menu->image ?? false)
                          <img src="{{ asset('storage/menus/' . $menu->image) }}" alt="{{ $menu->name }}"
                            class="h-full w-full object-cover">
                        @else
                          <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                          </svg>
                        @endif
                      </div>
                      <span class="font-semibold text-gray-900 dark:text-white">{{ $menu->name }}</span>
                    </div>
                  </td>
                  <td class="px-6 py-4 text-center">
                    <span
                      class="px-2.5 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400">
                      {{ $menu->total_quantity }} <small>Porsi</small>
                    </span>
                  </td>
                  <td class="px-6 py-4 font-mono text-gray-900 dark:text-white">
                    Rp {{ number_format($menu->total_revenue, 0, ',', '.') }}
                  </td>
                  <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                      <div class="flex-1 bg-gray-100 dark:bg-gray-700 rounded-full h-1.5 overflow-hidden">
                        <div class="bg-blue-600 h-full transition-all duration-500"
                          style="width: {{ $totalRevenue > 0 ? ($menu->total_revenue / $totalRevenue) * 100 : 0 }}%">
                        </div>
                      </div>
                      <span class="text-xs font-bold text-gray-700 dark:text-gray-300">
                        {{ $totalRevenue > 0 ? round(($menu->total_revenue / $totalRevenue) * 100, 1) : 0 }}%
                      </span>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    @else
      <div
        class="px-6 py-20 text-center bg-white dark:bg-gray-800 rounded-2xl border border-dashed border-gray-200 dark:border-gray-700">
        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
        </svg>
        <p class="text-gray-500 dark:text-gray-400 font-medium">Tidak ada data penjualan menu pada periode yang dipilih.
        </p>
      </div>
    @endif
  </x-admin.card>

  @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const topMenus = @json($topMenus);
        if (!topMenus || topMenus.length === 0) return;

        const labels = topMenus.map(item => item.name);
        const data = topMenus.map(item => item.total_quantity);

        const ctx = document.getElementById('topMenusChart').getContext('2d');
        new Chart(ctx, {
          type: 'bar',
          data: {
            labels: labels,
            datasets: [{
              label: 'Porsi Terjual',
              data: data,
              backgroundColor: 'rgba(59, 130, 246, 0.8)',
              borderColor: '#2563eb',
              borderWidth: 1,
              borderRadius: 8,
            }]
          },
          options: {
            responsive: true,
            maintainAspectRatio: false,
            indexAxis: 'y',
            plugins: {
              legend: {
                display: false
              },
              tooltip: {
                backgroundColor: '#1f2937',
                titleColor: '#fff',
                bodyColor: '#fff',
                padding: 12,
                displayColors: false,
                callbacks: {
                  label: function(context) {
                    return context.parsed.x + ' Porsi Terjual';
                  }
                }
              }
            },
            scales: {
              x: {
                beginAtZero: true,
                grid: {
                  display: false
                },
                ticks: {
                  color: '#6b7280'
                }
              },
              y: {
                grid: {
                  display: false
                },
                ticks: {
                  color: '#6b7280'
                }
              }
            }
          }
        });
      });
    </script>
  @endpush
@endsection
