@extends('admin.layout')

@section('title', 'จัดการข้อมูลพนักงาน | ศอ.บต.')

@section('content')

<style>
    .emp-wrapper {
        max-width: 1100px;
        margin: 0 auto;
        padding: 0 1rem;
    }

    .emp-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.5rem;
        padding: 1rem 1.5rem;
        background-color: #ffffff;
        border: 1px solid #ebeaeaff;
        border-radius: 0.450rem;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    .emp-left {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .emp-icon {
        width: 2rem;
        height: 2rem;
        border-radius: .375rem;
        background: #fff;
        border: 1px solid #d4d4d4;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .emp-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: #1f2933;
    }

    .btn-add-emp {
        display: inline-flex;
        align-items: center;
        padding: 0.45rem 1.2rem;
        border-radius: 8px;
        background-color: #F5D020;
        color: #111827;
        font-size: 0.875rem;
        font-weight: 600;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        text-decoration: none;
    }

    .btn-add-emp:hover {
        background-color: #f2c739;
    }

    .emp-table-wrap {
        background: #fff;
        border-radius: .5rem;
        border: 1px solid #e5e7eb;
        overflow: hidden;
        box-shadow: 0 1px 2px rgba(0, 0, 0, .03);
    }

    table.emp-table {
        width: 100%;
        border-collapse: collapse;
        font-size: .9rem;
    }

    .emp-table thead {
        background: #f3f4f6;
    }

    .emp-table th,
    .emp-table td {
        padding: .7rem .9rem;
        border-bottom: 1px solid #e5e7eb;
        text-align: left;
        white-space: nowrap;
    }

    .emp-table th {
        font-weight: 700;
        color: #374151;
    }

    .emp-table tbody tr:nth-child(even) {
        background: #fafafa;
    }

    .emp-table tbody tr:hover {
        background: #fefce8;
    }

    .text-center {
        text-align: center;
    }
</style>

<div class="emp-wrapper">

    <div class="emp-header">
        <div class="emp-left">
            <div class="emp-icon">
                <i class="bi bi-people-fill"></i>
            </div>
            <div class="emp-title">รายชื่อพนักงาน</div>
        </div>

        <a href="{{ route('admin_create_employees') }}" class="btn-add-emp">
            + เพิ่มพนักงาน
        </a>

    </div>

    <div class="emp-table-wrap">
        <table class="emp-table">
            <thead>
                <tr>
                    <th>เลขบัตรประชาชน</th>
                    <th>ชื่อ</th>
                    <th>นามสกุล</th>
                    <th>เบอร์โทร</th>
                    <th>สำนัก/กอง</th>
                    <th>กลุ่มงาน</th>
                </tr>
            </thead>
            <tbody>
                @forelse($employees as $emp)
                <tr>
                    <td>{{ $emp->citizen_id }}</td>
                    <td>{{ $emp->first_name }}</td>
                    <td>{{ $emp->last_name }}</td>
                    <td>{{ $emp->phone }}</td>
                    <td>{{ optional($emp->division)->name ?? '-' }}</td>
                    <td>{{ optional($emp->department)->name ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">ยังไม่มีข้อมูลพนักงาน</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection