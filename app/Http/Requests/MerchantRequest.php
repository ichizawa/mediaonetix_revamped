<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MerchantRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
            'phone_number' => 'required|string|max:20|unique:users,phone_number',
            'dob' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'country' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'zip_code' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'password' => 'required|string|min:8|confirmed',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }

    /**
     * Custom validation messages (optional)
     */
    public function messages(): array
    {
        return [
            'password.confirmed' => 'Password confirmation does not match.',
        ];
    }
}
