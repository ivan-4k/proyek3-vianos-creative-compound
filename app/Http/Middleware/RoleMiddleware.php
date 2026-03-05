<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        // Convert ke lowercase
        $userRole = strtolower(trim($user->role));
        $requiredRole = strtolower(trim($role));

        // Handle multiple roles (separated by |)
        $allowedRoles = explode('|', $requiredRole);

        // Check role user
        if (!in_array($userRole, $allowedRoles)) {
            // Redirect berdasarkan role user
            if ($userRole === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif ($userRole === 'owner') {
                return redirect()->route('owner.dashboard');
            } elseif ($userRole === 'user') {
                return redirect('/');
            } else {
                return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
            }
        }

        return $next($request);
    }
}
