<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Admin;
use App\Models\Department;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            //->where('department_id', $admin->department_id)
            ->when($q, function ($query) use ($q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('card_id', 'like', "%{$q}%")
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

        $departments = Department::all();
        return view('admin.create_employees', compact('departments'));
    }


    public function store(Request $request)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $admin = Admin::findOrFail(session('admin_id'));

        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'card_id' => 'required|unique:employees,card_id',
            'email' => 'nullable|email|unique:employees,email',
            'password'   => 'required|min:6|confirmed',
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'phone'      => 'nullable|string|max:20',
        ]);

        $baseUsername = Str::lower(Str::slug($request->first_name, ''));

        // กรณีชื่อภาษาไทย slug จะว่าง
        if ($baseUsername === '') {
            $baseUsername = Str::lower($request->first_name);
        }

        $username = $baseUsername;
        $counter = 1;

        // 🔹 กัน username ซ้ำ
        while (Employee::where('username', $username)->exists()) {
            $username = $baseUsername . $counter;
            $counter++;
        }

        Employee::create([
            'card_id'    => $request->card_id,
            'username'      => $username,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'first_name'    => $request->first_name,
            'last_name'     => $request->last_name,
            'phone'         => $request->phone,
            'department_id' => $request->department_id,
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
        $departments = Department::all(); 

        return view('admin.edit_employees', compact('employee', 'departments'));
    }

    public function update(Request $request, $id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        $employee = Employee::findOrFail($id);

        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'card_id' => 'required|unique:employees,card_id,' . $employee->id,
            'email'   => 'nullable|email|unique:employees,email,' . $employee->id,
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'phone'      => 'nullable|string|max:20',
        ]);

        $employee->update([
            'department_id' => $request->department_id,
            'card_id' => $request->card_id,
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
