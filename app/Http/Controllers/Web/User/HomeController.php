<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
  public function index()
  {
    $user = Auth::user();

    $userFavorites = [];

    if ($user) {
      if (!$user->google_id && !$user->email_verified_at) {
        return redirect()->route('verification.notice')
          ->with('status', 'Silakan verifikasi email Anda terlebih dahulu.');
      }

      if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
      }

      $userFavorites = Favorite::where('id_users', $user->id_users ?? $user->id)
        ->pluck('id_produk')
        ->toArray();
    }

    // 3 Signature Menu
    $signatureMenus = Product::where('is_available', true)
      ->limit(3)
      ->get();

    // 6 Best Seller Products
    $bestSellerProducts = Product::where('is_available', true)
      ->withCount('orderItems')
      ->orderByDesc('order_items_count')
      ->limit(5)
      ->get();

    $totalMenus = Product::where('is_available', true)->count();

    return view('user.home', [
      'signatureMenus'     => $signatureMenus,
      'bestSellerProducts' => $bestSellerProducts,
      'userFavorites'      => $userFavorites,
      'totalMenus'         => $totalMenus,
      'theme'              => 'dark'
    ]);
  }
}
