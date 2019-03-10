<?php

namespace App\Http\Requests\Upload;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUploadRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules() // rules of storing a file
    {
        return [
            'file' => 'required|mimes:png,jpg,jpeg'
        ];
    }
}
