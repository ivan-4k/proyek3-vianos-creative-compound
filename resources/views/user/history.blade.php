@extends('layouts.app')

@section('title', 'Riwayat Pesanan')

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

          {{-- Header & Tabs --}}
          <div
            class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6 lg:mb-8 border-b border-[#3E1E04]/10 pb-4">
            <header>
              <h2 class="text-2xl font-bold text-[#3E1E04] font-primary">Riwayat Pesanan</h2>
              <p class="text-sm text-gray-500 mt-1 font-secondary">Daftar menu yang pernah kamu kirim untuk dipesan melalui
                WhatsApp.</p>
            </header>

            {{-- Tab Navigasi --}}
            <div
              class="flex items-center bg-gray-50 rounded-lg p-1 border border-gray-200 font-secondary overflow-x-auto shrink-0">
              <button
                class="px-4 py-1.5 bg-[#F4EFEA] text-[#3E1E04] font-semibold rounded-md text-sm shadow-sm transition-colors whitespace-nowrap">
                Semua
              </button>
              <button
                class="px-4 py-1.5 text-gray-500 font-medium rounded-md text-sm hover:text-gray-700 transition-colors whitespace-nowrap">
                Minggu Ini
              </button>
              <button
                class="px-4 py-1.5 text-gray-500 font-medium rounded-md text-sm hover:text-gray-700 transition-colors whitespace-nowrap">
                Bulan Ini
              </button>
            </div>
          </div>

          {{-- List Riwayat Pesanan --}}
          @if (true)
            <div class="space-y-4">

              {{-- Card 1: Multi Item Detail --}}
              <div
                class="border border-[#3E1E04]/10 rounded-xl p-5 hover:border-[#BC430D]/30 transition-all duration-300 hover:shadow-md bg-white">
                <div class="flex flex-col md:flex-row justify-between gap-4">
                  {{-- Kiri: Detail Pesanan --}}
                  <div>
                    <div class="flex items-center gap-2 text-sm text-gray-500 font-secondary mb-2">
                      <i class="fa-regular fa-calendar"></i>
                      <span>12 Februari 2026 • 14:32</span>
                    </div>

                    <span
                      class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-[#E8F5E9] text-[#2E7D32] text-xs font-semibold font-secondary border border-[#A5D6A7]/50 mb-4">
                      <i class="fa-brands fa-whatsapp text-sm"></i>
                      Dikirim ke WhatsApp
                    </span>

                    <div class="text-sm font-secondary space-y-1.5">
                      <div class="font-medium text-[#3E1E04] mb-2 flex items-center gap-2">
                        ☕ <span>2 Item</span>
                      </div>
                      <div class="flex items-center gap-2 text-gray-600">
                        🍦 <span>Iced Latte</span>
                      </div>
                      <div class="flex items-center gap-2 text-gray-600">
                        🥐 <span>Croissant</span>
                      </div>
                    </div>
                  </div>

                  {{-- Kanan: Harga & Aksi --}}
                  <div
                    class="flex flex-col justify-end items-start md:items-end mt-2 md:mt-0 pt-4 md:pt-0 border-t md:border-0 border-gray-100">
                    <div class="text-lg font-bold text-[#3E1E04] font-primary mb-3">Rp 45.000</div>
                    <div class="flex flex-wrap items-center gap-2 w-full md:w-auto">
                      <button
                        class="flex-1 md:flex-none bg-[#4A3219] hover:bg-[#BC430D] text-white px-5 py-2 rounded-lg text-sm font-semibold transition-colors font-secondary text-center shadow-sm">
                        Pesan Lagi
                      </button>
                      <button
                        class="flex-1 md:flex-none bg-gray-100 hover:bg-gray-200 text-gray-700 px-5 py-2 rounded-lg text-sm font-medium transition-colors font-secondary text-center">
                        Lihat Detail
                      </button>
                    </div>
                  </div>
                </div>
              </div>

              {{-- Card 2: Single Item --}}
              <div
                class="border border-[#3E1E04]/10 rounded-xl p-5 hover:border-[#BC430D]/30 transition-all duration-300 hover:shadow-md bg-white">
                <div class="flex flex-col md:flex-row justify-between gap-4">
                  {{-- Kiri: Detail Pesanan --}}
                  <div>
                    <div class="flex items-center gap-2 text-sm text-gray-500 font-secondary mb-2">
                      <i class="fa-regular fa-calendar"></i>
                      <span>10 Februari 2026 • 09:15</span>
                    </div>

                    <span
                      class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-[#E8F5E9] text-[#2E7D32] text-xs font-semibold font-secondary border border-[#A5D6A7]/50 mb-4">
                      <i class="fa-brands fa-whatsapp text-sm"></i>
                      Dikirim ke WhatsApp
                    </span>

                    <div class="text-sm font-secondary space-y-1.5">
                      <div class="font-medium text-[#3E1E04] mb-2 flex items-center gap-2">
                        ☕ <span>1 Item</span>
                      </div>
                      <div class="flex items-center gap-2 text-gray-600">
                        ☕ <span>Cappuccino</span>
                      </div>
                    </div>
                  </div>

                  {{-- Kanan: Harga & Aksi --}}
                  <div
                    class="flex flex-col justify-end items-start md:items-end mt-2 md:mt-0 pt-4 md:pt-0 border-t md:border-0 border-gray-100">
                    <div class="text-lg font-bold text-[#3E1E04] font-primary mb-3">Rp 24.000</div>
                    <div class="flex flex-wrap items-center gap-2 w-full md:w-auto">
                      <button
                        class="flex-1 md:flex-none bg-[#4A3219] hover:bg-[#BC430D] text-white px-5 py-2 rounded-lg text-sm font-semibold transition-colors font-secondary text-center shadow-sm">
                        Pesan Lagi
                      </button>
                      <button
                        class="flex-1 md:flex-none bg-gray-100 hover:bg-gray-200 text-gray-700 px-5 py-2 rounded-lg text-sm font-medium transition-colors font-secondary text-center">
                        Lihat Detail
                      </button>
                    </div>
                  </div>
                </div>
              </div>

              {{-- Card 3: Multi Item Summarized --}}
              <div
                class="border border-[#3E1E04]/10 rounded-xl p-5 hover:border-[#BC430D]/30 transition-all duration-300 hover:shadow-md bg-white">
                <div class="flex flex-col md:flex-row justify-between gap-4">
                  {{-- Kiri: Detail Pesanan --}}
                  <div>
                    <div class="flex items-center gap-2 text-sm text-gray-500 font-secondary mb-2">
                      <i class="fa-regular fa-calendar"></i>
                      <span>08 Februari 2026 • 07:45</span>
                    </div>

                    <span
                      class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-[#E8F5E9] text-[#2E7D32] text-xs font-semibold font-secondary border border-[#A5D6A7]/50 mb-4">
                      <i class="fa-brands fa-whatsapp text-sm"></i>
                      Dikirim ke WhatsApp
                    </span>

                    <div class="text-sm font-secondary space-y-1.5">
                      <div class="flex items-center gap-2 text-gray-800 font-medium">
                        ☕ <span>Americano, Cheese Croissant, +1 lainnya</span>
                      </div>
                      <div class="flex items-center gap-2 text-gray-500 text-xs">
                        🍵 <span>Dipesan untuk makan di tempat</span> {{-- Contoh variasi teks --}}
                      </div>
                    </div>
                  </div>

                  {{-- Kanan: Harga & Aksi --}}
                  <div
                    class="flex flex-col justify-end items-start md:items-end mt-2 md:mt-0 pt-4 md:pt-0 border-t md:border-0 border-gray-100">
                    <div class="text-lg font-bold text-[#3E1E04] font-primary mb-3">Rp 59.000</div>
                    <div class="flex flex-wrap items-center gap-2 w-full md:w-auto">
                      <button
                        class="flex-1 md:flex-none bg-[#4A3219] hover:bg-[#BC430D] text-white px-5 py-2 rounded-lg text-sm font-semibold transition-colors font-secondary text-center shadow-sm">
                        Pesan Lagi
                      </button>
                      <button
                        class="flex-1 md:flex-none bg-gray-100 hover:bg-gray-200 text-gray-700 px-5 py-2 rounded-lg text-sm font-medium transition-colors font-secondary text-center">
                        Lihat Detail
                      </button>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          @else
            {{-- Empty State (Jika riwayat pesanan kosong) --}}
            <div class="text-center py-16 px-4">
              <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fa-solid fa-receipt text-4xl text-gray-400"></i>
              </div>
              <h3 class="text-lg font-bold text-[#3E1E04] font-primary mb-2">Belum Ada Pesanan</h3>
              <p class="text-sm text-gray-500 font-secondary max-w-sm mx-auto mb-6">
                Riwayat pesananmu masih kosong. Yuk, pesan kopi dan camilan favoritmu sekarang!
              </p>
              <a href="{{ route('menu.index') }}"
                class="inline-flex items-center gap-2 bg-[#BC430D] hover:bg-[#3E1E04] text-white px-6 py-2.5 rounded-lg transition-colors font-secondary font-medium shadow-sm">
                <i class="fa-solid fa-cart-plus"></i>
                Mulai Pesan
              </a>
            </div>
          @endif

        </div>
      </div>

    </div>
  </div>
@endsection
