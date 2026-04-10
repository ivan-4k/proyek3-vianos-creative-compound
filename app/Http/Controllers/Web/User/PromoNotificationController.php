<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PromoNotificationController extends Controller
{
    public function index()
    {
        return view('user.promo', [
            'theme' => 'light'
        ]);
    }
}
