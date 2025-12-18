<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Booking;
use Carbon\Carbon;

class BookingController extends Controller
{
    // ================ ฝั่ง User ================

    public function create($room_id)
    {
        if (!session('user_logged_in')) {
            session(['url.intended' => url()->current()]);
            return redirect()->route('user.login');
        }

        $room = Room::findOrFail($room_id);
        return view('user.create_booking', compact('room'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_id'       => 'required',
            'use_date'      => 'required|date',
            'start_time'    => 'required',
            'end_time'      => 'required',
            'meeting_topic' => 'required|string|max:255',
            'department'    => 'required|string|max:255',
            'first_name'    => 'required|string|max:100',
            'last_name'     => 'required|string|max:100',
            'phone'         => 'required|string|max:30',
        ]);

        $start = Carbon::parse($request->use_date . ' ' . $request->start_time);
        $end   = Carbon::parse($request->use_date . ' ' . $request->end_time);

        // ✅ ห้ามจองย้อนหลัง (รวมวันนี้แต่เวลาเริ่มผ่านมาแล้ว)
        if ($start->lt(now())) {
            return back()
                ->withErrors(['use_date' => 'ไม่สามารถจองย้อนหลังได้ กรุณาเลือกวัน/เวลาใหม่'])
                ->withInput();
        }

        // ✅ เวลาสิ้นสุดต้องมากกว่าเวลาเริ่ม
        if ($end->lte($start)) {
            return back()
                ->withErrors(['end_time' => 'เวลาสิ้นสุดต้องมากกว่าเวลาเริ่ม'])
                ->withInput();
        }

        // ✅ กันเวลาชนกัน (ห้องเดียวกัน + ช่วงเวลาทับซ้อน)
        $conflict = Booking::where('room_id', $request->room_id)
            ->where(function ($q) use ($start, $end) {
                $q->where('start_time', '<', $end)
                    ->where('end_time', '>', $start);
            })
            ->exists();

        if ($conflict) {
            return back()
                ->withErrors(['start_time' => 'ช่วงเวลานี้มีคนจองแล้ว กรุณาเลือกเวลาใหม่'])
                ->withInput();
        }

        Booking::create([
            'room_id'       => $request->room_id,
            'employee_id'   => session('employee_id'),
            'department'    => $request->department,          // ✅ ใช้ค่าจาก hidden
            'name'          => $request->first_name,
            'lastname'      => $request->last_name,
            'phone'         => $request->phone,
            'meeting_topic' => $request->meeting_topic,
            'start_time'    => $start,
            'end_time'      => $end,
        ]);

        return redirect()
            ->route('user_history_booking')
            ->with('success', 'บันทึกการจองเรียบร้อยแล้ว');
    }

    public function userEdit($id)
    {
        $booking = Booking::with('room')
            ->where('booking_id', $id)
            ->where('employee_id', session('employee_id'))
            ->firstOrFail();

        $use_date   = $booking->start_time ? $booking->start_time->format('Y-m-d') : null;
        $start_time = $booking->start_time ? $booking->start_time->format('H:i') : null;
        $end_time   = $booking->end_time   ? $booking->end_time->format('H:i') : null;

        return view('user.edit_booking', compact('booking', 'use_date', 'start_time', 'end_time'));
    }

