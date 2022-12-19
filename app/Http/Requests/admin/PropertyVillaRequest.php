<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class PropertyVillaRequest extends FormRequest
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
            "property_villa_name" => ['required'],
            "location" => ['required'],
            "description" => ['required', 'min:10'],
            "price" => ['required', 'numeric', 'min:5'],
            "category" => ['required'],
            "img_thumbnail" => ['required', 'image', 'file', 'mimes:png,jpg', 'max:2048']
        ];
    }
}
