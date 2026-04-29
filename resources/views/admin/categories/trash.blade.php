@extends('layouts.admin')

@section('content')
  <x-admin.card title="Sampah Kategori" subtitle="Kategori yang telah dihapus sementara">
    {{-- Header & Search --}}
    <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
      <a href="{{ route('admin.categories.index') }}"
        class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-700 dark:text-blue-500 dark:hover:text-blue-400">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
        Kembali ke Daftar Kategori
      </a>

    </div>

    {{-- Alert messages --}}
    @if (session('error'))
      <x-admin.alert type="error" :message="session('error')" />
    @endif
    @if (session('success'))
      <x-admin.alert type="success" :message="session('success')" />
    @endif

    @if ($categories->count())
      {{-- Bulk actions bar --}}
      <div class="mb-4 flex flex-wrap items-center justify-between gap-3">
        <div class="flex items-center gap-3">
          <label class="flex items-center gap-2 text-sm text-gray-700 dark:text-gray-300">
            <input type="checkbox" id="select-all" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
            <span>Pilih Semua</span>
          </label>
          <button id="bulk-restore-btn"
            class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-4 focus:ring-green-300 transition-all">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
            </svg>
            Pulihkan Terpilih
          </button>
          <button id="bulk-force-delete-btn"
            class="inline-flex items-center px-3 py-1.5 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:ring-red-300 transition-all">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
            Hapus Permanen Terpilih
          </button>
        </div>
      </div>

      {{-- Table --}}
      <div class="relative overflow-x-auto border border-gray-100 dark:border-gray-700 rounded-xl">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 datatable">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50/50 dark:bg-gray-700/50 dark:text-gray-400">
            <tr>
              <th scope="col" class="px-6 py-4 w-10">#</th>
              <th scope="col" class="px-6 py-4">Gambar</th>
              <th scope="col" class="px-6 py-4">Nama Kategori</th>
              <th scope="col" class="px-6 py-4 hidden md:table-cell">Slug</th>
              <th scope="col" class="px-6 py-4 text-center w-28">Jumlah Produk</th>
              <th scope="col" class="px-6 py-4 text-right">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
            @foreach ($categories as $cat)
              <tr class="bg-white dark:bg-gray-800 hover:bg-blue-50/30 dark:hover:bg-blue-900/10 transition-colors">
                <td class="px-6 py-4">
                  <input type="checkbox"
                    class="category-checkbox rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                    value="{{ $cat->id_kategori }}">
                </td>
                <td class="px-6 py-4">
                  @if ($cat->image)
                    <img src="{{ Storage::url($cat->image) }}" alt="{{ $cat->name }}"
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
                <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
                  {{ $cat->name }}
                </td>
                <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400 hidden md:table-cell">
                  {{ $cat->slug }}
                </td>
                <td class="px-6 py-4 text-center">
                  <span
                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">
                    {{ $cat->products()->withTrashed()->count() }}
                  </span>
                </td>
                <td class="px-6 py-4 text-right">
                  <div class="flex justify-end gap-3">
                    <form action="{{ route('admin.categories.restore', $cat->id_kategori) }}" method="POST"
                      class="inline restore-form">
                      @csrf
                      <button type="submit"
                        class="text-green-600 hover:text-green-800 font-medium inline-flex items-center gap-1"
                        title="Pulihkan">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Pulihkan
                      </button>
                    </form>
                    <form action="{{ route('admin.categories.forceDelete', $cat->id_kategori) }}" method="POST"
                      class="inline force-delete-form">
                      @csrf
                      @method('DELETE')
                      <button type="submit"
                        class="text-red-600 hover:text-red-800 font-medium inline-flex items-center gap-1"
                        title="Hapus permanen"
                        onclick="return confirm('Hapus permanen kategori \'{{ $cat->name }}\'? Semua produk akan kehilangan kategori ini, tetapi produk tetap ada (kategori menjadi tidak terisi).')">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
      <div
        class="text-center py-12 bg-gray-50/50 dark:bg-gray-800/50 rounded-2xl border-2 border-dashed border-gray-200 dark:border-gray-700">
        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
        </svg>
        <p class="mt-4 text-gray-500 dark:text-gray-400 font-medium">Tidak ada kategori di sampah.</p>
        <a href="{{ route('admin.categories.index') }}"
          class="mt-2 inline-block text-blue-600 hover:text-blue-700 font-semibold underline">
          Kembali ke daftar kategori
        </a>
      </div>
    @endif
  </x-admin.card>

  @push('scripts')
    <script>
      // Select All checkbox
      const selectAll = document.getElementById('select-all');
      const checkboxes = document.querySelectorAll('.category-checkbox');
      if (selectAll) {
        selectAll.addEventListener('change', function() {
          checkboxes.forEach(cb => cb.checked = this.checked);
        });
      }

      // Bulk Restore
      const bulkRestoreBtn = document.getElementById('bulk-restore-btn');
      if (bulkRestoreBtn) {
        bulkRestoreBtn.addEventListener('click', function() {
          const selectedIds = Array.from(document.querySelectorAll('.category-checkbox:checked')).map(cb => cb.value);
          if (selectedIds.length === 0) {
            alert('Pilih kategori yang akan dipulihkan.');
            return;
          }
          if (!confirm(`Pulihkan ${selectedIds.length} kategori?`)) return;

          fetch('{{ route('admin.categories.bulkRestore') }}', {
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
            .then(response => response.json())
            .then(data => {
              if (data.success) location.reload();
              else alert('Gagal: ' + data.message);
            })
            .catch(() => alert('Terjadi kesalahan.'));
        });
      }

      // Bulk Force Delete
      const bulkForceDeleteBtn = document.getElementById('bulk-force-delete-btn');
      if (bulkForceDeleteBtn) {
        bulkForceDeleteBtn.addEventListener('click', function() {
          const selectedIds = Array.from(document.querySelectorAll('.category-checkbox:checked')).map(cb => cb.value);
          if (selectedIds.length === 0) {
            alert('Pilih kategori yang akan dihapus permanen.');
            return;
          }
          if (!confirm(`Hapus permanen ${selectedIds.length} kategori? Tindakan ini tidak dapat dibatalkan.`)) return;

          fetch('{{ route('admin.categories.bulkForceDelete') }}', {
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
            .then(response => response.json())
            .then(data => {
              if (data.success) location.reload();
              else alert('Gagal: ' + data.message);
            })
            .catch(() => alert('Terjadi kesalahan.'));
        });
      }

      // Prevent double submit pada single restore/force delete
      document.querySelectorAll('.restore-form, .force-delete-form').forEach(form => {
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
