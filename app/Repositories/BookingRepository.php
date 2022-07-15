<?php

namespace App\Repositories;

use App\Abstracts\Repository;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;

class BookingRepository extends Repository
{

    protected $model;

    /**
     * @param Booking $model
     */
    public function __construct(Booking $model)
    {
        $this->model = $model;
    }


    public function availableSeat($eventId, $ticketTypeId)
    {
        $subQuery = DB::table('bookings')
            ->selectRaw('sum(seat_quantity) as booked_seat,event_id')
            ->where('event_id', '=', $eventId)
            ->where('ticket_type_id', '=', $ticketTypeId)
            ->groupBy('event_id');
        return DB::table('event_tickets as et')
            ->selectRaw('(seat - COALESCE(b.booked_seat,0)) AS availableSeat')
            ->leftJoinSub($subQuery, 'b', 'b.event_id', '=', 'et.event_id')
            ->where('et.event_id', '=', $eventId)
            ->where('et.ticket_type_id', '=', $ticketTypeId)
            ->first();
    }
}
