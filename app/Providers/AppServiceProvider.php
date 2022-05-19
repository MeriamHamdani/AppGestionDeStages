<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
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
        
        $project_title = 'Gestion Des Stages';
        View::share('title', $project_title);   
        //Blade::if('super',Request::user()->hasRole('superadmin'));
        Blade::if('super', function () {
            return Auth::check() && Auth::user()->hasRole('superadmin');});
        
    }
}