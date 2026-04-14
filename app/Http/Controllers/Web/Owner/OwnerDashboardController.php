<?php

namespace App\Http\Controllers\Web\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OwnerDashboardController extends Controller
{
    /**
     * Display the Owner dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('owner.dashboard');
    }
}