<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GroupRequest extends FormRequest
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
                    Rule::unique('groups', 'title')
                ],
                'type' => [
                    'required'
                ],
                'status' => [
                    'required',
                    Rule::in(['on', 'off'])
                ],
            ];
        else
            return [
                'title' => [
                    'required',
                    Rule::unique('groups', 'title')->ignore($this->group->id)
                ],
                'type' => [
                    'required'
                ],
                'status' => [
                    'required',
                    Rule::in(['on', 'off'])
                ],
            ];
    }
}
