<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TestRequest extends FormRequest
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
            'title'       => 'string|required',
            'desc'       => 'string|required|max:255',
            'type'       => 'string|required|max:255',
            'photo'       => 'nullable',
            'price'       => 'string|nullable|max:255',
        ];
    }
}
