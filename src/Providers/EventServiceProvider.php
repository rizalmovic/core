<?php

namespace Rizalmovic\Core\Providers;

require __DIR__.'/../../vendor/autoload.php';

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        '\Rizalmovic\Core\Events\UserRegistrationEvent' => [
            '\Rizalmovic\Core\Listeners\UserRegistrationEventListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
