<?php

namespace SysthaTech\Meeting;

use Illuminate\Support\ServiceProvider;

class MeetingServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadMigrationsFrom(__DIR__ . '/migrations');
        $this->publishes([
            __DIR__ . '/seeds/AgentsTableSeeder.php' => database_path('seeds/AgentsTableSeeder.php')
        ]);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('command.systhatech.meeting-install', function($app) {
            return $app['SysthaTech\Meeting\Commands\InstallCommand'];
        });
        $this->commands('command.systhatech.meeting-install');
    }
}
