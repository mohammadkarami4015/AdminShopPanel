<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'title' => 'string|max:255',
            'message' => 'required|string|max:500',
            'phone_number' => 'required|string|max:255',
            'type' => 'required|string',
        ];
    }
}
