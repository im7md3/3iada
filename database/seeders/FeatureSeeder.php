<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $features = [
        'is_dentist' =>'dentist',
        'is_dermatologist' => 'dermatologist',
        'is_orthodontics' => 'orthodontics',
        'is_optometrist' => 'optometrist',
        'is_pregnancy' =>'pregnancy'
    ];
        foreach ($features as $key => $feature){
            Feature::create(['name' => $feature , 'key' =>$key]);
        }
    }
}
