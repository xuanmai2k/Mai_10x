<?php

namespace App\Http\Requests\VnpayPayment;

use Illuminate\Foundation\Http\FormRequest;

class StoreVnpayPaymentRequest extends FormRequest
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
            'vnp_amount' => 'required|string',
            'vnp_bankcode' => 'required|string',
            'vnp_banktranno' => 'required|string',
            'vnp_cardtype' => 'required|string',
            'vnp_orderinfo' => 'required|string',
            'vnp_paydate' => 'required|string',
            'vnp_tmncode' => 'required|string',
            'vnp_transactionno' => 'required|string',
            'vnp_transactionstatus' => 'required|string',
            'users_id'=>'required|exists:users,id',
        ];
    }

    public function messages(): array
    {
        return [
            'vnp_amount.required' => 'The VNP amount field is required.',
            'vnp_amount.string' => 'The VNP amount field must be a string.',
            'vnp_bankcode.required' => 'The VNP bank code field is required.',
            'vnp_bankcode.string' => 'The VNP bank code field must be a string.',

            'vnp_banktranno.required' => 'The VNP bank transaction number field is required.',
            'vnp_banktranno.string' => 'The VNP bank transaction number field must be a string.',

            'vnp_cardtype.required' => 'The VNP card type field is required.',
            'vnp_cardtype.string' => 'The VNP card type field must be a string.',

            'vnp_orderinfo.required' => 'The VNP order info field is required.',
            'vnp_orderinfo.string' => 'The VNP order info field must be a string.',

            'vnp_paydate.required' => 'The VNP pay date field is required.',
            'vnp_paydate.string' => 'The VNP pay date field must be a string.',

            'vnp_tmncode.required' => 'The VNP merchant code field is required.',
            'vnp_tmncode.string' => 'The VNP merchant code field must be a string.',

            'vnp_transactionno.required' => 'The VNP transaction number field is required.',
            'vnp_transactionno.string' => 'The VNP transaction number field must be a string.',

            'vnp_transactionstatus.required' => 'The VNP transaction status field is required.',
            'vnp_transactionstatus.string' => 'The VNP transaction status field must be a string.',

            'users_id.required' => 'The user ID field is required.',
            'users_id.exists' => 'The selected user is invalid.',
        ];
    }
}
