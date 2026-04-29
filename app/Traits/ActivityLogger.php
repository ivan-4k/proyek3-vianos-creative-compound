<?php

namespace App\Traits;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

trait ActivityLogger
{
  protected function logActivity($action, $entity, $entityId = null, $oldData = null, $newData = null)
  {
    try {
      ActivityLog::create([
        'id_users' => Auth::id(),
        'action' => $action,
        'entity' => $entity,
        'entity_id' => $entityId,
        'old_data' => $oldData,
        'new_data' => $newData,
        'ip_address' => request()->ip(),
        'user_agent' => request()->userAgent(),
      ]);
    } catch (\Exception $e) {
      // log error tapi jangan ganggu proses utama
      Log::error('Activity log gagal: ' . $e->getMessage());
    }
  }
}
