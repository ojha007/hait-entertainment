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
            'ticket_type_id' => 'required|array',
            'ticket_type_id.*' => 'nullable|numeric|exists:ticket_types,id',
            'rate' => 'required|array',
            'rate.*' => 'nullable|numeric',
            'seat' => 'required|array',
            'seat.*' => 'nullable|numeric',
            'address' => 'required|string',
            'event_type_id' => 'required|exists:event_types,id',
            'banner_image' => 'required|image|mimes:jpg,png,jpeg,webp,gif,svg',
            'background_image' => 'nullable|image|mimes:jpg,png,jpeg,webp,gif,svg'
        ];
    }

}
