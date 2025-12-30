@extends('admin.layout')

@section('title', 'รายการจองประจำวัน | ศอ.บต.')

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
    }

    .day-wrapper {
        max-width: 1120px;
        margin: 0 auto;
        padding: 0 1rem 1.5rem;
    }

    /* ===== Top bar ===== */

    .backbtn {
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

    .backbtn:hover {
        background: var(--soft);
        transform: translateY(-1px);
    }

    .backbtn:active {
        transform: scale(.98);
    }


    /* ===== Header card ===== */
    .day-hero {
        background: linear-gradient(135deg, #ffffff 0%, #ffffff 60%, #eefaff 100%);
        border: 1px solid var(--line);
        border-radius: 18px;
        box-shadow: var(--shadow);
        padding: 16px 18px;
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 14px;
    }

    .hero-left {
        display: flex;
        gap: 12px;
        align-items: flex-start;
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
        flex: 0 0 auto;
    }

    .hero-title {
        margin: 0;
        font-size: 18px;
        font-weight: 900;
        color: var(--ink);
        letter-spacing: .2px;
    }

    .hero-sub {
        margin: 4px 0 0 0;
        font-size: 12.5px;
        color: var(--muted);
    }

    /* ===== Room card ===== */
    .room-card {
        background: var(--card);
        border: 1px solid var(--line);
        border-radius: 16px;
        box-shadow: 0 8px 22px rgba(15, 23, 42, .06);
        overflow: hidden;
        margin-bottom: 14px;
    }

    .room-head {
        padding: 12px 14px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        background: #fbfdff;
        border-bottom: 1px solid var(--line);
    }

    .room-name {
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 900;
        color: var(--ink);
    }

    .room-name i {
        width: 34px;
        height: 34px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #eef2ff;
        color: #4338ca;
        border: 1px solid #e5e7eb;
    }

    .room-count {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 10px;
        border-radius: 999px;
        background: #fff7ed;
        border: 1px solid #fed7aa;
        color: #9a3412;
        font-weight: 900;
        font-size: 12px;
        white-space: nowrap;
    }

    /* ===== Table ===== */
    .tbl {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        font-size: .92rem;
    }

    .tbl thead th {
        background: #f8fafc;
        color: #111827;
        font-weight: 900;
        font-size: 12.5px;
        padding: 12px 12px;
        border-bottom: 1px solid var(--line);
        text-align: left;
        white-space: nowrap;
    }

    .tbl tbody td {
        padding: 12px 12px;
        border-bottom: 1px solid var(--line);
        vertical-align: top;
        color: #0f172a;
    }

    .tbl tbody tr:hover td {
        background: #f8fafc;
    }

    .timechip {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-weight: 900;
        color: #0f172a;
    }

    .timechip i {
        color: #64748b;
    }

    .topic {
        font-weight: 500;
        color: #0f172a;
    }

    .meta {
        color: #64748b;
        font-size: 12px;
        margin-top: 4px;
    }

    .empty {
        background: #fff;
        border: 1px dashed #cbd5e1;
        border-radius: 14px;
        padding: 18px;
        color: #64748b;
        text-align: center;
    }

    @media (max-width: 900px) {
        .tbl thead {
            display: none;
        }

        .tbl,
        .tbl tbody,
        .tbl tr,
        .tbl td {
            display: block;
            width: 100%;
        }

        .tbl tr {
            border-bottom: 1px solid var(--line);
        }

        .tbl tbody td {
            border-bottom: none;
            padding: 10px 14px;
        }

        .tbl tbody td::before {
            content: attr(data-label);
            display: block;
            font-size: 12px;
            color: var(--muted);
            font-weight: 800;
            margin-bottom: 4px;
        }
    }
</style>

@php
$thaiMonths=[1=>'มกราคม',2=>'กุมภาพันธ์',3=>'มีนาคม',4=>'เมษายน',5=>'พฤษภาคม',6=>'มิถุนายน',7=>'กรกฎาคม',8=>'สิงหาคม',9=>'กันยายน',10=>'ตุลาคม',11=>'พฤศจิกายน',12=>'ธันวาคม'];
$monthName=$thaiMonths[(int)$day->format('n')] ?? $day->format('F');
$thaiYear=(int)$day->format('Y')+543;

$total = (int) $bookingsByRoom->flatten(1)->count();
@endphp

<div class="day-wrapper">

    <div class="day-hero">
        <div class="hero-left">
            <div class="hero-icon"><i class="bi bi-calendar-check"></i></div>
            <div>
                <h1 class="hero-title">รายการจองประจำวัน</h1>
                <div class="hero-sub">
                    {{ $day->format('j') }} {{ $monthName }} {{ $thaiYear }}
                </div>
            </div>
        </div>
        <a class="backbtn" href="{{ route('admin_calendar', ['month' => $day->format('Y-m')]) }}">
            <i class="bi bi-arrow-left"></i> ย้อนกลับ
        </a>
    </div>

    @if($bookingsByRoom->isEmpty())
    <div class="empty">
        <div style="font-weight:900; color:#334155; margin-bottom:6px;">
            <i class="bi bi-info-circle"></i> ไม่มีรายการจองในวันนี้
        </div>
        ลองเลือกวันอื่นจากปฏิทิน
    </div>
    @else

    @foreach($bookingsByRoom as $roomId => $list)
    @php
    $roomName = $list->first()?->room?->room_name ?? 'ห้องประชุม';
    $roomCount = (int) $list->count();
    @endphp

    <div class="room-card">
        <div class="room-head">
            <div class="room-name">
                <i class="bi bi-door-open"></i>
                {{ $roomName }}
            </div>
            <div class="room-count">
                <i class="bi bi-list-check"></i>
                {{ $roomCount }} รายการ
            </div>
        </div>

        <div style="overflow:auto;">
            <table class="tbl">
                <thead>
                    <tr>
                        <th style="width:14%;">เวลา</th>
                        <th style="width:16%;">วันที่</th>
                        <th>หัวข้อการประชุม</th>
                        <th style="width:22%;">กลุ่มงาน</th>
                        <th style="width:18%;">ผู้จอง</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($list as $b)
                    <tr>
                        {{-- เวลา --}}
                        <td data-label="เวลา">
                            <div class="timechip">
                                <i class="bi bi-clock"></i>
                                {{ $b->start_time?->format('H.i') }} - {{ $b->end_time?->format('H.i') }} น.
                            </div>
                        </td>

                        {{-- วันที่ (แยกคอลัมน์) --}}
                        <td data-label="วันที่">
                            <div class="timechip">
                                <i class="bi bi-calendar3"></i>
                                {{ $b->start_time?->format('d/m/Y') ?? $day->format('d/m/Y') }}
                            </div>
                        </td>

                        {{-- หัวข้อการประชุม (เหลือเฉพาะหัวข้อ) --}}
                        <td data-label="หัวข้อการประชุม">
                            <div class="topic">{{ $b->meeting_topic }}</div>
                        </td>

                        {{-- กลุ่มงาน --}}
                        <td data-label="กลุ่มงาน">
                            {{ $b->department }}
                        </td>

                        {{-- ผู้จอง --}}
                        <td data-label="ผู้จอง">
                            <div style="font-weight:500;">{{ $b->name }} {{ $b->lastname }}</div>
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
    @endforeach

    @endif

</div>
@endsection