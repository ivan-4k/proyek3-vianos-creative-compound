<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * 5.1 Get All Orders — GET /api/staff/orders
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = (int)$request->query('per_page', 15);
        $sort    = in_array($request->query('sort'), ['created_at', 'updated_at', 'total']) ? $request->query('sort') : 'created_at';
        $order   = $request->query('order', 'desc') === 'asc' ? 'asc' : 'desc';

        $query = Order::with(['table', 'items.product', 'user']);

        if ($request->filled('status')) {
            $query->where('order_status', $request->status);
        }

        $paginator = $query->orderBy($sort, $order)->paginate($perPage);

        return response()->json([
            'success' => true,
            'message' => 'Orders retrieved successfully',
            'data'    => $paginator->map(fn($o) => $this->formatOrderSummary($o)),
            'pagination' => [
                'current_page' => $paginator->currentPage(),
                'per_page'     => $paginator->perPage(),
                'total'        => $paginator->total(),
                'last_page'    => $paginator->lastPage(),
            ],
        ]);
    }

    /**
     * 5.4 Filter by Status — GET /api/staff/orders/status/{status}
     */
    public function byStatus(Request $request, string $status): JsonResponse
    {
        $allowed = ['pending_confirmation', 'processing', 'ready_for_pickup', 'completed', 'cancelled'];
        if (!in_array($status, $allowed)) {
            return response()->json([
                'success' => false, 'message' => 'Status tidak valid',
                'error_code' => 'VALIDATION_ERROR', 'data' => null,
            ], 422);
        }

        $perPage   = (int)$request->query('per_page', 15);
        $paginator = Order::with(['table', 'items.product', 'user'])
            ->where('order_status', $status)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        return response()->json([
            'success' => true,
            'data'    => $paginator->map(fn($o) => $this->formatOrderSummary($o)),
            'pagination' => [
                'current_page' => $paginator->currentPage(),
                'per_page'     => $paginator->perPage(),
                'total'        => $paginator->total(),
            ],
        ]);
    }

    /**
     * 5.5 Orders by Table — GET /api/staff/orders/table/{tableId}
     */
    public function byTable(int $tableId): JsonResponse
    {
        $orders = Order::with(['items.product', 'user'])
            ->where('table_id', $tableId)
            ->whereNotIn('order_status', ['completed', 'cancelled'])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data'    => $orders->map(fn($o) => $this->formatOrderSummary($o)),
        ]);
    }

    /**
     * 5.2 Get Order Detail — GET /api/staff/orders/{id}
     */
    public function show(int $id): JsonResponse
    {
        $order = Order::with(['table', 'items.product', 'user'])->find($id);

        if (!$order) {
            return response()->json([
                'success' => false, 'message' => 'Pesanan tidak ditemukan',
                'error_code' => 'NOT_FOUND', 'data' => null,
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $this->formatOrderDetail($order),
        ]);
    }

    /**
     * 5.3 Update Order Status — PUT /api/staff/orders/{id}
     */
    public function updateStatus(Request $request, int $id): JsonResponse
    {
        $order = Order::find($id);
        if (!$order) {
            return response()->json([
                'success' => false, 'message' => 'Pesanan tidak ditemukan',
                'error_code' => 'NOT_FOUND', 'data' => null,
            ], 404);
        }

        $allowed   = ['pending_confirmation', 'processing', 'ready_for_pickup', 'completed', 'cancelled'];
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:' . implode(',', $allowed),
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false, 'message' => 'Validasi gagal',
                'error_code' => 'VALIDATION_ERROR', 'errors' => $validator->errors(),
            ], 422);
        }

        $order->update(['order_status' => $request->status]);

        return response()->json([
            'success' => true,
            'message' => "Status pesanan diupdate ke {$request->status}",
            'data'    => [
                'id'           => $order->id_pesanan,
                'order_number' => $order->order_code,
                'status'       => $order->order_status,
                'updated_at'   => $order->updated_at->format('Y-m-d H:i:s'),
            ],
        ]);
    }

    /**
     * 5.6 Mark Ready — POST /api/staff/orders/{id}/ready
     */
    public function markReady(int $id): JsonResponse
    {
        return $this->changeStatus($id, 'ready_for_pickup', 'siap disajikan');
    }

    /**
     * 5.7 Mark Served — POST /api/staff/orders/{id}/served
     */
    public function markServed(int $id): JsonResponse
    {
        return $this->changeStatus($id, 'completed', 'sudah disajikan');
    }

    /** Helper: change status */
    private function changeStatus(int $id, string $status, string $msg): JsonResponse
    {
        $order = Order::find($id);
        if (!$order) {
            return response()->json([
                'success' => false, 'message' => 'Pesanan tidak ditemukan',
                'error_code' => 'NOT_FOUND', 'data' => null,
            ], 404);
        }

        $order->update(['order_status' => $status]);

        return response()->json([
            'success' => true,
            'message' => "Pesanan {$order->order_code} {$msg}",
            'data'    => [
                'id'         => $order->id_pesanan,
                'status'     => $order->order_status,
                'updated_at' => $order->updated_at->format('Y-m-d H:i:s'),
            ],
        ]);
    }

    /** Helper: format order summary */
    private function formatOrderSummary(Order $o): array
    {
        return [
            'id'             => $o->id_pesanan,
            'order_number'   => $o->order_code,
            'table_id'       => $o->table_id,
            'table_number'   => $o->table?->number,
            'customer_name'  => $o->customer_name ?? $o->user?->name ?? '-',
            'items'          => $o->items->map(fn($i) => [
                'id'           => $i->id_item_pesanan,
                'product_id'   => $i->id_produk,
                'product_name' => $i->product_name_snapshot ?? $i->product?->nama_menu,
                'quantity'     => $i->quantity,
                'price'        => (float) $i->unit_price,
                'subtotal'     => (float) $i->subtotal,
                'notes'        => $i->notes,
            ]),
            'status'         => $o->order_status,
            'payment_status' => $o->payment_status,
            'created_at'     => $o->created_at->format('Y-m-d H:i:s'),
            'updated_at'     => $o->updated_at->format('Y-m-d H:i:s'),
            'total_price'    => (float) $o->total,
            'queue_number'   => $o->queue_number,
        ];
    }

    /** Helper: format order detail (sama + user info) */
    private function formatOrderDetail(Order $o): array
    {
        $data = $this->formatOrderSummary($o);
        if ($o->user) {
            $data['customer'] = [
                'id'    => $o->user->getKey(),
                'name'  => $o->user->name,
                'email' => $o->user->email,
                'phone' => $o->user->phone,
            ];
        }
        return $data;
    }
}
