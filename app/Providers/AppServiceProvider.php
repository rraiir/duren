<?php

namespace App\Providers;

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
        View::share('namaSistem', config('duren.nama'));
        View::share('taglineSistem', config('duren.tagline'));
        View::share('waAdminSistem', config('duren.wa_admin'));
        View::share('alamatSistem', config('duren.alamat'));
    }
}
