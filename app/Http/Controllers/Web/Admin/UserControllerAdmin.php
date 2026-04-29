<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserControllerAdmin extends Controller
{
  /**
   * Hanya owner yang boleh melakukan aksi tertentu.
   */
  private function authorizeOwner()
  {
    if (Auth::user()->role !== 'owner') {
      abort(403, 'Hanya owner yang dapat melakukan aksi ini.');
    }
  }

  public function index(Request $request)
  {
    $query = User::query();

    if ($search = $request->input('search')) {
      $query->where(function ($q) use ($search) {
        $q->where('name', 'like', "%{$search}%")
          ->orWhere('email', 'like', "%{$search}%");
      });
    }
    if ($role = $request->input('role')) {
      $query->where('role', $role);
    }
    if ($status = $request->input('status')) {
      $query->where('is_active', $status === 'active');
    }

    $users = $query->latest()->get();
    $roles = ['user', 'admin', 'owner'];

    return view('admin.users.index', compact('users', 'roles'));
  }

  public function create()
  {
    $this->authorizeOwner();
    return view('admin.users.create');
  }

  public function edit(User $user)
  {
    $this->authorizeOwner();
    return view('admin.users.edit', compact('user'));
  }

  public function trash()
  {
    $this->authorizeOwner();
    $users = User::onlyTrashed()->get();
    return view('admin.users.trash', compact('users'));
  }

  public function store(Request $request)
  {
    $this->authorizeOwner();

    $request->validate([
      'name'      => 'required|string|max:255',
      'email'     => 'required|email|unique:users,email',
      'password'  => 'required|string|min:6|confirmed',
      'role'      => 'required|in:user,admin,owner',
      'phone'     => 'nullable|string|max:20',
      'gender'    => 'nullable|in:male,female',
      'address'   => 'nullable|string',
      'is_active' => 'boolean',
    ]);

    User::create([
      'name'      => $request->name,
      'email'     => $request->email,
      'password'  => Hash::make($request->password),
      'role'      => $request->role,
      'phone'     => $request->phone,
      'gender'    => $request->gender,
      'address'   => $request->address,
      'is_active' => $request->is_active ?? true,
    ]);

    return redirect()->route('admin.users.index')
      ->with('success', "User baru berhasil ditambahkan.");
  }

  public function update(Request $request, User $user)
  {
    $this->authorizeOwner();

    $request->validate([
      'name'      => 'required|string|max:255',
      'email'     => 'required|email|unique:users,email,' . $user->id_users . ',id_users',
      'role'      => 'required|in:user,admin,owner',
      'phone'     => 'nullable|string|max:20',
      'gender'    => 'nullable|in:male,female',
      'address'   => 'nullable|string',
      'password'  => 'nullable|string|min:6|confirmed',
    ]);

    $data = $request->only(['name', 'email', 'phone', 'gender', 'address']);

    if ($user->id_users === Auth::id()) {
      $data['role'] = $user->role;
      $data['is_active'] = $user->is_active;
    } else {
      $data['role'] = $request->role;
      $data['is_active'] = $request->has('is_active');
    }

    if ($request->filled('password')) {
      $data['password'] = Hash::make($request->password);
    }

    $user->update($data);

    return redirect()->route('admin.users.index')
      ->with('success', "User {$user->name} berhasil diperbarui.");
  }

  public function destroy(User $user)
  {
    $this->authorizeOwner();
    if ($user->id_users === Auth::id()) {
      return redirect()->back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri!');
    }

    $user->delete();
    return redirect()->route('admin.users.index')
      ->with('success', "User {$user->name} dipindahkan ke sampah.");
  }

  public function restore($id)
  {
    $this->authorizeOwner();
    $user = User::withTrashed()->findOrFail($id);
    $user->restore();
    return redirect()->route('admin.users.trash')
      ->with('success', "User {$user->name} berhasil dipulihkan.");
  }

  public function forceDelete($id)
  {
    $this->authorizeOwner();
    $user = User::withTrashed()->findOrFail($id);
    $user->forceDelete();
    return redirect()->route('admin.users.trash')
      ->with('success', "User {$user->name} dihapus permanen.");
  }

  public function toggleStatus(User $user)
  {
    $this->authorizeOwner();

    if ($user->id_users === Auth::id()) {
      return response()->json([
        'success' => false,
        'message' => 'Anda tidak bisa menonaktifkan akun sendiri.'
      ], 403);
    }

    $user->is_active = !$user->is_active;
    $user->save();
    return response()->json([
      'success' => true,
      'is_active' => $user->is_active,
      'message' => "Status user diubah menjadi " . ($user->is_active ? 'aktif' : 'nonaktif')
    ]);
  }

  public function resetPassword(Request $request, User $user)
  {
    $this->authorizeOwner();
    $newPassword = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 8);
    $user->password = Hash::make($newPassword);
    $user->save();

    if ($request->expectsJson()) {
      return response()->json([
        'success' => true,
        'new_password' => $newPassword,
        'message' => "Password berhasil direset."
      ]);
    }

    return redirect()->back()
      ->with('success', "Password user {$user->name} direset menjadi: {$newPassword}");
  }
}
