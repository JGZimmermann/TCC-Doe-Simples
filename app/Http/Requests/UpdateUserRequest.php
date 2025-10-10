<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the users is authorized to make this request.
     */
    public function authorize(): bool
    {
        $userToUpdate = $this->route('users');
        return auth()->check() || $this->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_type' => 'prohibited',
            'name' => 'sometimes|string',
            'email' => 'sometimes|string|email|max:255',
            'password' => 'sometimes|min:8',
            'blood_type' => ['sometimes', Rule::in(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-', 'N/A'])],
            'cpf' => 'sometimes|string|unique:users,cpf|regex:/^\d{11}$/',
            'birth_date' => 'sometimes|date_format:Y-m-d|before_or_equal:today',
            'address' => 'sometimes|string|min:10|max:255',
            'number' => 'sometimes|string|regex:/^[0-9]{10,11}$/',
        ];
    }
}
