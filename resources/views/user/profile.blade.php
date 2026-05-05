@extends('layouts.app')

@section('title', 'Profil')

@section('content')

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">
    {{-- Flex column di mobile, row di desktop --}}
    <div class="flex flex-col lg:flex-row gap-6 lg:gap-8 mt-12">

      {{-- Sidebar - Full width di mobile, fixed width di desktop --}}
      <div class="w-full lg:w-80 flex-shrink-0">
        <x-sidebar />
      </div>

      {{-- Content - Full width di mobile, sisa space di desktop --}}
      <div class="flex-1 space-y-6">

        {{-- Update Profile --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 sm:p-6">
          @include('profile.partials.update-profile-information-form')
        </div>

        {{-- Update Password --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 sm:p-6">
          @include('profile.partials.update-password-form')
        </div>

      </div>

    </div>
  </div>

@endsection
@push('scripts')
  @vite('resources/js/pages/profile.js')
@endpush
