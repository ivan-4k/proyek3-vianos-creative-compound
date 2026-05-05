<?php

namespace App\Traits;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

trait ActivityLogger
{
  /**
   * Log aktivitas secara manual (untuk Controller)
   */
  public function logActivity($action, $entity, $entityId = null, $oldData = null, $newData = null)
  {
    self::recordActivity($action, $entity, $entityId, $oldData, $newData);
  }

  /**
   * Logic utama untuk menyimpan log ke database
   */
  protected static function recordActivity($action, $entity, $entityId = null, $oldData = null, $newData = null)
  {
    try {
      ActivityLog::create([
        'id_users' => Auth::id(),
        'action' => $action,
        'entity' => $entity,
        'entity_id' => $entityId,
        'old_data' => is_array($oldData) || is_object($oldData) ? json_encode($oldData) : $oldData,
        'new_data' => is_array($newData) || is_object($newData) ? json_encode($newData) : $newData,
        'ip_address' => request()->ip(),
        'user_agent' => request()->userAgent(),
      ]);
    } catch (\Exception $e) {
      Log::error('Activity log gagal: ' . $e->getMessage());
    }
  }

  /**
   * Boot trait untuk digunakan pada Eloquent Model
   * Secara otomatis mencatat event created, updated, deleted, restored.
   */
  public static function bootActivityLogger()
  {
    static::created(function ($model) {
      self::recordActivity('create', class_basename($model), $model->getKey(), null, $model->getAttributes());
    });

    static::updated(function ($model) {
      self::recordActivity('update', class_basename($model), $model->getKey(), $model->getOriginal(), $model->getChanges());
    });

    static::deleted(function ($model) {
      self::recordActivity('delete', class_basename($model), $model->getKey(), $model->getAttributes(), null);
    });

    if (method_exists(static::class, 'restored')) {
      static::restored(function ($model) {
        self::recordActivity('restore', class_basename($model), $model->getKey(), null, $model->getAttributes());
      });
    }
  }
}
