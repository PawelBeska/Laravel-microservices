<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class RouteStatistic extends Model
{
    public const BIND = 'bind';
    public const QUERY = 'query';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var string[]
     */
    public $fillable = [
        'method',
        'route',
        'ip',
        'date',
        'counter',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function parameters(): HasMany
    {
        return $this->hasMany(RouteStatisticParameter::class);
    }
}
