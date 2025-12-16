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
            ['email' => 'admin1@sbpac.go.th', 'password' => Hash::make('123456'), 'role' => 'admin', 'department_id' => 1],
            ['email' => 'admin2@sbpac.go.th', 'password' => Hash::make('123456'), 'role' => 'admin', 'department_id' => 2],
            ['email' => 'admin3@sbpac.go.th', 'password' => Hash::make('123456'), 'role' => 'admin', 'department_id' => 3],
            ['email' => 'admin4@sbpac.go.th', 'password' => Hash::make('123456'), 'role' => 'admin', 'department_id' => 4],
        ];

        foreach ($admins as $admin) {
            Admin::updateOrCreate(
                ['email' => $admin['email']],
                [
                    'password' => $admin['password'],
                    'role' => $admin['role'],
                    'department_id' => $admin['department_id'],
                ]
            );
        }
    }
}
