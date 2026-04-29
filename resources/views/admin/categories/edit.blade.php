@extends('layouts.admin')

@section('content')
  <div class="mb-6">
    <a href="{{ route('admin.categories.index') }}"
      class="flex items-center text-sm font-medium text-blue-600 hover:text-blue-700 dark:text-blue-500 dark:hover:text-blue-400 mb-4">
      <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
      </svg>
      Kembali ke Daftar Kategori
    </a>
    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Edit Kategori</h1>
    <p class="text-sm text-gray-500 dark:text-gray-400">Ubah informasi kategori menu.</p>
  </div>

  <div class="bg-white rounded-2xl shadow-sm border border-gray-100 dark:bg-gray-800 dark:border-gray-700 p-6">
    <form action="{{ route('admin.categories.update', $category->id_kategori) }}" method="POST"
      enctype="multipart/form-data">
      @csrf
      @method('PUT')
      @include('admin.categories.partials._form', ['category' => $category])
      <div class="flex justify-end gap-3 pt-6 border-t border-gray-100 dark:border-gray-700">
        <a href="{{ route('admin.categories.index') }}"
          class="px-5 py-2.5 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-xl hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
          Batal
        </a>
        <button type="submit"
          class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-xl hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 shadow-lg shadow-blue-500/30 transition-all">
          Update Kategori
        </button>
      </div>
    </form>
  </div>
@endsection
