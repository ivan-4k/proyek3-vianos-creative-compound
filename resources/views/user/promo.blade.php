@extends('layouts.app')

@section('title', 'Promo & Penawaran Spesial')

@section('content')
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">
    <div class="flex flex-col lg:flex-row gap-6 lg:gap-8 mt-12">

      {{-- Sidebar Component --}}
      <div class="w-full lg:w-80 flex-shrink-0">
        <x-sidebar />
      </div>

      {{-- Main Content --}}
      <div class="flex-1 space-y-6">
        <div class="bg-white rounded-xl shadow-sm border border-[#3E1E04]/10 p-6 lg:p-8">

          {{-- Header --}}
          <div
            class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6 lg:mb-8 border-b border-[#3E1E04]/10 pb-4">
            <header>
              <div class="flex items-center gap-3 mb-1">
                <h2 class="text-2xl font-bold text-[#3E1E04] font-primary">Promo & Penawaran</h2>
                <span
                  class="bg-rose-100 text-rose-700 text-[10px] uppercase tracking-wider font-bold px-2 py-0.5 rounded-full font-secondary animate-pulse">
                  2 Baru
                </span>
              </div>
              <p class="text-sm text-gray-500 mt-1 font-secondary">Dapatkan informasi diskon, menu baru, dan promo menarik
                lainnya.</p>
            </header>

            {{-- Tombol Aksi Global --}}
            <button type="button"
              class="text-sm font-medium text-[#BC430D] hover:text-[#3E1E04] transition-colors font-secondary whitespace-nowrap flex items-center gap-2 bg-[#BC430D]/5 px-3 py-1.5 rounded-lg hover:bg-[#3E1E04]/5 w-fit">
              <i class="fa-solid fa-check-double"></i> Tandai semua dibaca
            </button>
          </div>

          {{-- List Notifikasi Promo --}}
          @if (true)
            <div class="space-y-4">

              {{-- ITEM 1: Belum Dibaca (Unread State) - Tema Highlight --}}
              <div
                class="group relative bg-[#FDF7F4] border border-[#BC430D]/20 rounded-xl p-4 sm:p-5 transition-all hover:shadow-md flex flex-col sm:flex-row gap-4 sm:gap-5 overflow-hidden">
                {{-- Indikator Unread (Garis Kiri & Titik) --}}
                <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-[#BC430D]"></div>

                {{-- Ikon Tipe Promo --}}
                <div
                  class="hidden sm:flex flex-shrink-0 items-center justify-center w-12 h-12 bg-white rounded-full border border-[#BC430D]/20 text-[#BC430D] shadow-sm">
                  <i class="fa-solid fa-ticket-simple text-xl"></i>
                </div>

                {{-- Konten Text --}}
                <div class="flex-1">
                  <div class="flex justify-between items-start gap-4">
                    <div>
                      <h3 class="text-base font-bold text-[#3E1E04] font-primary mb-1">Diskon 20% Latte Hari Ini! 🎉</h3>
                      <p class="text-sm text-gray-600 font-secondary mb-3 leading-relaxed">
                        Nikmati sore harimu dengan secangkir Latte hangat. Berlaku khusus hari ini pukul 17.00–19.00.
                        Tunjukkan notifikasi ini ke kasir.
                      </p>
                      <span class="text-xs text-gray-400 font-secondary flex items-center gap-1.5 font-medium">
                        <i class="fa-regular fa-clock"></i> 2 jam yang lalu
                      </span>
                    </div>

                    {{-- Action Buttons --}}
                    <div
                      class="flex items-center gap-1 flex-shrink-0 bg-white sm:bg-transparent rounded-lg p-1 sm:p-0 shadow-sm border border-gray-100 sm:border-none sm:shadow-none absolute top-4 right-4 sm:static">
                      <button type="button"
                        class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-400 hover:text-[#3C6B3E] hover:bg-[#3C6B3E]/10 transition-colors"
                        title="Tandai sudah dibaca">
                        <i class="fa-solid fa-check"></i>
                      </button>
                      <button type="button"
                        class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-400 hover:text-red-500 hover:bg-red-50 transition-colors"
                        title="Hapus notifikasi">
                        <i class="fa-regular fa-trash-can"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>

              {{-- ITEM 2: Belum Dibaca (Unread State) - Flash Sale --}}
              <div
                class="group relative bg-[#FDF7F4] border border-[#BC430D]/20 rounded-xl p-4 sm:p-5 transition-all hover:shadow-md flex flex-col sm:flex-row gap-4 sm:gap-5 overflow-hidden">
                <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-[#BC430D]"></div>

                <div
                  class="hidden sm:flex flex-shrink-0 items-center justify-center w-12 h-12 bg-white rounded-full border border-amber-200 text-amber-500 shadow-sm">
                  <i class="fa-solid fa-bolt text-xl"></i>
                </div>

                <div class="flex-1">
                  <div class="flex justify-between items-start gap-4">
                    <div>
                      <h3 class="text-base font-bold text-[#3E1E04] font-primary mb-1">Flash Sale Akhir Pekan! ⚡</h3>
                      <p class="text-sm text-gray-600 font-secondary mb-3 leading-relaxed">
                        Beli 1 Gratis 1 untuk semua varian Frappuccino. Hanya berlaku hari Sabtu dan Minggu ini. Jangan
                        sampai kehabisan!
                      </p>
                      <span class="text-xs text-gray-400 font-secondary flex items-center gap-1.5 font-medium">
                        <i class="fa-regular fa-clock"></i> 5 jam yang lalu
                      </span>
                    </div>

                    <div
                      class="flex items-center gap-1 flex-shrink-0 bg-white sm:bg-transparent rounded-lg p-1 sm:p-0 shadow-sm border border-gray-100 sm:border-none sm:shadow-none absolute top-4 right-4 sm:static">
                      <button type="button"
                        class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-400 hover:text-[#3C6B3E] hover:bg-[#3C6B3E]/10 transition-colors"
                        title="Tandai sudah dibaca">
                        <i class="fa-solid fa-check"></i>
                      </button>
                      <button type="button"
                        class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-400 hover:text-red-500 hover:bg-red-50 transition-colors"
                        title="Hapus notifikasi">
                        <i class="fa-regular fa-trash-can"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>

              {{-- ITEM 3: Sudah Dibaca (Read State) - Normal --}}
              <div
                class="group relative bg-white border border-[#3E1E04]/10 rounded-xl p-4 sm:p-5 transition-all hover:border-[#3E1E04]/30 flex flex-col sm:flex-row gap-4 sm:gap-5">

                <div
                  class="hidden sm:flex flex-shrink-0 items-center justify-center w-12 h-12 bg-gray-50 rounded-full border border-gray-100 text-gray-400">
                  <i class="fa-solid fa-mug-hot text-xl"></i>
                </div>

                <div class="flex-1 opacity-80 group-hover:opacity-100 transition-opacity">
                  <div class="flex justify-between items-start gap-4">
                    <div>
                      <h3 class="text-base font-medium text-gray-800 font-primary mb-1">Menu Baru: Caramel Macchiato</h3>
                      <p class="text-sm text-gray-500 font-secondary mb-3 leading-relaxed">
                        Rasakan perpaduan sempurna espresso dan manisnya karamel. Sudah tersedia di seluruh cabang kami.
                      </p>
                      <span class="text-xs text-gray-400 font-secondary flex items-center gap-1.5">
                        <i class="fa-regular fa-calendar"></i> Kemarin
                      </span>
                    </div>

                    <div class="flex items-center gap-1 flex-shrink-0 absolute top-4 right-4 sm:static">
                      {{-- Tidak ada tombol check karena sudah dibaca --}}
                      <button type="button"
                        class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-300 hover:text-red-500 hover:bg-red-50 transition-colors"
                        title="Hapus notifikasi">
                        <i class="fa-regular fa-trash-can"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          @else
            {{-- Empty State (Jika tidak ada promo) --}}
            <div class="text-center py-16 px-4">
              <div
                class="w-24 h-24 bg-gray-50 border border-gray-100 rounded-full flex items-center justify-center mx-auto mb-4 relative">
                <i class="fa-solid fa-ticket-simple text-4xl text-gray-300"></i>
              </div>
              <h3 class="text-lg font-bold text-[#3E1E04] font-primary mb-2">Belum Ada Promo</h3>
              <p class="text-sm text-gray-500 font-secondary max-w-sm mx-auto mb-6">
                Saat ini belum ada promo atau penawaran spesial baru untukmu. Nyalakan notifikasi agar tidak ketinggalan
                diskon menarik!
              </p>
              <a href="{{ route('menu.index') }}"
                class="inline-flex items-center gap-2 bg-white border border-[#3E1E04]/20 hover:bg-gray-50 text-[#3E1E04] px-6 py-2.5 rounded-lg transition-colors font-secondary font-medium">
                Kembali ke Menu
              </a>
            </div>
          @endif

        </div>
      </div>

    </div>
  </div>
@endsection
