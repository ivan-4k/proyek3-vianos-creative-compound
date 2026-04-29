<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
  public function index(Request $request)
  {
    // Ambil 4 produk unggulan
    $featuredMenus = Product::where('is_signature', true)
      ->where('is_available', true)
      ->limit(4)
      ->get();

    // Ambil 4 produk paling populer berdasarkan jumlah pesanan
    $popularMenus = Product::withCount('orderItems')
      ->where('is_available', true)
      ->orderByDesc('order_items_count')
      ->limit(4)
      ->get();

    // Query dasar untuk All Menus section
    $query = Product::with('category')
      ->where('is_available', true);

    // Filter: Search
    $query->when($request->search, function ($q) use ($request) {
      return $q->where('name', 'like', '%' . $request->search . '%');
    });

    // Filter: Category
    $query->when($request->category, function ($q) use ($request) {
      return $q->whereHas('category', function ($sub) use ($request) {
        $sub->where('id_kategori', $request->category);
      });
    });

    // Filter: Price Range
    $query->when($request->price, function ($q) use ($request) {
      if ($request->price === '50000+') {
        return $q->where('price', '>=', 50000);
      } elseif (strpos($request->price, '-') !== false) {
        [$min, $max] = explode('-', $request->price);
        return $q->whereBetween('price', [(int)$min, (int)$max]);
      }
    });

    // Sort
    $query->when($request->sort, function ($q) use ($request) {
      switch ($request->sort) {
        case 'new':
          return $q->orderByDesc('created_at');
        case 'price-asc':
          return $q->orderBy('price', 'asc');
        case 'price-desc':
          return $q->orderBy('price', 'desc');
        case 'popular':
          return $q->withCount('orderItems')
            ->orderByDesc('order_items_count');
        default:
          return $q->orderByDesc('created_at');
      }
    }, function ($q) {
      return $q->orderByDesc('created_at');
    });

    // Paginate
    $allMenus = $query->paginate(8)->withQueryString();

    // Jika AJAX request, return JSON dengan HTML cards
    if ($request->ajax()) {
      $html = view('components.menu.all-menu-items', ['allMenus' => $allMenus])->render();
      return response()->json([
        'html' => $html,
        'next_page_url' => $allMenus->nextPageUrl(),
        'has_more' => $allMenus->hasMorePages(),
      ]);
    }

    // Ambil semua kategori untuk dropdown
    $categories = Category::where('is_active', true)
      ->orderBy('order', 'asc')
      ->get();

    $userFavorites = Auth::check()
      ? Favorite::where('id_users', Auth::id())->pluck('id_produk')->toArray()
      : [];

    // QUERY STATISTIK
    $totalProducts = Product::count();
    $totalCategories = Category::count();
    $recentGallery = Product::whereNotNull('main_image')
      ->latest()
      ->take(4)
      ->get();

    // Mengirim data ke view
    return view('user.menu', compact(
      'featuredMenus',
      'popularMenus',
      'allMenus',
      'categories',
      'userFavorites',
      'totalProducts',
      'totalCategories',
      'recentGallery'
    ));
  }
}
