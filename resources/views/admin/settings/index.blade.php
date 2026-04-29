@extends('layouts.admin')

@section('content')
  <x-admin.card title="Pengaturan Kafe" subtitle="Konfigurasi identitas, operasional, dan tampilan sistem Anda">

    {{-- Alert Messages --}}
    @if (session('success'))
      <div
        class="mb-6 p-4 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-2xl flex items-center gap-3">
        <div class="p-1 bg-green-500 rounded-full">
          <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
          </svg>
        </div>
        <p class="text-sm font-semibold text-green-800 dark:text-green-300">{{ session('success') }}</p>
      </div>
    @endif

    {{-- Tab Navigation --}}
    <div class="mb-8 border-b border-gray-100 dark:border-gray-700 overflow-x-auto whitespace-nowrap">
      <nav class="flex gap-6">
        @php
          $tabs = [
              [
                  'id' => 'general',
                  'label' => 'Umum',
                  'icon' => 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
              ],
              ['id' => 'operating', 'label' => 'Jam Kerja', 'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
              [
                  'id' => 'contact',
                  'label' => 'Kontak',
                  'icon' =>
                      'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
              ],
              [
                  'id' => 'social',
                  'label' => 'Sosial Media',
                  'icon' =>
                      'M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z',
              ],
              [
                  'id' => 'branding',
                  'label' => 'Branding',
                  'icon' =>
                      'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z',
              ],
          ];
        @endphp

        @foreach ($tabs as $tab)
          <button data-tab="{{ $tab['id'] }}"
            class="tab-link {{ $loop->first ? 'active' : '' }} py-4 border-b-2 font-bold text-sm transition-all flex items-center gap-2 text-gray-400 dark:text-gray-500 border-transparent hover:text-gray-700 dark:hover:text-gray-300">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $tab['icon'] }}"></path>
            </svg>
            {{ $tab['label'] }}
          </button>
        @endforeach
      </nav>
    </div>

    {{-- Content --}}
    <div class="tab-content text-gray-900 dark:text-gray-100">

      {{-- Form Helper untuk Input Class --}}
      @php $inputClass = "w-full bg-gray-50 dark:bg-gray-700/50 border-gray-200 dark:border-gray-600 rounded-xl focus:ring-blue-500 focus:border-blue-500 dark:text-white transition-colors"; @endphp

      <div id="general" class="tab-pane active">
        <form action="{{ route('admin.settings.updateGeneral') }}" method="POST" class="max-w-3xl space-y-6">
          @csrf @method('PUT')
          <div>
            <label class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase mb-2">Nama Kafe</label>
            <input type="text" name="store_name" value="{{ $settings['store_name'] }}" class="{{ $inputClass }}">
          </div>
          <div>
            <label class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase mb-2">Deskripsi</label>
            <textarea name="store_description" rows="4" class="{{ $inputClass }}">{{ $settings['store_description'] }}</textarea>
          </div>
          <button type="submit"
            class="px-6 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 transition-all font-bold shadow-lg shadow-blue-600/20">Simpan
            Perubahan</button>
        </form>
      </div>

      <div id="operating" class="tab-pane hidden">
        <form action="{{ route('admin.settings.updateOperatingHours') }}" method="POST" class="max-w-3xl space-y-8">
          @csrf @method('PUT')
          <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="space-y-4">
              <h4 class="font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
                <span class="w-2 h-2 bg-blue-500 rounded-full"></span> Weekday (Sen-Jum)
              </h4>
              <div class="flex gap-4">
                <input type="time" name="weekday_opening"
                  value="{{ substr($cafeSetting->weekday_opening_time ?? '09:00', 0, 5) }}" class="{{ $inputClass }}">
                <input type="time" name="weekday_closing"
                  value="{{ substr($cafeSetting->weekday_closing_time ?? '22:00', 0, 5) }}" class="{{ $inputClass }}">
              </div>
            </div>
            <div class="space-y-4">
              <h4 class="font-bold text-gray-800 dark:text-gray-200 flex items-center gap-2">
                <span class="w-2 h-2 bg-orange-500 rounded-full"></span> Weekend (Sab-Min)
              </h4>
              <div class="flex gap-4">
                <input type="time" name="weekend_opening"
                  value="{{ substr($cafeSetting->weekend_opening_time ?? '08:00', 0, 5) }}" class="{{ $inputClass }}">
                <input type="time" name="weekend_closing"
                  value="{{ substr($cafeSetting->weekend_closing_time ?? '23:00', 0, 5) }}" class="{{ $inputClass }}">
              </div>
            </div>
          </div>
          <div
            class="p-4 bg-blue-50 dark:bg-blue-900/20 rounded-2xl border border-blue-100 dark:border-blue-800/50 flex gap-6">
            <label class="flex items-center gap-3 cursor-pointer group">
              <input type="checkbox" name="is_open" value="1" {{ $cafeSetting->is_open ? 'checked' : '' }}
                class="rounded text-blue-600 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600">
              <span class="text-sm font-bold text-blue-900 dark:text-blue-300">Kafe Buka</span>
            </label>
            <label class="flex items-center gap-3 cursor-pointer group">
              <input type="checkbox" name="is_order_open" value="1"
                {{ $cafeSetting->is_order_open ? 'checked' : '' }}
                class="rounded text-blue-600 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600">
              <span class="text-sm font-bold text-blue-900 dark:text-blue-300">Penerimaan Pesanan</span>
            </label>
          </div>
          <button type="submit"
            class="px-6 py-2 bg-blue-600 text-white rounded-xl font-bold shadow-lg shadow-blue-600/20">Simpan Jam
            Kerja</button>
        </form>
      </div>

      <div id="contact" class="tab-pane hidden">
        <form action="{{ route('admin.settings.updateContact') }}" method="POST" class="max-w-3xl space-y-6">
          @csrf @method('PUT')
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase mb-2">Email Bisnis</label>
              <input type="email" name="store_email" value="{{ $settings['store_email'] }}"
                class="{{ $inputClass }}">
            </div>
            <div>
              <label class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase mb-2">No. Telepon</label>
              <input type="text" name="store_phone" value="{{ $settings['store_phone'] }}"
                class="{{ $inputClass }}">
            </div>
          </div>
          <div>
            <label class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase mb-2">Alamat Fisik</label>
            <textarea name="store_address" rows="3" class="{{ $inputClass }}">{{ $settings['store_address'] }}</textarea>
          </div>
          <button type="submit"
            class="px-6 py-2 bg-blue-600 text-white rounded-xl font-bold shadow-lg shadow-blue-600/20">Simpan
            Kontak</button>
        </form>
      </div>

      <div id="social" class="tab-pane hidden">
        <form action="{{ route('admin.settings.updateSocial') }}" method="POST" class="max-w-3xl space-y-6">
          @csrf @method('PUT')
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach (['instagram' => 'Instagram URL', 'facebook' => 'Facebook URL', 'tiktok' => 'TikTok URL', 'whatsapp' => 'WhatsApp Bisnis'] as $key => $label)
              <div>
                <label
                  class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase mb-2">{{ $label }}</label>
                <input type="{{ in_array($key, ['whatsapp']) ? 'text' : 'url' }}" name="{{ $key }}"
                  value="{{ $settings[$key] }}" placeholder="{{ $key === 'whatsapp' ? '628...' : 'https://...' }}"
                  class="{{ $inputClass }}">
              </div>
            @endforeach
          </div>
          <button type="submit"
            class="px-6 py-2 bg-blue-600 text-white rounded-xl font-bold shadow-lg shadow-blue-600/20">Simpan
            Sosmed</button>
        </form>
      </div>

      <div id="branding" class="tab-pane hidden">
        <form action="{{ route('admin.settings.updateBranding') }}" method="POST" enctype="multipart/form-data"
          class="max-w-3xl space-y-8">
          @csrf @method('PUT')

          <div
            class="p-6 bg-gray-50 dark:bg-gray-800/50 rounded-2xl border border-gray-100 dark:border-gray-700 flex flex-col md:flex-row items-center gap-8 transition-colors">
            <div
              class="w-32 h-32 bg-white dark:bg-gray-700 rounded-xl border border-gray-200 dark:border-gray-600 p-2 flex items-center justify-center shadow-sm">
              <img src="{{ asset($settings['logo']) }}" class="max-h-full max-w-full object-contain">
            </div>
            <div class="flex-1">
              <label class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase mb-2">Logo Utama
                Kafe</label>
              <input type="file" name="logo"
                class="block w-full text-xs text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-blue-600 file:text-white hover:file:bg-blue-700 transition-all cursor-pointer">
              <p class="mt-2 text-[10px] text-gray-400 dark:text-gray-500 font-medium italic">PNG/SVG Transparan (Max
                2MB)</p>
            </div>
          </div>

          <div
            class="p-6 bg-gray-50 dark:bg-gray-800/50 rounded-2xl border border-gray-100 dark:border-gray-700 flex flex-col md:flex-row items-center gap-8 transition-colors">
            <div
              class="w-16 h-16 bg-white dark:bg-gray-700 rounded-lg border border-gray-200 dark:border-gray-600 p-1 flex items-center justify-center shadow-sm">
              <img src="{{ asset($settings['favicon']) }}" class="w-8 h-8 object-contain">
            </div>
            <div class="flex-1">
              <label class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase mb-2">Favicon (Ikon
                Browser)</label>
              <input type="file" name="favicon"
                class="block w-full text-xs text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:bg-blue-600 file:text-white hover:file:bg-blue-700 transition-all cursor-pointer">
              <p class="mt-2 text-[10px] text-gray-400 dark:text-gray-500 font-medium italic">.ico atau .png 32x32px (Max
                1MB)</p>
            </div>
          </div>

          <button type="submit"
            class="px-6 py-2 bg-blue-600 text-white rounded-xl font-bold shadow-lg shadow-blue-600/20">Simpan
            Branding</button>
        </form>
      </div>

    </div>
  </x-admin.card>

  @push('scripts')
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const hash = window.location.hash.substring(1);

        function switchTab(tabId) {
          if (!tabId) return;
          document.querySelectorAll('.tab-link').forEach(link => {
            const isActive = link.getAttribute('data-tab') === tabId;
            link.classList.toggle('active', isActive);
            // Tailwind class toggle manual untuk JS
            if (isActive) {
              link.classList.add('border-blue-600', 'text-blue-600', 'dark:text-blue-400');
              link.classList.remove('border-transparent', 'text-gray-400', 'dark:text-gray-500');
            } else {
              link.classList.remove('border-blue-600', 'text-blue-600', 'dark:text-blue-400');
              link.classList.add('border-transparent', 'text-gray-400', 'dark:text-gray-500');
            }
          });
          document.querySelectorAll('.tab-pane').forEach(pane => {
            pane.classList.toggle('hidden', pane.id !== tabId);
          });
        }

        if (hash) switchTab(hash);

        document.querySelectorAll('.tab-link').forEach(link => {
          link.addEventListener('click', function() {
            const target = this.getAttribute('data-tab');
            window.location.hash = target;
            switchTab(target);
          });
        });
      });
    </script>
  @endpush
@endsection
