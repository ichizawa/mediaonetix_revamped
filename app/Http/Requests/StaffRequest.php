<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StaffRequest extends FormRequest
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username' . ($this->id ? (',' . $this->id) : ''),
            'email' => 'required|email|max:255|unique:users,email' . ($this->id ? (',' . $this->id) : ''),
            'phone_number' => 'required|string|max:20|unique:users,phone_number' . ($this->id ? (',' . $this->id) : ''),
            'password' => ($this->isMethod('put') || $this->isMethod('patch') ? 'nullable' : 'required') . '|string|min:6',
            'security_pin' => ($this->isMethod('put') || $this->isMethod('patch') ? 'nullable' : 'required') . '|string|min:4|max:6',
            'event_id' => 'required|exists:events,id',
            'permission_name' => ($this->isMethod('put') || $this->isMethod('patch') ? 'nullable' : 'required') . '|array|min:1',
            'permission_name.*' => 'string|max:255',
        ];
    }


    public function messages(): array
    {
        return [
            'security_pin.min' => 'The security pin must be at least 4 characters.',
            'security_pin.max' => 'The security pin may not be greater than 6 characters.',
            'permission_name.required' => 'The permission name is required.',
        ];
    }
}
