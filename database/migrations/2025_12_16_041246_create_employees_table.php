<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();

            $table->string('citizen_id', 13)->unique();

            // 🔐 สำหรับ login
            $table->string('email')->unique();
            $table->string('password');

            // 👤 ข้อมูลพนักงาน
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone', 20)->nullable();

            // 🏢 กลุ่มงาน
            $table->unsignedBigInteger('department_id')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
