<?php

namespace App\Repositories;

use App\Abstracts\Repository;
use App\Models\Booking;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
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

    public function getBookingByToken($token)
    {
        return $this->getModel()
            ->where('token_id', '=', $token)
            ->get();
    }


    public function findByEventId($eventId, $paginate = 20): LengthAwarePaginator
    {
        return DB::table('bookings as b')
            ->select('et.rate', 'b.name', 'b.email', 'b.phone', 'b.token_id', 'b.seat_quantity', 'tt.name as ticketType')
            ->join('event_tickets as et', 'b.event_ticket_id', '=', 'et.id')
            ->join('ticket_types as tt', 'et.ticket_type_id', '=', 'tt.id')
            ->where('et.event_id', '=', $eventId)
            ->orderByDesc('created_at')
            ->paginate($paginate);
    }
}
