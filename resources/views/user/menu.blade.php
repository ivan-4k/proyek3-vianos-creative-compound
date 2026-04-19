@extends('layouts.app')

@section('title', 'Menu')

@section('content')
  {{-- logika favorit --}}
  <x-favorite-manager :userFavorites="$userFavorites ?? []">

    {{-- Hero Section --}}
    <x-menu.menu-hero-section />

    {{-- Category Section --}}
    <x-menu.category-section :categories="$categories" />

    {{-- Statistics Section --}}
    <x-menu.statistics-section :totalProducts="$totalProducts" :totalCategories="$totalCategories" :recentGallery="$recentGallery" />

    {{-- Featured Section --}}
    <x-menu.featured-menu :featuredMenus="$featuredMenus" :userFavorites="$userFavorites" />

    {{-- Popular menu Section --}}
    <x-menu.popular-menu :popularMenus="$popularMenus" :userFavorites="$userFavorites" />

    {{-- All menu Section --}}
    <x-menu.all-menu :allMenus="$allMenus" :categories="$categories" :userFavorites="$userFavorites" />

  </x-favorite-manager>
@endsection

@push('scripts')
  @vite('resources/js/pages/menu.js')
@endpush
