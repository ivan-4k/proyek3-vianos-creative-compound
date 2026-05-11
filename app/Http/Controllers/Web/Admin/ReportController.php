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
    if ($request->has('period')) {
      $period = $request->input('period');
      $endDate = now()->format('Y-m-d');
      $startDate = now()->subDays((int)$period - 1)->format('Y-m-d');
    } else {
      $startDate = $request->input('from', now()->startOfMonth()->format('Y-m-d'));
      $endDate = $request->input('to', now()->format('Y-m-d'));
    }

    $startDateObj = \Carbon\Carbon::parse($startDate)->startOfDay();
    $endDateObj = \Carbon\Carbon::parse($endDate)->endOfDay();
    $periodLength = $startDateObj->diffInDays($endDateObj) + 1;

    $allOrders = Order::whereBetween('created_at', [$startDateObj, $endDateObj])
      ->orderBy('created_at')
      ->get();

    $totalRevenue = $allOrders->where('order_status', 'completed')->sum('total');
    $totalOrders = $allOrders->count();
    $avgOrder = $totalOrders > 0 ? $totalRevenue / $totalOrders : 0;

    // Previous period for growth calculation
    $prevEndDateObj = $startDateObj->copy()->subDay()->endOfDay();
    $prevStartDateObj = $prevEndDateObj->copy()->subDays($periodLength - 1)->startOfDay();

    $prevOrders = Order::whereBetween('created_at', [$prevStartDateObj, $prevEndDateObj])->get();
    
    $prevTotalRevenue = $prevOrders->where('order_status', 'completed')->sum('total');
    $prevTotalOrders = $prevOrders->count();
    $prevAvgOrder = $prevTotalOrders > 0 ? $prevTotalRevenue / $prevTotalOrders : 0;

    $revenueGrowth = $prevTotalRevenue > 0 ? round((($totalRevenue - $prevTotalRevenue) / $prevTotalRevenue) * 100) : 0;
    $ordersGrowth = $prevTotalOrders > 0 ? round((($totalOrders - $prevTotalOrders) / $prevTotalOrders) * 100) : 0;
    $avgOrderGrowth = $prevAvgOrder > 0 ? round((($avgOrder - $prevAvgOrder) / $prevAvgOrder) * 100) : 0;

    $daily = $allOrders->groupBy(function ($order) {
      return $order->created_at->format('Y-m-d');
    })->map(function ($dayOrders) {
      return [
        'count' => $dayOrders->count(),
        'revenue' => $dayOrders->where('order_status', 'completed')->sum('total')
      ];
    });

    $currentDate = $startDateObj->copy();
    $dailyFilled = [];
    while($currentDate <= $endDateObj) {
      $dateStr = $currentDate->format('Y-m-d');
      $dailyFilled[$dateStr] = $daily->has($dateStr) ? $daily[$dateStr] : ['count' => 0, 'revenue' => 0];
      $currentDate->addDay();
    }
    $daily = $dailyFilled;

    $orders = Order::with('user')
      ->whereBetween('created_at', [$startDateObj, $endDateObj])
      ->orderBy('created_at', 'desc')
      ->get();

    // 1. Category Distribution Doughnut
    $categoryData = DB::table('order_items')
      ->join('orders', 'order_items.id_pesanan', '=', 'orders.id_pesanan')
      ->join('products', 'order_items.id_produk', '=', 'products.id_produk')
      ->join('categories', 'products.id_kategori', '=', 'categories.id_kategori')
      ->whereBetween('orders.created_at', [$startDateObj, $endDateObj])
      ->where('orders.order_status', 'completed')
      ->select('categories.name as label', DB::raw('SUM(order_items.quantity) as count'))
      ->groupBy('categories.id_kategori', 'categories.name')
      ->orderByDesc('count')
      ->get();

    $totalCatItems = $categoryData->sum('count');
    $colors = ['#3B82F6', '#10B981', '#F59E0B', '#8B5CF6', '#EC4899', '#06B6D4', '#EAB308'];
    $categoryDistribution = $categoryData->map(function($cat, $index) use ($totalCatItems, $colors) {
      return [
        'label' => $cat->label,
        'count' => (int)$cat->count,
        'pct' => $totalCatItems > 0 ? round(($cat->count / $totalCatItems) * 100) : 0,
        'color' => $colors[$index % count($colors)],
      ];
    })->toArray();

    // 2. Top Products Bar
    $topProductsData = DB::table('order_items')
      ->join('orders', 'order_items.id_pesanan', '=', 'orders.id_pesanan')
      ->join('products', 'order_items.id_produk', '=', 'products.id_produk')
      ->whereBetween('orders.created_at', [$startDateObj, $endDateObj])
      ->where('orders.order_status', 'completed')
      ->select('products.name', DB::raw('SUM(order_items.quantity) as count'))
      ->groupBy('products.id_produk', 'products.name')
      ->orderByDesc('count')
      ->limit(5)
      ->get();

    $maxProductCount = $topProductsData->max('count');
    $topProducts = $topProductsData->map(function($prod) use ($maxProductCount) {
      return [
        'name' => $prod->name,
        'count' => (int)$prod->count,
        'pct' => $maxProductCount > 0 ? round(($prod->count / $maxProductCount) * 100) : 0,
      ];
    })->toArray();

    // 3. Monthly Comparison (Last 6 Months)
    $monthlyComparison = ['labels' => [], 'revenue' => [], 'orders' => []];
    $sixMonthsAgo = now()->startOfMonth()->subMonths(5);
    
    $monthlyData = Order::where('created_at', '>=', $sixMonthsAgo)
      ->select(
        DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month_str'),
        DB::raw('COUNT(id_pesanan) as total_orders'),
        DB::raw('SUM(CASE WHEN order_status = "completed" THEN total ELSE 0 END) as total_revenue')
      )
      ->groupBy('month_str')
      ->orderBy('month_str')
      ->get()
      ->keyBy('month_str');

    $currentMonth = $sixMonthsAgo->copy();
    for ($i = 0; $i < 6; $i++) {
      $mStr = $currentMonth->format('Y-m');
      $monthlyComparison['labels'][] = $currentMonth->translatedFormat('M Y');
      if ($monthlyData->has($mStr)) {
        $monthlyComparison['revenue'][] = (float)$monthlyData[$mStr]->total_revenue;
        $monthlyComparison['orders'][] = (int)$monthlyData[$mStr]->total_orders;
      } else {
        $monthlyComparison['revenue'][] = 0;
        $monthlyComparison['orders'][] = 0;
      }
      $currentMonth->addMonth();
    }

    return view('admin.reports.sales', compact(
      'orders', 'totalRevenue', 'totalOrders', 'avgOrder', 'daily', 
      'startDate', 'endDate', 'revenueGrowth', 'ordersGrowth', 'avgOrderGrowth',
      'categoryDistribution', 'topProducts', 'monthlyComparison'
    ));
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
