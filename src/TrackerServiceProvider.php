<?php
namespace Salem\Tracker;

use Illuminate\Support\ServiceProvider;

class TrackerServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__.'/config/tracker.php', 'tracker');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->registerHelper();
        $this->loadRoutesFrom(__DIR__.'/routes/routes.php');

        $this->publishes([
            __DIR__.'/config/tracker.php' => config_path('tracker.php')
        ], 'config');

        $this->publishes([
            __DIR__.'/database/migrations/' => database_path('migrations')
        ], 'migrations');

    }

    /**
     * Register helper file
     * 
     * @return void
    */
    public function registerHelper()
    {
        if (file_exists($file = __DIR__.'/helpers/helper.php'))
        {
            require_once $file;
        }
    }
}