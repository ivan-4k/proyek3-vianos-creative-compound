<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_daily_stocks', function (Blueprint $table) {
            $table->unsignedBigInteger('id_stok')->autoIncrement()->primary();
            $table->unsignedBigInteger('id_produk');
            $table->date('date');
            $table->integer('stock');
            $table->integer('remaining_stock');
            $table->timestamps();

            $table->foreign('id_produk')
                ->references('id_produk')
                ->on('products')
                ->onDelete('cascade');

            $table->unique(['id_produk', 'date']);
            $table->index('date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_daily_stocks');
    }
};
