<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Admin;
use App\Models\Department;
use Illuminate\Support\Facades\Hash;

class AdminEmployeeController extends Controller
{
    public function index(Request $request)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $admin = Admin::findOrFail(session('admin_id'));

        $employees = Employee::with(['department'])
            ->where('department_id', $admin->department_id)
            ->orderBy('first_name')
            ->get();

        return view('admin.employees', compact('employees'));
    }

    // ✅ เพิ่ม: หน้าเพิ่มพนักงาน
    public function create()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $admin = Admin::findOrFail(session('admin_id'));

        // ดึงชื่อกลุ่มงานจากตาราง departments
        $dept = Department::find($admin->department_id);

        $departmentId = $admin->department_id;
        $departmentName = $dept?->name; // ถ้าไม่เจอจะเป็น null

        return view('admin.create_employees', compact('departmentId', 'departmentName'));
    }
   public function store(Request $request)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $admin = Admin::findOrFail(session('admin_id'));

        $request->validate([
            'citizen_id' => 'required|digits:13|unique:employees,citizen_id',
            'email'      => 'required|email|unique:employees,email',   // ✅ เพิ่ม
            'password'   => 'required|min:6|confirmed',               // ✅ เพิ่ม (ใช้ password_confirmation)
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'phone'      => 'nullable|string|max:20',
        ]);

        Employee::create([
            'citizen_id'    => $request->citizen_id,
            'email'         => $request->email,                       // ✅ เพิ่ม
            'password'      => Hash::make($request->password),         // ✅ เพิ่ม
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'phone'         => $request->phone,
            'department_id' => $admin->department_id,                 // ✅ ล็อกตามแอดมินเหมือนเดิม
        ]);

        return redirect()
            ->route('admin_employees')
            ->with('success', 'เพิ่มพนักงานเรียบร้อยแล้ว');
    }
}