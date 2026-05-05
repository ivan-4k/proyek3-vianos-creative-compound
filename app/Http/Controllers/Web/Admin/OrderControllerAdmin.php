<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Notification;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class OrderControllerAdmin extends Controller
{
  /**
   * Daftar pesanan dengan filter dan pencarian.
   */
  public function index(Request $request)
  {
    $statuses = ['pending_confirmation', 'processing', 'ready_for_pickup', 'completed', 'cancelled'];
    return view('admin.orders.index', compact('statuses'));
  }

  /**
   * Method API untuk DataTables Server-Side
   */
  public function data(Request $request)
  {
    $query = Order::with('user')->select('orders.*');

    // Filter Status dari Frontend
    if ($request->has('status') && $request->status != '') {
      $query->where('order_status', $request->status);
    }

    return DataTables::eloquent($query)
      ->editColumn('id_pesanan', function ($order) {
        return '#' . $order->id_pesanan;
      })
      ->editColumn('order_code', function ($order) {
        return '<span class="font-mono">' . $order->order_code . '</span>';
      })
      ->addColumn('pelanggan', function ($order) {
        $name = $order->user->name ?? 'Guest';
        $email = $order->user->email ?? '-';
        return '<div class="flex flex-col">' .
          '<span class="font-semibold text-gray-900 dark:text-white">' . $name . '</span>' .
          '<span class="text-xs text-gray-400">' . $email . '</span>' .
          '</div>';
      })
      ->editColumn('total', function ($order) {
        return 'Rp ' . number_format($order->total, 0, ',', '.');
      })
      ->editColumn('order_status', function ($order) {
        $class = match ($order->order_status) {
          'pending_confirmation' => 'bg-amber-100 text-amber-800',
          'processing' => 'bg-blue-100 text-blue-800',
          'ready_for_pickup' => 'bg-indigo-100 text-indigo-800',
          'completed' => 'bg-emerald-100 text-emerald-800',
          default => 'bg-rose-100 text-rose-800',
        };
        $label = str_replace('_', ' ', strtoupper($order->order_status));
        return '<span class="px-3 py-1 rounded-full text-xs font-bold whitespace-nowrap ' . $class . '">' . $label . '</span>';
      })
      ->editColumn('created_at', function ($order) {
        return '<div class="text-xs text-gray-500 dark:text-gray-400 whitespace-nowrap">' .
          $order->created_at->translatedFormat('d M Y') . '<br>' .
          $order->created_at->format('H:i') . ' WIB</div>';
      })
      ->addColumn('aksi', function ($order) {
        $showUrl = route('admin.orders.show', $order->id_pesanan);
        $deleteUrl = route('admin.orders.destroy', $order->id_pesanan);
        $csrf = csrf_field();
        $method = method_field('DELETE');

        $buttons = '
              <div class="flex justify-end items-center gap-3">
                  <a href="' . $showUrl . '" class="text-blue-600 hover:text-blue-800 transition-colors" title="Detail Pesanan">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>
                  </a>';

        // Tampilkan tombol batal HANYA jika status belum completed/cancelled
        if (in_array($order->order_status, ['pending_confirmation', 'processing', 'ready_for_pickup'])) {
          $buttons .= '
                  <form action="' . $deleteUrl . '" method="POST" class="inline" onsubmit="return confirm(\'Batalkan pesanan #' . $order->id_pesanan . '?\')">
                      ' . $csrf . $method . '
                      <button type="submit" class="text-red-600 hover:text-red-800 transition-colors" title="Batalkan Pesanan">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                      </button>
                  </form>';
        }

        $buttons .= '</div>';
        return $buttons;
      })
      ->rawColumns(['order_code', 'pelanggan', 'order_status', 'created_at', 'aksi'])
      ->make(true);
  }

  /**
   * Detail pesanan.
   */
  public function show(Order $order)
  {
    $order->load(['user', 'items.product']);
    return view('admin.orders.show', compact('order'));
  }

  /**
   * Update status pesanan.
   */
  public function updateStatus(Request $request, Order $order)
  {
    $request->validate([
      'order_status' => 'required|string|in:pending_confirmation,processing,ready_for_pickup,completed,cancelled',
    ]);

    $order->order_status = $request->order_status;
    $order->save();

    // Map status untuk notifikasi
    $statusText = match ($request->order_status) {
      'processing' => 'sedang diproses oleh staf kami',
      'ready_for_pickup' => 'sudah siap untuk diambil',
      'completed' => 'telah selesai. Terima kasih atas pesananmu!',
      'cancelled' => 'dibatalkan',
      default => 'telah diperbarui'
    };

    if ($request->order_status !== 'pending_confirmation') {
      Notification::create([
        'id_users' => $order->id_users,
        'title' => 'Update Status Pesanan',
        'message' => "Pesanan kamu dengan nomor {$order->order_code} $statusText.",
        'type' => 'system',
        'is_read' => false,
      ]);
    }

    if ($request->expectsJson()) {
      return response()->json([
        'success' => true,
        'message' => "Status pesanan #{$order->id_pesanan} diperbarui menjadi {$order->order_status}",
        'order_status' => $order->order_status,
      ]);
    }

    return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui.');
  }

  /**
   * Update status pembayaran.
   */
  public function updatePaymentStatus(Request $request, Order $order)
  {
    $request->validate([
      'payment_status' => 'required|string|in:pending,paid,failed,refunded',
    ]);

    $order->payment_status = $request->payment_status;
    $order->save();

    if ($request->expectsJson()) {
      return response()->json([
        'success' => true,
        'message' => "Status pembayaran pesanan #{$order->id_pesanan} diperbarui menjadi {$order->payment_status}",
        'payment_status' => $order->payment_status,
      ]);
    }

    return redirect()->back()->with('success', 'Status pembayaran berhasil diperbarui.');
  }

  /**
   * Batalkan pesanan (ubah status menjadi cancelled).
   */
  public function destroy(Order $order)
  {
    // 1. Cek validasi status (Hanya bisa batal jika belum selesai/batal)
    if (in_array($order->order_status, ['completed', 'cancelled'])) {
      return redirect()->back()->with('error', 'Pesanan yang sudah selesai atau batal tidak bisa diubah lagi.');
    }

    DB::beginTransaction();
    try {
      // 2. LOGIKA PENGEMBALIAN STOK
      foreach ($order->items as $item) {
        if ($item->product) {
          $item->product->increment('stock', $item->quantity);
        }
      }

      // 3. Ubah status pesanan menjadi cancelled
      $order->order_status = 'cancelled';
      $order->save();

      // Notifikasi Pembatalan
      Notification::create([
        'id_users' => $order->id_users,
        'title' => 'Pesanan Dibatalkan',
        'message' => "Pesanan kamu dengan nomor {$order->order_code} telah dibatalkan oleh Admin.",
        'type' => 'system',
        'is_read' => false,
      ]);

      DB::commit();
      return redirect()->route('admin.orders.index')
        ->with('success', "Pesanan #{$order->id_pesanan} berhasil dibatalkan dan stok dikembalikan.");
    } catch (\Exception $e) {
      DB::rollback();
      return redirect()->back()->with('error', 'Gagal membatalkan pesanan: ' . $e->getMessage());
    }
  }

  /**
   * Cetak invoice PDF.
   */
  public function printReceipt(Order $order)
  {
    $order->load(['user', 'items']);
    $pdf = Pdf::loadView('admin.orders.pdf', compact('order'));
    return $pdf->download("invoice-{$order->order_code}.pdf");
  }
}
