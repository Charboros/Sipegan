<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePenelitianRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'nim_nisn' => 'required|string|max:50',
            'institution' => 'required|string|max:255',
            'study_program' => 'required|string|max:255',
            'research_title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'document' => 'required|file|mimes:pdf|max:2048',
        ];
    }
}
