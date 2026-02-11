<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'card_id',
        'username',
        'email',
        'password',
        'first_name',
        'last_name',
        'phone',
        'department_id',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'employee_id');
    }
}
