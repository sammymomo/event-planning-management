<?php

namespace App\Policies;

use App\Models\Sponsorship;
use App\Models\User;
class SponsorshipPolicy
{
    public function create(User $user): bool
    {
        return $user->isSponsor();
    }

    public function update(User $user, Sponsorship $sponsorship): bool
    {
        return !$sponsorship->acknowledged && $sponsorship->sponsor_id === $user->id;
    }
}
