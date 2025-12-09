<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Booking;

class BookingController extends Controller
{
    // ================ ฝั่ง User ================

    // แสดงฟอร์มจองของห้องที่เลือกมา
    public function create($room_id)
    {
        $room = Room::findOrFail($room_id);
        return view('user.create_booking', compact('room'));
    }

    // รับฟอร์มจากหน้า create_booking แล้วบันทึก
    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_id'       => 'required|exists:rooms,room_id',
            'use_date'      => 'required|date',

            'start_time'    => 'required',
            'end_time'      => 'required|after:start_time',

            'meeting_topic' => 'required|string|max:255',
            'department'    => 'required|string|max:255',

            'first_name'    => 'required|string|max:100',
            'last_name'     => 'required|string|max:100',
            'phone'         => 'required|string|max:50',
            'email'         => 'required|email|max:255',
        ]);

        // รวมวันที่ + เวลา → datetime
        $startDateTime = $validated['use_date'].' '.$validated['start_time'];
        $endDateTime   = $validated['use_date'].' '.$validated['end_time'];

        Booking::create([
            'room_id'       => $validated['room_id'],
            'meeting_topic' => $validated['meeting_topic'],
            'department'    => $validated['department'],

            'name'          => $validated['first_name'],
            'lastname'      => $validated['last_name'],
            'phone'         => $validated['phone'],
            'email'         => $validated['email'],

            'start_time'    => $startDateTime,
            'end_time'      => $endDateTime,
        ]);

        return redirect()->route('user_history_booking')
            ->with('success', 'จองห้องประชุมเรียบร้อยแล้ว');
    }

    // ================ ฝั่ง Admin ================

    // หน้าแก้ไขการจอง
    public function edit($id)
    {
        $booking = Booking::with('room')->findOrFail($id);

        // แยกวันที่ / เวลา ไว้เติมใน input type="date" & "time"
        $use_date   = $booking->start_time ? $booking->start_time->format('Y-m-d') : null;
        $start_time = $booking->start_time ? $booking->start_time->format('H:i') : null;
        $end_time   = $booking->end_time   ? $booking->end_time->format('H:i')   : null;

        return view('admin.edit_booking', compact('booking', 'use_date', 'start_time', 'end_time'));
    }

    // บันทึกข้อมูลที่แก้ไข
    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        $validated = $request->validate([
            'use_date'      => 'required|date',
            'start_time'    => 'required',
            'end_time'      => 'required|after:start_time',

            'meeting_topic' => 'required|string|max:255',
            'department'    => 'required|string|max:255',

            'name'          => 'required|string|max:100',
            'lastname'      => 'required|string|max:100',
            'phone'         => 'required|string|max:50',
            'email'         => 'required|email|max:255',
        ]);

        $startDateTime = $validated['use_date'].' '.$validated['start_time'];
        $endDateTime   = $validated['use_date'].' '.$validated['end_time'];

        $booking->update([
            'meeting_topic' => $validated['meeting_topic'],
            'department'    => $validated['department'],
            'name'          => $validated['name'],
            'lastname'      => $validated['lastname'],
            'phone'         => $validated['phone'],
            'email'         => $validated['email'],
            'start_time'    => $startDateTime,
            'end_time'      => $endDateTime,
        ]);

        return redirect()->route('admin_history_detail', $booking->booking_id)
            ->with('success', 'แก้ไขข้อมูลการจองเรียบร้อยแล้ว');
    }

    // ลบการจอง
    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('admin_history_booking')
            ->with('success', 'ลบข้อมูลการจองเรียบร้อยแล้ว');
    }
}
