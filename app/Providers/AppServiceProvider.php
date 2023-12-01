<?php

namespace App\Providers;

use App\Models\Notification;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::composer('layout.petani', function ($view) {
            $user = auth()->user();
            $latestNotification = Notification::where('user_id', $user->id)
                ->latest()
                ->first();
            $view->with('notification', $latestNotification);
        });
    }
}
