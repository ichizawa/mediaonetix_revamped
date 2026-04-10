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
        // Get the merchant ID from the route parameter (e.g., from admin/merchants/update/{id})
        $merchantId = $this->input('merchant_id');
        // Base rules that apply to BOTH creating and updating
        $rules = [
            'name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'dob' => 'required|date',
            'gender' => 'required|in:male,female,other,prefer_not_to_say', 
            'country' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'zip_code' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];

        if ($this->isMethod('POST')) {
            // Rules for CREATING
            $rules['username'] = 'required|string|max:255|unique:users,username';
            $rules['email'] = 'required|email|max:255|unique:users,email';
            $rules['phone_number'] = 'required|string|max:20|unique:users,phone_number';
            $rules['password'] = 'required|string|min:8|confirmed';
        } 
        elseif ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            // Rules for UPDATING
            // Now $merchantId is guaranteed to exist because of the hidden input
            $rules['username'] = 'required|string|max:255|unique:users,username,' . $merchantId;
            $rules['email'] = 'required|email|max:255|unique:users,email,' . $merchantId;
            $rules['phone_number'] = 'required|string|max:20|unique:users,phone_number,' . $merchantId;
            $rules['password'] = 'nullable|string|min:8|confirmed'; 
        }

        return $rules;
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
