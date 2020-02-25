<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResultRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'value' => 'required|string',
            'tip' => 'required|string|max:255',
            'test_id' => 'required|string|max:255',
        ];
    }
}
