@if (!auth()->user()->google_id)
  <section class="mb-8">
    <header class="mb-6">
      <h2 class="text-xl font-bold text-[#3E1E04] font-primary">
        {{ __('Perbarui Password') }}
      </h2>
      <p class="text-sm text-gray-500 mt-1 font-secondary">
        {{ __('Pastikan akun Anda menggunakan kata sandi yang panjang dan acak untuk tetap aman.') }}
      </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6">
      @csrf
      @method('put')

      <div class="space-y-6">
        <!-- Current Password -->
        <div class="relative">
          <input type="password" id="update_password_current_password" name="current_password"
            class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[#BC430D] peer font-secondary"
            placeholder=" " autocomplete="current-password" />
          <label for="update_password_current_password"
            class="inline-flex items-center absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-[#BC430D] peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1 font-secondary">
            <i class="fas fa-lock me-1.5 text-xs"></i>
            {{ __('Password Sekarang') }}
          </label>
          @if ($errors->updatePassword->has('current_password'))
            <div class="text-red-500 text-xs mt-1 flex items-center gap-1">
              <i class="fas fa-exclamation-circle"></i>
              {{ $errors->updatePassword->first('current_password') }}
            </div>
          @endif
        </div>

        <!-- New Password -->
        <div class="relative">
          <input type="password" id="update_password_password" name="password"
            class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[#BC430D] peer font-secondary"
            placeholder=" " autocomplete="new-password" minlength="8" />
          <label for="update_password_password"
            class="inline-flex items-center absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-[#BC430D] peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1 font-secondary">
            <i class="fas fa-key me-1.5 text-xs"></i>
            {{ __('Password Baru') }}
          </label>
          @if ($errors->updatePassword->has('password'))
            <div class="text-red-500 text-xs mt-1 flex items-center gap-1">
              <i class="fas fa-exclamation-circle"></i>
              {{ $errors->updatePassword->first('password') }}
            </div>
          @endif
          <p class="text-xs text-gray-400 mt-1 font-secondary">
            <i class="fas fa-info-circle me-1"></i>
            Minimal 8 karakter
          </p>
        </div>

        <!-- Confirm Password -->
        <div class="relative">
          <input type="password" id="update_password_password_confirmation" name="password_confirmation"
            class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[#BC430D] peer font-secondary"
            placeholder=" " autocomplete="new-password" minlength="8" />
          <label for="update_password_password_confirmation"
            class="inline-flex items-center absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-[#BC430D] peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1 font-secondary">
            <i class="fas fa-check-circle me-1.5 text-xs"></i>
            {{ __('Konfirmasi Password') }}
          </label>
          @if ($errors->updatePassword->has('password_confirmation'))
            <div class="text-red-500 text-xs mt-1 flex items-center gap-1">
              <i class="fas fa-exclamation-circle"></i>
              {{ $errors->updatePassword->first('password_confirmation') }}
            </div>
          @endif
        </div>

        <!-- Submit Button -->
        <div class="flex items-center gap-4">
          <button type="submit"
            class="inline-flex items-center gap-2 px-6 py-2.5 bg-[#BC430D] hover:bg-[#3E1E04] text-white font-medium rounded-lg transition-colors shadow-sm font-secondary">
            <i class="fas fa-save"></i>
            {{ __('Simpan Password') }}
          </button>

          @if (session('status') === 'password-updated')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
              class="text-sm text-green-600 font-secondary flex items-center gap-1">
              <i class="fas fa-check-circle"></i>
              {{ __('Password berhasil disimpan.') }}
            </p>
          @endif
        </div>
      </div>
    </form>
  </section>
@else
  <!-- Google Users - Cannot Change Password -->
  <section class="mb-8">
    <header class="mb-6">
      <h2 class="text-xl font-bold text-[#3E1E04] font-primary">
        {{ __('Perbarui Password') }}
      </h2>
      <p class="text-sm text-gray-500 mt-1 font-secondary">
        {{ __('Anda login menggunakan akun Google. Fitur perubahan password tidak tersedia.') }}
      </p>
    </header>

    <div class="bg-gradient-to-r from-[#BC430D]/5 to-[#3E1E04]/5 border-l-4 border-[#BC430D] rounded-lg p-5">
      <div class="flex items-start gap-4">
        <div class="flex-shrink-0">
          <div class="w-12 h-12 bg-[#BC430D]/10 rounded-full flex items-center justify-center">
            <i class="fab fa-google text-[#BC430D] text-xl"></i>
          </div>
        </div>
        <div class="flex-1">
          <h3 class="font-semibold text-[#3E1E04] mb-1 font-primary">
            Akun Google Terdeteksi
          </h3>
          <p class="text-sm text-gray-600 font-secondary">
            Anda login menggunakan akun Google. Untuk mengubah password, silakan gunakan fitur manajemen akun Google
            Anda.
          </p>
          <div class="mt-3 flex items-center gap-2 text-xs text-[#BC430D]">
            <i class="fas fa-shield-alt"></i>
            <span>Keamanan dikelola oleh Google</span>
          </div>
        </div>
      </div>
    </div>
  </section>
@endif
