<?php

namespace App\Providers;

use App\Models\Reservation;
use App\Models\Review;
use App\Models\Yacht;
use App\Observers\ReservationObserver;
use App\Observers\ReviewObserver;
use App\Observers\YachtObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

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
        Model::unguard();

    }
}
