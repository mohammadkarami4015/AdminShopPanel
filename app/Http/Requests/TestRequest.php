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
            'desc'       => 'string|required',
            'sub_desc'       => 'string|required',
            'type'       => 'string|nullable|max:255',
            'photo'       => 'nullable',
            'price'       => 'string|nullable|max:255',
        ];
    }
}
