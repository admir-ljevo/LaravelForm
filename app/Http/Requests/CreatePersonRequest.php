<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePersonRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'married' => 'required|string|max:255',
            'date_of_marriage' => 'nullable|date',
            'marriage_country' => 'nullable|string|max:255',
            'widowed' => 'required|boolean',
            'previous_marriage' => 'required|boolean',
        ];
    }
}
