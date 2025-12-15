@extends('user.layout')

@section('title', 'ประวัติการจอง | ศอ.บต.')

@section('content')

<style>
    .history-wrapper {
        max-width: 1000px;
        margin: 0 auto;
        padding: 0 1rem;
    }

    /* header */
    .history-header {
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

    .history-header-left {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .history-icon {
        width: 2rem;
        height: 2rem;
        border-radius: 0.375rem;
        background-color: #ffffff;
        border: 1px solid #d4d4d4;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .history-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: #1f2933;
    }

    /* search */
    .history-search {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        background: #f9fafb;
        border-radius: 999px;
        padding: 0.25rem 0.75rem;
        border: 1px solid #e5e7eb;
    }

    .history-search input {
        border: none;
        background: transparent;
        outline: none;
        font-size: 0.85rem;
        min-width: 220px;
    }

    /* table */
    .history-table-wrapper {
        background: #ffffff;
        border-radius: 0.5rem;
        border: 1px solid #e5e7eb;
        overflow: hidden;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03);
    }

    table.history-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.85rem;
    }

    .history-table thead {
        background: #f3f4f6;
    }

    .history-table th,
    .history-table td {
        padding: 0.65rem 0.9rem;
        border-bottom: 1px solid #e5e7eb;
        text-align: left;
        white-space: nowrap;
    }

    .history-table th {
        font-weight: 600;
        color: #374151;
        font-size: 1rem;
    }

    .history-table tbody tr:nth-child(even) {
        background-color: #fafafa;
    }

    .history-table tbody tr:hover {
        background-color: #fefce8;
    }

    .col-date {
        width: 15%;
    }

    .col-time {
        width: 20%;
    }

    .col-name {
        width: 25%;
    }

    .col-room {
        width: 20%;
    }

    .col-detail {
        width: 10%;
        text-align: center;
    }

    .btn-detail {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.3rem 0.9rem;
        border-radius: 999px;
        background-color: #F5D020;
        color: #ffffff;
        font-size: 0.8rem;
        font-weight: 600;
        text-decoration: none;
        border: none;
        cursor: pointer;
    }

    .btn-detail:hover {
        background-color: #f2c739;
    }

    .text-center {
        text-align: center;
    }
</style>

<div class="history-wrapper">

    {{-- header --}}
    <div class="history-header">
        <div class="history-header-left">
            <div class="history-icon">
                <i class="bi bi-clock-history"></i>
            </div>
            <div class="history-title">ประวัติการจอง</div>
        </div>

        {{-- ฟอร์มค้นหา --}}
        <form action="{{ route('user_history_booking') }}" method="GET" class="history-search">
            <i class="bi bi-search"></i>
            <input type="text"
                name="q"
                value="{{ $q ?? '' }}"
                placeholder="ค้นหาด้วยชื่อผู้จอง ">
        </form>
    </div>


    {{-- ตารางประวัติการจอง --}}
    <div class="history-table-wrapper">
        <table class="history-table">
            <thead>
                <tr>
                    <th class="col-date">วันที่ใช้ห้อง</th>
                    <th class="col-time">เวลา</th>
                    <th class="col-name">ชื่อ - นามสกุล</th>
                    <th class="col-room">ห้องประชุม</th>
                    <th class="col-detail">รายละเอียด</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bookings as $booking)
                <tr>
                    {{-- วันที่ใช้ห้อง --}}
                    <td>
                        @if($booking->start_time)
                        {{ $booking->start_time->format('d/m/Y') }}
                        @else
                        -
                        @endif
                    </td>

                    {{-- เวลา --}}
                    <td>
                        @if($booking->start_time && $booking->end_time)
                        {{ $booking->start_time->format('H.i') }}
                        - {{ $booking->end_time->format('H.i') }} น.
                        @else
                        -
                        @endif
                    </td>

                    {{-- ชื่อ - นามสกุล --}}
                    <td>{{ $booking->name }} {{ $booking->lastname }}</td>

                    {{-- ห้องประชุม --}}
                    <td>{{ optional($booking->room)->room_name ?? '-' }}</td>

                    {{-- ปุ่มรายละเอียด (ตอนนี้ยังให้ลิงก์เป็น # ไว้ก่อน) --}}
                    <td class="col-detail">
                        <a href="{{ route('user_history_detail', $booking->booking_id) }}"
                            class="btn-detail">
                            รายละเอียด
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">
                        ยังไม่มีข้อมูลการจอง
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection