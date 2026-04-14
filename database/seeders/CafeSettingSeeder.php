<?php

namespace Database\Seeders;

use App\Models\CafeSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CafeSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CafeSetting::factory(10)->create();
    }
}
