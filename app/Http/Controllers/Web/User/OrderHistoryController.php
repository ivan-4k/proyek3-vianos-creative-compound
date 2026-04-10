<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderHistoryController extends Controller
{
    public function index()
    {
        return view('user.history', [
            'theme' => 'light'
        ]);
    }
}
