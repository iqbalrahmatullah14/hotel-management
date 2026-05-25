<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\HotelConfigManager;
use App\Facades\BookingFacade;
use App\Services\RoomService;
use App\Services\GuestService;
use App\Services\PricingService;
use App\Services\PaymentService;

class HotelServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(HotelConfigManager::class, function () {
            return HotelConfigManager::getInstance();
        });

        $this->app->singleton(BookingFacade::class, function ($app) {
            return new BookingFacade(
                $app->make(RoomService::class),
                $app->make(GuestService::class),
                $app->make(PricingService::class),
                $app->make(PaymentService::class),
            );
        });
    }

    public function boot(): void
    {
        //
    }
}
