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
    }

    public function boot()
    {
        //
    }
}
