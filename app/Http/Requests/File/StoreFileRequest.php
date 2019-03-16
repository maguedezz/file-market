<?php

namespace App\Http\Requests\File;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreFileRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    protected function validationData()
    {
        $this->merge(['uploads'=> $this->file->id]);
        return $this->all();
    }

    public function rules() // rules of storing a file
    {
        //$this->replace(['uploads'=> $this->file->id]);

        return [
            'title' => 'required|max:255',
            'overview_short' => 'required|max:300',
            'overview' => 'required|max:5000',
            'price' => 'required|numeric',
            'uploads' => [
                'required',
                Rule::exists('uploads', 'file_id')->where(function ($query) {
                    $query->whereNull('deleted_at');
                })
            ]
        ];
    }

     public function messages()
     {
         return [
            'uploads.exists' => 'Please upload at least one file.'
         ];
     }
}
