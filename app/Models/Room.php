<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'rooms';
    protected $primaryKey = 'room_id';

    protected $fillable = [
        'room_name',
        'building',
        'quantity',
        'organization',
        'department',
        'description',
        'room_image',
    ];
}
