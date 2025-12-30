@extends('user.layout')

@section('title', 'แก้ไขการจองห้องประชุม | ศอ.บต.')

@section('content')

<style>
    main { background: #f3f4f6; }

    :root {
        --brand: #25A6D5;
        --ink: #0f172a;
        --muted: #64748b;
        --line: #e5e7eb;
        --card: #ffffff;
        --soft: #f8fafc;
        --shadow: 0 10px 30px rgba(15, 23, 42, .08);
        --yellow: #F5D020;
        --ok: #22c55e; /* ✅ เพิ่มให้ popup-icon ใช้ได้ */
    }

    .ed-wrap {
        max-width: 1120px;
        margin: 0 auto;
        padding: 0 1rem 1.5rem;
    }

    /* ===== Banner error ===== */
    .ed-banner {
        display: none;
        margin-bottom: 12px;
        padding: 10px 12px;
        border-radius: 12px;
        background: #FEF2F2;
        border: 1px solid #fecaca;
        color: #b91c1c;
        font-size: 13px;
        font-weight: 900;
        align-items: center;
        gap: 8px;
    }

    /* ===== HERO ===== */
    .ed-hero {
        background: linear-gradient(135deg, #ffffff 0%, #ffffff 62%, #eefaff 100%);
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

    .ed-hero-left {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 0;
    }

    .ed-hero-ico {
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

    .ed-hero-title {
        margin: 0;
        font-size: 18px;
        font-weight: 1000;
        color: var(--ink);
        line-height: 1.1;
        letter-spacing: .2px;
    }

    .ed-hero-sub {
        margin: 4px 0 0 0;
        font-size: 12.5px;
        color: var(--muted);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 720px;
    }

    .ed-back {
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

    .ed-back:hover { background: var(--soft); transform: translateY(-1px); }
    .ed-back:active { transform: scale(.98); }

    /* ===== CARD ===== */
    .ed-card {
        background: var(--card);
        border: 1px solid var(--line);
        border-radius: 18px;
        box-shadow: var(--shadow);
        overflow: hidden;
        margin-bottom: 14px;
    }

    .ed-card-head {
        padding: 12px 16px;
        border-bottom: 1px solid var(--line);
        background: #fbfdff;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        flex-wrap: wrap;
    }

    .ed-card-head-left {
        display: flex;
        align-items: center;
        gap: 10px;
        color: var(--ink);
        font-weight: 1000;
    }

    .ed-mini-ico {
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

    .ed-card-title { font-weight: 1000; color: var(--ink); }
    .ed-card-body { padding: 14px 16px 16px; }

    /* ===== FORM ===== */
    .ed-label {
        display: block;
        font-size: 12.5px;
        font-weight: 900;
        color: #334155;
        margin-bottom: 6px;
    }

    .ed-input {
        width: 100%;
        border-radius: 12px;
        border: 1px solid #d1d5db;
        padding: 10px 12px;
        font-size: 14px;
        outline: none;
        background: #fff;
        transition: border-color .15s ease, box-shadow .15s ease;
    }

    .ed-input:focus {
        border-color: #38bdf8;
        box-shadow: 0 0 0 3px rgba(56, 189, 248, .18);
    }

    .ed-disabled {
        background: #f3f4f6 !important;
        border-color: #e5e7eb !important;
        color: #0f172a;
    }

    .input-error {
        border-color: #ef4444 !important;
        background: #fef2f2 !important;
    }

    /* ===== ACTIONS ===== */
    .ed-actions {
        display: flex;
        justify-content: flex-end;
        margin-top: 12px;
    }

    .ed-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 16px;
        border-radius: 14px;
        border: 1px solid rgba(0, 0, 0, .06);
        background: var(--yellow);
        color: #111827;
        font-weight: 1000;
        cursor: pointer;
        box-shadow: 0 10px 18px rgba(245, 208, 32, .25), 0 6px 12px rgba(15, 23, 42, .08);
        transition: .15s ease;
        white-space: nowrap;
    }

    .ed-btn:hover { filter: brightness(.98); transform: translateY(-1px); }
    .ed-btn:active { transform: scale(.98); }

    /* ===== Popup ===== */
    .popup-overlay {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.55);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        backdrop-filter: blur(2px);
        padding: 1rem;
    }

    .popup-box {
        width: min(440px, 92vw);
        background: #fff;
        border-radius: 18px;
        border: 1px solid var(--line);
        box-shadow: 0 22px 60px rgba(0, 0, 0, .25);
        padding: 18px 18px 16px;
        animation: pop .18s ease-out;
    }

    @keyframes pop {
        from { transform: translateY(8px) scale(.98); opacity: 0; }
        to   { transform: translateY(0) scale(1); opacity: 1; }
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
        border: 1px solid rgba(34, 197, 94, .22);
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
        border-radius: 14px;
        background: #f1f5f9;
        border: 1px solid #e2e8f0;
        font-weight: 1000;
        cursor: pointer;
    }

    .btn-cancel:hover { background: #eaf0f7; }

    .btn-confirm {
        padding: 10px 14px;
        border-radius: 14px;
        background: #22c55e;
        border: 1px solid #16a34a;
        color: #fff;
        font-weight: 1000;
        cursor: pointer;
    }

    .btn-confirm:hover { filter: brightness(.95); }

    @media (max-width: 900px) {
        .ed-hero { flex-direction: column; align-items: stretch; }
        .ed-back { width: fit-content; }
        .ed-hero-sub { max-width: 100%; }
    }
</style>

@php
    $roomName = optional($booking->room)->room_name ?? '-';
@endphp

<div class="ed-wrap">

    <div id="client-error-banner" class="ed-banner">
        <i class="bi bi-exclamation-triangle"></i> กรุณากรอกข้อมูลให้ครบถ้วน
    </div>

    {{-- HERO --}}
    <div class="ed-hero">
        <div class="ed-hero-left">
            <div class="ed-hero-ico"><i class="bi bi-pencil-square"></i></div>
            <div style="min-width:0;">
                <h1 class="ed-hero-title">แก้ไขการจองห้องประชุม</h1>
                <p class="ed-hero-sub">ปรับวัน เวลา และข้อมูลผู้ขอใช้ห้อง แล้วกดบันทึกการแก้ไข</p>
            </div>
        </div>

        <a class="ed-back" href="{{ route('user_history_booking') }}">
            <i class="bi bi-arrow-left"></i> ย้อนกลับ
        </a>
    </div>

    <form id="bookingForm" action="{{ route('user_update_booking', $booking->booking_id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- ค่าคงที่ --}}
        <input type="hidden" name="room_id" value="{{ $booking->room_id }}">
        <input type="hidden" name="department" value="{{ $booking->department }}">

        {{-- CARD: ข้อมูลการใช้ห้อง --}}
        <div class="ed-card">
            <div class="ed-card-head">
                <div class="ed-card-head-left">
                    <div class="ed-mini-ico"><i class="bi bi-clipboard-check"></i></div>
                    <div class="ed-card-title">ข้อมูลการใช้ห้อง</div>
                </div>
            </div>

            <div class="ed-card-body">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                    <div>
                        <label class="ed-label">วันที่ใช้ห้อง</label>
                        <input type="date"
                               name="use_date"
                               class="ed-input @error('use_date') input-error @enderror"
                               value="{{ old('use_date', $use_date) }}">
                    </div>

                    <div>
                        <label class="ed-label">เวลาเริ่ม</label>
                        <input type="time"
                               name="start_time"
                               class="ed-input @error('start_time') input-error @enderror"
                               value="{{ old('start_time', $start_time) }}">
                    </div>

                    <div>
                        <label class="ed-label">เวลาสิ้นสุด</label>
                        <input type="time"
                               name="end_time"
                               class="ed-input @error('end_time') input-error @enderror"
                               value="{{ old('end_time', $end_time) }}">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="ed-label">ห้องประชุม</label>
                    <input type="text" class="ed-input ed-disabled" value="{{ $roomName }}" disabled>
                </div>

                <div>
                    <label class="ed-label">หัวข้อการประชุม</label>
                    <input type="text"
                           name="meeting_topic"
                           class="ed-input @error('meeting_topic') input-error @enderror"
                           value="{{ old('meeting_topic', $booking->meeting_topic) }}"
                           placeholder="ระบุหัวข้อการประชุม">
                </div>
            </div>
        </div>

        {{-- CARD: ข้อมูลผู้ขอใช้ห้อง --}}
        <div class="ed-card">
            <div class="ed-card-head">
                <div class="ed-card-head-left">
                    <div class="ed-mini-ico"><i class="bi bi-person-badge"></i></div>
                    <div class="ed-card-title">ข้อมูลผู้ขอใช้ห้อง</div>
                </div>
            </div>

            <div class="ed-card-body">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="ed-label">กลุ่มงาน</label>
                        <input type="text" class="ed-input ed-disabled" value="{{ $booking->department ?? '-' }}" disabled>
                    </div>

                    <div>
                        <label class="ed-label">เบอร์โทร</label>
                        <input type="text"
                               name="phone"
                               class="ed-input @error('phone') input-error @enderror"
                               value="{{ old('phone', $booking->phone) }}"
                               placeholder="เบอร์โทร">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="ed-label">ชื่อ</label>
                        <input type="text"
                               name="name"
                               class="ed-input @error('name') input-error @enderror"
                               value="{{ old('name', $booking->name) }}"
                               placeholder="ชื่อ">
                    </div>

                    <div>
                        <label class="ed-label">นามสกุล</label>
                        <input type="text"
                               name="lastname"
                               class="ed-input @error('lastname') input-error @enderror"
                               value="{{ old('lastname', $booking->lastname) }}"
                               placeholder="นามสกุล">
                    </div>
                </div>

                <div class="ed-actions">
                    <button type="submit" class="ed-btn">
                        <i class="bi bi-save2"></i> บันทึกการแก้ไข
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

{{-- Popup Confirm --}}
<div id="confirmPopup" class="popup-overlay" aria-hidden="true">
    <div class="popup-box" role="dialog" aria-modal="true">
        <div class="popup-top">
            <div class="popup-icon"><i class="bi bi-check2-circle"></i></div>
            <div>
                <div class="popup-title">ยืนยันการแก้ไขข้อมูลการจองหรือไม่?</div>
                <div class="popup-text">ตรวจสอบวันและเวลาให้ถูกต้องก่อนกดยืนยัน</div>
            </div>
        </div>

        <div class="popup-actions">
            <button class="btn-cancel" type="button" onclick="closeConfirmPopup()">ยกเลิก</button>
            {{-- ✅ แก้: เรียก submitForm() ให้ตรงกับ JS --}}
            <button class="btn-confirm" type="button" onclick="submitForm()">ตกลง</button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form   = document.getElementById('bookingForm');
        const banner = document.getElementById('client-error-banner');
        const popup  = document.getElementById('confirmPopup');

        function openConfirmPopup() {
            popup.style.display = 'flex';
            popup.setAttribute('aria-hidden', 'false');
        }

        window.closeConfirmPopup = function() {
            popup.style.display = 'none';
            popup.setAttribute('aria-hidden', 'true');
        };

        // ✅ ใช้ชื่อเดียวกับที่ปุ่มเรียก
        window.submitForm = function() {
            window.closeConfirmPopup();
            form.submit();
        };

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const requiredFields = [
                'use_date','start_time','end_time','meeting_topic',
                'department','name','lastname','phone','room_id'
            ];

            let isValid = true;

            requiredFields.forEach((field) => {
                const input = form.querySelector(`[name="${field}"]`);
                if (input && String(input.value).trim() === '') {
                    input.classList.add('input-error');
                    isValid = false;
                } else if (input) {
                    input.classList.remove('input-error');
                }
            });

            if (!isValid) {
                banner.style.display = 'flex';
                window.scrollTo({ top: 0, behavior: 'smooth' });
                return;
            }

            banner.style.display = 'none';
            openConfirmPopup();
        });

        // ✅ คลิกพื้นหลังเพื่อปิด
        popup.addEventListener('click', function(e) {
            if (e.target === popup) window.closeConfirmPopup();
        });

        // ✅ กด ESC เพื่อปิด
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && popup.style.display === 'flex') {
                window.closeConfirmPopup();
            }
        });
    });
</script>

@endsection
