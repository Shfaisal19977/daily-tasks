<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
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
            'title' => ['sometimes', 'string', 'max:255'],
            'author' => ['sometimes', 'string', 'max:255'],
            'publication_year' => ['sometimes', 'integer', 'digits:4', 'min:1000', 'max:9999'],
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
            'title.string' => 'The title must be a string.',
            'title.max' => 'The title may not be greater than 255 characters.',
            'author.string' => 'The author must be a string.',
            'author.max' => 'The author may not be greater than 255 characters.',
            'publication_year.integer' => 'The publication year must be a number.',
            'publication_year.digits' => 'The publication year must be exactly 4 digits.',
            'publication_year.min' => 'The publication year must be at least 1000.',
            'publication_year.max' => 'The publication year must not exceed 9999.',
        ];
    }
}
