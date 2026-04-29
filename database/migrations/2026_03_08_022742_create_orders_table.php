<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('id_pesanan')->autoIncrement()->primary();
            $table->unsignedBigInteger('id_users');
            $table->string('order_code')->unique();
            $table->string('queue_number')->nullable();
            $table->decimal('subtotal', 12, 2);
            $table->decimal('total', 12, 2);

            // Status
            $table->enum('payment_status', ['pending', 'paid', 'failed', 'refunded'])->default('pending');
            $table->enum('order_status', [
                'pending_confirmation',
                'processing',
                'ready_for_pickup',
                'completed',
                'cancelled'
            ])->default('pending_confirmation');

            // Notes
            $table->text('notes')->nullable();

            $table->timestamps();

            $table->foreign('id_users')
                ->references('id_users')
                ->on('users')
                ->onDelete('restrict');

            $table->index('order_status');
            $table->index('payment_status');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
