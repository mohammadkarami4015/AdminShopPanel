<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'sub_title' => 'required|string|max:255',
            'sub_desc' => 'required|string|max:50000',
            'desc' => 'required|string|max:50000',
            'photo' => 'nullable|file',
        ];
    }
}
