<?php

namespace App\Http\Requests;

use App\Requests\FormRequestForApi;

class EventRequest extends FormRequestForApi
{

    public function rules(): array
    {
        return [
            'title' => 'required|string|min:2',
            'description' => 'required|string',
            'date' => 'required',
            'time' => 'nullable',
            'organizer' => 'nullable|string',
            'ticket_type_id' => 'required|array|min:1',
            'ticket_type_id.*' => 'required|numeric|exists:ticket_types,id',
            'rate' => 'required|array|min:1',
            'rate.*' => 'required|numeric|gt:0',
            'seat' => 'required|array|min:1',
            'seat.*' => 'required|numeric|gt:0',
            'address' => 'required|string',
            'event_type_id' => 'required|exists:event_types,id',
            'image' => 'required|image|mimes:jpg,png,jpeg,webp,gif,svg'
        ];
    }

}
