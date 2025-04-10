<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            \App\Repositories\Contracts\RoomRepositoryInterface::class,
            \App\Repositories\RoomRepository::class
        );

        $this->app->bind(
            \App\Repositories\Contracts\CustomerRepositoryInterface::class,
            \App\Repositories\CustomerRepository::class
        );

        $this->app->bind(
            \App\Repositories\Contracts\CustomerTypeRepositoryInterface::class,
            \App\Repositories\CustomerTypeRepository::class
        );

        $this->app->bind(
            \App\Repositories\Contracts\ReservationRepositoryInterface::class,
            \App\Repositories\ReservationRepository::class
        );
        // $this->app->bind(
        //     \App\Repositories\Contracts\RoomTypeRepositoryInterface::class,
        //     \App\Repositories\RoomTypeRepository::class
        // );
    }

    public function boot()
    {
        //
    }
}
