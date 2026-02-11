<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $admins = [
            [
                'username' => 'adminit',
                'password' => Hash::make('123456'),
                'role' => 'admin',
                'department_id' => 1
            ],
        ];

        foreach ($admins as $admin) {
            Admin::updateOrCreate(
                ['username' => $admin['username']],
                [
                    'password' => $admin['password'],
                    'role' => $admin['role'],
                    'department_id' => $admin['department_id'],
                ]
            );
        }
    }
}
