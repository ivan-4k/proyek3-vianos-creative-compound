<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\GoogleController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// === ROUTE COMPANY PROFILE ===
// Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('/', function () {
  return view('welcome');
});

// === GOOGLE OAUTH ===
Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');

// === Redirect setelah login (tambahkan semua role nanti)===
Route::middleware(['auth'])->get('/home', function () {
  $user = Auth::user();

  if (!$user->google_id && !$user->email_verified_at) {
    return redirect()->route('verification.notice')
      ->with('status', 'Silakan verifikasi email Anda terlebih dahulu.');
  }

  return $user->role === 'admin'
    ? redirect()->route('admin.dashboard')
    : view('user.home');
})->name('user.home');


// === ROUTE USER ===
Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




require __DIR__ . '/auth.php';
