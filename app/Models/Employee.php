<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'citizen_id',
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
}
