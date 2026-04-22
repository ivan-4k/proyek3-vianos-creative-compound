<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cafe_settings', function (Blueprint $table) {
            $table->unsignedBigInteger('id_setting')->autoIncrement()->primary();

            $table->time('weekday_opening_time')->default('09:00:00');
            $table->time('weekday_closing_time')->default('02:00:00');

            $table->time('weekend_opening_time')->default('08:00:00');
            $table->time('weekend_closing_time')->default('02:00:00');

            $table->boolean('is_open')->default(true);
            $table->boolean('is_order_open')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cafe_settings');
    }
};
