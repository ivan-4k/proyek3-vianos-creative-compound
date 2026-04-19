<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderHistoryController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Ambil data order dari user yang sedang login dengan relasi items dan product
        $orders = Order::where('id_users', $userId)
            ->with(['items' => function ($query) {
                $query->with('product');
            }])
            ->orderByDesc('created_at')
            ->get();

        return view('user.history', [
            'orders' => $orders,
            'theme' => 'light'
        ]);
    }
}
