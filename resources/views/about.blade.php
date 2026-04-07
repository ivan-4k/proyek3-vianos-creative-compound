@extends('layouts.app')

@section('title', 'About Us')

@section('content')

    {{-- Hero Section --}}
    <x-about-section.hero/>

    {{-- Cerita Kami Section --}}
    <x-about-section.story/>

    {{-- Kenapa Kami Section --}}
    <x-about-section.why/>

    {{-- Visi & Misi Section --}}
    <x-about-section.vision/>

@endsection