@extends('user.layout')

@section('title', 'จองห้องประชุม | ศอ.บต.')

{{-- ========== ส่วน CSS ========== --}}
<style>
    .booking-wrapper {
        max-width: 1000px;
        margin: 0 auto;
        padding: 0 1rem;
    }

    .booking-header {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        margin-bottom: 1.5rem;
        padding: 1rem 1.5rem;
        background-color: #ffffff;
        border: 1px solid #ebeaeaff;
        border-radius: 0.450rem;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    .booking-header-left {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .booking-header-icon {
        width: 2rem;
        height: 2rem;
        border-radius: 0.375rem;
        background-color: #ffffff;
        border: 1px solid #d4d4d4;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .booking-header-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: #1f2933;
    }

    /* กล่องฟอร์ม */
    .card-box {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
        margin-bottom: 1.25rem;
        border: 1px solid #e5e7eb;
    }

    .card-header {
        padding: 0.75rem 1.25rem;
        border-bottom: 1px solid #e5e7eb;
        background: #f9fafb;
        border-radius: 16px 16px 0 0;
        font-size: 0.9rem;
        font-weight: 600;
        color: #111827;
    }

    .card-body {
        padding: 1.25rem;
    }

    .form-label {
        display: block;
        font-size: 0.85rem;
        margin-bottom: 0.25rem;
        color: #374151;
    }

    .form-input,
    .form-select,
    .form-textarea {
        width: 100%;
        border-radius: 0.5rem;
        border: 1px solid #d1d5db;
        padding: 0.5rem 0.75rem;
        font-size: 0.85rem;
        outline: none;
    }

    .form-input:focus,
    .form-select:focus,
    .form-textarea:focus {
        border-color: #38bdf8;
        box-shadow: 0 0 0 1px #38bdf833;
    }

    /* ปุ่มจอง */
    .booking-actions {
        display: flex;
        justify-content: flex-end;
        margin-top: 0.5rem;
    }

    .btn-submit-booking {
        padding: 0.5rem 1.4rem;
        border-radius: 8px;
        border: none;
        background-color: #FFE04B;
        font-size: 0.9rem;
        font-weight: 600;
        color: #ffffff;
        cursor: pointer;
    }

    .btn-submit-booking:hover {
        background-color: #f2c739;
    }

    /* ==== ส่วนแสดง error (กรอบแดง) ==== */
    .input-error {
        border-color: #f97373;
        background-color: #fef2f2;
    }

    /* ===== Popup Confirm ===== */
    .popup-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.35);
        display: flex;
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
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
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

    .btn-cancel {
        padding: 0.5rem 1.4rem;
        background: #BDBDBD;
        border-radius: 8px;
        font-size: 0.9rem;
        cursor: pointer;
    }
    .btn-cancel:hover {
        background: #a8a8a8ff;
    }

    .btn-confirm {
        padding: 0.5rem 1.4rem;
        background: #7ED957;
        border-radius: 8px;
        font-size: 0.9rem;
        cursor: pointer;
        border: none;
    }
    .btn-confirm:hover {
        background: #6CB94C;
    }

</style>

{{-- ========== ส่วน HTML + Blade (เนื้อหา) ========== --}}
@section('content')
<div class="booking-wrapper">

    {{-- แถบแจ้งเตือนเมื่อกรอกไม่ครบ (ควบคุมด้วย JS) --}}
    <div id="client-error-banner"
         style="display:none; margin-bottom: 1rem; padding: 0.75rem 1rem; border-radius: 0.5rem;
                background-color:#FEF2F2; color:#B91C1C; font-size:0.85rem;">
        <strong>กรุณากรอกข้อมูลให้ครบถ้วน</strong>
    </div>

    {{-- แถบหัวข้อหน้า --}}
    <div class="booking-header">
        <div class="booking-header-left">
            <div class="booking-header-icon">
                <i class="bi bi-calendar2-plus" style="font-size: 1.25rem; color: #374151;"></i>
            </div>
            <h1 class="booking-header-title">จองห้องประชุม</h1>
        </div>
    </div>

    <form action="{{ route('booking.store') }}" method="POST">
        @csrf

        {{-- กล่อง: ข้อมูลการใช้ห้อง --}}
        <div class="card-box">
            <div class="card-header">
                ข้อมูลการใช้ห้อง
            </div>
            <div class="card-body">

                {{-- วันที่ / เวลา --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                    <div>
                        <label class="form-label">
                            วันที่ใช้ห้อง <span style="color:red">*</span>
                        </label>
                        <input type="date"
                               name="use_date"
                               class="form-input @error('use_date') input-error @enderror"
                               value="{{ old('use_date') }}">
                    </div>
                    <div>
                        <label class="form-label">
                            เวลาเริ่ม <span style="color:red">*</span>
                        </label>
                        <input type="time"
                               name="start_time"
                               class="form-input @error('start_time') input-error @enderror"
                               value="{{ old('start_time') }}">
                    </div>
                    <div>
                        <label class="form-label">
                            เวลาสิ้นสุด <span style="color:red">*</span>
                        </label>
                        <input type="time"
                               name="end_time"
                               class="form-input @error('end_time') input-error @enderror"
                               value="{{ old('end_time') }}">
                    </div>
                </div>

                {{-- ห้องประชุม (ล็อกจากปุ่มจองห้องนี้) --}}
                <div class="mb-4">
                    <label class="form-label">ห้องประชุม</label>

                    {{-- ซ่อน room_id ไว้ส่งไป Controller --}}
                    <input type="hidden" name="room_id" value="{{ $room->room_id }}">

                    {{-- แสดงชื่อห้อง (แก้ไม่ได้) --}}
                    <input type="text"
                           class="form-input bg-gray-100"
                           value="{{ $room->room_name }}"
                           disabled>
                </div>

                {{-- หัวข้อการประชุม --}}
                <div>
                    <label class="form-label">
                        หัวข้อการประชุม <span style="color:red">*</span>
                    </label>
                    <input type="text"
                           name="meeting_topic"
                           class="form-input @error('meeting_topic') input-error @enderror"
                           value="{{ old('meeting_topic') }}"
                           placeholder="ระบุหัวข้อการประชุม">
                </div>
            </div>
        </div>

        {{-- กล่อง: ข้อมูลผู้ขอใช้ห้อง --}}
        <div class="card-box">
            <div class="card-header">
                ข้อมูลผู้ขอใช้ห้อง
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <label class="form-label">
                        กลุ่มงาน / ส่วนงาน <span style="color:red">*</span>
                    </label>
                    <input type="text"
                           name="department"
                           class="form-input @error('department') input-error @enderror"
                           value="{{ old('department') }}"
                           placeholder="เช่น กลุ่มงานบริหารงบประมาณ">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="form-label">
                            ชื่อ <span style="color:red">*</span>
                        </label>
                        <input type="text"
                               name="first_name"
                               class="form-input @error('first_name') input-error @enderror"
                               value="{{ old('first_name') }}">
                    </div>
                    <div>
                        <label class="form-label">
                            นามสกุล <span style="color:red">*</span>
                        </label>
                        <input type="text"
                               name="last_name"
                               class="form-input @error('last_name') input-error @enderror"
                               value="{{ old('last_name') }}">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="form-label">
                            เบอร์โทร <span style="color:red">*</span>
                        </label>
                        <input type="text"
                               name="phone"
                               class="form-input @error('phone') input-error @enderror"
                               value="{{ old('phone') }}">
                    </div>
                    <div>
                        <label class="form-label">
                            อีเมล <span style="color:red">*</span>
                        </label>
                        <input type="email"
                               name="email"
                               class="form-input @error('email') input-error @enderror"
                               value="{{ old('email') }}">
                    </div>
                </div>
            </div>
        </div>

        {{-- ปุ่มจอง --}}
        <div class="booking-actions">
            <button type="submit" class="btn-submit-booking">
                จอง
            </button>
        </div>
    </form>
</div>

{{-- ===== Popup Confirm ===== --}}
<div id="confirmPopup" class="popup-overlay" style="display: none;">
    <div class="popup-box">
        <div class="popup-icon-circle">
            <i class="bi bi-question-lg"></i>
        </div>

        <div class="popup-text" style="margin-bottom: 1.2rem;">
            ต้องการจองห้องประชุมหรือไม่?
        </div>

        <div style="display:flex; gap:1rem; justify-content:center;">
            <button type="button" class="btn-cancel" onclick="closeConfirmPopup()">ยกเลิก</button>
            <button type="button" class="btn-confirm" onclick="submitForm()">ตกลง</button>
        </div>
    </div>
</div>

{{-- ยืนยันก่อนบันทึก --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const form   = document.querySelector('form');
    const banner = document.getElementById('client-error-banner');
    const popup  = document.getElementById('confirmPopup');

    // ฟังก์ชันปิด popup
    window.closeConfirmPopup = function () {
        popup.style.display = 'none';
    };

    // ฟังก์ชันยืนยันส่งฟอร์ม
    window.submitForm = function () {
        popup.style.display = 'none';
        form.submit();
    };

    form.addEventListener('submit', function (e) {
        e.preventDefault(); // กันไม่ให้ส่งฟอร์มทันที

        // ====== 1) ตรวจข้อมูลว่าครบไหม ======
        let requiredFields = [
            'use_date',
            'start_time',
            'end_time',
            'meeting_topic',
            'department',
            'first_name',
            'last_name',
            'phone',
            'email'
        ];

        let isValid = true;

        requiredFields.forEach(function (field) {
            let input = form.querySelector(`[name="${field}"]`);

            if (input && input.value.trim() === '') {
                input.classList.add('input-error');
                isValid = false;
            } else if (input) {
                input.classList.remove('input-error');
            }
        });

        // ถ้ายังไม่ครบ → แสดงแถบด้านบน & ไม่เปิด popup
        if (!isValid) {
            if (banner) banner.style.display = 'block';
            return;
        }

        // กรอกครบแล้ว ซ่อนแถบเตือน (ถ้าเคยแสดงมาก่อน) และเปิด popup
        if (banner) banner.style.display = 'none';
        popup.style.display = 'flex';
    });
});
</script>

@endsection