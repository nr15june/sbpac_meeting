<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{

    protected $table = 'bookings';
    protected $primaryKey = 'booking_id';

    protected $fillable = [
        'name',
        'lastname',
        'phone',
        'email',
        'department',
        'meeting_topic',
        'start_time',
        'end_time',
        'room_id',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id', 'room_id');
    }

    protected $casts = [
        'start_time' => 'datetime',
        'end_time'   => 'datetime',
    ];
}
