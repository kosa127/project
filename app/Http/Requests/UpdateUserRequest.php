<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => 'required|max:30|min:3',
            'email' => 'required|email',
            'password' => 'required|max:60|min:6'
        ];

    }

    public function messages()
    {
        return [
            'name.required' => 'Name field can not be empty.',
            'name.min.max' => '',
            'email.required' => 'Email field can not be empty.',
            'email.email' => 'Please check your email format.',
            'password.required' => 'Password field can not be empty.',
            'password.min.max' => '',
        ];
    }
}