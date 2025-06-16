<?php

namespace App\Models;

use App\Enums\InflationStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InflationHistory extends Model
{
    use HasFactory;

    protected $table = 'inflation_histories';
    protected $primaryKey = 'id';
    protected $fillable = [
        'commodity_uuid',
        'inflation',
        'percentage',
        'average',
        'start_date',
        'status',
    ];
    protected $casts = [
        'start_date' => 'date',
        'status' => InflationStatusEnum::class,
    ];

    public function commodity(): BelongsTo
    {
        return $this->belongsTo(Commodity::class, 'commodity_uuid', 'uuid');
    }
}
