<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ResponseService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ResponseService::class, function(){
            return (new ResponseService());
        });
    }
}
