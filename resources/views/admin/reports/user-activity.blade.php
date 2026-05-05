@extends('layouts.admin')

@section('content')
  <x-admin.card title="Aktivitas User" subtitle="Monitor aktivitas pengguna di platform">
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

    <!-- Summary Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
      <div
        class="bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/20 p-6 rounded-xl border border-blue-200 dark:border-blue-800">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-sm font-medium text-blue-600 dark:text-blue-400">Total Aktivitas</p>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $logs->count() }}</p>
          </div>
          <div class="p-3 bg-blue-500 rounded-lg">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
            </svg>
          </div>
        </div>
      </div>

      <div
        class="bg-gradient-to-br from-green-50 to-green-100 dark:from-green-900/20 dark:to-green-800/20 p-6 rounded-xl border border-green-200 dark:border-green-800">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-sm font-medium text-green-600 dark:text-green-400">User Aktif</p>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $groupByUser->count() }}</p>
          </div>
          <div class="p-3 bg-green-500 rounded-lg">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
          </div>
        </div>
      </div>

      <div
        class="bg-gradient-to-br from-purple-50 to-purple-100 dark:from-purple-900/20 dark:to-purple-800/20 p-6 rounded-xl border border-purple-200 dark:border-purple-800">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-sm font-medium text-purple-600 dark:text-purple-400">Rata-rata per User</p>
            <p class="text-2xl font-bold text-gray-900 dark:text-white">
              {{ $groupByUser->count() > 0 ? round($logs->count() / $groupByUser->count(), 1) : 0 }}</p>
          </div>
          <div class="p-3 bg-purple-500 rounded-lg">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
            </svg>
          </div>
        </div>
      </div>
    </div>

    <!-- User Activity Summary -->
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden mb-8">
      <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Ringkasan Aktivitas per User</h3>
        <p class="text-sm text-gray-600 dark:text-gray-400">Periode:
          {{ \Carbon\Carbon::parse($startDate)->format('d/m/Y') }} -
          {{ \Carbon\Carbon::parse($endDate)->format('d/m/Y') }}</p>
      </div>

      @if ($groupByUser->count())
        <div class="overflow-x-auto">
          <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 datatable">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
              <tr>
                <th class="px-6 py-3">User</th>
                <th class="px-6 py-3">Total Aktivitas</th>
                <th class="px-6 py-3">Persentase</th>
                <th class="px-6 py-3">Aktivitas Terakhir</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
              @foreach ($groupByUser->sortByDesc('total') as $userActivity)
                <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700">
                  <td class="px-6 py-4">
                    <div class="flex items-center">
                      <div class="flex-shrink-0 h-8 w-8">
                        <div class="h-8 w-8 rounded-full bg-gray-300 dark:bg-gray-600 flex items-center justify-center">
                          <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
                            {{ strtoupper(substr($userActivity['user'], 0, 1)) }}
                          </span>
                        </div>
                      </div>
                      <div class="ml-4">
                        <div class="text-sm font-medium text-gray-900 dark:text-white">{{ $userActivity['user'] }}</div>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4">
                    <span
                      class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                      {{ $userActivity['total'] }} aktivitas
                    </span>
                  </td>
                  <td class="px-6 py-4">
                    <div class="flex items-center">
                      <div class="w-full bg-gray-200 rounded-full h-2 mr-2 dark:bg-gray-700">
                        <div class="bg-blue-600 h-2 rounded-full"
                          style="width: {{ $logs->count() > 0 ? ($userActivity['total'] / $logs->count()) * 100 : 0 }}%">
                        </div>
                      </div>
                      <span class="text-sm font-medium text-gray-900 dark:text-white">
                        {{ $logs->count() > 0 ? round(($userActivity['total'] / $logs->count()) * 100, 1) : 0 }}%
                      </span>
                    </div>
                  </td>
                  <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                    {{ $logs->where('id_users', $userActivity['user_id'] ?? null)->first()->created_at->diffForHumans() ?? 'N/A' }}
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
              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
          </svg>
          <p class="text-gray-500 dark:text-gray-400">Tidak ada aktivitas user dalam periode ini</p>
        </div>
      @endif
    </div>

    <!-- Detailed Activity Log -->
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
      <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Log Aktivitas Detail</h3>
      </div>

      @if ($logs->count())
        <div class="overflow-x-auto">
          <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 datatable">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
              <tr>
                <th class="px-6 py-3">Waktu</th>
                <th class="px-6 py-3">User</th>
                <th class="px-6 py-3">Aksi</th>
                <th class="px-6 py-3">Entity</th>
                <th class="px-6 py-3">Detail</th>
                <th class="px-6 py-3">IP Address</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
              @foreach ($logs as $log)
                <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700">
                  <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">
                    {{ $log->created_at->format('d/m/Y H:i:s') }}
                  </td>
                  <td class="px-6 py-4">
                    <div class="flex items-center">
                      <div class="flex-shrink-0 h-6 w-6">
                        <div class="h-6 w-6 rounded-full bg-gray-300 dark:bg-gray-600 flex items-center justify-center">
                          <span class="text-xs font-medium text-gray-700 dark:text-gray-300">
                            {{ strtoupper(substr($log->user->name ?? 'U', 0, 1)) }}
                          </span>
                        </div>
                      </div>
                      <div class="ml-3">
                        <div class="text-sm font-medium text-gray-900 dark:text-white">
                          {{ $log->user->name ?? 'Unknown' }}</div>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4">
                    <span
                      class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                      @if (strtolower($log->action) == 'create') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300
                      @elseif(strtolower($log->action) == 'update') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300
                      @elseif(strtolower($log->action) == 'delete') bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300
                      @else bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-300 @endif">
                      {{ ucfirst($log->action) }}
                    </span>
                  </td>
                  <td class="px-6 py-4">
                    <span
                      class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300">
                      {{ ucfirst($log->entity) }}
                    </span>
                  </td>
                  <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400 max-w-xs truncate">
                    {{ $log->entity_id ? 'ID: ' . $log->entity_id : '-' }}
                  </td>
                  <td class="px-6 py-4 text-sm font-mono text-gray-500 dark:text-gray-400">
                    {{ $log->ip_address ?? '-' }}
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
              d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
          <p class="text-gray-500 dark:text-gray-400">Tidak ada log aktivitas dalam periode ini</p>
        </div>
      @endif
    </div>
  </x-admin.card>
@endsection
