@extends('layouts.admin')

@section('content')
  <div class="mb-6">
    <a href="{{ route('admin.menu.index') }}"
      class="flex items-center text-sm font-medium text-blue-600 hover:text-blue-700 dark:text-blue-500 dark:hover:text-blue-400 mb-4">
      <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
      </svg>
      Kembali ke Daftar Menu
    </a>
    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Edit Menu</h1>
    <p class="text-sm text-gray-500 dark:text-gray-400">Ubah informasi menu/produk restoran Anda.</p>
  </div>

  <div class="bg-white rounded-2xl shadow-sm border border-gray-100 dark:bg-gray-800 dark:border-gray-700 p-6">
    <form action="{{ route('admin.menu.update', $menu) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        {{-- Kolom Kiri --}}
        <div class="space-y-6">
          <div>
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Menu <span
                class="text-red-500">*</span></label>
            <input type="text" name="name" id="name" value="{{ old('name', $menu->name) }}"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white"
              required>
            @error('name')
              <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
          </div>

          <div>
            <label for="id_kategori" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori <span
                class="text-red-500">*</span></label>
            <select name="id_kategori" id="id_kategori"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
              required>
              <option value="">-- Pilih Kategori --</option>
              @foreach ($categories as $category)
                <option value="{{ $category->id_kategori }}"
                  {{ old('id_kategori', $menu->id_kategori) == $category->id_kategori ? 'selected' : '' }}>
                  {{ $category->name }}
                </option>
              @endforeach
            </select>
            @error('id_kategori')
              <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
          </div>

          <div>
            <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga (Rp) <span
                class="text-red-500">*</span></label>
            <div class="relative">
              <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400">Rp</span>
              <input type="number" name="price" id="price" value="{{ old('price', $menu->price) }}" min="0"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 pl-8 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                required>
            </div>
            @error('price')
              <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
          </div>

          <div>
            <label for="stock" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stok <span
                class="text-red-500">*</span></label>
            <input type="number" name="stock" id="stock" value="{{ old('stock', $menu->stock) }}" min="0"
              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
              required>
            @error('stock')
              <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
          </div>

          <div>
            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi Menu
              <span class="text-red-500">*</span></label>
            <textarea name="description" id="description" rows="4"
              class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-xl border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
              required>{{ old('description', $menu->description) }}</textarea>
            @error('description')
              <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
          </div>
        </div>

        {{-- Kolom Kanan --}}
        <div class="space-y-6">
          <div>
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Foto Menu <span
                class="text-red-500">*</span></label>
            <div class="flex items-center justify-center w-full">
              <label for="main_image"
                class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-xl cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600 transition-colors overflow-hidden relative">
                <div class="flex flex-col items-center justify-center pt-5 pb-6 text-center" id="upload-placeholder"
                  @if ($menu->main_image) style="display: none;" @endif>
                  <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                  </svg>
                  <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Klik untuk
                      upload</span></p>
                  <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, atau JPEG (Maks. 2MB)</p>
                </div>
                <img id="image-preview"
                  class="absolute inset-0 w-full h-full object-cover @if (!$menu->main_image) hidden @endif"
                  src="{{ $menu->main_image ? Storage::url($menu->main_image) : '' }}" />
                <input id="main_image" name="main_image" type="file" class="hidden" accept="image/*"
                  onchange="previewImage(event)" />
              </label>
            </div>
            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Kosongkan jika tidak ingin mengubah gambar</p>
            @error('main_image')
              <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
          </div>

          <div
            class="p-4 bg-gray-50 dark:bg-gray-700/50 rounded-xl space-y-4 border border-gray-100 dark:border-gray-600">
            <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Pengaturan Visibilitas</h3>

            <label class="relative flex items-center cursor-pointer">
              <input type="checkbox" name="is_signature" value="1" class="sr-only peer"
                {{ old('is_signature', $menu->is_signature) ? 'checked' : '' }}>
              <div
                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-600 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600">
              </div>
              <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Jadikan Menu Signature <span
                  class="text-xs text-blue-600 dark:text-blue-400">(Unggulan)</span></span>
            </label>

            <label class="relative flex items-center cursor-pointer">
              <input type="checkbox" name="is_available" value="1" class="sr-only peer"
                {{ old('is_available', $menu->is_available) ? 'checked' : '' }}>
              <div
                class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 dark:peer-focus:ring-green-800 rounded-full peer dark:bg-gray-600 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600">
              </div>
              <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Tersedia (In Stock)</span>
            </label>
          </div>
        </div>
      </div>

      <div class="flex justify-end gap-3 pt-6 border-t border-gray-100 dark:border-gray-700">
        <a href="{{ route('admin.menu.index') }}"
          class="px-5 py-2.5 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-xl hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
          Batal
        </a>
        <button type="submit"
          class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-xl hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 shadow-lg shadow-blue-500/30 transition-all">
          Simpan Perubahan
        </button>
      </div>
    </form>
  </div>

  @push('scripts')
    <script>
      function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('image-preview');
        const placeholder = document.getElementById('upload-placeholder');

        if (input.files && input.files[0]) {
          const reader = new FileReader();
          reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('hidden');
            placeholder.style.display = 'none';
          }
          reader.readAsDataURL(input.files[0]);
        } else {
          // Jika tidak ada file baru, kembalikan ke gambar lama
          preview.src = "{{ $menu->main_image ? Storage::url($menu->main_image) : '' }}";
          if (!preview.src) {
            preview.classList.add('hidden');
            placeholder.style.display = 'flex';
          } else {
            preview.classList.remove('hidden');
            placeholder.style.display = 'none';
          }
        }
      }

      // Event listener untuk reset jika user menghapus pilihan file
      document.getElementById('main_image').addEventListener('change', function() {
        const preview = document.getElementById('image-preview');
        const placeholder = document.getElementById('upload-placeholder');
        if (!this.files || this.files.length === 0) {
          // Kembalikan ke gambar lama
          const oldImage = "{{ $menu->main_image ? Storage::url($menu->main_image) : '' }}";
          if (oldImage) {
            preview.src = oldImage;
            preview.classList.remove('hidden');
            placeholder.style.display = 'none';
          } else {
            preview.src = '';
            preview.classList.add('hidden');
            placeholder.style.display = 'flex';
          }
        }
      });
    </script>
  @endpush
@endsection
