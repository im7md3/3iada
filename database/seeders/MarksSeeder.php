<?php

namespace Database\Seeders;

use App\Models\Mark;
use Illuminate\Database\Seeder;

class MarksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Mark::truncate();
        Mark::create(['show'=>1,'name'=>'الحرارة']);
        Mark::create(['show'=>1,'name'=>'الوزن']);
        Mark::create(['show'=>1,'name'=>'الضغط']);
        Mark::create(['show'=>1,'name'=>'الطول']);
        Mark::create(['show'=>1,'name'=>'دقات القلب']);
        Mark::create(['show'=>1,'name'=>'التنفس']);
        Mark::create(['show'=>1,'name'=>'الحمل']);
        Mark::create(['show'=>1,'name'=>'السكر']);
    }
}
