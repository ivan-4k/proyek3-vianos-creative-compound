<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $carts = Cart::with('product')
            ->where('id_users', $userId)
            ->get()
            ->map(function ($cart) {
                if (!$cart->product) {
                    $cart->product = (object) [
                        'name' => 'Produk tidak ditemukan',
                        'price' => 0,
                        'image' => 'default.jpg',
                    ];
                }
                $cart->subtotal = $cart->product->price * $cart->quantity;
                return $cart;
            });

        $total = $carts->sum('subtotal');

        return view('user.cart', [
            'theme' => 'light',
            'carts' => $carts,
            'total' => $total,
        ]);
    }
}
