@extends('admin.layout')

@section('title', 'ปฏิทินการใช้ห้อง | ศอ.บต.')

@section('content')

<style>
    .cal-wrapper {
        width: 100%;
        max-width: 100%;
        margin: 0;
        padding: 0 1rem;
    }

    .cal-header {
        display: flex;
        align-items: center;
        justify-content: flex-start;
        margin-bottom: .35rem;
        padding: 1rem 1.5rem;
        background-color: #ffffff;
        border: 1px solid #ebeaeaff;
        border-radius: 0.450rem;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    .cal-header-left {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .cal-header-icon {
        width: 2rem;
        height: 2rem;
        border-radius: 0.375rem;
        background-color: #ffffff;
        border: 1px solid #d4d4d4;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .cal-header-title {
        font-size: 1.2rem;
        font-weight: 600;
        color: #1f2933;
    }

    .cal-monthbar {
        margin-top: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 2rem;
        padding: .35rem .65rem;
    }

    .cal-navbtn-circle {
        width: 1.5rem;
        height: 1.5rem;
        border-radius: 999px;
        background-color: #f1f1f1ff;
        color: #636262ff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        text-decoration: none;
        transition: all 0.15s ease;
        font-weight: 1000;
    }

    .cal-navbtn-circle:hover {
        background-color: #c7c7c7ff;
    }

    .cal-navbtn-circle:active {
        transform: scale(0.9);
        background-color: #c2c2c2ff;
    }

    .cal-monthtitle {
        font-weight: 700;
        font-size: 1.05rem;
        color: #111;
        min-width: auto;
        text-align: left;
    }

    .cal-tablewrap {
        background: #fff;
        border-radius: 6px;
        overflow: hidden;
        border: 1px solid #d4d4d4;
        margin-top: .8rem;
    }

    .cal-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        table-layout: fixed;
    }

    .cal-table th {
        background: #f3f4f6;
        padding: .55rem .25rem;
        font-size: .85rem;
        font-weight: 700;
        color: #111;
        border-right: 1px solid #d4d4d4;
        border-bottom: 1px solid #d4d4d4;
        text-align: center;
    }

    .cal-table th:last-child {
        border-right: none;
    }

    .cal-table td {
        height: 120px;
        vertical-align: top;
        border-right: 1px solid #d4d4d4;
        border-bottom: 1px solid #d4d4d4;
        background: #fff;
        padding: .35rem;
        position: relative;
    }

    .cal-table tr td:last-child {
        border-right: none;
    }

    .cal-out {
        color: #9ca3af;
        background: #fafafa;
    }

    .cal-daylink {
        display: block;
        width: 100%;
        height: 100%;
        text-decoration: none;
        color: inherit;
        border-radius: 4px;
        padding: .15rem;
    }

    .cal-daynum {
        position: absolute;
        top: 8px;
        right: 10px;
        font-size: .9rem;
        font-weight: 700;
        color: #111;
        line-height: 1;
    }

    .cal-hasbooking {
        background: #fff5cc;
    }

    .cal-hasbooking:hover {
        filter: brightness(0.98);
    }
</style>

@php
$thaiMonths = [
1=>'มกราคม',2=>'กุมภาพันธ์',3=>'มีนาคม',4=>'เมษายน',5=>'พฤษภาคม',6=>'มิถุนายน',
7=>'กรกฎาคม',8=>'สิงหาคม',9=>'กันยายน',10=>'ตุลาคม',11=>'พฤศจิกายน',12=>'ธันวาคม'
];
$monthName = $thaiMonths[(int)$current->format('n')] ?? $current->format('F');
$thaiYear = (int)$current->format('Y') + 543;

$prevMonth = $current->copy()->subMonth()->format('Y-m');
$nextMonth = $current->copy()->addMonth()->format('Y-m');
@endphp

<div class="cal-wrapper">

    <div class="cal-header">
        <div class="cal-header-left">
            <div class="cal-header-icon">
                <i class="bi bi-calendar2-event"></i>
            </div>
            <h1 class="cal-header-title">ระบบจองห้องประชุม</h1>
        </div>
    </div>

    <div class="cal-monthbar">
        <a class="cal-navbtn-circle" href="{{ route('admin_calendar', ['month' => $prevMonth]) }}">
            <i class="bi bi-chevron-left"></i>
        </a>

        <div class="cal-monthtitle">{{ $monthName }} {{ $thaiYear }}</div>

        <a class="cal-navbtn-circle" href="{{ route('admin_calendar', ['month' => $nextMonth]) }}">
            <i class="bi bi-chevron-right"></i>
        </a>
    </div>

    <div class="cal-tablewrap">
        <table class="cal-table">
            <thead>
                <tr>
                    <th>จันทร์</th>
                    <th>อังคาร</th>
                    <th>พุธ</th>
                    <th>พฤหัส</th>
                    <th>ศุกร์</th>
                    <th>เสาร์</th>
                    <th>อาทิตย์</th>
                </tr>
            </thead>
            <tbody>
                @foreach($weeks as $week)
                <tr>
                    @foreach($week as $day)
                    @php
                    $dateKey = $day->toDateString();
                    $isCurrentMonth = $day->month === $current->month;
                    $count = (int)($countsByDate[$dateKey] ?? 0);
                    $hasBooking = $count > 0;
                    @endphp

                    <td class="{{ $isCurrentMonth ? '' : 'cal-out' }}">
                        <a class="cal-daylink {{ $hasBooking ? 'cal-hasbooking' : '' }}"
                            href="{{ route('admin_calendar_day', $dateKey) }}"
                            title="{{ $hasBooking ? 'มีการจอง' : 'ดูรายละเอียดวันที่ '.$dateKey }}">
                            <div class="cal-daynum">{{ $day->format('j') }}</div>
                        </a>
                    </td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

@endsection
