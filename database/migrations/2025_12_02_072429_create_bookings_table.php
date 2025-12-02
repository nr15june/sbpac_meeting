<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('bookings', function (Blueprint $table) {
        $table->id('booking_id');
        $table->string('name');
        $table->string('lastname');
        $table->string('phone');
        $table->string('email');
        $table->string('department');
        $table->string('meeting_topic');
        $table->dateTime('start_time');
        $table->dateTime('end_time');
        $table->string('status')->default('pending');
        $table->unsignedBigInteger('room_id');   // FK ห้อง
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
