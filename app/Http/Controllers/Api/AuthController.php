<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password as PasswordRule;

class AuthController extends Controller
{
    /**
     * 1.1 Login Staff
     * POST /api/auth/login
     */
    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success'    => false,
                'message'    => 'Validasi gagal',
                'error_code' => 'VALIDATION_ERROR',
                'errors'     => $validator->errors(),
            ], 422);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success'    => false,
                'message'    => 'Email atau password salah',
                'error_code' => 'INVALID_CREDENTIALS',
                'data'       => null,
            ], 401);
        }

        if (!$user->is_active) {
            return response()->json([
                'success'    => false,
                'message'    => 'Akun Anda tidak aktif. Hubungi admin.',
                'error_code' => 'ACCOUNT_INACTIVE',
                'data'       => null,
            ], 403);
        }

        // Revoke existing tokens & create new one
        $user->tokens()->where('name', 'staff-mobile')->delete();
        $token = $user->createToken('staff-mobile', ['*'], now()->addDay())->plainTextToken;

        $user->update(['last_login_at' => now()]);

        return response()->json([
            'success' => true,
            'message' => 'Login berhasil',
            'data'    => [
                'token'      => $token,
                'token_type' => 'Bearer',
                'expires_in' => 86400,
                'user'       => [
                    'id'         => $user->getKey(),
                    'name'       => $user->name,
                    'email'      => $user->email,
                    'role'       => $user->role,
                    'position'   => $user->position ?? null,
                    'department' => $user->department ?? null,
                    'avatar'     => $user->avatar ? asset('storage/' . $user->avatar) : null,
                ],
            ],
        ]);
    }

    /**
     * 1.2 Forgot Password
     * POST /api/auth/forgot-password
     */
    public function forgotPassword(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success'    => false,
                'message'    => 'Validasi gagal',
                'error_code' => 'VALIDATION_ERROR',
                'errors'     => $validator->errors(),
            ], 422);
        }

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json([
                'success'    => false,
                'message'    => 'Email tidak ditemukan',
                'error_code' => 'EMAIL_NOT_FOUND',
                'data'       => null,
            ], 404);
        }

        $status = Password::sendResetLink(['email' => $request->email]);

        if ($status === Password::RESET_LINK_SENT) {
            return response()->json([
                'success' => true,
                'message' => 'Link reset password telah dikirim ke email Anda',
            ]);
        }

        return response()->json([
            'success'    => false,
            'message'    => 'Gagal mengirim link reset password, coba lagi nanti',
            'error_code' => 'SERVER_ERROR',
        ], 500);
    }

    /**
     * 1.3 Reset Password
     * POST /api/auth/reset-password
     */
    public function resetPassword(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email'                 => 'required|email',
            'token'                 => 'required|string',
            'password'              => ['required', 'confirmed', PasswordRule::min(8)],
            'password_confirmation' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success'    => false,
                'message'    => 'Validasi gagal',
                'error_code' => 'VALIDATION_ERROR',
                'errors'     => $validator->errors(),
            ], 422);
        }

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill(['password' => $password])->save();
                $user->tokens()->delete(); // Revoke all tokens on password reset
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return response()->json([
                'success' => true,
                'message' => 'Password berhasil direset',
            ]);
        }

        return response()->json([
            'success'    => false,
            'message'    => 'Token tidak valid atau sudah expired',
            'error_code' => 'INVALID_TOKEN',
            'data'       => null,
        ], 400);
    }

    /**
     * 1.4 Logout
     * POST /api/auth/logout
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logout berhasil',
        ]);
    }

    /**
     * 1.5 Refresh Token
     * POST /api/auth/refresh-token
     */
    public function refreshToken(Request $request): JsonResponse
    {
        $user = $request->user();

        // Revoke current token and issue a new one
        $request->user()->currentAccessToken()->delete();
        $token = $user->createToken('staff-mobile', ['*'], now()->addDay())->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Token berhasil direfresh',
            'data'    => [
                'token'      => $token,
                'token_type' => 'Bearer',
                'expires_in' => 86400,
            ],
        ]);
    }
}
