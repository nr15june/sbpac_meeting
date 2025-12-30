@extends('user.layout')

@section('title', 'จองห้องประชุม | ศอ.บต.')

@section('content')

<style>
    /* ===== Page Background (เหมือนแอดมิน) ===== */
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
        --warn: #f59e0b;
        --shadow: 0 10px 30px rgba(15, 23, 42, .08);
    }

    .bk-wrapper {
        max-width: 1120px;
        margin: 0 auto;
        padding: 0 1rem 1.5rem;
    }

    /* ===== Hero (เหมือนหน้าแอดมิน) ===== */
    .bk-hero {
        background: linear-gradient(135deg, #ffffff 0%, #ffffff 60%, #eefaff 100%);
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

    .bk-hero-left {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .bk-hero-icon {
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
        flex: 0 0 auto;
    }

    .bk-hero-title {
        margin: 0;
        font-size: 18px;
        font-weight: 900;
        color: var(--ink);
        letter-spacing: .2px;
    }

    .bk-hero-sub {
        margin: 2px 0 0 0;
        font-size: 12.5px;
        color: var(--muted);
    }

    .bk-back {
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

    .bk-back:hover {
        background: var(--soft);
        transform: translateY(-1px);
    }

    .bk-back:active {
        transform: scale(.98);
    }

    /* ===== Summary pill (ขวาบน) ===== */
    .bk-pill {
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

    /* ===== Card ===== */
    .bk-card {
        background: var(--card);
        border: 1px solid var(--line);
        border-radius: 16px;
        box-shadow: 0 8px 22px rgba(15, 23, 42, .06);
        overflow: hidden;
        margin-bottom: 14px;
    }

    .bk-card-head {
        padding: 12px 14px;
        background: #fbfdff;
        border-bottom: 1px solid var(--line);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }

    .bk-card-title {
        font-weight: 900;
        color: var(--ink);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .bk-card-title i {
        width: 34px;
        height: 34px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #eef2ff;
        color: #4338ca;
        border: 1px solid var(--line);
    }

    .bk-card-body {
        padding: 14px;
    }

    /* ===== Form ===== */
    .bk-label {
        display: block;
        font-size: 12.5px;
        font-weight: 800;
        color: #334155;
        margin-bottom: 6px;
    }

    .bk-input,
    .bk-select,
    .bk-textarea {
        width: 100%;
        border-radius: 12px;
        border: 1px solid #d1d5db;
        padding: 10px 12px;
        font-size: 14px;
        outline: none;
        background: #fff;
        transition: border-color .15s ease, box-shadow .15s ease;

    }

    .bk-input:focus,
    .bk-select:focus,
    .bk-textarea:focus {
        border-color: #38bdf8;
        box-shadow: 0 0 0 3px rgba(56, 189, 248, .18);
    }

    .bk-disabled {
        background: #f3f4f6 !important;
        border-color: #e5e7eb !important;
        color: #0f172a;
    }

    /* ===== Error ===== */
    .input-error {
        border-color: #ef4444 !important;
        background: #fef2f2 !important;
    }

    .bk-banner {
        display: none;
        margin-bottom: 12px;
        padding: 10px 12px;
        border-radius: 12px;
        background: #FEF2F2;
        border: 1px solid #fecaca;
        color: #b91c1c;
        font-size: 13px;
        font-weight: 800;
    }

    /* ===== Actions ===== */
    .bk-actions {
        display: flex;
        justify-content: flex-end;
        width: 100%;
        margin-top: 12px;
    }

    .bk-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 16px;
        border-radius: 14px;
        border: 1px solid rgba(0, 0, 0, .06);
        background: linear-gradient(135deg, var(--yellow) 0%, #F2C230 100%);
        color: #111827;
        font-weight: 1000;
        cursor: pointer;
        box-shadow: 0 10px 18px rgba(245, 208, 32, .25), 0 6px 12px rgba(15, 23, 42, .08);
        transition: .15s ease;
        white-space: nowrap;
    }

    .bk-btn:hover {
        filter: brightness(.98);
        transform: translateY(-1px);
    }

    .bk-btn:active {
        transform: scale(.98);
    }

    .bk-btn-primary {
        background: #F5D020;
        color: #111827;
        box-shadow: 0 10px 18px rgba(245, 208, 32, .25);
    }

    .bk-btn-primary:hover {
        filter: brightness(.98);
        transform: translateY(-1px);
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
        width: min(440px, 92vw);
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
        background: rgba(34, 197, 94, .12);
        color: var(--ok);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        border: 1px solid rgba(34, 197, 94, .22);
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

    .btn-cancel,
    .btn-confirm {
        padding: 10px 16px;
        border-radius: 12px;
        font-weight: 900;
        cursor: pointer;
        border: none;
        min-width: 120px;
        transition: .15s ease;
    }

    .btn-cancel {
        padding: 10px 14px;
        border-radius: 14px;
        background: #f1f5f9;
        border: 1px solid #e2e8f0;
        font-weight: 1000;
        cursor: pointer;
    }

    .btn-cancel:hover {
        background: #eaf0f7;
    }

    .btn-confirm {
        padding: 10px 14px;
        border-radius: 14px;
        background: #22c55e;
        border: 1px solid #16a34a;
        color: #fff;
        font-weight: 1000;
        cursor: pointer;
    }

    .btn-confirm:hover {
        filter: brightness(.95);
    }
</style>

@php
$roomName = $room->room_name ?? 'ห้องประชุม';
@endphp

<div class="bk-wrapper">

    <div id="client-error-banner" class="bk-banner">
        <i class="bi bi-exclamation-triangle"></i>
        กรุณากรอกข้อมูลให้ครบถ้วน
    </div>

    {{-- ===== HERO ===== --}}
    <div class="bk-hero">
        <div class="bk-hero-left">
            <div class="bk-hero-icon"><i class="bi bi-calendar2-plus"></i></div>
            <div>
                <h1 class="bk-hero-title">จองห้องประชุม</h1>
                <p class="bk-hero-sub">ระบุวัน เวลา และข้อมูลผู้ขอใช้ห้องให้ครบถ้วน</p>
            </div>
        </div>
        <a class="bk-back" href="{{ route('user_rooms') }}">
            <i class="bi bi-arrow-left"></i> ย้อนกลับ
        </a>
    </div>

    <form id="bookingForm" action="{{ route('booking.store') }}" method="POST">
        @csrf

        {{-- ===== Card: ข้อมูลการใช้ห้อง ===== --}}
        <div class="bk-card">
            <div class="bk-card-head">
                <div class="bk-card-title">
                    <i class="bi bi-clipboard-check"></i>
                    ข้อมูลการใช้ห้อง
                </div>
            </div>

            <div class="bk-card-body">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                    <div>
                        <label class="bk-label">วันที่ใช้ห้อง</label>
                        <input
                            type="date"
                            name="use_date"
                            min="{{ now()->toDateString() }}"
                            class="bk-input @error('use_date') input-error @enderror"
                            value="{{ old('use_date') }}">
                        @error('use_date') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <label class="bk-label">เวลาเริ่ม</label>
                        <input
                            type="time"
                            name="start_time"
                            class="bk-input @error('start_time') input-error @enderror"
                            value="{{ old('start_time') }}">
                        @error('start_time') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <label class="bk-label">เวลาสิ้นสุด</label>
                        <input
                            type="time"
                            name="end_time"
                            class="bk-input @error('end_time') input-error @enderror"
                            value="{{ old('end_time') }}">
                        @error('end_time') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label class="bk-label">ห้องประชุม</label>
                        <input type="hidden" name="room_id" value="{{ $room->room_id }}">
                        <input type="text" class="bk-input bk-disabled" value="{{ $roomName }}" disabled>
                    </div>

                    <div>
                        <label class="bk-label">หัวข้อการประชุม</label>
                        <input
                            type="text"
                            name="meeting_topic"
                            class="bk-input @error('meeting_topic') input-error @enderror"
                            value="{{ old('meeting_topic') }}"
                            placeholder="ระบุหัวข้อการประชุม">
                        @error('meeting_topic')
                        <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- ===== Card: ข้อมูลผู้ขอใช้ห้อง ===== --}}
        <div class="bk-card">
            <div class="bk-card-head">
                <div class="bk-card-title">
                    <i class="bi bi-person-badge"></i>
                    ข้อมูลผู้ขอใช้ห้อง
                </div>
            </div>

            <div class="bk-card-body">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="bk-label">กลุ่มงาน</label>
                        <input type="hidden" name="department" value="{{ session('department_name') ?? '' }}">
                        <input
                            type="text"
                            class="bk-input bk-disabled @error('department') input-error @enderror"
                            value="{{ session('department_name') ?? '-' }}"
                            disabled>
                        @error('department') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <label class="bk-label">เบอร์โทร</label>
                        <input
                            type="text"
                            name="phone"
                            class="bk-input @error('phone') input-error @enderror"
                            value="{{ old('phone', session('phone')) }}"
                            placeholder="เบอร์โทร">
                        @error('phone') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="bk-label">ชื่อ</label>
                        <input
                            type="text"
                            name="first_name"
                            class="bk-input @error('first_name') input-error @enderror"
                            value="{{ old('first_name', session('first_name')) }}"
                            placeholder="ชื่อ">
                        @error('first_name') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <label class="bk-label">นามสกุล</label>
                        <input
                            type="text"
                            name="last_name"
                            class="bk-input @error('last_name') input-error @enderror"
                            value="{{ old('last_name', session('last_name')) }}"
                            placeholder="นามสกุล">
                        @error('last_name') <div class="text-red-600 text-sm mt-1">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="bk-actions">
                    <button type="submit" class="bk-btn bk-btn-primary">
                        <i class="bi bi-check2-circle"></i> ยืนยันการจอง
                    </button>
                </div>
            </div>
        </div>

    </form>
</div>

{{-- ===== Popup Confirm ===== --}}
<div id="confirmPopup" class="popup-overlay">
    <div class="popup-box">
        <div class="popup-top">
            <div class="popup-icon"><i class="bi bi-check2-circle"></i></div>
            <div>
                <div class="popup-title">ต้องการยืนยันการจองห้องประชุมหรือไม่?</div>
                <div class="popup-text">ตรวจสอบวันและเวลาก่อนกดยืนยัน</div>
            </div>
        </div>

        <div class="popup-actions">
            <button class="btn-cancel" type="button" onclick="closeConfirmPopup()">ยกเลิก</button>
            <button class="btn-confirm" type="button" onclick="submitForm()">ตกลง</button>
        </div>
    </div>
</div>

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
                'use_date', 'start_time', 'end_time', 'meeting_topic',
                'department', 'first_name', 'last_name', 'phone'
            ];

            let isValid = true;

            requiredFields.forEach((field) => {
                const input = form.querySelector(`[name="${field}"]`);
                if (input && (input.value ?? '').trim() === '') {
                    input.classList.add('input-error');
                    isValid = false;
                } else if (input) {
                    input.classList.remove('input-error');
                }
            });

            if (!isValid) {
                if (banner) banner.style.display = 'block';
                // scroll ให้เห็น banner
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
                return;
            }

            if (banner) banner.style.display = 'none';
            popup.style.display = 'flex';
        });
    });
</script>

@endsection