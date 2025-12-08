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
        /* เดิมเป็น space-between → เอาออกให้ชิดซ้ายเหมือน room */
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
        /* แบบเดียวกับ create-room-header-left */
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
        /* ให้เท่ากับ create-room-title */
        font-weight: 600;
        color: #1f2933;
        /* เทาเข้ม เหมือน room */
        margin: 0;
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

    .form-textarea {
        resize: vertical;
        min-height: 90px;
    }

    /* ปุ่มจอง */
    .booking-actions {
        display: flex;
        justify-content: flex-end;
        margin-top: 0.5rem;
    }

    .btn-submit-booking {
        padding: 0.6rem 3rem;
        border-radius: 999px;
        border: none;
        background-color: #50C65E;
        font-size: 0.9rem;
        font-weight: 600;
        color: #ffffff;
        cursor: pointer;
        box-shadow: 0 2px 6px rgba(16, 185, 129, 0.35);
    }

    .btn-submit-booking:hover {
        background-color: #45b154;
    }
</style>

{{-- ========== ส่วน HTML + Blade (เนื้อหา) ========== --}}
@section('content')
<div class="booking-wrapper">

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

                {{-- วันที่ / เวลา (ยังใช้ grid ของ Tailwind ไว้ได้) --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                    <div>
                        <label class="form-label">วันที่ใช้ห้อง</label>
                        <input type="date" name="use_date" class="form-input">
                    </div>
                    <div>
                        <label class="form-label">เวลาเริ่ม</label>
                        <input type="time" name="start_time" class="form-input">
                    </div>
                    <div>
                        <label class="form-label">เวลาสิ้นสุด</label>
                        <input type="time" name="end_time" class="form-input">
                    </div>
                </div>

                {{-- ห้องประชุม --}}
                <div class="mb-4">
                    <label class="form-label">ห้องประชุม</label>
                    <select name="room_id" class="form-select">
                        <option value="">-- เลือกห้องประชุม --</option>
                        @isset($rooms)
                        @foreach($rooms as $room)
                        <option value="{{ $room->room_id }}"
                            {{ request('room_id') == $room->room_id ? 'selected' : '' }}>
                            {{ $room->room_name }}
                        </option>
                        @endforeach
                        @else
                        <option value="1">ห้องประชุม 1</option>
                        @endisset
                    </select>
                </div>

                {{-- หัวข้อการประชุม --}}
                <div>
                    <label class="form-label">หัวข้อการประชุม</label>
                    <input type="text" name="meeting_topic"
                        class="form-input"
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
                    <label class="form-label">กลุ่มงาน / ส่วนงาน</label>
                    <input type="text" name="department"
                        class="form-input"
                        placeholder="เช่น กลุ่มงานบริหารงบประมาณ">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="form-label">ชื่อ</label>
                        <input type="text" name="first_name" class="form-input">
                    </div>
                    <div>
                        <label class="form-label">นามสกุล</label>
                        <input type="text" name="last_name" class="form-input">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="form-label">เบอร์โทร</label>
                        <input type="text" name="phone" class="form-input">
                    </div>
                    <div>
                        <label class="form-label">อีเมล</label>
                        <input type="email" name="email" class="form-input">
                    </div>
                </div>

                <div>
                    <label class="form-label">รายละเอียดเพิ่มเติม</label>
                    <textarea name="note" class="form-textarea"
                        placeholder="เช่น ต้องการอุปกรณ์เพิ่มเติม, การจัดรูปแบบโต๊ะ ฯลฯ"></textarea>
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
@endsection