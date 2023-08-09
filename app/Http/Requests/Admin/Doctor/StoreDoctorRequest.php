<?php

namespace App\Http\Requests\Admin\Doctor;

use Illuminate\Foundation\Http\FormRequest;

class StoreDoctorRequest extends FormRequest
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
            'slug'=> 'required|alpha_dash',
            'email'=> 'required|email',
            'phone'=> 'required|regex:/^(0[0-9]{9,10})$/',
            'position'=> 'required|min:1|max:255|string',
            'short_information'=> 'required|min:1|max:255|string',
            'information'=> 'required|min:10',
            'image_url'=>'required|mimes:jpeg,png,jpg',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.min' => 'The name must have at least :min character.',
            'name.max' => 'The name may not be greater than :max characters.',
            'name.string' => 'The name field must be a string.',

            'slug.required' => 'The slug field is required.',
            'slug.alpha_dash' => 'The slug may only contain letters, numbers, dashes, and underscores.',

            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',

            'phone.required' => 'The phone field is required.',
            'phone.regex' => 'Please enter a valid phone number (starting with 0 and followed by 9 to 10 digits).',

            'position.required' => 'The position field is required.',
            'position.min' => 'The position must have at least :min character.',
            'position.max' => 'The position may not be greater than :max characters.',
            'position.string' => 'The position field must be a string.',

            'short_information.required' => 'The short information field is required.',
            'short_information.min' => 'The short information must have at least :min character.',
            'short_information.max' => 'The short information may not be greater than :max characters.',
            'short_information.string' => 'The short information field must be a string.',

            'information.required' => 'The information field is required.',
            'information.min' => 'The information must have at least :min character.',

            'image_url.required' => 'The image field is required.',
            'image_url.mimes' => 'The image must be a file of type: jpeg, png, jpg.',
        ];
    }
}
