<?php

namespace SocialCAPI\Facebook;

use Illuminate\Support\ServiceProvider;

class FBServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/fb-capi.php', 'fb-capi');
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../../config/fb-capi.php' => $this->app->configPath('fb-capi.php'),
        ], 'config');
    }
}
