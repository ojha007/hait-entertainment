<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketType extends Model
{

    public $timestamps = false;
    protected $table = 'ticket_types';
    protected $fillable = ['name'];
}
