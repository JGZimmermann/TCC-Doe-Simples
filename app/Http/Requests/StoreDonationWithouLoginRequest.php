<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDonationWithouLoginRequest extends FormRequest
{
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
            'donor_id' => 'prohibited',
            'user_id' => 'prohibited',
            'hour_id' => 'required|integer',
            'status' => 'prohibited',
            'name' => 'required|string',
            'blood_type' => ['required', Rule::in(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-', 'N/A'])],
            'birth_date' => 'required|date_format:Y-m-d|before_or_equal:today',
            'phone_number' => 'required|string|regex:/^[0-9]{10,11}$/'
        ];
    }
}
