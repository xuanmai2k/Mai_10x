<?php

namespace App\Http\Requests\Admin\Contact;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
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
            'name'=> 'required|min:1|max:255|string',
            'email'=> 'required|email',
            'phone'=> 'required|regex:/^(0[0-9]{9,10})$/',
            'content'=> 'required|min:1|max:512|string',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.min' => 'The name must have at least :min character.',
            'name.max' => 'The name may not be greater than :max characters.',
            'name.string' => 'The name field must be a string.',

            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',

            'phone.required' => 'The phone field is required.',
            'phone.regex' => 'Please enter a valid phone number (starting with 0 and followed by 9 to 10 digits).',

            'content.required' => 'The content field is required.',
            'content.min' => 'The content must have at least :min character.',
            'content.max' => 'The content may not be greater than :max characters.',
            'content.string' => 'The content field must be a string.',
        ];
    }
}
