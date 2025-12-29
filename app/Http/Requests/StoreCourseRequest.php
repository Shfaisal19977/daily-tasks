<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'teacher_id' => ['required', 'integer', 'exists:teachers,id'],
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
            'name.required' => 'The course name field is required.',
            'name.string' => 'The course name must be a string.',
            'name.max' => 'The course name may not be greater than 255 characters.',
            'teacher_id.required' => 'The teacher field is required.',
            'teacher_id.integer' => 'The teacher must be a valid teacher ID.',
            'teacher_id.exists' => 'The selected teacher does not exist.',
        ];
    }
}
