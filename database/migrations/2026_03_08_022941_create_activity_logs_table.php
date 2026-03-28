<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->unsignedBigInteger('id_aktivitas')->autoIncrement()->primary();
            $table->unsignedBigInteger('id_users')->nullable();
            $table->string('action'); // create, update, delete, login, logout, view
            $table->string('entity'); // order, product, user, category, setting
            $table->unsignedBigInteger('entity_id')->nullable();
            $table->json('old_data')->nullable();
            $table->json('new_data')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamps();

            $table->foreign('id_users')
                ->references('id_users')
                ->on('users')
                ->onDelete('set null');

            $table->index('entity');
            $table->index('action');
            $table->index('created_at');
            $table->index(['entity', 'entity_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
