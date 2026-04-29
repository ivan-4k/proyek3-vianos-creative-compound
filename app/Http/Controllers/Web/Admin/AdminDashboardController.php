<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
  public function index()
  {
    // Statistik dasar
    $totalProducts = Product::count();
    $totalCategories = Category::count();
    $totalUsers = User::count();
    $newThisWeek = Product::where('created_at', '>=', now()->subDays(7))->count();
    // Pesanan
    $todayOrders = Order::whereDate('created_at', today())->count();
    $activeOrders = Order::whereIn('order_status', ['pending_confirmation', 'processing'])->count();

    // Pendapatan
    $todayRevenue = Order::where('order_status', 'completed')
      ->whereDate('created_at', today())
      ->sum('total');

    $monthRevenue = Order::where('order_status', 'completed')
      ->whereMonth('created_at', now()->month)
      ->whereYear('created_at', now()->year)
      ->sum('total');

    // Data untuk charts
    $orderChart = $this->getOrderChartData();
    $revenueChart = $this->getRevenueChartData();

    // Pesanan terbaru
    $recentOrders = Order::with('user')
      ->latest()
      ->take(5)
      ->get();

    return view('admin.dashboard.index', compact(
      'totalProducts',
      'totalCategories',
      'totalUsers',
      'todayOrders',
      'activeOrders',
      'todayRevenue',
      'monthRevenue',
      'orderChart',
      'revenueChart',
      'recentOrders',
      'newThisWeek'
    ));
  }

  // API untuk AJAX refresh
  public function getStatistics()
  {
    return response()->json([
      'today_orders' => Order::whereDate('created_at', today())->count(),
      'today_revenue' => Order::where('order_status', 'completed')->whereDate('created_at', today())->sum('total'),
      'active_orders' => Order::whereIn('order_status', ['pending_confirmation', 'processing'])->count(),
    ]);
  }

  private function getOrderChartData()
  {
    $dates = collect();
    for ($i = 6; $i >= 0; $i--) {
      $dates->push(now()->subDays($i)->format('Y-m-d'));
    }

    $orders = Order::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
      ->where('created_at', '>=', now()->subDays(6))
      ->groupBy('date')
      ->pluck('total', 'date');

    $data = [];
    foreach ($dates as $date) {
      $data[] = $orders->get($date, 0);
    }

    return [
      'labels' => $dates->map(fn($d) => \Carbon\Carbon::parse($d)->translatedFormat('d M'))->toArray(),
      'data' => $data,
    ];
  }
  
  private function getRevenueChartData()
  {
    $dates = collect();
    for ($i = 6; $i >= 0; $i--) {
      $dates->push(now()->subDays($i)->format('Y-m-d'));
    }

    $revenues = Order::select(DB::raw('DATE(created_at) as date'), DB::raw('sum(total) as total'))
      ->where('order_status', 'completed')
      ->where('created_at', '>=', now()->subDays(6))
      ->groupBy('date')
      ->pluck('total', 'date');

    $data = [];
    foreach ($dates as $date) {
      $data[] = $revenues->get($date, 0);
    }

    return [
      'labels' => $dates->map(fn($d) => \Carbon\Carbon::parse($d)->translatedFormat('d M'))->toArray(),
      'data' => $data,
    ];
  }
}
