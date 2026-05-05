@extends('layouts.admin')

@section('content')
  <x-admin.card title="Notifikasi Pengguna" subtitle="Kelola promo dan notifikasi untuk pengguna">
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-8">

      {{-- Kolom Kiri: Form Kirim Notifikasi --}}
      <div class="xl:col-span-1 bg-white dark:bg-gray-900 rounded-3xl border border-gray-200 dark:border-gray-700 p-6">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Kirim Notifikasi Baru</h3>

        <form method="POST" action="{{ route('admin.notifications.store') }}">
          @csrf
          <div class="space-y-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Tipe Notifikasi <span class="text-red-500">*</span>
              </label>
              <select name="type" required
                class="w-full px-3 py-2 border rounded-lg dark:bg-gray-800 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                <option value="promo">Promo</option>
                <option value="system">System</option>
              </select>
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Kirim ke <span class="text-red-500">*</span>
              </label>
              <select id="recipient-select" name="recipient" required
                class="w-full px-3 py-2 border rounded-lg dark:bg-gray-800 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                <option value="all">Semua Pengguna</option>
                <option value="user">Pengguna Tertentu</option>
              </select>
            </div>

            <div id="user-select-wrapper" class="hidden">
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Pilih Pengguna <span class="text-red-500">*</span>
              </label>
              <select name="user_id"
                class="w-full px-3 py-2 border rounded-lg dark:bg-gray-800 dark:text-white focus:ring-blue-500 focus:border-blue-500">
                <option value="">Pilih pengguna...</option>
                @foreach ($users as $user)
                  <option value="{{ $user->id_users }}">{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
              </select>
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Judul <span class="text-red-500">*</span>
              </label>
              <input type="text" name="title" value="{{ old('title') }}" required
                class="w-full px-3 py-2 border rounded-lg dark:bg-gray-800 dark:text-white focus:ring-blue-500 focus:border-blue-500"
                placeholder="Judul notifikasi">
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                Pesan <span class="text-red-500">*</span>
              </label>
              <textarea name="message" rows="4" required
                class="w-full px-3 py-2 border rounded-lg dark:bg-gray-800 dark:text-white focus:ring-blue-500 focus:border-blue-500"
                placeholder="Isi pesan notifikasi">{{ old('message') }}</textarea>
            </div>

            <button type="submit"
              class="w-full inline-flex justify-center items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
              Kirim Notifikasi
            </button>
          </div>
        </form>
      </div>

      {{-- Kolom Kanan: Tabel Notifikasi --}}
      <div class="xl:col-span-2">
        <div class="bg-white dark:bg-gray-900 rounded-3xl border border-gray-200 dark:border-gray-700 p-6 h-full">

          <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <div>
              <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Riwayat Notifikasi</h3>
              <p class="text-sm text-gray-500 dark:text-gray-400">Semua notifikasi yang telah dikirim.</p>
            </div>
            <div class="flex items-center gap-3">
              <label for="filter-type" class="text-sm font-medium text-gray-700 dark:text-gray-300">Filter Tipe:</label>
              <select id="filter-type"
                class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:text-white">
                <option value="">Semua Tipe</option>
                <option value="promo">Promo</option>
                <option value="system">System</option>
              </select>
            </div>
          </div>

          {{-- Tabel Data --}}
          <div class="overflow-x-auto">
            <table id="tabel-notifikasi" class="min-w-full text-sm text-left text-gray-500 dark:text-gray-400">
              <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-800 dark:text-gray-300">
                <tr>
                  <th class="px-4 py-3">No</th>
                  <th class="px-4 py-3">User</th>
                  <th class="px-4 py-3">Tipe</th>
                  <th class="px-4 py-3">Judul</th>
                  <th class="px-4 py-3">Pesan</th>
                  <th class="px-4 py-3">Status</th>
                  <th class="px-4 py-3">Dikirim</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </x-admin.card>

  @push('scripts')
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        // 1. Logika Toggle Field "Pilih Pengguna"
        const recipientSelect = document.getElementById('recipient-select');
        const userSelectWrapper = document.getElementById('user-select-wrapper');
        const userSelect = userSelectWrapper.querySelector('select[name="user_id"]');

        function updateUserSelectRequirement() {
          if (recipientSelect.value === 'user') {
            userSelectWrapper.classList.remove('hidden');
            userSelect.setAttribute('required', 'required');
          } else {
            userSelectWrapper.classList.add('hidden');
            userSelect.removeAttribute('required');
            userSelect.value = '';
          }
        }

        recipientSelect.addEventListener('change', updateUserSelectRequirement);
        updateUserSelectRequirement();
      });

      // 2. Inisialisasi DataTables & Fitur Filter Instan
      $(document).ready(function() {
        // INISIALISASI SERVER-SIDE DATATABLES
        var table = $('#tabel-notifikasi').DataTable({
          processing: true,
          serverSide: true,
          ajax: {
            url: "{{ route('admin.notifications.data') }}",
            data: function(d) {
              // Kirim parameter filter Tipe ke controller via AJAX
              d.type = $('#filter-type').val();
            }
          },
          columns: [{
              data: 'DT_RowIndex',
              name: 'DT_RowIndex',
              orderable: false,
              searchable: false
            },
            {
              data: 'user_name',
              name: 'user.name'
            },
            {
              data: 'type',
              name: 'type'
            },
            {
              data: 'title',
              name: 'title'
            },
            {
              data: 'message',
              name: 'message'
            },
            {
              data: 'is_read',
              name: 'is_read',
              searchable: false
            },
            {
              data: 'created_at',
              name: 'created_at'
            }
          ],
          order: [
            [6, "desc"]
          ],
          language: {
            "search": "Cari Riwayat:",
            "lengthMenu": "Tampilkan _MENU_ data",
            "info": "Menampilkan _START_-_END_ dari _TOTAL_",
            "infoEmpty": "Tidak ada data",
            "zeroRecords": "Tidak ada riwayat notifikasi yang ditemukan.",
            "processing": "Sedang memuat data dari server...",
            "paginate": {
              "first": "Awal",
              "last": "Akhir",
              "next": "›",
              "previous": "‹"
            }
          }
        });

        // Filter ulang (tembak AJAX lagi) saat Dropdown Tipe berubah
        $('#filter-type').on('change', function() {
          table.draw();
        });
      });
    </script>
  @endpush
@endsection
