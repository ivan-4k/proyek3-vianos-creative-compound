<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\Order;
use App\Models\Product;
use App\AI\Models\RevenuePredictor;
use App\AI\Models\DemandForecast;
use Carbon\Carbon;

class TrainAiModelsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $sixMonthsAgo = now()->subMonths(6)->startOfDay();
        
        // Buat folder jika belum ada
        if (!Storage::disk('local')->exists('ai-models')) {
            Storage::disk('local')->makeDirectory('ai-models');
        }

        $this->trainRevenuePredictor($sixMonthsAgo);
        $this->trainDemandForecaster($sixMonthsAgo);
    }

    private function trainRevenuePredictor($startDate)
    {
        // Kumpulkan data harian
        $dailyOrders = Order::where('order_status', 'completed')
            ->where('created_at', '>=', $startDate)
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total) as daily_total'))
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->keyBy('date');

        $samples = [];
        $labels = [];
        
        $cursor = $startDate->copy();
        $today = now()->startOfDay();
        
        $lastDayRevenue = 0;
        $dataCount = 0;

        while ($cursor->lte($today)) {
            $dateString = $cursor->format('Y-m-d');
            $revenue = $dailyOrders->has($dateString) ? (float) $dailyOrders[$dateString]->daily_total : 0.0;
            
            // Fitur: month, day_of_month, day_of_week, is_weekend, lag_1_day_revenue
            $samples[] = [
                (float) $cursor->month,
                (float) $cursor->day,
                (float) $cursor->dayOfWeekIso,
                (float) ($cursor->isWeekend() ? 1 : 0),
                (float) $lastDayRevenue
            ];
            
            $labels[] = $revenue;
            
            $lastDayRevenue = $revenue;
            $cursor->addDay();
            $dataCount++;
        }

        if ($dataCount < 10) {
            Log::channel('ai')->warning("Data Revenue terlalu sedikit untuk training ({$dataCount} baris).");
            return;
        }

        try {
            $predictor = new RevenuePredictor();
            $mae = $predictor->train($samples, $labels);
            Log::channel('ai')->info("Model RevenuePredictor berhasil ditraining. MAE: " . round($mae, 2));
        } catch (\Exception $e) {
            Log::channel('ai')->error("Gagal training RevenuePredictor: " . $e->getMessage());
        }
    }

    private function trainDemandForecaster($startDate)
    {
        $products = Product::where('is_available', true)->get();

        foreach ($products as $product) {
            $dailySales = DB::table('order_items')
                ->join('orders', 'order_items.id_pesanan', '=', 'orders.id_pesanan')
                ->where('orders.order_status', 'completed')
                ->where('orders.created_at', '>=', $startDate)
                ->where('order_items.id_produk', $product->id_produk)
                ->select(DB::raw('DATE(orders.created_at) as date'), DB::raw('SUM(order_items.quantity) as daily_qty'))
                ->groupBy('date')
                ->orderBy('date')
                ->get()
                ->keyBy('date');

            $samples = [];
            $labels = [];
            
            $cursor = $startDate->copy();
            $today = now()->subDay()->startOfDay();
            
            $lastDayQty = 0;
            $dataCount = 0;

            while ($cursor->lte($today)) {
                $dateString = $cursor->format('Y-m-d');
                $qty = $dailySales->has($dateString) ? (int) $dailySales[$dateString]->daily_qty : 0;
                
                // Fitur: month, day_of_month, day_of_week, is_weekend, lag_1_day_sales_qty
                $samples[] = [
                    (float) $cursor->month,
                    (float) $cursor->day,
                    (float) $cursor->dayOfWeekIso,
                    (float) ($cursor->isWeekend() ? 1 : 0),
                    (float) $lastDayQty
                ];
                
                $labels[] = (float) $qty;
                
                $lastDayQty = $qty;
                $cursor->addDay();
                $dataCount++;
            }

            // Minimal 30 baris/hari untuk product
            if ($dataCount < 30) {
                continue;
            }

            try {
                $forecaster = new DemandForecast($product->id_produk);
                $mae = $forecaster->train($samples, $labels);
                Log::channel('ai')->info("Model DemandForecast [Produk {$product->id_produk}] berhasil ditraining. MAE: " . round($mae, 2));
            } catch (\Exception $e) {
                Log::channel('ai')->error("Gagal training DemandForecast [Produk {$product->id_produk}]: " . $e->getMessage());
            }
        }
    }
}
