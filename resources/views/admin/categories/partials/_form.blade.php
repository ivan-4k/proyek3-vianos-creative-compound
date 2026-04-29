@php
  $isEdit = isset($category) && $category->exists;
@endphp

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
  {{-- Kolom Kiri --}}
  <div class="space-y-6">
    <div>
      <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Kategori <span
          class="text-red-500">*</span></label>
      <input type="text" name="name" id="name" value="{{ old('name', $isEdit ? $category->name : '') }}"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
        required>
      @error('name')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
      @enderror
    </div>

    <div>
      <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi <span
          class="text-red-500">*</span></label>
      <textarea name="description" id="description" rows="4"
        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-xl border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
        {{ $isEdit ? '' : 'required' }}>{{ old('description', $isEdit ? $category->description : '') }}</textarea>
      @error('description')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
      @enderror
    </div>
  </div>

  {{-- Kolom Kanan --}}
  <div class="space-y-6">
    <div>
      <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gambar Kategori <span
          class="text-red-500" {{ $isEdit ? 'style=display:none' : '' }}>*</span></label>
      <div class="flex items-center justify-center w-full">
        <label for="image"
          class="flex flex-col items-center justify-center w-full h-48 border-2 border-gray-300 border-dashed rounded-xl cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600 transition-colors overflow-hidden relative">
          <div class="flex flex-col items-center justify-center pt-5 pb-6 text-center" id="upload-placeholder"
            {{ $isEdit && $category->image ? 'style="display: none;"' : '' }}>
            <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
              viewBox="0 0 20 16">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
            </svg>
            <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Klik untuk
                upload</span></p>
            <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, JPEG (Maks. 1MB)</p>
          </div>
          <img id="image-preview"
            class="absolute inset-0 w-full h-full object-cover {{ $isEdit && $category->image ? '' : 'hidden' }}"
            src="{{ $isEdit && $category->image ? Storage::url($category->image) : '' }}" />
          <input id="image" name="image" type="file" class="hidden" accept="image/*"
            onchange="previewImage(event)" {{ $isEdit ? '' : 'required' }} />
        </label>
      </div>
      @if ($isEdit && $category->image)
        <div class="mt-2 flex items-center gap-2">
          <input type="checkbox" name="remove_image" id="remove_image" value="1"
            class="rounded border-gray-300 text-red-600 focus:ring-red-500">
          <label for="remove_image" class="text-sm text-red-600 dark:text-red-400">Hapus gambar saat ini</label>
        </div>
      @endif
      @error('image')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
      @enderror
    </div>

    {{-- Status Aktif --}}
    <div class="p-4 bg-gray-50 dark:bg-gray-700/50 rounded-xl border border-gray-100 dark:border-gray-600">
      <label class="relative flex items-center cursor-pointer">
        <input type="checkbox" name="is_active" value="1" class="sr-only peer"
          {{ old('is_active', $isEdit ? $category->is_active : true) ? 'checked' : '' }}>
        <div
          class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 dark:peer-focus:ring-green-800 rounded-full peer dark:bg-gray-600 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600">
        </div>
        <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">Aktif (ditampilkan di website)</span>
      </label>
    </div>
  </div>
</div>

@push('scripts')
  <script>
    function previewImage(event) {
      const input = event.target;
      const preview = document.getElementById('image-preview');
      const placeholder = document.getElementById('upload-placeholder');
      const removeCheckbox = document.getElementById('remove_image');

      if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
          preview.src = e.target.result;
          preview.classList.remove('hidden');
          placeholder.style.display = 'none';
          if (removeCheckbox) removeCheckbox.checked = false;
        }
        reader.readAsDataURL(input.files[0]);
      } else {
        const oldImage = "{{ $isEdit && $category->image ? Storage::url($category->image) : '' }}";
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
    }

    const removeImageCheckbox = document.getElementById('remove_image');
    if (removeImageCheckbox) {
      removeImageCheckbox.addEventListener('change', function() {
        const preview = document.getElementById('image-preview');
        const placeholder = document.getElementById('upload-placeholder');
        const fileInput = document.getElementById('image');

        if (this.checked) {
          preview.src = '';
          preview.classList.add('hidden');
          placeholder.style.display = 'flex';
          fileInput.value = '';
        } else {
          const oldImage = "{{ $isEdit && $category->image ? Storage::url($category->image) : '' }}";
          if (oldImage) {
            preview.src = oldImage;
            preview.classList.remove('hidden');
            placeholder.style.display = 'none';
          } else {
            preview.classList.add('hidden');
            placeholder.style.display = 'flex';
          }
        }
      });
    }
  </script>
@endpush
