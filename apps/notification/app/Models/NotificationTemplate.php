<?php

namespace App\Models;

use App\Enum\NotificationTemplateTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property mixed $status
 * @property \App\Enum\NotificationTemplateTypeEnum $type
 * @property mixed $description
 * @property mixed $name
 */
class NotificationTemplate extends Model
{
    use HasFactory;

    public $casts = [
        'type' => NotificationTemplateTypeEnum::class
    ];

    public function data():hasMany
    {
        return $this->hasMany(NotificationTemplateData::class);
    }
}
