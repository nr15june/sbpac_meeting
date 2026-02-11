<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required',
        ]);

        $admin = Admin::where('username', $request->username)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return back()->with('error', 'อีเมลหรือรหัสผ่านไม่ถูกต้อง')->withInput();
        }

        session([
            'admin_logged_in' => true,
            'admin_id' => $admin->id,
            'admin_department_id' => $admin->department_id, 
        ]);

        return redirect()->route('admin_calendar');
    }

    public function logout(Request $request)
    {
        $request->session()->forget(['admin_logged_in', 'admin_id', 'admin_department_id']);
        return redirect()->route('user_calendar');
    }
}
