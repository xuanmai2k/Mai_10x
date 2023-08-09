<?php

namespace App\Http\Requests\Admin\Holiday;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHolidayRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name_of_date'=> 'required|min:1|max:255|string',
            'dayoff'=> 'required|date|after_or_equal:today',
        ];
    }

    public function messages():array {
        return [
            'name_of_date.required' => 'The name field is required.',
            'name_of_date.min' => 'The name must have at least :min character.',
            'name_of_date.max' => 'The name may not be greater than :max characters.',
            'name_of_date.string' => 'The name field must be a string.',

            'dayoff.required' => 'The date field is required.',
            'dayoff.date' => 'Please enter a valid date.',
            'dayoff.after_or_equal' => 'The date must be equal to or after today.',
        ];
    }

}
