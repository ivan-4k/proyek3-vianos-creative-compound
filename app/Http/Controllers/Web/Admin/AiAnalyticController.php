<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\AI\Models\RevenuePredictor;
use App\AI\Models\DemandForecast;

class AiAnalyticController extends Controller
{
    public function index()
    {
        // =========================================================
        // 1. PREDIKSI PENDAPATAN & GROWTH
        // =========================================================
        $currentMonthStart = now()->startOfMonth();
        $currentMonthEnd   = now()->endOfMonth();
        $daysInMonth       = $currentMonthEnd->day;
        $daysPassed        = now()->day;

        $currentRevenue = Order::where('order_status', 'completed')
            ->whereBetween('created_at', [$currentMonthStart, now()])
            ->sum('total');

        $revenuePredictor = new RevenuePredictor();
        
        if ($revenuePredictor->exists()) {
            $predictedRevenue = $currentRevenue;
            $cursor = now()->addDay()->startOfDay();
            $lastDayRevenue = Order::where('order_status', 'completed')
                ->where('created_at', '>=', now()->startOfDay())
                ->sum('total');

            while ($cursor->lte($currentMonthEnd)) {
                $features = [
                    [(float) $cursor->month, (float) $cursor->day, (float) $cursor->dayOfWeekIso, (float) ($cursor->isWeekend() ? 1 : 0), (float) $lastDayRevenue]
                ];
                
                $pred = $revenuePredictor->predict($features);
                $dailyPred = max(0, $pred[0]);
                
                $predictedRevenue += $dailyPred;
                $lastDayRevenue = $dailyPred;
                $cursor->addDay();
            }
        } else {
            // Fallback
            $predictedRevenue = $daysPassed > 0
                ? ($currentRevenue / $daysPassed) * $daysInMonth
                : 0;
        }

        $lastMonthStart = now()->subMonth()->startOfMonth();
        $lastMonthEnd   = now()->subMonth()->endOfMonth();
        $lastRevenue    = Order::where('order_status', 'completed')
            ->whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])
            ->sum('total');

        $revenueGrowth = $lastRevenue > 0
            ? (($predictedRevenue - $lastRevenue) / $lastRevenue) * 100
            : 0;

        // =========================================================
        // 2. RETENSI PELANGGAN
        // =========================================================
        $threeMonthsAgo = now()->subMonths(3)->startOfMonth();

        $usersOrdered = DB::table('orders')
            ->where('order_status', 'completed')
            ->where('created_at', '>=', $threeMonthsAgo)
            ->whereNotNull('id_users')
            ->select('id_users', DB::raw('COUNT(*) as order_count'))
            ->groupBy('id_users')
            ->get();

        $totalUsers     = $usersOrdered->count();
        $returningUsers = $usersOrdered->where('order_count', '>', 1)->count();
        $retentionRate  = $totalUsers > 0
            ? ($returningUsers / $totalUsers) * 100
            : 0;

        // =========================================================
        // 3. REKOMENDASI RESTOK
        //    FIX: $urgencyDays sebelumnya mencampur satuan (hari vs unit).
        //         Sekarang urgency murni dari $daysLeft (satuan: hari).
        //         Kondisi stok fisik rendah (< 10 unit) tetap dipakai
        //         sebagai TRIGGER masuk daftar, bukan untuk mixing nilai.
        // =========================================================
        $products       = Product::where('is_available', true)->get();
        $thirtyDaysAgo  = now()->subDays(30);

        $salesLast30Days = DB::table('order_items')
            ->join('orders', 'order_items.id_pesanan', '=', 'orders.id_pesanan')
            ->where('orders.order_status', 'completed')
            ->where('orders.created_at', '>=', $thirtyDaysAgo)
            ->select('id_produk', DB::raw('SUM(quantity) as total_sold'))
            ->groupBy('id_produk')
            ->pluck('total_sold', 'id_produk');

        $restockItems = [];

        foreach ($products as $product) {
            $forecaster = new DemandForecast($product->id_produk);
            
            if ($forecaster->exists()) {
                $lastDayQty = DB::table('order_items')
                    ->join('orders', 'order_items.id_pesanan', '=', 'orders.id_pesanan')
                    ->where('orders.order_status', 'completed')
                    ->where('orders.created_at', '>=', now()->startOfDay())
                    ->where('order_items.id_produk', $product->id_produk)
                    ->sum('order_items.quantity');
                
                $cursor = now()->addDay()->startOfDay();
                $totalPredQty = 0;
                $daysToPredict = 30;
                
                for ($i = 0; $i < $daysToPredict; $i++) {
                    $features = [
                        [(float) $cursor->month, (float) $cursor->day, (float) $cursor->dayOfWeekIso, (float) ($cursor->isWeekend() ? 1 : 0), (float) $lastDayQty]
                    ];
                    
                    $pred = $forecaster->predict($features);
                    $dailyPred = max(0, $pred[0]);
                    
                    $totalPredQty += $dailyPred;
                    $lastDayQty = $dailyPred;
                    $cursor->addDay();
                }
                
                $dailyAvgSales = $totalPredQty / $daysToPredict;
            } else {
                // Fallback
                $soldLast30    = $salesLast30Days->get($product->id_produk, 0);
                $dailyAvgSales = $soldLast30 / 30;
            }

            // Sisa hari berdasarkan burn-rate
            $daysLeft = ($dailyAvgSales > 0)
                ? ($product->stock / $dailyAvgSales)
                : 999;

            // Trigger: burn-rate kritis (<= 14 hari) ATAU stok fisik rendah (< 10 unit)
            if ($daysLeft <= 14 || $product->stock < 10) {

                // FIX: $urgencyDays HANYA dari $daysLeft (satuan konsisten = hari).
                // Jika produk tidak pernah terjual (daysLeft = 999) tapi stok fisik
                // rendah, kita override ke nilai "hari estimasi" berdasarkan stok
                // minimum supaya tetap masuk kategori urgensi yang masuk akal.
                if ($dailyAvgSales > 0) {
                    $urgencyDays = $daysLeft;
                } else {
                    // Tidak ada data penjualan, pakai stok fisik sebagai proxy
                    // (anggap 1 unit = 1 hari sebagai worst-case sederhana)
                    $urgencyDays = $product->stock;
                }

                if ($urgencyDays <= 3) {
                    $risk  = 'Tinggi';
                    $color = 'text-red-500';
                    $width = 'w-[90%]';
                } elseif ($urgencyDays <= 7) {
                    $risk  = 'Sedang';
                    $color = 'text-amber-500';
                    $width = 'w-[75%]';
                } else {
                    $risk  = 'Rendah';
                    $color = 'text-green-500';
                    $width = 'w-[40%]';
                }

                $restockItems[] = [
                    'item'      => $product->name,
                    'risk'      => $risk,
                    'time'      => ceil($urgencyDays) . ' Hari Lagi',
                    'color'     => $color,
                    'width'     => $width,
                    'days_left' => $urgencyDays,
                ];
            }
        }

        // Urutkan dari paling mendesak, ambil top 4
        usort($restockItems, fn($a, $b) => $a['days_left'] <=> $b['days_left']);
        $restockItems = array_slice($restockItems, 0, 4);
        $restockCount = count($restockItems);

        // =========================================================
        // 4. DATA FORECAST PENDAPATAN (Chart)
        //    FIX 1: $chartUnit dihitung SETELAH mengumpulkan semua
        //           revenue bulanan (bukan dari max() satu order).
        //    FIX 2: Guard end() untuk array kosong.
        // =========================================================
        $chartLabels  = [];
        $chartData    = [];
        $trendValues  = [];
        $monthCursor  = now()->subMonths(4)->startOfMonth();

        // --- Kumpulkan 5 bulan historis dalam satuan Rupiah mentah ---
        $rawMonthlyRevenues = [];
        $rawMonthLabels     = [];

        for ($i = 0; $i < 5; $i++) {
            $mStart = $monthCursor->copy()->startOfMonth();
            $mEnd   = $monthCursor->copy()->endOfMonth();

            $mRev = Order::where('order_status', 'completed')
                ->whereBetween('created_at', [$mStart, $mEnd])
                ->sum('total');

            $rawMonthlyRevenues[] = (float) $mRev;
            $rawMonthLabels[]     = $monthCursor->translatedFormat('M');

            $monthCursor->addMonth();
        }

        // FIX: Tentukan unit SETELAH tahu semua nilai bulanan
        $maxMonthRev  = !empty($rawMonthlyRevenues) ? max($rawMonthlyRevenues) : 0;
        $chartUnit    = $maxMonthRev >= 1_000_000 ? 1_000_000 : ($maxMonthRev >= 1_000 ? 1_000 : 1);
        $chartUnitLabel = match ($chartUnit) {
            1_000_000 => 'Juta',
            1_000     => 'Ribu',
            default   => 'Rupiah',
        };

        // Scale nilai historis
        foreach ($rawMonthlyRevenues as $idx => $rev) {
            $scaled          = round($rev / $chartUnit, 1);
            $chartLabels[]   = $rawMonthLabels[$idx];
            $chartData[]     = $scaled;
            $trendValues[]   = $scaled;
        }

        // --- Prediksi 3 bulan ke depan ---
        $avgGrowth = 0;

        if (count($trendValues) > 1) {
            $growths = [];
            for ($i = 1; $i < count($trendValues); $i++) {
                $growths[] = $trendValues[$i] - $trendValues[$i - 1];
            }
            $avgGrowth = count($growths) > 0
                ? array_sum($growths) / count($growths)
                : 0;
        }

        // FIX: Guard jika $trendValues kosong
        $lastVal = !empty($trendValues) ? end($trendValues) : 0;

        for ($i = 0; $i < 3; $i++) {
            $nextVal       = max(0, $lastVal + $avgGrowth);
            $chartLabels[] = $monthCursor->translatedFormat('M') . ' (P)';
            $chartData[]   = round($nextVal, 1);
            $lastVal       = $nextVal;
            $monthCursor->addMonth();
        }

        // =========================================================
        // 5. AI STRATEGY INSIGHT
        // =========================================================
        $busiestDayRaw = DB::table('orders')
            ->where('order_status', 'completed')
            ->where('created_at', '>=', $threeMonthsAgo)
            ->select(
                DB::raw('DAYOFWEEK(created_at) as day_num'),
                DB::raw('COUNT(*) as order_count')
            )
            ->groupBy('day_num')
            ->orderByDesc('order_count')
            ->first();

        $daysMap    = [1=>'Minggu', 2=>'Senin', 3=>'Selasa', 4=>'Rabu', 5=>'Kamis', 6=>'Jumat', 7=>'Sabtu'];
        $busiestDay = $busiestDayRaw ? $daysMap[$busiestDayRaw->day_num] : 'Akhir Pekan';

        $topCatRaw = DB::table('order_items')
            ->join('orders',     'order_items.id_pesanan',  '=', 'orders.id_pesanan')
            ->join('products',   'order_items.id_produk',   '=', 'products.id_produk')
            ->join('categories', 'products.id_kategori',    '=', 'categories.id_kategori')
            ->where('orders.order_status', 'completed')
            ->where('orders.created_at', '>=', $threeMonthsAgo)
            ->select('categories.name', DB::raw('SUM(order_items.quantity) as total_qty'))
            ->groupBy('categories.id_kategori', 'categories.name')
            ->orderByDesc('total_qty')
            ->first();

        $topCategory = $topCatRaw ? $topCatRaw->name : 'Minuman';

        $aiInsightText = '';
        $apiKey        = env('GROQ_API_KEY');

        if ($apiKey) {
            try {
                $prompt = "Sebagai Data Analyst Cafe 'Vianos Creative Compound', berikan 1 paragraf singkat (maksimal 3 kalimat) berupa insight dan saran strategi bisnis. Jangan gunakan salam, langsung berikan insight. \n\nData Bulan Ini:\n"
                    . "- Hari paling ramai: {$busiestDay}\n"
                    . "- Kategori terlaris: {$topCategory}\n"
                    . "- Pertumbuhan pendapatan: " . round($revenueGrowth, 1) . "%\n"
                    . "- Tingkat retensi pelanggan: " . round($retentionRate, 1) . "%\n\n"
                    . "Buatlah kalimat yang profesional, analitis, dan berikan saran aksi yang konkret (contoh: bundle, promo, penyiapan stok). Gunakan sedikit tag HTML dasar seperti <b> untuk penekanan jika perlu, lalu berikan saran dengan awalan <br><br><span class=\"text-cyan-500 font-bold italic\">Saran AI:</span>";

                $response = \Illuminate\Support\Facades\Http::timeout(15)
                    ->withHeaders([
                        'Authorization' => 'Bearer ' . $apiKey,
                        'Content-Type'  => 'application/json',
                    ])
                    ->post('https://api.groq.com/openai/v1/chat/completions', [
                        'model'    => env('GROQ_MODEL', 'llama-3.1-8b-instant'),
                        'messages' => [
                            [
                                'role'    => 'system',
                                'content' => 'Kamu adalah asisten AI Analitik bisnis restoran/kafe yang sangat ahli dalam membaca data operasional.',
                            ],
                            ['role' => 'user', 'content' => $prompt],
                        ],
                        'temperature' => 0.7,
                        'max_tokens'  => 400,
                    ]);

                if ($response->successful()) {
                    $data          = $response->json();
                    $aiInsightText = trim($data['choices'][0]['message']['content']);
                }
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Groq AI Analytic Error: ' . $e->getMessage());
            }
        }

        if (empty($aiInsightText)) {
            $aiInsightText = "Berdasarkan data 3 bulan terakhir, terjadi lonjakan kunjungan yang konsisten pada hari <b>{$busiestDay}</b> untuk kategori <b>\"{$topCategory}\"</b>.<br><br>"
                . "<span class=\"text-cyan-500 font-bold italic\">Saran AI:</span> Siapkan stok bahan baku terkait ekstra 20% menjelang hari {$busiestDay}, serta tawarkan bundle promo untuk kategori {$topCategory} guna meningkatkan rata-rata transaksi harian.";
        }

        // --- Formatter mata uang untuk Blade ---
        if ($predictedRevenue >= 1_000_000) {
            $predictedRevenueText = 'Rp ' . number_format($predictedRevenue / 1_000_000, 1, ',', '.') . 'Jt';
        } elseif ($predictedRevenue >= 1_000) {
            $predictedRevenueText = 'Rp ' . number_format($predictedRevenue / 1_000, 1, ',', '.') . 'Rb';
        } else {
            $predictedRevenueText = 'Rp ' . number_format($predictedRevenue, 0, ',', '.');
        }

        // =========================================================
        // 6. PREDIKSI JAM RAMAI
        // =========================================================
        $hourAnalysis = DB::table('orders')
            ->where('order_status', 'completed')
            ->where('created_at', '>=', now()->subMonths(3))
            ->select(
                DB::raw('HOUR(created_at) as hour'),
                DB::raw('COUNT(*) as total_orders')
            )
            ->groupBy('hour')
            ->orderBy('hour')
            ->get();

        $peakHourLabels = [];
        $peakHourData   = [];

        for ($h = 0; $h < 24; $h++) {
            $peakHourLabels[] = sprintf('%02d:00', $h);
            $found            = $hourAnalysis->where('hour', $h)->first();
            $peakHourData[]   = $found ? $found->total_orders : 0;
        }

        return view('admin.ai.index', compact(
            'predictedRevenue',
            'predictedRevenueText',
            'revenueGrowth',
            'retentionRate',
            'restockItems',
            'restockCount',
            'chartLabels',
            'chartData',
            'chartUnitLabel',
            'aiInsightText',
            'peakHourLabels',
            'peakHourData'
        ));
    }
}