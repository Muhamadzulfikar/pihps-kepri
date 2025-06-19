<?php

namespace App\Http\Controllers;

use App\Enums\MarketTypeEnum;
use App\Models\City;
use App\Models\CityMarket;
use App\Models\Commodity;
use App\Models\Market;
use Illuminate\View\View;

class PublicController extends Controller
{
    public function index(): View
    {
        $marketType = request()->query('market_type', MarketTypeEnum::Tradisional);
        $category = request()->query('category', 'beras');

        $fiveLatestDates = Market::select('start_date')
            ->distinct()
            ->orderByDesc('start_date')
            ->take(5)
            ->pluck('start_date')
            ->sort()
            ->values();

        $commodities = Commodity::select('uuid', 'name', 'category')
            ->with([
                'markets' => fn($query) => $query->whereIn('start_date', $fiveLatestDates),
                'inflationHistories' => fn($query) => $query->whereIn('start_date', $fiveLatestDates),
            ])
            ->where('market_type', $marketType)
            ->get();

        $markets = Market::whereHas('commodity', fn($query) => $query->where('category', $category))
            ->where('start_date', $fiveLatestDates->last())->get();

        $cityMarkets = CityMarket::select(['id', 'city_id', 'name'])->get();

        $cities = City::select('id', 'name')->get();

        return view('public', [
            'commodities' => $commodities,
            'cities' => $cities,
            'markets' => $markets,
            'cityMarkets'  => $cityMarkets,
            'category' => $category,
        ]);
    }
}
