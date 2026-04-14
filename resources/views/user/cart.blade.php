@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">
    <div class="flex flex-col lg:flex-row gap-6 lg:gap-8 mt-12">

      {{-- Sidebar Component --}}
      <div class="w-full lg:w-80 flex-shrink-0">
        <x-sidebar />
      </div>

      {{-- Main Content --}}
      <div class="flex-1 space-y-6">
        <div class="bg-white rounded-xl shadow-sm border border-[#3E1E04]/10 p-6">

          {{-- Header --}}
          <header class="mb-6">
            <h2 class="text-xl font-bold text-[#3E1E04] font-primary">Keranjang Belanja</h2>
            <p class="text-sm text-gray-500 mt-1 font-secondary">Periksa kembali pesananmu sebelum dikirim ke WhatsApp.</p>
          </header>

          {{-- Tab Navigasi --}}
          <div class="flex flex-wrap items-center gap-2 mb-6 font-secondary">
            <button
              class="px-4 py-2 bg-[#F4EFEA] text-[#3E1E04] font-semibold rounded-lg text-sm border border-[#E8E1D5] transition-colors">
              Semua
            </button>
            <button
              class="px-4 py-2 bg-white text-gray-600 font-medium rounded-lg text-sm border border-gray-200 hover:bg-gray-50 transition-colors">
              Minggu Ini
            </button>
            <button
              class="px-4 py-2 bg-white text-gray-600 font-medium rounded-lg text-sm border border-gray-200 hover:bg-gray-50 transition-colors">
              Bulan ini
            </button>
          </div>

          {{-- Pengecekan Kondisi Keranjang --}}
          @if ($carts->isNotEmpty())
            <div class="flex flex-col lg:flex-row gap-6">

              {{-- Daftar Pesanan (Kiri) --}}
              <div class="flex-1 space-y-4 min-w-0">

                @foreach ($carts as $cart)
                  <div class="border border-gray-200 rounded-xl p-4 transition-all hover:border-[#3E1E04]/30">
                    <div class="flex gap-4">
                      {{-- Gambar Produk --}}
                      <div class="w-20 h-20 flex-shrink-0 bg-gray-100 rounded-lg overflow-hidden border border-gray-200">
                        <img src="{{ asset('images/default/' . ($cart->product->image ?? 'default.jpg')) }}"
                          alt="{{ $cart->product->name ?? 'Produk' }}" class="w-full h-full object-cover">
                      </div>

                      {{-- Detail Info --}}
                      <div class="flex-1">
                        <div class="flex justify-between items-start">
                          <div>
                            <h3 class="font-bold text-lg text-[#3E1E04] font-primary">
                              {{ $cart->product->name ?? 'Produk' }}
                            </h3>
                            <p class="text-sm text-gray-600 font-secondary mt-0.5">Rp
                              {{ number_format($cart->product->price ?? 0, 0, ',', '.') }}</p>
                          </div>
                          <p class="font-bold text-[#3E1E04] font-secondary">Rp
                            {{ number_format(($cart->product->price ?? 0) * $cart->quantity, 0, ',', '.') }}</p>
                        </div>

                        {{-- Kuantitas Control --}}
                        <div class="mt-3 flex items-center justify-between">
                          <div class="inline-flex items-center border border-gray-200 rounded-lg bg-white">
                            <button type="button"
                              class="px-3 py-1 text-sm font-medium text-gray-600 hover:text-[#3E1E04]">-</button>
                            <span
                              class="px-4 py-1 text-sm font-medium text-[#3E1E04] font-secondary border-x border-gray-200">{{ $cart->quantity }}</span>
                            <button type="button"
                              class="px-3 py-1 text-sm font-medium text-gray-600 hover:text-[#3E1E04]">+</button>
                          </div>

                          {{-- Tombol Hapus --}}
                          <button
                            class="text-gray-400 hover:text-red-500 transition-colors text-sm font-secondary flex items-center gap-1.5">
                            <i class="fa-regular fa-trash-can"></i> Hapus
                          </button>
                        </div>
                      </div>
                    </div>

                    {{-- Input Catatan --}}
                    <div class="mt-4 pt-4 border-t border-gray-100 flex items-center gap-3 font-secondary">
                      <label for="catatan_{{ $cart->id_keranjang }}" class="text-sm text-gray-500 whitespace-nowrap"><i
                          class="fa-regular fa-pen-to-square mr-1"></i> Catatan:</label>
                      <input type="text" id="catatan_{{ $cart->id_keranjang }}" value="{{ $cart->notes }}"
                        placeholder="Tambahkan catatan..."
                        class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border-0 focus:ring-1 focus:ring-[#BC430D] px-3 py-1.5 transition-colors">
                    </div>
                  </div>
                @endforeach
              </div>

              {{-- Ringkasan Pesanan (Kanan) --}}
              <div class="w-full lg:w-[280px] xl:w-[320px] flex-shrink-0">
                <div class="bg-[#F9F8F6] rounded-xl border border-[#3E1E04]/10 p-5 sticky top-6">
                  <h3 class="text-lg font-bold text-[#3E1E04] mb-5 font-primary">Ringkasan Pesanan</h3>

                  <div class="space-y-3 mb-6 font-secondary text-sm">
                    <div class="text-gray-600 font-medium">{{ $carts->count() }} Item</div>

                    <div class="flex justify-between items-center">
                      <span class="text-gray-600">Subtotal</span>
                      <span class="font-semibold text-[#3E1E04]">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>

                    <div class="flex justify-between items-center">
                      <span class="text-gray-600">Biaya Layanan</span>
                      <span class="font-semibold text-[#3E1E04]">-</span>
                    </div>
                  </div>

                  <hr class="border-[#3E1E04]/10 mb-5">

                  <div class="flex justify-between items-center mb-6">
                    <span class="font-medium text-gray-600 font-secondary text-sm">Total Estimasi</span>
                    <span class="text-xl font-bold text-[#3E1E04] font-primary">Rp
                      {{ number_format($total, 0, ',', '.') }}</span>
                  </div>

                  <button type="button"
                    class="w-full bg-[#3C6B3E] hover:bg-[#2A4D2B] text-white font-medium py-2.5 px-4 rounded-xl flex items-center justify-center gap-2 transition-colors shadow-sm font-secondary">
                    <i class="fa-brands fa-whatsapp text-lg"></i>
                    Kirim ke WhatsApp
                  </button>

                  <p class="text-center text-xs text-gray-500 mt-4 font-secondary leading-relaxed">
                    Pesanan akan dikirim ke WhatsApp<br>untuk konfirmasi lebih lanjut.
                  </p>
                </div>
              </div>

            </div>
          @else
            {{-- Kondisi Saat Keranjang Kosong --}}
            <div
              class="flex flex-col items-center justify-center py-16 px-4 text-center border-2 border-dashed border-gray-200 rounded-xl bg-gray-50/50">
              <div
                class="w-20 h-20 bg-white rounded-full flex items-center justify-center mb-4 shadow-sm border border-gray-100">
                <i class="fa-solid fa-cart-shopping text-3xl text-gray-400"></i>
              </div>
              <h3 class="text-xl font-bold text-[#3E1E04] font-primary mb-2">Keranjangmu masih kosong</h3>
              <p class="text-gray-500 font-secondary mb-6 text-sm max-w-sm">
                Sepertinya kamu belum menambahkan produk apa pun ke keranjang. Yuk, jelajahi produk kami dan temukan yang
                kamu suka!
              </p>
              <a href="{{ url('/menu') }}"
                class="px-6 py-2.5 bg-[#3E1E04] hover:bg-[#2A1402] text-white font-medium rounded-xl transition-colors font-secondary text-sm shadow-sm inline-flex items-center gap-2">
                <i class="fa-solid fa-bag-shopping"></i> Mulai Belanja
              </a>
            </div>
          @endif

        </div>
      </div>

    </div>
  </div>
@endsection