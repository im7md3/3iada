<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountsSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Account::truncate();
        Account::create(['name'=>'الأصول']);
        Account::create(['name'=>'الأصول المتداولة','parent_id'=>'1']);
        Account::create(['name'=>'الأصول الغير متداولة','parent_id'=>'1']);
    }
}
