@extends('layouts.admin')

@section('content')
  <x-admin.card title="Manajemen Kategori" subtitle="Kelola kategori menu">
    <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
      <a href="{{ route('admin.categories.create') }}"
        class="inline-flex items-center px-4 py-2.5 text-sm font-medium bg-blue-600 text-white rounded-xl hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 transition-all shadow-lg shadow-blue-500/25">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        Tambah Kategori
      </a>
      <button type="button" id="btn-bulk-delete"
        class="hidden items-center px-4 py-2.5 text-sm font-medium bg-red-50 text-red-600 rounded-xl border border-red-200 hover:bg-red-600 hover:text-white transition-all">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
        </svg>
        Hapus Terpilih (<span id="selected-count">0</span>)
      </button>

      <a href="{{ route('admin.categories.trash') }}"
        class="inline-flex items-center text-sm text-gray-600 hover:text-red-600 dark:text-gray-400 dark:hover:text-red-400">
        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
        </svg>
        Sampah
      </a>
    </div>
    </div>

    @if ($categories->count())
      <div class="relative overflow-x-auto border border-gray-100 dark:border-gray-700 rounded-xl">
        <table id="tabel-kategori" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50/50 dark:bg-gray-700/50 dark:text-gray-400">
            <tr>
              <th scope="col" class="px-6 py-4 w-16">
                <div class="flex items-center gap-3">
                  <input type="checkbox" id="check-all"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                  <span>Urut</span>
                </div>
              </th>
              <th scope="col" class="px-6 py-4">Gambar</th>
              <th scope="col" class="px-6 py-4">Nama Kategori</th>
              <th scope="col" class="px-6 py-4 hidden md:table-cell">Slug</th>
              <th scope="col" class="px-6 py-4 text-center w-28">Jumlah Produk</th>
              <th scope="col" class="px-6 py-4 text-center w-24">Status</th>
              <th scope="col" class="px-6 py-4 text-right w-32">Aksi</th>
            </tr>
          </thead>
          <tbody id="sortable-list" class="divide-y divide-gray-100 dark:divide-gray-700">
            @foreach ($categories as $category)
              <tr data-id="{{ $category->id_kategori }}"
                class="bg-white dark:bg-gray-800 hover:bg-blue-50/30 dark:hover:bg-blue-900/10 transition-colors">
                {{-- Drag handle --}}
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center gap-3">
                    <input type="checkbox"
                      class="row-checkbox w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500"
                      value="{{ $category->id_kategori }}">
                    <span class="drag-handle cursor-move text-gray-400 hover:text-gray-600">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16" />
                      </svg>
                    </span>
                  </div>
                </td>

                {{-- Gambar --}}
                <td class="px-6 py-4">
                  @if ($category->image && Storage::disk('public')->exists($category->image))
                    <img src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}"
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

                {{-- Nama Kategori --}}
                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                  {{ $category->name }}
                </td>

                {{-- Slug (hidden di mobile) --}}
                <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400 hidden md:table-cell">
                  {{ $category->slug }}
                </td>

                {{-- Jumlah Produk --}}
                <td class="px-6 py-4 text-center">
                  <span
                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                    {{ $category->products_count }}
                  </span>
                </td>

                {{-- Status --}}
                <td class="px-6 py-4 text-center">
                  @if ($category->is_active)
                    <span
                      class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300">
                      Aktif
                    </span>
                  @else
                    <span
                      class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300">
                      Nonaktif
                    </span>
                  @endif
                </td>

                {{-- Aksi --}}
                <td class="px-6 py-4">
                  <div class="flex justify-end gap-3">
                    <a href="{{ route('admin.categories.edit', $category->id_kategori) }}"
                      class="inline-flex items-center text-blue-600 hover:text-blue-800 dark:text-blue-400 transition"
                      title="Edit">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                      </svg>
                    </a>
                    <form action="{{ route('admin.categories.destroy', $category->id_kategori) }}" method="POST"
                      class="inline delete-form">
                      @csrf
                      @method('DELETE')
                      <button type="submit"
                        class="inline-flex items-center text-red-600 hover:text-red-800 dark:text-red-400 transition"
                        title="Hapus"
                        onclick="return confirm('Hapus kategori \'{{ $category->name }}\'? Data produk tidak terhapus, kategori akan menjadi tidak terisi.')">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
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
      <div
        class="text-center py-12 bg-gray-50/50 dark:bg-gray-800/50 rounded-2xl border-2 border-dashed border-gray-200 dark:border-gray-700">
        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
        </svg>
        <p class="mt-4 text-gray-500 dark:text-gray-400 font-medium">Belum ada kategori yang terdaftar.</p>
        <a href="{{ route('admin.categories.create') }}"
          class="mt-2 inline-block text-blue-600 hover:text-blue-700 font-semibold underline">Tambah kategori
          sekarang</a>
      </div>
    @endif
  </x-admin.card>

  @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <script>
      $(document).ready(function() {
        // 1. DataTables Config (Tambahkan destroy: true)
        $(document).ready(function() {
          $('#tabel-kategori').DataTable({
            "ordering": false,
            "paging": false,
            "info": true,
            "language": {
              "search": "Cari Kategori:"
            }
          });
        });

        // 2. Logika Checkbox & Bulk Delete UI
        const checkAll = document.getElementById('check-all');
        const rowCheckboxes = document.querySelectorAll('.row-checkbox');
        const btnBulkDelete = document.getElementById('btn-bulk-delete');
        const selectedCount = document.getElementById('selected-count');

        // Fungsi untuk mengupdate tampilan tombol
        function updateBulkDeleteUI() {
          const checkedBoxes = document.querySelectorAll('.row-checkbox:checked');
          selectedCount.innerText = checkedBoxes.length;

          if (checkedBoxes.length > 0) {
            btnBulkDelete.classList.remove('hidden');
            btnBulkDelete.classList.add('inline-flex');
          } else {
            btnBulkDelete.classList.add('hidden');
            btnBulkDelete.classList.remove('inline-flex');
            checkAll.checked = false;
          }
        }

        // Event saat 'Pilih Semua' diklik
        if (checkAll) {
          checkAll.addEventListener('change', function() {
            rowCheckboxes.forEach(cb => cb.checked = this.checked);
            updateBulkDeleteUI();
          });
        }

        // Event saat checkbox individual diklik
        rowCheckboxes.forEach(cb => {
          cb.addEventListener('change', updateBulkDeleteUI);
        });

        // 3. Aksi Eksekusi Bulk Delete
        if (btnBulkDelete) {
          btnBulkDelete.addEventListener('click', function() {
            const checkedBoxes = document.querySelectorAll('.row-checkbox:checked');
            const ids = Array.from(checkedBoxes).map(cb => cb.value);

            if (confirm(`Apakah Anda yakin ingin memindahkan ${ids.length} kategori yang dipilih ke sampah?`)) {

              // Disable tombol saat loading
              const originalText = this.innerHTML;
              this.innerHTML = 'Memproses...';
              this.disabled = true;

              fetch('{{ route('admin.categories.bulkDelete') }}', {
                  method: 'POST',
                  headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                  },
                  body: JSON.stringify({
                    ids: ids
                  })
                })
                .then(response => response.json())
                .then(data => {
                  if (data.success) {
                    // Jika sukses, reload halaman agar tabel terupdate
                    window.location.reload();
                  } else {
                    showToast('Terjadi kesalahan saat menghapus data.', 'error');
                    btnBulkDelete.innerHTML = originalText;
                    btnBulkDelete.disabled = false;
                  }
                })
                .catch(error => {
                  console.error('Error:', error);
                  showToast('Terjadi kesalahan pada jaringan.', 'error');
                  btnBulkDelete.innerHTML = originalText;
                  btnBulkDelete.disabled = false;
                });
            }
          });
        }
      });

      // Drag & Drop reorder
      const sortableList = document.getElementById('sortable-list');
      if (sortableList) {
        new Sortable(sortableList, {
          handle: '.drag-handle',
          animation: 150,
          onEnd: function() {
            let order = [];
            document.querySelectorAll('#sortable-list tr').forEach((row, index) => {
              order.push({
                id: row.dataset.id,
                position: index
              });
            });
            fetch('{{ route('admin.categories.reorder') }}', {
                method: 'POST',
                headers: {
                  'X-CSRF-TOKEN': '{{ csrf_token() }}',
                  'Content-Type': 'application/json',
                  'Accept': 'application/json'
                },
                body: JSON.stringify({
                  order: order
                })
              })
              .then(response => response.json())
              .then(data => {
                if (!data.success) console.error('Reorder failed:', data);
              })
              .catch(error => console.error('Reorder error:', error));
          }
        });
      }

      // Prevent double submit pada form hapus
      document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
          const btn = this.querySelector('button[type="submit"]');
          if (btn && btn.disabled) {
            e.preventDefault();
            return;
          }
          if (btn) btn.disabled = true;
        });
      });
    </script>
  @endpush
@endsection
