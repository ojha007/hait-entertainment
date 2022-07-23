<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{

    public $timestamps = false;
    protected $table = 'partners';
    protected $fillable = ['name', 'image'];
}
