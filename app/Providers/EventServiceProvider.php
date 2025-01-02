<?php

namespace App\Providers;

use App\Events\SubtaskCompleted;
use App\Listeners\NotifySubtaskCompletion;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        SubtaskCompleted::class => [
            NotifySubtaskCompletion::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }
}
