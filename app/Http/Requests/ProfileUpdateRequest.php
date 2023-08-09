<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'=> 'required|min:1|max:255|string',//'name' => ['string', 'max:255'],
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'phone'=>'regex:/^(0[0-9]{9,10})$/', //'phone' => ['string', 'max:20'],
            'dob' => 'date|before_or_equal:today',//'dob'=> ['date'],
            'image_url'=>'mimes:jpeg,png,jpg',//'image_url'=> ['string', 'max:255'],
        ];
    }

    public function messages(): array
{
    return [
        'name.required' => 'Please enter a name.',
        'name.min' => 'The name must be at least 1 character.',
        'name.max' => 'The name must not exceed 255 characters.',
        'name.string' => 'The name must be a string.',

        'email.email' => 'Please enter a valid email address.',
        'email.max' => 'The email address must not exceed 255 characters.',
        'email.unique' => 'The email address has already been taken.',

        'phone.regex' => 'Please enter a valid phone number.',

        'dob.date' => 'Please enter a valid date of birth.',
        'dob.before_or_equal' => 'The date of birth must be before or equal to the current date.',

        'image_url.mimes' => 'Please only upload images in JPEG, PNG, or JPG format.',
    ];
}
}
