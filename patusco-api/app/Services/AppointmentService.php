<?php

namespace App\Services;

use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class AppointmentService
{
    public function getAppointments(): array|object
    {
        $user = Auth::user();

        return match (true) {
            $user->hasRole('receptionist') => Appointment::all(),
            $user->hasRole('doctor') => Appointment::where('doctor_id', $user->id)->get(),
            $user->hasRole('customer') => Appointment::where('customer_id', $user->id)->get(),
            default => []
        };
    }

    public function createAppointment($data): Appointment
    {
        $data['customer_id'] = Auth::id();
        return Appointment::create($data);
    }

    public function updateAppointment(Appointment $appointment, $data): bool
    {
        return $appointment->update($data);
    }

    public function deleteAppointment(Appointment $appointment): ?bool
    {
        return $appointment->delete();
    }
}
