@extends('admin.layout')

@section('title', 'จัดการข้อมูลพนักงาน | ศอ.บต.')

@section('content')
<style>
    main {
        background: #f3f4f6;
    }

    :root {
        --brand: #25A6D5;
        --ink: #0f172a;
        --muted: #64748b;
        --line: #e5e7eb;
        --card: #ffffff;
        --soft: #f8fafc;
        --shadow: 0 10px 30px rgba(15, 23, 42, .08);
    }

    .emp-wrapper {
        max-width: 1120px;
        margin: 0 auto;
        padding: 0 1rem 1.5rem;
    }

    /* ===== Hero ===== */
    .emp-hero {
        background: linear-gradient(135deg, #ffffff 0%, #ffffff 60%, #fff7d6 100%);
        border: 1px solid var(--line);
        border-radius: 18px;
        box-shadow: var(--shadow);
        padding: 16px 18px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 12px;
    }

    .hero-left {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .hero-icon {
        width: 46px;
        height: 46px;
        border-radius: 16px;
        background: rgba(37, 166, 213, .12);
        color: var(--brand);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        border: 1px solid rgba(37, 166, 213, .18);
    }

    .hero-title {
        margin: 0;
        font-size: 18px;
        font-weight: 900;
        color: var(--ink);
        letter-spacing: .2px;
    }

    .hero-sub {
        margin: 3px 0 0 0;
        font-size: 12.5px;
        color: var(--muted);
    }

    .hero-right {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
        justify-content: flex-end;
    }

    .pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 12px;
        border-radius: 999px;
        background: rgba(37, 166, 213, .10);
        border: 1px solid rgba(37, 166, 213, .18);
        color: #0b5f7a;
        font-weight: 900;
        font-size: 12.5px;
        white-space: nowrap;
    }

    .btn-add {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 16px;
        border-radius: 14px;
        background: linear-gradient(135deg, #f3d53fff 0%, #eec855ff 100%);
        border: 1px solid rgba(0, 0, 0, .06);
        color: #111827;
        font-weight: 1000;
        text-decoration: none;
        box-shadow: 0 10px 18px rgba(245, 208, 32, .25), 0 6px 12px rgba(15, 23, 42, .08);
        transition: .15s ease;
        white-space: nowrap;
    }

    .btn-add i {
        font-size: 16px;
    }

    .btn-add:hover {
        filter: brightness(.98);
        transform: translateY(-1px);
        box-shadow: 0 12px 22px rgba(245, 208, 32, .28), 0 10px 16px rgba(15, 23, 42, .10);
    }

    .btn-add:active {
        transform: scale(.98);
    }

    /* ===== Toolbar ===== */
    .toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin: 8px 0 12px;
        flex-wrap: wrap;
    }

    .search-pill {
        max-width: 420px;
        width: 100%;
        position: relative;
    }

    .search-pill input {
        width: 100%;
        height: 44px;
        padding: 0 14px 0 42px;
        border-radius: 999px;
        border: 1px solid #d1d5db;
        background: #ffffff;
        font-size: 0.92rem;
        color: #111827;
        outline: none;
        transition: border-color .15s ease, box-shadow .15s ease;
    }

    .search-pill input:focus {
        border-color: rgba(37, 166, 213, .5);
        box-shadow: 0 0 0 4px rgba(37, 166, 213, .12);
    }

    .search-pill .search-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 1rem;
        pointer-events: none;
    }

    /* ===== Table Card ===== */
    .emp-table-wrap {
        background: var(--card);
        border-radius: 16px;
        border: 1px solid var(--line);
        overflow: hidden;
        box-shadow: var(--shadow);
    }

    table.emp-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        font-size: .92rem;
    }

    .emp-table thead th {
        background: #f8fafc;
        color: #111827;
        font-weight: 900;
        font-size: 12.5px;
        padding: 12px 14px;
        border-bottom: 1px solid var(--line);
        text-align: left;
        white-space: nowrap;
        position: sticky;
        top: 0;
        z-index: 2;
    }

    .emp-table tbody td {
        padding: 12px 14px;
        border-bottom: 1px solid var(--line);
        vertical-align: middle;
        color: #0f172a;
    }

    .emp-table tbody tr:nth-child(even) td {
        background: #fcfcfd;
    }

    .emp-table tbody tr:hover td {
        background: #f8fafc;
    }

    .text-center {
        text-align: center;
    }

    /* ===== nice columns ===== */
    .mono {
        font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
        letter-spacing: .2px;
    }

    .card-mask {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 999px;
        background: #f1f5f9;
        border: 1px solid #e2e8f0;
        color: #0f172a;
        font-weight: 800;
        max-width: 190px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        vertical-align: middle;
    }

    .dept-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 10px;
        border-radius: 999px;
        background: rgba(37, 166, 213, .10);
        border: 1px solid rgba(37, 166, 213, .18);
        color: #0b5f7a;
        font-weight: 900;
        font-size: 12px;
        max-width: 380px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    /* ===== Actions ===== */
    .col-actions {
        width: 180px;
    }

    .action-wrap {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
    }

    .btn-edit,
    .btn-delete {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 8px 10px;
        border-radius: 12px;
        font-size: 12.5px;
        font-weight: 900;
        text-decoration: none;
        border: 1px solid transparent;
        cursor: pointer;
        line-height: 1.1;
        transition: .15s ease;
        white-space: nowrap;
    }

    .btn-edit {
        background: #f1f5f9;
        border-color: #e2e8f0;
        color: #0f172a;
    }

    .btn-edit:hover {
        background: #eaf0f7;
        transform: translateY(-1px);
    }

    .btn-delete {
        background: #fee2e2;
        border-color: #fecaca;
        color: #7f1d1d;
    }

    .btn-delete:hover {
        background: #fecaca;
        transform: translateY(-1px);
    }

    /* ===== Empty state ===== */
    .empty {
        padding: 18px;
        text-align: center;
        color: #64748b;
        background: #fff;
    }

    /* ===== Popup Confirm ===== */
    .popup-overlay {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.55);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        backdrop-filter: blur(2px);
    }

    .popup-box {
        width: min(420px, 92vw);
        background: #ffffff;
        border-radius: 18px;
        border: 1px solid var(--line);
        box-shadow: 0 22px 60px rgba(0, 0, 0, .25);
        padding: 18px 18px 16px;
        animation: popupShow .18s ease-out;
    }

    @keyframes popupShow {
        from {
            transform: translateY(8px) scale(.98);
            opacity: 0;
        }

        to {
            transform: translateY(0) scale(1);
            opacity: 1;
        }
    }

    .popup-top {
        display: flex;
        gap: 12px;
        align-items: flex-start;
    }

    .popup-icon {
        width: 46px;
        height: 46px;
        border-radius: 16px;
        background: #fee2e2;
        color: #dc2626;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        border: 1px solid #fecaca;
        flex: 0 0 auto;
    }

    .popup-title {
        margin: 2px 0 0 0;
        font-weight: 1000;
        color: #0f172a;
        font-size: 16px;
    }

    .popup-text {
        margin: 6px 0 0 0;
        color: #64748b;
        font-size: 13px;
        line-height: 1.4;
    }

    .popup-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 14px;
    }

    .btn-cancel {
        padding: 10px 14px;
        border-radius: 12px;
        background: #f1f5f9;
        border: 1px solid #e2e8f0;
        font-weight: 900;
        cursor: pointer;
    }

    .btn-cancel:hover {
        background: #eaf0f7;
    }

    .btn-confirm {
        padding: 10px 14px;
        border-radius: 12px;
        background: #ef4444;
        border: 1px solid #dc2626;
        color: #fff;
        font-weight: 1000;
        cursor: pointer;
    }

    .btn-confirm:hover {
        filter: brightness(.95);
    }

    @media (max-width: 820px) {
        .col-actions {
            width: 160px;
        }

        .card-mask {
            max-width: 160px;
        }

        .dept-badge {
            max-width: 220px;
        }
    }
