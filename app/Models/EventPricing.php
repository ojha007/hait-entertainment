<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EventPricing extends Model
{

    public $timestamps = false;
    protected $table = 'event_tickets';
    protected $fillable = ['event_id', 'ticket_type_id', 'rate', 'seat'];
    protected $with = ['ticket'];

//    protected $appends=['availableSeat'];

    public function ticket(): BelongsTo
    {
        return $this->belongsTo(TicketType::class, 'ticket_type_id');
    }

    public function availableSeat($ticketTypeId): int
    {
        $totalSeat = $this->getAttribute('seat');
        $bookedSeat = $this->bookings()
            ->getBaseQuery()
            ->join('event_tickets as e', 'bookings.event_ticket_id', '=', 'e.id')
            ->where('ticket_type_id', '=', $ticketTypeId)
            ->sum('seat_quantity');
        return $totalSeat - $bookedSeat;
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class, 'event_ticket_id');
    }

}
