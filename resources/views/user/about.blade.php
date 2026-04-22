@extends('layouts.app')

@section('title', 'About Us')

@section('content')

  {{-- Hero Section --}}
  <x-about-section.about-hero-section />

  {{-- Cerita Kami Section --}}
  <x-about-section.story />

  {{-- Kenapa Kami Section --}}
  <x-about-section.why-choose-us />

  {{-- Visi & Misi Section --}}
  <x-about-section.vision />

  {{-- Instagram Section --}}
  <x-about-section.instagram />
  
  {{-- Lokasi Section --}}
  <x-about-section.location />

@endsection

@push('scripts')
  @vite('resources/js/pages/about.js')
@endpush