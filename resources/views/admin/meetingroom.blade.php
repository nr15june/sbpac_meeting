@extends('admin.layout')

@section('title', 'ห้องประชุมทั้งหมด | ศอ.บต.')

@section('content')

{{-- ====== CSS สำหรับหน้านี้ ====== --}}
<style>
    .room-wrapper {
        max-width: 1200px;
        margin: 0 auto;
        margin-left: 3rem;
        margin-right: 3rem;
    }

    /* Flash message */
    .alert-success {
        margin-bottom: 1rem;
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        background-color: #dcfce7; /* green-100 */
        color: #166534;            /* green-800 */
        font-size: 0.875rem;
    }

    /* แถบหัวข้อ + ปุ่มเพิ่มห้อง */
    .room-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.5rem;
        padding: 0.5rem 1rem;
        background-color: #ffffff;
        border: 1px solid #d4d4d4;
        border-radius: 0.375rem;
        box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        margin: 1rem 0;

    }

    .room-header-left {
        display: flex;
        align-items: center;
        gap: 0.5rem;
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
        font-size: 1rem;
        font-weight: 600;
        color: #1f2933; /* เทาเข้ม */
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
        box-shadow: 0 1px 2px rgba(0,0,0,0.05);
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
        display: flex;
        flex-wrap: wrap;
        gap: 1.5rem;
    }

    .room-card {
        width: 260px;
        background-color: #ffffff;
        border: 1px solid #e5e7eb;
        border-radius: 0.5rem;
        overflow: hidden;
        box-shadow: 0 1px 2px rgba(0,0,0,0.05);
    }

    .room-card-image {
        width: 100%;
        height: 160px;
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
        font-size: 0.9rem;
        font-weight: 600;
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
        border-color: #F8CB00;
        color: #eab308;
    }

    .btn-edit-room:hover {
        background-color: #FFF3BE;
    }

    .btn-delete-room {
        border-color: #FCA5A5;
        color: #ef4444;
    }

    .btn-delete-room:hover {
        background-color: #fee2e2;
    }

    /* ให้การ์ดเล็กลงในจอมือถือ */
    @media (max-width: 640px) {
        .room-card {
            width: 100%;
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
                            <a href="#"
                               class="btn-edit-room">
                                แก้ไข
                            </a>

                            <button type="button"
                                    onclick="alert('ตัวอย่างปุ่มลบ – ยังไม่ได้เชื่อมกับระบบลบจริง');"
                                    class="btn-delete-room">
                                ลบ
                            </button>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    @endif
</div>

@endsection