</style>

@php
// จำนวนพนักงานในหน้านี้ (ตาม filter ที่ส่งมา)
$totalOnPage = $employees?->count() ?? 0;
@endphp

<div class="emp-wrapper">

    <div class="emp-hero">
        <div class="hero-left">
            <div class="hero-icon"><i class="bi bi-people-fill"></i></div>
            <div>
                <div class="hero-title">รายชื่อพนักงาน</div>
                <div class="hero-sub">ค้นหา แก้ไข และจัดการข้อมูลพนักงานของหน่วยงาน</div>
            </div>
        </div>

        <div class="hero-right">
            <span class="pill">
                <i class="bi bi-person-badge"></i> แสดง {{ $totalOnPage }} รายการ
            </span>

            <a href="{{ route('admin_create_employees') }}" class="btn-add">
                <i class="bi bi-person-plus-fill"></i> เพิ่มพนักงาน
            </a>
        </div>
    </div>

    <div class="toolbar">
        <form method="GET" action="{{ route('admin_employees') }}" style="width:100%; max-width:420px;">
            <div class="search-pill">
                <i class="bi bi-search search-icon"></i>
                <input
                    type="text"
                    name="q"
                    value="{{ $q ?? '' }}"
                    placeholder="ค้นหาด้วยชื่อพนักงาน / นามสกุล / เลขบัตร..."
                    autocomplete="off">
            </div>
        </form>
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
                    <td>
                        <span class="card-mask mono" title="{{ $emp->card_id }}">
                            {{ $emp->card_id }}
                        </span>
                    </td>
                    <td style="font-weight:900;">{{ $emp->first_name }}</td>
                    <td style="font-weight:900;">{{ $emp->last_name }}</td>
                    <td class="mono">{{ $emp->phone }}</td>
                    <td>
                        <span class="dept-badge" title="{{ optional($emp->department)->name }}">
                            <i class="bi bi-diagram-3"></i>
                            {{ optional($emp->department)->name ?? '-' }}
                        </span>
                    </td>

                    <td class="col-actions">
                        <div class="action-wrap">
                            <a href="{{ route('admin_edit.employees', $emp->id) }}" class="btn-edit" title="แก้ไข">
                                <i class="bi bi-pencil-square"></i> แก้ไข
                            </a>

                            <form class="delete-form"
                                action="{{ route('admin_delete.employees', $emp->id) }}"
                                method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn-delete" onclick="openDeletePopup(this)" title="ลบ">
                                    <i class="bi bi-trash3"></i> ลบ
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="empty">ยังไม่มีข้อมูลพนักงาน</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

{{-- ===== Popup Confirm Delete ===== --}}
<div id="deletePopup" class="popup-overlay">
    <div class="popup-box">
        <div class="popup-top">
            <div class="popup-icon"><i class="bi bi-exclamation-triangle-fill"></i></div>
            <div>
                <div class="popup-title">ยืนยันการลบพนักงาน</div>
                <div class="popup-text">เมื่อลบแล้วจะไม่สามารถกู้คืนข้อมูลได้ คุณต้องการลบรายการนี้ใช่หรือไม่?</div>
            </div>
        </div>

        <div class="popup-actions">
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

    document.getElementById('deletePopup').addEventListener('click', function(e) {
        if (e.target === this) closeDeletePopup();
    });
</script>

@endsection