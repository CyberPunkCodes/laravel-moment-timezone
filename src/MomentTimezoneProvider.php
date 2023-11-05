<?php

namespace CyberPunkCodes\MomentTimezone;

use CyberPunkCodes\MomentTimezone\Components\Moment;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class MomentTimezoneProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/moment.php', 'moment'
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'moment');

        Blade::component('moment', Moment::class, config('moment.prefix', ''));

        Blade::directive('momentScripts', function (string $expression) {
            $scripts = config('moment.assets.scripts');

            if ( isset($scripts) && is_array($scripts) && ! empty($scripts) ) {
                return implode(PHP_EOL, $scripts);
            }
        });

        if ($this->app->runningInConsole()) {
            /**
             * Publishing config files
             */
            $this->publishes([
                __DIR__.'/../config/moment.php' => config_path('moment.php')
            ], 'moment-config');

            /**
             * Publishing view files
             */
            $this->publishes([
                __DIR__.'/../resources/views' => $this->app->resourcePath('views/vendor/moment'),
            ], 'moment-views');
        }
    }
}
