<?php

namespace App\Http\Requests\Admin\Service;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceRequest extends FormRequest
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
            'name'=> 'required|min:1|max:255|string|unique:service,name,'.$this->id,
            'slug'=> 'required|alpha_dash',
            'price'=> 'required|numeric|regex:/^\d{1,11}$/',
            'short_description'=> 'required|min:1|max:255|string',
            'description'=> 'required|min:10',
            'status'=> 'required|boolean',
            'image_url'=>'mimes:jpeg,png,jpg',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.min' => 'The name must have at least :min character.',
            'name.max' => 'The name may not be greater than :max characters.',
            'name.string' => 'The name field must be a string.',
            'name.unique' => 'The name has already been taken.',

            'slug.required' => 'The slug field is required.',
            'slug.alpha_dash' => 'The slug may only contain letters, numbers, dashes, and underscores.',

            'price.required' => 'The price field is required.',
            'price.numeric' => 'The price must be a number.',
            'price.regex' => 'The price must be a decimal number with up to 11 digits.',

            'short_description.required' => 'The short description field is required.',
            'short_description.min' => 'The short description must have at least :min character.',
            'short_description.max' => 'The short description may not be greater than :max characters.',
            'short_description.string' => 'The short description field must be a string.',

            'description.required' => 'The description field is required.',
            'description.min' => 'The description must have at least :min character.',

            'status.required' => 'The status field is required.',
            'status.boolean' => 'The status must be either true or false.',

            'image_url.mimes' => 'The image must be a file of type: jpeg, png, jpg.',
        ];
    }
}
