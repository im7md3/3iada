<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class NewPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Permission::truncate();

        $groups = (config()->get('permission_groups.groups'));
        $permissions = [];
        foreach ($groups as $name =>$group) {
            foreach ($group as $map){
                $permissions[] = $map . '_' . $name;
            }
        }

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
