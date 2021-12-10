<?php

namespace App\Providers;


use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \App\Events\RegisterMailEvent::class => [
            \App\Listeners\RegisterMailListener::class,
        ],
        \App\Events\WorkPermitMailEvent::class => [
            \App\Listeners\WorkPermitMailListener::class,
        ],
    ];

    public function boot()
    {
        parent::boot();
    }

}
