<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'details' => ['nullable', 'string'],
            'status' => ['required', 'string', 'max:50'],
            'priority' => ['required', 'string', 'max:50'],
            'due_date' => ['nullable', 'date'],
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
            'title.required' => 'The title field is required.',
            'title.string' => 'The title must be a string.',
            'title.max' => 'The title may not be greater than 255 characters.',
            'details.string' => 'The details must be a string.',
            'status.required' => 'The status field is required.',
            'status.string' => 'The status must be a string.',
            'status.max' => 'The status may not be greater than 50 characters.',
            'priority.required' => 'The priority field is required.',
            'priority.string' => 'The priority must be a string.',
            'priority.max' => 'The priority may not be greater than 50 characters.',
            'due_date.date' => 'The due date must be a valid date.',
        ];
    }
}
