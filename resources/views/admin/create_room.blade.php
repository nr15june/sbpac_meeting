@extends('admin.layout')

@section('title', 'เพิ่มห้องประชุม | ศอ.บต.')

@section('content')

{{-- ============ CSS เฉพาะหน้านี้ ============ --}}
<style>
    .create-room-wrapper {
        max-width: 960px;
        margin: 0 auto;
    }

    /* แถบหัวข้อ + ปุ่มย้อนกลับ */
    .create-room-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1rem;
    }

    .create-room-header-left {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .create-room-icon {
        width: 2.25rem;  /* 36px */
        height: 2.25rem;
        border-radius: 9999px;
        background-color: #F2F2F2;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .create-room-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: #1f2933;
    }

    .btn-back {
        padding: 0.5rem 1.25rem;
        border-radius: 9999px;
        border: 1px solid #9ca3af;
        background-color: #ffffff;
        font-size: 0.875rem;
        color: #374151;
        cursor: pointer;
    }
    .btn-back:hover {
        background-color: #f3f4f6;
    }

    /* กล่องฟอร์ม */
    .create-room-card {
        background-color: #ffffff;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        box-shadow: 0 1px 2px rgba(0,0,0,0.05);
    }

    .create-room-card-header {
        padding: 0.75rem 1.5rem;
        border-bottom: 1px solid #e5e7eb;
        font-size: 0.875rem;
        font-weight: 600;
        color: #1f2933;
        background-color: #F7F7F7;
    }

    .create-room-card-body {
        padding: 1.5rem;
    }

    /* ฟอร์ม */
    .form-group {
        margin-bottom: 1rem;
    }

    .form-label {
        display: block;
        font-size: 0.875rem;
        margin-bottom: 0.25rem;
        color: #374151;
    }

    .form-input,
    .form-textarea,
    .form-file {
        width: 100%;
        border-radius: 0.375rem;
        border: 1px solid #d1d5db;
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
        outline: none;
        background-color: #ffffff;
    }

    .form-input:focus,
    .form-textarea:focus,
    .form-file:focus {
        border-color: #9ca3af;
        box-shadow: 0 0 0 1px #9ca3af33;
    }

    .form-textarea {
        resize: none;
        min-height: 6rem;
    }

    /* แบ่งคอลัมน์ อาคาร + จำนวนคน */
    .form-row {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1rem;
    }

    @media (min-width: 768px) {
        .form-row {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    /* ปุ่มบันทึก */
    .btn-submit-wrapper {
        padding-top: 0.5rem;
        display: flex;
        justify-content: flex-end;
    }

    .btn-submit {
        padding: 0.6rem 2.5rem;
        border-radius: 9999px;
        border: none;
        background-color: #FFE04B;
        font-size: 0.875rem;
        font-weight: 600;
        color: #111827;
        cursor: pointer;
    }

    .btn-submit:hover {
        background-color: #f2c739;
    }
</style>

{{-- ============ เนื้อหา ============ --}}
<div class="create-room-wrapper">

    {{-- แถบหัวข้อ + ปุ่มย้อนกลับ --}}
    <div class="create-room-header">
        <div class="create-room-header-left">
            <div class="create-room-icon">
                <i class="bi bi-calendar2-plus" style="font-size: 1.25rem; color: #374151;"></i>
            </div>
            <h1 class="create-room-title">เพิ่มห้องประชุม</h1>
        </div>

        <button type="button"
                onclick="history.back()"
                class="btn-back">
            ย้อนกลับ
        </button>
    </div>

    {{-- กล่องฟอร์ม --}}
    <div class="create-room-card">

        {{-- หัวข้อย่อย --}}
        <div class="create-room-card-header">
            รายละเอียดห้องประชุม
        </div>

        {{-- ฟอร์มเพิ่มห้อง --}}
        <form action="{{ route('rooms.store') }}" method="POST" enctype="multipart/form-data" class="create-room-card-body">
            @csrf

            {{-- ชื่อห้องประชุม --}}
            <div class="form-group">
                <label class="form-label">ชื่อห้องประชุม</label>
                <input type="text" name="room_name"
                       class="form-input"
                       placeholder="ระบุชื่อห้องประชุม">
            </div>

            {{-- อาคาร + จำนวนคน/ห้อง --}}
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">อาคาร</label>
                    <input type="text" name="building"
                           class="form-input"
                           placeholder="อาคาร / ชั้น">
                </div>

                <div class="form-group">
                    <label class="form-label">จำนวนคน/ห้อง</label>
                    <input type="number" name="capacity" min="1"
                           class="form-input"
                           placeholder="เช่น 20">
                </div>
            </div>

            {{-- รายละเอียด --}}
            <div class="form-group">
                <label class="form-label">รายละเอียด</label>
                <textarea name="description"
                          class="form-textarea"
                          placeholder="เช่น มีโปรเจคเตอร์ ไมโครโฟน ไวท์บอร์ด ฯลฯ"></textarea>
            </div>

            {{-- อัปโหลดรูปภาพ --}}
            <div class="form-group">
                <label class="form-label">รูปภาพ</label>
                <input type="file" name="room_image"
                       class="form-file">
            </div>

            {{-- ปุ่มบันทึก --}}
            <div class="btn-submit-wrapper">
                <button type="submit"
                        onclick="return confirm('ยืนยันการบันทึกข้อมูลห้องประชุมหรือไม่?')"
                        class="btn-submit">
                    บันทึก
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
