@extends('layouts.app')

@section('title', 'Alamat')

@section('content')
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">
    <div class="flex flex-col lg:flex-row gap-6 lg:gap-8 mt-12">

      <div class="w-full lg:w-80 flex-shrink-0">
        <x-sidebar />
      </div>

      <div class="flex-1 space-y-6">
        <div class="bg-white rounded-xl shadow-sm border border-[#3E1E04]/10 p-6">
          <header class="mb-6">
            <h2 class="text-xl font-bold text-[#3E1E04] font-primary">Alamat</h2>
            <p class="text-sm text-gray-500 mt-1 font-secondary">Kelola informasi alamat kamu</p>
          </header>

          {{-- Alamat utama --}}
          <div class="border border-[#3E1E04]/10 rounded-lg p-4 mb-6 bg-gradient-to-r from-[#BC430D]/5 to-transparent">
            <div class="flex items-start justify-between">
              <div class="flex-1">
                <div class="flex items-center gap-2 mb-2">
                  <p class="font-semibold text-[#3E1E04] font-secondary">{{ auth()->user()->name }}</p>
                  <span
                    class="text-xs bg-[#BC430D]/10 text-[#BC430D] px-2 py-0.5 rounded-full font-secondary">Utama</span>
                </div>
                <p class="text-sm text-gray-600 font-secondary">
                  📞 {{ auth()->user()->phone ?? 'Belum diisi' }}
                </p>
                <p class="text-sm text-gray-600 mt-1 font-secondary">
                  📍 {{ auth()->user()->address ?? 'Belum ada alamat' }}
                </p>
              </div>
            </div>
          </div>

          {{-- Form --}}
          {{-- Gunakan route 'address.update' bukan 'user.address.update' --}}
          <form method="POST" action="{{ route('address.update') }}">
            @csrf
            @method('PUT')
            <div class="relative mb-6">
              <textarea id="address" name="address" rows="3"
                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[#BC430D] peer font-secondary"
                placeholder=" ">{{ old('address', $user->address) }}</textarea>
              <label for="address"
                class="inline-flex items-center absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-[#BC430D] peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1 font-secondary">
                <svg class="w-4 h-4 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                  height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M12 4v16M4 12h16" />
                  <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                    d="M12 4a8 8 0 0 1 8 8M12 4a8 8 0 0 0-8 8M12 20a8 8 0 0 1 8-8M12 20a8 8 0 0 0-8 8" />
                </svg>
                {{ __('Alamat Lengkap') }}
              </label>
              @error('address')
                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
              @enderror
              <p class="text-xs text-gray-400 mt-1 font-secondary">
                <i class="fa-solid fa-info-circle"></i> Masukkan alamat lengkap termasuk nama jalan, nomor rumah, RT/RW,
                kelurahan, kecamatan, kota/kabupaten, dan kode pos.
              </p>
            </div>

            <div class="relative mb-4">
              <input type="tel" id="phone" name="phone"
                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-[#BC430D] peer font-secondary"
                placeholder=" " value="{{ old('phone', $user->phone) }}" autocomplete="tel" maxlength="20" />
              <label for="phone"
                class="inline-flex items-center absolute text-sm text-gray-500 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white px-2 peer-focus:px-2 peer-focus:text-[#BC430D] peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1 font-secondary">
                <svg class="w-4 h-4 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                  height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M18.5 4h-13a1 1 0 0 0-1 1v14a1 1 0 0 0 1 1h13a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1Z" />
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 4v16M8 4v2M16 4v2" />
                </svg>
                {{ __('Nomor HP') }}
              </label>
              @error('phone')
                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
              @enderror
            </div>

            <div class="flex items-center gap-3">
              <button type="submit"
                class="bg-[#BC430D] hover:bg-[#3E1E04] text-white px-6 py-2.5 rounded-lg transition-colors font-secondary font-medium shadow-sm">
                <i class="fa-solid fa-save mr-2"></i>
                Simpan Alamat
              </button>

              @if (session('status') === 'address-updated')
                <p x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
                  class="text-sm text-green-600 font-secondary flex items-center gap-1">
                  <i class="fa-solid fa-check-circle"></i>
                  Alamat berhasil disimpan.
                </p>
              @endif
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
  @vite('resources/js/pages/profile.js')
@endpush
