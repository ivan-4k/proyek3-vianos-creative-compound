<x-guest-layout title="Reset Password - {{ config('app.name', 'Laravel') }}">
  <!-- Kotak Reset Password efek blur -->
  <section class="flex-1 flex items-center justify-center w-full font-primary relative max-h-screen py-8 mt-5">
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
              <i class="fa-solid fa-lock-open text-2xl text-amber-300"></i>
            </div>
          </div>
          <h3 class="text-center text-2xl font-semibold mb-2 text-[#F1F7FB]">{{ __('Reset Password') }}</h3>
          <p class="text-[#F1F7FB]/80 text-sm">
            {{ __('Buat password baru yang kuat dan mudah diingat.') }}
          </p>
        </div>

        <form method="POST" action="{{ route('password.store') }}">
          @csrf

          <!-- Password Reset Token (hidden) -->
          <input type="hidden" name="token" value="{{ $request->route('token') }}">

          <!-- Email dengan floating label -->
          <div class="relative mb-5 group">
            <input type="email" name="email" id="email" value="{{ old('email', $request->email) }}"
              class="block w-full px-4 pb-2 pt-6 text-[#F1F7FB] bg-amber-950/20 border border-amber-700/30 rounded-xl 
                     focus:outline-none focus:border-amber-500 focus:ring-4 focus:ring-amber-500/20
                     peer transition-all duration-300 ease-in-out tracking-wide
                     autofill:bg-transparent autofill:text-amber-50
                     hover:border-amber-300/50"
              placeholder=" " required autofocus autocomplete="username" />
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

          <!-- Password dengan floating label -->
          <div class="relative mb-5 group">
            <input type="password" name="password" id="password"
              class="block w-full px-4 pb-2 pt-6 text-[#F1F7FB] bg-amber-950/20 border border-amber-700/30 rounded-xl 
                     focus:outline-none focus:border-amber-500 focus:ring-4 focus:ring-amber-500/20
                     peer transition-all duration-300 ease-in-out tracking-wide
                     autofill:bg-transparent autofill:text-amber-50
                     hover:border-amber-300/50"
              placeholder=" " required autocomplete="new-password" />
            <label for="password"
              class="absolute text-sm text-[#F1F7FB] duration-300 transform -translate-y-4 scale-75 top-5 left-4 origin-[0] 
                     peer-placeholder-shown:translate-y-1 peer-placeholder-shown:scale-100 peer-placeholder-shown:top-5
                     peer-focus:-translate-y-4 peer-focus:scale-75 peer-focus:top-5 peer-focus:text-amber-300
                     peer-[:not(:placeholder-shown)]:-translate-y-4 peer-[:not(:placeholder-shown)]:scale-75 peer-[:not(:placeholder-shown)]:top-5
                     transition-all ease-in-out z-10">
              <i class="fa-solid fa-lock mr-1"></i> {{ __('Password Baru') }}
            </label>
            <button type="button" id="togglePassword"
              class="absolute right-3 top-1/2 transform -translate-y-1/2 text-amber-50 hover:text-amber-300/70 focus:outline-none transition-colors duration-200 z-20">
              <i class="fa-regular fa-eye-slash text-lg"></i>
            </button>
            @error('password')
              <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>

          <!-- Confirm Password dengan floating label -->
          <div class="relative mb-5 group">
            <input type="password" name="password_confirmation" id="password_confirmation"
              class="block w-full px-4 pb-2 pt-6 text-[#F1F7FB] bg-amber-950/20 border border-amber-700/30 rounded-xl 
                     focus:outline-none focus:border-amber-500 focus:ring-4 focus:ring-amber-500/20
                     peer transition-all duration-300 ease-in-out tracking-wide
                     autofill:bg-transparent autofill:text-amber-50
                     hover:border-amber-300/50"
              placeholder=" " required autocomplete="new-password" />
            <label for="password_confirmation"
              class="absolute text-sm text-[#F1F7FB] duration-300 transform -translate-y-4 scale-75 top-5 left-4 origin-[0] 
                     peer-placeholder-shown:translate-y-1 peer-placeholder-shown:scale-100 peer-placeholder-shown:top-5
                     peer-focus:-translate-y-4 peer-focus:scale-75 peer-focus:top-5 peer-focus:text-amber-300
                     peer-[:not(:placeholder-shown)]:-translate-y-4 peer-[:not(:placeholder-shown)]:scale-75 peer-[:not(:placeholder-shown)]:top-5
                     transition-all ease-in-out z-10">
              <i class="fa-solid fa-lock mr-1"></i> {{ __('Konfirmasi Password') }}
            </label>
            <button type="button" id="toggleConfirmPassword"
              class="absolute right-3 top-1/2 transform -translate-y-1/2 text-amber-50 hover:text-amber-300/70 focus:outline-none transition-colors duration-200 z-20">
              <i class="fa-regular fa-eye-slash text-lg"></i>
            </button>
            @error('password_confirmation')
              <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>

          <!-- Password Strength Indicator (opsional, biar lebih keren) -->
          <div class="mb-5 text-xs" id="password-strength">
            <div class="flex items-center gap-1 mb-1">
              <span class="text-[#F1F7FB]/60">{{ __('Kekuatan password:') }}</span>
              <span id="strength-text" class="text-amber-300 font-medium">Belum dimasukkan</span>
            </div>
            <div class="flex gap-1 h-1">
              <div id="strength-1" class="flex-1 rounded-full bg-amber-800/30"></div>
              <div id="strength-2" class="flex-1 rounded-full bg-amber-800/30"></div>
              <div id="strength-3" class="flex-1 rounded-full bg-amber-800/30"></div>
            </div>
          </div>

          <!-- Tombol Reset Password -->
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
              <i class="fa-solid fa-rotate-right mr-2"></i> {{ __('Reset Password') }}
            </span>
          </button>

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

  <!-- JavaScript untuk toggle password dan strength indicator -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Toggle untuk Password
      const togglePassword = document.getElementById('togglePassword');
      const passwordInput = document.getElementById('password');

      if (togglePassword && passwordInput) {
        togglePassword.addEventListener('click', function() {
          const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
          passwordInput.setAttribute('type', type);
          const icon = this.querySelector('i');
          icon.classList.toggle('fa-eye-slash');
          icon.classList.toggle('fa-eye');
        });
      }

      // Toggle untuk Confirm Password
      const toggleConfirm = document.getElementById('toggleConfirmPassword');
      const confirmInput = document.getElementById('password_confirmation');

      if (toggleConfirm && confirmInput) {
        toggleConfirm.addEventListener('click', function() {
          const type = confirmInput.getAttribute('type') === 'password' ? 'text' : 'password';
          confirmInput.setAttribute('type', type);
          const icon = this.querySelector('i');
          icon.classList.toggle('fa-eye-slash');
          icon.classList.toggle('fa-eye');
        });
      }

      // Password Strength Indicator (opsional)
      const strengthText = document.getElementById('strength-text');
      const strengthBars = {
        1: document.getElementById('strength-1'),
        2: document.getElementById('strength-2'),
        3: document.getElementById('strength-3')
      };

      if (passwordInput && strengthText && strengthBars[1]) {
        passwordInput.addEventListener('input', function() {
          const password = this.value;
          let strength = 0;

          if (password.length === 0) {
            strengthText.textContent = 'Belum dimasukkan';
            strengthText.className = 'text-amber-300 font-medium';
            resetBars();
            return;
          }

          // Cek panjang minimal 8 karakter
          if (password.length >= 8) strength += 1;

          // Cek mengandung huruf besar dan kecil
          if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength += 1;

          // Cek mengandung angka dan simbol
          if (/[0-9]/.test(password) && /[^a-zA-Z0-9]/.test(password)) strength += 1;

          // Update tampilan
          switch (strength) {
            case 0:
              strengthText.textContent = 'Lemah';
              strengthText.className = 'text-red-400 font-medium';
              updateBars(0);
              break;
            case 1:
              strengthText.textContent = 'Cukup';
              strengthText.className = 'text-yellow-400 font-medium';
              updateBars(1);
              break;
            case 2:
              strengthText.textContent = 'Baik';
              strengthText.className = 'text-amber-400 font-medium';
              updateBars(2);
              break;
            case 3:
              strengthText.textContent = 'Kuat';
              strengthText.className = 'text-green-400 font-medium';
              updateBars(3);
              break;
          }
        });

        function resetBars() {
          for (let i = 1; i <= 3; i++) {
            strengthBars[i].className = 'flex-1 rounded-full bg-amber-800/30';
          }
        }

        function updateBars(level) {
          const colors = ['bg-red-500', 'bg-yellow-500', 'bg-amber-500', 'bg-green-500'];
          for (let i = 1; i <= 3; i++) {
            if (i <= level) {
              strengthBars[i].className = `flex-1 rounded-full ${colors[level]}`;
            } else {
              strengthBars[i].className = 'flex-1 rounded-full bg-amber-800/30';
            }
          }
        }
      }

      // Handle autofill
      const inputs = document.querySelectorAll('input');
      inputs.forEach(input => {
        input.addEventListener('animationstart', function(e) {
          if (e.animationName.includes('autofill')) {
            this.classList.add('autofill-active');
          }
        });
      });
    });
  </script>

  <!-- Style tambahan -->
  <style>
    /* Mengatasi background kuning saat autofill */
    input:-webkit-autofill,
    input:-webkit-autofill:hover,
    input:-webkit-autofill:focus,
    input:-webkit-autofill:active {
      -webkit-background-clip: text;
      -webkit-text-fill-color: #F1F7FB;
      transition: background-color 5000s ease-in-out 0s;
      box-shadow: inset 0 0 20px 20px rgba(58, 42, 22, 0.5);
      caret-color: #F1F7FB;
    }

    input:-webkit-autofill+label {
      transform: translateY(-1rem) scale(0.75);
      top: 1.25rem;
      color: #f59e0b !important;
    }
  </style>
</x-guest-layout>
