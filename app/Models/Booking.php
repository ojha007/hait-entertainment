<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{

    protected $table = 'bookings';
    protected $fillable = ['event_id', 'ticket_type_id', 'seat_quantity', 'name', 'email', 'phone'];

}
