<?php

namespace Obelaw\Groupium;

use Illuminate\Support\ServiceProvider;

class GroupiumServiceProvider extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/groupium.php',
            'obelaw.groupium'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/groupium.php' => config_path('obelaw/groupium.php'),
            ], ['obelaw:groupium', 'obelaw:groupium:config']);

            $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views/vendor/obelaw-ui'),
            ], ['obelaw:groupium', 'obelaw:groupium:views']);
        }
    }
}
