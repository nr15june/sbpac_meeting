@extends('admin.layout')

@section('title', 'ปฏิทินการใช้ห้อง | ศอ.บต.')

@section('content')

<style>
    /* ===== Page Background ===== */
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
        --today: #dcfce7;
        --weekend: #f1f5f9;
        --bookbg: #fff7d6;
        --bookline: #f59e0b;
        --shadow: 0 10px 30px rgba(15, 23, 42, .08);
        --shadow2: 0 10px 22px rgba(15, 23, 42, .12);
    }

    .cal-wrapper {
        max-width: 1120px;
        margin: 0 auto;
        padding: 0 1rem 1.5rem;
    }

    /* ===== Header Card ===== */
    .cal-hero {
        background: linear-gradient(135deg, #ffffff 0%, #ffffff 60%, #eefaff 100%);
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

    .cal-hero-left {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .cal-hero-icon {
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

    .cal-hero-title {
        margin: 0;
        font-size: 18px;
        font-weight: 800;
        color: var(--ink);
        letter-spacing: .2px;
    }

    .cal-hero-sub {
        margin: 2px 0 0 0;
        font-size: 12.5px;
        color: var(--muted);
    }

    /* ===== Month Bar ===== */
    .cal-monthbar {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        margin: 10px 0 12px;
    }

    .cal-monthpill {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 14px;
        background: var(--card);
        border: 1px solid var(--line);
        border-radius: 999px;
        box-shadow: 0 4px 12px rgba(15, 23, 42, .06);
    }

    /* ===== Legend ===== */
    .cal-legend {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        flex-wrap: wrap;
        margin: 0 2px 10px;
    }

    .cal-tag {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 12px;
        color: #334155;
        background: #fff;
        border: 1px solid var(--line);
        padding: 6px 10px;
        border-radius: 999px;
        box-shadow: 0 2px 8px rgba(15, 23, 42, .04);
    }

    .dot {
        width: 10px;
        height: 10px;
        border-radius: 999px;
        background: #cbd5e1;
    }

    .dot.today {
        background: #22c55e;
    }

    .dot.book {
        background: #f59e0b;
    }

    .cal-navbtn {
        width: 34px;
        height: 34px;
        border-radius: 999px;
        border: 1px solid var(--line);
        background: #fff;
        color: #334155;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: .15s ease;
    }

    .cal-navbtn:hover {
        background: #f1f5f9;
        transform: translateY(-1px);
    }

    .cal-navbtn:active {
        transform: scale(.97);
    }

    .cal-monthtitle {
        font-weight: 900;
        color: var(--ink);
        font-size: 15px;
        letter-spacing: .2px;
        min-width: 170px;
        text-align: center;
    }

    /* ===== Legend ===== */


    /* ===== Calendar Table ===== */
    .cal-tablewrap {
        background: var(--card);
        border-radius: 16px;
        border: 1px solid var(--line);
        overflow: hidden;
        box-shadow: var(--shadow);
    }

    .cal-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        table-layout: fixed;
    }

    .cal-table thead th {
        background: #f8fafc;
        padding: 12px 8px;
        font-size: 12.5px;
        font-weight: 900;
        color: #111827;
        border-bottom: 1px solid var(--line);
        text-align: center;
    }

    .cal-table thead th+th {
        border-left: 1px solid var(--line);
    }

    .cal-table td {
        height: 128px;
        vertical-align: top;
        border-bottom: 1px solid var(--line);
        position: relative;
        background: #fff;
    }

    .cal-table td+td {
        border-left: 1px solid var(--line);
    }

    /* inside day */
    .cal-daylink {
        display: block;
        height: 100%;
        width: 100%;
        padding: 10px;
        text-decoration: none;
        color: inherit;
        transition: .15s ease;
        position: relative;
    }

    .cal-daylink:hover {
        background: #f8fafc;
        box-shadow: inset 0 0 0 1px rgba(37, 166, 213, .18);
    }

    .cal-daynum {
        position: absolute;
        top: 10px;
        right: 12px;
        font-size: 14px;
        font-weight: 900;
        color: var(--ink);
        line-height: 1;
    }

    /* out-of-month */
    .cal-out {
        background: #fafafa;
        color: #94a3b8;
    }

    .cal-out .cal-daynum {
        color: #94a3b8;
    }

    /* weekends */
    .cal-weekend .cal-daylink {
        background: var(--weekend);
    }

    .cal-weekend .cal-daylink:hover {
        background: #eaf0f7;
    }

    /* today highlight */
    .cal-today .cal-daylink {
        background: var(--today);
        box-shadow: inset 0 0 0 1px rgba(34, 197, 94, .25);
    }

    /* booking highlight */
    .cal-hasbooking .cal-daylink {
        background: var(--bookbg);
        box-shadow: inset 0 0 0 1px rgba(245, 158, 11, .25);
    }

    .cal-hasbooking .cal-daylink:hover {
        filter: brightness(.99);
        box-shadow: inset 0 0 0 1px rgba(245, 158, 11, .35);
    }

    /* booking count badge */
    .cal-count {
        position: absolute;
        left: 10px;
        bottom: 10px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 9px;
        border-radius: 999px;
        background: #fff;
        border: 1px solid rgba(245, 158, 11, .35);
        color: #92400e;
        font-size: 12px;
        font-weight: 800;
        box-shadow: 0 6px 14px rgba(15, 23, 42, .08);
    }

    .cal-count i {
        font-size: 13px;
    }

    /* responsive */
    @media (max-width: 720px) {
        .cal-monthtitle {
            min-width: 120px;
            font-size: 14px;
        }

        .cal-table td {
            height: 110px;
        }

        .cal-legend {
            justify-content: flex-start;
        }
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

$today = now()->toDateString(); // ✅ ไฮไลต์วันนี้
@endphp

<div class="cal-wrapper">

    <div class="cal-hero">
        <div class="cal-hero-left">
            <div class="cal-hero-icon">
                <i class="bi bi-calendar2-event"></i>
            </div>
            <div>
                <h1 class="cal-hero-title">ปฏิทินการใช้ห้องประชุม</h1>
                <p class="cal-hero-sub">คลิกวันที่เพื่อดูรายละเอียดการจองรายวัน</p>
            </div>
        </div>
    </div>

    <div class="cal-monthbar">
        <div class="cal-monthpill">
            <a class="cal-navbtn" href="{{ route('admin_calendar', ['month' => $prevMonth]) }}" title="เดือนก่อนหน้า">
                <i class="bi bi-chevron-left"></i>
            </a>

            <div class="cal-monthtitle">{{ $monthName }} {{ $thaiYear }}</div>

            <a class="cal-navbtn" href="{{ route('admin_calendar', ['month' => $nextMonth]) }}" title="เดือนถัดไป">
                <i class="bi bi-chevron-right"></i>
            </a>
        </div>
    </div>
    <div class="cal-legend">
        <span class="cal-tag"><span class="dot today"></span> วันนี้</span>
        <span class="cal-tag"><span class="dot book"></span> มีการจอง</span>
        <span class="cal-tag"><span class="dot"></span> ปกติ</span>
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

                    // ✅ weekend (เสาร์=6, อาทิตย์=7) ถ้าใช้ Carbon: isoWeekday()
                    $isWeekend = in_array($day->isoWeekday(), [6,7]);

                    // ✅ today
                    $isToday = $dateKey === $today;

                    $tdClass = trim(implode(' ', array_filter([
                    $isCurrentMonth ? '' : 'cal-out',
                    $isWeekend ? 'cal-weekend' : '',
                    $hasBooking ? 'cal-hasbooking' : '',
                    $isToday ? 'cal-today' : '',
                    ])));
                    @endphp

                    <td class="{{ $tdClass }}">
                        <a class="cal-daylink"
                            href="{{ route('admin_calendar_day', $dateKey) }}"
                            title="{{ $hasBooking ? 'มีการจอง '.$count.' รายการ' : 'ดูรายละเอียดวันที่ '.$dateKey }}">
                            <div class="cal-daynum">{{ $day->format('j') }}</div>

                            @if($hasBooking)
                            <div class="cal-count">
                                <i class="bi bi-bookmark-star-fill"></i>
                                {{ $count }} รายการ
                            </div>
                            @endif
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