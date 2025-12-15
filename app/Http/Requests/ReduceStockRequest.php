<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReduceStockRequest extends FormRequest
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
            'amount' => ['required', 'integer', 'min:1'],
        ];
    }

    /**
     * Get custom error messages for validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'amount.required' => 'The amount field is required.',
            'amount.integer' => 'The amount must be an integer.',
            'amount.min' => 'The amount must be at least 1.',
        ];
    }
}
