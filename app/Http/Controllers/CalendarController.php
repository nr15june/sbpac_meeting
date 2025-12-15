<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Booking;

class CalendarController extends Controller
{
    // ---------------- USER ----------------
    public function userIndex(Request $request)
    {
        return $this->renderCalendar($request, 'user.calendar');
    }

    public function userDay($date)
    {
        return $this->renderDay($date, 'user.calendar_day');
    }

    // ---------------- ADMIN ----------------
    public function adminIndex(Request $request)
    {
        return $this->renderCalendar($request, 'admin.calendar');
    }

    public function adminDay($date)
    {
        return $this->renderDay($date, 'admin.calendar_day');
    }

    // ---------------- SHARED ----------------
    private function renderCalendar(Request $request, string $viewName)
    {
        $current = $request->query('month')
            ? Carbon::parse($request->query('month'))->startOfMonth()
            : Carbon::now()->startOfMonth();

        $startOfWeek = $current->copy()->startOfWeek(Carbon::MONDAY);
        $endOfWeek   = $current->copy()->endOfMonth()->endOfWeek(Carbon::SUNDAY);

        $date = $startOfWeek->copy();
        $weeks = [];
        while ($date->lte($endOfWeek)) {
            $week = [];
            for ($i = 0; $i < 7; $i++) {
                $week[] = $date->copy();
                $date->addDay();
            }
            $weeks[] = $week;
        }

        $countsByDate = Booking::query()
            ->whereBetween('start_time', [
                $startOfWeek->copy()->startOfDay(),
                $endOfWeek->copy()->endOfDay()
            ])
            ->selectRaw('DATE(start_time) as d, COUNT(*) as c')
            ->groupBy('d')
            ->pluck('c', 'd')
            ->toArray();

        return view($viewName, compact('current', 'weeks', 'countsByDate'));
    }

    private function renderDay(string $date, string $viewName)
    {
        $day = Carbon::parse($date)->startOfDay();

        $bookings = Booking::with('room')
            ->whereDate('start_time', $day->toDateString())
            ->orderBy('room_id')
            ->orderBy('start_time')
            ->get();

        $bookingsByRoom = $bookings->groupBy('room_id');

        return view($viewName, compact('day', 'bookingsByRoom'));
    }
}
