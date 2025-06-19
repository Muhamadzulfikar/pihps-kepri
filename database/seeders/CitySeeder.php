<?php

namespace Database\Seeders;

use App\Enums\CityEnum;
use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        foreach (CityEnum::cases() as $cityEnum) {
            City::create([
               'name' => $cityEnum->readableText(),
            ]);
        }
    }
}
