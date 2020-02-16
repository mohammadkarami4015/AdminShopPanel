<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name' => 'string|max:255|nullable',
            'last_name' => 'string|max:255|nullable',
            'status' => 'string|max:255|nullable',
            'phone_number' =>  ['string', Rule::unique('users')->ignore($this->route('user'))]
        ];
    }
}
