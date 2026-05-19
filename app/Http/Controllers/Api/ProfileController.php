<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password as PasswordRule;

class ProfileController extends Controller
{
    /**
     * 2.1 Get Profile
     * GET /api/profile
     */
    public function show(Request $request): JsonResponse
    {
        $user = $request->user();

        return response()->json([
            'success' => true,
            'message' => 'Profile retrieved successfully',
            'data'    => [
                'id'         => $user->getKey(),
                'name'       => $user->name,
                'email'      => $user->email,
                'phone'      => $user->phone,
                'position'   => $user->position ?? null,
                'department' => $user->department ?? null,
                'hire_date'  => $user->hire_date ?? null,
                'avatar'     => $user->avatar ? asset('storage/' . $user->avatar) : null,
                'status'     => $user->is_active ? 'active' : 'inactive',
                'role'       => $user->role,
            ],
        ]);
    }

    /**
     * 2.2 Update Profile
     * PUT /api/profile/update
     */
    public function update(Request $request): JsonResponse
    {
        $user = $request->user();

        $validator = Validator::make($request->all(), [
            'name'  => 'sometimes|required|string|max:255',
            'phone' => 'sometimes|nullable|string|max:20',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success'    => false,
                'message'    => 'Validasi gagal',
                'error_code' => 'VALIDATION_ERROR',
                'errors'     => $validator->errors(),
            ], 422);
        }

        $user->update($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Profil berhasil diupdate',
            'data'    => [
                'id'         => $user->getKey(),
                'name'       => $user->name,
                'email'      => $user->email,
                'phone'      => $user->phone,
                'position'   => $user->position ?? null,
                'department' => $user->department ?? null,
            ],
        ]);
    }

    /**
     * 2.3 Change Password
     * PUT /api/profile/change-password
     */
    public function changePassword(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'current_password'      => 'required|string',
            'new_password'          => ['required', 'confirmed', PasswordRule::min(8)],
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

        $user = $request->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'success'    => false,
                'message'    => 'Password lama tidak sesuai',
                'error_code' => 'INVALID_CURRENT_PASSWORD',
                'data'       => null,
            ], 400);
        }

        $user->update(['password' => $request->new_password]);

        return response()->json([
            'success' => true,
            'message' => 'Password berhasil diubah',
        ]);
    }
}
