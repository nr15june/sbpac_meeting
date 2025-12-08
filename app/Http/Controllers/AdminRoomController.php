<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use Illuminate\Support\Facades\Storage;

class AdminRoomController extends Controller
{
    // แสดงหน้า meetingroom + รายการห้องทั้งหมด
    public function index()
    {
        $rooms = Room::all();

        return view('admin.meetingroom', compact('rooms'));
    }

    // บันทึกห้องใหม่
    public function store(Request $request)
    {
        $request->validate([
            'room_name'   => 'required|string|max:255',
            'building'    => 'nullable|string|max:255',
            'capacity'    => 'nullable|integer',
            'description' => 'nullable|string',
            'room_image'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('room_image')) {
            $imagePath = $request->file('room_image')->store('rooms', 'public');
        }

        Room::create([
            'room_name'   => $request->room_name,
            'building'    => $request->building,
            'quantity'    => $request->capacity,   // ใช้ field quantity ในฐานข้อมูล
            'description' => $request->description,
            'room_image'  => $imagePath,
        ]);

        return redirect()
            ->route('admin_meetingrooms')
            ->with('success', 'เพิ่มห้องประชุมเรียบร้อยแล้ว');
    }

    // ลบห้อง
    public function destroy(Room $room)
    {
        if ($room->room_image && Storage::disk('public')->exists($room->room_image)) {
            Storage::disk('public')->delete($room->room_image);
        }

        $room->delete();

        return redirect()->back()->with('success', 'ลบห้องประชุมเรียบร้อยแล้ว');
    }

    // แสดงหน้าแก้ไขห้อง
    public function edit($room_id)
    {
        $room = Room::findOrFail($room_id);
        return view('admin.edit_room', compact('room'));
    }

    // อัปเดตข้อมูลห้อง
    public function update(Request $request, $room_id)
    {
        $room = Room::findOrFail($room_id);

        $request->validate([
            'room_name'   => 'required|string|max:255',
            'building'    => 'nullable|string|max:255',
            'capacity'    => 'nullable|integer|min:1',
            'description' => 'nullable|string',
            'room_image'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $room->room_name   = $request->room_name;
        $room->building    = $request->building;
        $room->quantity    = $request->capacity;
        $room->description = $request->description;

        if ($request->hasFile('room_image')) {

            if ($room->room_image && Storage::disk('public')->exists($room->room_image)) {
                Storage::disk('public')->delete($room->room_image);
            }

            $path = $request->file('room_image')->store('rooms', 'public');
            $room->room_image = $path;
        }

        $room->save();

        return redirect()
            ->route('admin_meetingrooms')
            ->with('success', 'แก้ไขข้อมูลห้องประชุมเรียบร้อยแล้ว!');
    }
}
