<?php

namespace App\Http\Requests\Admin\ProductCategory;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductCategoryRequest extends FormRequest
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
            'name'=> 'required|min:1|max:255|string|unique:product_category,name,'.$this->id,
            'slug'=> 'required|alpha_dash',
            'minimum_limit_age'=> 'required|numeric|lte:maximum_limit_age|between:0,100',
            'maximum_limit_age'=> 'required|numeric|gte:minimum_limit_age|between:0,100',
            'quantity_for_injection' => 'required|numeric|min:1',
            'status'=> 'required|boolean',
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

            'minimum_limit_age.required' => 'The minimum limit age field is required.',
            'minimum_limit_age.numeric' => 'The minimum limit age must be a number.',
            'minimum_limit_age.lte' => 'The minimum limit age must be less than or equal to the maximum limit age.',
            'minimum_limit_age.between' => 'The minimum limit age must be between :min and :max.',

            'maximum_limit_age.required' => 'The maximum limit age field is required.',
            'maximum_limit_age.numeric' => 'The maximum limit age must be a number.',
            'maximum_limit_age.gte' => 'The maximum limit age must be greater than or equal to the minimum limit age.',
            'maximum_limit_age.between' => 'The maximum limit age must be between :min and :max.',

            'quantity_for_injection.required' => 'The quantity for injection field is required.',
            'quantity_for_injection.numeric' => 'The quantity for injection must be a number.',
            'quantity_for_injection.min' => 'The quantity for injection must be at least :min.',

            'status.required' => 'The status field is required.',
            'status.boolean' => 'The status must be either true or false.',
        ];
    }
}
