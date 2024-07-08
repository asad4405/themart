<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Password;

class UserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'current_password' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'current_password.required' => 'Enter your Password',
            'password.required' => 'Enter your New Password',
            'password_confirmation.required' => 'Enter your Confirm Password',
        ];
    }
}
