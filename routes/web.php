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
use App\Http\Controllers\Web\User\UserNotificationController;
use App\Http\Controllers\Web\User\MenuController;

use App\Http\Controllers\Web\Admin\AdminDashboardController;
use App\Http\Controllers\Web\Admin\MenuControllerAdmin;
use App\Http\Controllers\Web\Admin\CategoryControllerAdmin;
use App\Http\Controllers\Web\Admin\OrderControllerAdmin;
use App\Http\Controllers\Web\Admin\NotificationControllerAdmin;
use App\Http\Controllers\Web\Admin\UserControllerAdmin;
use App\Http\Controllers\Web\Admin\ActivityLogController;
use App\Http\Controllers\Web\Admin\WhatsappLogController;
use App\Http\Controllers\Web\Admin\ReportController;
use App\Http\Controllers\Web\Admin\SettingsController;

use App\Http\Controllers\Web\Owner\OwnerDashboardController;

// === ROUTE COMPANY PROFILE ===
Route::get('/', function () {
  return view('welcome');
});

// === GOOGLE AUTH ===
Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');

// === ROUTE USER ===
Route::middleware(['auth', 'verified', 'role:user'])->group(function () {
  // PROFILE ROUTES
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

  Route::post('/user/favorite/toggle', [FavoriteController::class, 'toggle'])->name('user.favorite.toggle');

  // Address
  Route::get('/user/address', [AddressController::class, 'index'])->name('user.address');
  Route::put('/address', [AddressController::class, 'update'])->name('address.update');

  // Belanja
  Route::get('/user/cart', [CartController::class, 'index'])->name('user.cart');
  Route::post('/user/cart/add', [CartController::class, 'add'])->name('cart.add');
  Route::post('/user/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
  Route::patch('/api/cart/{id}/update', [CartController::class, 'updateQuantity']);
  Route::patch('/api/cart/{id}/note', [CartController::class, 'updateNote']);
  Route::delete('/api/cart/{id}', [CartController::class, 'destroy']);

  Route::get('/user/favorite', [FavoriteController::class, 'index'])->name('user.favorite');
  Route::get('/user/history', [OrderHistoryController::class, 'index'])->name('user.history');

  // Smart
  Route::get('/user/recommendation', [RecommendationController::class, 'index'])->name('user.recommendation');
  Route::get('/user/popular', [PopularMenuController::class, 'index'])->name('user.popular');

  // Notifikasi
  Route::get('/user/promo', [PromoNotificationController::class, 'index'])->name('user.promo');
  Route::get('/user/system', [SystemNotificationController::class, 'index'])->name('user.system');
  Route::patch('/user/notifications/{notification}/read', [UserNotificationController::class, 'markAsRead'])->name('user.notifications.read');
  Route::patch('/user/notifications/read-all', [UserNotificationController::class, 'markAllAsRead'])->name('user.notifications.readAll');
  Route::delete('/user/notifications/{notification}', [UserNotificationController::class, 'destroy'])->name('user.notifications.destroy');
});

// === ROUTE ADMIN ===
Route::middleware(['auth', 'verified', 'role:admin|owner'])->prefix('admin')->name('admin.')->group(function () {
  // Dashboard
  Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
  Route::get('/api/statistics', [AdminDashboardController::class, 'getStatistics'])->name('statistics');

  // ==================== MENU MANAGEMENT  ====================
  Route::get('/menu/trash', [MenuControllerAdmin::class, 'trash'])->name('menu.trash');
  Route::post('/menu/restore/{id}', [MenuControllerAdmin::class, 'restore'])->name('menu.restore');
  Route::delete('/menu/force-delete/{id}', [MenuControllerAdmin::class, 'forceDelete'])->name('menu.forceDelete');

  Route::post('/menu/bulk-delete', [MenuControllerAdmin::class, 'bulkDelete'])->name('menu.bulkDelete');
  Route::post('/menu/bulk-restore', [MenuControllerAdmin::class, 'bulkRestore'])->name('menu.bulkRestore');
  Route::delete('/menu/bulk-force-delete', [MenuControllerAdmin::class, 'bulkForceDelete'])->name('menu.bulkForceDelete');

  Route::post('/menu/{menu}/toggle-signature', [MenuControllerAdmin::class, 'toggleSignature'])->name('menu.toggleSignature');
  Route::post('/menu/{menu}/toggle-availability', [MenuControllerAdmin::class, 'toggleAvailability'])->name('menu.toggleAvailability');

  Route::get('/menu/api/search', [MenuControllerAdmin::class, 'search'])->name('menu.search');
  Route::get('/menu/api/filter', [MenuControllerAdmin::class, 'filterByCategory'])->name('menu.filterByCategory');

  Route::resource('/menu', MenuControllerAdmin::class)->except(['show']);

  // ==================== CATEGORY MANAGEMENT ====================
  Route::resource('/categories', CategoryControllerAdmin::class)->except(['show']);
  Route::get('/categories/trash', [CategoryControllerAdmin::class, 'trash'])->name('categories.trash');
  Route::post('/categories/restore/{id}', [CategoryControllerAdmin::class, 'restore'])->name('categories.restore');
  Route::delete('/categories/force-delete/{id}', [CategoryControllerAdmin::class, 'forceDelete'])->name('categories.forceDelete');

  Route::post('/categories/bulk-delete', [CategoryControllerAdmin::class, 'bulkDelete'])->name('categories.bulkDelete');
  Route::post('/categories/bulk-restore', [CategoryControllerAdmin::class, 'bulkRestore'])->name('categories.bulkRestore');
  Route::delete('/categories/bulk-force-delete', [CategoryControllerAdmin::class, 'bulkForceDelete'])->name('categories.bulkForceDelete');

  Route::post('/categories/reorder', [CategoryControllerAdmin::class, 'reorder'])->name('categories.reorder');

  // ==================== ORDER MANAGEMENT ====================
  Route::patch('/orders/{order}/status', [OrderControllerAdmin::class, 'updateStatus'])->name('orders.updateStatus');
  Route::patch('/orders/{order}/payment-status', [OrderControllerAdmin::class, 'updatePaymentStatus'])->name('orders.updatePaymentStatus');
  Route::delete('/orders/{order}', [OrderControllerAdmin::class, 'destroy'])->name('orders.destroy');
  Route::get('/orders/{order}/print', [OrderControllerAdmin::class, 'printReceipt'])->name('orders.print');
  Route::get('/orders/export/report', [OrderControllerAdmin::class, 'exportReport'])->name('orders.export');
  Route::get('orders/data', [OrderControllerAdmin::class, 'data'])->name('orders.data');
  Route::resource('orders', OrderControllerAdmin::class)->only(['index', 'show', 'destroy']);
  // ==================== NOTIFICATION MANAGEMENT ====================
  Route::get('/notifications', [NotificationControllerAdmin::class, 'index'])->name('notifications.index');
  Route::get('/notifications/data', [NotificationControllerAdmin::class, 'data'])->name('notifications.data');
  Route::post('/notifications', [NotificationControllerAdmin::class, 'store'])->name('notifications.store');

  // ==================== USER MANAGEMENT ====================
  Route::get('users/trash', [UserControllerAdmin::class, 'trash'])->name('users.trash');
  Route::post('users/{id}/restore', [UserControllerAdmin::class, 'restore'])->name('users.restore');
  Route::delete('users/{id}/force-delete', [UserControllerAdmin::class, 'forceDelete'])->name('users.forceDelete');
  Route::post('users/{user}/toggle-status', [UserControllerAdmin::class, 'toggleStatus'])->name('users.toggleStatus');
  Route::post('users/{user}/reset-password', [UserControllerAdmin::class, 'resetPassword'])->name('users.resetPassword');

  Route::resource('users', UserControllerAdmin::class)->except(['show']);


  // ==================== ACTIVITY LOG ====================
  Route::delete('activity-logs/clear', [ActivityLogController::class, 'clearAll'])->name('activity-logs.clear');
  Route::get('activity-logs/data', [ActivityLogController::class, 'data'])->name('activity-logs.data');
  Route::resource('activity-logs', ActivityLogController::class)->only(['index', 'show', 'destroy']);

  // ==================== WHATSAPP LOG ====================
  Route::get('whatsapp-logs/data', [WhatsappLogController::class, 'data'])->name('whatsapp-logs.data');
  Route::post('whatsapp-logs/{whatsapp_log}/retry', [WhatsappLogController::class, 'retry'])->name('whatsapp-logs.retry');
  Route::resource('whatsapp-logs', WhatsappLogController::class)->only(['index', 'show']);

  // ==================== REPORT MANAGEMENT ====================
  Route::prefix('reports')->name('reports.')->group(function () {
    Route::get('/', [ReportController::class, 'index'])->name('index');
    Route::get('/sales', [ReportController::class, 'sales'])->name('sales');
    Route::get('/top-menus', [ReportController::class, 'topMenus'])->name('top-menus');
    Route::get('/user-activity', [ReportController::class, 'userActivity'])->name('user-activity');
    Route::get('/export-sales', [ReportController::class, 'exportSales'])->name('export-sales');
  });

  // ==================== SETTINGS MANAGEMENT ====================
  Route::prefix('settings')->name('settings.')->group(function () {
    Route::get('/', [SettingsController::class, 'index'])->name('index');
    Route::put('/general', [SettingsController::class, 'updateGeneral'])->name('updateGeneral');
    Route::put('/branding', [SettingsController::class, 'updateBranding'])->name('updateBranding');
    Route::put('/contact', [SettingsController::class, 'updateContact'])->name('updateContact');
    Route::put('/social', [SettingsController::class, 'updateSocial'])->name('updateSocial');
    Route::put('/operating-hours', [SettingsController::class, 'updateOperatingHours'])->name('updateOperatingHours');
    Route::post('/upload-image', [SettingsController::class, 'uploadImage'])->name('uploadImage');
  });
});

// === ROUTE OWNER ===
// Route::middleware(['auth', 'verified', 'role:owner'])->group(function () {
//   Route::get('/owner/dashboard', [OwnerDashboardController::class, 'index'])->name('owner.dashboard');
// });

// === ROUTE GUEST ===
// Home
Route::get('/home', [HomeController::class, 'index'])->name('home');
// Menu
Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
// About
Route::get('/about', [AboutController::class, 'index'])->name('about');

require __DIR__ . '/auth.php';
