<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminRoomController;
use App\Models\Room;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\CalendarController;


//-------หน้าแรก-------//
Route::get('/', function () {
    return view('welcome');
});

//---------------------------------user---------------------------------------//

//-------หน้าปฏิทินการใช้ห้อง-------//
Route::get('/user/calendar', [CalendarController::class, 'userIndex'])->name('user_calendar');
Route::get('/user/calendar/day/{date}', [CalendarController::class, 'userDay'])->name('user_calendar_day');

//-------หน้าจองห้อง-------//
Route::get('/user/room', function () {
    $rooms = Room::all();
    return view('user.room', compact('rooms'));
})->name('user_rooms');

Route::get('/create_booking/{room_id}', [BookingController::class, 'create'])
    ->name('create_booking');

Route::post('/booking/store', [BookingController::class, 'store'])
    ->name('booking.store');

//-------หน้าประวัติการจอง-------//
Route::get('/user/history_booking', function (Request $request) {
    $q = $request->input('q');  // ค่าที่พิมพ์ในช่องค้นหา

    $bookings = Booking::with('room')
        ->when($q, function ($query) use ($q) {
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('lastname', 'like', "%{$q}%")
                    ->orWhereRaw("CONCAT(name, ' ', lastname) LIKE ?", ["%{$q}%"]);
            });
        })
        ->orderBy('start_time', 'desc')
        ->get();

    return view('user.history_booking', [
        'bookings' => $bookings,
        'q'        => $q,
    ]);
})->name('user_history_booking');

//-------หน้ารายละเอียดการจอง-------//
Route::get('/user/history_booking/detail/{id}', function ($id) {
    $booking = Booking::with('room')->findOrFail($id);  // ตอนนี้จะ where booking_id = $id ให้เอง

    return view('user.detail_history', compact('booking'));
})->name('user_history_detail');
//---------------------------------admin---------------------------------------//

//-------หน้าสำหรับเจ้าหน้าที่-------//
Route::get('/login', function () {
    return view('admin.login');
})->name('login');

// //-------login admin-------//
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');


//-------หน้าปฏิทินการใช้ห้อง-------//
Route::get('/admin/calendar', [CalendarController::class, 'adminIndex'])->name('admin_calendar');
Route::get('/admin/calendar/day/{date}', [CalendarController::class, 'adminDay'])->name('admin_calendar_day');

//-------หน้า ห้องประชุม-------//
Route::post('/admin/rooms/store', [AdminRoomController::class, 'store'])
    ->name('rooms.store');
// Admin Meeting Rooms
Route::get('/admin/meetingrooms', [AdminRoomController::class, 'index'])
    ->name('admin_meetingrooms');
// Create Room Page
Route::get('/admin/create_room', function () {
    return view('admin.create_room');
})->name('admin_create_room');
// Delete Room
Route::delete('/admin/rooms/{room}', [AdminRoomController::class, 'destroy'])
    ->name('admin_delete_room');
// Edit Room
Route::get('/admin/rooms/{room_id}/edit', [AdminRoomController::class, 'edit'])
    ->name('admin_edit_room');
// Update Room
Route::put('/admin/rooms/{room_id}', [AdminRoomController::class, 'update'])
    ->name('rooms.update');


//-------หน้าประวัติการจอง-------//
Route::get('/admin/history_booking', function (Request $request) {
    $q = $request->input('q');  // ค่าที่พิมพ์ในช่องค้นหา

    $bookings = Booking::with('room')
        ->when($q, function ($query) use ($q) {
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('lastname', 'like', "%{$q}%")
                    ->orWhereRaw("CONCAT(name, ' ', lastname) LIKE ?", ["%{$q}%"]);
            });
        })
        ->orderBy('start_time', 'desc')
        ->get();

    return view('admin.history_booking', [
        'bookings' => $bookings,
        'q'        => $q,
    ]);
})->name('admin_history_booking');

//-------หน้ารายละเอียดการจอง-------//
Route::get('/admin/history_booking/detail/{id}', function ($id) {
    $booking = Booking::with('room')->findOrFail($id);

    return view('admin.detail_history', compact('booking'));
})->name('admin_history_detail');

// แก้ไขการจอง
Route::get('/admin/booking/{id}/edit', [BookingController::class, 'edit'])
    ->name('admin_edit_booking');

// บันทึกแก้ไข
Route::put('/admin/booking/{id}', [BookingController::class, 'update'])
    ->name('admin_update_booking');

// ลบการจอง
Route::delete('/admin/booking/{id}', [BookingController::class, 'destroy'])
    ->name('admin_delete_booking');

