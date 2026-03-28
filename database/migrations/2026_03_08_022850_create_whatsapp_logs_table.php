<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('whatsapp_logs', function (Blueprint $table) {
            $table->unsignedBigInteger('id_wa_log')->autoIncrement()->primary();
            $table->unsignedBigInteger('id_pesanan')->nullable();
            $table->unsignedBigInteger('id_users')->nullable();
            $table->string('destination_number');
            $table->text('message');
            $table->enum('status', ['sent', 'failed', 'pending'])->default('pending');
            $table->text('response')->nullable();
            $table->string('type'); // order_confirmation, payment_reminder, pickup_reminder, etc
            $table->timestamps();

            $table->foreign('id_pesanan')
                ->references('id_pesanan')
                ->on('orders')
                ->onDelete('set null');

            $table->foreign('id_users')
                ->references('id_users')
                ->on('users')
                ->onDelete('set null');

            $table->index('status');
            $table->index('type');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('whatsapp_logs');
    }
};
