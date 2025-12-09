@extends('user.layout')

@section('title', 'รายละเอียดประวัติการจอง | ศอ.บต.')

@section('content')

<style>
    .detail-wrapper {
        max-width: 1000px;
        margin: 0 auto;
        padding: 0 1rem;
    }

    /* header */
    .detail-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
        padding: 1rem 1.5rem;
        background-color: #ffffff;
        border: 1px solid #ebeaea;
        border-radius: 0.450rem;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    .detail-icon {
        width: 2rem;
        height: 2rem;
        border-radius: 0.375rem;
        background-color: #ffffff;
        border: 1px solid #d4d4d4;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .detail-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: #1f2933;
    }

    /* กล่องข้อมูล */
    .detail-box {
        background: #ECECEC;
        /* เทาอ่อน */
        border-radius: 12px;
        padding: 2rem;
    }

    /* ตารางรายละเอียด */
    /* ตารางรายละเอียด */
    .detail-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.95rem;
    }

    .detail-table td {
        padding: 0.75rem 0.25rem;
        /* ← ระยะห่างแต่ละบรรทัด */
    }

    .label-cell {
        width: 25%;
        font-weight: 600;
        color: #374151;
        vertical-align: top;
    }

    .value-cell {
        color: #111827;
    }
</style>

<div class="detail-wrapper">

    {{-- header --}}
    <div class="detail-header">
        <div class="detail-icon">
            <i class="bi bi-clock-history"></i>
        </div>
        <div class="detail-title">รายละเอียดประวัติการจอง</div>
    </div>

    {{-- กล่องรายละเอียด --}}
    <div class="detail-box">

        <table class="detail-table">
            <tr>
                <td class="label-cell">ชื่อ - สกุล :</td>
                <td class="value-cell">{{ $booking->name }} {{ $booking->lastname }}</td>
            </tr>

            <tr>
                <td class="label-cell">เบอร์โทรศัพท์ :</td>
                <td class="value-cell">{{ $booking->phone }}</td>
            </tr>

            <tr>
                <td class="label-cell">อีเมล :</td>
                <td class="value-cell">{{ $booking->email }}</td>
            </tr>

            <tr>
                <td class="label-cell">วันที่ใช้ห้อง :</td>
                <td class="value-cell">
                    {{ $booking->start_time ? $booking->start_time->format('d/m/Y') : '-' }}
                </td>
            </tr>

            <tr>
                <td class="label-cell">เวลา :</td>
                <td class="value-cell">
                    {{ $booking->start_time->format('H.i') }} - {{ $booking->end_time->format('H.i') }} น.
                </td>
            </tr>

            <tr>
                <td class="label-cell">ห้องที่ใช้ :</td>
                <td class="value-cell">{{ optional($booking->room)->room_name ?? '-' }}</td>
            </tr>

            <tr>
                <td class="label-cell">หัวข้อการประชุม :</td>
                <td class="value-cell">{{ $booking->meeting_topic }}</td>
            </tr>

            <tr>
                <td class="label-cell">กลุ่มงาน / ส่วนงาน :</td>
                <td class="value-cell">{{ $booking->department }}</td>
            </tr>
        </table>

    </div>

</div>

@endsection