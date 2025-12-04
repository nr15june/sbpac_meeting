<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class AdminRoomController extends Controller
{
    // แสดงหน้า meetingroom + รายการห้องทั้งหมด
    public function index()
    {
        $rooms = Room::all();   // ถ้ายังไม่ใช้จะแค่ $rooms ไว้ก็ได้

        // ให้ชี้ไปที่ resources/views/admin/meetingroom.blade.php
        return view('admin.meetingroom', compact('rooms'));
    }

    // บันทึกห้องใหม่
    public function store(Request $request)
    {
        // validate
        $request->validate([
            'room_name'   => 'required|string|max:255',
            'building'    => 'nullable|string|max:255',
            'capacity'    => 'nullable|integer',
            'description' => 'nullable|string',
            'room_image'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // อัปโหลดรูป
        $imagePath = null;
        if ($request->hasFile('room_image')) {
            $imagePath = $request->file('room_image')->store('rooms', 'public');
        }

        // บันทึกข้อมูลลง DB
        Room::create([
            'room_name'   => $request->room_name,
            'building'    => $request->building,
            'quantity'    => $request->capacity,   // map ไปยัง field quantity
            'description' => $request->description,
            'room_image'  => $imagePath,
        ]);

        // เสร็จแล้วเด้งกลับหน้า meetingroom
        return redirect()
            ->route('admin_meetingrooms')   // ชื่อตรงกับ route ที่เตงตั้งแล้ว
            ->with('success', 'เพิ่มห้องประชุมเรียบร้อยแล้ว');
    }
}
