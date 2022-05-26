<?php

namespace App\Providers;

use App\Models\Roles;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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
        Blade::if('moderator', function () {
            if (auth()->user()){
               return auth()->user()->id_role == Roles::query()->where('name', '=', 'moderator')->get('id');
            }
            return  false;
        });
        Blade::if('administrator', function () {
            if (auth()->user()){
                return auth()->user()->id_role == Roles::query()->where('name', '=', 'administrator')->get('id');
            }
            return  false;
        });
    }
}
