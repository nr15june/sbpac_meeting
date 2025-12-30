@extends('admin.layout')

@section('title', 'รายละเอียดประวัติการจอง | ศอ.บต.')

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
        --shadow: 0 10px 30px rgba(15, 23, 42, .08);
        --danger: #ef4444;
        --danger2: #dc2626;
        --soft: #f8fafc;
    }

    .wrap {
        max-width: 1120px;
        margin: 0 auto;
        padding: 0 1rem 1.5rem;
    }

    /* Hero */
    .hero {
        background: linear-gradient(135deg, #fff 0%, #fff 62%, #eefaff 100%);
        border: 1px solid var(--line);
        border-radius: 18px;
        box-shadow: var(--shadow);
        padding: 16px 18px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 14px;
    }

    .hero-left {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 0;
    }

    .hero-icon {
        width: 46px;
        height: 46px;
        border-radius: 16px;
        background: rgba(37, 166, 213, .12);
        color: var(--brand);
        border: 1px solid rgba(37, 166, 213, .18);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        flex: 0 0 auto;
    }

    .hero-title {
        margin: 0;
        font-size: 18px;
        font-weight: 1000;
        color: var(--ink);
        line-height: 1.1;
    }

    .hero-sub {
        margin: 4px 0 0 0;
        font-size: 12.5px;
        color: var(--muted);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 720px;
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 14px;
        border-radius: 14px;
        background: #fff;
        border: 1px solid var(--line);
        color: var(--ink);
        font-weight: 1000;
        text-decoration: none;
        box-shadow: 0 6px 12px rgba(15, 23, 42, .06);
        transition: .15s ease;
        white-space: nowrap;
    }

    .btn-back:hover {
        background: var(--soft);
        transform: translateY(-1px);
    }

    .btn-back:active {
        transform: scale(.98);
    }

    /* Card */
    .card {
        background: var(--card);
        border: 1px solid var(--line);
        border-radius: 18px;
        box-shadow: var(--shadow);
        overflow: hidden;
    }

    .card-hd {
        padding: 12px 16px;
        border-bottom: 1px solid var(--line);
        background: #fbfdff;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        flex-wrap: wrap;
    }

    .card-hd-left {
        display: flex;
        align-items: center;
        gap: 10px;
        color: var(--ink);
        font-weight: 1000;
    }

    /* ✅ เพิ่มเหมือนผู้ใช้ */
    .dt-mini-ico {
        width: 34px;
        height: 34px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #eefaff;
        border: 1px solid rgba(37, 166, 213, .18);
        color: var(--brand);
        font-size: 16px;
    }

    .card-title {
        font-weight: 1000;
        color: var(--ink);
    }

    .chip {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 7px 12px;
        border-radius: 999px;
        border: 1px solid #e2e8f0;
        background: #fff;
        font-weight: 1000;
        font-size: 12.5px;
        color: #0f172a;
        white-space: nowrap;
    }

    .chip i {
        color: #64748b;
    }

    .card-bd {
        padding: 14px 16px 16px;
    }

    /* Table */
    .detail-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        background: #fff;
        border: 1px solid #eef2f7;
        border-radius: 16px;
        overflow: hidden;
    }

    .detail-table tr+tr td {
        border-top: 1px solid #eef2f7;
    }

    .detail-table td {
        padding: 12px 14px;
        vertical-align: top;
        font-size: 14px;
    }

    .key {
        width: 28%;
        color: var(--muted);
        font-weight: 1000;
        white-space: nowrap;
    }

    .val {
        color: var(--ink);
        font-weight: 500;
        word-break: break-word;
    }

    .actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 12px;
        padding-top: 12px;
        border-top: 1px solid #eef2f7;
    }

    .btn-delete {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 14px;
        border-radius: 14px;
        border: 1px solid rgba(0, 0, 0, .06);
        background: var(--danger);
        color: #fff;
        font-weight: 1000;
        cursor: pointer;
        box-shadow: 0 10px 18px rgba(239, 68, 68, .18), 0 6px 12px rgba(15, 23, 42, .08);
        transition: .15s ease;
        white-space: nowrap;
    }

    .btn-delete:hover {
        background: var(--danger2);
        transform: translateY(-1px);
    }

    .btn-delete:active {
        transform: scale(.98);
    }

    /* Popup */
    .popup-overlay {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, .55);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        backdrop-filter: blur(2px);
        padding: 1rem;
    }

    .popup-box {
        width: min(460px, 92vw);
        background: #fff;
        border-radius: 18px;
        border: 1px solid var(--line);
        box-shadow: 0 22px 60px rgba(0, 0, 0, .25);
        padding: 18px 18px 16px;
        animation: pop .18s ease-out;
        text-align: left;
    }

    @keyframes pop {
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
        background: rgba(239, 68, 68, .12);
        color: var(--danger);
        border: 1px solid rgba(239, 68, 68, .22);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        flex: 0 0 auto;
    }

    .popup-title {
        margin: 2px 0 0 0;
        font-weight: 1000;
        color: var(--ink);
        font-size: 16px;
    }

    .popup-text {
        margin: 6px 0 0 0;
        color: var(--muted);
        font-size: 13px;
        line-height: 1.45;
        word-break: break-word;
    }

    .popup-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 14px;
    }

    .btn-cancel {
        padding: 10px 14px;
        border-radius: 14px;
        background: #f1f5f9;
        border: 1px solid #e2e8f0;
        font-weight: 1000;
        cursor: pointer;
    }

    .btn-confirm {
        padding: 10px 14px;
        border-radius: 14px;
        background: var(--danger);
        border: 1px solid var(--danger2);
        color: #fff;
        font-weight: 1000;
        cursor: pointer;
    }
