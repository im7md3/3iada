<?php

namespace Database\Seeders;

use App\Models\OurService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ourServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('services')->truncate();
        OurService::create([
            'name' => 'خدمة الربط مع شركات التأمين ونفيس متوفرة حاليا.',
            'description' => 'خدمة الربط مع شركات التأمين ونفيس متوفرة حاليا.'
        ]);
        OurService::create([
            'name' => 'الربط مع مزود خدمات الرسائل SMS ( تذكيرات - مواعيد - إلغاء - حجز ) اعلانات . ',
            'description' => 'الربط مع مزود خدمات الرسائل SMS ( تذكيرات - مواعيد - إلغاء - حجز ) اعلانات . ',
        ]);
        OurService::create([
            'name' => 'الربط مع مزود الخدمة الواتس اب ( تذكيرات - مواعيد - إلغاء - حجز ) اعلانات .',
            'description' => 'الربط مع مزود الخدمة الواتس اب ( تذكيرات - مواعيد - إلغاء - حجز ) اعلانات .'
        ]);
    }
}
