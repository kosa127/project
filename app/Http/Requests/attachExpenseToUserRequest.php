<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class attachExpenseToUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'name' => 'required|max:30|min:3',
            'user' => 'required',
            'amount' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name field can not be empty.',
            'name.min.max' => '',
            'user.required' => 'Please choose a user.',
            'amount.required' => 'Please give an amount.',
            'amount.numeric' => 'Amount should be a number.'
        ];
    }
}
