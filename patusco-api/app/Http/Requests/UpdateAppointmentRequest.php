<?php

namespace App\Http\Requests;

use App\Enums\RoleEnum;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAppointmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->hasRole(RoleEnum::DOCTOR) || $this->user()->hasRole(RoleEnum::RECEPTIONIST);
    }

    public function rules(): array
    {
        return [
            'animal_name' => 'sometimes|required|string|max:255',
            'animal_type' => 'sometimes|required|string|max:255',
            'age' => 'sometimes|required|integer|min:0',
            'symptoms' => 'sometimes|required|string|max:500',
            'appointment_date' => 'sometimes|required|date|after_or_equal:today',
            'period' => 'sometimes|required|in:morning,afternoon',
            'status' => 'sometimes|required|in:pending,completed,cancelled',
        ];
    }
}

