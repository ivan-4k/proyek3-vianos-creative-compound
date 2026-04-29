@extends('layouts.admin')
@section('content')
  <x-admin.card title="Sampah User" subtitle="User yang telah dihapus sementara">
    <div class="mb-4">
      <a href="{{ route('admin.users.index') }}" class="text-blue-600">← Kembali ke daftar user</a>
    </div>
    @if ($users->count())
      <div class="overflow-x-auto border rounded-xl">
        <table class="min-w-full text-sm text-left text-gray-500 dark:text-gray-400 datatable">
          <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th class="px-6 py-3">ID</th>
              <th class="px-6 py-3">Nama</th>
              <th class="px-6 py-3">Email</th>
              <th class="px-6 py-3">Role</th>
              <th class="px-6 py-3">Dihapus pada</th>
              <th class="px-6 py-3">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            @foreach ($users as $user)
              <tr class="bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                  {{ $user->id_users }}
                </td>
                <td class="px-6 py-4 text-gray-900 dark:text-white">
                  {{ $user->name }}
                </td>
                <td class="px-6 py-4">
                  {{ $user->email }}
                </td>
                <td class="px-6 py-4">
                  <span
                    class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                    {{ ucfirst($user->role) }}
                  </span>
                </td>
                <td class="px-6 py-4">
                  {{ $user->deleted_at->format('d/m/Y H:i') }}
                </td>
                <td class="px-6 py-4">
                  <form action="{{ route('admin.users.restore', $user->id_users) }}" method="POST" class="inline">
                    @csrf
                    <button
                      class="font-medium text-green-600 dark:text-green-400 hover:text-green-800 dark:hover:text-green-300 hover:underline transition-colors">
                      Pulihkan
                    </button>
                  </form>
                  <form action="{{ route('admin.users.forceDelete', $user->id_users) }}" method="POST"
                    class="inline ml-3" onsubmit="return confirm('Hapus permanen user ini?')">
                    @csrf @method('DELETE')
                    <button
                      class="font-medium text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-300 hover:underline transition-colors">
                      Hapus Permanen
                    </button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @else
      <p class="text-center py-8 text-gray-500">Tidak ada user di sampah.</p>
    @endif
  </x-admin.card>
@endsection