</style>

<div class="wrap">

    {{-- HERO --}}
    <div class="hero">
        <div class="hero-left">
            <div class="hero-icon"><i class="bi bi-info-circle"></i></div>
            <div style="min-width:0;">
                <div class="hero-title">รายละเอียดประวัติการจอง</div>
                <div class="hero-sub">ผู้จอง: <b>{{ $booking->name }} {{ $booking->lastname }}</b></div>
            </div>
        </div>

        <a href="{{ route('admin_history_booking') }}" class="btn-back">
            <i class="bi bi-arrow-left"></i> ย้อนกลับ
        </a>
    </div>

    {{-- CARD --}}
    <div class="card">
        <div class="card-hd">
            {{-- ✅ เปลี่ยนหัวซ้ายให้เหมือนผู้ใช้ --}}
            <div class="card-hd-left">
                <div class="dt-mini-ico"><i class="bi bi-file-text"></i></div>
                <div class="card-title">ข้อมูลการจอง</div>
            </div>

            <span class="chip">
                <i class="bi bi-calendar3"></i>
                {{ $booking->start_time ? $booking->start_time->format('d/m/Y') : '-' }}
            </span>
        </div>

        <div class="card-bd">
            <table class="detail-table">
                <tr>
                    <td class="key">ชื่อ - สกุล</td>
                    <td class="val">{{ $booking->name }} {{ $booking->lastname }}</td>
                </tr>
                <tr>
                    <td class="key">เบอร์โทรศัพท์</td>
                    <td class="val">{{ $booking->phone ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="key">วันที่ใช้ห้อง</td>
                    <td class="val">{{ $booking->start_time ? $booking->start_time->format('d/m/Y') : '-' }}</td>
                </tr>
                <tr>
                    <td class="key">เวลา</td>
                    <td class="val">
                        @if($booking->start_time && $booking->end_time)
                        {{ $booking->start_time->format('H.i') }} - {{ $booking->end_time->format('H.i') }} น.
                        @else - @endif
                    </td>
                </tr>
                <tr>
                    <td class="key">ห้องที่ใช้</td>
                    <td class="val">{{ optional($booking->room)->room_name ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="key">หัวข้อการประชุม</td>
                    <td class="val">{{ $booking->meeting_topic ?? '-' }}</td>
                </tr>
                <tr>
                    <td class="key">กลุ่มงาน</td>
                    <td class="val">{{ $booking->department ?? '-' }}</td>
                </tr>
            </table>

            <div class="actions">
                <form action="{{ route('admin_delete_booking', $booking->booking_id) }}"
                    method="POST" id="deleteForm" style="margin:0;">
                    @csrf
                    @method('DELETE')

                    <button type="button"
                        class="btn-delete"
                        data-room-name="{{ optional($booking->room)->room_name ?? 'การจองห้องประชุม' }}"
                        onclick="openDeletePopup(this.dataset.roomName)">
                        <i class="bi bi-trash3"></i> ลบรายการนี้
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Popup --}}
<div id="deletePopup" class="popup-overlay">
    <div class="popup-box">
        <div class="popup-top">
            <div class="popup-icon"><i class="bi bi-exclamation-triangle"></i></div>
            <div>
                <div class="popup-title">ยืนยันการลบ</div>
                <div id="deletePopupText" class="popup-text">ต้องการลบการจองนี้หรือไม่?</div>
            </div>
        </div>

        <div class="popup-actions">
            <button type="button" class="btn-cancel" onclick="closeDeletePopup()">ยกเลิก</button>
            <button type="button" class="btn-confirm" onclick="confirmDelete()">ลบเลย</button>
        </div>
    </div>
</div>

<script>
    function openDeletePopup(roomName) {
        document.getElementById('deletePopupText').textContent =
            `ต้องการลบการจองห้อง "${roomName}" หรือไม่?`;
        document.getElementById('deletePopup').style.display = 'flex';
    }

    function closeDeletePopup() {
        document.getElementById('deletePopup').style.display = 'none';
    }

    function confirmDelete() {
        document.getElementById('deleteForm').submit();
    }
    document.getElementById('deletePopup').addEventListener('click', function(e) {
        if (e.target === this) closeDeletePopup();
    });
</script>

@endsection