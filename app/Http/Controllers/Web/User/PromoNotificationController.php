<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class PromoNotificationController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Ambil data notifikasi promo dari user yang sedang login
        $promos = Notification::where('id_users', $userId)
            ->where('type', 'promo')
            ->orderByDesc('created_at')
            ->get();

        // Hitung jumlah notifikasi yang belum dibaca
        $unreadCount = $promos->where('is_read', false)->count();

        return view('user.promo', [
            'promos' => $promos,
            'unreadCount' => $unreadCount,
            'theme' => 'light'
        ]);
    }
}
