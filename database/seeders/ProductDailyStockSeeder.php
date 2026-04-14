<?php

namespace Database\Seeders;

use App\Models\ProductDailyStock;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductDailyStockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductDailyStock::factory(10)->create();
    }
}
