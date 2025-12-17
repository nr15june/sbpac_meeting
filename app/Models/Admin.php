<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admins';

    protected $fillable = [
        'email',
        'password',
        'role',
        'department_id', 
    ];

    protected $hidden = ['password'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
