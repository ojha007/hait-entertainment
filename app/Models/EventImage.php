<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventImage extends Model
{

    public $timestamps = false;
    protected $fillable = ['file', 'is_banner', 'event_id'];
    protected $table = 'event_images';
}
