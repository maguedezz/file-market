<?php

namespace App\Http\Requests\File;

use Illuminate\Foundation\Http\FormRequest;

class StoreFileRequest extends FormRequest
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

    public function rules() // rules of storing a file
    {
        return [
            'title' => 'required|max:255',
            'overview_short' => 'required|max:300',
            'overview' => 'required|max:5000',
            'price' => 'required|numeric',
            
        ];
    }
}
