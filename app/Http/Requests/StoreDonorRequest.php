<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDonorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_type' => 'prohibited',
            'username' => 'prohibited',
            'name' => 'required|string',
            'email' => 'required|string|email|max:255',
            'phone_number' => 'required|string|regex:/^[0-9]{10,11}$/',
            'address' => 'required|string|min:10|max:255',
            'password' => 'required|min:8',
            'blood_type' => ['required', Rule::in(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-', 'N/A'])],
            'cpf' => 'required|string|unique:users,cpf|regex:/^\d{11}$/',
            'birth_date' => 'required|date_format:Y-m-d|before_or_equal:today',
        ];
    }

    public function messages(): array
    {
        return [
            'cpf.regex' => 'O campo CPF deve conter exatamente 11 dígitos, sem pontos ou traços.',
            'birth_date.before_or_equal' => 'A data de nascimento não pode ser uma data futura.',
        ];
    }
}
