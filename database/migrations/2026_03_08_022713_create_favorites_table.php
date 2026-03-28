<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->unsignedBigInteger('id_favorit')->autoIncrement()->primary();
            $table->unsignedBigInteger('id_users');
            $table->unsignedBigInteger('id_produk');
            $table->timestamps();

            $table->foreign('id_users')
                ->references('id_users')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('id_produk')
                ->references('id_produk')
                ->on('products')
                ->onDelete('cascade');

            $table->unique(['id_users', 'id_produk']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('favorites');
    }
};
