<?php

namespace App\Providers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public const DEFAULT_STRING_LENGTH = 191;

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
        Schema::defaultStringLength(self::DEFAULT_STRING_LENGTH);

        if (!app()->environment('production')) {
            Mail::alwaysTo(env('MAIL_TO_DEVELOPER', ''));
        }
    }
}