    public function userUpdate(Request $request, $id)
    {
        $booking = Booking::where('booking_id', $id)
            ->where('employee_id', session('employee_id'))
            ->firstOrFail();

        $request->validate([
            'room_id'       => 'required',
            'use_date'      => 'required|date',
            'start_time'    => 'required',
            'end_time'      => 'required',
            'meeting_topic' => 'required|string|max:255',
            'department'    => 'required|string|max:255',
            'name'          => 'required|string|max:100',
            'lastname'      => 'required|string|max:100',
            'phone'         => 'required|string|max:30',
        ]);

        $start = Carbon::parse($request->use_date . ' ' . $request->start_time);
        $end   = Carbon::parse($request->use_date . ' ' . $request->end_time);

        if ($start->lt(now())) {
            return back()->withErrors(['use_date' => 'ไม่สามารถแก้ไขเป็นเวลาย้อนหลังได้'])->withInput();
        }

        if ($end->lte($start)) {
            return back()->withErrors(['end_time' => 'เวลาสิ้นสุดต้องมากกว่าเวลาเริ่ม'])->withInput();
        }

        // ✅ กันเวลาชน (ยกเว้นรายการนี้เอง)
        $conflict = Booking::where('room_id', $booking->room_id)
            ->where('booking_id', '!=', $booking->booking_id)
            ->where(function ($q) use ($start, $end) {
                $q->where('start_time', '<', $end)
                    ->where('end_time', '>', $start);
            })
            ->exists();

        if ($conflict) {
            return back()->withErrors(['start_time' => 'ช่วงเวลานี้มีคนจองแล้ว กรุณาเลือกเวลาใหม่'])->withInput();
        }

        $booking->update([
            // 🔒 ค่าคงที่: room_id / department ใช้ค่าที่ส่งจาก hidden (หรือจะยึดของเดิมก็ได้)
            'room_id'       => $booking->room_id,
            'department'    => $request->department,

            // ✅ แก้ได้
            'meeting_topic' => $request->meeting_topic,
            'name'          => $request->name,
            'lastname'      => $request->lastname,
            'phone'         => $request->phone,
            'start_time'    => $start,
            'end_time'      => $end,
        ]);

        return redirect()
            ->route('user_history_detail', $booking->booking_id)
            ->with('success', 'บันทึกการแก้ไขเรียบร้อยแล้ว');
    }

    public function userDestroy($id)
    {
        $booking = Booking::where('booking_id', $id)
            ->where('employee_id', session('employee_id')) // 🔒 กันลบของคนอื่น
            ->firstOrFail();

        $booking->delete();

        return redirect()
            ->route('user_history_booking')
            ->with('success', 'ลบการจองเรียบร้อยแล้ว');
    }
    // ================ ฝั่ง Admin ================

    public function edit($id)
    {
        $booking = Booking::with('room')->findOrFail($id);
        $use_date   = $booking->start_time ? $booking->start_time->format('Y-m-d') : null;
        $start_time = $booking->start_time ? $booking->start_time->format('H:i') : null;
        $end_time   = $booking->end_time   ? $booking->end_time->format('H:i')   : null;

        return view('admin.edit_booking', compact('booking', 'use_date', 'start_time', 'end_time'));
    }

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

        $start = Carbon::parse($validated['use_date'] . ' ' . $validated['start_time']);
        $end   = Carbon::parse($validated['use_date'] . ' ' . $validated['end_time']);

        // ✅ กันเวลาชนกันตอนแก้ไข (ยกเว้นรายการตัวเอง)
        $conflict = Booking::where('room_id', $booking->room_id)
            ->where('booking_id', '!=', $booking->booking_id)
            ->where(function ($q) use ($start, $end) {
                $q->where('start_time', '<', $end)
                    ->where('end_time', '>', $start);
            })
            ->exists();

        if ($conflict) {
            return back()
                ->withErrors(['start_time' => 'ช่วงเวลานี้มีคนจองแล้ว กรุณาเลือกเวลาใหม่'])
                ->withInput();
        }

        $booking->update([
            'meeting_topic' => $validated['meeting_topic'],
            'department'    => $validated['department'],
            'name'          => $validated['name'],
            'lastname'      => $validated['lastname'],
            'phone'         => $validated['phone'],
            'email'         => $validated['email'],
            'start_time'    => $start,
            'end_time'      => $end,
        ]);

        return redirect()->route('admin_history_detail', $booking->booking_id)
            ->with('success', 'แก้ไขข้อมูลการจองเรียบร้อยแล้ว');
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('admin_history_booking')
            ->with('success', 'ลบข้อมูลการจองเรียบร้อยแล้ว');
    }
}
