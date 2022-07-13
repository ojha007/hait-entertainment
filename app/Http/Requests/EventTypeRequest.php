<?php

namespace App\Http\Requests;

use App\Requests\FormRequestForApi;

class EventTypeRequest extends FormRequestForApi
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:2'
        ];
    }

    /**
     * @return bool
     */
    public function authorization(): bool
    {
        return true;
    }
}
