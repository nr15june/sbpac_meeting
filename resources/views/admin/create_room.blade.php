@extends('admin.layout')

@section('title', 'เพิ่มห้องประชุม | ศอ.บต.')

@section('content')

{{-- ============ CSS เฉพาะหน้านี้ ============ --}}
<style>
    .create-room-wrapper {
        max-width: 1100px;
        margin: 0 auto;
        padding: 0 1rem;
    }

    /* แถบหัวข้อ + ปุ่มย้อนกลับ */
    .create-room-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.5rem;
        padding: 1rem 1.5rem;
        background-color: #ffffff;
        border: 1px solid #ebeaeaff;
        border-radius: 0.450rem;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    .create-room-header-left {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .create-room-icon {
        width: 2rem;
        height: 2rem;
        border-radius: 0.375rem;
        background-color: #ffffff;
        border: 1px solid #d4d4d4;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .create-room-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: #1f2933;
        /* เทาเข้ม */
    }

    .btn-back:hover {
        background-color: #f3f4f6;
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
    }

    .btn-back:hover {
        background-color: #f3f4f6;
    }

    .create-room-card {
        background-color: #ffffff;
        border: 1px solid #e9eaebff;
        border-radius: 0.375rem;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    .create-room-card-header {
        padding: 0.75rem 1.5rem;
        border-bottom: 1px solid #e5e7eb;
        font-size: 1rem;
        font-weight: 500;
        color: #1f2933;
        background-color: #F7F7F7;
    }

    .create-room-card-body {
        padding: 1.5rem;
    }

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

    .btn-submit-wrapper {
        padding-top: 0.5rem;
        display: flex;
        justify-content: flex-end;
    }

    .btn-submit {
        padding: 0.45rem 1.2rem;
        border-radius: 8px;
        border: none;
        background-color: #F5D020;
        font-size: 0.875rem;
        font-weight: 600;
        color: #111827;
        cursor: pointer;
    }

    .btn-submit:hover {
        background-color: #f2c739;
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

    .popup-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.45);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
    }

    .popup-box {
        background: #ffffff;
        padding: 2.5rem 3rem;
        border-radius: 10px;
        text-align: center;
        min-width: 320px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.2);
        animation: popupShow 0.25s ease-out;
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

    @keyframes popupShow {
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

        <a href="{{ route('admin_meetingrooms') }}" class="btn-back">
            <i class="bi bi-arrow-left"></i> ย้อนกลับ
        </a>
    </div>

    {{-- กล่องฟอร์ม --}}
    <div class="create-room-card">

        {{-- หัวข้อย่อย --}}
        <div class="create-room-card-header">
            รายละเอียดห้องประชุม
        </div>

        {{-- ฟอร์มเพิ่มห้อง --}}
        <form id="create-room-form"
            action="{{ route('rooms.store') }}"
            method="POST"
            enctype="multipart/form-data"
            class="create-room-card-body">
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
                        placeholder="เช่น 10">
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
                {{-- ❌ ไม่ใช้ confirm ของ browser แล้ว --}}
                {{-- <button type="submit" onclick="return confirm('ยืนยันการบันทึกข้อมูลห้องประชุมหรือไม่?')" class="btn-submit">บันทึก</button> --}}

                {{-- ✅ ใช้ปุ่มเปิด popup แทน --}}
                <button type="button"
                    onclick="openConfirmPopup()"
                    class="btn-submit">
                    บันทึก
                </button>
            </div>
        </form>

        {{-- ===== Popup Confirm ===== --}}
        <div id="confirmPopup" class="popup-overlay" style="display: none;">
            <div class="popup-box">
                <div class="popup-icon-circle">
                    <i class="bi bi-question-lg"></i>
                </div>

                <div class="popup-text" style="margin-bottom: 1.2rem;">
                    ต้องการบันทึกข้อมูลห้องประชุมหรือไม่?
                </div>

                <div style="display:flex; gap:1rem; justify-content:center;">
                    <button class="btn-cancel" onclick="closeConfirmPopup()">ยกเลิก</button>
                    <button class="btn-confirm" onclick="submitForm()">ตกลง</button>
                </div>
            </div>
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

    function submitForm() {
        // ส่งฟอร์มจริง
        document.getElementById('create-room-form').submit();
    }
</script>

@endsection