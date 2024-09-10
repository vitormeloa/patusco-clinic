<?php

namespace App\Http\Requests;

use App\Enums\RoleEnum;
use Illuminate\Foundation\Http\FormRequest;

class CreateAppointmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->hasRole(RoleEnum::CUSTOMER) || $this->user()->hasRole(RoleEnum::RECEPCIONIST);
    }

    public function rules(): array
    {
        return [
            'animal_name' => 'required|string|max:255',
            'animal_type' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'symptoms' => 'required|string|max:500',
            'appointment_date' => 'required|date|after_or_equal:today',
            'period' => 'required|in:morning,afternoon',
        ];
    }
}

