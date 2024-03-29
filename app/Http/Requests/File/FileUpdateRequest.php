<?php

namespace App\Http\Requests\File;

use Illuminate\Foundation\Http\FormRequest;

class FileUpdateRequest extends FormRequest
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
            'name' => 'required',
            'file' => 'required|mimes:pdf|max:102400'
        ];
    }

    public function messages()
    {
        return [
            'file.required' => 'File is require.',
            'file.mimes' => 'File must be a PDF.',
            'file.max' => 'File should not be 10mb over.',
            'name.required' => 'The book name is require.'
        ];
    }
}
