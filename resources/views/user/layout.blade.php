<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'ระบบจองห้องประชุม | ศอ.บต.')</title>
    <link rel="icon" type="image/png" href="{{ asset('images/sbpac-logo.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    <script src="https://cdn.tailwindcss.com"></script>
    @endif

    <style>
        body {
            font-family: 'Sarabun', sans-serif;
        }
    </style>
</head>

<body class="antialiased bg-gray-300 min-h-screen">

    <!-- Header -->
    <header class="w-full bg-[#D9D9D9] border-b border-gray-400">
        <div class="flex items-center px-6 py-3">
            <img src="{{ asset('images/sbpac-logo.png') }}" class="w-12 h-12 mr-3">

            <div class="leading-tight">
                <div class="text-base font-semibold text-gray-900">
                    ศูนย์อำนวยการบริหารจังหวัดชายแดนภาคใต้
                </div>
                <div class="text-sm text-gray-700">
                    Southern Border Provinces Administrative Centre
                </div>
            </div>
        </div>
    </header>

    <!-- Main Layout -->
    <div class="w-full h-[calc(100vh-64px)] bg-white">
        <div class="flex h-full">

            <!-- ===== Sidebar ===== -->
            <aside class="w-64 bg-[#4C4C4C] text-gray-100 flex flex-col">

                <!-- เมนูหลัก -->
                <div class="bg-[#676767] px-4 py-2.5 text-sm font-semibold border-b border-gray-500">
                    เมนูหลัก
                </div>

                <nav class="text-sm">
                    <!-- ปฏิทินการใช้ห้อง -->
                    <a href="{{ route('user_calendar') }}"
                        class="flex items-center px-4 py-2.5 border-b border-gray-600 hover:bg-gray-600">
                        <i class="bi bi-house-door-fill mr-2 text-white"></i>
                        <span>ปฏิทินการใช้ห้อง</span>
                    </a>
                </nav>

                <!-- รายการ -->
                <div class="bg-[#676767] px-4 py-2.5 text-xs tracking-wide text-gray-300 border-b border-gray-500 mt-1">
                    รายการ
                </div>

                <nav class="text-sm">
                    <!-- จองห้องประชุม -->
                    <a href="{{ route('user_rooms') }}"
                        class="flex items-center px-4 py-2.5 border-b border-gray-600 hover:bg-gray-600">
                        <i class="bi bi-calendar2-event mr-2 text-white"></i>
                        <span>จองห้องประชุม</span>
                    </a>

                    <!-- ประวัติการจอง -->
                    <a href="{{ route('user_history_booking') }}"
                        class="flex items-center px-4 py-2.5 border-b border-gray-600 hover:bg-gray-600">
                        <i class="bi bi-clock-history mr-2 text-white"></i>
                        <span>ประวัติการจอง</span>
                    </a>
                </nav>

                <!-- บุคคล -->
                <div class="bg-[#676767] px-4 py-2.5 text-xs tracking-wide text-gray-300 border-b border-gray-500 mt-1">
                    บุคคล
                </div>

                <nav class="text-sm mb-4">
                    <!-- สำหรับเจ้าหน้าที่ -->
                    <a href="{{ route('login') }}"
                        class="flex items-center px-4 py-2.5 border-b border-gray-600 hover:bg-gray-600">
                        <i class="bi bi-person-circle mr-2 text-white"></i>
                        <span>สำหรับเจ้าหน้าที่</span>
                    </a>
                </nav>

            </aside>

        {{-- ================== พื้นที่แสดงเนื้อหาแต่ละหน้า ================== --}}
        <main class="flex-1 bg-[#FFFFFF] p-6 overflow-y-auto">
            @yield('content')
        </main>
        
        </div>
    </div>

</body>

</html>