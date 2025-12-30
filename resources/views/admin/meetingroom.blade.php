@extends('admin.layout')

@section('title', 'ห้องประชุมทั้งหมด | ศอ.บต.')

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
        --danger: #ef4444;
    }

    .room-wrapper {
        max-width: 1120px;
        margin: 0 auto;
        padding: 0 1rem 1.5rem;
    }

    /* ===== Flash message ===== */
    .alert-success {
        margin-bottom: 12px;
        padding: 10px 12px;
        border-radius: 14px;
        background: linear-gradient(135deg, #dcfce7 0%, #f0fdf4 100%);
        color: #166534;
        border: 1px solid #bbf7d0;
        font-size: 0.9rem;
        font-weight: 800;
        box-shadow: 0 10px 24px rgba(15, 23, 42, .06);
    }

    /* ===== Hero Header ===== */
    .hero {
        background: linear-gradient(135deg, #ffffff 0%, #ffffff 60%, #fff7d6 100%);
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

    .btn-add-room {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 14px;
        border-radius: 14px;
        border: 1px solid rgba(0, 0, 0, .06);
        background: linear-gradient(135deg, var(--yellow) 0%, #F2C230 100%);
        color: #111827;
        font-weight: 1000;
        text-decoration: none;
        box-shadow: 0 10px 18px rgba(245, 208, 32, .25), 0 6px 12px rgba(15, 23, 42, .08);
        transition: .15s ease;
        white-space: nowrap;
    }

    .btn-add-room:hover {
        filter: brightness(.98);
        transform: translateY(-1px);
    }

    .btn-add-room:active {
        transform: scale(.98);
    }

    /* ===== Empty state ===== */
    .room-empty {
        background: #fff;
        border: 1px solid var(--line);
        border-radius: 18px;
        padding: 26px 16px;
        text-align: center;
        color: #6b7280;
        font-size: .95rem;
        box-shadow: var(--shadow);
    }

    .room-empty a {
        color: #0284c7;
        font-weight: 900;
        text-decoration: none;
        border-bottom: 1px dashed #93c5fd;
        padding-bottom: 2px;
    }

    .room-empty a:hover {
        color: #0369a1;
    }

    /* ===== Grid list ===== */
    .room-list {
        display: grid;
        grid-template-columns: repeat(1, minmax(0, 1fr));
        gap: 14px;
    }

    @media (min-width:640px) {
        .room-list {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (min-width:1024px) {
        .room-list {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }
    }

    /* ===== Room card ===== */
    .room-card {
        background: var(--card);
        border: 1px solid var(--line);
        border-radius: 18px;
        overflow: hidden;
        box-shadow: var(--shadow);
        transition: .18s ease;
        display: flex;
        flex-direction: column;
        min-width: 0;
    }

    .room-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 14px 40px rgba(15, 23, 42, .12);
    }

    .room-card-image {
        width: 100%;
        height: 200px;
        background: #e5e7eb;
        position: relative;
        overflow: hidden;
    }

    .room-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transform: scale(1.02);
        transition: .25s ease;
    }

    .room-card:hover .room-card-image img {
        transform: scale(1.06);
    }

    /* overlay gradient for nicer text contrast */
    .room-card-image::after {
        content: "";
        position: absolute;
        inset: 0;
        background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 35%, rgba(0, 0, 0, .28) 100%);
        pointer-events: none;
    }

    .room-card-image-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #94a3b8;
        font-weight: 900;
        font-size: .95rem;
        background: repeating-linear-gradient(45deg,
                #f1f5f9,
                #f1f5f9 10px,
                #e2e8f0 10px,
                #e2e8f0 20px);
        position: relative;
        z-index: 1;
    }

    /* ===== Footer content ===== */
    .room-card-footer {
        padding: 12px 12px 12px;
        background: #ffffff;
        border-top: 1px solid var(--line);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }

    .room-name {
        font-size: 15px;
        font-weight: 1000;
        color: var(--ink);
        line-height: 1.2;
        min-width: 0;
    }

    .room-name small {
        display: block;
        margin-top: 3px;
        color: var(--muted);
        font-weight: 800;
        font-size: 12px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 240px;
    }

    .room-actions {
        display: flex;
        align-items: center;
        gap: 8px;
        flex: 0 0 auto;
    }

    .btn-edit-room,
    .btn-delete-room {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 8px 10px;
        border-radius: 12px;
        font-size: 12.5px;
        font-weight: 1000;
        text-decoration: none;
        border: 1px solid transparent;
        cursor: pointer;
        line-height: 1.2;
        white-space: nowrap;
        transition: .15s ease;
    }

    .btn-edit-room {
        background: #f1f5f9;
        color: #0f172a;
        border: 1px solid #e2e8f0;
    }

    .btn-edit-room:hover {
        background: #eaf0f7;
        transform: translateY(-1px);
    }

    .btn-delete-room {
        background: #fee2e2;
        color: #7f1d1d;
        border: 1px solid #fecaca;
    }

    .btn-delete-room:hover {
        background: #fecaca;
        transform: translateY(-1px);
    }

    /* ===== Popup delete ===== */
    .popup-overlay-del {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, .55);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        backdrop-filter: blur(2px);
    }

    .popup-box-del {
        width: min(440px, 92vw);
        background: #fff;
        border-radius: 18px;
        border: 1px solid var(--line);
        box-shadow: 0 22px 60px rgba(0, 0, 0, .25);
        padding: 18px 18px 16px;
        animation: popupShowDel .18s ease-out;
        text-align: left;
    }

    @keyframes popupShowDel {
        from {
            transform: translateY(8px) scale(.98);
            opacity: 0;
        }

        to {
            transform: translateY(0) scale(1);
            opacity: 1;
        }
    }

    .popup-top-del {
        display: flex;
        gap: 12px;
        align-items: flex-start;
    }

    .popup-icon-circle-del {
        width: 46px;
        height: 46px;
        border-radius: 16px;
        background: rgba(239, 68, 68, .12);
        color: var(--danger);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        border: 1px solid rgba(239, 68, 68, .22);
        flex: 0 0 auto;
    }

    .popup-text-del {
        margin: 0;
        color: #0f172a;
        font-weight: 1000;
        font-size: 15px;
        line-height: 1.3;
    }

    .popup-sub-del {
        margin: 6px 0 0 0;
        color: #64748b;
        font-size: 13px;
        font-weight: 800;
        line-height: 1.4;
    }

    .popup-actions-del {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 14px;
    }

    .btn-cancel-del {
        padding: 10px 14px;
        border-radius: 14px;
        background: #f1f5f9;
        border: 1px solid #e2e8f0;
        font-weight: 1000;
        cursor: pointer;
    }

    .btn-cancel-del:hover {
        background: #eaf0f7;
    }

    .btn-confirm-del {
        padding: 10px 14px;
        border-radius: 14px;
        background: #ef4444;
        border: 1px solid #dc2626;
        color: #fff;
        font-weight: 1000;
        cursor: pointer;
    }

    .btn-confirm-del:hover {
        filter: brightness(.95);
    }
</style>

<div class="room-wrapper">

    {{-- Flash message --}}
    @if (session('success'))
    <div class="alert-success">
        <i class="bi bi-check-circle-fill" style="margin-right:6px;"></i>
        {{ session('success') }}
    </div>
    @endif

    {{-- Hero Header --}}
    <div class="hero">
        <div class="hero-left">
            <div class="hero-icon"><i class="bi bi-door-open"></i></div>
            <div>
                <div class="hero-title">ห้องประชุมทั้งหมด</div>
                <div class="hero-sub">จัดการข้อมูลห้องประชุม เพิ่ม/แก้ไข/ลบ และรูปภาพประกอบ</div>
            </div>
        </div>

        <a href="{{ route('admin_create_room') }}" class="btn-add-room">
            <i class="bi bi-plus-lg"></i> เพิ่มห้อง
        </a>
    </div>

    {{-- ถ้าไม่มีห้อง --}}
    @if($rooms->isEmpty())
    <div class="room-empty">
        ยังไม่มีข้อมูลห้องประชุมในระบบ —
        <a href="{{ route('admin_create_room') }}">เพิ่มห้องประชุม</a>
    </div>
    @else

    {{-- รายการห้องประชุม --}}
    <div class="room-list">
        @foreach($rooms as $room)
        <div class="room-card">

            {{-- รูปห้อง --}}
            <div class="room-card-image">
                @if($room->room_image)
                <img src="{{ asset('storage/'.$room->room_image) }}" alt="{{ $room->room_name }}">
                @else
                <div class="room-card-image-placeholder">
                    <i class="bi bi-image" style="font-size:22px; margin-right:8px;"></i> ไม่มีรูปภาพ
                </div>
                @endif
            </div>

            {{-- ชื่อห้อง + ปุ่ม --}}
            <div class="room-card-footer">
                <div class="room-name">
                    {{ $room->room_name }}
                </div>

                <div class="room-actions">
                    <a href="{{ route('admin_edit_room', $room->room_id) }}" class="btn-edit-room">
                        <i class="bi bi-pencil-square"></i> แก้ไข
                    </a>

                    <form class="delete-form"
                        action="{{ route('admin_delete_room', $room->room_id) }}"
                        method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')

                        <button type="button"
                            class="btn-delete-room"
                            onclick="openDeletePopup(this, '{{ $room->room_name }}')">
                            <i class="bi bi-trash3"></i> ลบ
                        </button>
                    </form>
                </div>
            </div>

        </div>
        @endforeach
    </div>

    @endif
</div>

{{-- Popup ยืนยันการลบห้อง --}}
<div id="deletePopup" class="popup-overlay-del">
    <div class="popup-box-del">
        <div class="popup-top-del">
            <div class="popup-icon-circle-del"><i class="bi bi-exclamation-triangle"></i></div>
            <div>
                <p id="deletePopupText" class="popup-text-del">ต้องการลบห้องประชุมนี้หรือไม่?</p>
                <p class="popup-sub-del">การลบจะไม่สามารถกู้คืนได้ โปรดตรวจสอบอีกครั้ง</p>
            </div>
        </div>

        <div class="popup-actions-del">
            <button type="button" class="btn-cancel-del" onclick="closeDeletePopup()">ยกเลิก</button>
            <button type="button" class="btn-confirm-del" onclick="confirmDelete()">ลบห้อง</button>
        </div>
    </div>
</div>

<script>
    let deleteFormTarget = null;

    function openDeletePopup(button, roomName) {
        deleteFormTarget = button.closest('form');
        document.getElementById('deletePopupText').textContent = `ต้องการลบ "${roomName}" หรือไม่?`;
        document.getElementById('deletePopup').style.display = 'flex';
    }

    function closeDeletePopup() {
        document.getElementById('deletePopup').style.display = 'none';
        deleteFormTarget = null;
    }

    function confirmDelete() {
        if (deleteFormTarget) deleteFormTarget.submit();
    }

    // ปิด popup เมื่อคลิกพื้นหลัง
    document.getElementById('deletePopup').addEventListener('click', function(e) {
        if (e.target === this) closeDeletePopup();
    });
</script>

@endsection