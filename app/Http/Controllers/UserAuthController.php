<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $email = strtolower(trim($request->email));

        $employee = Employee::whereRaw('LOWER(email) = ?', [$email])->first();

        if (!$employee || !Hash::check($request->password, $employee->password)) {
            return back()->with('error', 'อีเมลหรือรหัสผ่านไม่ถูกต้อง')->withInput();
        }

        session([
            'user_logged_in' => true,
            'user_id'        => $employee->id,
            'user_name'      => $employee->first_name . ' ' . $employee->last_name,
            'department_id'  => $employee->department_id,
        ]);

        return redirect()->route('user_calendar');
    }

    public function logout(Request $request)
    {
        // ล้าง session ของ user
        $request->session()->forget([
            'user_logged_in',
            'user_id',
            'user_name',
            'department_id',
        ]);

        $request->session()->regenerate();

        return redirect()->route('user_calendar');
    }
}
