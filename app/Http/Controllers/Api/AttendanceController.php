<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AttendanceController extends Controller
{
    /**
     * 3.1 Clock In — POST /api/staff/clock-in
     */
    public function clockIn(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'latitude'  => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false, 'message' => 'Validasi gagal',
                'error_code' => 'VALIDATION_ERROR', 'errors' => $validator->errors(),
            ], 422);
        }

        $userId = $request->user()->getKey();
        $today  = Carbon::today()->toDateString();

        if (Attendance::where('id_users', $userId)->where('date', $today)->exists()) {
            return response()->json([
                'success' => false, 'message' => 'Anda sudah clock in hari ini',
                'error_code' => 'ALREADY_CLOCKED_IN', 'data' => null,
            ], 409);
        }

        $attendance = Attendance::create([
            'id_users'      => $userId,
            'date'          => $today,
            'clock_in_time' => Carbon::now()->format('H:i:s'),
            'status'        => 'present',
            'lat_in'        => $request->latitude ?? 0,
            'lng_in'        => $request->longitude ?? 0,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Clock in berhasil',
            'data'    => [
                'id'             => $attendance->id,
                'staff_id'       => $userId,
                'date'           => $attendance->date->toDateString(),
                'clock_in_time'  => Carbon::today()->setTimeFromTimeString($attendance->clock_in_time)->format('Y-m-d H:i:s'),
                'clock_out_time' => null,
                'status'         => $attendance->status,
                'location_in'    => ['latitude' => (float)$request->latitude, 'longitude' => (float)$request->longitude],
            ],
        ]);
    }

    /**
     * 3.2 Clock Out — POST /api/staff/clock-out
     */
    public function clockOut(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'latitude'  => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false, 'message' => 'Validasi gagal',
                'error_code' => 'VALIDATION_ERROR', 'errors' => $validator->errors(),
            ], 422);
        }

        $userId     = $request->user()->getKey();
        $today      = Carbon::today()->toDateString();
        $attendance = Attendance::where('id_users', $userId)->where('date', $today)->first();

        if (!$attendance) {
            return response()->json([
                'success' => false, 'message' => 'Belum clock in hari ini',
                'error_code' => 'NOT_CLOCKED_IN', 'data' => null,
            ], 409);
        }

        if ($attendance->clock_out_time) {
            return response()->json([
                'success' => false, 'message' => 'Anda sudah clock out hari ini',
                'error_code' => 'ALREADY_CLOCKED_OUT', 'data' => null,
            ], 409);
        }

        $clockOut  = Carbon::now();
        $clockIn   = Carbon::today()->setTimeFromTimeString($attendance->clock_in_time);
        $workHours = round($clockOut->diffInMinutes($clockIn) / 60, 2);

        $attendance->update([
            'clock_out_time' => $clockOut->format('H:i:s'),
            'work_hours'     => $workHours,
            'overtime_hours' => max(0, $workHours - 8),
            'lat_out'        => $request->latitude ?? 0,
            'lng_out'        => $request->longitude ?? 0,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Clock out berhasil',
            'data'    => [
                'id'             => $attendance->id,
                'staff_id'       => $userId,
                'date'           => $attendance->date->toDateString(),
                'clock_in_time'  => Carbon::today()->setTimeFromTimeString($attendance->clock_in_time)->format('Y-m-d H:i:s'),
                'clock_out_time' => $clockOut->format('Y-m-d H:i:s'),
                'work_hours'     => $workHours,
                'status'         => $attendance->status,
                'location_out'   => ['latitude' => (float)$request->latitude, 'longitude' => (float)$request->longitude],
            ],
        ]);
    }

    /**
     * 3.3 History — GET /api/staff/attendance
     */
    public function history(Request $request): JsonResponse
    {
        $userId  = $request->user()->getKey();
        $month   = (int)$request->query('month', Carbon::now()->month);
        $year    = (int)$request->query('year', Carbon::now()->year);
        $perPage = (int)$request->query('per_page', 15);

        $paginator = Attendance::forUser($userId)->forMonth($month, $year)
            ->orderBy('date', 'desc')->paginate($perPage);

        return response()->json([
            'success' => true,
            'message' => 'Attendance history retrieved',
            'data'    => $paginator->map(fn($a) => [
                'id'         => $a->id,
                'staff_id'   => $a->id_users,
                'date'       => $a->date->toDateString(),
                'clock_in'   => $a->clock_in_time ? Carbon::parse($a->date->toDateString() . ' ' . $a->clock_in_time)->format('Y-m-d H:i:s') : null,
                'clock_out'  => $a->clock_out_time ? Carbon::parse($a->date->toDateString() . ' ' . $a->clock_out_time)->format('Y-m-d H:i:s') : null,
                'work_hours' => (float)$a->work_hours,
                'status'     => $a->status,
            ]),
            'pagination' => [
                'current_page' => $paginator->currentPage(),
                'per_page'     => $paginator->perPage(),
                'total'        => $paginator->total(),
                'last_page'    => $paginator->lastPage(),
                'from'         => $paginator->firstItem(),
                'to'           => $paginator->lastItem(),
            ],
        ]);
    }

    /**
     * 3.4 By Date — GET /api/staff/attendance/{date}
     */
    public function byDate(Request $request, string $date): JsonResponse
    {
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
            return response()->json([
                'success' => false, 'message' => 'Format tanggal tidak valid. Gunakan YYYY-MM-DD',
                'error_code' => 'VALIDATION_ERROR',
            ], 422);
        }

        $attendance = Attendance::where('id_users', $request->user()->getKey())
            ->where('date', $date)->first();

        if (!$attendance) {
            return response()->json([
                'success' => false, 'message' => 'Data kehadiran tidak ditemukan',
                'error_code' => 'NOT_FOUND', 'data' => null,
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => [
                'id'           => $attendance->id,
                'date'         => $attendance->date->toDateString(),
                'clock_in'     => $attendance->clock_in_time ? Carbon::parse($attendance->date->toDateString() . ' ' . $attendance->clock_in_time)->format('Y-m-d H:i:s') : null,
                'clock_out'    => $attendance->clock_out_time ? Carbon::parse($attendance->date->toDateString() . ' ' . $attendance->clock_out_time)->format('Y-m-d H:i:s') : null,
                'work_hours'   => (float)$attendance->work_hours,
                'status'       => $attendance->status,
                'location_in'  => $attendance->lat_in
                    ? ['latitude' => (float)$attendance->lat_in, 'longitude' => (float)$attendance->lng_in] : null,
                'location_out' => $attendance->lat_out
                    ? ['latitude' => (float)$attendance->lat_out, 'longitude' => (float)$attendance->lng_out] : null,
            ],
        ]);
    }

    /**
     * 3.5 Summary — GET /api/staff/attendance/summary
     */
    public function summary(Request $request): JsonResponse
    {
        $userId = $request->user()->getKey();
        $month  = (int)$request->query('month', Carbon::now()->month);
        $year   = (int)$request->query('year', Carbon::now()->year);

        $rows = Attendance::forUser($userId)->forMonth($month, $year)->get();

        // Hitung hari kerja (Senin–Sabtu) dalam bulan tersebut
        $start       = Carbon::create($year, $month, 1);
        $end         = $start->copy()->endOfMonth();
        $workingDays = 0;
        $cur         = $start->copy();
        while ($cur->lte($end)) {
            if ($cur->dayOfWeek !== Carbon::SUNDAY) $workingDays++;
            $cur->addDay();
        }

        return response()->json([
            'success' => true,
            'data'    => [
                'month'                 => $month,
                'year'                  => $year,
                'total_days'            => $workingDays,
                'present_days'          => $rows->where('status', 'present')->count(),
                'absent_days'           => $rows->where('status', 'absent')->count(),
                'leave_days'            => $rows->where('status', 'leave')->count(),
                'total_hours'           => round((float)$rows->sum('work_hours'), 2),
                'average_hours_per_day' => $rows->where('status', 'present')->count() > 0
                    ? round($rows->sum('work_hours') / $rows->where('status', 'present')->count(), 3) : 0,
                'overtime_hours'        => round((float)$rows->sum('overtime_hours'), 2),
            ],
        ]);
    }
}
