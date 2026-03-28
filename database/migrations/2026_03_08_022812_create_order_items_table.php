<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->unsignedBigInteger('id_item_pesanan')->autoIncrement()->primary();
            $table->unsignedBigInteger('id_pesanan');
            $table->unsignedBigInteger('id_produk');
            $table->string('product_name_snapshot');
            $table->decimal('unit_price', 12, 2);
            $table->integer('quantity');
            $table->decimal('subtotal', 12, 2);
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('id_pesanan')
                ->references('id_pesanan')
                ->on('orders')
                ->onDelete('cascade');

            $table->foreign('id_produk')
                ->references('id_produk')
                ->on('products')
                ->onDelete('restrict');

            $table->index('id_pesanan');
            $table->index('id_produk');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
