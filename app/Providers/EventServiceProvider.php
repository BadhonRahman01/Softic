<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use App\Events\MoneyAdded;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use App\Listeners\SendCommissionNotification;
use App\Notifications\CommissionNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        MoneyAdded::class => [
            SendCommissionNotification::class,
            // CommissionNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
