<?php

namespace App\Http\Requests\Admin\Vaccine;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name_product'=> 'required|min:1|max:255|unique:product,name_product,'.$this->id,
            'slug'=> 'required|alpha_dash',
            'product_category_id' => 'required|exists:product_category,id',
            'price'=> 'required|numeric|integer|gt:0',
            'made_in'=> 'required|min:1|max:255|string',
            'short_description'=> 'required|min:1|max:255|string',
            'description'=> 'required|min:1',
            'information'=> 'required|min:1|max:255|string',
            'qty'=> 'required|numeric|gt:0',
            'dosage'=> 'required|numeric',
            'status'=> 'required|boolean',
            'image_url'=>'mimes:jpeg,png,jpg',
        ];
    }

    public function messages(): array
    {
        return [
            'name_product.required' => 'The product name field is required.',
            'name_product.min' => 'The product name must have at least :min character.',
            'name_product.max' => 'The product name may not be greater than :max characters.',
            'name_product.unique' => 'The product name has already been taken.',

            'slug.required' => 'The slug field is required.',
            'slug.alpha_dash' => 'The slug may only contain letters, numbers, dashes, and underscores.',

            'product_category_id.required' => 'The product category field is required.',
            'product_category_id.exists' => 'The selected product category is invalid.',

            'price.required' => 'The price field is required.',
            'price.numeric' => 'The price must be a number.',
            'price.integer' => 'The price must be an integer.',
            'price.gt' => 'The price must be greater than 0.',

            'made_in.required' => 'The made in field is required.',
            'made_in.min' => 'The made in must have at least :min character.',
            'made_in.max' => 'The made in may not be greater than :max characters.',
            'made_in.string' => 'The made in field must be a string.',

            'short_description.required' => 'The short description field is required.',
            'short_description.min' => 'The short description must have at least :min character.',
            'short_description.max' => 'The short description may not be greater than :max characters.',
            'short_description.string' => 'The short description field must be a string.',

            'description.required' => 'The description field is required.',
            'description.min' => 'The description must have at least :min character.',

            'information.required' => 'The information field is required.',
            'information.min' => 'The information must have at least :min character.',
            'information.max' => 'The information may not be greater than :max characters.',
            'information.string' => 'The information field must be a string.',

            'qty.required' => 'The quantity field is required.',
            'qty.numeric' => 'The quantity must be a number.',
            'qty.gt' => 'The quantity must be greater than 0.',

            'dosage.required' => 'The dosage field is required.',
            'dosage.numeric' => 'The dosage must be a number.',

            'status.required' => 'The status field is required.',
            'status.boolean' => 'The status must be either true or false.',

            'image_url.mimes' => 'The image must be a file of type: jpeg, png, jpg.',
        ];
    }
}
