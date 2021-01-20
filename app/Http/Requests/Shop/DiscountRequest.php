<?php

namespace App\Http\Requests\Shop;

use Illuminate\Foundation\Http\FormRequest;

class DiscountRequest extends FormRequest
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
        if ($this->isMethod('POST'))
            return [
                'title' => 'required',
                'type' => 'required',
                'percent' => 'required|numeric',
                'max_discount_price' => 'required|numeric',
                'number_of_usage' => 'required|numeric',
                'number_of_usage_for_user' => 'required|numeric',
                'expire' => 'required',
            ];
        else
            return [
                'title' => 'required',
                'type' => 'required',
                'percent' => 'required|numeric',
                'max_discount_price' => 'required|numeric',
                'number_of_usage' => 'required|numeric',
                'number_of_usage_for_user' => 'required|numeric',
            ];
    }
}
