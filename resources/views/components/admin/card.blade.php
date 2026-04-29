@props(['title' => null, 'subtitle' => null, 'class' => ''])

<div class="bg-white dark:bg-gray-800 rounded-lg shadow {{ $class }}" data-aos="fade-up" data-aos-duration="700">
  @if ($title)
    <div class="px-4 py-6 sm:px-6 border-b border-gray-200 dark:border-gray-700">
      <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">
        {{ $title }}
      </h3>
      @if ($subtitle)
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
          {{ $subtitle }}
        </p>
      @endif
    </div>
  @endif

  <div class="px-4 py-6 sm:px-6">
    {{ $slot }}
  </div>
</div>
