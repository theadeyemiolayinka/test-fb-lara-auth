<?php

namespace TheAdeyemiOlayinka\FbLaraAuth;

use Illuminate\Support\ServiceProvider;

class FbLaraAuthServiceProvider extends ServiceProvider{
        
    /**
     * Boot the provider
     *
     * @return void
     */
    public function boot()
    {
        //$this->loadRoutesFrom(__DIR__.'/routes/routes.php');
        //$this->loadViewsFrom(__DIR__.'/resources/views', 'FbLaraAuth');
        $this->addPublishes();
        $this->addCommands();
    }

    /**
     * Register publishable assets
     *
     * @return void
     */
    public function addPublishes()
    {
        $this->publishes([
            __DIR__.'/../config/fb-lara-auth.php' => config_path('fb-lara-auth.php'),
        ], 'fb-lara-auth.config');
    }

    /**
     * Add commands
     *
     * @return void
     */
    protected function addCommands()
    {
        // Console only commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                Commands\InstallCommand::class,
            ]);
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/fb-lara-auth.php', 'fb-lara-auth');
    }
}

?>