<?php

namespace Database\Seeders;

use App\Models\WhatsappLog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WhatsappLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WhatsappLog::factory(10)->create();
    }
}
