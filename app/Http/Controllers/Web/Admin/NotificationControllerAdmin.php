<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class NotificationControllerAdmin extends Controller
{
  public function index(Request $request)
  {
    $users = User::orderBy('name')->get();
    return view('admin.notifications.index', compact('users'));
  }

  // METHOD BARU KHUSUS UNTUK DATA API (SERVER SIDE)
  public function data(Request $request)
  {
    $query = Notification::with('user')->select('notifications.*');

    // Filter berdasarkan Tipe (jika dikirim dari AJAX)
    if ($request->has('type') && $request->type != '') {
      $query->where('type', $request->type);
    }

    return DataTables::eloquent($query)
      ->addIndexColumn()
      ->addColumn('user_name', function ($row) {
        return $row->user ? $row->user->name : 'Semua Pengguna';
      })
      ->editColumn('type', function ($row) {
        $color = $row->type == 'promo' ? 'text-purple-600' : 'text-blue-600';
        return '<span class="font-semibold capitalize ' . $color . '">' . $row->type . '</span>';
      })
      ->editColumn('message', function ($row) {
        return '<span title="' . htmlspecialchars($row->message) . '" class="truncate max-w-[200px] inline-block">'
          . \Illuminate\Support\Str::limit($row->message, 30) .
          '</span>';
      })
      ->editColumn('is_read', function ($row) {
        $class = $row->is_read ? 'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300' : 'bg-amber-100 text-amber-800 dark:bg-amber-900/30 dark:text-amber-400';
        $text = $row->is_read ? 'Dibaca' : 'Belum dibaca';
        return '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold ' . $class . '">' . $text . '</span>';
      })
      ->editColumn('created_at', function ($row) {
        return $row->created_at ? $row->created_at->format('d/m/Y H:i') : '-';
      })
      ->rawColumns(['type', 'message', 'is_read'])
      ->make(true);
  }

  public function store(Request $request)
  {
    $request->validate([
      'title' => 'required|string|max:191',
      'message' => 'required|string',
      'type' => 'required|string|in:promo,system',
      'recipient' => 'required|string|in:all,user',
      'user_id' => 'required_if:recipient,user|nullable|exists:users,id_users',
    ]);

    $payload = [
      'title' => $request->title,
      'message' => $request->message,
      'type' => $request->type,
      'data' => null,
      'is_read' => false,
      'read_at' => null,
      'created_at' => now(),
      'updated_at' => now(),
    ];

    if ($request->recipient === 'all') {
      $userIds = User::where('role', 'user')->orWhereNull('role')->pluck('id_users');
      if ($userIds->isEmpty()) {
        return redirect()->back()->with('error', 'Tidak ada pengguna yang dapat dikirimi notifikasi.');
      }

      $records = $userIds->map(function ($id) use ($payload) {
        return array_merge($payload, ['id_users' => $id]);
      })->toArray();

      Notification::insert($records);
    } else {
      Notification::create(array_merge($payload, ['id_users' => $request->user_id]));
    }

    return redirect()->back()->with('success', 'Notifikasi berhasil dikirim.');
  }
}
