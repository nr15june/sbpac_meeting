<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminRoomController;

//-------หน้าแรก-------//
Route::get('/', function () {
    return view('welcome');
});

//---------------------------------user---------------------------------------//

//-------หน้า Tapbar user-------//
// Route::get('/tapbar', function () {
//     return view('user.tapbar');
// })->name('tapbar');

//-------หน้าปฏิทินการใช้ห้อง-------//
Route::get('/calendar', function () {
    return view('user.calendar');
})->name('calendar');

//-------หน้าจองห้อง-------//
Route::get('/create_booking', function () {
    return view('user.create_booking');
})->name('create_booking');

Route::post('/booking/store', [BookingController::class, 'store'])
        ->name('booking.store');

//-------หน้าประวัติการจอง-------//
Route::get('/history_booking', function () {
    return view('user.history_booking');
})->name('history_booking');

//---------------------------------admin---------------------------------------//

//-------หน้าสำหรับเจ้าหน้าที่-------//
Route::get('/login', function () {
    return view('admin.login');
})->name('login');

// //-------login admin-------//
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

// Route::get('/admin/dashboard', function () { 
//     if (!session('admin_logged_in')) {
//         return redirect()->route('admin.login');
//     }
//     return 'ยินดีต้อนรับเข้าสู่หน้า Admin Dashboard';
// })->name('admin_calendar'); 

//-------หน้าปฏิทินการใช้ห้อง-------//
Route::get('/admin/calendar', function () {
    return view('admin.calendar');
})->name('admin_calendar');

Route::post('/admin/rooms/store', [AdminRoomController::class, 'store'])
     ->name('rooms.store');

//-------หน้าห้องประชุม-------//
Route::get('/admin/meetingrooms', [AdminRoomController::class, 'index'])
    ->name('admin_meetingrooms');

//-------หน้าจองห้อง-------//
Route::get('/admin/create_room', function () {
    return view('admin.create_room');
})->name('admin_create_room');

//-------หน้าประวัติการจอง-------//
Route::get('/admin/history_booking', function () {
    return view('admin.history_booking');
})->name('admin_history_booking');



