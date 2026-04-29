<x-guest-layout title="Lupa Password - {{ Cache::get('store_name', config('app.name', 'Laravel')) }}">
  <!-- Kotak Lupa Password efek blur -->
  <section class="flex-1 flex items-center justify-center w-full font-primary relative max-h-screen py-8">
    <div class="relative w-full max-w-md p-6 md:p-8 mx-5">
      <!-- Efek card transparan -->
      <div
        class="absolute inset-0 bg-gradient-to-br from-amber-200/10 to-amber-900/20 backdrop-blur-2xl rounded-2xl shadow-2xl border border-amber-200">
      </div>

      <!-- Content card -->
      <div class="relative z-10">
        <!-- Icon & Title -->
        <div class="text-center mb-6">
          <div class="flex justify-center mb-3">
            <div
              class="w-16 h-16 bg-amber-800/30 rounded-full flex items-center justify-center border border-amber-200/30">
              <i class="fa-solid fa-key text-2xl text-amber-300"></i>
            </div>
          </div>
          <h3 class="text-center text-2xl font-semibold mb-2 text-[#F1F7FB]">{{ __('Lupa Password?') }}</h3>
          <p class="text-[#F1F7FB]/80 text-sm">
            {{ __('Tenang, kami akan bantu reset password-mu. Masukkan email dan kami kirim link reset.') }}
          </p>
        </div>

        <form method="POST" action="{{ route('password.email') }}">
          @csrf

          <!-- Email dengan floating label -->
          <div class="relative mb-5 group">
            <input type="email" name="email" id="email" value="{{ old('email') }}"
              class="block w-full px-4 pb-2 pt-6 text-[#F1F7FB] bg-amber-950/20 border border-amber-700/30 rounded-xl 
                     focus:outline-none focus:border-amber-500 focus:ring-4 focus:ring-amber-500/20
                     peer transition-all duration-300 ease-in-out tracking-wide
                     autofill:bg-transparent autofill:text-amber-50
                     hover:border-amber-300/50"
              placeholder=" " required autofocus autocomplete="off" />
            <label for="email"
              class="absolute text-sm text-[#F1F7FB] duration-300 transform -translate-y-4 scale-75 top-5 left-4 origin-[0] 
                     peer-placeholder-shown:translate-y-1 peer-placeholder-shown:scale-100 peer-placeholder-shown:top-5
                     peer-focus:-translate-y-4 peer-focus:scale-75 peer-focus:top-5 peer-focus:text-amber-300
                     peer-[:not(:placeholder-shown)]:-translate-y-4 peer-[:not(:placeholder-shown)]:scale-75 peer-[:not(:placeholder-shown)]:top-5
                     transition-all ease-in-out z-10">
              <i class="fa-regular fa-envelope mr-1"></i> {{ __('Email') }}
            </label>
            @error('email')
              <p class="text-red-400 text-xs mt-1 flex items-center">
                <i class="fa-solid fa-circle-exclamation mr-1"></i> {{ $message }}
              </p>
            @enderror
          </div>

          <!-- Tombol Kirim Link Reset -->
          <button type="submit"
            class="w-full bg-gradient-to-r from-amber-800 to-amber-700 
                   hover:from-amber-700 hover:to-amber-600
                   text-amber-50 font-semibold py-3 px-4 rounded-xl 
                   transition-all duration-300 ease-in-out 
                   transform hover:scale-[1.02] hover:shadow-xl hover:shadow-amber-900/30
                   focus:outline-none focus:ring-4 focus:ring-amber-500/40
                   active:scale-[0.98]
                   relative overflow-hidden group mb-4">
            <span
              class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/20 to-white/0 
                         -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></span>
            <span class="relative z-10 flex items-center justify-center">
              <i class="fa-regular fa-paper-plane mr-2"></i> {{ __('Kirim Link Reset') }}
            </span>
          </button>

          <!-- Status Sesi -->
          <x-auth-session-status class="mb-4" :status="session('status')" />

          <!-- Kembali ke Login -->
          <div class="text-center">
            <a href="{{ route('login') }}"
              class="inline-flex items-center text-[#F1F7FB] hover:text-amber-300 transition-colors duration-200 text-sm group">
              <i class="fa-solid fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform duration-200"></i>
              {{ __('Kembali ke halaman login') }}
            </a>
          </div>
        </form>
      </div>
    </div>
  </section>

  @push('scripts')
    @vite('resources/js/pages/auth.js')
  @endpush
</x-guest-layout>
