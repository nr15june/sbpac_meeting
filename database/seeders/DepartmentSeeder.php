<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department; 

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
            ['code' => 'SBPAC-1', 'name' => 'กลุ่มงานบริหารยุทธศาสตร์การพัฒนาจังหวัดชายแดนภาคใต้'],
            ['code' => 'SBPAC-2',  'name' => 'กลุ่มงานบริหารงบประมาณ'],
            ['code' => 'SBPAC-3',  'name' => 'กลุ่มงานอํานวยการและบริหาร'],
            ['code' => 'SBPAC-4',  'name' => 'กลุ่มงานบริหารยุทธศาสตร์การสื่อสารสร้างความเข้าใจที่ดี'],
        ];

        foreach ($departments as $dept) {
            Department::firstOrCreate(
                ['code' => $dept['code']],
                ['name' => $dept['name']]
            );
        }
    }
}