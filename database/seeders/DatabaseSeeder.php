<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     *
     * Urutan seeding:
     * 1. Master tables (tanpa foreign key): Category, CafeSetting, User
     * 2. Tables yang depend on master tables: Product, Order
     * 3. Tables yang depend on master tables: Cart, Favorite, Notification, ActivityLog
     * 4. Tables yang depend on Order: OrderItem, WhatsappLog
     * 5. Tables yang depend on Product: ProductDailyStock
     */
    public function run(): void
    {
        // 1. Master Tables (no foreign keys) - eksekusi lebih dulu
        $this->call([
            CategorySeeder::class,
            CafeSettingSeeder::class,
            UserSeeder::class,
        ]);

        // 2. Tables yang depend on master tables
        $this->call([
            ProductSeeder::class,
            OrderSeeder::class,
        ]);

        // 3. Tables yang depend on User dan Product (relationship tables)
        $this->call([
            CartSeeder::class,
            FavoriteSeeder::class,
            NotificationSeeder::class,
            ActivityLogSeeder::class,
        ]);

        // 4. Tables yang depend on Order dan Product
        $this->call([
            OrderItemSeeder::class,
            WhatsappLogSeeder::class,
        ]);

        // 5. Tables yang depend on Product
        $this->call([
            ProductDailyStockSeeder::class,
        ]);
    }
}
