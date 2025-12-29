<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketsRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:155',
            'event_id' => 'required|exists:events,id',
            'status' => 'nullable|integer|in:0,1,2',
            'price' => 'required|numeric',
            'color' => 'required|string|size:7',
            'quantity' => 'required|integer'
        ];
    }
}
