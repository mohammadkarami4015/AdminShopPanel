<?php

namespace App\Http\Requests\Shop;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
            'title' => 'required',
            'desc' => 'nullable|sometimes',
            'inventory' => 'required|numeric',
            'shop_category_id' => 'required|numeric',
            'price' => 'required|numeric',
            'price_with_discount' => 'nullable|sometimes',
            'admin_verification'=>'required',
            'status'=>'required',
            'installment' => 'sometimes',
            'installment_flag' => 'sometimes',
        ];
    }
}
