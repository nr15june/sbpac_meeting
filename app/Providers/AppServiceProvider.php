<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Admin;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // ส่งตัวแปรให้ทุก view ที่อยู่ใน admin.*
        View::composer('admin.*', function ($view) {
            $adminName = null;
            $deptName  = null;

            if (session('admin_logged_in') && session('admin_id')) {
                $admin = Admin::with('department')->find(session('admin_id'));

                if ($admin) {
                    // ถ้ามี field name ก็ใช้ ไม่มีก็ fallback เป็น email
                    $adminName = $admin->name ?? $admin->email ?? 'Admin';
                    $deptName  = optional($admin->department)->name ?? 'ไม่พบกลุ่มงาน';
                }
            }

            $view->with([
                'adminName' => $adminName,
                'deptName'  => $deptName,
            ]);
        });
    }
}
