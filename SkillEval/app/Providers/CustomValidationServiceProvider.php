<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class CustomValidationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('unique_not_deleted', function ($attribute, $value, $parameters, $validator) {
            $table = $parameters[0] ?? null;

            if (!$table) {
                return true;
            }

            return \DB::table($table)
                ->where($attribute, $value)
                ->whereNull('deleted_at')
                ->count() === 0;
        });
    }
}
