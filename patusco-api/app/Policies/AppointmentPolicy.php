<?php

namespace App\Policies;

use App\Enums\RoleEnum;
use App\Models\Appointment;
use App\Models\User;

class AppointmentPolicy
{
    public function view(User $user, Appointment $appointment): bool
    {
        if ($user->hasRole(RoleEnum::RECEPTIONIST)) {
            return true;
        }

        if ($user->hasRole(RoleEnum::DOCTOR)) {
            return $appointment->doctor_id == $user->id;
        }

        return $appointment->customer_id == $user->id;
    }

    public function create(User $user): bool
    {
        return $user->hasRole(RoleEnum::CUSTOMER) || $user->hasRole(RoleEnum::RECEPTIONIST);
    }

    public function update(User $user, Appointment $appointment): bool
    {
        if ($user->hasRole(RoleEnum::RECEPTIONIST)) {
            return true;
        }

        if ($user->hasRole(RoleEnum::DOCTOR)) {
            return $appointment->doctor_id == $user->id;
        }

        return false;
    }

    public function delete(User $user, Appointment $appointment): bool
    {
        return $user->hasRole(RoleEnum::RECEPTIONIST);
    }
}
