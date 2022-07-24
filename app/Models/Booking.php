<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{

    protected $table = 'bookings';
    protected $fillable = ['event_ticket_id', 'seat_quantity', 'name', 'email', 'phone', 'payer_id', 'token_id'];


    /**
     * @return BelongsTo
     */
    public function pricing(): BelongsTo
    {
        return $this->belongsTo(EventPricing::class,'event_ticket_id');
    }

}
