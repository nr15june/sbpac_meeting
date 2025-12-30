@extends('admin.layout')

@section('title', 'เพิ่มห้องประชุม | ศอ.บต.')

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
        border: 1px solid rgba(37, 166, 213, .18);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        flex: 0 0 auto;
    }

    .hero-title {
        margin: 0;
        font-size: 18px;
        font-weight: 1000;
        color: var(--ink);
        letter-spacing: .2px;
        line-height: 1.1;
    }

    .hero-sub {
        margin: 4px 0 0 0;
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
        color: var(--ink);
        font-weight: 1000;
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
        font-weight: 1000;
        color: var(--ink);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }

    .card-bd {
        padding: 16px;
    }

    /* ===== Form Layout ===== */
    .grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 12px;
        align-items: start;
    }

    @media (min-width: 860px) {
        .grid {
            grid-template-columns: 1.2fr .8fr;
        }
    }

    .form {
        display: grid;
        grid-template-columns: 1fr;
        gap: 12px;
    }

    .row-2 {
        display: grid;
        grid-template-columns: 1fr;
        gap: 12px;
    }

    @media (min-width: 820px) {
        .row-2 {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    .label {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        color: #334155;
        font-weight: 900;
        margin-bottom: 6px;
    }

    .input,
    .textarea,
    .file {
        width: 100%;
        border-radius: 12px;
        border: 1px solid #d1d5db;
        background: #fff;
        font-size: 14px;
        outline: none;
        transition: .15s ease;
    }

    .input {
        height: 44px;
        padding: 0 12px;
    }

    .textarea {
        min-height: 120px;
        padding: 10px 12px;
        resize: vertical;
    }

    .file {
        height: 44px;
        padding: 8px 12px;
    }

    .input:focus,
    .textarea:focus,
    .file:focus {
        border-color: rgba(37, 166, 213, .55);
        box-shadow: 0 0 0 4px rgba(37, 166, 213, .12);
    }

    /* ===== Preview ===== */
    .preview {
        border: 1px dashed #cbd5e1;
        border-radius: 18px;
        background: #f8fafc;
        overflow: hidden;
        min-height: 260px;
        display: flex;
        flex-direction: column;
    }

    .preview-hd {
        padding: 12px 14px;
        border-bottom: 1px dashed #cbd5e1;
        font-weight: 1000;
        color: var(--ink);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }

    .preview-hd small {
        color: var(--muted);
        font-weight: 800;
    }

    .preview-body {
        padding: 12px;
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .preview-img {
        width: 100%;
        height: 230px;
        border-radius: 14px;
        object-fit: cover;
        display: none;
    }

    .preview-empty {
        color: #94a3b8;
        font-weight: 900;
        text-align: center;
        padding: 18px;
    }

    /* ===== Footer actions (ชิดขวาสุดของทั้ง card) ===== */
    .grid-footer {
        grid-column: 1 / -1;
        /* span ทั้ง 2 คอลัมน์ */
        display: flex;
        justify-content: flex-end;
        /* ชิดขวาสุด */
        gap: 10px;
        padding-top: 6px;
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
        transform: translateY(-1px);
        filter: brightness(.98);
    }

    .btn-save:active {
        transform: scale(.98);
    }

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

    <div class="hero">
        <div class="hero-left">
            <div class="hero-icon"><i class="bi bi-calendar2-plus"></i></div>
            <div>
                <div class="hero-title">เพิ่มห้องประชุม</div>
                <div class="hero-sub">กรอกข้อมูลห้องประชุมและอัปโหลดรูปภาพประกอบ</div>
            </div>
        </div>

        <a href="{{ route('admin_meetingrooms') }}" class="btn-back">
            <i class="bi bi-arrow-left"></i> ย้อนกลับ
        </a>
    </div>

    <div class="card">
        <div class="card-hd">
            <span>รายละเอียดห้องประชุม</span>
            <span style="font-size:12px;color:var(--muted);font-weight:900;">(*) แนะนำกรอกให้ครบเพื่อค้นหา/แสดงผลได้ดี</span>
        </div>

        <div class="card-bd">
            <div class="grid">

                {{-- FORM --}}
                <form id="create-room-form"
                    action="{{ route('rooms.store') }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="form">
                    @csrf

                    <div>
                        <label class="label"><i class="bi bi-door-open"></i> ชื่อห้องประชุม</label>
                        <input type="text" name="room_name" class="input" placeholder="ระบุชื่อห้องประชุม" value="{{ old('room_name') }}">
                    </div>

                    <div class="row-2">
                        <div>
                            <label class="label"><i class="bi bi-building"></i> อาคาร</label>
                            <input type="text" name="building" class="input" placeholder="อาคาร / ชั้น" value="{{ old('building') }}">
                        </div>

                        <div>
                            <label class="label"><i class="bi bi-people"></i> จำนวนคน/ห้อง</label>
                            <input type="number" name="quantity" min="1" class="input" placeholder="เช่น 10" value="{{ old('quantity') }}">
                        </div>
                    </div>

                    <div>
                        <label class="label"><i class="bi bi-card-text"></i> รายละเอียด</label>
                        <textarea name="description" class="textarea" placeholder="เช่น มีโปรเจคเตอร์ ไมโครโฟน ไวท์บอร์ด ฯลฯ">{{ old('description') }}</textarea>
                    </div>

                    <div>
                        <label class="label"><i class="bi bi-image"></i> รูปภาพ</label>
                        <input id="roomImageInput" type="file" name="room_image" class="file" accept="image/*">
                    </div>
                </form>

                {{-- PREVIEW --}}
                <div class="preview">
                    <div class="preview-hd">
                        <span><i class="bi bi-eye"></i> ตัวอย่างรูปภาพ</span>
                        <small id="previewName">ยังไม่ได้เลือกรูป</small>
                    </div>
                    <div class="preview-body">
                        <img id="previewImg" class="preview-img" alt="preview">
                        <div id="previewEmpty" class="preview-empty">
                            <i class="bi bi-image" style="font-size:24px;display:block;margin-bottom:8px;"></i>
                            เลือกไฟล์รูปภาพเพื่อดูตัวอย่าง
                        </div>
                    </div>
                </div>

                {{-- ✅ FOOTER ปุ่มชิดขวาสุดของทั้ง card --}}
                <div class="grid-footer">
                    <button type="button" class="btn-save" onclick="openConfirmPopup()">
                        <i class="bi bi-save2"></i> บันทึก
                    </button>
                </div>

            </div>
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
                <div class="popup-text">ต้องการบันทึกข้อมูลห้องประชุมหรือไม่?</div>
            </div>
        </div>

        <div class="popup-actions">
            <button class="btn-cancel" type="button" onclick="closeConfirmPopup()">ยกเลิก</button>
            <button class="btn-confirm" type="button" onclick="submitForm()">ตกลง</button>
        </div>
    </div>
</div>

<script>
    // Preview image
    const input = document.getElementById('roomImageInput');
    const img = document.getElementById('previewImg');
    const empty = document.getElementById('previewEmpty');
    const nameEl = document.getElementById('previewName');

    if (input) {
        input.addEventListener('change', function() {
            const file = this.files && this.files[0];
            if (!file) {
                img.style.display = 'none';
                empty.style.display = 'block';
                nameEl.textContent = 'ยังไม่ได้เลือกรูป';
                return;
            }

            nameEl.textContent = file.name;

            const url = URL.createObjectURL(file);
            img.src = url;
            img.style.display = 'block';
            empty.style.display = 'none';
        });
    }

    // Popup
    function openConfirmPopup() {
        document.getElementById('confirmPopup').style.display = 'flex';
    }

    function closeConfirmPopup() {
        document.getElementById('confirmPopup').style.display = 'none';
    }

    function submitForm() {
        document.getElementById('create-room-form').submit();
    }

    // click outside close
    document.getElementById('confirmPopup').addEventListener('click', function(e) {
        if (e.target === this) closeConfirmPopup();
    });
</script>

@endsection