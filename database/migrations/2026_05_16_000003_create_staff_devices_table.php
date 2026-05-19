<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('staff_devices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_users');
            $table->text('device_token');
            $table->enum('device_type', ['android', 'ios'])->default('android');
            $table->string('device_name')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamp('last_used_at')->nullable();
            $table->timestamps();

            $table->foreign('id_users')->references('id_users')->on('users')->onDelete('cascade');
            $table->index('id_users');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('staff_devices');
    }
};
