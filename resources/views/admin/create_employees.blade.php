@extends('admin.layout')

@section('title', 'เพิ่มพนักงาน | ศอ.บต.')

@section('content')

<style>
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
        --shadow: 0 10px 30px rgba(15, 23, 42, .08);
        --warn: #ef4444;
        --ok: #22c55e;
        --yellow: #F5D020;
    }

    .create-emp-wrapper {
        max-width: 1120px;
        margin: 0 auto;
        padding: 0 1rem 1.5rem;
    }

    /* ===== Hero (header) ===== */
    .emp-hero {
        background: linear-gradient(135deg, #ffffff 0%, #ffffff 60%, #eefaff 100%);
        border: 1px solid var(--line);
        border-radius: 18px;
        box-shadow: var(--shadow);
        padding: 16px 18px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 12px;
    }

    .hero-left {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .hero-icon {
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
    }

    .hero-title {
        margin: 0;
        font-size: 18px;
        font-weight: 900;
        color: var(--ink);
        letter-spacing: .2px;
    }

    .hero-sub {
        margin: 3px 0 0 0;
        font-size: 12.5px;
        color: var(--muted);
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 14px;
        border-radius: 14px;
        background: #fff;
        border: 1px solid var(--line);
        color: #0f172a;
        font-weight: 900;
        text-decoration: none;
        box-shadow: 0 6px 12px rgba(15, 23, 42, .06);
        transition: .15s ease;
        white-space: nowrap;
    }

    .btn-back:hover {
        background: var(--soft);
        transform: translateY(-1px);
    }

    .btn-back:active {
        transform: scale(.98);
    }

    /* ===== Card ===== */
    .create-emp-card {
        background: var(--card);
        border: 1px solid var(--line);
        border-radius: 18px;
        box-shadow: var(--shadow);
        overflow: hidden;
    }

    .create-emp-card-header {
        padding: 12px 16px;
        border-bottom: 1px solid var(--line);
        background: #fbfdff;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        font-weight: 1000;
        color: var(--ink);
    }

    .hint {
        font-size: 12px;
        color: var(--muted);
        font-weight: 700;
    }

    .create-emp-card-body {
        padding: 16px;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr;
        gap: 12px;
        margin-bottom: 12px;
    }

    @media (min-width: 820px) {
        .form-row {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    .form-group {
        margin-bottom: 2px;
    }

    .form-label {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        color: #334155;
        font-weight: 900;
        margin-bottom: 6px;
    }

    .form-input {
        width: 100%;
        height: 44px;
        padding: 0 12px;
        border-radius: 12px;
        border: 1px solid #d1d5db;
        background: #fff;
        font-size: 14px;
        outline: none;
        transition: .15s ease;
    }

    .form-input:focus {
        border-color: rgba(37, 166, 213, .55);
        box-shadow: 0 0 0 4px rgba(37, 166, 213, .12);
    }

    .form-input[readonly] {
        background: #f8fafc;
        border-color: #e2e8f0;
        color: #0f172a;
        font-weight: 800;
    }

    .error-msg {
        margin-top: 6px;
        font-size: 12.5px;
        color: #b91c1c;
        font-weight: 900;
    }

    /* ===== Footer buttons ===== */
    .btn-submit-wrapper {
        display: flex;
        justify-content: flex-end;
        margin-top: 4px;
    }

    .btn-submit {
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

    .btn-submit:hover {
        filter: brightness(.98);
        transform: translateY(-1px);
    }

    .btn-submit:active {
        transform: scale(.98);
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

<div class="create-emp-wrapper">

    <div class="emp-hero">
        <div class="hero-left">
            <div class="hero-icon"><i class="bi bi-person-plus-fill"></i></div>
            <div>
                <div class="hero-title">เพิ่มพนักงาน</div>
                <div class="hero-sub">กรอกข้อมูลให้ครบถ้วนก่อนบันทึก</div>
            </div>
        </div>

        <a href="{{ route('admin_employees') }}" class="btn-back">
            <i class="bi bi-arrow-left"></i> ย้อนกลับ
        </a>
    </div>

    <div class="create-emp-card">
        <div class="create-emp-card-header">
            <span>รายละเอียดพนักงาน</span>
            <span class="hint">ช่องที่จำเป็น: กลุ่มงาน / เลขบัตร / ชื่อ / นามสกุล</span>
        </div>

        <div class="create-emp-card-body">

            <form id="create-emp-form" action="{{ route('admin_store_employees') }}" method="POST">
                @csrf

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label"><i class="bi bi-diagram-3"></i> กลุ่มงาน</label>
                        <input type="text" class="form-input" value="{{ $departmentName ?? '-' }}" readonly>
                        <input type="hidden" name="department_id" value="{{ $departmentId ?? '' }}">
                        @error('department_id') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label"><i class="bi bi-credit-card-2-front"></i> เลขบัตรประชาชน</label>
                        <input type="text" name="card_id" maxlength="13"
                            class="form-input" placeholder="13 หลัก"
                            value="{{ old('card_id') }}">
                        @error('card_id') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label"><i class="bi bi-person"></i> ชื่อ</label>
                        <input type="text" name="first_name" class="form-input"
                            placeholder="ชื่อ" value="{{ old('first_name') }}">
                        @error('first_name') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label"><i class="bi bi-person"></i> นามสกุล</label>
                        <input type="text" name="last_name" class="form-input"
                            placeholder="นามสกุล" value="{{ old('last_name') }}">
                        @error('last_name') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label"><i class="bi bi-telephone"></i> เบอร์โทร</label>
                        <input type="text" name="phone" class="form-input"
                            placeholder="เช่น 08xxxxxxxx" value="{{ old('phone') }}">
                        @error('phone') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label"><i class="bi bi-envelope"></i> อีเมล</label>
                        <input type="text" name="email" class="form-input"
                            placeholder="อีเมล" value="{{ old('email') }}">
                        @error('email') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label"><i class="bi bi-key"></i> รหัสผ่าน</label>
                        <input type="password" name="password" class="form-input"
                            placeholder="รหัสผ่าน">
                        @error('password') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label"><i class="bi bi-shield-lock"></i> ยืนยันรหัสผ่าน</label>
                        <input type="password" name="password_confirmation"
                            class="form-input" placeholder="ยืนยันรหัสผ่าน">
                    </div>
                </div>

                <div class="btn-submit-wrapper">
                    <button type="button" onclick="openConfirmPopup()" class="btn-submit">
                        <i class="bi bi-save2"></i> บันทึก
                    </button>
                </div>
            </form>

        </div>
    </div>

    {{-- Popup Confirm --}}
    <div id="confirmPopup" class="popup-overlay">
        <div class="popup-box">
            <div class="popup-top">
                <div class="popup-icon"><i class="bi bi-check2-circle"></i></div>
                <div>
                    <div class="popup-title">ยืนยันการบันทึกข้อมูล</div>
                    <div class="popup-text">ต้องการบันทึกข้อมูลพนักงานคนนี้ใช่หรือไม่?</div>
                </div>
            </div>

            <div class="popup-actions">
                <button class="btn-cancel" type="button" onclick="closeConfirmPopup()">ยกเลิก</button>
                <button class="btn-confirm" type="button" onclick="submitForm()">ตกลง</button>
            </div>
        </div>
    </div>

</div>

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

    // ปิด popup เมื่อคลิกพื้นหลัง
    document.getElementById('confirmPopup').addEventListener('click', function(e) {
        if (e.target === this) closeConfirmPopup();
    });
</script>

@endsection