<?php

namespace App\Http\Requests\Dashboard;

use App\Services\NotificationService;
use Illuminate\Foundation\Http\FormRequest;

class NotificationCreateRequest extends FormRequest
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
            'number' => [
                'required', 'string', 'max:255',
                function ($attribute, $value, $fail) {
                    $number = NotificationService::checkNumber($value);

                    if ($number == null) {
                        $fail('Նման օգտատեր չի գտնվել');
                    }
                },
            ],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'type' => ['nullable'],
            'status' => ['nullable'],
            'icon' => ['nullable'],
        ];
    }
}
