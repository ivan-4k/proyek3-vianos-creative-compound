<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cafe_tables', function (Blueprint $table) {
            $table->id();
            $table->string('number', 20)->unique(); // T01, T02, dst
            $table->unsignedTinyInteger('capacity')->default(4);
            $table->enum('location', ['indoor', 'outdoor', 'vip'])->default('indoor');
            $table->enum('status', ['empty', 'occupied', 'reserved', 'maintenance'])->default('empty');
            $table->integer('coord_x')->nullable();
            $table->integer('coord_y')->nullable();
            $table->integer('width')->default(80);
            $table->integer('height')->default(60);
            $table->string('qr_code')->unique()->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index('status');
            $table->index('location');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cafe_tables');
    }
};
