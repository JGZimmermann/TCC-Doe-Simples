<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAvailableHourRequest extends FormRequest
{
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
        $allowedTimes = ['08:00', '09:00', '10:00', '11:00', '13:00', '14:00', '15:00', '16:00'];

        return [
            'employee_id' => ['required', Rule::exists('users', 'id')->where('user_type', 'clinician')],
            'days_of_week'   => 'required|array|min:1',
            'days_of_week.*' => 'integer|between:1,5',
            'times'   => 'required|array|min:1',
            'times.*' => ['required', Rule::in($allowedTimes)],
            'availability' => 'prohibited'
        ];
    }
}
