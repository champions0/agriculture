<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UserRegistrationStep2Request extends FormRequest
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
            'user_id' => ['required'],
            'soc_number' => ['required', 'string', 'max:20'],
            'region' => ['nullable', 'string', 'max:50'],
            'address' => ['required', 'string', 'max:255'],
            'birth_date' => ['required', 'string', 'max:50'],
            'gender' => ['nullable', 'string', 'max:10'],
        ];
    }
}
