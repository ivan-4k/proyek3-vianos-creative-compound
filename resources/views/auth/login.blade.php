<x-guest-layout title="Login - {{ config('app.name', 'Laravel') }}">
  <!-- Status Sesi -->
  <x-auth-session-status class="mb-4" :status="session('status')" />

  <!-- Kotak Login efek blur -->
  <section class="flex-1 flex items-center justify-center w-full font-primary relative max-h-full py-8">
    <div class="relative w-full max-w-md p-6 md:p-8 mx-5">
      <!-- Efek card transparan -->
      <div
        class="absolute inset-0 bg-gradient-to-br from-amber-200/10 to-amber-900/20 backdrop-blur-2xl rounded-2xl shadow-2xl border border-amber-200">
      </div>

      <!-- Content card -->
      <div class="relative z-10">
        <h3 class="text-center text-2xl font-semibold mb-6 text-[#F1F7FB]">{{ __('Masuk') }}</h3>
        <form method="POST" action="{{ route('login') }}">
          @csrf

          <!-- Email floating label -->
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
              <i class="fa-regular fa-envelope mr-1"></i>
              {{ __('Email') }}
            </label>
            @error('email')
              <p class="text-red-400 text-xs mt-1 flex items-center">
                <i class="fa-solid fa-circle-exclamation mr-1"></i> {{ $message }}
              </p>
            @enderror
          </div>

          <!-- Password floating label -->
          <div class="relative mb-5 group">
            <input type="password" name="password" id="password"
              class="block w-full px-4 pb-2 pt-6 text-[#F1F7FB] bg-amber-950/20 border border-amber-700/30 rounded-xl 
                     focus:outline-none focus:border-amber-500 focus:ring-4 focus:ring-amber-500/20
                     peer transition-all duration-300 ease-in-out tracking-wide
                     autofill:bg-transparent autofill:text-amber-50
                     hover:border-amber-300/50"
              placeholder=" " required autocomplete="off" minlength="8" />
            <label for="password"
              class="absolute text-sm text-[#F1F7FB] duration-300 transform -translate-y-4 scale-75 top-5 left-4 origin-[0] 
                     peer-placeholder-shown:translate-y-1 peer-placeholder-shown:scale-100 peer-placeholder-shown:top-5
                     peer-focus:-translate-y-4 peer-focus:scale-75 peer-focus:top-5 peer-focus:text-amber-300
                     peer-[:not(:placeholder-shown)]:-translate-y-4 peer-[:not(:placeholder-shown)]:scale-75 peer-[:not(:placeholder-shown)]:top-5
                     transition-all ease-in-out z-10">
              <i class="fa-solid fa-lock mr-1"></i>
              {{ __('Password') }}
            </label>
            <button type="button" id="togglePassword"
              class="absolute right-3 top-1/2 transform -translate-y-1/2 text-amber-50 hover:text-amber-300/70  focus:outline-none transition-colors duration-200 z-20">
              <i class="fa-regular fa-eye-slash text-lg"></i>
            </button>
            @error('password')
              <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>

          <!-- Ingat Saya & Lupa Password -->
          <div class="flex justify-between items-center text-sm mb-5">
            <label
              class="flex items-center text-[#F1F7FB] hover:text-amber-300 cursor-pointer transition-colors duration-200">
              <input type="checkbox" name="remember" id="remember_me"
                class="rounded border-amber-700/30 bg-amber-950/30 text-amber-500 
                       focus:ring-amber-500/50 focus:ring-offset-0 focus:ring-2
                       transition-all duration-200 cursor-pointer
                       checked:bg-amber-600 checked:border-amber-600
                       w-4 h-4" />
              <span class="ml-2">{{ __('Ingat saya') }}</span>
            </label>

            @if (Route::has('password.request'))
              <a href="{{ route('password.request') }}"
                class="text-[#F1F7FB] hover:text-amber-300 underline underline-offset-2 transition-all duration-200">
                {{ __('Lupa Password?') }}
              </a>
            @endif
          </div>

          <!-- Tombol Login -->
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
              <i class="fa-solid fa-mug-hot mr-2"></i> {{ __('Login') }}
            </span>
          </button>

          <!-- Link Daftar -->
          <p class="text-center text-[#F1F7FB] font-light mt-4 mb-4">
            {{ __('Belum punya akun?') }}
            <a href="{{ route('register') }}"
              class="font-medium text-amber-400 hover:text-amber-300 underline underline-offset-2 transition-all duration-200">
              {{ __('Daftar') }}
            </a>
          </p>

          <!-- Separator -->
          <div class="relative flex items-center justify-center my-4">
            <div class="flex-grow border-t border-amber-200/30"></div>
            <span class="flex-shrink mx-4 text-[#F1F7FB] font-light text-sm flex items-center">
              <i class="fa-solid fa-coffee-bean mr-1 text-xs"></i> {{ __('atau') }} <i
                class="fa-solid fa-coffee-bean ml-1 text-xs"></i>
            </span>
            <div class="flex-grow border-t border-amber-200/30"></div>
          </div>

          <!-- Login Google  -->
          <div class="flex justify-center mt-4">
            <a href="{{ route('google.redirect') }}"
              class="flex items-center justify-center w-14 h-14 
                     bg-gradient-to-br from-amber-200/10 to-amber-800/20
                     hover:from-amber-200/20 hover:to-amber-800/30
                     backdrop-blur-sm rounded-2xl 
                     shadow-lg hover:shadow-xl hover:shadow-amber-900/20
                     transition-all duration-300 hover:scale-110 
                     border border-amber-200/30 group"
              title="Login dengan Google">
              <i class="fa-brands fa-google text-2xl text-amber-300/80 group-hover:text-amber-50 transition-colors"></i>
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
