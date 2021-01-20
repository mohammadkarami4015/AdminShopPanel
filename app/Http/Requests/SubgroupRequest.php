<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SubgroupRequest extends FormRequest
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
                    Rule::unique('subgroups', 'title')
                ],
                'group_id' => [
                    'required',
                    'numeric',
                    Rule::exists('groups', 'id')
                ],

            ];
        else
            return [
                'title' => [
                    'required',
                    Rule::unique('subgroups', 'title')->ignore($this->subgroup->id)
                ],
                'group_id' => [
                    'required',
                    'numeric',
                    Rule::exists('groups', 'id')
                ],
            ];
    }
}
