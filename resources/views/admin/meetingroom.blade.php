@extends('admin.layout')

@section('title', 'ห้องประชุมทั้งหมด | ศอ.บต.')

@section('content')

{{-- ====== CSS สำหรับหน้านี้ ====== --}}
<style>
    .room-wrapper {
        max-width: 1000px;
        margin: 0 auto;
        padding: 0 1rem;
    }

    /* Flash message */
    .alert-success {
        margin-bottom: 1rem;
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        background-color: #dcfce7;
        /* green-100 */
        color: #166534;
        /* green-800 */
        font-size: 0.875rem;
    }

    /* แถบหัวข้อ + ปุ่มเพิ่มห้อง */
    .room-header {
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

    .room-header-left {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .room-header-icon {
        width: 2rem;
        height: 2rem;
        border-radius: 0.375rem;
        background-color: #ffffff;
        border: 1px solid #d4d4d4;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .room-header-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: #1f2933;
        /* เทาเข้ม */
    }

    .btn-add-room {
        display: inline-flex;
        align-items: center;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        background-color: #F5D020;
        color: #111827;
        font-size: 0.875rem;
        font-weight: 600;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
        text-decoration: none;
    }

    .btn-add-room:hover {
        background-color: #f2c739;
    }

    /* ถ้าไม่มีห้อง */
    .room-empty {
        background-color: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        padding: 2.5rem 1.5rem;
        text-align: center;
        color: #6b7280;
        font-size: 0.875rem;
    }

    .room-empty a {
        color: #0284c7;
        text-decoration: underline;
    }

    /* รายการการ์ดห้อง */
    .room-list {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 2rem;
    }

    .room-card {
        width: 300px;
        background-color: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        overflow: hidden;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    .room-card-image {
        width: 100%;
        height: 190px;
        background-color: #e5e7eb;
        overflow: hidden;
    }

    .room-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .room-card-image-placeholder {
        width: 100%;
        height: 100%;
        font-size: 0.875rem;
        color: #9ca3af;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .room-card-footer {
        padding: 0.5rem 0.75rem;
        background-color: #D6D6D6;
        border-top: 1px solid #d4d4d4;
    }

    .room-name {
        font-size: 1rem;
        font-weight: 500;
        color: #1f2933;
        margin-bottom: 0.35rem;
    }

    .room-actions {
        display: flex;
        justify-content: flex-end;
        gap: 0.5rem;
    }

    .btn-edit-room,
    .btn-delete-room {
        padding: 0.25rem 1rem;
        font-size: 0.75rem;
        font-weight: 500;
        border-radius: 0.25rem;
        border: 1px solid transparent;
        background-color: #ffffff;
        cursor: pointer;
        text-decoration: none;
    }

    .btn-edit-room {
        color: #ffffffff;
        background-color: #3b82f6;
    }

    .btn-edit-room:hover {
        background-color: #5c9bffff;
    }

    .btn-delete-room {
        color: #ffffffff;
        background-color: #dc2626;
    }

    .btn-delete-room:hover {
        background-color: #e05959ff;
    }

    /* ให้การ์ดเล็กลงในจอมือถือ */
    @media (max-width: 640px) {
        .room-card {
            width: 100%;
        }
    }

    /* ===== Popup ลบห้อง ===== */
    .popup-overlay-del {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.45);
        display: none;
        /* เริ่มต้นซ่อน */
        align-items: center;
        justify-content: center;
        z-index: 9999;
    }

    .popup-box-del {
        background: #ffffff;
        padding: 2.2rem 2.8rem;
        border-radius: 10px;
        text-align: center;
        min-width: 320px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.2);
        animation: popupShowDel 0.25s ease-out;
    }

    .popup-icon-circle-del {
        width: 70px;
        height: 70px;
        border-radius: 9999px;
        border: 3px solid #F87171;
        /* แดงอ่อน */
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.2rem auto;
    }

    .popup-icon-circle-del i {
        font-size: 2.2rem;
        color: #F87171;
    }

    .popup-text-del {
        font-size: 1rem;
        font-weight: 500;
        color: #111827;
        margin-bottom: 1.2rem;
    }

    .btn-cancel-del {
        padding: 0.5rem 1.4rem;
        background: #E5E7EB;
        border-radius: 8px;
        font-size: 0.9rem;
        cursor: pointer;
        border: none;
    }

    .btn-cancel-del:hover {
        background: #D1D5DB;
    }

    .btn-confirm-del {
        padding: 0.5rem 1.4rem;
        background: #F97373;
        color: #ffffff;
        border-radius: 8px;
        font-size: 0.9rem;
        cursor: pointer;
        border: none;
    }

    .btn-confirm-del:hover {
        background: #EF4444;
    }

    @keyframes popupShowDel {
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

{{-- ====== เนื้อหา ====== --}}
<div class="room-wrapper">

    {{-- Flash message --}}
    @if (session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
    @endif

    {{-- แถบหัวข้อ + ปุ่มเพิ่มห้อง --}}
    <div class="room-header">
        <div class="room-header-left">
            <div class="room-header-icon">
                <i class="bi bi-calendar2-event"></i>
            </div>
            <span class="room-header-title">ห้องประชุมทั้งหมด</span>
        </div>

        <a href="{{ route('admin_create_room') }}" class="btn-add-room">
            + เพิ่มห้อง
        </a>
    </div>

    {{-- ถ้าไม่มีห้อง --}}
    @if($rooms->isEmpty())
    <div class="room-empty">
        ยังไม่มีข้อมูลห้องประชุมในระบบ
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
                <img src="{{ asset('storage/'.$room->room_image) }}"
                    alt="{{ $room->room_name }}">
                @else
                <div class="room-card-image-placeholder">
                    ไม่มีรูปภาพ
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
                        แก้ไข
                    </a>

                    <form action="{{ route('admin_delete_room', $room->room_id) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        {{-- ปุ่มเปิด popup --}}
                        <button type="button"
                            class="btn-delete-room"
                            onclick="openDeletePopup(this, '{{ $room->room_name }}')">
                            ลบ
                        </button>
                    </form>

                </div>


            </div>

        </div>
        @endforeach
    </div>
    @endif
</div>

{{-- ===== Popup ยืนยันการลบห้อง ===== --}}
<div id="deletePopup" class="popup-overlay-del">
    <div class="popup-box-del">
        <div class="popup-icon-circle-del">
            <i class="bi bi-exclamation-lg"></i>
        </div>

        <div id="deletePopupText" class="popup-text-del">
            ต้องการลบห้องประชุมนี้หรือไม่?
        </div>

        <div style="display:flex; gap:1rem; justify-content:center;">
            <button type="button"
                class="btn-cancel-del"
                onclick="closeDeletePopup()">
                ยกเลิก
            </button>

            <button type="button"
                class="btn-confirm-del"
                onclick="confirmDelete()">
                ตกลง
            </button>
        </div>
    </div>
</div>

{{-- ===== JS ควบคุม popup ลบ ===== --}}
<script>
    let deleteFormTarget = null;

    function openDeletePopup(button, roomName) {
        deleteFormTarget = button.closest('form');

        // ใส่ชื่อห้องในข้อความ popup ให้ดูชัดเจน
        const textEl = document.getElementById('deletePopupText');
        textEl.textContent = `ต้องการลบ "${roomName}" หรือไม่?`;

        document.getElementById('deletePopup').style.display = 'flex';
    }

    function closeDeletePopup() {
        document.getElementById('deletePopup').style.display = 'none';
        deleteFormTarget = null;
    }

    function confirmDelete() {
        if (deleteFormTarget) {
            deleteFormTarget.submit();
        }
    }
</script>

@endsection