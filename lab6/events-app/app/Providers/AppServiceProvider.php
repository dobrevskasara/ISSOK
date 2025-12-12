<?php

namespace App\Providers;

use App\Models\Event;
use App\Models\Organizer;
use App\Observers\EventObserver;
use App\Observers\OrganizerObserver;

use App\Repositories\Event\EventRepository;
use App\Repositories\Event\EventRepositoryInterface;
use App\Repositories\Organizer\OrganizerRepository;
use App\Repositories\Organizer\OrganizerRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(EventRepositoryInterface::class, EventRepository::class);
        $this->app->bind(OrganizerRepositoryInterface::class, OrganizerRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Organizer::observe(OrganizerObserver::class);
        Event::observe(EventObserver::class);
    }
}
