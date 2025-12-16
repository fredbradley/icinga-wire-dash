<?php

namespace FredBradley\IcingaWireDash;

use FredBradley\IcingaWireDash\Livewire\Dashboard;
use FredBradley\IcingaWireDash\Livewire\Tiles\HostHeadlines;
use FredBradley\IcingaWireDash\Livewire\Tiles\ProblemHosts;
use FredBradley\IcingaWireDash\Livewire\Tiles\ProblemServices;
use Illuminate\Support\ServiceProvider;
use Livewire;

class IcingaWireDashServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'icinga-wire-dash');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'icinga-wire-dash');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('icinga-wire-dash.php'),
            ], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/icinga-wire-dash'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/icinga-wire-dash'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/icinga-wire-dash'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }

        Livewire::component('icinga-dash', Dashboard::class);
        Livewire::component('host-headlines', HostHeadlines::class);
        Livewire::component('problem-hosts', ProblemHosts::class);
        Livewire::component('problem-services', ProblemServices::class);

        \Spatie\Dashboard\Facades\Dashboard::stylesheet('https://cdn-uicons.flaticon.com/uicons-regular-rounded/css/uicons-regular-rounded.css');
        \Spatie\Dashboard\Facades\Dashboard::inlineStylesheet('.table { border-collapse:separate;border-spacing:1px;width:100%;table-layout:auto;} .table td {padding:5px;}');

    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'icinga-wire-dash');

        // Register the main class to use with the facade
        $this->app->singleton('icinga-wire-dash', function () {
            return new IcingaWireDash;
        });
    }
}
