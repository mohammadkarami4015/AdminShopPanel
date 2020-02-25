<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FinancialRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'amount' => 'required|string|max:255',
            'card_number' => 'required|string|max:255',
            'sheba' => 'required|string|max:255',
        ];
    }
}
