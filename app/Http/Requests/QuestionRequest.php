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
            'title'       => 'string|required',
            'question'       => 'string|required|max:500',
            'answer1'       => 'string|required|max:500',
            'answer2'       => 'string|required|max:500',
            'answer3'       => 'string|nullable|max:500',
            'answer4'       => 'string|nullable|max:500',
        ];
    }
}
