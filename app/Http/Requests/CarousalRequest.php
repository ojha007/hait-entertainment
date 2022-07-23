<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarousalRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'image' => 'required|image|mimes:jpg,png,webp,jpeg'
        ];
    }
}
