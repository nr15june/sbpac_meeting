@extends('admin.layout')

@section('title', 'ประวัติการจอง | ศอ.บต.')

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
    }

    .wrap {
        max-width: 1120px;
        margin: 0 auto;
        padding: 0 1rem 1.5rem;
    }

    /* ===== HERO ===== */
    .hero {
        background: linear-gradient(135deg, #ffffff 0%, #ffffff 62%, #eefaff 100%);
        border: 1px solid var(--line);
        border-radius: 18px;
        box-shadow: var(--shadow);
        padding: 16px 18px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 14px;
    }

    .hero-left {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 0;
    }

    .hero-icon {
        width: 46px;
        height: 46px;
        border-radius: 16px;
        background: rgba(37, 166, 213, .12);
        color: var(--brand);
        border: 1px solid rgba(37, 166, 213, .18);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        flex: 0 0 auto;
    }

    .hero-title {
        margin: 0;
        font-size: 18px;
        font-weight: 1000;
        color: var(--ink);
        line-height: 1.1;
        letter-spacing: .2px;
    }

    .hero-sub {
        margin: 4px 0 0 0;
        font-size: 12.5px;
        color: var(--muted);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 720px;
    }

    /* ===== SEARCH ===== */
    .search {
        display: flex;
        align-items: center;
        gap: 10px;
        background: #fff;
        border: 1px solid var(--line);
        border-radius: 999px;
        padding: 8px 12px;
        box-shadow: 0 6px 12px rgba(15, 23, 42, .06);
        min-width: min(420px, 100%);
    }

    .search i {
        color: var(--muted);
    }

    .search input {
        width: 100%;
        border: none;
        background: transparent;
        outline: none;
        font-size: 14px;
        color: var(--ink);
    }

    .search input::placeholder {
        color: #94a3b8;
        font-weight: 700;
    }

    /* ===== CARD + TABLE ===== */
    .card {
        background: var(--card);
        border: 1px solid var(--line);
        border-radius: 18px;
        box-shadow: var(--shadow);
        overflow: hidden;
    }

    .card-hd {
        padding: 12px 16px;
        border-bottom: 1px solid var(--line);
        background: #fbfdff;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        flex-wrap: wrap;
    }

    .card-hd .hd-left {
        display: flex;
        align-items: center;
        gap: 10px;
        color: var(--ink);
        font-weight: 1000;
    }

    .badge-count {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 10px;
        border-radius: 999px;
        background: rgba(37, 166, 213, .12);
        border: 1px solid rgba(37, 166, 213, .18);
        color: #0b6f93;
        font-weight: 1000;
        font-size: 12px;
        white-space: nowrap;
    }

    .hint {
        font-size: 12px;
        color: var(--muted);
        font-weight: 800;
    }

    .table-wrap {
        overflow: auto;
        -webkit-overflow-scrolling: touch;
    }

    table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    thead th {
        background: #f3f4f6;
        color: #334155;
        font-weight: 900;
        font-size: 13px;
        padding: 12px 14px;
        border-bottom: 1px solid var(--line);
        text-align: left;
    }

    tbody td {
        padding: 12px 14px;
        border-bottom: 1px solid #eef2f7;
        color: #0f172a;
        vertical-align: middle;
        white-space: nowrap;
    }

    tbody tr:nth-child(even) {
        background: #fbfbfb;
    }

    tbody tr:hover {
        background: #fffbe6;
    }

    .td-center {
        text-align: center;
    }

    /* ===== “chips” date/time/room ===== */
    .chip {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 7px 10px;
        border-radius: 999px;
        border: 1px solid #e2e8f0;
        background: #fff;
        color: #0f172a;
        font-weight: 900;
        font-size: 13px;
    }

    .chip i {
        color: #64748b;
    }

    .name {
        display: flex;
        align-items: center;
        gap: 10px;
        min-width: 0;
    }


    .name-text {
        display: flex;
        flex-direction: column;
        line-height: 1.15;
        min-width: 0;
    }

    .name-text b {
        font-weight: 1000;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        max-width: 320px;
    }

    .name-text small {
        color: var(--muted);
        font-weight: 800;
        font-size: 12px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        max-width: 320px;
    }

    .btn-detail {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 8px 12px;
        border-radius: 999px;
        background: linear-gradient(135deg, var(--yellow) 0%, #F2C230 100%);
        color: #111827;
        font-weight: 1000;
        text-decoration: none;
        border: 1px solid rgba(0, 0, 0, .06);
        box-shadow: 0 10px 18px rgba(245, 208, 32, .22), 0 6px 12px rgba(15, 23, 42, .08);
        transition: .15s ease;
        white-space: nowrap;
    }

    .btn-detail:hover {
        transform: translateY(-1px);
        filter: brightness(.98);
    }

    .btn-detail:active {
        transform: scale(.98);
    }

    .empty {
        padding: 28px 16px;
        text-align: center;
        color: #64748b;
        font-weight: 900;
    }

    .empty i {
        display: block;
        font-size: 26px;
        color: #94a3b8;
        margin-bottom: 8px;
    }

    /* ✅ responsive hero */
    @media (max-width: 860px) {
        .search {
            min-width: 100%;
        }

        .hero {
            flex-direction: column;
            align-items: stretch;
        }

        .hero-left {
            justify-content: flex-start;
        }
    }
</style>

<div class="wrap">

    {{-- HERO --}}
    <div class="hero">
        <div class="hero-left">
            <div class="hero-icon"><i class="bi bi-clock-history"></i></div>
            <div style="min-width:0;">
                <div class="hero-title">ประวัติการจอง</div>
                <div class="hero-sub">ตรวจสอบรายการจองย้อนหลัง ค้นหาด้วยชื่อผู้จองได้ทันที</div>
            </div>
        </div>

        {{-- Search --}}
        <form action="{{ route('admin_history_booking') }}" method="GET" class="search">
            <i class="bi bi-search"></i>
            <input
                type="text"
                name="q"
                value="{{ $q ?? '' }}"
                placeholder="ค้นหาด้วยชื่อผู้จอง">
        </form>
    </div>

    {{-- TABLE CARD --}}
    <div class="card">
        <div class="card-hd">
            <div class="hd-left">
                <i class="bi bi-list-check" style="color:#0ea5e9;"></i>
                <span>รายการประวัติการจอง</span>

                {{-- ✅ badge จำนวนรายการ (ถ้าเป็น paginator จะมี total) --}}
                <span class="badge-count">
                    <i class="bi bi-collection"></i>
                    {{ method_exists($bookings, 'total') ? $bookings->total() : $bookings->count() }} รายการ
                </span>
            </div>

            <div class="hint">
                * คลิก “รายละเอียด” เพื่อดูข้อมูลการจอง
            </div>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th style="width:16%;">วันที่ใช้ห้อง</th>
                        <th style="width:20%;">เวลา</th>
                        <th style="width:30%;">ชื่อ - นามสกุล</th>
                        <th style="width:20%;">ห้องประชุม</th>
                        <th style="width:14%;" class="td-center">รายละเอียด</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($bookings as $booking)
                    @php
                    $dateText = ($booking->start_time) ? $booking->start_time->format('d/m/Y') : '-';
                    $timeText = ($booking->start_time && $booking->end_time)
                    ? $booking->start_time->format('H.i').' - '.$booking->end_time->format('H.i').' น.'
                    : '-';

                    $fullName = trim(($booking->name ?? '').' '.($booking->lastname ?? ''));
                    $initial = $fullName ? mb_substr($fullName, 0, 1) : 'B';

                    $roomName = optional($booking->room)->room_name ?? '-';
                    $dept = $booking->department ?? null; // ถ้ามี field นี้ในตาราง bookings
                    @endphp

                    <tr>
                        <td>
                            <span class="chip"><i class="bi bi-calendar3"></i> {{ $dateText }}</span>
                        </td>

                        <td>
                            <span class="chip"><i class="bi bi-clock"></i> {{ $timeText }}</span>
                        </td>

                        <td>
                            <div class="name">
                                <div class="name-text">
                                    <b title="{{ $fullName ?: '-' }}">{{ $fullName ?: '-' }}</b>
                                    <small title="{{ $dept ?: '' }}">
                                        {{ $dept ? 'หน่วยงาน: '.$dept : ' ' }}
                                    </small>
                                </div>
                            </div>
                        </td>

                        <td>
                            <span class="chip"><i class="bi bi-door-open"></i> {{ $roomName }}</span>
                        </td>

                        <td class="td-center">
                            <a href="{{ route('admin_history_detail', $booking->booking_id) }}" class="btn-detail">
                                <i class="bi bi-eye"></i> รายละเอียด
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">
                            <div class="empty">
                                <i class="bi bi-inbox"></i>
                                ยังไม่มีข้อมูลการจอง
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- ✅ ถ้า $bookings เป็น paginator และอยากโชว์เลขหน้า ให้ปลดคอมเมนต์ --}}
        {{-- <div style="padding:12px 16px;border-top:1px solid var(--line);background:#fbfdff;">
            {{ $bookings->links() }}
    </div> --}}
</div>

</div>

@endsection