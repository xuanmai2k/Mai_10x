<?php

namespace App\Http\Requests\Admin\Appointment;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class StoreAppointmentRequest extends FormRequest
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
            'name'=>'required|min:1|max:255|string',
            'email'=> 'required|email',
            'phone'=> 'required|regex:/^(0[0-9]{9,10})$/',
            'age' => 'required|numeric|min:0|max:100',
            'users_id'=>'required|exists:users,id',
            'doctor_id'=> 'required|exists:doctor,id',
            'nurse_id'=> 'required|exists:nurse,id',
            'product_category_id'=> 'required|exists:product_category,id',
            'product_id'=>'required|exists:product,id',
            'date_appointment' => 'required|date|after_or_equal:today',
            'time_appointment' => 'required',
            'total_price'=>'required|numeric|integer|min:0',
            'status'=>'required|integer|in:1,2,3',
            'pay_by'=>'required|integer|in:0,1,2',
            'rating' => 'numeric|min:0|max:5',
            'comment'=> 'string|min=1',
            'status_payment'=>'string|max:255',
        ];
    }

    public function messages():array {
        return [
            'name.required' => 'The name field is required.',
            'name.min' => 'The name must have at least :min characters.',
            'name.max' => 'The name may not be greater than :max characters.',
            'name.string' => 'The name field must be a string.',

            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',

            'phone.required' => 'The phone number field is required.',
            'phone.regex' => 'Please enter a valid phone number.',

            'age.required' => 'The age field is required.',
            'age.numeric' => 'The age must be a numeric value.',
            'age.min' => 'The age must be at least :min.',
            'age.max' => 'The age may not be greater than :max.',

            'doctor_id.required' => 'The doctor ID field is required.',
            'doctor_id.exists' => 'The selected doctor is invalid.',

            'nurse_id.required' => 'The nurse ID field is required.',
            'nurse_id.exists' => 'The selected nurse is invalid.',

            'product_category_id.required' => 'The product category ID field is required.',
            'product_category_id.exists' => 'The selected product category is invalid.',

            'product_id.required' => 'The product ID field is required.',
            'product_id.exists' => 'The selected product is invalid.',

            'date_appointment.required' => 'The appointment date field is required.',
            'date_appointment.date' => 'Please enter a valid date format.',
            'date_appointment.after_or_equal' => 'The appointment date must be equal to or after today.',

            'time_appointment.required' => 'Please enter a time for the appointment.',
            // 'time_appointment.date_format' => 'Please enter a valid time in the format HH:MM.',
            // 'time_appointment.between' => 'The appointment time must be between 08:00 and 18:00.',

            'total_price.required' => 'The total price field is required.',
            'total_price.numeric' => 'The total price must be a numeric value.',
            'total_price.integer' => 'The total price must be an integer.',
            'total_price.min' => 'The total price must be at least :min.',

            'status.required' => 'The status field is required.',
            'status.integer' => 'The status must be an integer.',
            'status.in' => 'The selected status is invalid.',

            'pay_by.required' => 'The payment method field is required.',
            'pay_by.integer' => 'The payment method must be an integer.',
            'pay_by.in' => 'The selected payment method is invalid.',

            'rating.numeric' => 'The rating must be a numeric value.',
            'rating.min' => 'The rating must be at least :min.',
            'rating.max' => 'The rating may not be greater than :max.',

            'comment.string' => 'The comment field must be a string.',
            'comment.min' => 'The comment must have at least :min characters.',

            'status_payment.string' => 'The payment status field must be a string.',
            'status_payment.max' => 'The payment status may not be greater than :max characters.',
        ];
    }
}
