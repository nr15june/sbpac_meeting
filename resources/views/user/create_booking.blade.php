@extends('user.layout')

@section('content')
<div class="max-w-5xl mx-auto py-6">

    {{-- หัวข้อหน้า --}}
    <div class="bg-white rounded-2xl shadow mb-6 px-6 py-4 flex items-center">
        <div class="w-9 h-9 rounded-full bg-gray-100 flex items-center justify-center mr-3">
            <i class="bi bi-calendar2-event text-xl text-gray-700"></i>
        </div>
        <h1 class="text-xl font-semibold text-gray-800">
            จองห้องประชุม
        </h1>
    </div>

    <form action="{{ route('booking.store') }}" method="POST">
        @csrf

        {{-- กล่อง: ข้อมูลการใช้ห้อง --}}
        <div class="bg-white rounded-2xl shadow mb-6 px-6 py-5">
            <h2 class="text-base font-semibold text-gray-800 mb-4">
                ข้อมูลการใช้ห้อง
            </h2>

            {{-- วันที่ / เวลา --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                <div>
                    <label class="block text-sm text-gray-700 mb-1">วันที่ใช้ห้อง</label>
                    <input type="date" name="use_date"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm
                                  focus:outline-none focus:ring-2 focus:ring-sky-300 focus:border-sky-400">
                </div>
                <div>
                    <label class="block text-sm text-gray-700 mb-1">เวลาเริ่ม</label>
                    <input type="time" name="start_time"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm
                                  focus:outline-none focus:ring-2 focus:ring-sky-300 focus:border-sky-400">
                </div>
                <div>
                    <label class="block text-sm text-gray-700 mb-1">เวลาสิ้นสุด</label>
                    <input type="time" name="end_time"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm
                                  focus:outline-none focus:ring-2 focus:ring-sky-300 focus:border-sky-400">
                </div>
            </div>

            {{-- ห้องประชุม --}}
            <div class="mb-4">
                <label class="block text-sm text-gray-700 mb-1">ห้องประชุม</label>
                <select name="room_id"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm bg-white
                               focus:outline-none focus:ring-2 focus:ring-sky-300 focus:border-sky-400">
                    <option value="">-- เลือกห้องประชุม --</option>
                    <option value="1">ห้องประชุม 1</option>
                    {{-- ถ้ามีดึงจากฐานข้อมูลก็วน loop rooms ตรงนี้ --}}
                </select>
            </div>

            {{-- หัวข้อการประชุม --}}
            <div>
                <label class="block text-sm text-gray-700 mb-1">หัวข้อการประชุม</label>
                <input type="text" name="meeting_topic"
                       class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm
                              focus:outline-none focus:ring-2 focus:ring-sky-300 focus:border-sky-400"
                       placeholder="ระบุหัวข้อการประชุม">
            </div>
        </div>

        {{-- กล่อง: ข้อมูลผู้ขอใช้ห้อง --}}
        <div class="bg-white rounded-2xl shadow mb-6 px-6 py-5">
            <h2 class="text-base font-semibold text-gray-800 mb-4">
                ข้อมูลผู้ขอใช้ห้อง
            </h2>

            {{-- หน่วยงาน / ส่วนงาน --}}
            <div class="mb-4">
                <label class="block text-sm text-gray-700 mb-1">กลุ่มงาน / ส่วนงาน</label>
                <input type="text" name="department"
                       class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm
                              focus:outline-none focus:ring-2 focus:ring-sky-300 focus:border-sky-400"
                       placeholder="เช่น กลุ่มงานบริหารงบประมาณ">
            </div>

            {{-- ชื่อ - นามสกุล --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm text-gray-700 mb-1">ชื่อ</label>
                    <input type="text" name="first_name"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm
                                  focus:outline-none focus:ring-2 focus:ring-sky-300 focus:border-sky-400">
                </div>
                <div>
                    <label class="block text-sm text-gray-700 mb-1">นามสกุล</label>
                    <input type="text" name="last_name"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm
                                  focus:outline-none focus:ring-2 focus:ring-sky-300 focus:border-sky-400">
                </div>
            </div>

            {{-- เบอร์โทร / อีเมล --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm text-gray-700 mb-1">เบอร์โทร</label>
                    <input type="text" name="phone"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm
                                  focus:outline-none focus:ring-2 focus:ring-sky-300 focus:border-sky-400">
                </div>
                <div>
                    <label class="block text-sm text-gray-700 mb-1">อีเมล</label>
                    <input type="email" name="email"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm
                                  focus:outline-none focus:ring-2 focus:ring-sky-300 focus:border-sky-400">
                </div>
            </div>

            {{-- รายละเอียดเพิ่มเติม --}}
            <div>
                <label class="block text-sm text-gray-700 mb-1">รายละเอียดเพิ่มเติม</label>
                <textarea name="note" rows="3"
                          class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm
                                 focus:outline-none focus:ring-2 focus:ring-sky-300 focus:border-sky-400"
                          placeholder="เช่น ต้องการอุปกรณ์เพิ่มเติม, การจัดรูปแบบโต๊ะ ฯลฯ"></textarea>
            </div>
        </div>

        {{-- ปุ่มจอง --}}
        <div class="flex justify-end">
            <button type="submit"
                    class="px-10 py-2.5 rounded-full bg-[#50C65E] hover:bg-[#45b154]
                           text-white text-sm font-semibold shadow">
                จอง
            </button>
        </div>
    </form>
</div>
@endsection