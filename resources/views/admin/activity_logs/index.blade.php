@extends('layouts.admin')

@section('content')
  <x-admin.card title="Activity Logs"
    subtitle="Riwayat aktivitas pengguna di dalam sistem. Data dimuat secara bertahap (Server-Side) agar tetap ringan.">

    {{-- Header Actions (Filter & Delete All) --}}
    <div class="mb-6 flex flex-col md:flex-row md:items-end justify-between gap-4">

      {{-- Custom Dropdown Filters --}}
      <div class="flex flex-wrap gap-3 items-end">
        <div>
          <label for="filter-entity" class="block mb-1 text-xs font-medium text-gray-700 dark:text-gray-300">Filter
            Entitas</label>
          <select id="filter-entity"
            class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            <option value="">Semua Entitas</option>
            @foreach ($entities as $ent)
              <option value="{{ $ent }}">{{ $ent }}</option>
            @endforeach
          </select>
        </div>
        <div>
          <label for="filter-action" class="block mb-1 text-xs font-medium text-gray-700 dark:text-gray-300">Filter
            Tindakan</label>
          <select id="filter-action"
            class="bg-gray-50 border border-gray-300 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            <option value="">Semua Tindakan</option>
            @foreach ($actions as $act)
              <option value="{{ $act }}">{{ ucfirst($act) }}</option>
            @endforeach
          </select>
        </div>
        <button id="btn-reset-filter"
          class="hidden text-sm text-red-500 hover:text-red-700 underline mb-2 transition-all">
          Reset Filter
        </button>
      </div>

      {{-- Tombol Hapus Semua --}}
      <form action="{{ route('admin.activity-logs.clear') }}" method="POST"
        onsubmit="return confirm('Apakah Anda yakin ingin menghapus semua log aktivitas? TINDAKAN INI TIDAK DAPAT DIBATALKAN dan akan mengosongkan seluruh riwayat!')">
        @csrf @method('DELETE')
        <button type="submit"
          class="inline-flex items-center gap-2 bg-red-50 text-red-600 hover:bg-red-600 hover:text-white border border-red-200 hover:border-red-600 px-4 py-2 rounded-xl transition-colors font-medium text-sm dark:bg-red-900/20 dark:border-red-800 dark:text-red-400 dark:hover:bg-red-600 dark:hover:text-white">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
          </svg>
          Hapus Semua Log
        </button>
      </form>
    </div>

    {{-- Tabel Server-Side --}}
    <div class="relative overflow-x-auto border border-gray-100 dark:border-gray-700 rounded-2xl p-4">
      <table id="tabel-activity-logs" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider">
          <tr>
            <th class="px-6 py-4 font-semibold whitespace-nowrap">ID</th>
            <th class="px-6 py-4 font-semibold whitespace-nowrap">User</th>
            <th class="px-6 py-4 font-semibold whitespace-nowrap">Tindakan</th>
            <th class="px-6 py-4 font-semibold whitespace-nowrap">Entitas</th>
            <th class="px-6 py-4 font-semibold whitespace-nowrap">ID Entitas</th>
            <th class="px-6 py-4 font-semibold whitespace-nowrap">IP Address</th>
            <th class="px-6 py-4 font-semibold whitespace-nowrap">Waktu</th>
            <th class="px-6 py-4 font-semibold text-right whitespace-nowrap">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
          {{-- Diisi secara otomatis oleh AJAX Yajra DataTables --}}
        </tbody>
      </table>
    </div>

  </x-admin.card>

  @push('scripts')
    <script>
      $(document).ready(function() {
        // 1. Inisialisasi Yajra DataTables Server Side
        var table = $('#tabel-activity-logs').DataTable({
          processing: true,
          serverSide: true,
          ajax: {
            url: "{{ route('admin.activity-logs.data') }}",
            data: function(d) {
              d.entity = $('#filter-entity').val();
              d.action = $('#filter-action').val();
            }
          },
          columns: [{
              data: 'id_aktivitas',
              name: 'id_aktivitas'
            },
            {
              data: 'user_name',
              name: 'user.name'
            },
            {
              data: 'action',
              name: 'action'
            },
            {
              data: 'entity',
              name: 'entity'
            },
            {
              data: 'entity_id',
              name: 'entity_id'
            },
            {
              data: 'ip_address',
              name: 'ip_address'
            },
            {
              data: 'created_at',
              name: 'created_at'
            },
            {
              data: 'aksi',
              name: 'aksi',
              orderable: false,
              searchable: false
            }
          ],
          order: [
            [6, "desc"]
          ],
          language: {
            "search": "Cari Log:",
            "lengthMenu": "Tampilkan _MENU_ data",
            "info": "Menampilkan _START_-_END_ dari _TOTAL_",
            "infoEmpty": "Tidak ada data riwayat",
            "zeroRecords": "Tidak ada log yang cocok.",
            "processing": "Mencari data...",
            "paginate": {
              "first": "Awal",
              "last": "Akhir",
              "next": "›",
              "previous": "‹"
            }
          }
        });

        // 2. Trigger pencarian otomatis saat Dropdown berubah
        $('#filter-entity, #filter-action').on('change', function() {
          table.draw();
          checkFilters();
        });

        // 3. Logika tombol Reset Filter
        const btnReset = $('#btn-reset-filter');

        function checkFilters() {
          if ($('#filter-entity').val() !== '' || $('#filter-action').val() !== '') {
            btnReset.removeClass('hidden');
          } else {
            btnReset.addClass('hidden');
          }
        }

        btnReset.on('click', function() {
          $('#filter-entity').val('');
          $('#filter-action').val('');
          table.draw();
          checkFilters();
        });
      });
    </script>
  @endpush
@endsection
