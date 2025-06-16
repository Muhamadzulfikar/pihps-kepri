<?php

namespace Database\Seeders;

use App\Enums\CommodityEnum;
use App\Enums\MarketTypeEnum;
use App\Models\Commodity;
use Illuminate\Database\Seeder;

class CommoditySeeder extends Seeder
{
    public function run(): void
    {
        foreach (MarketTypeEnum::cases() as $marketTypeEnum) {
            foreach (CommodityEnum::cases() as $commodityEnum) {
                Commodity::updateOrCreate([
                    'name' => $commodityEnum->value,
                    'category' => $commodityEnum->type()->value,
                    'market_type' => $marketTypeEnum->value,
                ], [
                    'name' => $commodityEnum->value,
                    'category' => $commodityEnum->type()->value,
                    'market_type' => $marketTypeEnum->value,
                ]);
            }
        }
    }
}
