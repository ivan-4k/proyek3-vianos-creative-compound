<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\CafeSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class SettingsController extends Controller
{
  /**
   * Show the settings form with all tabs.
   *
   * @return \Illuminate\View\View
   */
  public function index()
  {
    $cafeSetting = CafeSetting::first() ?? new CafeSetting();

    $settings = [
      'store_name' => Cache::get('store_name', config('app.name', 'Vianos Cafe')),
      'store_description' => Cache::get('store_description', ''),

      'store_email' => Cache::get('store_email', config('app.email', '')),
      'store_phone' => Cache::get('store_phone', ''),
      'store_address' => Cache::get('store_address', ''),

      'weekday_opening' => $cafeSetting->weekday_opening_time ?? '09:00:00',
      'weekday_closing' => $cafeSetting->weekday_closing_time ?? '02:00:00',
      'weekend_opening' => $cafeSetting->weekend_opening_time ?? '08:00:00',
      'weekend_closing' => $cafeSetting->weekend_closing_time ?? '02:00:00',
      'is_open' => $cafeSetting->is_open ?? true,
      'is_order_open' => $cafeSetting->is_order_open ?? true,

      'instagram' => Cache::get('instagram', ''),
      'facebook' => Cache::get('facebook', ''),
      'whatsapp' => Cache::get('whatsapp', ''),
      'tiktok' => Cache::get('tiktok', ''),

      'logo' => Cache::get('logo', 'images/logo.png'),
      'favicon' => Cache::get('favicon', 'images/favicon.ico'),
    ];

    return view('admin.settings.index', compact('settings', 'cafeSetting'));
  }

  /**
   * Update general settings.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\RedirectResponse
   */
  public function updateGeneral(Request $request)
  {
    $validated = $request->validate([
      'store_name' => 'required|string|max:255',
      'store_description' => 'nullable|string|max:1000',
    ]);

    Cache::forever('store_name', $validated['store_name']);
    Cache::forever('store_description', $validated['store_description'] ?? '');

    return redirect()->route('admin.settings.index')
      ->with('success', 'Pengaturan umum berhasil diperbarui');
  }

  /**
   * Update contact settings.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\RedirectResponse
   */
  public function updateContact(Request $request)
  {
    $validated = $request->validate([
      'store_email' => 'required|email|max:255',
      'store_phone' => 'required|string|max:20',
      'store_address' => 'required|string|max:500',
    ]);

    Cache::forever('store_email', $validated['store_email']);
    Cache::forever('store_phone', $validated['store_phone']);
    Cache::forever('store_address', $validated['store_address']);

    return redirect()->route('admin.settings.index')
      ->with('success', 'Pengaturan kontak berhasil diperbarui');
  }

  /**
   * Update operating hours in database.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\RedirectResponse
   */
  public function updateOperatingHours(Request $request)
  {
    $validated = $request->validate([
      'weekday_opening' => 'required',
      'weekday_closing' => 'required',
      'weekend_opening' => 'required',
      'weekend_closing' => 'required',
    ]);

    // Gunakan updateOrCreate agar otomatis membuat data jika belum ada
    CafeSetting::updateOrCreate(
      ['id' => 1],
      [
        'weekday_opening_time' => $validated['weekday_opening'],
        'weekday_closing_time' => $validated['weekday_closing'],
        'weekend_opening_time' => $validated['weekend_opening'],
        'weekend_closing_time' => $validated['weekend_closing'],
        'is_open' => $request->has('is_open'),
        'is_order_open' => $request->has('is_order_open'),
      ]
    );

    return redirect()->to(url()->previous() . '#operating') 
      ->with('success', 'Jam operasional berhasil diperbarui');
  }

  /**
   * Update social media links.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\RedirectResponse
   */
  public function updateSocial(Request $request)
  {
    $validated = $request->validate([
      'instagram' => 'nullable|url|max:500',
      'facebook' => 'nullable|url|max:500',
      'whatsapp' => 'nullable|string|max:20',
      'tiktok' => 'nullable|url|max:500',
    ]);

    Cache::forever('instagram', $validated['instagram'] ?? '');
    Cache::forever('facebook', $validated['facebook'] ?? '');
    Cache::forever('whatsapp', $validated['whatsapp'] ?? '');
    Cache::forever('tiktok', $validated['tiktok'] ?? '');

    return redirect()->route('admin.settings.index')
      ->with('success', 'Pengaturan media sosial berhasil diperbarui');
  }

  /**
   * Update branding (logo, favicon, colors).
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\RedirectResponse
   */
  public function updateBranding(Request $request)
  {
    $request->validate([
      'logo' => 'nullable|image|mimes:png,jpg,jpeg,svg|max:2048',
      'favicon' => 'nullable|image|mimes:png,ico|max:512',
    ]);

    if ($request->hasFile('logo')) {
      // Hapus logo lama jika ada
      $oldLogo = Cache::get('logo');
      if ($oldLogo && file_exists(public_path($oldLogo))) {
        @unlink(public_path($oldLogo));
      }

      $logoPath = $request->file('logo')->store('branding', 'public');
      Cache::forever('logo', 'storage/' . $logoPath);
    }

    if ($request->hasFile('favicon')) {
      $faviconPath = $request->file('favicon')->store('branding', 'public');
      Cache::forever('favicon', 'storage/' . $faviconPath);
    }

    return redirect()->to(url()->previous() . '#branding')
      ->with('success', 'Branding berhasil diperbarui');
  }

  /**
   * Upload image.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function uploadImage(Request $request)
  {
    $validated = $request->validate([
      'image' => 'required|image|mimes:png,jpg,jpeg,gif|max:5120',
      'type' => 'required|in:logo,favicon,banner',
    ]);

    try {
      $imagePath = $request->file('image')->store('branding/' . $validated['type'], 'public');

      return response()->json([
        'success' => true,
        'message' => 'Gambar berhasil diunggah',
        'path' => 'storage/' . $imagePath,
        'url' => asset('storage/' . $imagePath),
      ]);
    } catch (\Exception $e) {
      return response()->json([
        'success' => false,
        'message' => 'Gagal mengunggah gambar: ' . $e->getMessage(),
      ], 422);
    }
  }
}
