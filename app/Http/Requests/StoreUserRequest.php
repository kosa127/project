<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|unique:users|max:30|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|max:60|min:6'
        ];

    }

    public function messages()
    {
        return [
            'name.required' => 'Name field can not be empty.',
            'name.unique' => 'User with that name already exists.',
            'name.min.max' => '',
            'email.required' => 'Email field can not be empty.',
            'email.email' => 'Please check your email format.',
            'email.unique' => 'This email is already in use.',
            'password.required' => 'Password field can not be empty.',
            'password.min.max' => '',
        ];
    }
}
