<?php

namespace App\Services;

use App\Models\AuditLog;
use App\Models\User;

class AuditLogger
{
    public static function log(User $user, string $action): void
    {
        AuditLog::create([
            'user_id' => $user->id,
            'action' => $action,
            'timestamp' => now(),
        ]);
    }
}
