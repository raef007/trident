<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Users
        $this->app->bind(
            'App\User\Interfaces\UserInterface',
            'App\User\Repositories\UserEloquent'
        );

        // Community
        $this->app->bind(
            'App\Estate\Interfaces\CommunityInterface',
            'App\Estate\Repositories\CommunityEloquent'
        );

        // Unit
        $this->app->bind(
            'App\Estate\Interfaces\UnitInterface',
            'App\Estate\Repositories\UnitEloquent'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
