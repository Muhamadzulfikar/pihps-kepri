<?php

namespace App\Enums;

use App\Traits\EnhancedEnumTrait;

enum InflationStatusEnum: string
{
    use EnhancedEnumTrait;

    case Tetap = 'tetap';
    case Turun = 'turun';
    case Naik = 'naik';

    public function readableText(): string
    {
        return match ($this) {
            self::Tetap => 'Tetap',
            self::Turun => 'Turun',
            self::Naik => 'Naik',
        };
    }

    public function badgeColor(): string
    {
        return match ($this) {
            self::Tetap => 'bg-blue',
            self::Turun => 'bg-green',
            self::Naik => 'bg-red',
        };
    }

    public function badgeIcon(): string
    {
        return match ($this) {
            self::Tetap => 'la-pause',
            self::Turun => 'la-arrow-down',
            self::Naik => 'la-arrow-up',
        };
    }
}
