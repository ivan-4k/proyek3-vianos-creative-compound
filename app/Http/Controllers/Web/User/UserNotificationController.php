<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserNotificationController extends Controller
{
  public function markAsRead(Notification $notification): RedirectResponse
  {
    $this->ensureUserOwnsNotification($notification);

    if (! $notification->is_read) {
      $notification->update([
        'is_read' => true,
        'read_at' => now(),
      ]);
    }

    return back();
  }

  public function markAllAsRead(Request $request): RedirectResponse
  {
    Notification::where('id_users', Auth::id())
      ->where('is_read', false)
      ->update([
        'is_read' => true,
        'read_at' => now(),
      ]);

    return back();
  }

  public function destroy(Notification $notification): RedirectResponse
  {
    $this->ensureUserOwnsNotification($notification);

    $notification->delete();

    return back();
  }

  private function ensureUserOwnsNotification(Notification $notification): void
  {
    if ($notification->id_users !== Auth::id()) {
      abort(403);
    }
  }
}
