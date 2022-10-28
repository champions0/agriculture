<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'surname' => ['nullable', 'string', 'max:255'],
            'soc_number' => ['nullable', 'string', 'max:20'],
//            'number' => ['required', 'string', 'max:255'],
            'passport' => ['nullable', 'string', 'max:20'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'country_code' => ['required', 'string', 'max:10'],
            'phone' => ['required', 'string', 'max:20'],
            'region' => ['nullable', 'string', 'max:50'],
            'address' => ['required', 'string', 'max:255'],
            'birth_date' => ['required', 'string', 'max:50'],
            'gender' => ['nullable', 'string', 'max:10'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:5000'],
        ];
    }
}
