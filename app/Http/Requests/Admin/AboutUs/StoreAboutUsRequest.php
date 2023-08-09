<?php

namespace App\Http\Requests\Admin\AboutUs;

use Illuminate\Foundation\Http\FormRequest;

class StoreAboutUsRequest extends FormRequest
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
            'description'=> 'required|min:10|max:4000|string',
        ];
    }

    public function messages(): array
    {
        return [
            'description.required' => 'The description field is required.',
            'description.min' => 'The description must have at least :min character.',
            'description.max' => 'The description may not be greater than :max characters.',
            'description.string' => 'The description field must be a string.',
        ];
    }
}
