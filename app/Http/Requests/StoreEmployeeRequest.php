<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEmployeeRequest extends FormRequest
{
    /**
     * Determine if the users is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_type' => ['required', Rule::in(['admin', 'clinician', 'attendant'])],
            'name' => 'required|string',
            'password' => 'required|min:8',
            'blood_type' => ['sometimes', Rule::in(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-', 'N/A'])],
            'cpf' => 'sometimes|string|unique:users,cpf|regex:/^\d{11}$/',
            'birth_date' => 'sometimes|date_format:Y-m-d|before_or_equal:today',
        ];
    }
}
