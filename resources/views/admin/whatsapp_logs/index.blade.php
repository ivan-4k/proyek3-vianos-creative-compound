@extends('layouts.admin')
@section('content')
  <x-admin.card title="WhatsApp Logs"
    subtitle="Riwayat pengiriman pesan WhatsApp. Data dimuat secara bertahap untuk menjaga performa.">

    {{-- Search & Filter Section --}}
    <div class="mb-6 flex flex-col md:flex-row gap-4 items-end">
      {{-- Input Search --}}
      <div class="w-full md:w-1/2">
        <label for="customSearch" class="block mb-2 text-xs font-semibold text-gray-500 uppercase dark:text-gray-400">
          Pencarian Instan
        </label>
        <div class="relative">
          <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" fill="none" viewBox="0 0 20 20">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
            </svg>
          </div>
          <input type="text" id="customSearch"
            class="bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400"
            placeholder="Cari nomor tujuan atau isi pesan...">
        </div>
      </div>

      {{-- Dropdown Status --}}
      <div class="w-full md:w-1/4">
        <label for="customStatus" class="block mb-2 text-xs font-semibold text-gray-500 uppercase dark:text-gray-400">
          Filter Status
        </label>
        <select id="customStatus"
          class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
          <option value="">Semua Status</option>
          @if (isset($statuses))
            @foreach ($statuses as $s)
              <option value="{{ $s }}">{{ ucfirst($s) }}</option>
            @endforeach
          @else
            <option value="pending">Pending</option>
            <option value="sent">Sent</option>
            <option value="failed">Failed</option>
          @endif
        </select>
      </div>

      {{-- Dropdown Tipe --}}
      <div class="w-full md:w-1/4">
        <label for="customType" class="block mb-2 text-xs font-semibold text-gray-500 uppercase dark:text-gray-400">
          Filter Tipe
        </label>
        <select id="customType"
          class="w-full bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
          <option value="">Semua Tipe</option>
          @if (isset($types))
            @foreach ($types as $t)
              <option value="{{ $t }}">{{ ucfirst(str_replace('_', ' ', $t)) }}</option>
            @endforeach
          @endif
        </select>
      </div>
    </div>

    {{-- Table Section --}}
    <div
      class="relative overflow-x-auto bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow-sm p-4">
      <table id="waLogsTable" class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm w-full">
        <thead class="bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider">
          <tr>
            <th scope="col" class="px-6 py-3 font-semibold text-left">ID</th>
            <th scope="col" class="px-6 py-3 font-semibold text-left">Order</th>
            <th scope="col" class="px-6 py-3 font-semibold text-left">Nomor</th>
            <th scope="col" class="px-6 py-3 font-semibold text-left">Pesan</th>
            <th scope="col" class="px-6 py-3 font-semibold text-left">Tipe</th>
            <th scope="col" class="px-6 py-3 font-semibold text-left">Status</th>
            <th scope="col" class="px-6 py-3 font-semibold text-left">Waktu</th>
            <th scope="col" class="px-6 py-3 font-semibold text-right">Aksi</th>
          </tr>
        </thead>
        <tbody class="bg-white dark:bg-transparent divide-y divide-gray-200 dark:divide-gray-700">
        </tbody>
      </table>
    </div>

  </x-admin.card>

  @push('scripts')
    <script>
      $(document).ready(function() {
        // 1. Inisialisasi DataTables (Server-Side)
        var table = $('#waLogsTable').DataTable({
          "dom": '<"top">rt<"bottom"ilp><"clear">',
          processing: true,
          serverSide: true,
          ajax: {
            url: "{{ route('admin.whatsapp-logs.data') }}",
            data: function(d) {
              // Kirim payload custom untuk filter dropdown ke backend
              d.status = $('#customStatus').val();
              d.type = $('#customType').val();
            }
          },
          columns: [{
              data: 'id_wa_log',
              name: 'id_wa_log'
            },
            {
              data: 'id_pesanan',
              name: 'id_pesanan'
            },
            {
              data: 'destination_number',
              name: 'destination_number'
            },
            {
              data: 'message',
              name: 'message'
            },
            {
              data: 'type',
              name: 'type'
            },
            {
              data: 'status',
              name: 'status'
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
          pageLength: 15,
          language: {
            "processing": "Mencari log...",
            "paginate": {
              "previous": "Sebelumnya",
              "next": "Selanjutnya"
            },
            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ log",
            "infoEmpty": "Tidak ada data tersedia",
            "emptyTable": "Tidak ada log yang sesuai"
          }
        });

        // 2. Event Pencarian Instan (Memicu AJAX)
        // Gunakan jeda (debounce)
        let searchTimeout;
        $('#customSearch').on('keyup', function() {
          clearTimeout(searchTimeout);
          let val = this.value;
          searchTimeout = setTimeout(function() {
            table.search(val).draw();
          }, 400);
        });

        // 3. Event Filter Dropdown Status (Memicu AJAX)
        $('#customStatus').on('change', function() {
          table.draw();
        });

        // 4. Event Filter Dropdown Tipe (Memicu AJAX)
        $('#customType').on('change', function() {
          table.draw();
        });
      });
    </script>
  @endpush
@endsection
