<?php

namespace App\Enums;

enum RoleEnum: string
{
    case CUSTOMER = 'customer';
    case DOCTOR = 'doctor';
    case RECEPTIONIST = 'receptionist';
}
