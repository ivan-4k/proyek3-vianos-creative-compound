@extends('layouts.app')

@section('title', 'Menu')

@section('content')

  {{-- Hero Section --}}
  <x-menu.menu-hero-section />

  {{-- Category Section --}}
  <x-menu.category-section />

  {{-- Statistics Section --}}
  <x-menu.statistics-section />

  {{-- featured Section --}}
  <x-menu.featured-menu />

  {{-- Popular menu Section --}}
  <x-menu.popular-menu />

  {{-- all menu Section --}}
  <x-menu.all-menu />

@endsection

@push('scripts')
  @vite('resources/js/pages/menu.js')
@endpush
