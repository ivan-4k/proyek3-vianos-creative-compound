<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
  public function index()
  {
    // Ambil data user yang sedang login
    $user = Auth::user();

    // JIKA ADA USER YANG LOGIN, jalankan pengecekan ini
    if ($user) {
      // 1. Cek Verifikasi Email (Kecuali jika login via Google)
      if (!$user->google_id && !$user->email_verified_at) {
        return redirect()->route('verification.notice')
          ->with('status', 'Silakan verifikasi email Anda terlebih dahulu.');
      }

      // 2. Redirect berdasarkan Role
      if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
      }
    }

    // Jika TIDAK ADA yang login (Guest) ATAU user biasa yang sudah aman, 
    // tampilkan halaman Beranda seperti biasa.
    return view('user.home', [
      'theme' => 'dark' // Ubah sesuai kebutuhan navbar kamu
    ]);
  }
}
