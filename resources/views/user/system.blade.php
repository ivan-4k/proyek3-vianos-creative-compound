@extends('layouts.app')

@section('title', 'Pemberitahuan Sistem')

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
                <h2 class="text-2xl font-bold text-[#3E1E04] font-primary">Pemberitahuan Sistem</h2>
                {{-- Badge Unread --}}
                @if ($unreadCount > 0)
                  <span
                    class="bg-blue-100 text-blue-700 text-[10px] uppercase tracking-wider font-bold px-2 py-0.5 rounded-full font-secondary">
                    {{ $unreadCount }} Baru
                  </span>
                @endif
              </div>
              <p class="text-sm text-gray-500 mt-1 font-secondary">Informasi penting terkait akun, aktivitas, dan pembaruan
                layanan.</p>
            </header>

            {{-- Tombol Aksi Global --}}
            <button type="button"
              class="text-sm font-medium text-gray-500 hover:text-blue-600 transition-colors font-secondary whitespace-nowrap flex items-center gap-2 bg-gray-50 hover:bg-blue-50 px-3 py-1.5 rounded-lg border border-gray-200 hover:border-blue-200 w-fit">
              <i class="fa-solid fa-check-double"></i> Tandai semua dibaca
            </button>
          </div>

          {{-- Konten Notifikasi Sistem --}}
          <div class="space-y-4">
            @forelse ($systemNotifications as $notification)
              <div
                class="group relative {{ $notification->is_read ? 'bg-white border border-gray-200' : 'bg-[#F0F7FF] border border-blue-200' }} rounded-xl p-4 sm:p-5 transition-all hover:shadow-md flex flex-col sm:flex-row gap-4 sm:gap-5 overflow-hidden">

                {{-- Indikator Unread --}}
                @if (!$notification->is_read)
                  <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-blue-500"></div>
                @endif

                {{-- Ikon Sistem / Status --}}
                <div
                  class="hidden sm:flex flex-shrink-0 items-center justify-center w-12 h-12 {{ $notification->is_read ? 'bg-gray-50 border border-gray-200 text-gray-500' : 'bg-white border border-blue-200 text-blue-600' }} rounded-full shadow-sm">
                  @if (str_contains($notification->type, 'security'))
                    <i class="fa-solid fa-shield-halved text-xl"></i>
                  @elseif (str_contains($notification->message, 'Profil'))
                    <i class="fa-solid fa-user-pen text-xl"></i>
                  @elseif (str_contains($notification->message, 'Layanan') || str_contains($notification->message, 'server'))
                    <i class="fa-solid fa-server text-xl"></i>
                  @else
                    <i class="fa-solid fa-bell text-xl"></i>
                  @endif
                </div>

                <div class="flex-1 {{ $notification->is_read ? 'opacity-75' : '' }}">
                  <div class="flex justify-between items-start gap-4">
                    <div>
                      <h3
                        class="text-base {{ $notification->is_read ? 'font-medium text-gray-800' : 'font-bold text-[#3E1E04]' }} font-primary mb-1">
                        {{ $notification->title }}
                      </h3>
                      <p
                        class="text-sm {{ $notification->is_read ? 'text-gray-500' : 'text-gray-600' }} font-secondary mb-3 leading-relaxed">
                        {{ $notification->message }}
                      </p>
                      <span
                        class="text-xs {{ $notification->is_read ? 'text-gray-400' : 'text-blue-600 font-medium' }} font-secondary flex items-center gap-1.5">
                        <i class="fa-regular {{ $notification->read_at ? 'fa-calendar-check' : 'fa-clock' }}"></i>
                        @if ($notification->read_at)
                          {{ $notification->read_at->format('d M Y, H:i') }}
                        @else
                          {{ $notification->created_at->diffForHumans() }}
                        @endif
                      </span>
                    </div>

                    {{-- Action Buttons --}}
                    @if (!$notification->is_read)
                      <div
                        class="flex items-center gap-1 flex-shrink-0 bg-white sm:bg-transparent rounded-lg p-1 sm:p-0 shadow-sm border border-gray-100 sm:border-none sm:shadow-none absolute top-4 right-4 sm:static">
                        <button type="button"
                          class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-400 hover:text-blue-600 hover:bg-blue-100 transition-colors"
                          title="Tandai sudah dibaca">
                          <i class="fa-solid fa-check"></i>
                        </button>
                      </div>
                    @endif
                  </div>
                </div>
              </div>
            @empty
              <div class="text-center py-20 px-4">
                {{-- Placeholder Ilustrasi (Gunakan tag img jika punya SVG-nya) --}}
                {{-- <img src="{{ asset('images/illustrations/empty-notification.svg') }}" alt="Empty" class="w-64 mx-auto mb-6"> --}}

                {{-- Jika tidak ada gambar, ini adalah alternatif ilustrasi menggunakan ikon --}}
                <div class="relative w-40 h-40 mx-auto mb-6">
                  <div class="absolute inset-0 bg-blue-50 rounded-full animate-pulse opacity-50"></div>
                  <div class="absolute inset-4 bg-blue-100 rounded-full"></div>
                  <div class="absolute inset-0 flex items-center justify-center">
                    <i class="fa-solid fa-envelope-open-text text-6xl text-blue-500"></i>
                    <i
                      class="fa-solid fa-circle-exclamation text-xl text-rose-500 absolute top-8 right-6 bg-white rounded-full border-2 border-white"></i>
                  </div>
                </div>

                <h3 class="text-xl font-bold text-[#3E1E04] font-primary mb-3">Notifikasi Kosong</h3>
                <p class="text-sm text-gray-500 font-secondary max-w-sm mx-auto mb-8">
                  Notifikasi akan muncul di sini ketika ada aktivitas baru terkait akun atau layananmu.
                </p>

                <a href="{{ route('profile.edit') }}"
                  class="inline-flex items-center gap-2 bg-white border border-[#3E1E04]/20 hover:bg-gray-50 text-[#3E1E04] px-6 py-2.5 rounded-lg transition-colors font-secondary font-medium">
                  Cek Pengaturan Akun
                </a>
              </div>
            @endforelse
          </div>

        </div>
      </div>

    </div>
  </div>
@endsection
