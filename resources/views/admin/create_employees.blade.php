@extends('admin.layout')

@section('title', 'เพิ่มพนักงาน | ศอ.บต.')

@section('content')

{{-- ============ CSS เฉพาะหน้านี้ ============ --}}
<style>
    .create-emp-wrapper {
        max-width: 1100px;
        margin: 0 auto;
        padding: 0 1rem;
    }

    /* แถบหัวข้อ + ปุ่มย้อนกลับ */
    .create-emp-header {
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

    .create-emp-header-left {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .create-emp-icon {
        width: 2rem;
        height: 2rem;
        border-radius: 0.375rem;
        background-color: #ffffff;
        border: 1px solid #d4d4d4;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .create-emp-title {
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
    }

    .btn-back:hover {
        background-color: #f3f4f6;
    }

    .create-emp-card {
        background-color: #ffffff;
        border: 1px solid #e9eaebff;
        border-radius: 0.375rem;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    .create-emp-card-header {
        padding: 0.75rem 1.5rem;
        border-bottom: 1px solid #e5e7eb;
        font-size: 1rem;
        font-weight: 500;
        color: #1f2933;
        background-color: #F7F7F7;
    }

    .create-emp-card-body {
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
        font-weight: 600;
    }

    .form-input,
    .form-select {
        width: 100%;
        border-radius: 0.375rem;
        border: 1px solid #d1d5db;
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
        outline: none;
        background-color: #ffffff;
    }

    .form-input:focus,
    .form-select:focus {
        border-color: #9ca3af;
        box-shadow: 0 0 0 1px #9ca3af33;
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

    .error-msg {
        margin-top: .35rem;
        font-size: .85rem;
        color: #b91c1c;
        font-weight: 600;
    }

    .btn-submit-wrapper {
        padding-top: 0.5rem;
        display: flex;
        justify-content: flex-end;
        gap: .75rem;
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
        border: none;
        color: #111827;
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
        color: #111827;
        font-weight: 700;
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
<div class="create-emp-wrapper">

    {{-- แถบหัวข้อ + ปุ่มย้อนกลับ --}}
    <div class="create-emp-header">
        <div class="create-emp-header-left">
            <div class="create-emp-icon">
                <i class="bi bi-person-plus" style="font-size: 1.25rem; color: #374151;"></i>
            </div>
            <h1 class="create-emp-title">เพิ่มพนักงาน</h1>
        </div>

        <a href="{{ route('admin_employees') }}" class="btn-back">
            <i class="bi bi-arrow-left"></i> ย้อนกลับ
        </a>
    </div>

    <div class="create-emp-card">
        <div class="create-emp-card-header">
            รายละเอียดพนักงาน
        </div>

        <div class="create-emp-card-body">

            {{-- ฟอร์มเพิ่มพนักงาน --}}
            <form id="create-emp-form" action="{{ route('admin_store_employees') }}" method="POST">
                @csrf

                {{-- แสดงกลุ่มงาน (ดึงจาก DB) แต่แก้ไม่ได้ --}}
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">กลุ่มงาน</label>
                        <input type="text"
                            class="form-input"
                            value="{{ $departmentName ?? '-' }}"
                            readonly>

                        {{-- ส่ง id ไปด้วย (ถ้าต้องการรับใน controller) --}}
                        <input type="hidden" name="department_id" value="{{ $departmentId ?? '' }}">

                        @error('department_id') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">เลขบัตรประชาชน</label>
                        <input type="text" name="card_id" maxlength="13"
                            class="form-input" placeholder="13 หลัก"
                            value="{{ old('card_id') }}">
                        @error('card_id') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">ชื่อ</label>
                        <input type="text" name="first_name"
                            class="form-input" placeholder="ชื่อ"
                            value="{{ old('first_name') }}">
                        @error('first_name') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">นามสกุล</label>
                        <input type="text" name="last_name"
                            class="form-input" placeholder="นามสกุล"
                            value="{{ old('last_name') }}">
                        @error('last_name') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">เบอร์โทร</label>
                        <input type="text" name="phone"
                            class="form-input" placeholder="เช่น 08xxxxxxxx"
                            value="{{ old('phone') }}">
                        @error('phone') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">อีเมล</label>
                        <input type="text" name="email"
                            class="form-input" placeholder="อีเมล"
                            value="{{ old('email') }}">
                        @error('email') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class=" form-group">
                        <label class="form-label">รหัสผ่าน</label>
                        <input type="password" name="password"
                            class="form-input" placeholder="รหัสผ่าน"
                            value="{{ old('password') }}">
                        @error('password') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">ยืนยันรหัสผ่าน</label>
                        <input type="password" name="password_confirmation" class="form-input" placeholder="ยืนยันรหัสผ่าน">
                    </div>
                </div>

                {{-- ปุ่มบันทึก --}}
                <div class="btn-submit-wrapper">
                    <button type="button" onclick="openConfirmPopup()" class="btn-submit">
                        บันทึก
                    </button>
                </div>
            </form>

        </div>
    </div>

    {{-- ===== Popup Confirm ===== --}}
    <div id="confirmPopup" class="popup-overlay" style="display: none;">
        <div class="popup-box">
            <div class="popup-icon-circle">
                <i class="bi bi-question-lg"></i>
            </div>

            <div class="popup-text" style="margin-bottom: 1.2rem;">
                ต้องการบันทึกข้อมูลพนักงานหรือไม่?
            </div>

            <div style="display:flex; gap:1rem; justify-content:center;">
                <button class="btn-cancel" onclick="closeConfirmPopup()">ยกเลิก</button>
                <button class="btn-confirm" onclick="submitForm()">ตกลง</button>
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
        document.getElementById('create-emp-form').submit();
    }
</script>

@endsection