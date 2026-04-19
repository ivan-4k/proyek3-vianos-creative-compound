@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
  {{-- logika favorit --}}
  <x-favorite-manager :userFavorites="$userFavorites ?? []">
    
    {{-- Hero Section --}}
    <x-home.home-hero-section />

    {{-- Menu Unggulan Section --}}
    <x-home.signature-menu :menus="$signatureMenus" :userFavorites="$userFavorites" />

    {{-- Spot Menarik Section --}}
    <x-home.gallery-section />

    {{-- slider product Section --}}
    <x-home.product-slider :products="$bestSellerProducts" />

    {{-- Layanan Kami Section --}}
    <x-home.services-section />

    {{-- Cerita Section --}}
    <x-home.story-section :totalMenus="$totalMenus" />

    {{-- Kontak Section --}}
    <x-home.contact-section />

  </x-favorite-manager>
@endsection

@push('scripts')
  @vite('resources/js/pages/home.js')
@endpush
