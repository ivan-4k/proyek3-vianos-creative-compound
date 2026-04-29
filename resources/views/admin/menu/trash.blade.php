@extends('layouts.admin')

@section('content')
  <x-admin.card title="Sampah Menu" subtitle="Menu yang telah dihapus sementara">

    @if (session('error'))
      <x-admin.alert type="error" :message="session('error')" />
    @endif
    @if (session('success'))
      <x-admin.alert type="success" :message="session('success')" />
    @endif
    @if (session('warning'))
      <x-admin.alert type="warning" :message="session('warning')" />
    @endif

    {{-- Header dengan tombol kembali --}}
    <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
      <a href="{{ route('admin.menu.index') }}"
        class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-700 dark:text-blue-500 dark:hover:text-blue-400">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
        Kembali ke Daftar Menu
      </a>
    </div>

    @if ($menus->count())
      {{-- Bulk actions bar --}}
      <div class="mb-4 flex flex-wrap items-center gap-4">
        <label class="flex items-center gap-2 text-sm text-gray-700 dark:text-gray-300 cursor-pointer">
          <input type="checkbox" id="select-all"
            class="rounded border-gray-300 text-blue-600 focus:ring-blue-500 cursor-pointer">
          <span>Pilih Semua</span>
        </label>

        {{-- Container tombol massal --}}
        <div id="bulk-action-container" class="hidden items-center gap-2">
          <button id="bulk-restore-btn"
            class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-4 focus:ring-green-300 transition-all">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
            </svg>
            Pulihkan (<span class="selected-count">0</span>)
          </button>
          <button id="bulk-force-delete-btn"
            class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:ring-red-300 transition-all">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
            Hapus Permanen (<span class="selected-count">0</span>)
          </button>
        </div>
      </div>

      {{-- Tabel data --}}
      <div class="relative overflow-x-auto border border-gray-100 dark:border-gray-700 rounded-xl">
        <table id="tabel-sampah-menu" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50/50 dark:bg-gray-700/50 dark:text-gray-400">
            <tr>
              <th scope="col" class="px-6 py-4 w-10">#</th>
              <th scope="col" class="px-6 py-4 font-semibold">Gambar</th>
              <th scope="col" class="px-6 py-4 font-semibold">Nama</th>
              <th scope="col" class="px-6 py-4 font-semibold">Kategori</th>
              <th scope="col" class="px-6 py-4 font-semibold">Harga</th>
              <th scope="col" class="px-6 py-4 font-semibold text-center">Stok</th>
              <th scope="col" class="px-6 py-4 font-semibold text-right">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
            @foreach ($menus as $menu)
              <tr class="bg-white dark:bg-gray-800 hover:bg-blue-50/30 dark:hover:bg-blue-900/10 transition-colors">
                {{-- Checkbox --}}
                <td class="px-6 py-4">
                  <input type="checkbox"
                    class="menu-checkbox rounded border-gray-300 dark:border-gray-600 dark:bg-gray-800 text-blue-600 focus:ring-blue-500 cursor-pointer"
                    value="{{ $menu->id_produk }}">
                </td>
                {{-- Gambar --}}
                <td class="px-6 py-4">
                  @if ($menu->main_image)
                    <img src="{{ Storage::url($menu->main_image) }}" alt="{{ $menu->name }}"
                      class="w-12 h-12 rounded-lg object-cover" loading="lazy">
                  @else
                    <div class="w-12 h-12 rounded-lg bg-gray-100 dark:bg-gray-700 flex items-center justify-center">
                      <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                      </svg>
                    </div>
                  @endif
                </td>
                {{-- Nama --}}
                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                  {{ $menu->name }}
                </td>
                {{-- Kategori --}}
                <td class="px-6 py-4">
                  <span
                    class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                    {{ $menu->category->name ?? 'Tanpa Kategori' }}
                  </span>
                </td>
                {{-- Harga --}}
                <td class="px-6 py-4 font-medium text-gray-900 dark:text-gray-200">
                  Rp {{ number_format($menu->price, 0, ',', '.') }}
                </td>
                {{-- Stok --}}
                <td class="px-6 py-4 text-center">
                  @if ($menu->stock > 0)
                    <span
                      class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                      {{ $menu->stock }}
                    </span>
                  @else
                    <span
                      class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300">
                      Habis
                    </span>
                  @endif
                </td>
                {{-- Aksi --}}
                <td class="px-6 py-4 text-right">
                  <div class="flex justify-end gap-2">
                    <form action="{{ route('admin.menu.restore', $menu->id_produk) }}" method="POST"
                      class="inline restore-form">
                      @csrf
                      <button type="submit"
                        class="text-green-600 hover:text-green-800 font-medium text-sm inline-flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Pulihkan
                      </button>
                    </form>
                    <form action="{{ route('admin.menu.forceDelete', $menu->id_produk) }}" method="POST"
                      class="inline force-delete-form">
                      @csrf
                      @method('DELETE')
                      <button type="submit"
                        class="text-red-600 hover:text-red-800 font-medium text-sm inline-flex items-center gap-1"
                        onclick="return confirm('Hapus permanen menu {{ $menu->name }}? Data tidak dapat dikembalikan.')">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Hapus Permanen
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @else
      {{-- Empty state --}}
      <div
        class="text-center py-12 bg-gray-50/50 dark:bg-gray-800/50 rounded-2xl border-2 border-dashed border-gray-200 dark:border-gray-700">
        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 012-2h2a2 2 0 012 2" />
        </svg>
        <p class="mt-4 text-gray-500 dark:text-gray-400 font-medium">Tidak ada menu di sampah.</p>
        <a href="{{ route('admin.menu.index') }}"
          class="mt-2 inline-block text-blue-600 hover:text-blue-700 font-semibold underline">
          Kembali ke daftar menu
        </a>
      </div>
    @endif
  </x-admin.card>

  @push('scripts')
    <script>
      // 1. Toast notification
      let toastTimeout = null;

      function showToast(message, type = 'success') {
        const existingToast = document.querySelector('.custom-toast');
        if (existingToast) existingToast.remove();
        if (toastTimeout) clearTimeout(toastTimeout);

        const toast = document.createElement('div');
        toast.className = `custom-toast fixed bottom-4 right-4 px-4 py-2 rounded-lg text-white z-50 transition-opacity duration-300 shadow-lg ${
          type === 'success' ? 'bg-green-500' : 'bg-red-500'
        }`;
        toast.textContent = message;
        document.body.appendChild(toast);

        toastTimeout = setTimeout(() => {
          toast.style.opacity = '0';
          setTimeout(() => toast.remove(), 300);
        }, 3000);
      }

      $(document).ready(function() {
        // 2. Inisialisasi DataTables
        var table = $('#tabel-sampah-menu').DataTable({
          "destroy": true,
          "ordering": true,
          "columnDefs": [{
              "orderable": false,
              "targets": [0, 1, 6]
            }
          ],
          "language": {
            "search": "Cari Sampah:",
            "lengthMenu": "Tampilkan _MENU_ data",
            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            "infoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
            "infoFiltered": "(difilter dari _MAX_ total data)",
            "zeroRecords": "Tidak ada data yang cocok",
            "paginate": {
              "first": "Pertama",
              "last": "Terakhir",
              "next": "Selanjutnya",
              "previous": "Sebelumnya"
            }
          }
        });

        // 3. Logic Checkbox & Toggle Tombol Massal
        const selectAllCheckbox = document.getElementById('select-all');
        const bulkActionContainer = document.getElementById('bulk-action-container');
        const countSpans = document.querySelectorAll('.selected-count');

        function toggleBulkButtons() {
          var selectedCount = table.$('input[type="checkbox"].menu-checkbox:checked').length;

          countSpans.forEach(span => span.innerText = selectedCount);

          if (selectedCount > 0) {
            bulkActionContainer.classList.remove('hidden');
            bulkActionContainer.classList.add('flex');
          } else {
            bulkActionContainer.classList.add('hidden');
            bulkActionContainer.classList.remove('flex');
            if (selectAllCheckbox) selectAllCheckbox.checked = false;
          }
        }

        if (selectAllCheckbox) {
          selectAllCheckbox.addEventListener('change', function() {
            var rows = table.rows({
              'search': 'applied'
            }).nodes();
            $('input[type="checkbox"].menu-checkbox', rows).prop('checked', this.checked);
            toggleBulkButtons();
          });
        }

        $('#tabel-sampah-menu tbody').on('change', 'input[type="checkbox"].menu-checkbox', function() {
          toggleBulkButtons();
        });

        // 4. Aksi Bulk Restore
        const bulkRestoreBtn = document.getElementById('bulk-restore-btn');
        if (bulkRestoreBtn) {
          bulkRestoreBtn.addEventListener('click', function() {
            var selectedIds = [];
            table.$('input[type="checkbox"].menu-checkbox:checked').each(function() {
              selectedIds.push($(this).val());
            });

            if (!confirm(`Pulihkan ${selectedIds.length} menu yang dipilih?`)) return;

            const originalText = this.innerHTML;
            this.innerHTML =
              '<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> Memproses...';
            this.disabled = true;

            fetch('{{ route('admin.menu.bulkRestore') }}', {
                method: 'POST',
                headers: {
                  'X-CSRF-TOKEN': '{{ csrf_token() }}',
                  'Content-Type': 'application/json',
                  'Accept': 'application/json'
                },
                body: JSON.stringify({
                  ids: selectedIds
                })
              })
              .then(async response => {
                const data = await response.json();
                if (!response.ok) throw new Error(data.message || 'Gagal memulihkan');
                showToast(data.message, 'success');
                setTimeout(() => location.reload(), 1500);
              })
              .catch(error => {
                showToast('Error: ' + error.message, 'error');
                this.innerHTML = originalText;
                this.disabled = false;
              });
          });
        }

        // 5. Aksi Bulk Force Delete
        const bulkForceDeleteBtn = document.getElementById('bulk-force-delete-btn');
        if (bulkForceDeleteBtn) {
          bulkForceDeleteBtn.addEventListener('click', function() {
            var selectedIds = [];
            table.$('input[type="checkbox"].menu-checkbox:checked').each(function() {
              selectedIds.push($(this).val());
            });

            if (!confirm(`Hapus PERMANEN ${selectedIds.length} menu? Data ini tidak dapat dikembalikan lagi.`))
              return;

            const originalText = this.innerHTML;
            this.innerHTML =
              '<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> Memproses...';
            this.disabled = true;

            fetch('{{ route('admin.menu.bulkForceDelete') }}', {
                method: 'DELETE',
                headers: {
                  'X-CSRF-TOKEN': '{{ csrf_token() }}',
                  'Content-Type': 'application/json',
                  'Accept': 'application/json'
                },
                body: JSON.stringify({
                  ids: selectedIds
                })
              })
              .then(async response => {
                const data = await response.json();
                if (!response.ok) throw new Error(data.message || 'Gagal menghapus');
                showToast(data.message, 'success');
                setTimeout(() => location.reload(),
                2000); // Tunggu agak lama sedikit agar toast terbaca jika ada error relasi
              })
              .catch(error => {
                showToast('Error: ' + error.message, 'error');
                this.innerHTML = originalText;
                this.disabled = false;
              });
          });
        }
      });

      // 6. Loading state untuk form submit satuan
      document.querySelectorAll('.restore-form, .force-delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
          const btn = this.querySelector('button[type="submit"]');
          if (btn && btn.disabled) {
            e.preventDefault();
            return false;
          }
          if (btn) {
            btn.disabled = true;
            btn.innerHTML =
              '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>...';
          }
        });
      });
    </script>
  @endpush
@endsection
