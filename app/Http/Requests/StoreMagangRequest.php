<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreMagangRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Anyone can submit magang
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
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'nim_nisn' => 'required|string|max:50',
            'participant_category' => 'required|in:Sekolah Menengah Kejuruan,Perguruan Tinggi',
            'institution' => 'required|string|max:255',
            'study_program' => 'required|string|max:255',
            'birth_place' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'address' => 'required|string',
            'magang_months' => 'required|array',
            'magang_months.*' => 'string',
            'advisor_name' => 'nullable|string|max:255',
            'advisor_phone' => 'nullable|string|max:50',
            'document' => 'required|file|mimes:pdf|max:2048',
        ];
    }
}
