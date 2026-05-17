<?php

namespace App\Enums;

enum UserRole: string
{
    case User = 'user';
    case Organizer = 'organizer';
    case Volunteer = 'volunteer';
    case Admin = 'admin';
    case Sponsor = 'sponsor';
}
