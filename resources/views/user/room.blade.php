@extends('user.layout')

@section('title', 'เลือกห้องประชุม | ระบบจองห้อง ศอ.บต.')

@section('content')

<style>
    main { background:#f3f4f6; }

    :root{
        --brand:#25A6D5;
        --ink:#0f172a;
        --muted:#64748b;
        --line:#e5e7eb;
        --card:#ffffff;
        --soft:#f8fafc;
        --shadow:0 10px 30px rgba(15,23,42,.08);
        --shadow2:0 10px 22px rgba(15,23,42,.10);

        --yellow:#F5D020;
        --yellow2:#f2c739;
    }

    .room-wrapper{
        max-width:1120px;
        margin:0 auto;
        padding:0 1rem 1.5rem;
    }

    /* ===== Hero ===== */
    .hero{
        background: linear-gradient(135deg, #ffffff 0%, #ffffff 60%, #eefaff 100%);
        border:1px solid var(--line);
        border-radius:18px;
        box-shadow:var(--shadow);
        padding:16px 18px;
        display:flex;
        align-items:center;
        justify-content:space-between;
        gap:12px;
        margin-bottom:14px;
    }
    .hero-left{
        display:flex;
        align-items:center;
        gap:12px;
        min-width:0;
    }
    .hero-icon{
        width:46px;height:46px;
        border-radius:16px;
        background: rgba(37,166,213,.12);
        color: var(--brand);
        border:1px solid rgba(37,166,213,.18);
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:22px;
        flex:0 0 auto;
    }
    .hero-title{
        margin:0;
        font-size:18px;
        font-weight:900;
        color:var(--ink);
        letter-spacing:.2px;
        line-height:1.1;
    }
    .hero-sub{
        margin:4px 0 0 0;
        font-size:12.5px;
        color:var(--muted);
    }

    /* ===== Grid ===== */
    .room-list{
        display:grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap:18px;
    }
    @media (max-width: 1024px){
        .room-list{ grid-template-columns: repeat(2, minmax(0, 1fr)); }
    }
    @media (max-width: 640px){
        .room-list{ grid-template-columns: 1fr; }
    }

    /* ===== Card ===== */
    .room-card{
        background: var(--card);
        border:1px solid var(--line);
        border-radius:18px;
        overflow:hidden;
        box-shadow: var(--shadow2);
        transition:.18s ease;
        position:relative;
    }
    .room-card:hover{
        transform: translateY(-2px);
        box-shadow: 0 16px 40px rgba(15,23,42,.12);
    }

    .room-card-image{
        width:100%;
        height: 190px;
        background:#e5e7eb;
        overflow:hidden;
        position:relative;
    }
    .room-card-image img{
        width:100%;
        height:100%;
        object-fit:cover;
        transition:.25s ease;
        transform: scale(1.01);
    }
    .room-card:hover .room-card-image img{
        transform: scale(1.06);
    }

    /* badge มุมซ้ายบน */
    .badge{
        position:absolute;
        top:12px; left:12px;
        display:inline-flex;
        align-items:center;
        gap:8px;
        padding:6px 10px;
        border-radius:999px;
        background: rgba(255,255,255,.92);
        border:1px solid rgba(0,0,0,.06);
        color:#0f172a;
        font-weight:900;
        font-size:12px;
        box-shadow: 0 10px 18px rgba(15,23,42,.12);
        backdrop-filter: blur(4px);
    }
    .badge i{ color:#64748b; }

    .room-body{
        padding: 12px 14px 14px;
        display:flex;
        flex-direction:column;
        gap:10px;
    }

    .room-name{
        font-size:15px;
        font-weight:900;
        color:var(--ink);
        margin:0;
        line-height:1.25;
    }

    .room-meta{
        display:flex;
        align-items:center;
        justify-content:space-between;
        gap:10px;
        color:var(--muted);
        font-size:12.5px;
        margin-top:-2px;
    }

    .meta-chip{
        display:inline-flex;
        align-items:center;
        gap:8px;
        padding:6px 10px;
        border-radius:999px;
        background:#f8fafc;
        border:1px solid #e2e8f0;
        color:#334155;
        font-weight:800;
        white-space:nowrap;
    }
    .meta-chip i{ color:#64748b; }

    .room-actions{
        display:flex;
        justify-content:flex-end;
        margin-top:2px;
    }

    .btn-book-room{
        display:inline-flex;
        align-items:center;
        gap:8px;
        padding:10px 14px;
        border-radius:14px;
        background: var(--yellow);
        color:#111827;
        font-weight:1000;
        text-decoration:none;
        border:1px solid rgba(0,0,0,.06);
        box-shadow: 0 10px 18px rgba(245,208,32,.22), 0 6px 12px rgba(15,23,42,.08);
        transition:.15s ease;
        white-space:nowrap;
    }
    .btn-book-room:hover{
        background: var(--yellow2);
        transform: translateY(-1px);
    }
    .btn-book-room:active{
        transform: scale(.98);
    }

    /* placeholder */
    .noimg{
        height:100%;
        display:flex;
        align-items:center;
        justify-content:center;
        color:#6b7280;
        font-weight:900;
        font-size:13px;
        background: repeating-linear-gradient(
            45deg,
            #f3f4f6,
            #f3f4f6 10px,
            #e5e7eb 10px,
            #e5e7eb 20px
        );
    }
</style>

<div class="room-wrapper">

    {{-- Hero --}}
    <div class="hero">
        <div class="hero-left">
            <div class="hero-icon"><i class="bi bi-door-open"></i></div>
            <div style="min-width:0;">
                <h1 class="hero-title">เลือกห้องประชุม</h1>
                <p class="hero-sub">เลือกห้องที่ต้องการ แล้วกด “จองห้องนี้” เพื่อไปหน้ากรอกรายละเอียด</p>
            </div>
        </div>
    </div>

    {{-- Grid --}}
    <div class="room-list">
        @foreach ($rooms as $room)
        <div class="room-card">

            <div class="room-card-image">
                <div class="badge">
                    <i class="bi bi-building"></i> ห้องประชุม
                </div>

                @if($room->room_image)
                <img src="{{ asset('storage/' . $room->room_image) }}" alt="{{ $room->room_name }}">
                @else
                <div class="noimg">
                    <i class="bi bi-image" style="margin-right:8px;"></i> ไม่มีรูปภาพ
                </div>
                @endif
            </div>

            <div class="room-body">
                <p class="room-name">{{ $room->room_name }}</p>
                <div class="room-actions">
                    <a href="{{ route('create_booking', ['room_id' => $room->room_id]) }}" class="btn-book-room">
                        <i class="bi bi-plus-circle"></i> จองห้องนี้
                    </a>
                </div>
            </div>

        </div>
        @endforeach
    </div>

</div>

@endsection
