<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ActivityLogController extends Controller
{
  public function index(Request $request)
  {
    // Hanya ambil dropdown unik untuk filter
    $entities = ActivityLog::select('entity')->distinct()->pluck('entity');
    $actions = ActivityLog::select('action')->distinct()->pluck('action');

    return view('admin.activity_logs.index', compact('entities', 'actions'));
  }

  // METHOD BARU UNTUK SERVER-SIDE DATATABLES
  public function data(Request $request)
  {
    $query = ActivityLog::with('user')->select('activity_logs.*');

    // Filter Dropdown dari Frontend
    if ($request->has('entity') && $request->entity != '') {
      $query->where('entity', $request->entity);
    }
    if ($request->has('action') && $request->action != '') {
      $query->where('action', $request->action);
    }

    return DataTables::eloquent($query)
      ->addColumn('user_name', function ($log) {
        // Tampilkan nama user, beri badge jika System
        if ($log->user) {
          return '<span class="font-semibold text-gray-900 dark:text-white">' . $log->user->name . '</span>';
        }
        return '<span class="px-2 py-1 text-[10px] font-bold tracking-wider text-purple-700 bg-purple-100 rounded-md dark:bg-purple-900/30 dark:text-purple-400">SYSTEM</span>';
      })
      ->editColumn('action', function ($log) {
        // Buat lencana (badge) warna-warni berdasarkan tindakan
        $action = strtolower($log->action);
        $class = 'bg-gray-100 text-gray-700 border-gray-200 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600';

        if (Str::contains($action, ['create', 'tambah', 'insert', 'store'])) {
          $class = 'bg-green-50 text-green-700 border-green-200 dark:bg-green-900/30 dark:text-green-400 dark:border-green-800';
        } elseif (Str::contains($action, ['update', 'edit', 'ubah'])) {
          $class = 'bg-blue-50 text-blue-700 border-blue-200 dark:bg-blue-900/30 dark:text-blue-400 dark:border-blue-800';
        } elseif (Str::contains($action, ['delete', 'hapus', 'remove'])) {
          $class = 'bg-red-50 text-red-700 border-red-200 dark:bg-red-900/30 dark:text-red-400 dark:border-red-800';
        }

        return '<span class="px-2.5 py-1 text-xs font-semibold rounded-full border whitespace-nowrap ' . $class . '">' . ucfirst($log->action) . '</span>';
      })
      ->editColumn('entity_id', function ($log) {
        return $log->entity_id ? '<span class="font-mono text-xs bg-gray-100 dark:bg-gray-700 px-2 py-1 rounded text-gray-600 dark:text-gray-300">#' . $log->entity_id . '</span>' : '-';
      })
      ->editColumn('ip_address', function ($log) {
        return '<span class="font-mono text-xs text-gray-500 dark:text-gray-400">' . $log->ip_address . '</span>';
      })
      ->editColumn('created_at', function ($log) {
        return '<div class="text-xs text-gray-500 dark:text-gray-400 whitespace-nowrap">' .
          $log->created_at->format('d M Y') . '<br>' .
          $log->created_at->format('H:i:s') .
          '</div>';
      })
      ->addColumn('aksi', function ($log) {
        $detailUrl = route('admin.activity-logs.show', $log->id_aktivitas);
        $deleteUrl = route('admin.activity-logs.destroy', $log->id_aktivitas);
        $csrf = csrf_field();
        $method = method_field('DELETE');

        return '
                <div class="flex justify-end gap-3">
                    <a href="' . $detailUrl . '" class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 transition-colors" title="Detail Log">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>
                    </a>
                    <form action="' . $deleteUrl . '" method="POST" class="inline" onsubmit="return confirm(\'Apakah Anda yakin ingin menghapus log ini?\')">
                        ' . $csrf . $method . '
                        <button type="submit" class="text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 transition-colors" title="Hapus Log">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>
                        </button>
                    </form>
                </div>';
      })
      ->rawColumns(['user_name', 'action', 'entity_id', 'ip_address', 'created_at', 'aksi'])
      ->make(true);
  }

  public function show($id)
  {
    $activityLog = ActivityLog::with('user')->findOrFail($id);
    return view('admin.activity_logs.show', compact('activityLog'));
  }

  public function destroy($id)
  {
    ActivityLog::findOrFail($id)->delete();
    return redirect()->route('admin.activity-logs.index')->with('success', 'Log aktivitas berhasil dihapus.');
  }

  public function clearAll()
  {
    ActivityLog::truncate();
    return redirect()->route('admin.activity-logs.index')->with('success', 'Semua log aktivitas berhasil dihapus.');
  }
}
