<x-guest-layout title="Verifikasi Email - {{ Cache::get('store_name', config('app.name', 'Laravel')) }}">

  <!-- Kotak Verifikasi dengan efek blur -->
  <section class="flex-1 flex items-center justify-center w-full font-primary relative min-h-screen py-8">
    <div class="relative w-full max-w-md p-6 md:p-8 mx-5">
      <!-- Efek card transparan dengan nuansa kopi -->
      <div
        class="absolute inset-0 bg-gradient-to-br from-amber-200/10 to-amber-900/20 backdrop-blur-2xl rounded-2xl shadow-2xl border border-amber-200">
      </div>

      <!-- Content card -->
      <div class="relative z-10">

        <!-- Icon & Title -->
        <div class="text-center mb-6">
          <div class="flex justify-center mb-3">
            <div
              class="w-20 h-20 bg-amber-800/30 rounded-full flex items-center justify-center border border-amber-200/30">
              <i class="fa-solid fa-envelope-circle-check text-3xl text-amber-300"></i>
            </div>
          </div>
          <h3 class="text-center text-2xl font-semibold mb-2 text-[#F1F7FB]">{{ __('Verifikasi Email') }}</h3>
          <div class="w-12 h-0.5 bg-amber-500/50 mx-auto my-3"></div>
        </div>

        <!-- Info Message -->
        <div class="mb-6 text-center">
          <p class="text-[#F1F7FB]/80 text-sm leading-relaxed">
            {{ __('Terima kasih telah mendaftar! Sebelum memulai, verifikasi alamat email kamu dengan mengklik tautan yang telah kami kirimkan ke email kamu.') }}
          </p>
        </div>

        @if (session('status') == 'verification-link-sent')
          <!-- Success Alert -->
          <div class="mb-6 p-4 bg-amber-900/30 border border-amber-500/30 rounded-xl backdrop-blur-sm">
            <div class="flex items-start gap-3">
              <div class="flex-shrink-0">
                <i class="fa-solid fa-circle-check text-amber-400 text-lg mt-0.5"></i>
              </div>
              <div class="flex-1">
                <p class="text-sm text-amber-100">
                  {{ __('Tautan verifikasi baru telah dikirim ke alamat email yang kamu daftarkan.') }}
                </p>
              </div>
            </div>
          </div>
        @endif

        <!-- Action Buttons -->
        <div class="space-y-3">
          <!-- Resend Verification Form -->
          <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit"
              class="w-full bg-gradient-to-r from-amber-800 to-amber-700 
                     hover:from-amber-700 hover:to-amber-600
                     text-amber-50 font-semibold py-3 px-4 rounded-xl 
                     transition-all duration-300 ease-in-out 
                     transform hover:scale-[1.02] hover:shadow-xl hover:shadow-amber-900/30
                     focus:outline-none focus:ring-4 focus:ring-amber-500/40
                     active:scale-[0.98]
                     relative overflow-hidden group">
              <span
                class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/20 to-white/0 
                           -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></span>
              <span class="relative z-10 flex items-center justify-center">
                <i class="fa-regular fa-paper-plane mr-2"></i> {{ __('Kirim Ulang Email Verifikasi') }}
              </span>
            </button>
          </form>

          <!-- Logout Form -->
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
              class="w-full bg-transparent 
                     hover:bg-amber-800/30
                     text-amber-300/80 hover:text-amber-100
                     font-medium py-3 px-4 rounded-xl 
                     transition-all duration-300 ease-in-out 
                     transform hover:scale-[1.01]
                     focus:outline-none focus:ring-2 focus:ring-amber-500/40
                     border border-amber-700/30 hover:border-amber-600/50
                     backdrop-blur-sm
                     relative overflow-hidden group">
              <span class="relative z-10 flex items-center justify-center">
                <i class="fa-solid fa-sign-out-alt mr-2"></i> {{ __('Keluar') }}
              </span>
            </button>
          </form>
        </div>

        <!-- Tips Box -->
        <div class="text-center mt-3">
          <div class="inline-flex items-center gap-2 px-4 py-2 bg-amber-900/20 rounded-full border border-amber-700/30">
            <i class="fa-regular fa-clock text-amber-400 text-xs"></i>
            <span class="text-xs text-[#F1F7FB]/70">
              {{ __('Tidak menerima email? Cek folder spam') }}
            </span>
          </div>
        </div>
      </div>
    </div>
  </section>

  @push('scripts')
    @vite('resources/js/pages/auth.js')
  @endpush
</x-guest-layout>
