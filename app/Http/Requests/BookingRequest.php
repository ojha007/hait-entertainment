<?php

namespace App\Http\Requests;

use App\Models\Booking;
use App\Repositories\BookingRepository;
use App\Requests\FormRequestForApi;

class BookingRequest extends FormRequestForApi
{

    public function rules(): array
    {

        $repo = (new BookingRepository(new Booking()));
        $event_id =$this->get('event_id');
        $ticketTypeId =$this->get('ticket_type_id');
        $seat = $repo->availableSeat($event_id, $ticketTypeId);
        $availableSeat = $seat->availableSeat ?? 0;


        return [
            'event_id' => 'required|numeric|exists:events,id,date,>=,' . now(),
            'ticket_type_id' => 'required|exists:ticket_types,id',
            'seat_quantity' => 'required|numeric|gt:0|lt:' . $availableSeat,
            'email' => 'required|email',
            'name' => 'required|string',
            'phone' => 'required|numeric|size:10'
        ];
    }
}
