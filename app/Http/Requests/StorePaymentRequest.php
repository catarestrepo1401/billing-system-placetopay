<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'invoice' => ['required'],
            'identifier' => [
                'required',
                Rule::unique('payments', 'identifier')
            ],
            'method' => [
                'required',
                Rule::in([
                    'debit_card',
                    'credit_card',
                    'cash',
                    'bank_payment',
                    'bank_check',
                    'electronic_transfer'
                ])
            ],
            'amount' => ['required', 'numeric', 'min:0', 'max:' . $this->amount],
        ];
    }
}
