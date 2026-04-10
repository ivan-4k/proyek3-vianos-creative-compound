<section class="mb-8">
  <header class="mb-6">
    <h2 class="text-xl font-bold text-gray-900 font-primary">
      {{ __('Hapus Akun') }}
    </h2>
    <p class="text-sm text-gray-500 mt-1 font-secondary">
      {{ __('Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Sebelum menghapus akun, pastikan Anda telah mendownload data yang ingin disimpan.') }}
    </p>
  </header>

  @if (auth()->user()->google_id)
    <!-- Button trigger modal untuk Google Users -->
    <button type="button" data-modal-target="deleteAccountModal" data-modal-toggle="deleteAccountModal"
      class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 transition-colors inline-flex items-center gap-2">
      <i class="fas fa-trash-alt"></i>
      {{ __('Hapus Akun') }}
    </button>
  @else
    <!-- Button trigger modal untuk Normal Users -->
    <button type="button" data-modal-target="deleteAccountModal" data-modal-toggle="deleteAccountModal"
      class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 transition-colors inline-flex items-center gap-2">
      <i class="fas fa-trash-alt"></i>
      {{ __('Hapus Akun') }}
    </button>
  @endif

  <!-- Modal -->
  <div id="deleteAccountModal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
      <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">

        @if (auth()->user()->google_id)
          <!-- Modal untuk login lewat Google -->
          <form method="POST" action="{{ route('profile.destroy') }}" id="socialDeleteForm">
            @csrf
            @method('delete')

            <!-- Modal Header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
              <h3 class="text-lg font-semibold text-gray-900 dark:text-white font-primary">
                {{ __('Hapus Akun') }}
              </h3>
              <button type="button"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                data-modal-hide="deleteAccountModal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                  viewBox="0 0 14 14">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
              </button>
            </div>

            <!-- Modal Body -->
            <div class="p-4 md:p-5 space-y-4">
              <!-- Google Alert -->
              <div class="flex p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                role="alert">
                <i class="fab fa-google text-blue-600 text-lg me-3"></i>
                <span class="sr-only">Info</span>
                <div>
                  <span class="font-medium">Akun Google Terdeteksi!</span> Akun Anda terhubung dengan Google.
                </div>
              </div>

              <p class="text-sm text-gray-600 dark:text-gray-300 font-secondary">
                {{ __('Akun Anda terhubung dengan Google. Penghapusan akun tidak memerlukan verifikasi password.') }}
              </p>

              <!-- Warning Alert -->
              <div class="flex p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                role="alert">
                <i class="fas fa-exclamation-triangle text-red-600 text-lg me-3"></i>
                <span class="sr-only">Peringatan</span>
                <div>
                  <span class="font-medium">Peringatan!</span> Tindakan ini tidak dapat dibatalkan. Semua data akan
                  dihapus permanen.
                </div>
              </div>
            </div>

            <!-- Modal Footer -->
            <div
              class="flex items-center justify-end p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600 gap-3">
              <button type="button" data-modal-hide="deleteAccountModal"
                class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 transition-colors">
                {{ __('Batal') }}
              </button>
              <button type="submit"
                class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 transition-colors inline-flex items-center gap-2">
                <i class="fas fa-trash-alt"></i>
                {{ __('Hapus Akun Permanen') }}
              </button>
            </div>
          </form>
        @else
          <!-- Modal untuk login normal -->
          <form method="POST" action="{{ route('profile.destroy') }}">
            @csrf
            @method('delete')

            <!-- Modal Header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
              <h3 class="text-lg font-semibold text-gray-900 dark:text-white font-primary">
                {{ __('Yakin ingin menghapus akun?') }}
              </h3>
              <button type="button"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                data-modal-hide="deleteAccountModal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                  viewBox="0 0 14 14">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
              </button>
            </div>

            <!-- Modal Body -->
            <div class="p-4 md:p-5 space-y-4">
              <p class="text-sm text-gray-600 dark:text-gray-300 font-secondary">
                {{ __('Setelah akun dihapus, semua data akan terhapus secara permanen. Masukkan password Anda untuk konfirmasi penghapusan akun.') }}
              </p>

              <!-- Warning Alert -->
              <div class="flex p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                role="alert">
                <i class="fas fa-exclamation-triangle text-red-600 text-lg me-3"></i>
                <span class="sr-only">Peringatan</span>
                <div>
                  <span class="font-medium">Peringatan!</span> Tindakan ini tidak dapat dibatalkan.
                </div>
              </div>

              <!-- Password Input -->
              <div>
                <label for="password"
                  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white font-secondary">
                  <i class="fas fa-lock me-1"></i>
                  {{ __('Password') }}
                </label>
                <input type="password" id="password" name="password"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500 font-secondary"
                  placeholder="{{ __('Masukkan password Anda') }}" required />
                @error('password', 'userDeletion')
                  <p class="mt-2 text-sm text-red-600 dark:text-red-500 font-secondary">
                    {{ $message }}
                  </p>
                @enderror
              </div>
            </div>

            <!-- Modal Footer -->
            <div
              class="flex items-center justify-end p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600 gap-3">
              <button type="button" data-modal-hide="deleteAccountModal"
                class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 transition-colors">
                {{ __('Batal') }}
              </button>
              <button type="submit"
                class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 transition-colors inline-flex items-center gap-2">
                <i class="fas fa-trash-alt"></i>
                {{ __('Hapus Akun') }}
              </button>
            </div>
          </form>
        @endif

      </div>
    </div>
  </div>
</section>
