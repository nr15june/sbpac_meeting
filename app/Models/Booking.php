<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Employee; // ✅ เพิ่ม

class Booking extends Model
{
    protected $table = 'bookings';
    protected $primaryKey = 'booking_id';

    protected $fillable = [
        'room_id',
        'employee_id',
        'meeting_topic',
        'department',
        'name',
        'lastname',
        'phone',
        'start_time',
        'end_time',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id', 'room_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    protected $casts = [
        'start_time' => 'datetime',
        'end_time'   => 'datetime',
    ];
}
