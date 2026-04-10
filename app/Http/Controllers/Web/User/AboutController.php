<?php

namespace App\Http\Controllers\Web\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    public function index()
    {
        return view('user.about', [
            'theme' => 'light'
        ]);
    }
}
