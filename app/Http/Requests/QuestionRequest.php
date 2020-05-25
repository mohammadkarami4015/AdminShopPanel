<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class QuestionRequest extends FormRequest
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
            'test_id'       => 'string|required',
            'question'       => 'string|required|max:500',
            'answers'       => 'array|required|max:500',
            'values'       => 'array|required|max:500',
            'valuex'       => 'array|nullable|max:500',
        ];
    }
}
