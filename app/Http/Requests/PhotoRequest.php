<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhotoRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'type' => 'string',/*type: post_photos = post photos  type: server_photo = adviser*/
            'file' => 'max:100000000000000',
            'base64_photo' => 'string',
        ];
    }
}
