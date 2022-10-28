<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class FastQuestion extends FormRequest
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
            'category_id' => ['required', 'numeric'],
            'address' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'is_anonymous' => ['required'],
//            'images' => ['required', 'array'],
            'images' => ['required', 'array', 'max:10'],
            'images.*' => ['image', 'mimes:jpeg,png,jpg', 'max:5000'],
        ];
    }
}
