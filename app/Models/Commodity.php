<?php

namespace App\Models;

use App\Enums\CommodityCategoryEnum;
use App\Enums\CommodityEnum;
use App\Enums\MarketTypeEnum;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Commodity extends Model
{
    use CrudTrait;
    use HasUuids;
    use HasFactory;

    protected $table = 'commodities';
    protected $primaryKey = 'uuid';
    protected $fillable = [
        'name',
        'category',
        'market_type',
    ];
    protected $casts = [
      'name' => CommodityEnum::class,
      'category' => CommodityCategoryEnum::class,
      'market_type' => MarketTypeEnum::class,
    ];

    public function markets(): HasMany
    {
        return $this->hasMany(Market::class, 'commodity_uuid', 'uuid');
    }

    public function inflationHistories(): HasMany
    {
        return $this->hasMany(InflationHistory::class, 'commodity_uuid', 'uuid');
    }

    public function getNameTextAttribute(): string
    {
        return $this->name->readableText();
    }

    public function getCategoryTextAttribute(): string
    {
        return $this->category->readableText();
    }

     public function getMarketTextAttribute(): string
    {
        return $this->market_type->readableText();
    }
}
