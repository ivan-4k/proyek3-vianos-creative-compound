@extends('layouts.admin')

@section('content')
  <x-admin.card title="Manajemen Pesanan" subtitle="Pantau dan kelola semua transaksi masuk secara real-time">

    {{-- Search & Filter Section --}}
    <div class="mb-6 flex flex-col md:flex-row gap-4 items-end">
      {{-- Input Search Custom --}}
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
            placeholder="Cari Kode Pesanan, ID, atau Nama...">
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
          @foreach ($statuses as $status)
            <option value="{{ $status }}">{{ str_replace('_', ' ', ucfirst($status)) }}</option>
          @endforeach
        </select>
      </div>
    </div>

    {{-- Tabel Data --}}
    <div
      class="relative overflow-x-auto border border-gray-100 dark:border-gray-700 rounded-2xl p-4 bg-white dark:bg-gray-800 shadow-sm">
      <table id="tabel-orders" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th scope="col" class="px-6 py-4 font-bold">No. Pesanan</th>
            <th scope="col" class="px-6 py-4 font-bold">Kode</th>
            <th scope="col" class="px-6 py-4 font-bold">Pelanggan</th>
            <th scope="col" class="px-6 py-4 font-bold">Total</th>
            <th scope="col" class="px-6 py-4 font-bold">Status</th>
            <th scope="col" class="px-6 py-4 font-bold">Waktu Pesan</th>
            <th scope="col" class="px-6 py-4 font-bold text-right">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
        </tbody>
      </table>
    </div>

  </x-admin.card>

  @push('scripts')
    <script>
      $(document).ready(function() {
        var table = $('#tabel-orders').DataTable({
          "dom": '<"top">rt<"bottom"ilp><"clear">',
          processing: true,
          serverSide: true,
          ajax: {
            url: "{{ route('admin.orders.data') }}",
            data: function(d) {
              d.status = $('#customStatus').val();
            }
          },
          columns: [{
              data: 'id_pesanan',
              name: 'id_pesanan'
            },
            {
              data: 'order_code',
              name: 'order_code'
            },
            {
              data: 'pelanggan',
              name: 'user.name'
            },
            {
              data: 'total',
              name: 'total'
            },
            {
              data: 'order_status',
              name: 'order_status'
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
            [5, "desc"]
          ],
          pageLength: 25,
          language: {
            "processing": "Memuat transaksi...",
            "paginate": {
              "previous": "Sebelumnya",
              "next": "Selanjutnya"
            },
            "info": "Menampilkan _START_ - _END_ dari _TOTAL_ pesanan",
            "infoEmpty": "Tidak ada pesanan",
            "emptyTable": "Belum ada transaksi masuk"
          }
        });

        // Event Pencarian Instan
        let searchTimeout;
        $('#customSearch').on('keyup', function() {
          clearTimeout(searchTimeout);
          let val = this.value;
          searchTimeout = setTimeout(function() {
            table.search(val).draw();
          }, 400);
        });

        // Event Filter Dropdown Status
        $('#customStatus').on('change', function() {
          table.draw();
        });
      });
    </script>
  @endpush
@endsection
