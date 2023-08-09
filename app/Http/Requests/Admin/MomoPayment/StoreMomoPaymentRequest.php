<?php

namespace App\Http\Requests\Admin\MomoPayment;

use Illuminate\Foundation\Http\FormRequest;

class StoreMomoPaymentRequest extends FormRequest
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
            'partner_code'=> 'required|string',
            'order_id'=> 'required|string',
            'request_id'=> 'required|string',
            'amount'=> 'required|string',
            'order_info'=> 'required|string',
            'order_type'=> 'required|string',
            'trans_id'=> 'required|string',
            'pay_type'=> 'required|string',
            'response_time'=> 'required|string',
            'message'=> 'required|string',
            'users_id'=> 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'partner_code.required' => 'The partner code field is required.',
            'partner_code.string' => 'The partner code field must be a string.',
            'order_id.required' => 'The order ID field is required.',
            'order_id.string' => 'The order ID field must be a string.',

            'request_id.required' => 'The request ID field is required.',
            'request_id.string' => 'The request ID field must be a string.',

            'amount.required' => 'The amount field is required.',
            'amount.string' => 'The amount field must be a string.',

            'order_info.required' => 'The order info field is required.',
            'order_info.string' => 'The order info field must be a string.',

            'order_type.required' => 'The order type field is required.',
            'order_type.string' => 'The order type field must be a string.',

            'trans_id.required' => 'The transaction ID field is required.',
            'trans_id.string' => 'The transaction ID field must be a string.',

            'pay_type.required' => 'The payment type field is required.',
            'pay_type.string' => 'The payment type field must be a string.',

            'response_time.required' => 'The response time field is required.',
            'response_time.string' => 'The response time field must be a string.',

            'message.required' => 'The message field is required.',
            'message.string' => 'The message field must be a string.',

            'users_id.required' => 'The user ID field is required.',
            'users_id.string' => 'The user ID field must be a string.',
        ];
    }
}
