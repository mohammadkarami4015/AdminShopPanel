<?php

namespace App\Http\Requests\Shop;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ShopCategoryRequest extends FormRequest
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
        if ($this->isMethod('patch')) {
            return [
                'title' => [
                    'required',
                    Rule::unique('shop_categories', 'title')
                        ->whereNull('deleted_at')
                        ->ignore($this->shopCategory->id)
                ],
                'status' => [
                    'required',
                    Rule::in('on', 'off')
                ]

            ];
        } else
            return [
                'title' => [
                    'required',
                    Rule::unique('shop_categories', 'title')
                        ->whereNull('deleted_at')->where('shop_id', $this->shop->id)
                ],
                'status' => [
                    'required',
                    Rule::in('on', 'off')
                ]


            ];
    }
}
