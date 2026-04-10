<section class="mb-8">
  <header class="mb-6 ms-2">
    <h2 class="text-xl font-bold text-[#3E1E04] font-primary">
      {{ __('Profil Saya') }}
    </h2>
    <p class="text-sm text-gray-500 mt-1 font-secondary">
      {{ __('Kelola informasi profil anda.') }}
    </p>
  </header>

  <form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
  </form>

  <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">
    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" x-data="profileForm()">
      @csrf
      @method('patch')

      <input type="hidden" name="hapus_avatar" id="hapus_avatar" x-model="hapusAvatar" value="0">

      <div class="flex flex-col lg:flex-row gap-8 lg:gap-10">

        <div class="flex-1 order-2 lg:order-1">

          <div class="relative mb-6">
            <input type="text" id="name" name="name"
              class="block px-3 pb-2.5 pt-5 w-full text-sm text-gray-900 bg-transparent rounded-xl border-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-[#BC430D] peer font-secondary transition-colors"
              placeholder=" " value="{{ old('name', $user->name) }}" required autofocus autocomplete="name"
              minlength="3" maxlength="255" />
            <label for="name"
              class="inline-flex items-center absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-[#BC430D] peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 start-2 font-secondary">
              <svg class="w-4 h-4 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M12 4v16M4 12h16" />
                <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                  d="M12 4a8 8 0 0 1 8 8M12 4a8 8 0 0 0-8 8M12 20a8 8 0 0 1 8-8M12 20a8 8 0 0 0-8 8" />
              </svg>
              {{ __('Nama Lengkap') }}
            </label>
            @error('name')
              <div class="text-red-500 text-xs mt-1.5 ml-1 font-secondary">{{ $message }}</div>
            @enderror
          </div>

          <div class="relative mb-6">
            <input type="email" id="email" name="email"
              class="block px-3 pb-2.5 pt-5 w-full text-sm bg-transparent rounded-xl border-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-[#BC430D] peer font-secondary transition-colors @if ($user->google_id) cursor-not-allowed text-gray-500 @endif"
              placeholder=" " value="{{ old('email', $user->email) }}" maxlength="255" autocomplete="email"
              @if ($user->google_id) disabled @else required @endif />
            <label for="email"
              class="inline-flex items-center absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-[#BC430D] peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 start-2 font-secondary">
              <svg class="w-4 h-4 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                  d="m3.5 5.5 7.893 6.036a1 1 0 0 0 1.214 0L20.5 5.5M4 19h16a1 1 0 0 0 1-1V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z" />
              </svg>
              {{ __('Alamat Email') }}
            </label>

            @if ($user->google_id)
              <div class="text-[#BC430D] text-xs mt-2 ml-1 flex items-center gap-1.5 font-secondary">
                <i class="fab fa-google"></i>
                Email terhubung dengan akun Google dan tidak dapat diubah
              </div>
            @endif

            @error('email')
              <div class="text-red-500 text-xs mt-1.5 ml-1 font-secondary">{{ $message }}</div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
              <div class="mt-3 p-3.5 bg-amber-50 rounded-xl border border-amber-100">
                <p class="text-sm text-amber-800 font-secondary flex items-start gap-2">
                  <i class="fas fa-exclamation-circle mt-0.5"></i>
                  <span>
                    {{ __('Email anda belum terverifikasi.') }}
                    <button type="submit" form="send-verification"
                      class="text-[#BC430D] hover:text-[#3E1E04] font-bold underline transition-colors ml-1">
                      {{ __('Kirim ulang email.') }}
                    </button>
                  </span>
                </p>
                @if (session('status') === 'verification-link-sent')
                  <p class="text-xs text-green-600 mt-2 font-medium flex items-center gap-1">
                    <i class="fas fa-check-circle"></i> {{ __('Link verifikasi telah dikirim ke alamat email Anda.') }}
                  </p>
                @endif
              </div>
            @endif
          </div>

          <div class="relative mb-6">
            <input type="tel" id="phone" name="phone"
              class="block px-3 pb-2.5 pt-5 w-full text-sm text-gray-900 bg-transparent rounded-xl border-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-[#BC430D] peer font-secondary transition-colors"
              placeholder=" " value="{{ old('phone', $user->phone) }}" autocomplete="tel" maxlength="20" />
            <label for="phone"
              class="inline-flex items-center absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-[#BC430D] peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 start-2 font-secondary">
              <svg class="w-4 h-4 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M18.5 4h-13a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h13a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1Z" />
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 4v16M8 4v2M16 4v2" />
              </svg>
              {{ __('Nomor HP / WhatsApp') }}
            </label>
            @error('phone')
              <div class="text-red-500 text-xs mt-1.5 ml-1 font-secondary">{{ $message }}</div>
            @enderror
          </div>

          <div class="relative mb-6">
            <select id="gender" name="gender"
              class="block px-3 pb-2.5 pt-5 w-full text-sm text-gray-900 bg-transparent rounded-xl border-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-[#BC430D] peer font-secondary transition-colors cursor-pointer">
              <option value="" disabled {{ old('gender', $user->gender) ? '' : 'selected' }}
                class="text-gray-400">Pilih Jenis Kelamin</option>
              <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Laki-laki</option>
              <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Perempuan
              </option>
            </select>
            <label for="gender"
              class="inline-flex items-center absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-[#BC430D] peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 start-2 font-secondary">
              <svg class="w-4 h-4 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M12 4v16M4 12h16" />
                <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                  d="M12 4a8 8 0 0 1 8 8M12 4a8 8 0 0 0-8 8M12 20a8 8 0 0 1 8-8M12 20a8 8 0 0 0-8 8" />
              </svg>
              {{ __('Jenis Kelamin') }}
            </label>
            <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-500">
              <i class="fas fa-chevron-down text-xs"></i>
            </div>
            @error('gender')
              <div class="text-red-500 text-xs mt-1.5 ml-1 font-secondary">{{ $message }}</div>
            @enderror
          </div>

          <div class="relative mb-8">
            <textarea id="address" name="address" rows="3"
              class="block px-3 pb-2.5 pt-5 w-full text-sm text-gray-900 bg-transparent rounded-xl border-2 border-gray-200 appearance-none focus:outline-none focus:ring-0 focus:border-[#BC430D] peer font-secondary transition-colors resize-y"
              placeholder=" ">{{ old('address', $user->address) }}</textarea>
            <label for="address"
              class="inline-flex items-center absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-[#BC430D] peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-6 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 start-2 font-secondary">
              <svg class="w-4 h-4 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M17.8 13.938h-.011a7 7 0 1 0-11.464.144h-.016l.14.171c.1.127.2.251.3.371L12 21l5.13-6.248c.194-.209.374-.429.54-.659l.13-.155Z" />
              </svg>
              {{ __('Alamat Lengkap') }}
            </label>
            @error('address')
              <div class="text-red-500 text-xs mt-1.5 ml-1 font-secondary">{{ $message }}</div>
            @enderror
          </div>

          <div class="flex items-center gap-4">
            <button type="submit"
              class="inline-flex items-center justify-center gap-2 px-8 py-3 bg-[#BC430D] hover:bg-[#3E1E04] text-white font-bold rounded-xl transition-all duration-300 shadow-md hover:shadow-lg hover:-translate-y-0.5 font-secondary w-full sm:w-auto">
              <i class="fas fa-save text-sm" aria-hidden="true"></i>
              {{ __('Simpan Perubahan') }}
            </button>

            @if (session('status') === 'profile-updated')
              <div
                class="px-4 py-2 bg-emerald-50 text-emerald-700 rounded-lg flex items-center gap-2 font-secondary text-sm border border-emerald-100 shadow-sm"
                x-data="{ show: true }" x-show="show" x-transition.opacity.duration.500ms x-init="setTimeout(() => show = false, 3000)">
                <i class="fas fa-check-circle"></i>
                {{ __('Tersimpan.') }}
              </div>
            @endif
          </div>
        </div>

        <div
          class="w-full lg:w-72 order-1 lg:order-2 border-b lg:border-b-0 lg:border-l border-gray-100 pb-8 lg:pb-0 lg:pl-8 text-center flex flex-col items-center justify-start pt-2">

          <h3 class="text-sm font-bold text-gray-700 mb-4 font-secondary lg:hidden">Foto Profil</h3>

          <template x-if="!previewUrl && !hapusAvatar">
            <div class="flex flex-col items-center w-full">
              @if ($user->avatar)
                <img src="{{ Storage::url($user->avatar) }}" alt="Foto Profil"
                  class="w-28 h-28 sm:w-32 sm:h-32 rounded-full object-cover ring-4 ring-[#BC430D]/20 shadow-sm mb-4">
                <button type="button" @click="hapusAvatar = 1; previewUrl = null"
                  class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-red-600 hover:text-white bg-red-50 hover:bg-red-500 rounded-lg transition-colors duration-300 font-secondary w-full justify-center">
                  <i class="fas fa-trash-alt"></i> Hapus Foto
                </button>
              @else
                <img src="{{ asset('images/default/default-avatar.png') }}" alt="Foto Profil Default"
                  class="w-28 h-28 sm:w-32 sm:h-32 rounded-full object-cover ring-4 ring-gray-100 mb-4">
              @endif
            </div>
          </template>

          <template x-if="previewUrl">
            <div class="flex flex-col items-center w-full">
              <img :src="previewUrl" alt="Preview Foto Baru"
                class="w-28 h-28 sm:w-32 sm:h-32 rounded-full object-cover ring-4 ring-[#BC430D] shadow-md mb-4">
              <button type="button" @click="previewUrl = null; hapusAvatar = 0; $refs.fileInput.value = ''"
                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-600 hover:text-[#3E1E04] bg-gray-100 hover:bg-gray-200 rounded-lg transition-colors duration-300 font-secondary w-full justify-center">
                <i class="fas fa-undo"></i> Batal Ubah
              </button>
            </div>
          </template>

          <div class="mt-4 w-full">
            <button type="button" @click="$refs.fileInput.click()"
              class="inline-flex items-center justify-center gap-2 px-4 py-2.5 text-sm font-bold text-[#BC430D] bg-[#BC430D]/10 hover:bg-[#BC430D]/20 border border-[#BC430D]/20 rounded-xl transition-colors duration-300 font-secondary w-full shadow-sm">
              <i class="fas fa-camera"></i> Pilih Gambar Baru
            </button>

            <input x-ref="fileInput" name="avatar" type="file" class="hidden"
              accept="image/jpeg,image/png,image/jpg" @change="handleFileSelect($event)">

            <p class="text-xs text-gray-400 mt-3 font-secondary break-words px-2"
              x-text="fileName || 'Format: JPEG, JPG, PNG (Max 2MB)'"></p>

            @error('avatar')
              <div class="text-red-500 text-xs mt-2 font-secondary">{{ $message }}</div>
            @enderror
          </div>

        </div>

      </div>
    </form>
  </div>
</section>