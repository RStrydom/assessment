<?php

declare(strict_types=1);

namespace TaskFighter;

// Framework
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class TaskFighterServiceProvider extends ServiceProvider
{
    /**
     * The namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace for building
     * named routes.
     *
     * @var string
     */
    protected $namespace = 'TaskFighter\Controllers';

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
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

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map(): void
    {
        Route::prefix('tasks')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(__DIR__ . '/routes.php');
    }
}
