<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class SystemNotificationController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Ambil data notifikasi sistem dari user yang sedang login
        $systemNotifications = Notification::where('id_users', $userId)
            ->where('type', 'system')
            ->orderByDesc('created_at')
            ->get();

        // Hitung jumlah notifikasi yang belum dibaca
        $unreadCount = $systemNotifications->where('is_read', false)->count();

        return view('user.system', [
            'systemNotifications' => $systemNotifications,
            'unreadCount' => $unreadCount,
            'theme' => 'light'
        ]);
    }
}
