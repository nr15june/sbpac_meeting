@extends('admin.layout')

@section('title', 'รายการจองประจำวัน | ศอ.บต.')

@section('content')
<style>
    .day-wrapper {
        width: 100%;
        max-width: 100%;
        margin: 0;
        padding: 0 1rem;
    }

    .day-card {
        background: #fafafa;
        border: 1px solid #d1d5db;
        border-radius: .5rem;
        padding: 1rem 1rem 1.25rem;
        box-shadow: 0 1px 2px rgba(0, 0, 0, .04);
        margin-bottom: 1rem;
    }

    .day-title {
        font-weight: 700;
        font-size: 1.05rem;
        margin-bottom: .75rem;
        color: #111827;
    }

    .room-title {
        font-weight: 700;
        font-size: .95rem;
        margin: .85rem 0 .35rem;
        color: #111827;
    }

    .tbl {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        border-radius: 5px;
        overflow: hidden;
        border: 1px solid #d1d5db;
        margin-bottom: 1.2rem;
        font-size: .9rem;
    }

    .tbl thead th:first-child {
        border-top-left-radius: 5px;
    }

    .tbl thead th:last-child {
        border-top-right-radius: 5px;
    }

    .tbl tbody tr:last-child td:first-child {
        border-bottom-left-radius: 5px;
    }

    .tbl tbody tr:last-child td:last-child {
        border-bottom-right-radius: 5px;
    }

    .tbl th,
    .tbl td {
        border: 1px solid #bdbdbd;
        padding: .55rem .6rem;
        vertical-align: top;
    }

    .tbl th {
        background: #d9d9d9;
        font-weight: 700;
        text-align: left;
        color: #111;
    }

    .muted {
        color: #6b7280;
        font-size: .85rem;
        padding: .6rem 0;
    }
</style>

@php
$thaiMonths=[1=>'มกราคม',2=>'กุมภาพันธ์',3=>'มีนาคม',4=>'เมษายน',5=>'พฤษภาคม',6=>'มิถุนายน',7=>'กรกฎาคม',8=>'สิงหาคม',9=>'กันยายน',10=>'ตุลาคม',11=>'พฤศจิกายน',12=>'ธันวาคม'];
$monthName=$thaiMonths[(int)$day->format('n')] ?? $day->format('F');
$thaiYear=(int)$day->format('Y')+543;
@endphp

<div class="day-wrapper">
    <div class="day-card">

        <div class="day-title">
            {{ $day->format('j') }} {{ $monthName }} {{ $thaiYear }}
        </div>

        @if($bookingsByRoom->isEmpty())
        <div class="muted">ไม่มีรายการจอง</div>
        @else
        @foreach($bookingsByRoom as $roomId => $list)
        @php
        $roomName = $list->first()?->room?->room_name ?? 'ห้องประชุม';
        @endphp

        <div class="room-title">{{ $roomName }}</div>

        <table class="tbl">
            <thead>
                <tr>
                    <th style="width:12%;">เวลาเริ่มต้น</th>
                    <th style="width:12%;">เวลาสิ้นสุด</th>
                    <th>หัวข้อการประชุม</th>
                    <th style="width:20%;">กลุ่มงาน / ส่วนงาน</th>
                    <th style="width:18%;">ผู้จองห้องประชุม</th>
                </tr>
            </thead>
            <tbody>
                @foreach($list as $b)
                <tr>
                    <td>{{ $b->start_time?->format('H.i') }} น.</td>
                    <td>{{ $b->end_time?->format('H.i') }} น.</td>
                    <td>{{ $b->meeting_topic }}</td>
                    <td>{{ $b->department }}</td>
                    <td>{{ $b->name }} {{ $b->lastname }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endforeach
        @endif

    </div>
</div>
@endsection
