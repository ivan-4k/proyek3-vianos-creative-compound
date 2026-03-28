<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->unsignedBigInteger('id_produk')->autoIncrement()->primary();
            $table->unsignedBigInteger('id_kategori');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->decimal('price', 12, 2);
            $table->integer('stock')->default(0);
            $table->string('main_image')->nullable();
            $table->boolean('is_available')->default(true);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_kategori')
                ->references('id_kategori')
                ->on('categories')
                ->onDelete('restrict');

            $table->index('is_available');
            $table->index('price');
            $table->index('name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
