<?php

namespace App\Providers;
use App\Models\Notification;
use Illuminate\Support\ServiceProvider;
use View;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::share('notifications', Notification::latest()->get());
        View::composer('*', function ($view) {
            $unreadCount = 0;
            if (Auth::check()) {
                $unreadCount = Notification::where('user_id', Auth::id())
                    ->whereNull('read_at')
                    ->count();
            }
            $view->with('unreadCount', $unreadCount);
        });
    }
}

