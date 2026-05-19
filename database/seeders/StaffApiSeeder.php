<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\CafeTable;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StaffApiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Setup Staff User
        $staff = User::firstOrCreate(
            ['email' => 'staff@sevencaffee.com'],
            [
                'name' => 'John Doe (Staff)',
                'password' => Hash::make('password123'),
                'role' => 'staff',
                'is_active' => true,
                'email_verified_at' => now(),
            ]
        );

        // 2. Setup Meja (Cafe Tables)
        $tablesData = [
            ['number' => 'T01', 'capacity' => 2, 'location' => 'indoor', 'status' => 'empty', 'coord_x' => 100, 'coord_y' => 100],
            ['number' => 'T02', 'capacity' => 4, 'location' => 'indoor', 'status' => 'occupied', 'coord_x' => 100, 'coord_y' => 200],
            ['number' => 'T03', 'capacity' => 4, 'location' => 'indoor', 'status' => 'reserved', 'coord_x' => 100, 'coord_y' => 320],
            ['number' => 'T04', 'capacity' => 6, 'location' => 'outdoor', 'status' => 'empty', 'coord_x' => 300, 'coord_y' => 100],
            ['number' => 'T05', 'capacity' => 2, 'location' => 'outdoor', 'status' => 'maintenance', 'coord_x' => 300, 'coord_y' => 220],
            ['number' => 'V01', 'capacity' => 8, 'location' => 'vip', 'status' => 'empty', 'coord_x' => 300, 'coord_y' => 350],
        ];

        foreach ($tablesData as $tData) {
            CafeTable::updateOrCreate(
                ['number' => $tData['number']],
                [
                    'capacity' => $tData['capacity'],
                    'location' => $tData['location'],
                    'status' => $tData['status'],
                    'coord_x' => $tData['coord_x'],
                    'coord_y' => $tData['coord_y'],
                    'qr_code' => CafeTable::generateQrCode($tData['number']),
                ]
            );
        }

        // 3. Setup Attendances (Absensi 5 hari terakhir)
        for ($i = 4; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i);
            
            // Skip weekend if you want, or just add
            if ($date->isWeekend()) continue;

            $clockIn = $date->copy()->setHour(8)->setMinute(rand(0, 15));
            $clockOut = $date->copy()->setHour(17)->setMinute(rand(0, 30));
            $workHours = round($clockOut->diffInMinutes($clockIn) / 60, 2);

            Attendance::firstOrCreate(
                [
                    'id_users' => $staff->id_users,
                    'date' => $date->toDateString(),
                ],
                [
                    'clock_in_time' => $clockIn->format('H:i:s'),
                    'clock_out_time' => $clockOut->format('H:i:s'),
                    'work_hours' => $workHours,
                    'status' => 'present',
                    'lat_in' => -6.1751,
                    'lng_in' => 106.8650,
                    'lat_out' => -6.1751,
                    'lng_out' => 106.8650,
                ]
            );
        }

        // 4. Setup Dummy Order
        $products = Product::inRandomOrder()->limit(3)->get();
        
        if ($products->count() > 0) {
            $table = CafeTable::where('number', 'T02')->first();
            
            if ($table) {
                // Buat 1 Order Pending
                $order1 = Order::create([
                    'id_users' => $staff->id_users,
                    'table_id' => $table->id,
                    'customer_name' => 'Budi Pelanggan',
                    'order_code' => 'ORD-' . date('Ymd') . '-' . Str::random(5),
                    'queue_number' => rand(1, 100),
                    'subtotal' => 0,
                    'total' => 0,
                    'payment_status' => 'unpaid',
                    'order_status' => 'pending_confirmation',
                    'notes' => 'Tolong diantar cepat',
                ]);

                $total1 = 0;
                foreach ($products as $product) {
                    $qty = rand(1, 2);
                    $subtotal = $product->price * $qty;
                    $total1 += $subtotal;

                    OrderItem::create([
                        'id_pesanan' => $order1->id_pesanan,
                        'id_produk' => $product->id_produk,
                        'product_name_snapshot' => $product->name,
                        'unit_price' => $product->price,
                        'quantity' => $qty,
                        'subtotal' => $subtotal,
                        'notes' => 'Tidak pakai gula',
                    ]);
                }
                
                $order1->update(['subtotal' => $total1, 'total' => $total1]);
                
                // Buat 1 Order Preparing
                $order2 = Order::create([
                    'id_users' => $staff->id_users,
                    'table_id' => $table->id,
                    'customer_name' => 'Siti (T02)',
                    'order_code' => 'ORD-' . date('Ymd') . '-' . Str::random(5),
                    'queue_number' => rand(1, 100),
                    'subtotal' => 0,
                    'total' => 0,
                    'payment_status' => 'paid',
                    'order_status' => 'processing',
                ]);

                $total2 = 0;
                $product2 = $products->first();
                $sub2 = $product2->price * 2;
                $total2 += $sub2;
                
                OrderItem::create([
                    'id_pesanan' => $order2->id_pesanan,
                    'id_produk' => $product2->id_produk,
                    'product_name_snapshot' => $product2->name,
                    'unit_price' => $product2->price,
                    'quantity' => 2,
                    'subtotal' => $sub2,
                ]);

                $order2->update(['subtotal' => $total2, 'total' => $total2]);
            }
        }
    }
}
