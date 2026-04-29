@extends('layouts.admin')
@section('content')
  <x-admin.card title="Detail Log Aktivitas" subtitle="{{ $activityLog->created_at->format('d/m/Y H:i:s') }}">
    <dl class="grid grid-cols-2 gap-4">
      <dt>User</dt>
      <dd>{{ $activityLog->user->name ?? 'System' }}</dd>
      <dt>Aksi</dt>
      <dd>{{ $activityLog->action }}</dd>
      <dt>Entitas</dt>
      <dd>{{ $activityLog->entity }} (ID: {{ $activityLog->entity_id }})</dd>
      <dt>IP Address</dt>
      <dd>{{ $activityLog->ip_address }}</dd>
      <dt>User Agent</dt>
      <dd class="break-words">{{ $activityLog->user_agent }}</dd>
      <dt>Data Lama</dt>
      <dd>
        <pre class="bg-gray-100 dark:bg-gray-600 p-2 rounded text-dark dark:text-light">{{ json_encode($activityLog->old_data, JSON_PRETTY_PRINT) }}</pre>
      </dd>
      <dt>Data Baru</dt>
      <dd>
        <pre class="bg-gray-100 dark:bg-gray-600 p-2 rounded text-dark dark:text-light">{{ json_encode($activityLog->new_data, JSON_PRETTY_PRINT) }}</pre>
      </dd>
    </dl>
    <div class="mt-6"><a href="{{ route('admin.activity-logs.index') }}"
        class="bg-gray-600 text-white px-4 py-2 rounded">Kembali</a></div>
  </x-admin.card>
@endsection
