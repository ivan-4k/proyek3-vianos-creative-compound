<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Menampilkan Halaman Daftar Favorit (Wishlist)
     */
    public function index()
    {
        $userId = Auth::id();

        $favorites = Favorite::where('id_users', $userId)
            ->with('product.category')
            ->latest()
            ->paginate(8);

        $userFavorites = Favorite::where('id_users', $userId)
            ->pluck('id_produk')
            ->toArray();

        return view('user.favorite', [
            'favorites'     => $favorites,
            'userFavorites' => $userFavorites,
            'theme'         => 'light'
        ]);
    }

    /**
     * Menangani fungsi klik tombol Love (AJAX)
     */
    public function toggle(Request $request)
    {
        $request->validate([
            'id_produk' => 'required|integer'
        ]);

        $userId = Auth::id();
        $productId = $request->id_produk;

        $favorite = Favorite::where('id_users', $userId)
            ->where('id_produk', $productId)
            ->first();

        if ($favorite) {
            $favorite->delete();
            return response()->json(['status' => 'removed']);
        } else {
            Favorite::create([
                'id_users'  => $userId,
                'id_produk' => $productId
            ]);
            return response()->json(['status' => 'added']);
        }
    }
}
