<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

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
        Validator::extend('filter', function ($attribute, $value, $parameters, $validator) {
        return !in_array(strtolower($value), array_map('strtolower', $parameters));
        }, 'The :attribute must not be this value.'
        );
    }

}
