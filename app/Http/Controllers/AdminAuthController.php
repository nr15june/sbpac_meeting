<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    // แสดงหน้า login
    public function showLogin()
    {
        return view('admin.login');
    }

    // ตรวจสอบข้อมูล login
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // หา admin ตาม email
        $admin = Admin::where('email', $request->email)->first();

        // ถ้าไม่เจอ หรือ รหัสผ่านไม่ตรง
        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return back()->with('error', 'อีเมลหรือรหัสผ่านไม่ถูกต้อง');
        }

        // เก็บสถานะว่า login แล้ว
        session(['admin_logged_in' => true, 'admin_id' => $admin->id]);

        // พาไปหน้า dashboard แอดมิน (คุณสร้าง view เองได้)
        return redirect()->route('admin_calendar');
    }
}
