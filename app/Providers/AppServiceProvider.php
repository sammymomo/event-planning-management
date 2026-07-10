<?php

namespace App\Providers;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        View::composer('layouts.navigation', function ($view) {
            $unreadCount = Auth::check()
                ? Notification::where('user_id', Auth::id())->where('read_status', false)->count()
                : 0;

            $view->with('unreadNotificationCount', $unreadCount);
        });
    }
}
