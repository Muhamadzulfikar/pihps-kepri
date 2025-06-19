<?php

namespace Database\Seeders;

use App\Enums\CommodityCategoryEnum;
use App\Models\CommodityCategory;
use Illuminate\Database\Seeder;

class CommodityCategorySeeder extends Seeder
{
    public function run():void
    {
        foreach (CommodityCategoryEnum::cases() as $commodityCategoryEnum) {
            CommodityCategory::create([
               'name' => $commodityCategoryEnum->readableText(),
            ]);
        }
    }
}
