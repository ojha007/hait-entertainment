<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{

    protected $fillable = ['title', 'description', 'address', 'date', 'time',
        'event_type_id', 'organizer_id', 'banner_image', 'background_image'];


    public function pricing(): HasMany
    {
        return $this->hasMany(EventPricing::class);
    }


    public function eventType(): BelongsTo
    {
        return $this->belongsTo(EventType::class);
    }
}
