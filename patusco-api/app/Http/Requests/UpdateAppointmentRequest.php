<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAppointmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->hasRole('doctor') || $this->user()->hasRole('receptionist');
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

