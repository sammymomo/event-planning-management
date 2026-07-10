<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;

class NotificationService
{
    public static function send(User $user, string $message): void
    {
        Notification::create([
            'user_id'     => $user->id,
            'message'     => $message,
            'read_status' => false,
        ]);
    }
}
