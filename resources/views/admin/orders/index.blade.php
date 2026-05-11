@extends('layouts.admin')

@section('content')
  <x-admin.card title="Manajemen Pesanan" subtitle="Pantau dan kelola semua transaksi masuk secara real-time">

    {{-- Real-time Notification Banner --}}
    <div id="new-order-alert"
      class="hidden mb-4 flex items-center gap-3 px-4 py-3 bg-green-50 border border-green-200 text-green-800 rounded-xl dark:bg-green-900/30 dark:border-green-700 dark:text-green-300 cursor-pointer"
      onclick="dismissNewOrderAlert()">
      <span class="relative flex h-3 w-3">
        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
        <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
      </span>
      <span id="new-order-alert-text" class="text-sm font-semibold">Pesanan baru masuk!</span>
      <span class="ml-auto text-xs opacity-60">Klik untuk tutup</span>
    </div>

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
          "dom": '<"flex justify-between items-center mb-4"l>rt<"flex justify-between items-center mt-4"ip><"clear">',
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

        // ─── Auto-Polling ringan: cek pesanan baru setiap 30 detik ──────────
        var latestOrderId = null;

        // Tangkap ID terbaru setelah draw pertama via ajax.json()
        table.one('draw', function() {
          var json = table.ajax.json();
          if (json && json.data && json.data.length > 0) {
            latestOrderId = json.data[0].id_pesanan_raw;
          }

          // Mulai interval setelah ID awal berhasil ditangkap
          setInterval(function() {
            $.getJSON("{{ route('admin.orders.latestId') }}", function(res) {
              var newestId = res.latest_id;
              if (latestOrderId !== null && newestId > latestOrderId) {
                var count = newestId - latestOrderId;
                latestOrderId = newestId;
                showNewOrderAlert(count);
                table.ajax.reload(null, false); // reload tanpa reset halaman/scroll
              } else if (latestOrderId === null) {
                latestOrderId = newestId;
              }
            });
          }, 30000); // setiap 30 detik
        });

        function showNewOrderAlert(count) {
          var text = count > 1
            ? count + ' pesanan baru masuk! Tabel diperbarui otomatis.'
            : 'Ada 1 pesanan baru masuk! Tabel diperbarui otomatis.';
          $('#new-order-alert-text').text(text);
          $('#new-order-alert').removeClass('hidden').addClass('flex');
          clearTimeout(window._orderAlertTimer);
          window._orderAlertTimer = setTimeout(dismissNewOrderAlert, 8000);
        }

        window.dismissNewOrderAlert = function() {
          $('#new-order-alert').addClass('hidden').removeClass('flex');
        };

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
