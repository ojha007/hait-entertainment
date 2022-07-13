<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventPricing extends Model
{

    public $timestamps = false;
    protected $table = 'event_tickets';
    protected $fillable = ['event_id', 'ticket_type_id', 'rate'];
    protected $with = ['ticket'];

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(TicketType::class,'ticket_type_id');
    }

}
