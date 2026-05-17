<?php

namespace App\Enums;

enum RegistrationStatus: string
{
    case Confirmed = 'confirmed';
    case Canceled = 'canceled';
    case Attended = 'attended';
}
