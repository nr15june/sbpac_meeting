<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'bookings';       // ชื่อตาราง
    protected $primaryKey = 'booking_id'; // PK ที่เราใช้เอง

    protected $fillable = [
        'name',
        'lastname',
        'phone',
        'email',
        'department',
        'meeting_topic',
        'start_time',
        'end_time',
        'status',
        'room_id',
    ];
}
