<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class SupplierFactory extends Factory
{
    protected $model = Supplier::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'name' => $this->faker->name(),
            'phone' => $this->faker->phoneNumber(),
            'building_no' => $this->faker->word(),
            'tax_no' => $this->faker->word(),

            'city_id' => City::factory(),
        ];
    }
}
