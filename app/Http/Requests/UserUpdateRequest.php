<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name'       => 'string|required',
            'email'       => ['string','required','max:255', Rule::unique('users')->ignore($this->route('user'))],
            'phone_number'       => ['string','required','max:255', Rule::unique('users')->ignore($this->route('user'))],
            'type'       => 'string|nullable|max:255',
            'about_me'       => 'string|nullable|max:1000',
            'level'       => 'string|nullable|max:255',
            'card_number'       => 'string|nullable|max:255',
            'sheba'       => 'string|nullable|max:255',
            'national_id'       =>  ['string','required','max:255', Rule::unique('users')->ignore($this->route('user'))],
            'password'       => 'string|nullable|confirmed|max:255',
        ];
    }
}
