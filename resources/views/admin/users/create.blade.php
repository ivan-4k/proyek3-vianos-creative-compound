@extends('layouts.admin')

@section('content')
  <div class="mb-6">
    <a href="{{ route('admin.users.index') }}" class="text-blue-600">← Kembali</a>
    <h1 class="text-2xl font-bold mt-2">Tambah User Baru</h1>
  </div>

  <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-6">
    {{-- Menampilkan pesan error umum jika ada --}}
    @if ($errors->any())
      <div class="mb-6 p-4 bg-red-100 border-l-4 border-red-500 text-red-700">
        <p class="font-bold">Terjadi kesalahan!</p>
        <ul class="list-disc list-inside text-sm">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('admin.users.store') }}" method="POST">
      @csrf
      <div class="grid md:grid-cols-2 gap-6">
        <div>
          <div class="space-y-2">
            <label class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase">Nama Lengkap</label>
            <input type="text" name="name" value="{{ old('name', $user->name ?? '') }}"
              class="w-full bg-gray-50 dark:bg-gray-700/50 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-blue-500 dark:text-white transition-all">
          </div>
          @error('name')
            <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email <span
              class="text-red-500 dark:text-red-400">*</span></label>
          <input type="email" name="email" value="{{ old('email') }}" required
            class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 dark:border-red-500 @enderror">
          @error('email')
            <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Password <span
              class="text-red-500 dark:text-red-400">*</span></label>
          <input type="password" name="password" required
            class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') border-red-500 dark:border-red-500 @enderror">
          @error('password')
            <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Konfirmasi Password <span
              class="text-red-500 dark:text-red-400">*</span></label>
          <input type="password" name="password_confirmation" required
            class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Role</label>
          <select name="role"
            class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="user" @selected(old('role') == 'user')>User (Customer)</option>
            <option value="admin" @selected(old('role') == 'admin')>Admin</option>
            <option value="owner" @selected(old('role') == 'owner')>Owner</option>
          </select>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">No. Telepon</label>
          <input type="text" name="phone" value="{{ old('phone') }}"
            class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('phone') border-red-500 dark:border-red-500 @enderror">
          @error('phone')
            <p class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Jenis Kelamin</label>
          <select name="gender"
            class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="">Pilih</option>
            <option value="male" @selected(old('gender') == 'male')>Laki-laki</option>
            <option value="female" @selected(old('gender') == 'female')>Perempuan</option>
          </select>
        </div>

        <div class="flex items-center mt-6">
          <input type="hidden" name="is_active" value="0"> {{-- Fallback jika tidak dicentang --}}
          <input type="checkbox" name="is_active" id="is_active" value="1"
            {{ old('is_active', '1') == '1' ? 'checked' : '' }}
            class="mr-2 w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600">
          <label for="is_active" class="text-sm font-medium text-gray-700 dark:text-gray-300">Aktif (dapat login
            langsung)</label>
        </div>

        <div class="md:col-span-2">
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Alamat</label>
          <textarea name="address" rows="3"
            class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('address') }}</textarea>
        </div>
      </div>

      <div class="mt-6 flex gap-3">
        <button type="submit"
          class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 transition">Simpan</button>
        <a href="{{ route('admin.users.index') }}"
          class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800 transition">Batal</a>
      </div>
    </form>
  </div>
@endsection
