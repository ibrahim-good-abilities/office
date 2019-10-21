<?php

namespace App\Providers;


use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use App\Notification;
use Illuminate\Support\Facades\View;
use Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);


    }
}
