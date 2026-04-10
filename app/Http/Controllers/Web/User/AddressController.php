<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;

class AddressController extends Controller
{
    public function index(Request $request): \Illuminate\View\View
    {
        return view('user.address', [
            'user' => $request->user(),
            'theme' => 'light',
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'address' => 'nullable|string|max:1000',
            'phone' => 'nullable|string|max:20|regex:/^([0-9\s\-\+\(\)]*)$/',
        ]);

        try {
            $user = $request->user();

            if (!$user) {
                return redirect()->route('login')->withErrors(['error' => 'Silakan login terlebih dahulu.']);
            }

            $user->address = $request->address;
            $user->phone = $request->phone;

            $user->save();

            return redirect()->route('user.address')
                ->with('status', 'address-updated')
                ->with('message', 'Alamat berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('user.address')
                ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
