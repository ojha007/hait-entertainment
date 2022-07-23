<?php

namespace App\Http\Requests;

use App\Requests\FormRequestForApi;

class PartnerRequest extends FormRequestForApi
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:2',
            'image' => 'required|image|mimes:jpg,png,jpeg'
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
