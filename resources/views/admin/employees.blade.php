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
        white-space: nowrap;
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
        vertical-align: middle;
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

    /* ===== คอลัมน์จัดการ ===== */
    .emp-table th.col-actions,
    .emp-table td.col-actions {
        width: 170px;
        padding-left: .55rem;
        padding-right: .55rem;
    }

    /* ===== ปุ่มจัดการ ===== */
    .action-wrap {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: .45rem;
    }

    .btn-edit,
    .btn-delete {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: .35rem;
        min-width: 76px;
        padding: .32rem .65rem;
        border-radius: 8px;
        font-size: .82rem;
        font-weight: 700;
        text-decoration: none;
        border: 1px solid transparent;
        cursor: pointer;
        line-height: 1.2;
    }

    .btn-edit {
        background-color: #F3F4F6;
        color: #374151;
        border: 1px solid #D1D5DB;
    }

    .btn-edit:hover {
        background-color: #E5E7EB;
    }

    .btn-delete {
        background-color: #FCE7E7;
        color: #7F1D1D;
        border: 1px solid #F5C2C7;
    }

    .btn-delete:hover {
        background-color: #F8D7DA;
    }

    /* ===== Popup Confirm Delete ===== */
    .popup-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.45);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 9999;
    }

    .popup-box {
        background: #ffffff;
        padding: 2.2rem 2.6rem;
        border-radius: 10px;
        text-align: center;
        min-width: 340px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.2);
        animation: popupShow 0.25s ease-out;
    }

    .popup-icon-circle {
        width: 70px;
        height: 70px;
        border-radius: 9999px;
        border: 3px solid #ef4444;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.2rem auto;
    }

    .popup-icon-circle i {
        font-size: 2.2rem;
        color: #ef4444;
    }

    .popup-text {
        font-size: 1rem;
        font-weight: 600;
        color: #111827;
    }

    @keyframes popupShow {
        from {
            transform: scale(0.85);
            opacity: 0;
        }

        to {
            transform: scale(1);
            opacity: 1;
        }
    }

    .btn-cancel {
        padding: 0.5rem 1.4rem;
        background: #E5E7EB;
        border-radius: 8px;
        font-size: 0.9rem;
        cursor: pointer;
        border: none;
    }

    .btn-cancel:hover {
        background: #D1D5DB;
    }

    .btn-confirm {
        padding: 0.5rem 1.4rem;
        background: #F97373;
        color: #ffffff;
        border-radius: 8px;
        font-size: 0.9rem;
        cursor: pointer;
        border: none;
    }

    .btn-confirm:hover {
        background: #EF4444;
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
                    <th>กลุ่มงาน</th>
                    <th class="col-actions text-center">จัดการ</th>
                </tr>
            </thead>
            <tbody>
                @forelse($employees as $emp)
                <tr>
                    <td>{{ $emp->citizen_id }}</td>
                    <td>{{ $emp->first_name }}</td>
                    <td>{{ $emp->last_name }}</td>
                    <td>{{ $emp->phone }}</td>
                    <td>{{ optional($emp->department)->name ?? '-' }}</td>

                    <td class="col-actions">
                        <div class="action-wrap">
                            <a href="{{ route('admin_edit.employees', $emp->id) }}" class="btn-edit">
                                <i class="bi bi-pencil-square"></i> แก้ไข
                            </a>

                            <form class="delete-form"
                                action="{{ route('admin_delete.employees', $emp->id) }}"
                                method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn-delete" onclick="openDeletePopup(this)">
                                    <i class="bi bi-trash3"></i> ลบ
                                </button>
                            </form>
                        </div>
                    </td>
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

{{-- ===== Popup Confirm Delete ===== --}}
<div id="deletePopup" class="popup-overlay">
    <div class="popup-box">
        <div class="popup-icon-circle">
            <i class="bi bi-exclamation-lg"></i>
        </div>

        <div class="popup-text" style="margin-bottom: 1.2rem;">
            ยืนยันการลบพนักงานคนนี้หรือไม่?
        </div>

        <div style="display:flex; gap:1rem; justify-content:center;">
            <button class="btn-cancel" type="button" onclick="closeDeletePopup()">ยกเลิก</button>
            <button class="btn-confirm" type="button" onclick="confirmDelete()">ลบ</button>
        </div>
    </div>
</div>

<script>
    let selectedDeleteForm = null;

    function openDeletePopup(btn) {
        selectedDeleteForm = btn.closest('form');
        document.getElementById('deletePopup').style.display = 'flex';
    }

    function closeDeletePopup() {
        document.getElementById('deletePopup').style.display = 'none';
        selectedDeleteForm = null;
    }

    function confirmDelete() {
        if (selectedDeleteForm) selectedDeleteForm.submit();
    }

    // ปิด popup เมื่อคลิกพื้นหลังดำ
    document.getElementById('deletePopup').addEventListener('click', function(e) {
        if (e.target === this) closeDeletePopup();
    });
</script>

@endsection