@extends('user.layout')

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

    .his-wrap {
        max-width: 1120px;
        margin: 0 auto;
        padding: 0 1rem 1.5rem;
    }

    /* ===== HERO ===== */
    .his-hero {
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

    .his-hero-left {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 0;
    }

    .his-hero-ico {
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

    .his-hero-title {
        margin: 0;
        font-size: 18px;
        font-weight: 1000;
        color: var(--ink);
        line-height: 1.1;
        letter-spacing: .2px;
    }

    .his-hero-sub {
        margin: 4px 0 0 0;
        font-size: 12.5px;
        color: var(--muted);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 720px;
    }

    /* search pill (เหมือนรูปแรก) */
    .his-search {
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

    .his-search i {
        color: var(--muted);
    }

    .his-search input {
        width: 100%;
        border: none;
        background: transparent;
        outline: none;
        font-size: 14px;
        color: var(--ink);
    }

    .his-search input::placeholder {
        color: #94a3b8;
        font-weight: 700;
    }

    /* ===== LIST CARD ===== */
    .his-card {
        background: var(--card);
        border: 1px solid var(--line);
        border-radius: 18px;
        box-shadow: var(--shadow);
        overflow: hidden;
    }

    .his-card-head {
        padding: 12px 16px;
        border-bottom: 1px solid var(--line);
        background: #fbfdff;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        flex-wrap: wrap;
    }

    .his-card-head-left {
        display: flex;
        align-items: center;
        gap: 10px;
        color: var(--ink);
        font-weight: 1000;
    }

    .his-card-head-left .mini-ico {
        width: 34px;
        height: 34px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #eefaff;
        border: 1px solid rgba(37, 166, 213, .18);
        color: var(--brand);
        font-size: 16px;
    }

    .his-card-title {
        font-weight: 900;
        color: var(--ink);
    }

    .his-pill-count {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 7px 12px;
        border-radius: 999px;
        background: rgba(37, 166, 213, .10);
        border: 1px solid rgba(37, 166, 213, .18);
        color: #0b5f7a;
        font-weight: 900;
        font-size: 12.5px;
        white-space: nowrap;
    }

    .his-card-head-note {
        margin-left: auto;
        font-size: 12px;
        color: var(--muted);
        font-weight: 700;
        white-space: nowrap;
    }

    /* ===== TABLE ===== */
    .his-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }

    .his-table thead th {
        background: #f3f4f6;
        color: #334155;
        font-weight: 900;
        font-size: 13px;
        padding: 12px 14px;
        border-bottom: 1px solid var(--line);
        text-align: left;
    }

    .his-table thead th:last-child {
        text-align: center;
    }

    .his-table tbody tr {
        background: #fff;
    }

    .his-table tbody tr td {
        padding: 12px 14px;
        border-bottom: 1px solid #edf2f7;
        vertical-align: middle;
    }

    /* row hover + highlight เหมือนรูปแรก */
    .his-table tbody tr:hover td {
        background: #fffbe6;
    }

    /* pill styles (วันที่/เวลา/ห้อง) */
    .pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 7px 12px;
        border-radius: 999px;
        background: #fff;
        border: 1px solid #e2e8f0;
        color: #0f172a;
        font-weight: 900;
        font-size: 12.5px;
        white-space: nowrap;
    }

    .pill i {
        color: #64748b;
    }

    .pill-room {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
    }

    /* name block 2 lines */
    .name-block {
        line-height: 1.2;
    }

    .name-main {
        font-weight: 900;
        color: var(--ink);
        font-size: 13px;
    }

    .name-sub {
        font-weight: 700;
        color: var(--muted);
        font-size: 12px;
        margin-top: 2px;
        max-width: 420px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    /* detail button */
    .btn-detail {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 16px;
        border-radius: 999px;
        background: #F5D020;
        color: #111827;
        font-weight: 1000;
        text-decoration: none;
        border: none;
        box-shadow: 0 10px 18px rgba(245, 208, 32, .25), 0 6px 12px rgba(15, 23, 42, .08);
        transition: .15s ease;
        white-space: nowrap;
    }

    .btn-detail:hover {
        filter: brightness(.98);
        transform: translateY(-1px);
    }

    .btn-detail:active {
        transform: scale(.98);
    }

    .td-center {
        text-align: center;
    }

    /* empty */
    .empty {
        padding: 20px 14px;
        text-align: center;
        color: var(--muted);
        font-weight: 900;
        background: #fff;
    }

    @media (max-width: 900px) {
        .his-search {
            width: 100%;
            min-width: auto;
        }

        .his-hero {
            flex-direction: column;
            align-items: stretch;
        }

        .his-card-head {
            flex-wrap: wrap;
        }

        .his-card-head-note {
            width: 100%;
            margin-left: 0;
        }

        .name-sub {
            max-width: 260px;
        }
    }
</style>

@php
$total = $bookings->count();
@endphp

<div class="his-wrap">

    {{-- HERO --}}
    <div class="his-hero">
        <div class="his-hero-left">
            <div class="his-hero-ico"><i class="bi bi-clock-history"></i></div>
            <div>
                <h1 class="his-hero-title">ประวัติการจอง</h1>
                <p class="his-hero-sub">ตรวจสอบรายการจองย้อนหลัง ค้นหาด้วยชื่อผู้จองได้ทันที</p>
            </div>
        </div>

        <div class="his-search">
            <i class="bi bi-search"></i>
            <input id="historySearch" type="text" placeholder="ค้นหาด้วยชื่อผู้จอง">
        </div>
    </div>

    {{-- LIST CARD --}}
    <div class="his-card">
        <div class="his-card-head">
            <div class="his-card-head-left">
                <i class="bi bi-list-check" style="color:#0ea5e9;"></i>
                <div class="his-card-title">รายการประวัติการจอง</div>
                <div class="his-pill-count">
                    <i class="bi bi-collection"></i>
                    <span id="historyCount">{{ $total }}</span> รายการ
                </div>
            </div>

            <div class="his-card-head-note">
                * คลิก “รายละเอียด” เพื่อดูข้อมูลการจอง
            </div>
        </div>

        <div style="overflow:auto;">
            <table class="his-table" id="historyTable">
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
                    @forelse ($bookings as $index => $booking)
                    @php
                    // ใช้ข้อมูลตามที่คุณมี (ถ้า start_time เป็น Carbon)
                    $dateTxt = ($booking->start_time) ? $booking->start_time->format('d/m/Y') : '-';
                    $timeTxt = ($booking->start_time && $booking->end_time)
                    ? $booking->start_time->format('H.i').' - '.$booking->end_time->format('H.i').' น.'
                    : '-';

                    $fullName = trim(($booking->name ?? '').' '.($booking->lastname ?? ''));
                    $deptTxt = $booking->department ?? '';
                    $roomTxt = optional($booking->room)->room_name ?? '-';
                    @endphp

                    <tr class="{{ $index === 0 ? 'is-first' : '' }}" data-name="{{ mb_strtolower($fullName) }}">
                        <td>
                            <span class="pill"><i class="bi bi-calendar3"></i> {{ $dateTxt }}</span>
                        </td>

                        <td>
                            <span class="pill"><i class="bi bi-clock"></i> {{ $timeTxt }}</span>
                        </td>

                        <td>
                            <div class="name-block">
                                <div class="name-main">{{ $fullName ?: '-' }}</div>
                                @if($deptTxt)
                                <div class="name-sub">หน่วยงาน: {{ $deptTxt }}</div>
                                @endif
                            </div>
                        </td>

                        <td>
                            <span class="pill pill-room"><i class="bi bi-door-open"></i> {{ $roomTxt }}</span>
                        </td>

                        <td class="td-center">
                            <a href="{{ route('user_history_detail', $booking->booking_id) }}" class="btn-detail">
                                <i class="bi bi-eye"></i> รายละเอียด
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="empty">ยังไม่มีข้อมูลการจอง</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('historySearch');
        const table = document.getElementById('historyTable');
        const countEl = document.getElementById('historyCount');

        if (!input || !table) return;

        input.addEventListener('input', function() {
            const q = (input.value || '').trim().toLowerCase();
            const rows = table.querySelectorAll('tbody tr');
            let visible = 0;

            rows.forEach(row => {
                // ถ้าเป็นแถว empty ไม่ต้อง filter
                if (row.querySelector('.empty')) return;

                const name = (row.getAttribute('data-name') || '');
                const show = q === '' || name.includes(q);
                row.style.display = show ? '' : 'none';
                if (show) visible++;
            });

            if (countEl) countEl.textContent = visible;
        });
    });
</script>

@endsection