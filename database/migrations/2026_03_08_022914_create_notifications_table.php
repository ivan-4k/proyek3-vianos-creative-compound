<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->unsignedBigInteger('id_notifikasi')->autoIncrement()->primary();
            $table->unsignedBigInteger('id_users');
            $table->string('title');
            $table->text('message');
            $table->string('type'); // order, promo, system, whatsapp
            $table->json('data')->nullable();
            $table->boolean('is_read')->default(false);
            $table->timestamp('read_at')->nullable();
            $table->timestamps();

            $table->foreign('id_users')
                ->references('id_users')
                ->on('users')
                ->onDelete('cascade');

            $table->index('is_read');
            $table->index('type');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
