@extends('user.layout')

@section('title', 'แก้ไขการจองห้องประชุม | ศอ.บต.')

<style>
    /* ✅ ใช้ CSS เดียวกับหน้าจองของคุณได้เลย (ผมยกมาเฉพาะที่จำเป็น) */
    .booking-wrapper {
        max-width: 1100px;
        margin: 0 auto;
        padding: 0 1rem;
    }

    .booking-header {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        margin-bottom: 1.25rem;
        padding: 1rem 1.5rem;
        background: #fff;
        border: 1px solid #ebeaeaff;
        border-radius: 12px;
        box-shadow: 0 1px 2px rgba(0, 0, 0, .05)
    }

    .booking-header-left {
        display: flex;
        align-items: center;
        gap: .9rem
    }

    .booking-header-icon {
        width: 2.1rem;
        height: 2.1rem;
        border-radius: 10px;
        background: #fff;
        border: 1px solid #d4d4d4;
        display: flex;
        align-items: center;
        justify-content: center
    }

    .booking-header-title {
        font-size: 1.15rem;
        font-weight: 700;
        color: #111827;
        margin: 0
    }

    .card-box {
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, .06);
        border: 1px solid #e5e7eb;
        overflow: hidden;
        margin-bottom: 1.1rem
    }

    .card-header {
        padding: .85rem 1.25rem;
        border-bottom: 1px solid #e5e7eb;
        background: #f9fafb;
        font-size: .92rem;
        font-weight: 700;
        color: #111827
    }

    .card-body {
        padding: 1.15rem 1.25rem
    }

    .form-label {
        display: block;
        font-size: .82rem;
        margin-bottom: .35rem;
        color: #374151;
        font-weight: 600
    }

    .form-input {
        width: 100%;
        border-radius: 10px;
        border: 1px solid #d1d5db;
        padding: .55rem .8rem;
        font-size: .88rem;
        outline: none;
        background: #fff;
        transition: .15s
    }

    .form-input:focus {
        border-color: #38bdf8;
        box-shadow: 0 0 0 3px rgba(56, 189, 248, .18)
    }

    .form-input[disabled],
    .form-input.bg-gray-100 {
        background: #f3f4f6;
        color: #111827;
        border-color: #e5e7eb
    }

    .input-error {
        border-color: #ef4444 !important;
        background: #fef2f2 !important
    }

    #client-error-banner {
        border: 1px solid #fecaca
    }

    .booking-actions {
        display: flex;
        justify-content: flex-end;
        margin-top: .75rem
    }

    .btn-submit-booking {
        padding: .45rem 1.2rem;
        border-radius: 8px;
        border: none;
        background: #F5D020;
        font-size: .875rem;
        font-weight: 600;
        color: #111827;
        cursor: pointer
    }

    .btn-submit-booking:hover {
        background: #f2c739
    }

    .popup-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, .35);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        padding: 1rem
    }

    .popup-box {
        background: #fff;
        padding: 1.8rem 2.2rem;
        border-radius: 16px;
        text-align: center;
        width: 360px;
        max-width: 92vw;
        box-shadow: 0 14px 40px rgba(0, 0, 0, .18);
        border: 1px solid #e5e7eb
    }

    .popup-icon-circle {
        width: 72px;
        height: 72px;
        border-radius: 9999px;
        border: 3px solid #7ED957;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.05rem
    }

    .popup-icon-circle i {
        font-size: 2.2rem;
        color: #7ED957
    }

    .popup-text {
        font-size: 1rem;
        font-weight: 600;
        color: #111827
    }

    .btn-cancel,
    .btn-confirm {
        padding: .55rem 1.4rem;
        border-radius: 10px;
        font-size: .92rem;
        cursor: pointer;
        border: none;
        font-weight: 700
    }

    .btn-cancel {
        background: #BDBDBD;
        color: #111827
    }

    .btn-cancel:hover {
        background: #a8a8a8
    }

    .btn-confirm {
        background: #7ED957;
        color: #fff
    }

    .btn-confirm:hover {
        background: #6CB94C
    }
</style>

