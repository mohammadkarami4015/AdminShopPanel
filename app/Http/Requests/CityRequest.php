<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CityRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->isMethod('post'))
            return [
                'title' => [
                    'required',
                    Rule::unique('cities', 'title')
                ],
                'country_id' => [
                    'required',
                    Rule::exists('countries', 'id')
                ],
                'status' => [
                    'required',
                    Rule::in(['on','off'])
                ]
            ];
        else
            return [
                'title' => [
                    'required',
                    Rule::unique('cities', 'title')->ignore($this->city->id)
                ],
                'country_id' => [
                    'required',
                    Rule::exists('countries', 'id')
                ],'status' => [
                    'required',
                    Rule::in(['on','off'])
                ]
            ];
    }
}
