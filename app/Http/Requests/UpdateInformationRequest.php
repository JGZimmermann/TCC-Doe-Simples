<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInformationRequest extends FormRequest
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
            'email' => 'sometimes|string|email|max:255',
            'phone_number' => 'sometimes|string|regex:/^[0-9]{10,11}$/',
            'address' => 'sometimes|string|min:10|max:255',
        ];
    }
}
