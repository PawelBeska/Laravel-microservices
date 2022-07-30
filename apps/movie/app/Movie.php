<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
    use HasFactory;

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function data(): HasMany
    {
        return $this->hasMany(MovieData::class);
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(MovieProvider::class);
    }
    public function genre(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class);
    }
}
