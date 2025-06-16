<?php

namespace App\Enums;

use App\Traits\EnhancedEnumTrait;

enum CommodityEnum: string
{
    use EnhancedEnumTrait;

   case BerasKualitasBawahI = 'beras_bwh_1';
    case BerasKualitasBawahII = 'beras_bwh_2';
    case BerasKualitasMediumI = 'beras_med_1';
    case BerasKualitasMediumII = 'beras_med_2';
    case BerasKualitasSuperI = 'beras_sup_1';
    case BerasKualitasSuperII = 'beras_sup_2';
    case DagingAyamRasSegar = 'ayam_ras';
    case DagingSapiKualitas1 = 'sapi_1';
    case DagingSapiKualitas2 = 'sapi_2';
    case TelurAyamRasSegar = 'telur_ras';
    case BawangMerahUkuranSedang = 'bawang_merah';
    case BawangPutihUkuranSedang = 'bawang_putih';
    case CabaiMerahBesar = 'cabai_merah_besar';
    case CabaiMerahKeriting = 'cabai_keriting';
    case CabaiRawitHijau = 'rawit_hijau';
    case CabaiRawitMerah = 'rawit_merah';
    case MinyakGorengCurah = 'minyak_curah';
    case MinyakGorengKemasanBermerk1 = 'minyak_kemasan_1';
    case MinyakGorengKemasanBermerk2 = 'minyak_kemasan_2';
    case GulaPasirKualitasPremium = 'gula_premium';
    case GulaPasirKualitasLokal = 'gula_lokal';

    public function readableText(): string
    {
        return match ($this) {
            self::BerasKualitasBawahI => 'Beras Kualitas Bawah I',
            self::BerasKualitasBawahII => 'Beras Kualitas Bawah II',
            self::BerasKualitasMediumI => 'Beras Kualitas Medium I',
            self::BerasKualitasMediumII => 'Beras Kualitas Medium II',
            self::BerasKualitasSuperI => 'Beras Kualitas Super I',
            self::BerasKualitasSuperII => 'Beras Kualitas Super II',
            self::DagingAyamRasSegar => 'Daging Ayam Ras Segar',
            self::DagingSapiKualitas1 => 'Daging Sapi Kualitas 1',
            self::DagingSapiKualitas2 => 'Daging Sapi Kualitas 2',
            self::TelurAyamRasSegar => 'Telur Ayam Ras Segar',
            self::BawangMerahUkuranSedang => 'Bawang Merah Ukuran Sedang',
            self::BawangPutihUkuranSedang => 'Bawang Putih Ukuran Sedang',
            self::CabaiMerahBesar => 'Cabai Merah Besar',
            self::CabaiMerahKeriting => 'Cabai Merah Keriting',
            self::CabaiRawitHijau => 'Cabai Rawit Hijau',
            self::CabaiRawitMerah => 'Cabai Rawit Merah',
            self::MinyakGorengCurah => 'Minyak Goreng Curah',
            self::MinyakGorengKemasanBermerk1 => 'Minyak Goreng Kemasan Bermerk 1',
            self::MinyakGorengKemasanBermerk2 => 'Minyak Goreng Kemasan Bermerk 2',
            self::GulaPasirKualitasPremium => 'Gula Pasir Kualitas Premium',
            self::GulaPasirKualitasLokal => 'Gula Pasir Kualitas Lokal',
        };
    }

    public function type(): CommodityCategoryEnum
    {
        return match ($this) {
            self::BerasKualitasBawahI => CommodityCategoryEnum::Beras,
            self::BerasKualitasBawahII => CommodityCategoryEnum::Beras,
            self::BerasKualitasMediumI => CommodityCategoryEnum::Beras,
            self::BerasKualitasMediumII => CommodityCategoryEnum::Beras,
            self::BerasKualitasSuperI => CommodityCategoryEnum::Beras,
            self::BerasKualitasSuperII => CommodityCategoryEnum::Beras,
            self::DagingAyamRasSegar => CommodityCategoryEnum::DagingAyam,
            self::DagingSapiKualitas1 => CommodityCategoryEnum::DagingSapi,
            self::DagingSapiKualitas2 => CommodityCategoryEnum::DagingSapi,
            self::TelurAyamRasSegar => CommodityCategoryEnum::TelurAyam,
            self::BawangMerahUkuranSedang => CommodityCategoryEnum::BawangMerah,
            self::BawangPutihUkuranSedang => CommodityCategoryEnum::BawangPutih,
            self::CabaiMerahBesar => CommodityCategoryEnum::CabaiMerah,
            self::CabaiMerahKeriting => CommodityCategoryEnum::CabaiMerah,
            self::CabaiRawitHijau => CommodityCategoryEnum::CabaiRawit,
            self::CabaiRawitMerah => CommodityCategoryEnum::CabaiRawit,
            self::MinyakGorengCurah => CommodityCategoryEnum::MinyakGoreng,
            self::MinyakGorengKemasanBermerk1 => CommodityCategoryEnum::MinyakGoreng,
            self::MinyakGorengKemasanBermerk2 => CommodityCategoryEnum::MinyakGoreng,
            self::GulaPasirKualitasPremium => CommodityCategoryEnum::GulaPasir,
            self::GulaPasirKualitasLokal => CommodityCategoryEnum::GulaPasir,
        };
    }

}
