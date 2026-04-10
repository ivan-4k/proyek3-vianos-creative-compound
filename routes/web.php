<?php

use App\Http\Controllers\Web\User\ProfileController;
use App\Http\Controllers\Auth\GoogleController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Web\User\HomeController;
use App\Http\Controllers\Web\User\AboutController;
use App\Http\Controllers\Web\User\AddressController;
use App\Http\Controllers\Web\User\CartController;
use App\Http\Controllers\Web\User\FavoriteController;
use App\Http\Controllers\Web\User\OrderHistoryController;
use App\Http\Controllers\Web\User\RecommendationController;
use App\Http\Controllers\Web\User\PopularMenuController;
use App\Http\Controllers\Web\User\PromoNotificationController;
use App\Http\Controllers\Web\User\SystemNotificationController;
use App\Http\Controllers\Web\User\MenuController;

// === ROUTE COMPANY PROFILE ===
// Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('/', function () {
  return view('welcome');
});

// === GOOGLE AUTH ===
Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');

// === ROUTE USER ===
Route::middleware(['auth', 'verified'])->group(function () {
  // PROFILE ROUTES
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

  // Address
  Route::get('/user/address', [AddressController::class, 'index'])->name('user.address');
  Route::put('/address', [AddressController::class, 'update'])->name('address.update');

  // Belanja
  Route::get('/user/cart', [CartController::class, 'index'])->name('user.cart');
  Route::get('/user/favorite', [FavoriteController::class, 'index'])->name('user.favorite');
  Route::get('/user/history', [OrderHistoryController::class, 'index'])->name('user.history');

  // Smart
  Route::get('/user/recommendation', [RecommendationController::class, 'index'])->name('user.recommendation');
  Route::get('/user/popular', [PopularMenuController::class, 'index'])->name('user.popular');

  // Notifikasi
  Route::get('/user/promo', [PromoNotificationController::class, 'index'])->name('user.promo');
  Route::get('/user/system', [SystemNotificationController::class, 'index'])->name('user.system');
});


// === ROUTE GUEST ===
// Home
Route::get('/home', [HomeController::class, 'index'])->name('home');
// Menu
Route::get('/menu', [MenuController::class, 'index']);
// About
Route::get('/about', [AboutController::class, 'index'])->name('about');


require __DIR__ . '/auth.php';
