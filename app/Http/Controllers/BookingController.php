<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        // ตัวอย่างเก็บข้อมูลแบบง่าย ๆ (ยังไม่บันทึก DB)
        // dump($request->all()); // ใช้เช็กข้อมูลตอนกด submit

        return back()->with('success', 'ส่งคำขอจองห้องสำเร็จ!');
    }
}
