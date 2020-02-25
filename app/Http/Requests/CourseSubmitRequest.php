<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseSubmitRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'user_id' => 'required|string',
            'present_course_id' => 'required|string',
            'time' => 'required|string',
        ];
    }
}
