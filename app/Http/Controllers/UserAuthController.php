<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ]);

        // ลองล็อกอินด้วย users table (default guard)
        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('user_rooms')); // ถ้ามาจากหน้า create_booking จะกลับไปเอง
        }

        return back()->with('error', 'อีเมลหรือรหัสผ่านไม่ถูกต้อง')->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('user_calendar');
    }
}