@section('content')
<div class="booking-wrapper">

    <div id="client-error-banner"
        style="display:none; margin-bottom:1rem; padding:0.75rem 1rem; border-radius:0.5rem;
               background:#FEF2F2; color:#B91C1C; font-size:0.85rem;">
        <strong>กรุณากรอกข้อมูลให้ครบถ้วน</strong>
    </div>

    <div class="booking-header">
        <div class="booking-header-left">
            <div class="booking-header-icon">
                <i class="bi bi-pencil-square" style="font-size:1.25rem; color:#374151;"></i>
            </div>
            <h1 class="booking-header-title">แก้ไขการจองห้องประชุม</h1>
        </div>
    </div>

    <form id="bookingForm" action="{{ route('user_update_booking', $booking->booking_id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- ✅ ค่าคงที่: room_id ต้องส่งไปด้วย --}}
        <input type="hidden" name="room_id" value="{{ $booking->room_id }}">

        {{-- ✅ ค่าคงที่: department ต้องส่งไปด้วย (เพราะช่อง disabled จะไม่ถูกส่ง) --}}
        <input type="hidden" name="department" value="{{ $booking->department }}">

        {{-- ========== ข้อมูลการใช้ห้อง ========== --}}
        <div class="card-box">
            <div class="card-header">ข้อมูลการใช้ห้อง</div>
            <div class="card-body">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                    <div>
                        <label class="form-label">วันที่ใช้ห้อง</label>
                        <input type="date"
                            name="use_date"
                            class="form-input @error('use_date') input-error @enderror"
                            value="{{ old('use_date', $use_date) }}">
                    </div>

                    <div>
                        <label class="form-label">เวลาเริ่ม</label>
                        <input type="time"
                            name="start_time"
                            class="form-input @error('start_time') input-error @enderror"
                            value="{{ old('start_time', $start_time) }}">
                    </div>

                    <div>
                        <label class="form-label">เวลาสิ้นสุด</label>
                        <input type="time"
                            name="end_time"
                            class="form-input @error('end_time') input-error @enderror"
                            value="{{ old('end_time', $end_time) }}">
                    </div>
                </div>

                {{-- 🔒 ห้องประชุม (คงที่เหมือนตอนจอง) --}}
                <div class="mb-4">
                    <label class="form-label">ห้องประชุม</label>
                    <input type="text"
                        class="form-input bg-gray-100"
                        value="{{ optional($booking->room)->room_name ?? '-' }}"
                        disabled>
                </div>

                <div>
                    <label class="form-label">หัวข้อการประชุม</label>
                    <input type="text"
                        name="meeting_topic"
                        class="form-input @error('meeting_topic') input-error @enderror"
                        value="{{ old('meeting_topic', $booking->meeting_topic) }}"
                        placeholder="ระบุหัวข้อการประชุม">
                </div>

            </div>
        </div>

        {{-- ========== ข้อมูลผู้ขอใช้ห้อง ========== --}}
        <div class="card-box">
            <div class="card-header">ข้อมูลผู้ขอใช้ห้อง</div>
            <div class="card-body">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    {{-- 🔒 กลุ่มงาน (คงที่เหมือนตอนจอง) --}}
                    <div>
                        <label class="form-label">กลุ่มงาน</label>
                        <input type="text"
                            class="form-input bg-gray-100"
                            value="{{ $booking->department ?? '-' }}"
                            disabled>
                    </div>

                    {{-- ✅ แก้ได้ --}}
                    <div>
                        <label class="form-label">เบอร์โทร</label>
                        <input type="text"
                            name="phone"
                            class="form-input @error('phone') input-error @enderror"
                            value="{{ old('phone', $booking->phone) }}"
                            placeholder="เบอร์โทร">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    {{-- ✅ แก้ได้ --}}
                    <div>
                        <label class="form-label">ชื่อ</label>
                        <input type="text"
                            name="name"
                            class="form-input @error('name') input-error @enderror"
                            value="{{ old('name', $booking->name) }}"
                            placeholder="ชื่อ">
                    </div>

                    {{-- ✅ แก้ได้ --}}
                    <div>
                        <label class="form-label">นามสกุล</label>
                        <input type="text"
                            name="lastname"
                            class="form-input @error('lastname') input-error @enderror"
                            value="{{ old('lastname', $booking->lastname) }}"
                            placeholder="นามสกุล">
                    </div>
                </div>

            </div>
        </div>

        <div class="booking-actions">
            <button type="submit" class="btn-submit-booking">
                บันทึกการแก้ไข
            </button>
        </div>
    </form>
</div>

{{-- ===== Popup Confirm ===== --}}
<div id="confirmPopup" class="popup-overlay" style="display:none;">
    <div class="popup-box">
        <div class="popup-icon-circle">
            <i class="bi bi-check-lg"></i>
        </div>

        <div class="popup-text" style="margin-bottom:1.2rem;">
            ยืนยันการแก้ไขข้อมูลการจองหรือไม่?
        </div>

        <div style="display:flex; gap:1rem; justify-content:center;">
            <button type="button" class="btn-cancel" onclick="closeConfirmPopup()">ยกเลิก</button>
            <button type="button" class="btn-confirm" onclick="submitForm()">ตกลง</button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('bookingForm');
        const banner = document.getElementById('client-error-banner');
        const popup = document.getElementById('confirmPopup');

        window.closeConfirmPopup = () => popup.style.display = 'none';
        window.submitForm = () => {
            popup.style.display = 'none';
            form.submit();
        };

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            // ✅ ช่องที่ "ต้องกรอก" (และแก้ได้)
            const requiredFields = [
                'use_date',
                'start_time',
                'end_time',
                'meeting_topic',
                'department', // hidden (ต้องมี)
                'name',
                'lastname',
                'phone',
                'room_id' // hidden (ต้องมี)
            ];

            let isValid = true;

            requiredFields.forEach(function(field) {
                const input = form.querySelector(`[name="${field}"]`);
                if (input && String(input.value).trim() === '') {
                    input.classList.add('input-error');
                    isValid = false;
                } else if (input) {
                    input.classList.remove('input-error');
                }
            });

            if (!isValid) {
                banner.style.display = 'block';
                return;
            }

            banner.style.display = 'none';
            popup.style.display = 'flex';
        });
    });
</script>
@endsection