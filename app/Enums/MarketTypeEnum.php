<?php

namespace App\Enums;

use App\Traits\EnhancedEnumTrait;

enum MarketTypeEnum:string
{
    use EnhancedEnumTrait;

    case Tradisional = 'tradisional';
    case Modern = 'modern';
    case PedaganganBesar = 'perdagangan_besar';
    case Produsen = 'produsen';

    public function readableText(): string
    {
        return match ($this) {
            self::Tradisional => 'Pasar Tradisional',
            self::Modern => 'Pasar Modern',
            self::PedaganganBesar => 'Pedagangan Besar',
            self::Produsen => 'Produsen',
        };
    }
}
