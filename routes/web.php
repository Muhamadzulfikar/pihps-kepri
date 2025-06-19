<?php

use App\Http\Controllers\Admin\CommodityCrudController;
use App\Http\Controllers\Admin\MarketCrudController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class, 'index']);

Route::group([
    'prefix' => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace' => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('commodity-categories', \App\Http\Controllers\Admin\CommodityCategoryCrudController::class);
    Route::crud('cities', \App\Http\Controllers\Admin\CityCrudController::class);
    Route::crud('city-markets', \App\Http\Controllers\Admin\CityMarketCrudController::class);
    Route::crud('commodities/{market_type}', CommodityCrudController::class);
    Route::crud('commodities/{market_type}/{commodity_uuid}/markets', MarketCrudController::class);
});
