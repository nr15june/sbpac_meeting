@extends('user.layout')

@section('title', 'จองห้องประชุม | ศอ.บต.')

{{-- ========== ส่วน CSS ========== --}}
<style>
    /* ===== Layout Wrapper ===== */
    .booking-wrapper {
        max-width: 1100px;
        margin: 0 auto;
        padding: 0 1rem;
    }

    /* ===== Page Header ===== */
    .booking-header {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        margin-bottom: 1.25rem;
        padding: 1rem 1.5rem;
        background: #ffffff;
        border: 1px solid #ebeaeaff;
        border-radius: 12px;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    .booking-header-left {
        display: flex;
        align-items: center;
        gap: 0.9rem;
    }

    .booking-header-icon {
        width: 2.1rem;
        height: 2.1rem;
        border-radius: 10px;
        background: #ffffff;
        border: 1px solid #d4d4d4;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .booking-header-title {
        font-size: 1.15rem;
        font-weight: 700;
        color: #111827;
        margin: 0;
    }

    /* ===== Card ===== */
    .card-box {
        background: #ffffff;
        border-radius: 14px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
        border: 1px solid #e5e7eb;
        overflow: hidden;
        margin-bottom: 1.1rem;
    }

    .card-header {
        padding: 0.85rem 1.25rem;
        border-bottom: 1px solid #e5e7eb;
        background: #f9fafb;
        font-size: 0.92rem;
        font-weight: 700;
        color: #111827;
    }

    .card-body {
        padding: 1.15rem 1.25rem;
    }

    /* ===== Form ===== */
    .form-label {
        display: block;
        font-size: 0.82rem;
        margin-bottom: 0.35rem;
        color: #374151;
        font-weight: 600;
    }

    .form-input,
    .form-select,
    .form-textarea {
        width: 100%;
        border-radius: 10px;
        border: 1px solid #d1d5db;
        padding: 0.55rem 0.8rem;
        font-size: 0.88rem;
        outline: none;
        background: #ffffff;
        transition: border-color .15s ease, box-shadow .15s ease, background .15s ease;
    }

    .form-input:focus,
    .form-select:focus,
    .form-textarea:focus {
        border-color: #38bdf8;
        box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.18);
    }

    /* disabled (กลุ่มงาน/ห้องประชุม) */
    .form-input[disabled],
    .form-input.bg-gray-100 {
        background: #f3f4f6;
        color: #111827;
        border-color: #e5e7eb;
    }

    /* ===== Error ===== */
    .input-error {
        border-color: #ef4444 !important;
        background-color: #fef2f2 !important;
    }

    #client-error-banner {
        border: 1px solid #fecaca;
    }

    /* ===== Actions ===== */
    .booking-actions {
        display: flex;
        justify-content: flex-end;
        margin-top: 0.75rem;
    }

    .btn-submit-booking {
        padding: 0.45rem 1.2rem;
        border-radius: 8px;
        border: none;
        background-color: #F5D020;
        font-size: 0.875rem;
        font-weight: 600;
        color: #111827;
        cursor: pointer;
    }

    .btn-submit-booking:hover {
        background-color: #f2c739;
    }

    /* ===== Popup Confirm ===== */
    .popup-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.35);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        padding: 1rem;
    }

    .popup-box {
        background: #fff;
        padding: 1.8rem 2.2rem;
        border-radius: 16px;
        text-align: center;
        width: 360px;
        max-width: 92vw;
        box-shadow: 0 14px 40px rgba(0, 0, 0, 0.18);
        border: 1px solid #e5e7eb;
    }

    .popup-icon-circle {
        width: 72px;
        height: 72px;
        border-radius: 9999px;
        border: 3px solid #7ED957;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.05rem auto;
    }

    .popup-icon-circle i {
        font-size: 2.2rem;
        color: #7ED957;
    }

    .popup-text {
        font-size: 1rem;
        font-weight: 600;
        color: #111827;
    }

    .btn-cancel,
    .btn-confirm {
        padding: 0.55rem 1.4rem;
        border-radius: 10px;
        font-size: 0.92rem;
        cursor: pointer;
        border: none;
        font-weight: 700;
    }

    .btn-cancel {
        background: #BDBDBD;
        color: #111827;
    }

    .btn-cancel:hover {
        background: #a8a8a8;
    }

    .btn-confirm {
        background: #7ED957;
        color: #ffffff;
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

    <form id="bookingForm" action="{{ route('booking.store') }}" method="POST">
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
                            วันที่ใช้ห้อง
                        </label>
                        <input type="date"
                            name="use_date"
                            min="{{ now()->toDateString() }}"
                            class="form-input @error('use_date') input-error @enderror"
                            value="{{ old('use_date') }}">
                    </div>
                    <div>
                        <label class="form-label">
                            เวลาเริ่ม
                        </label>
                        <input type="time"
                            name="start_time"
                            class="form-input @error('start_time') input-error @enderror"
                            value="{{ old('start_time') }}">

                        @error('start_time')
                        <div class="text-red-600 text-sm mt-1">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>
                    <div>
                        <label class="form-label">
                            เวลาสิ้นสุด
                        </label>
                        <input type="time"
                            name="end_time"
                            class="form-input @error('end_time') input-error @enderror"
                            value="{{ old('end_time') }}">

                        @error('end_time')
                        <div class="text-red-600 text-sm mt-1">
                            {{ $message }}
                        </div>
                        @enderror
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
                        หัวข้อการประชุม
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
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="form-label">
                            กลุ่มงาน
                        </label>

                        <input type="hidden"
                            name="department"
                            value="{{ session('department_name') ?? '' }}">

                        <input type="text"
                            class="form-input bg-gray-100 @error('department') input-error @enderror"
                            value="{{ session('department_name') ?? '-' }}"
                            disabled>
                    </div>
                    <div>
                        <label class="form-label">
                            เบอร์โทร
                        </label>
                        <input type="text"
                            name="phone"
                            class="form-input @error('phone') input-error @enderror"
                            value="{{ old('phone', session('phone')) }}"
                            placeholder="เบอร์โทร">

                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="form-label">ชื่อ</label>
                        <input type="text"
                            name="first_name"
                            class="form-input @error('first_name') input-error @enderror"
                            value="{{ old('first_name', session('first_name')) }}"
                            placeholder="ชื่อ">
                        @error('first_name')
                        @enderror
                    </div>

                    <div>
                        <label class="form-label">นามสกุล</label>
                        <input type="text"
                            name="last_name"
                            class="form-input @error('last_name') input-error @enderror"
                            value="{{ old('last_name', session('last_name')) }}"
                            placeholder="นามสกุล">
                        @error('last_name')
                        @enderror
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
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('bookingForm');
        const banner = document.getElementById('client-error-banner');
        const popup = document.getElementById('confirmPopup');

        if (!form || !popup) return;

        window.closeConfirmPopup = function() {
            popup.style.display = 'none';
        };

        window.submitForm = function() {
            popup.style.display = 'none';
            form.submit();
        };

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const requiredFields = [
                'use_date',
                'start_time',
                'end_time',
                'meeting_topic',
                'department', // hidden
                'first_name',
                'last_name',
                'phone',
            ];

            let isValid = true;

            requiredFields.forEach(function(field) {
                const input = form.querySelector(`[name="${field}"]`);
                if (input && input.value.trim() === '') {
                    // department เป็น hidden ใส่ class ก็ไม่เห็น แต่ยังตรวจได้
                    input.classList.add('input-error');
                    isValid = false;
                } else if (input) {
                    input.classList.remove('input-error');
                }
            });

            if (!isValid) {
                if (banner) banner.style.display = 'block';
                return;
            }

            if (banner) banner.style.display = 'none';
            popup.style.display = 'flex';
        });
    });
</script>
@endsection