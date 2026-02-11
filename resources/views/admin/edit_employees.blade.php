@extends('admin.layout')

@section('title', 'แก้ไขข้อมูลพนักงาน | ศอ.บต.')

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
        --yellow: #F5D020;
        --ok: #22c55e;
    }

    .wrap {
        max-width: 1120px;
        margin: 0 auto;
        padding: 0 1rem 1.5rem;
    }

    /* ===== Hero ===== */
    .hero {
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
        font-weight: 1000;
        color: var(--ink);
        letter-spacing: .2px;
    }

    .hero-sub {
        margin: 3px 0 0 0;
        font-size: 12.5px;
        color: var(--muted);
        line-height: 1.3;
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
    .card {
        background: var(--card);
        border: 1px solid var(--line);
        border-radius: 18px;
        box-shadow: var(--shadow);
        overflow: hidden;
    }

    .card-hd {
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

    .card-bd {
        padding: 16px;
    }

    .hint {
        font-size: 12px;
        color: var(--muted);
        font-weight: 700;
        white-space: nowrap;
    }

    /* ===== Info note ===== */
    .note {
        background: #f8fafc;
        border: 1px dashed #cbd5e1;
        color: #334155;
        padding: 10px 12px;
        border-radius: 14px;
        display: flex;
        gap: 10px;
        align-items: flex-start;
        margin-bottom: 12px;
    }

    .note i {
        color: #0ea5e9;
        margin-top: 2px;
    }

    .note b {
        font-weight: 1000;
    }

    .note small {
        color: var(--muted);
        display: block;
        margin-top: 2px;
    }

    /* ===== Form ===== */
    .form-row {
        display: grid;
        grid-template-columns: 1fr;
        gap: 12px;
        margin-bottom: 12px;
    }

    @media (min-width:820px) {
        .form-row {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    .form-row>div {
        min-width: 0;
    }

    /* กัน input ล้น */

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

    /* ===== Password input with eye ===== */
    .input-wrap {
        position: relative;
    }

    .input-wrap .form-input {
        padding-right: 46px;
    }

    .toggle-eye {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        width: 34px;
        height: 34px;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: #64748b;
    }

    .toggle-eye:hover {
        background: #f8fafc;
    }

    /* ===== Card footer (Save button area) ===== */
    .card-ft {
        padding: 12px 16px;
        border-top: 1px solid var(--line);
        background: #ffffff;
        display: flex;
        justify-content: flex-end;
    }

    .btn-save {
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

    .btn-save:hover {
        filter: brightness(.98);
        transform: translateY(-1px);
    }

    .btn-save:active {
        transform: scale(.98);
    }

    /* ===== Popup ===== */
    .popup-overlay {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, .55);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        backdrop-filter: blur(2px);
    }

    .popup-box {
        width: min(440px, 92vw);
        background: #fff;
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

<div class="wrap">

    {{-- Hero --}}
    <div class="hero">
        <div class="hero-left">
            <div class="hero-icon"><i class="bi bi-person-gear"></i></div>
            <div>
                <div class="hero-title">แก้ไขข้อมูลพนักงาน</div>
                <div class="hero-sub">
                    แก้ไขข้อมูลของ <b>{{ $employee->first_name }} {{ $employee->last_name }}</b>
                    <span style="color:#94a3b8;">(เลขบัตร: {{ $employee->card_id }})</span>
                </div>
            </div>
        </div>

        <a href="{{ route('admin_employees') }}" class="btn-back">
            <i class="bi bi-arrow-left"></i> ย้อนกลับ
        </a>
    </div>

    {{-- Card --}}
    <div class="card">
        <div class="card-hd">
            <span>รายละเอียดพนักงาน</span>
            <span class="hint">แก้ไขแล้วกด “บันทึก” เพื่ออัปเดตข้อมูล</span>
        </div>

        <div class="card-bd">

            <div class="note">
                <i class="bi bi-info-circle-fill"></i>
                <div>
                    <b>รหัสผ่านใหม่</b> กรอกเฉพาะตอนต้องการเปลี่ยนเท่านั้น
                    <small>ถ้าเว้นว่าง ระบบจะไม่เปลี่ยนรหัสผ่านเดิม</small>
                </div>
            </div>

            <form id="edit-emp-form" action="{{ route('admin_update.employees', $employee->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-row">
                    <div>
                        <label class="form-label">
                            <i class="bi bi-diagram-3"></i> กลุ่มงาน
                        </label>
                        <select name="department_id" class="form-input">
                            @foreach ($departments as $dept)
                            <option value="{{ $dept->id }}"
                                {{ old('department_id', $employee->department_id) == $dept->id ? 'selected' : '' }}>
                                {{ $dept->name }}
                            </option>
                            @endforeach
                        </select>

                        @error('department_id')
                        <div class="error-msg">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label class="form-label"><i class="bi bi-credit-card-2-front"></i> เลขบัตรประชาชน</label>
                        <input type="text" name="card_id" maxlength="13"
                            class="form-input" placeholder="13 หลัก"
                            value="{{ old('card_id', $employee->card_id) }}">
                        @error('card_id') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div>
                        <label class="form-label"><i class="bi bi-person"></i> ชื่อ</label>
                        <input type="text" name="first_name"
                            class="form-input" placeholder="ชื่อ"
                            value="{{ old('first_name', $employee->first_name) }}">
                        @error('first_name') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <label class="form-label"><i class="bi bi-person"></i> นามสกุล</label>
                        <input type="text" name="last_name"
                            class="form-input" placeholder="นามสกุล"
                            value="{{ old('last_name', $employee->last_name) }}">
                        @error('last_name') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div>
                        <label class="form-label"><i class="bi bi-telephone"></i> เบอร์โทร</label>
                        <input type="text" name="phone"
                            class="form-input" placeholder="เช่น 08xxxxxxxx"
                            value="{{ old('phone', $employee->phone) }}">
                        @error('phone') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <label class="form-label"><i class="bi bi-envelope"></i> อีเมล</label>
                        <input type="text" name="email"
                            class="form-input" placeholder="อีเมล"
                            value="{{ old('email', $employee->email) }}">
                        @error('email') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label"><i class="bi bi-key"></i> รหัสผ่านใหม่</label>
                        <div class="input-wrap">
                            <input id="pw" type="password" name="password"
                                class="form-input" placeholder="เว้นว่างถ้าไม่เปลี่ยน">
                            <button type="button" class="toggle-eye" onclick="togglePw('pw', this)">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        @error('password') <div class="error-msg">{{ $message }}</div> @enderror
                    </div>

                    <div>
                        <label class="form-label"><i class="bi bi-shield-lock"></i> ยืนยันรหัสผ่านใหม่</label>
                        <div class="input-wrap">
                            <input id="pw2" type="password" name="password_confirmation"
                                class="form-input" placeholder="ยืนยันรหัสผ่านใหม่">
                            <button type="button" class="toggle-eye" onclick="togglePw('pw2', this)">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>

            </form>
        </div>

        {{-- footer ปุ่มบันทึก --}}
        <div class="card-ft">
            <button type="button" class="btn-save" onclick="openConfirmPopup()">
                <i class="bi bi-save2"></i> บันทึก
            </button>
        </div>
    </div>

</div>

{{-- Popup Confirm --}}
<div id="confirmPopup" class="popup-overlay">
    <div class="popup-box">
        <div class="popup-top">
            <div class="popup-icon"><i class="bi bi-check2-circle"></i></div>
            <div>
                <div class="popup-title">ยืนยันการบันทึก</div>
                <div class="popup-text">ต้องการบันทึกการแก้ไขข้อมูลพนักงานหรือไม่?</div>
            </div>
        </div>

        <div class="popup-actions">
            <button class="btn-cancel" type="button" onclick="closeConfirmPopup()">ยกเลิก</button>
            <button class="btn-confirm" type="button" onclick="submitForm()">ตกลง</button>
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
        document.getElementById('edit-emp-form').submit();
    }
    document.getElementById('confirmPopup').addEventListener('click', function(e) {
        if (e.target === this) closeConfirmPopup();
    });

    function togglePw(id, btn) {
        const el = document.getElementById(id);
        const icon = btn.querySelector('i');
        if (el.type === 'password') {
            el.type = 'text';
            icon.className = 'bi bi-eye-slash';
        } else {
            el.type = 'password';
            icon.className = 'bi bi-eye';
        }
    }
</script>

@endsection