@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

  {{-- Hero Section --}}
  <x-home.home-hero-section />

  {{-- Menu Unggulan Section --}}
  <x-home.signature-menu />

  {{-- Spot Menarik Section --}}
  <x-home.gallery-section />

  {{-- slider product Section --}}
  <x-home.product-slider />

  {{-- Layanan Kami Section --}}
  <x-home.services-section />

  {{-- Cerita Section --}}
  <x-home.story-section />

  {{-- Kontak Section --}}
  <x-home.contact-section />
@endsection

@push('scripts')
  @vite('resources/js/pages/home.js')
@endpush
