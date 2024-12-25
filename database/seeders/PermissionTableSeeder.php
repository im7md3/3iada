<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        /*  $permissions = [
            'الأقسام',
            'العروض',
            'النماذج',
            'الخدمات',
            'المصاريف',
            'المشتريات',
            'اضافة فاتورة',
            'المحولون',
            'التقارير',
            'اضافة مريض',
            'تعديل مريض',
            'حذف مريض',
            'تحويل مريض',
            'المرضى',
            'المواعيد',
            'الفواتير',
            'التشخيصات',
            'تسديد الزيارات',
            'الاشعارات',
            'المرضى بالانتظار',
            'الاعدادات',
            'الصلاحيات',
            'المشرفين',
            'الموظفين',
            'خصم الفاتورة',
            'رؤية جوال المريض',
            'طلبات الأشعة داخل ملف المريض',
            'طلبات المختبر داخل ملف المريض',
            'رفع الملفات على الاشعه والمختبرات',
            'تعديل السعر',
            'بيانات المواعيد',
            'حذف الفواتير',
            'تحضير المرضى',
            'عرض الملف الشخصي للمريض',
            'اضافة الفواتير',
            'تعديل الفواتير',
            'استرجاع الفواتير',
            'حذف الموعد',
            'تعديل الموعد',
        ]; */

        $groups = config()->get('permission_groups');
        $permissions = [];
        foreach ($groups as $name => $group) {
            foreach ($group as $map) {
                $permissions[] = $map . '_' . $name;
            }
        }


        Permission::truncate();
        Role::truncate();
        $admin_role = Role::create(['name' => 'مدير']);
        $reception = Role::create(['name' => 'الاستقبال']);
        $doctor = Role::create(['name' => 'الأطباء']);
        $role4 = Role::create(['name' => 'المحاسبين']);
        $role5 = Role::create(['name' => 'الأشعة']);
        $role6 = Role::create(['name' => 'المختبر']);
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
            $admin_role->givePermissionTo($permission);
        }

        $reception_permissions = [
            $permissions[43],
            $permissions[44],
            $permissions[50],
            $permissions[51],
            $permissions[56],
            $permissions[57],
            $permissions[68],
            $permissions[69],
            $permissions[72],
            $permissions[73],
        ];

        foreach ($reception_permissions as $permission) {
            $reception->givePermissionTo($permission);
        }

        $doctor_permissions = [
            $permissions[44],
            $permissions[47],
            $permissions[48],
            $permissions[49],
            $permissions[50],
            $permissions[51],
            $permissions[57],
            $permissions[65],
            $permissions[68],
            $permissions[69],
            $permissions[72],
            $permissions[73],
            $permissions[74],
            $permissions[75],
            $permissions[76],
            $permissions[77],
            $permissions[78],
            $permissions[79],
            $permissions[80],
            $permissions[81],
            $permissions[83],
            $permissions[84],
            $permissions[85],
            $permissions[86],
            $permissions[87],
            $permissions[88],
            $permissions[89],
            $permissions[90],
            $permissions[92],
            $permissions[94],
            $permissions[98],
            $permissions[103],
            $permissions[109],
        ];


        foreach ($doctor_permissions as $permission) {
            $doctor->givePermissionTo($permission);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
