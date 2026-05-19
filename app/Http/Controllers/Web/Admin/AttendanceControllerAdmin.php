<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AttendanceControllerAdmin extends Controller
{
    public function index()
    {
        return view('admin.attendances.index');
    }

    public function data(Request $request)
    {
        $query = Attendance::with('user');

        if ($request->filled('date')) {
            $query->whereDate('date', $request->date);
        }

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('staff_name', function ($row) {
                return $row->user ? $row->user->name : '-';
            })
            ->addColumn('clock_in', function ($row) {
                return $row->clock_in_time ?: '-';
            })
            ->addColumn('clock_out', function ($row) {
                return $row->clock_out_time ?: '-';
            })
            ->addColumn('status_badge', function ($row) {
                $badges = [
                    'present' => '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Hadir</span>',
                    'absent' => '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Alpa</span>',
                    'leave' => '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Cuti</span>',
                    'late' => '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Terlambat</span>',
                ];
                return $badges[$row->status] ?? $row->status;
            })
            ->addColumn('action', function ($row) {
                $btn = '<div class="flex items-center gap-2">';
                $btn .= '<button onclick="deleteAttendance(' . $row->id . ')" class="p-2 text-white bg-red-600 rounded-lg hover:bg-red-700 transition-colors" title="Hapus"><i class="fa-solid fa-trash"></i></button>';
                $btn .= '</div>';
                return $btn;
            })
            ->rawColumns(['status_badge', 'action'])
            ->make(true);
    }

    public function destroy(string $id)
    {
        $attendance = Attendance::findOrFail($id);
        $attendance->delete();

        return response()->json(['success' => true, 'message' => 'Data absensi berhasil dihapus']);
    }
}
