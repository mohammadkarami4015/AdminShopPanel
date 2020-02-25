<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PresentCourseRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'course_id' => 'required|string',
            'desc' => 'required|string',
            'times' => 'required|array',
            'capacity' => 'required|string|max:255',
            'submit_date' => 'required|string|max:255',
            'start_date' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ];
    }
}
