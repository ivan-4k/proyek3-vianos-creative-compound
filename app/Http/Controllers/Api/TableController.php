<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CafeTable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TableController extends Controller
{
    /**
     * 4.1 Get All Tables — GET /api/staff/tables
     */
    public function index(Request $request): JsonResponse
    {
        $query   = CafeTable::query();
        $perPage = (int)$request->query('per_page', 20);

        if ($request->filled('status')) {
            $query->byStatus($request->status);
        }
        if ($request->filled('location')) {
            $query->byLocation($request->location);
        }

        $paginator = $query->orderBy('number')->paginate($perPage);

        return response()->json([
            'success' => true,
            'message' => 'Tables retrieved successfully',
            'data'    => $paginator->map(fn($t) => $this->formatTable($t)),
            'pagination' => [
                'current_page' => $paginator->currentPage(),
                'per_page'     => $paginator->perPage(),
                'total'        => $paginator->total(),
                'last_page'    => $paginator->lastPage(),
            ],
        ]);
    }

    /**
     * 4.5 Layout — GET /api/staff/tables/layout
     * Harus didefinisikan sebelum {id} agar tidak ambiguous
     */
    public function layout(): JsonResponse
    {
        $tables = CafeTable::orderBy('number')->get();

        return response()->json([
            'success' => true,
            'data'    => [
                'layout' => [
                    'width'  => 800,
                    'height' => 600,
                    'tables' => $tables->map(fn($t) => [
                        'id'       => $t->id,
                        'number'   => $t->number,
                        'x'        => $t->coord_x ?? 0,
                        'y'        => $t->coord_y ?? 0,
                        'width'    => $t->width,
                        'height'   => $t->height,
                        'capacity' => $t->capacity,
                        'status'   => $t->status,
                        'location' => $t->location,
                    ]),
                ],
            ],
        ]);
    }

    /**
     * 4.2 Get Table Detail — GET /api/staff/tables/{id}
     */
    public function show(int $id): JsonResponse
    {
        $table = CafeTable::with('currentOrder')->find($id);

        if (!$table) {
            return response()->json([
                'success' => false, 'message' => 'Meja tidak ditemukan',
                'error_code' => 'NOT_FOUND', 'data' => null,
            ], 404);
        }

        $data            = $this->formatTable($table);
        $data['current_order'] = $table->currentOrder
            ? ['id' => $table->currentOrder->id_pesanan, 'order_number' => $table->currentOrder->order_code]
            : null;

        return response()->json(['success' => true, 'data' => $data]);
    }

    /**
     * 4.3 Update Table Status — PUT /api/staff/tables/{id}
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $table = CafeTable::find($id);

        if (!$table) {
            return response()->json([
                'success' => false, 'message' => 'Meja tidak ditemukan',
                'error_code' => 'NOT_FOUND', 'data' => null,
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'status' => 'required|in:empty,occupied,reserved,maintenance',
            'notes'  => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false, 'message' => 'Validasi gagal',
                'error_code' => 'VALIDATION_ERROR', 'errors' => $validator->errors(),
            ], 422);
        }

        $table->update($validator->validated());

        return response()->json([
            'success' => true,
            'message' => 'Status meja berhasil diupdate',
            'data'    => [
                'id'           => $table->id,
                'number'       => $table->number,
                'status'       => $table->status,
                'last_updated' => $table->updated_at->format('Y-m-d H:i:s'),
            ],
        ]);
    }

    /**
     * 4.4 Scan Table via QR — POST /api/staff/scan-table
     */
    public function scanQr(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'qr_code' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false, 'message' => 'Validasi gagal',
                'error_code' => 'VALIDATION_ERROR', 'errors' => $validator->errors(),
            ], 422);
        }

        $table = CafeTable::where('qr_code', $request->qr_code)->first();

        if (!$table) {
            return response()->json([
                'success' => false, 'message' => 'QR Code tidak valid atau meja tidak ditemukan',
                'error_code' => 'INVALID_QR_CODE', 'data' => null,
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Scanning berhasil',
            'data'    => [
                'table_id'     => $table->id,
                'table_number' => $table->number,
                'status'       => $table->status,
                'capacity'     => $table->capacity,
                'location'     => $table->location,
            ],
        ]);
    }

    /** Helper: format table response */
    private function formatTable(CafeTable $t): array
    {
        return [
            'id'           => $t->id,
            'number'       => $t->number,
            'capacity'     => $t->capacity,
            'location'     => $t->location,
            'status'       => $t->status,
            'coordinates'  => ['x' => $t->coord_x, 'y' => $t->coord_y],
            'last_updated' => $t->updated_at->format('Y-m-d H:i:s'),
            'notes'        => $t->notes,
        ];
    }
}
