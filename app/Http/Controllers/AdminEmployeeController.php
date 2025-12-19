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

        // รับค่าค้นหา
        $q = trim($request->get('q'));

        $employees = Employee::with('department')
            ->where('department_id', $admin->department_id)
            ->when($q, function ($query) use ($q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('citizen_id', 'like', "%{$q}%")
                        ->orWhere('first_name', 'like', "%{$q}%")
                        ->orWhere('last_name', 'like', "%{$q}%")
                        ->orWhereRaw("CONCAT(first_name,' ',last_name) LIKE ?", ["%{$q}%"])
                        ->orWhere('phone', 'like', "%{$q}%")
                        ->orWhere('email', 'like', "%{$q}%")
                        ->orWhereHas('department', function ($d) use ($q) {
                            $d->where('name', 'like', "%{$q}%");
                        });
                });
            })
            ->orderBy('first_name')
            ->get();

        // ส่ง $q ไปให้ blade เพื่อให้ช่องค้นหาค้างค่าเดิม
        return view('admin.employees', compact('employees', 'q'));
    }

    public function create()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $admin = Admin::findOrFail(session('admin_id'));

        $dept = Department::find($admin->department_id);

        $departmentId = $admin->department_id;
        $departmentName = $dept?->name; 

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
            'email'      => 'required|email|unique:employees,email',
            'password'   => 'required|min:6|confirmed',
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'phone'      => 'nullable|string|max:20',
        ]);

        Employee::create([
            'citizen_id'    => $request->citizen_id,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'phone'         => $request->phone,
            'department_id' => $admin->department_id,
        ]);

        return redirect()
            ->route('admin_employees')
            ->with('success', 'เพิ่มพนักงานเรียบร้อยแล้ว');
    }

    public function edit($id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $employee = Employee::findOrFail($id);

        return view('admin.edit_employees', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $employee = Employee::findOrFail($id);

        $request->validate([
            'citizen_id' => 'required|digits:13|unique:employees,citizen_id,' . $employee->id,
            'email'      => 'required|email|unique:employees,email,' . $employee->id,
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'phone'      => 'nullable|string|max:20',
        ]);

        $employee->update([
            'citizen_id' => $request->citizen_id,
            'email'      => $request->email,
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'phone'      => $request->phone,
        ]);

        return redirect()
            ->route('admin_employees')
            ->with('success', 'แก้ไขข้อมูลพนักงานเรียบร้อยแล้ว');
    }

    public function destroy($id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $employee = Employee::findOrFail($id);
        $employee->delete();

        return redirect()
            ->route('admin_employees')
            ->with('success', 'ลบพนักงานเรียบร้อยแล้ว');
    }
}
