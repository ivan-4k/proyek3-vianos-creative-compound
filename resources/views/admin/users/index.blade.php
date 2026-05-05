@extends('layouts.admin')

@section('content')
  <x-admin.card title="Manajemen User" subtitle="Kelola admin, owner, dan pelanggan">
    @if (auth()->user()->role === 'owner')
      <div class="mb-6 flex flex-wrap justify-between items-center gap-4">
        <a href="{{ route('admin.users.create') }}"
          class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors shadow-sm font-medium text-sm">
          + Tambah User
        </a>
        <a href="{{ route('admin.users.trash') }}" class="text-gray-600 hover:text-red-600 dark:text-gray-400 dark:hover:text-red-500 font-medium text-sm transition-colors">
          🗑 Sampah
        </a>
      </div>
    @else
      <div class="mb-6 text-sm text-gray-500 dark:text-gray-400 italic">Mode baca: Anda tidak dapat mengubah data user.</div>
    @endif

    <div class="overflow-x-auto bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow-sm">
      <table class="min-w-full text-sm datatable">
        <thead class="bg-gray-50 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-xs uppercase tracking-wider">
          <tr>
            <th class="px-6 py-4 font-semibold text-left">ID</th>
            <th class="px-6 py-4 font-semibold text-left">Avatar</th>
            <th class="px-6 py-4 font-semibold text-left">Nama</th>
            <th class="px-6 py-4 font-semibold text-left">Email</th>
            <th class="px-6 py-4 font-semibold text-left">Role</th>
            <th class="px-6 py-4 font-semibold text-left">Status</th>
            <th class="px-6 py-4 font-semibold text-left">Terakhir Login</th>
            <th class="px-6 py-4 font-semibold text-right">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-transparent">
          @forelse($users as $user)
            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-200">
              <td class="px-6 py-4 text-gray-900 dark:text-gray-300 font-medium">{{ $user->id_users }}</td>
              
              <td class="px-6 py-4">
                @if ($user->avatar)
                  <img src="{{ Storage::url($user->avatar) }}" class="w-8 h-8 rounded-full object-cover border border-gray-200 dark:border-gray-600">
                @else
                  <div class="w-8 h-8 rounded-full bg-gray-100 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 flex items-center justify-center text-gray-500 dark:text-gray-400 font-medium text-xs">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                  </div>
                @endif
              </td>
              
              <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">{{ $user->name }}</td>
              
              <td class="px-6 py-4 text-gray-600 dark:text-gray-300">{{ $user->email }}</td>
              
              <td class="px-6 py-4">
                <span class="inline-flex items-center px-2.5 py-1 text-xs font-semibold rounded-full border
                    @if ($user->role == 'admin') bg-purple-50 text-purple-700 border-purple-200 dark:bg-purple-900/30 dark:text-purple-400 dark:border-purple-800
                    @elseif($user->role == 'owner') bg-amber-50 text-amber-700 border-amber-200 dark:bg-amber-900/30 dark:text-amber-400 dark:border-amber-800
                    @else bg-blue-50 text-blue-700 border-blue-200 dark:bg-blue-900/30 dark:text-blue-400 dark:border-blue-800 @endif">
                  {{ ucfirst($user->role) }}
                </span>
              </td>
              
              <td class="px-6 py-4">
                @if (auth()->user()->role === 'owner')
                  @if (auth()->id() === $user->id_users)
                    <span class="inline-flex items-center px-2.5 py-1 text-xs font-semibold rounded-full border bg-green-50 text-green-700 border-green-200 dark:bg-green-900/30 dark:text-green-400 dark:border-green-800">
                      Aktif (Anda)
                    </span>
                  @else
                    <button type="button" class="toggle-status focus:outline-none" data-id="{{ $user->id_users }}">
                      <span class="inline-flex items-center px-2.5 py-1 text-xs font-semibold rounded-full border cursor-pointer transition-colors duration-200
                        {{ $user->is_active ? 'bg-green-50 text-green-700 border-green-200 dark:bg-green-900/30 dark:text-green-400 dark:border-green-800' : 'bg-red-50 text-red-700 border-red-200 dark:bg-red-900/30 dark:text-red-400 dark:border-red-800' }}">
                        {{ $user->is_active ? 'Aktif' : 'Nonaktif' }}
                      </span>
                    </button>
                  @endif
                @else
                  <span class="inline-flex items-center px-2.5 py-1 text-xs font-semibold rounded-full border 
                    {{ $user->is_active ? 'bg-green-50 text-green-700 border-green-200 dark:bg-green-900/30 dark:text-green-400 dark:border-green-800' : 'bg-red-50 text-red-700 border-red-200 dark:bg-red-900/30 dark:text-red-400 dark:border-red-800' }}">
                    {{ $user->is_active ? 'Aktif' : 'Nonaktif' }}
                  </span>
                @endif
              </td>
              
              <td class="px-6 py-4 text-xs text-gray-500 dark:text-gray-400">
                {{ $user->last_login_at ? \Carbon\Carbon::parse($user->last_login_at)->diffForHumans() : 'Belum pernah login' }}
              </td>
              
              <td class="px-6 py-4">
                <div class="flex justify-end items-center gap-3">
                  @if (auth()->user()->role === 'owner')
                    @if (auth()->id() === $user->id_users)
                      <span class="text-gray-400 dark:text-gray-500 italic text-xs">Tidak ada aksi</span>
                    @else
                      {{-- Ikon Edit --}}
                      <a href="{{ route('admin.users.edit', $user->id_users) }}"
                        class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 transition-colors"
                        title="Edit User">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                      </a>

                      {{-- Ikon Reset Password --}}
                      <button type="button" 
                        class="text-orange-500 hover:text-orange-700 dark:text-orange-400 dark:hover:text-orange-300 transition-colors reset-password" 
                        data-id="{{ $user->id_users }}" 
                        data-name="{{ $user->name }}"
                        title="Reset Password">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1-.43-1.563A6 6 0 1121.75 8.25z" />
                        </svg>
                      </button>

                      {{-- Ikon Hapus --}}
                      <form action="{{ route('admin.users.destroy', $user->id_users) }}" method="POST" class="inline"
                        onsubmit="return confirm('Pindahkan user ini ke sampah?')">
                        @csrf @method('DELETE')
                        <button type="submit" 
                          class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 transition-colors"
                          title="Hapus User">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                          </svg>
                        </button>
                      </form>
                    @endif
                  @else
                    <span class="text-gray-400 dark:text-gray-600">-</span>
                  @endif
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="8" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                Tidak ada user ditemukan.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

  </x-admin.card>

  @push('scripts')
    @if (auth()->user()->role === 'owner')
      <script>
        document.querySelectorAll('.toggle-status').forEach(btn => {
          btn.addEventListener('click', function() {
            let id = this.dataset.id;
            let span = this.querySelector('span');
            fetch(`/admin/users/${id}/toggle-status`, {
                method: 'POST',
                headers: {
                  'X-CSRF-TOKEN': '{{ csrf_token() }}',
                  'Content-Type': 'application/json',
                  'Accept': 'application/json'
                },
                body: JSON.stringify({})
              })
              .then(res => res.json())
              .then(data => {
                if (data.success) {
                  let newText = data.is_active ? 'Aktif' : 'Nonaktif';
                  span.textContent = newText;

                  // Hapus SEMUA class warna (Light & Dark mode)
                  span.classList.remove(
                      'bg-green-50', 'text-green-700', 'border-green-200', 'dark:bg-green-900/30', 'dark:text-green-400', 'dark:border-green-800',
                      'bg-red-50', 'text-red-700', 'border-red-200', 'dark:bg-red-900/30', 'dark:text-red-400', 'dark:border-red-800'
                  );

                  // Tambahkan set class yang baru
                  if (data.is_active) {
                    span.classList.add('bg-green-50', 'text-green-700', 'border-green-200', 'dark:bg-green-900/30', 'dark:text-green-400', 'dark:border-green-800');
                  } else {
                    span.classList.add('bg-red-50', 'text-red-700', 'border-red-200', 'dark:bg-red-900/30', 'dark:text-red-400', 'dark:border-red-800');
                  }
                } else {
                  showToast(data.message, 'error');
                }
              })
              .catch(err => {
                console.error(err);
                showToast('Gagal mengubah status', 'error');
              });
          });
        });

        document.querySelectorAll('.reset-password').forEach(btn => {
          btn.addEventListener('click', function() {
            let id = this.dataset.id;
            let name = this.dataset.name;
            if (confirm(`Reset password untuk user "${name}"? Password baru akan ditampilkan.`)) {
              fetch(`/admin/users/${id}/reset-password`, {
                  method: 'POST',
                  headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                  },
                  body: JSON.stringify({})
                })
                .then(res => res.json())
                .then(data => {
                  if (data.success) {
                    showToast('Password baru untuk ' + name + ': ' + data.new_password + ' — Catat dan berikan ke user.', 'info', 10000);
                  } else {
                    showToast('Gagal reset password.', 'error');
                  }
                })
                .catch(() => showToast('Terjadi kesalahan.', 'error'));
            }
          });
        });
      </script>
    @endif
  @endpush
@endsection