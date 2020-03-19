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
        $this->app->bind(
            'App\Repositories\ProjectRepositoryInterface',
            'App\Repositories\Eloquent\ProjectRepository'
        );

        $this->app->bind(
            'App\Repositories\TaskRepositoryInterface',
            'App\Repositories\Eloquent\TaskRepository'
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
