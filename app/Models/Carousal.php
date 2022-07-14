<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Carousal extends Model
{

    use SoftDeletes;

    protected $fillable = ['title', 'description', 'order', 'url'];
    protected $table = 'slider_images';
}
