<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\StaffDevice;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotificationController extends Controller
{
    /**
     * 6.1 Get Notifications — GET /api/notifications
     */
    public function index(Request $request): JsonResponse
    {
        $userId  = $request->user()->getKey();
        $perPage = (int)$request->query('per_page', 15);

        $query = Notification::where('id_users', $userId);

        if ($request->query('is_read') === 'false') {
            $query->where('is_read', false);
        } elseif ($request->query('is_read') === 'true') {
            $query->where('is_read', true);
        }

        $paginator   = $query->orderBy('created_at', 'desc')->paginate($perPage);
        $unreadCount = Notification::where('id_users', $userId)->where('is_read', false)->count();

        return response()->json([
            'success' => true,
            'message' => 'Notifications retrieved',
            'data'    => $paginator->map(fn($n) => $this->formatNotification($n)),
            'pagination' => [
                'current_page' => $paginator->currentPage(),
                'per_page'     => $paginator->perPage(),
                'total'        => $paginator->total(),
                'last_page'    => $paginator->lastPage(),
                'unread_count' => $unreadCount,
            ],
        ]);
    }

    /**
     * 6.2 Get Unread — GET /api/notifications/unread
     */
    public function unread(Request $request): JsonResponse
    {
        $userId       = $request->user()->getKey();
        $notifications = Notification::where('id_users', $userId)
            ->where('is_read', false)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success'      => true,
            'data'         => $notifications->map(fn($n) => $this->formatNotification($n)),
            'unread_count' => $notifications->count(),
        ]);
    }

    /**
     * 6.3 Mark as Read — PUT /api/notifications/{id}/read
     */
    public function markRead(Request $request, int $id): JsonResponse
    {
        $notification = Notification::where('id_users', $request->user()->getKey())
            ->find($id);

        if (!$notification) {
            return response()->json([
                'success' => false, 'message' => 'Notifikasi tidak ditemukan',
                'error_code' => 'NOT_FOUND', 'data' => null,
            ], 404);
        }

        $notification->update(['is_read' => true]);

        return response()->json([
            'success' => true,
            'message' => 'Notifikasi berhasil ditandai sebagai dibaca',
        ]);
    }

    /**
     * 6.4 Delete — DELETE /api/notifications/{id}
     */
    public function destroy(Request $request, int $id): JsonResponse
    {
        $notification = Notification::where('id_users', $request->user()->getKey())
            ->find($id);

        if (!$notification) {
            return response()->json([
                'success' => false, 'message' => 'Notifikasi tidak ditemukan',
                'error_code' => 'NOT_FOUND', 'data' => null,
            ], 404);
        }

        $notification->delete();

        return response()->json([
            'success' => true,
            'message' => 'Notifikasi berhasil dihapus',
        ]);
    }

    /**
     * 6.5 Register Device — POST /api/notifications/register-device
     */
    public function registerDevice(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'device_token' => 'required|string',
            'device_type'  => 'required|in:android,ios',
            'device_name'  => 'nullable|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false, 'message' => 'Validasi gagal',
                'error_code' => 'VALIDATION_ERROR', 'errors' => $validator->errors(),
            ], 422);
        }

        $userId = $request->user()->getKey();

        // Upsert device token (replace jika sudah ada)
        StaffDevice::updateOrCreate(
            ['id_users' => $userId, 'device_token' => $request->device_token],
            [
                'device_type' => $request->device_type,
                'device_name' => $request->device_name,
                'is_active'   => true,
                'last_used_at' => now(),
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Device berhasil didaftarkan untuk push notification',
        ]);
    }

    /** Helper: format notification */
    private function formatNotification(Notification $n): array
    {
        // data kolom bisa menyimpan related_id
        $data = is_array($n->data) ? $n->data : [];

        return [
            'id'         => $n->id_notifikasi,
            'title'      => $n->title,
            'message'    => $n->message,
            'type'       => $n->type ?? 'general',
            'related_id' => $data['related_id'] ?? null,
            'is_read'    => (bool) $n->is_read,
            'created_at' => $n->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
