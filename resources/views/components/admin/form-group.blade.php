@props(['label', 'error' => null, 'required' => false, 'name' => ''])

<div class="mb-6">
  @if ($label)
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-900 dark:text-white mb-2">
      {{ $label }}
      @if ($required)
        <span class="text-red-500">*</span>
      @endif
    </label>
  @endif

  <div>
    {{ $slot }}
  </div>

  @if ($error)
    <p class="mt-1 text-sm text-red-600 dark:text-red-400">
      {{ $error }}
    </p>
  @endif
</div>
