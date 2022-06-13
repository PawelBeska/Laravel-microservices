<?php

namespace App\Models;


use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RouteStatisticParameter extends Model
{

    /**
     * @var string[]
     */
    protected $fillable = [
        'route_statistic_id',
        'type',
        'key',
        'value',
        'counter'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function routeStatistic(): belongsTo
    {
        return $this->belongsTo(RouteStatistic::class);
    }

}
