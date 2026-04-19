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
          <div class="space-y-4">
            @forelse ($orders as $order)
              @php
                // Mapping Warna dan Label untuk Order Status
                $statusColors = [
                    'pending_confirmation' => 'bg-yellow-50 text-yellow-700 border-yellow-200',
                    'processing' => 'bg-blue-50 text-blue-700 border-blue-200',
                    'ready_for_pickup' => 'bg-indigo-50 text-indigo-700 border-indigo-200',
                    'completed' => 'bg-green-50 text-green-700 border-green-200',
                    'cancelled' => 'bg-red-50 text-red-700 border-red-200',
                ];
                $statusLabels = [
                    'pending_confirmation' => 'Menunggu Konfirmasi',
                    'processing' => 'Sedang Diproses',
                    'ready_for_pickup' => 'Siap Diambil',
                    'completed' => 'Selesai',
                    'cancelled' => 'Dibatalkan',
                ];

                // Mapping untuk Payment Status
                $paymentColors = [
                    'pending' => 'text-yellow-600',
                    'paid' => 'text-green-600',
                    'failed' => 'text-red-600',
                    'refunded' => 'text-gray-600',
                ];
                $paymentLabels = [
                    'pending' => 'Belum Dibayar',
                    'paid' => 'Lunas',
                    'failed' => 'Gagal',
                    'refunded' => 'Dikembalikan',
                ];

                $currentStatusColor = $statusColors[$order->order_status] ?? 'bg-gray-50 text-gray-700 border-gray-200';
                $currentStatusLabel = $statusLabels[$order->order_status] ?? 'Unknown';
              @endphp

              <div
                class="border border-[#3E1E04]/10 rounded-xl p-5 hover:border-[#BC430D]/30 transition-all duration-300 hover:shadow-md bg-white">
                <div class="flex flex-col md:flex-row justify-between gap-4">

                  {{-- Kiri: Detail Pesanan --}}
                  <div class="flex-1">
                    <div class="flex flex-wrap items-center gap-3 text-sm text-gray-500 font-secondary mb-3">
                      {{-- Kode Pesanan --}}
                      <span class="font-bold text-[#3E1E04]">#{{ $order->order_code }}</span>
                      <span class="text-gray-300">|</span>
                      {{-- Tanggal --}}
                      <div class="flex items-center gap-1.5">
                        <i class="fa-regular fa-calendar"></i>
                        <span>{{ $order->created_at->format('d M Y • H:i') }}</span>
                      </div>
                    </div>

                    {{-- Badge Status Dinamis --}}
                    <div class="flex flex-wrap gap-2 mb-4">
                      <span
                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold font-secondary border {{ $currentStatusColor }}">
                        {{ $currentStatusLabel }}
                      </span>

                      {{-- Status Pembayaran --}}
                      <span
                        class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold font-secondary border border-gray-100 bg-gray-50 {{ $paymentColors[$order->payment_status] ?? 'text-gray-600' }}">
                        <i class="fa-solid fa-wallet mr-1.5"></i>
                        {{ $paymentLabels[$order->payment_status] ?? 'Unknown' }}
                      </span>
                    </div>

                    <div class="text-sm font-secondary space-y-1.5">
                      <div class="font-medium text-[#3E1E04] mb-2 flex items-center gap-2">
                        ☕ <span>{{ $order->items->count() }} Macam Menu</span>
                      </div>

                      {{-- Tampilkan Item --}}
                      @foreach ($order->items->take(2) as $item)
                        <div class="flex items-center gap-2 text-gray-600">
                          <span class="font-medium">{{ $item->quantity }}x</span>
                          <span>{{ $item->product->name ?? ($item->product_name_snapshot ?? 'Produk tidak tersedia') }}</span>
                        </div>
                      @endforeach

                      {{-- Tampilkan pesan jika ada lebih dari 2 item --}}
                      @if ($order->items->count() > 2)
                        <div class="flex items-center gap-2 text-gray-400 text-xs mt-1">
                          <span>+{{ $order->items->count() - 2 }} menu lainnya...</span>
                        </div>
                      @endif
                    </div>
                  </div>

                  {{-- Kanan: Harga & Aksi --}}
                  <div
                    class="flex flex-col justify-end items-start md:items-end mt-2 md:mt-0 pt-4 md:pt-0 border-t md:border-0 border-gray-100 min-w-[200px]">
                    <div class="text-sm text-gray-500 font-secondary mb-1">Total Belanja</div>
                    <div class="text-lg font-bold text-[#3E1E04] font-primary mb-4">
                      Rp {{ number_format($order->total, 0, ',', '.') }}
                    </div>

                    <div class="flex flex-wrap items-center gap-2 w-full md:w-auto mt-auto">
                      <button
                        class="flex-1 md:flex-none bg-[#4A3219] hover:bg-[#BC430D] text-white px-5 py-2 rounded-lg text-sm font-semibold transition-colors duration-300 font-secondary text-center shadow-sm">
                        Pesan Lagi
                      </button>
                      <button
                        class="flex-1 md:flex-none bg-gray-100 hover:bg-gray-200 text-gray-700 px-5 py-2 rounded-lg text-sm font-medium transition-colors font-secondary text-center">
                        Detail
                      </button>
                    </div>
                  </div>

                </div>
              </div>
            @empty
              <div class="text-center py-16 px-4">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                  <i class="fa-solid fa-receipt text-4xl text-gray-400"></i>
                </div>
                <h3 class="text-lg font-bold text-[#3E1E04] font-primary mb-2">Belum Ada Pesanan</h3>
                <p class="text-sm text-gray-500 font-secondary max-w-sm mx-auto mb-6">
                  Riwayat pesananmu masih kosong. Yuk, pesan kopi dan camilan favoritmu sekarang!
                </p>
                <a href="{{ route('menu.index') }}"
                  class="inline-flex items-center gap-2 bg-[#BC430D] hover:bg-[#3E1E04] text-white px-6 py-2.5 rounded-lg transition-colors duration-300 font-secondary font-medium shadow-sm">
                  <i class="fa-solid fa-cart-plus"></i>
                  Mulai Pesan
                </a>
              </div>
            @endforelse
          </div>

        </div>
      </div>

    </div>
  </div>
@endsection
