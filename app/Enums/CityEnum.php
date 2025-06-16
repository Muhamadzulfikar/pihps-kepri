<?php

namespace App\Enums;

use App\Traits\EnhancedEnumTrait;

enum CityEnum: string
{
    use EnhancedEnumTrait;

    case Batam = 'batam';
    case TanjungPinang = 'tanjungpinang';

    public function readableText(): string
    {
        return match ($this) {
            self::Batam => 'Kota Batam',
            self::TanjungPinang => 'Kota Tanjung Pinang',
        };
    }

    public function coordinate(): string
    {
        return match ($this) {
            self::Batam => 'coordinate-batam',
            self::TanjungPinang => 'coordinate-pinang',
        };
    }
}
