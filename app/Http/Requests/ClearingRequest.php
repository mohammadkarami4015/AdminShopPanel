<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClearingRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'amount' => 'required|string|max:255',
            'sheba' => 'nullable|string|max:255',
            'card_number' => 'nullable|string|max:255',
            'type' => 'required|string|max:255',
            'payment_request_id' => 'required|string|max:255',
        ];
    }
}
