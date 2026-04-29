@extends('layouts.admin')
@section('content')
  <div class="mb-6">
    <a href="{{ route('admin.users.index') }}" class="text-blue-600">← Kembali</a>
    <h1 class="text-2xl font-bold mt-2">Edit User: {{ $user->name }}</h1>
  </div>
  <div class="bg-white dark:bg-gray-800 rounded-2xl shadow p-6">
    <form action="{{ route('admin.users.update', $user->id_users) }}" method="POST">
      @csrf @method('PUT')
      <div class="grid md:grid-cols-2 gap-6">
        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Lengkap <span
              class="text-red-500 dark:text-red-400">*</span></label>
          <input type="text" name="name" value="{{ old('name', $user->name) }}" required
            class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email <span
              class="text-red-500 dark:text-red-400">*</span></label>
          <input type="email" name="email" value="{{ old('email', $user->email) }}" required
            class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Password (kosongkan jika tidak
            diubah)</label>
          <input type="password" name="password"
            class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Konfirmasi Password</label>
          <input type="password" name="password_confirmation"
            class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Role</label>
          @if (auth()->id() === $user->id_users)
            <input type="hidden" name="role" value="{{ $user->role }}">
            <select
              class="w-full border border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-600 text-gray-700 dark:text-gray-400 rounded-lg px-3 py-2 cursor-not-allowed"
              disabled>
              <option value="owner" selected>Owner (Role Anda Sendiri)</option>
            </select>
            <p class="text-xs text-red-500 dark:text-red-400 mt-1">Anda tidak bisa mengubah role akun sendiri.</p>
          @else
            <select name="role"
              class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
              <option value="user" @selected(old('role', $user->role) == 'user')>User (Customer)</option>
              <option value="admin" @selected(old('role', $user->role) == 'admin')>Admin</option>
              <option value="owner" @selected(old('role', $user->role) == 'owner')>Owner</option>
            </select>
          @endif
        </div>

        <div class="flex items-center mt-6">
          @if (auth()->id() === $user->id_users)
            <input type="hidden" name="is_active" value="1">
            <input type="checkbox" checked disabled
              class="mr-2 w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded cursor-not-allowed dark:bg-gray-700 dark:border-gray-600">
            <label class="text-sm font-medium text-gray-500 dark:text-gray-400">Aktif (Akun Anda sedang digunakan)</label>
          @else
            <input type="hidden" name="is_active" value="0">
            <input type="checkbox" name="is_active" id="is_active" value="1"
              {{ old('is_active', $user->is_active) ? 'checked' : '' }}
              class="mr-2 w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:bg-gray-700 dark:border-gray-600">
            <label for="is_active" class="text-sm font-medium text-gray-700 dark:text-gray-300">Aktif (dapat
              login)</label>
          @endif
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">No. Telepon</label>
          <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
            class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Jenis Kelamin</label>
          <select name="gender"
            class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <option value="">Pilih</option>
            <option value="male" @selected(old('gender', $user->gender) == 'male')>Laki-laki</option>
            <option value="female" @selected(old('gender', $user->gender) == 'female')>Perempuan</option>
          </select>
        </div>

        <div class="md:col-span-2">
          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Alamat</label>
          <textarea name="address" rows="3"
            class="w-full border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('address', $user->address) }}</textarea>
        </div>
      </div>

      <div class="mt-6 flex gap-3">
        <button type="submit"
          class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 transition">Update</button>
        <a href="{{ route('admin.users.index') }}"
          class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800 transition">Batal</a>
      </div>
    </form>
  </div>
@endsection
