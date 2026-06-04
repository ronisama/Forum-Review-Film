<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

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
        Paginator::useBootstrapFive();
        View::composer('*', function ($view) {

            $jumlahNotif = 0;

            if (Auth::check()) {

                $jumlahNotif = Notification::where(
                    'user_id',
                    Auth::id()
                )
                    ->where('is_read', false)
                    ->count();
            }

            $view->with(
                'jumlahNotif',
                $jumlahNotif
            );
        });
    }
}
