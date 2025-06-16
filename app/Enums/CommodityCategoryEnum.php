<?php

namespace App\Enums;

use App\Traits\EnhancedEnumTrait;

enum CommodityCategoryEnum: string
{
    use EnhancedEnumTrait;

   case Beras = 'beras';
    case DagingAyam = 'daging_ayam';
    case DagingSapi = 'daging_sapi';
    case TelurAyam = 'telur_ayam';
    case BawangMerah = 'bawang_merah';
    case BawangPutih = 'bawang_putih';
    case CabaiMerah = 'cabai_merah';
    case CabaiRawit = 'cabai_rawit';
    case MinyakGoreng = 'minyak_goreng';
    case GulaPasir = 'gula_pasir';

    public function readableText(): string
    {
        return match ($this) {
            self::Beras => 'Beras',
            self::DagingAyam => 'Daging Ayam',
            self::DagingSapi => 'Daging Sapi',
            self::TelurAyam => 'Telur Ayam',
            self::BawangMerah => 'Bawang Merah',
            self::BawangPutih => 'Bawang Putih',
            self::CabaiMerah => 'Cabai Merah',
            self::CabaiRawit => 'Cabai Rawit',
            self::MinyakGoreng => 'Minyak Goreng',
            self::GulaPasir => 'Gula Pasir',
        };
    }

    public static function search($value): ?self
    {
        foreach (self::cases() as $case) {
            if ($case->value === $value) {
                return $case;
            }
        }

        return null;
    }
}
