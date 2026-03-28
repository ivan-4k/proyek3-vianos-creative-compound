@extends('layouts.app')

@section('title', 'Beranda')

@section('content')

  {{-- Hero Section --}}
  <x-section.hero-section />

  {{-- Menu Unggulan Section --}}
  <x-section.signature-menu />

  {{-- Spot Menarik Section --}}
  <x-section.gallery-section />

  {{-- slider product Section --}}
  <x-section.product-slider />

  {{-- Layanan Kami Section --}}
  <x-section.services-section />

  {{-- Cerita Section --}}
  <x-section.story-section />

  {{-- Cerita Section --}}
  <x-section.contact-section />
@endsection
