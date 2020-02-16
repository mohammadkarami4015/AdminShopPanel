<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdviserRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string',
            'other_phone_number' => 'string|nullable',
            'email' => 'string|max:255|nullable',
            'instagram' => 'string|max:255|nullable',
            'telegram' => 'string|max:255|nullable',
            'type' => 'string|max:255|nullable',
            'old' => 'string|max:255|nullable',
            'description' => 'string|max:500|nullable',
            'cv' => 'string|max:500|nullable',
            'status' => 'string|max:255|nullable',
        ];
    }
}
