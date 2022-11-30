<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'news_date' => ['required'],
            'description' => ['required', 'string', 'max:1500'],
            'status' => ['required'],
            'wallpaper' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:8000'],
        ];
    }
}
