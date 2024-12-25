<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsTableSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::truncate();
        $settings = new Setting();
        $settings->site_name = 'برنامج العيادات الطبية';
        $settings->url = 'http://127.0.0.1:8000/admin/settings';
        $settings->email = 'atheeb.clinic@gmail.com';
        $settings->status = 'open';
        $settings->phone = '0506499275';
        $settings->sms_status = 'open';
        $settings->sms_username = 'برنامج العيادات الطبية';
        $settings->sms_password = '0123454';
        $settings->sms_sender = 'برنامج العيادات الطبية';
        $settings->address = 'حي طويق';
        $settings->build_num = '6624';
        $settings->unit_num = '4';
        $settings->postal_code = '14928';
        $settings->extra_number = '3034';
        $settings->tax_no = '310954677800003';
        $settings->tax_rate = '15';
        $settings->tax_enabled = '1';
        $settings->age_or_gender = 'all';
        $settings-> emergency_active = 0;
        $settings-> account_tree_active = 0;

        $settings->save();
    }
}
