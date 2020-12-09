<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminRequest extends FormRequest
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
        if ($this->isMethod('POST'))
            return [
                'name' => 'string|required',
                'last_name' => 'string|required',
                'email' => ['string', 'email', 'required', 'max:255', Rule::unique('admins', 'email')->ignore($this->route('admin'))],
                'phone_number' => ['digits:11', 'required', 'max:255', Rule::unique('admins', 'phone_number')->ignore($this->route('admin'))],
                'password' => 'string|required|confirmed|max:255',
                'status' => ['required', Rule::in(['on', 'off'])],
            ];
        else
            return [
                'name' => 'string|required',
                'last_name' => 'string|required',
                'email' => ['string', 'email', 'required', 'max:255', Rule::unique('admins', 'email')->ignore($this->route('admin'))],
                'phone_number' => ['digits:11', 'required', 'max:255', Rule::unique('admins', 'phone_number')->ignore($this->route('admin'))],
            ];
    }
}
