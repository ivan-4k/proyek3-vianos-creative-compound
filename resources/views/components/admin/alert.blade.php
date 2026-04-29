@props(['type' => 'info', 'message' => ''])

@php
  $bgColor = match ($type) {
      'success' => 'bg-green-100 border-green-400 text-green-700',
      'error' => 'bg-red-100 border-red-400 text-red-700',
      'warning' => 'bg-yellow-100 border-yellow-400 text-yellow-700',
      'info' => 'bg-blue-100 border-blue-400 text-blue-700',
  };

  $icon = match ($type) {
      'success'
          => '<svg class="w-5 h-5 mr-2 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>',
      'error'
          => '<svg class="w-5 h-5 mr-2 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l-2-2m0 0l-2-2m2 2l2-2m-2 2l-2 2m6-4l2-2m0 0l2-2m-2 2l2-2m-2 2l-2 2" /></svg>',
      'warning'
          => '<svg class="w-5 h-5 mr-2 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4v2m0 4v2M6.414 7.414l1.414 1.414M4 6l2 2m6-2l2-2m2 6l2-2m0 4l2 2m-2 0l-2 2" /></svg>',
      'info'
          => '<svg class="w-5 h-5 mr-2 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>',
  };
@endphp

<div class="border-l-4 p-4 mb-4 {{ $bgColor }} rounded" role="alert">
  <div class="flex">
    {!! $icon !!}
    <div>
      <p class="font-bold">
        @if ($type === 'success')
          Berhasil
        @elseif ($type === 'error')
          Error
        @elseif ($type === 'warning')
          Peringatan
        @else
          Informasi
        @endif
      </p>
      <p class="text-sm">
        {{ $message ?: $slot }}
      </p>
    </div>
  </div>
</div>
