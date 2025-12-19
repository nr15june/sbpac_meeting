<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.user_login');
    }

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

        $department = Department::find($employee->department_id);

        session([
            'user_logged_in'   => true,
            'employee_id'      => $employee->id,
            'user_name'        => $employee->first_name . ' ' . $employee->last_name,
            'first_name'       => $employee->first_name,
            'last_name'        => $employee->last_name,
            'phone'            => $employee->phone,
            'department_id'    => $employee->department_id,
            'department_name'  => $department?->name,
        ]);

        $intended = session('url.intended', route('user_calendar'));
        session()->forget('url.intended');

        return redirect($intended);
    }

    public function logout(Request $request)
    {
        $request->session()->forget([
            'user_logged_in',
            'employee_id',
            'user_name',
            'first_name',
            'last_name',
            'phone',
            'department_id',
            'department_name',
        ]);

        $request->session()->regenerate();

        return redirect()->route('user_calendar');
    }
}
