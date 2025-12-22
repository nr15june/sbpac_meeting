@extends('admin.layout')

@section('title', 'รายละเอียดประวัติการจอง | ศอ.บต.')

@section('content')

<style>
    .detail-wrapper {
        max-width: 1100px;
        margin: 0 auto;
        padding: 0 1rem;
    }

    .detail-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.5rem;
        padding: 1rem 1.5rem;
        background-color: #ffffff;
        border: 1px solid #ebeaea;
        border-radius: 0.450rem;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    .detail-header-left {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .detail-icon {
        width: 2rem;
        height: 2rem;
        border-radius: 0.375rem;
        background-color: #ffffff;
        border: 1px solid #d4d4d4;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .detail-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: #1f2933;
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: .5rem;
        padding: 0.45rem 1.1rem;
        border-radius: 8px;
        border: 1px solid #d1d5db;
        background: #fff;
        color: #111827;
        font-size: .875rem;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        white-space: nowrap;
    }

    .btn-back:hover {
        background-color: #f3f4f6;
    }

    /* กล่องข้อมูล */
    .detail-box {
        background: #ECECEC;
        border-radius: 12px;
        padding: 2rem;
        position: relative;
    }

    /* ปุ่มล่างขวา */
    .detail-actions {
        display: flex;
        gap: 0.5rem;
        justify-content: flex-end;
        margin-top: 1.5rem;
    }

    .btn-delete {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.4rem 1.2rem;
        border-radius: 0.25rem;
        font-size: 0.85rem;
        font-weight: 600;
        border: none;
        cursor: pointer;
        text-decoration: none;
        color: white;
    }

    .btn-delete {
        background-color: #EF4444;
    }

    .btn-delete:hover {
        background-color: #DC2626;
    }

    .inline-form {
        display: inline-block;
        margin: 0;
    }

    .detail-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.95rem;
    }

    .detail-table td {
        padding: 0.75rem 0.25rem;
    }

    .label-cell {
        width: 25%;
        font-weight: 600;
        color: #374151;
    }

    .value-cell {
        color: #111827;
    }

    .popup-overlay-del {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.45);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 9999;
    }

    .popup-box-del {
        background: #ffffff;
        padding: 2.2rem 2.8rem;
        border-radius: 10px;
        text-align: center;
        min-width: 320px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.2);
        animation: popupShowDel 0.25s ease-out;
    }

    .popup-icon-circle-del {
        width: 70px;
        height: 70px;
        border-radius: 9999px;
        border: 3px solid #F87171;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.2rem auto;
    }

    .popup-icon-circle-del i {
        font-size: 2.2rem;
        color: #F87171;
    }

    .popup-text-del {
        font-size: 1rem;
        font-weight: 500;
        color: #111827;
        margin-bottom: 1.2rem;
    }

    .btn-cancel-del {
        padding: 0.5rem 1.4rem;
        background: #E5E7EB;
        border-radius: 8px;
        font-size: 0.9rem;
        cursor: pointer;
        border: none;
    }

    .btn-cancel-del:hover {
        background: #D1D5DB;
    }

    .btn-confirm-del {
        padding: 0.5rem 1.4rem;
        background: #F97373;
        color: #ffffff;
        border-radius: 8px;
        font-size: 0.9rem;
        cursor: pointer;
        border: none;
    }

    .btn-confirm-del:hover {
        background: #EF4444;
    }

    @keyframes popupShowDel {
        from {
            transform: scale(0.85);
            opacity: 0;
        }

        to {
            transform: scale(1);
            opacity: 1;
        }
    }
</style>

<div class="detail-wrapper">

    {{-- header --}}
    <div class="detail-header">
        <div class="detail-header-left">
            <div class="detail-icon">
                <i class="bi bi-clock-history" style="font-size: 1.25rem; color: #374151;"></i>
            </div>
            <h1 class="detail-title">รายละเอียดประวัติการจอง</h1>
        </div>
        <a href="{{ route('admin_meetingrooms') }}" class="btn-back">
            <i class="bi bi-arrow-left"></i> ย้อนกลับ
        </a>
    </div>

{{-- กล่องรายละเอียด --}}
<div class="detail-box">

    <table class="detail-table">
        <tr>
            <td class="label-cell">ชื่อ - สกุล :</td>
            <td class="value-cell">{{ $booking->name }} {{ $booking->lastname }}</td>
        </tr>

        <tr>
            <td class="label-cell">เบอร์โทรศัพท์ :</td>
            <td class="value-cell">{{ $booking->phone }}</td>
        </tr>

        <tr>
            <td class="label-cell">วันที่ใช้ห้อง :</td>
            <td class="value-cell">
                {{ $booking->start_time ? $booking->start_time->format('d/m/Y') : '-' }}
            </td>
        </tr>

        <tr>
            <td class="label-cell">เวลา :</td>
            <td class="value-cell">
                {{ $booking->start_time->format('H.i') }} - {{ $booking->end_time->format('H.i') }} น.
            </td>
        </tr>

        <tr>
            <td class="label-cell">ห้องที่ใช้ :</td>
            <td class="value-cell">{{ optional($booking->room)->room_name ?? '-' }}</td>
        </tr>

        <tr>
            <td class="label-cell">หัวข้อการประชุม :</td>
            <td class="value-cell">{{ $booking->meeting_topic }}</td>
        </tr>

        <tr>
            <td class="label-cell">กลุ่มงาน :</td>
            <td class="value-cell">{{ $booking->department }}</td>
        </tr>
    </table>

    {{-- ปุ่มล่างขวา --}}
    <div class="detail-actions">
        <!-- {{-- ปุ่มแก้ไข --}}
            <a href="{{ route('admin_edit_booking', $booking->booking_id) }}" class="btn-edit">
                แก้ไข
            </a> -->

        {{-- ฟอร์มลบการจอง --}}
        <form action="{{ route('admin_delete_booking', $booking->booking_id) }}"
            method="POST"
            class="inline-form">
            @csrf
            @method('DELETE')

            <button type="button"
                class="btn-delete"
                data-room-name="{{ optional($booking->room)->room_name ?? 'การจองห้องประชุม' }}"
                onclick="openDeletePopup(this, this.dataset.roomName)">
                ลบ
            </button>


        </form>
    </div>

</div>

</div>

{{-- ===== Popup ยืนยันการลบการจอง ===== --}}
<div id="deletePopup" class="popup-overlay-del">
    <div class="popup-box-del">
        <div class="popup-icon-circle-del">
            <i class="bi bi-exclamation-lg"></i>
        </div>

        <div id="deletePopupText" class="popup-text-del">
            ต้องการลบการจองนี้หรือไม่?
        </div>

        <div style="display:flex; gap:1rem; justify-content:center;">
            <button type="button"
                class="btn-cancel-del"
                onclick="closeDeletePopup()">
                ยกเลิก
            </button>

            <button type="button"
                class="btn-confirm-del"
                onclick="confirmDelete()">
                ตกลง
            </button>
        </div>
    </div>
</div>

<script>
    let deleteFormTarget = null;

    function openDeletePopup(button, roomName) {
        deleteFormTarget = button.closest('form');
        const textEl = document.getElementById('deletePopupText');
        textEl.textContent = `ต้องการลบการจองห้อง "${roomName}" หรือไม่?`;
        document.getElementById('deletePopup').style.display = 'flex';
    }

    function closeDeletePopup() {
        document.getElementById('deletePopup').style.display = 'none';
        deleteFormTarget = null;
    }

    function confirmDelete() {
        if (deleteFormTarget) {
            deleteFormTarget.submit();
        }
    }
</script>

@endsection