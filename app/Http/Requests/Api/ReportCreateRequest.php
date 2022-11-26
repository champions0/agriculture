<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class ReportCreateRequest extends FormRequest
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
            'category_id' => ['required'],
            'address' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'is_anonymous' => ['required'],
//            'images' => ['required', 'array'],
            'files' => ['required', 'array', 'max:10'],
            'files.*' => ['file', 'mimes:jpeg,png,jpg,pdf,word', 'max:5000'],
        ];
    }
}
