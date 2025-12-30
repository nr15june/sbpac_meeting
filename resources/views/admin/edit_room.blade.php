@extends('admin.layout')

@section('title', 'แก้ไขห้องประชุม | ศอ.บต.')

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
        min-width: 0;
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
        line-height: 1.1;
        letter-spacing: .2px;
    }

    .hero-sub {
        margin: 4px 0 0 0;
        font-size: 12.5px;
        color: var(--muted);
        line-height: 1.35;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 720px;
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
        flex-wrap: wrap;
    }

    .hint {
        font-size: 12px;
        color: var(--muted);
        font-weight: 900;
    }

    .card-bd {
        padding: 16px;
    }

    /* ===== Layout grid ===== */
    .grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 12px;
        align-items: stretch;
        /* ✅ ให้ 2 คอลัมน์สูงเท่ากัน */
    }

    @media (min-width: 860px) {
        .grid {
            grid-template-columns: 1.2fr .8fr;
        }
    }

    /* ===== Form ===== */
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

    /* ===== Note ===== */
    .note {
        background: #f8fafc;
        border: 1px dashed #cbd5e1;
        border-radius: 14px;
        padding: 10px 12px;
        display: flex;
        gap: 10px;
        align-items: flex-start;
        color: #334155;
    }

    .note i {
        color: #0ea5e9;
        margin-top: 2px;
    }

    .note b {
        font-weight: 1000;
    }

    .note small {
        display: block;
        color: var(--muted);
        margin-top: 2px;
        font-weight: 800;
    }

    /* ===== Right column ===== */
    .right-col {
        display: flex;
        flex-direction: column;
        gap: 12px;
        min-width: 0;
        height: 100%;
        /* ✅ สำคัญ: ให้สูงเต็มคอลัมน์ */
    }

    /* ===== Preview ===== */
    .preview {
        border: 1px dashed #cbd5e1;
        border-radius: 18px;
        background: #f8fafc;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        min-height: 260px;
        flex: 1;
        /* ✅ กินพื้นที่ที่เหลือ แล้วดันปุ่มลงล่าง */
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
        min-width: 0;
    }

    .preview-hd small {
        color: var(--muted);
        font-weight: 900;
        max-width: 220px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        display: inline-block;
        text-align: right;
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
        height: 260px;
        border-radius: 14px;
        object-fit: cover;
        display: block;
    }

    .preview-empty {
        color: #94a3b8;
        font-weight: 900;
        text-align: center;
        padding: 18px;
    }

    /* ✅ ปุ่มใต้รูป ชิดขวา และอยู่ล่างสุด */
    .right-actions {
        display: flex;
        justify-content: flex-end;
        width: 100%;
        margin-top: auto;
        /* ✅ ดันลงล่างสุด */
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

@php
// ✅ ดึงชื่อไฟล์จากทั้ง path และ url ที่ยาวๆ (มี query string) ให้เหลือแค่ชื่อรูป
$raw = $room->room_image ?? '';
$pathOnly = $raw ? parse_url($raw, PHP_URL_PATH) : null;
$fileName = $pathOnly ? basename($pathOnly) : 'ยังไม่มีรูป';
@endphp

<div class="wrap">

    {{-- HERO --}}
    <div class="hero">
        <div class="hero-left">
            <div class="hero-icon"><i class="bi bi-pencil-square"></i></div>
            <div style="min-width:0;">
                <div class="hero-title">แก้ไขห้องประชุม</div>
                <div class="hero-sub">
                    กำลังแก้ไข <b>{{ $room->room_name }}</b>
                    <span style="color:#94a3b8;">(รหัสห้อง: {{ $room->room_id }})</span>
                </div>
            </div>
        </div>

        <a href="{{ route('admin_meetingrooms') }}" class="btn-back">
            <i class="bi bi-arrow-left"></i> ย้อนกลับ
        </a>
    </div>

    {{-- CARD --}}
    <div class="card">
        <div class="card-hd">
            <span>รายละเอียดห้องประชุม</span>
            <span class="hint">ถ้าไม่เลือกรูปใหม่ ระบบจะใช้รูปเดิม</span>
        </div>

        <div class="card-bd">
            <div class="grid">

                {{-- LEFT: FORM --}}
                <form id="edit-room-form"
                    action="{{ route('rooms.update', $room->room_id) }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="form">
                    @csrf
                    @method('PUT')

                    <div class="note">
                        <i class="bi bi-info-circle-fill"></i>
                        <div>
                            <b>คำแนะนำ</b> กรอกข้อมูลให้ครบเพื่อให้ค้นหา/แสดงผลได้ดี
                            <small>อัปโหลดรูปใหม่ได้ตลอด (ถ้าไม่อัปโหลด จะใช้รูปเดิม)</small>
                        </div>
                    </div>

                    <div>
                        <label class="label"><i class="bi bi-door-open"></i> ชื่อห้องประชุม</label>
                        <input type="text" name="room_name" class="input"
                            value="{{ old('room_name', $room->room_name) }}"
                            placeholder="ระบุชื่อห้องประชุม">
                    </div>

                    <div class="row-2">
                        <div>
                            <label class="label"><i class="bi bi-building"></i> อาคาร</label>
                            <input type="text" name="building" class="input"
                                value="{{ old('building', $room->building) }}"
                                placeholder="อาคาร / ชั้น">
                        </div>

                        <div>
                            <label class="label"><i class="bi bi-people"></i> จำนวนคน/ห้อง</label>
                            <input type="number" name="quantity" min="1" class="input"
                                value="{{ old('quantity', $room->quantity) }}"
                                placeholder="เช่น 10">
                        </div>
                    </div>

                    <div>
                        <label class="label"><i class="bi bi-card-text"></i> รายละเอียด</label>
                        <textarea name="description" class="textarea"
                            placeholder="เช่น มีโปรเจคเตอร์ ไมโครโฟน ไวท์บอร์ด ฯลฯ">{{ old('description', $room->description) }}</textarea>
                    </div>

                    <div>
                        <label class="label"><i class="bi bi-image"></i> รูปภาพ (เลือกใหม่ถ้าต้องการเปลี่ยน)</label>
                        <input id="roomImageInput" type="file" name="room_image" class="file" accept="image/*">
                    </div>
                </form>

                {{-- RIGHT: PREVIEW + BUTTON (ล่างสุด) --}}
                <div class="right-col">
                    <div class="preview">
                        <div class="preview-hd">
                            <span><i class="bi bi-eye"></i> ตัวอย่างรูปภาพ</span>
                            <small id="previewName" title="{{ $fileName }}">{{ $fileName }}</small>
                        </div>

                        <div class="preview-body">
                            @if($room->room_image)
                            <img id="previewImg"
                                class="preview-img"
                                src="{{ asset('storage/'.$room->room_image) }}"
                                alt="{{ $room->room_name }}">
                            @else
                            <div id="previewEmpty" class="preview-empty">
                                <i class="bi bi-image" style="font-size:24px;display:block;margin-bottom:8px;"></i>
                                ยังไม่มีรูปเดิม — เลือกไฟล์เพื่อดูตัวอย่าง
                            </div>
                            <img id="previewImg" class="preview-img" alt="preview" style="display:none;">
                            @endif
                        </div>
                    </div>

                    {{-- ✅ ปุ่มอยู่มุมล่างขวาใต้รูป และ “ล่างสุดของคอลัมน์ขวา” --}}
                    <div class="right-actions">
                        <button type="button" class="btn-save" onclick="openConfirmPopup()">
                            <i class="bi bi-save2"></i> บันทึกการแก้ไข
                        </button>
                    </div>
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
                <div class="popup-text">ต้องการบันทึกการแก้ไขข้อมูลห้องประชุมหรือไม่?</div>
            </div>
        </div>

        <div class="popup-actions">
            <button class="btn-cancel" type="button" onclick="closeConfirmPopup()">ยกเลิก</button>
            <button class="btn-confirm" type="button" onclick="submitEditForm()">ตกลง</button>
        </div>
    </div>
</div>

<script>
    // ===== Preview image (เลือกไฟล์ใหม่แล้วโชว์ทันที) =====
    const input = document.getElementById('roomImageInput');
    const img = document.getElementById('previewImg');
    const nameEl = document.getElementById('previewName');
    const empty = document.getElementById('previewEmpty');

    if (input) {
        input.addEventListener('change', function() {
            const file = this.files && this.files[0];
            if (!file) return;

            // ✅ แสดงชื่อไฟล์ (ไม่ใช่ url) + tooltip ชื่อเต็ม
            nameEl.textContent = file.name;
            nameEl.title = file.name;

            const url = URL.createObjectURL(file);
            img.src = url;
            img.style.display = 'block';
            if (empty) empty.style.display = 'none';
        });
    }

    // ===== Popup =====
    function openConfirmPopup() {
        document.getElementById('confirmPopup').style.display = 'flex';
    }

    function closeConfirmPopup() {
        document.getElementById('confirmPopup').style.display = 'none';
    }

    function submitEditForm() {
        document.getElementById('edit-room-form').submit();
    }
    document.getElementById('confirmPopup').addEventListener('click', function(e) {
        if (e.target === this) closeConfirmPopup();
    });
</script>

@endsection