<?php

namespace App\Models;

use App\Enums\CityEnum;
use App\Enums\MarketEnum;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Market extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $table = 'markets';
    protected $primaryKey = 'id';
    protected $fillable = [
        'commodity_uuid',
        'name',
        'city',
        'price',
        'start_date',
    ];
    protected $casts = [
        'name' => MarketEnum::class,
        'city' => CityEnum::class,
        'start_date' => 'date',
    ];

    public function commodity(): BelongsTo
    {
        return $this->belongsTo(Commodity::class, 'commodity_uuid', 'uuid');
    }

    public function getFormatDateAttribute(): string
    {
        return $this->start_date->format('d / m / Y');
    }
}
