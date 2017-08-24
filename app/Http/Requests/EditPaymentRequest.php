<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditPaymentRequest extends FormRequest
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
            'expense' => 'required',
            'amount' => 'required|numeric',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'user.required' => 'Please choose an expense.',
            'amount.required' => 'Please give an amount.',
            'amount.numeric' => 'Amount should be a number.',
            'status.required' => 'Please choose payment status.',
        ];
    }
}