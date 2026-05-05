<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
  public function index()
  {
    // total pendapatan
    $totalRevenue = Order::where('order_status', 'completed')->sum('total');

    // jumlah pesanan
    $completedOrders = Order::where('order_status', 'completed')->count();

    // jumlah pesanan pending
    $pendingOrders = Order::whereIn('order_status', ['pending_confirmation', 'processing'])->count();

    // total semua user
    $totalUsers = User::count();

    return view('admin.reports.index', compact('totalRevenue', 'completedOrders', 'pendingOrders', 'totalUsers'));
  }

  // Laporan Penjualan
  public function sales(Request $request)
  {
    $startDate = $request->input('from', now()->startOfMonth()->format('Y-m-d'));
    $endDate = $request->input('to', now()->format('Y-m-d'));

    $allOrders = Order::whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
      ->orderBy('created_at')
      ->get();

    $totalRevenue = $allOrders->where('order_status', 'completed')->sum('total');
    $totalOrders = $allOrders->count();
    $avgOrder = $totalOrders > 0 ? $totalRevenue / $totalOrders : 0;

    $daily = $allOrders->groupBy(function ($order) {
      return $order->created_at->format('Y-m-d');
    })->map(function ($dayOrders) {
      return [
        'count' => $dayOrders->count(),
        'revenue' => $dayOrders->sum('total')
      ];
    });

    $orders = Order::with('user')
      ->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
      ->orderBy('created_at')
      ->get();

    return view('admin.reports.sales', compact('orders', 'totalRevenue', 'totalOrders', 'avgOrder', 'daily', 'startDate', 'endDate'));
  }

  // Laporan Menu Terlaris
  public function topMenus(Request $request)
  {
    $startDate = $request->input('from', now()->startOfMonth()->format('Y-m-d'));
    $endDate = $request->input('to', now()->format('Y-m-d'));

    $topMenus = DB::table('order_items')
      ->join('products', 'order_items.id_produk', '=', 'products.id_produk')
      ->join('orders', 'order_items.id_pesanan', '=', 'orders.id_pesanan')
      ->whereBetween('orders.created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
      ->where('orders.order_status', 'completed')
      ->select('products.name', DB::raw('SUM(order_items.quantity) as total_quantity'), DB::raw('SUM(order_items.subtotal) as total_revenue'))
      ->groupBy('products.id_produk', 'products.name')
      ->orderByDesc('total_quantity')
      ->limit(10)
      ->get();

    return view('admin.reports.top-menus', compact('topMenus', 'startDate', 'endDate'));
  }

  // Laporan Aktivitas User
  public function userActivity(Request $request)
  {
    $startDate = $request->input('from', now()->startOfMonth()->format('Y-m-d'));
    $endDate = $request->input('to', now()->format('Y-m-d'));

    $allLogs = ActivityLog::with('user')
      ->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
      ->get();

    $groupByUser = $allLogs->groupBy('id_users')->map(function ($userLogs) {
      return [
        'user_id' => $userLogs->first()->id_users,
        'user' => $userLogs->first()->user->name ?? 'System/Guest',
        'total' => $userLogs->count()
      ];
    });

    $logs = ActivityLog::with('user')
      ->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
      ->orderBy('created_at', 'desc')
      ->get();

    return view('admin.reports.user-activity', compact('logs', 'groupByUser', 'startDate', 'endDate'));
  }

  // Export CSV
  public function exportSales(Request $request)
  {
    $startDate = $request->input('from', now()->startOfMonth()->format('Y-m-d'));
    $endDate = $request->input('to', now()->format('Y-m-d'));

    $orders = Order::with('user')
      ->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59'])
      ->orderBy('created_at')
      ->get();

    $filename = "sales_report_{$startDate}_to_{$endDate}.csv";
    $handle = fopen('php://temp', 'w+');
    fputcsv($handle, ['ID Pesanan', 'Kode', 'Pelanggan', 'Total', 'Status', 'Tanggal']);

    foreach ($orders as $order) {
      fputcsv($handle, [
        $order->id_pesanan,
        $order->order_code,
        $order->user->name ?? 'Guest',
        $order->total,
        $order->order_status,
        $order->created_at->format('Y-m-d H:i:s')
      ]);
    }

    rewind($handle);
    $csv = stream_get_contents($handle);
    fclose($handle);

    return response($csv, 200)
      ->header('Content-Type', 'text/csv')
      ->header('Content-Disposition', "attachment; filename=\"$filename\"");
  }
}
