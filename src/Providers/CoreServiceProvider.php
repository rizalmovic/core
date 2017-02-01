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
        // Service Binder
        $this->app->bind('Rizalmovic\Core\Contracts\RoleInterface', 'Rizalmovic\Core\Repositories\RoleRepository');
        $this->app->bind('Rizalmovic\Core\Contracts\UserInterface', 'Rizalmovic\Core\Repositories\UserRepository');
        $this->app->bind('Rizalmovic\Core\Contracts\SettingInterface', 'Rizalmovic\Core\Repositories\SettingRepository');

        // Register Service Provider
        $this->app->register(\Former\FormerServiceProvider::class);

        // Register Alias
        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Former', \Former\Facades\Former::class);
    }
}
