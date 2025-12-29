<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PromoCodesRequest extends FormRequest
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
            'code' => 'required|string|unique:promos,slug',
            'value' => 'required|numeric',
            'type' => 'required|string',
            'valid' => 'required|date',
            'limit' => 'required|integer',
            'event_id' => 'required|exists:events,id',
        ];
    }
}
