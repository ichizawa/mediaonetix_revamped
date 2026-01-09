<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // must be true for validation to run
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['required', 'string', 'max:20'],
            'dob' => ['required', 'date'],
            'password' => ['required', 'string', 'min:6'],
            'confirm_password' => ['required', 'same:password'],
            'account_type' => ['required', 'in:4,2'],
        ];
    }

    /**
     * Optional: custom error messages
     */
    public function messages(): array
    {
        return [
            'confirm_password.same' => 'Password confirmation does not match.',
            'account_type.in' => 'Invalid account type selected.',
        ];
    }
}
