@props(['route', 'placeholder' => 'Cari...', 'currentSearch' => ''])

<form method="GET" action="{{ $route }}" class="mb-4">
  <div class="flex gap-2">
    <input type="text" name="search" value="{{ $currentSearch }}" placeholder="{{ $placeholder }}"
      class="flex-1 px-4 py-2 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
    <button type="submit"
      class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
      Cari
    </button>
    @if ($currentSearch)
      <a href="{{ $route }}"
        class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
        Reset
      </a>
    @endif
  </div>

  {{ $slot }}
</form>
