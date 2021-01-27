<?php

namespace App\Http\Requests\Shop;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ShopStoreRequest extends FormRequest
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
        return [
            'name' => 'required',
            'title' => 'required',
            'email' => 'required',
            'group_id' => 'required',
            'subgroup_id' => 'required',
            'country_id' => 'required',
            'city_id' => 'required',
            'address' => 'required',
            'min_order_price' => 'required',
            'phone_number' => [
                'required',
                'digits:11',
                'numeric',
                Rule::unique('shops','phone_number')
            ]
        ];
    }
}
