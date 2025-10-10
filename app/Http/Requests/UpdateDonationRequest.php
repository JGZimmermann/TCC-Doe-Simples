<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDonationRequest extends FormRequest
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
            'donor_id' => 'prohibited',
            'user_id' => 'prohibited',
            'hour_id' => 'prohibited',
            'status' => ['required', Rule::in(['pending', 'accepted', 'rejected'])],
            'name' => 'prohibited',
            'blood_type' => 'prohibited',
            'birth_date' => 'prohibited',
            'phone_number' => 'prohibited'
        ];
    }
}
