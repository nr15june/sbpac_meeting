@extends('admin.layout')

@section('title', 'แก้ไขข้อมูลการจอง | ศอ.บต.')

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

    .detail-box {
        background: #ECECEC;
        border-radius: 12px;
        padding: 2rem;
        position: relative;
    }

    .detail-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.95rem;
    }

    .detail-table td {
        padding: 0.75rem 0.25rem;
        vertical-align: top;
    }

    .label-cell {
        width: 25%;
        font-weight: 600;
        color: #374151;
    }

    .value-cell {
        color: #111827;
    }

    /* input style */
    .form-input,
    .form-textarea {
        width: 100%;
        border-radius: 0.5rem;
        border: 1px solid #d1d5db;
        padding: 0.45rem 0.6rem;
        font-size: 0.9rem;
        outline: none;
        background-color: #ffffff;
    }

    .form-input:focus,
    .form-textarea:focus {
        border-color: #38bdf8;
        box-shadow: 0 0 0 1px #38bdf833;
    }

    .form-textarea {
        min-height: 80px;
        resize: vertical;
    }

    .name-group {
        display: flex;
        gap: 0.5rem;
    }

    .name-group .form-input {
        width: 100%;
    }

    .datetime-group {
        display: flex;
        gap: 0.75rem;
    }

    .datetime-group .form-input {
        max-width: 170px;
    }

    .detail-actions {
        display: flex;
        justify-content: flex-end;
        gap: 0.5rem;
        margin-top: 1.5rem;
    }

    .btn-save,
    .btn-cancel {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.5rem 1.6rem;
        border-radius: 999px;
        font-size: 0.9rem;
        font-weight: 600;
        border: none;
        cursor: pointer;
        text-decoration: none;
    }

    .btn-save {
        padding: 0.5rem 1.4rem;
        border-radius: 8px;
        background-color: #FFE04B;
        font-size: 0.875rem;
        font-weight: 600;
        color: #ffffff;
    }

    .btn-save:hover {
        background-color: #f2c739;
    }

    .btn-cancel {
        padding: 0.5rem 1.4rem;
        background: #9ca3af;
        border-radius: 8px;
        font-size: 0.9rem;
        cursor: pointer;
        border: none;
        color: #ffffff;
    }

    .btn-cancel:hover {
        background-color: #6b7280;
    }


    .popup-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.35);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 9999;
    }

    .popup-box {
        background: #fff;
        padding: 2rem 2.5rem;
        border-radius: 14px;
        text-align: center;
        width: 350px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .popup-icon-circle {
        width: 70px;
        height: 70px;
        border-radius: 9999px;
        border: 3px solid #7ED957;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.2rem auto;
    }

    .popup-icon-circle i {
        font-size: 2.2rem;
        color: #7ED957;
    }

    .popup-text {
        font-size: 1rem;
        font-weight: 500;
        color: #111827;
    }

    .btn-confirm {
        padding: 0.5rem 1.4rem;
        background: #7ED957;
        border-radius: 8px;
        font-size: 0.9rem;
        cursor: pointer;
        border: none;
        color: #ffffff;
    }

    .btn-confirm:hover {
        background: #6CB94C;
    }
</style>

<div class="detail-wrapper">

    {{-- header --}}
    <div class="detail-header">
        <div class="detail-header-left">
            <div class="detail-icon">
                <i class="bi bi-pencil-square"></i>
            </div>
            <div class="detail-title">แก้ไขข้อมูลการจอง</div>
        </div>
    </div>

    {{-- ฟอร์มแก้ไข --}}
    <form id="edit-booking-form"
        action="{{ route('admin_update_booking', $booking->booking_id) }}"
        method="POST">
        @csrf
        @method('PUT')

        <div class="detail-box">

            <table class="detail-table">
                {{-- ชื่อ - สกุล --}}
                <tr>
                    <td class="label-cell">ชื่อ - สกุล :</td>
                    <td class="value-cell">
                        <div class="name-group">
                            <input type="text"
                                name="name"
                                class="form-input"
                                placeholder="ชื่อ"
                                value="{{ old('name', $booking->name) }}">
                            <input type="text"
                                name="lastname"
                                class="form-input"
                                placeholder="นามสกุล"
                                value="{{ old('lastname', $booking->lastname) }}">
                        </div>
                    </td>
                </tr>

                {{-- เบอร์โทรศัพท์ --}}
                <tr>
                    <td class="label-cell">เบอร์โทรศัพท์ :</td>
                    <td class="value-cell">
                        <input type="text"
                            name="phone"
                            class="form-input"
                            value="{{ old('phone', $booking->phone) }}">
                    </td>
                </tr>

                <!-- {{-- อีเมล --}}
                <tr>
                    <td class="label-cell">อีเมล :</td>
                    <td class="value-cell">
                        <input type="email"
                            name="email"
                            class="form-input"
                            value="{{ old('email', $booking->email) }}">
                    </td>
                </tr> -->

                {{-- วันที่ใช้ห้อง --}}
                <tr>
                    <td class="label-cell">วันที่ใช้ห้อง :</td>
                    <td class="value-cell">
                        <div class="datetime-group">
                            <input type="date"
                                name="use_date"
                                class="form-input"
                                value="{{ old('use_date', $use_date ?? ($booking->start_time ? $booking->start_time->format('Y-m-d') : '')) }}">
                        </div>
                    </td>
                </tr>

                {{-- เวลา --}}
                <tr>
                    <td class="label-cell">เวลา :</td>
                    <td class="value-cell">
                        <div class="datetime-group">
                            <div>
                                <label style="font-size:0.8rem; color:#4b5563;">เริ่ม</label>
                                <input type="time"
                                    name="start_time"
                                    class="form-input"
                                    value="{{ old('start_time', $start_time ?? ($booking->start_time ? $booking->start_time->format('H:i') : '')) }}">
                            </div>
                            <div>
                                <label style="font-size:0.8rem; color:#4b5563;">สิ้นสุด</label>
                                <input type="time"
                                    name="end_time"
                                    class="form-input"
                                    value="{{ old('end_time', $end_time ?? ($booking->end_time ? $booking->end_time->format('H:i') : '')) }}">
                            </div>
                        </div>
                    </td>
                </tr>

                {{-- ห้องที่ใช้ (อ่านอย่างเดียว) --}}
                <tr>
                    <td class="label-cell">ห้องที่ใช้ :</td>
                    <td class="value-cell">
                        <input type="text"
                            class="form-input"
                            value="{{ optional($booking->room)->room_name ?? '-' }}"
                            disabled>
                    </td>
                </tr>

                {{-- หัวข้อการประชุม --}}
                <tr>
                    <td class="label-cell">หัวข้อการประชุม :</td>
                    <td class="value-cell">
                        <input type="text"
                            name="meeting_topic"
                            class="form-input"
                            value="{{ old('meeting_topic', $booking->meeting_topic) }}">
                    </td>
                </tr>

                {{-- กลุ่มงาน / ส่วนงาน --}}
                <tr>
                    <td class="label-cell">กลุ่มงาน / ส่วนงาน :</td>
                    <td class="value-cell">
                        <input type="text"
                            name="department"
                            class="form-input"
                            value="{{ old('department', $booking->department) }}">
                    </td>
                </tr>
            </table>

            {{-- ปุ่มล่างขวา --}}
            <div class="detail-actions">
                <a href="{{ route('admin_history_detail', $booking->booking_id) }}" class="btn-cancel">
                    ยกเลิก
                </a>
                {{-- เปลี่ยนเป็นปุ่มธรรมดา แล้วค่อยเปิด popup --}}
                <button type="button" class="btn-save" onclick="openConfirmPopup()">
                    บันทึกการแก้ไข
                </button>
            </div>

        </div>
    </form>

</div>

{{-- ===== Popup Confirm ===== --}}
<div id="confirmPopup" class="popup-overlay">
    <div class="popup-box">
        <div class="popup-icon-circle">
            <i class="bi bi-question-lg"></i>
        </div>

        <div class="popup-text" style="margin-bottom: 1.2rem;">
            ต้องการบันทึกการแก้ไขข้อมูลการจองห้องประชุมหรือไม่?
        </div>

        <div style="display:flex; gap:1rem; justify-content:center;">
            <button type="button" class="btn-cancel" onclick="closeConfirmPopup()">ยกเลิก</button>
            <button type="button" class="btn-confirm" onclick="submitEditForm()">ตกลง</button>
        </div>
    </div>
</div>

{{-- ============ JS ============ --}}
<script>
    function openConfirmPopup() {
        document.getElementById('confirmPopup').style.display = 'flex';
    }

    function closeConfirmPopup() {
        document.getElementById('confirmPopup').style.display = 'none';
    }

    function submitEditForm() {
        document.getElementById('edit-booking-form').submit();
    }
</script>

@endsection