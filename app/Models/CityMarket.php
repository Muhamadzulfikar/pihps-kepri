<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CityMarket extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $table = 'city_markets';
    protected $primaryKey = 'id';
    protected $fillable = [
        'city_id',
        'name'
    ];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function markets(): HasMany
    {
        return $this->hasMany(Market::class, 'city_market_id', 'id');
    }

    public function getCityMarketAttribute(): string
    {
        return $this->name.' ( '.$this->city->name.' )';
    }
}
