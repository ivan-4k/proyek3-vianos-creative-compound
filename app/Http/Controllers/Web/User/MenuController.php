<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        // Ambil data menu dari database atau sumber lain
        $menus = [
            // Data menu Anda
        ];
        
        // Kirim ke view
        return view('user.menu', compact('menus'));
    }
}