@extends('layouts.admin')

@section('content')
  <x-admin.card title="Detail WhatsApp Log #{{ $whatsappLog->id_wa_log }}"
    subtitle="Informasi lengkap pengiriman pesan WhatsApp">

    {{-- Header Actions --}}
    <div class="mb-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
      <a href="{{ route('admin.whatsapp-logs.index') }}"
        class="inline-flex items-center text-sm font-medium text-blue-600 hover:text-blue-700 dark:text-blue-500 dark:hover:text-blue-400 transition-colors">
        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        Kembali ke Daftar Log
      </a>

      {{-- Tombol Kirim Ulang --}}
      <form action="{{ route('admin.whatsapp-logs.retry', $whatsappLog->id_wa_log) }}" method="POST" id="retryForm"
        onsubmit="return confirm('Apakah Anda yakin ingin mengirim ulang pesan ini ke nomor {{ $whatsappLog->destination_number }}?')">
        @csrf
        <button type="submit" id="btnRetry"
          class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 transition-all text-sm font-medium shadow-lg shadow-blue-500/30">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
          </svg>
          Kirim Ulang Pesan
        </button>
      </form>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

      {{-- Bagian Kiri: Informasi Meta --}}
      <div class="lg:col-span-1 space-y-6">
        <div class="bg-gray-50 dark:bg-gray-800/50 rounded-2xl p-5 border border-gray-100 dark:border-gray-700">
          <h3
            class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-4 border-b border-gray-200 dark:border-gray-700 pb-2">
            Informasi Pengiriman</h3>

          <dl class="space-y-4">
            <div>
              <dt class="text-xs text-gray-500 dark:text-gray-400 mb-1">Status</dt>
              <dd>
                @php
                  $statusClass = match ($whatsappLog->status) {
                      'sent' => 'bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-400',
                      'failed' => 'bg-red-100 text-red-800 dark:bg-red-900/40 dark:text-red-400',
                      default => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/40 dark:text-yellow-400',
                  };
                @endphp
                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold {{ $statusClass }}">
                  {{ ucfirst($whatsappLog->status) }}
                </span>
              </dd>
            </div>

            <div>
              <dt class="text-xs text-gray-500 dark:text-gray-400 mb-1">Nomor Tujuan</dt>
              <dd class="text-sm font-semibold text-gray-900 dark:text-white">{{ $whatsappLog->destination_number }}</dd>
            </div>

            <div>
              <dt class="text-xs text-gray-500 dark:text-gray-400 mb-1">Tipe Pesan</dt>
              <dd class="text-sm font-medium text-gray-900 dark:text-white capitalize">
                {{ str_replace('_', ' ', $whatsappLog->type) }}</dd>
            </div>

            <div>
              <dt class="text-xs text-gray-500 dark:text-gray-400 mb-1">Waktu Dibuat</dt>
              <dd class="text-sm text-gray-900 dark:text-white">{{ $whatsappLog->created_at->format('d F Y, H:i:s') }}
              </dd>
            </div>

            <div>
              <dt class="text-xs text-gray-500 dark:text-gray-400 mb-1">Terakhir Diupdate</dt>
              <dd class="text-sm text-gray-900 dark:text-white">{{ $whatsappLog->updated_at->format('d F Y, H:i:s') }}
              </dd>
            </div>
          </dl>
        </div>

        <div class="bg-gray-50 dark:bg-gray-800/50 rounded-2xl p-5 border border-gray-100 dark:border-gray-700">
          <h3
            class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-4 border-b border-gray-200 dark:border-gray-700 pb-2">
            Informasi Relasi</h3>

          <dl class="space-y-4">
            <div>
              <dt class="text-xs text-gray-500 dark:text-gray-400 mb-1">Terkait Pesanan</dt>
              <dd>
                @if ($whatsappLog->order)
                  <a href="#" class="text-sm font-semibold text-blue-600 hover:underline dark:text-blue-400">
                    #{{ $whatsappLog->order->id_pesanan }}
                  </a>
                @else
                  <span class="text-sm text-gray-500 italic">Tidak ada (Pesan Umum)</span>
                @endif
              </dd>
            </div>

            <div>
              <dt class="text-xs text-gray-500 dark:text-gray-400 mb-1">Terkait Pengguna</dt>
              <dd>
                @if ($whatsappLog->user)
                  <div class="text-sm font-semibold text-gray-900 dark:text-white">{{ $whatsappLog->user->name }}</div>
                  <div class="text-xs text-gray-500">{{ $whatsappLog->user->email }}</div>
                @else
                  <span class="text-sm text-gray-500 italic">Tidak terikat ke akun pengguna</span>
                @endif
              </dd>
            </div>
          </dl>
        </div>
      </div>

      {{-- Bagian Kanan: Isi Pesan --}}
      <div class="lg:col-span-2">
        <div
          class="bg-white dark:bg-gray-900 rounded-2xl p-6 border border-gray-200 dark:border-gray-700 h-full flex flex-col">
          <h3 class="text-sm font-bold text-gray-800 dark:text-gray-200 mb-4 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="w-5 h-5 text-green-500">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
            </svg>
            Isi Pesan
          </h3>

          {{-- Mockup Chat Bubble --}}
          <div class="flex-grow bg-[#EFEAE2] dark:bg-gray-800 rounded-xl p-4 sm:p-6 overflow-hidden relative">
            {{-- Pattern Background  --}}
            <div class="absolute inset-0 opacity-10"
              style="background-image: url('data:image/svg+xml,%3Csvg width=\'20\' height=\'20\' viewBox=\'0 0 20 20\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'%23000000\' fill-opacity=\'1\' fill-rule=\'evenodd\'%3E%3Ccircle cx=\'3\' cy=\'3\' r=\'3\'/%3E%3Ccircle cx=\'13\' cy=\'13\' r=\'3\'/%3E%3C/g%3E%3C/svg%3E');">
            </div>

            <div
              class="relative bg-white dark:bg-gray-700 rounded-lg rounded-tl-none p-4 shadow-sm max-w-2xl mx-auto md:mx-0 whitespace-pre-wrap font-sans text-sm text-gray-800 dark:text-gray-200 border border-gray-100 dark:border-gray-600 leading-relaxed">
              {{ $whatsappLog->message }}</div>
          </div>
        </div>
      </div>
    </div>
  </x-admin.card>

  @push('scripts')
    <script>
      // Logic untuk mencegah user klik tombol "Kirim Ulang" berkali-kali saat proses loading
      document.getElementById('retryForm').addEventListener('submit', function() {
        const btn = document.getElementById('btnRetry');
        btn.disabled = true;
        btn.innerHTML =
          '<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span> Mengirim...';
      });
    </script>
  @endpush
@endsection
