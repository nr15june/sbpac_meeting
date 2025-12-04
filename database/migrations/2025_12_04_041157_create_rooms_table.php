<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id('room_id');                 // PK
            $table->string('room_name');           // ชื่อห้อง
            $table->string('building')->nullable(); // อาคาร / ชั้น
            $table->integer('quantity')->nullable(); // จำนวนคนต่อห้อง
            $table->text('description')->nullable(); // รายละเอียดห้อง
            $table->string('room_image')->nullable(); // รูปภาพ
            $table->timestamps();                  // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
