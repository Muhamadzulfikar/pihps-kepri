<?php

namespace App\Enums;

use App\Traits\EnhancedEnumTrait;

enum MarketEnum: string
{
    use EnhancedEnumTrait;

    case Aviari = 'aviari';
    case Sagulung = 'sagulung';
    case Jodoh = 'jodoh';
    case Pelantar = 'pelantar';
    case Bintan = 'bintan';

    public function readableText(): string
    {
        return match ($this) {
            self::Aviari => 'Pasar Aviari',
            self::Sagulung => 'Pasar Sagulung',
            self::Jodoh => 'Pasar Tos 3000 Jodoh',
            self::Pelantar => 'Pasar Pelantar Kud',
            self::Bintan => 'Pasar Bintan Center',
        };
    }

    public function type(): CityEnum
    {
        return match ($this) {
            self::Aviari => CityEnum::Batam,
            self::Sagulung => CityEnum::Batam,
            self::Jodoh => CityEnum::Batam,
            self::Pelantar => CityEnum::TanjungPinang,
            self::Bintan => CityEnum::TanjungPinang,
        };
    }
}
