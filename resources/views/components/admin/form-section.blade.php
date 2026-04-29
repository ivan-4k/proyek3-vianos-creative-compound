@props(['title', 'subtitle' => null])

<div class="bg-white dark:bg-gray-800 sm:rounded-lg shadow">
  <div class="px-4 py-6 sm:px-6">
    <div class="mb-6">
      <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">
        {{ $title }}
      </h3>
      @if ($subtitle)
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
          {{ $subtitle }}
        </p>
      @endif
    </div>
    <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
      {{ $slot }}
    </div>
  </div>
</div>
