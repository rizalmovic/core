<?php

namespace Rizalmovic\Core\Providers;

require __DIR__.'/../../vendor/autoload.php';

use Illuminate\Support\ServiceProvider;
class CoreServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        include(__DIR__.'/../helpers.php');

        $this->publishes([__DIR__.'/../../factories' => base_path('database/factories')], 'factories');
        $this->publishes([__DIR__.'/../../migrations' => base_path('database/migrations')], 'migrations');
        $this->publishes([__DIR__.'/../../seeds' => base_path('database/seeds')], 'seeds');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Rizalmovic\Core\Contracts\RoleInterface', 'Rizalmovic\Core\Repositories\RoleRepository');
        $this->app->bind('Rizalmovic\Core\Contracts\UserInterface', 'Rizalmovic\Core\Repositories\UserRepository');
        $this->app->register(\Former\FormerServiceProvider::class);

        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Former', \Former\Facades\Former::class);
    }
}
