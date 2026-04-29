<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class GoogleController extends Controller
{
  public function redirect()
  {
    return Socialite::driver('google')->redirect();
  }

  public function callback()
  {
    try {
      $googleUser = Socialite::driver('google')->user();

      $user = User::where('email', $googleUser->getEmail())->first();

      if (!$user) {
        $user = User::create([
          'name' => $googleUser->getName(),
          'email' => $googleUser->getEmail(),
          'google_id' => $googleUser->getId(),
          'password' => Hash::make(Str::random(16)),
          'role' => 'user',
          'email_verified_at' => now(),
        ]);
      } else {
        $user->update([
          'google_id' => $googleUser->getId(),
          'email_verified_at' => now(),
        ]);
      }

      Auth::login($user, true);
      request()->session()->regenerate();
      $userRole = strtolower(trim($user->role));
      if (in_array($userRole, ['admin', 'owner'])) {
        return redirect()->route('admin.dashboard');
      }

      return redirect()->route('home');
    } catch (\Exception $e) {
      return redirect()->route('login')
        ->with('error', 'Login dengan Google gagal: ' . $e->getMessage());
    }
  }
}
