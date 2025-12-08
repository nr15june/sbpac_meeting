@extends('user.layout')

@section('title', 'เลือกห้องประชุม | ระบบจองห้อง ศอ.บต.')

@section('content')

<style>
    .room-wrapper {
        max-width: 1000px;
        margin: 0 auto;
        padding: 0 1rem;
    }

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
    }

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

    .room-card-footer {
        padding: 0.75rem;
        background-color: #D6D6D6;
        border-top: 1px solid #d4d4d4;
    }

    .room-name {
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 0.35rem;
        color: #1f2933;
    }

    .room-actions {
        display: flex;
        justify-content: flex-end;
        /* ปุ่มไปด้านขวา */
        margin-top: 0.3rem;
    }

    /* ปุ่มสีเหลือง */
    .btn-book-room {
        padding: 0.45rem 1.2rem;
        background-color: #FACC15;
        /* เหลืองทองสวย */
        color: #ffffff;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        text-decoration: none;
        transition: 0.2s ease;
    }

    .btn-book-room:hover {
        background-color: #EAB308;
        /* เหลืองเข้ม */
    }
</style>

<div class="room-wrapper">

    {{-- Header --}}
    <div class="room-header">
        <div class="room-header-left">
            <div class="room-header-icon">
                <i class="bi bi-door-open"></i>
            </div>
            <span class="room-header-title">เลือกห้องประชุม</span>
        </div>
    </div>

    {{-- รายการห้อง --}}
    <div class="room-list">
        @foreach ($rooms as $room)
        <div class="room-card">

            <div class="room-card-image">
                @if($room->room_image)
                <img src="{{ asset('storage/' . $room->room_image) }}" alt="{{ $room->room_name }}">
                @else
                <div class="room-card-image-placeholder">
                    ไม่มีรูปภาพ
                </div>
                @endif
            </div>

            <div class="room-card-footer">
                <div class="room-name">{{ $room->room_name }}</div>

                <div class="room-actions">
                    <a href="{{ route('create_booking', ['room_id' => $room->room_id]) }}"
                        class="btn-book-room">
                        จองห้องนี้
                    </a>
                </div>
            </div>


        </div>
        @endforeach
    </div>

</div>

@endsection