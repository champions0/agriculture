<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class EventUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'subject_id' => ['required', 'numeric'],
            'wallpaper' => ['image', 'mimes:jpeg,png,jpg', 'max:8000'],
            'short_description' => ['required', 'string', 'max:1000'],
            'age' => ['required', 'string', 'max:20'],
            'gender' => ['required', 'string', 'max:50'],
            'organizer' => ['required', 'string', 'max:255'],
            'start_date' => ['required', 'string', 'max:50'],
            'end_date' => ['required', 'string', 'max:50'],
            'address' => ['required', 'string', 'max:255'],
            'additional_info' => ['required', 'string', 'max:500'],
            'status' => ['required', 'string', 'max:20'],
        ];
    }
}
