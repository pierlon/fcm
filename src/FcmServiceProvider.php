<?php

namespace NotificationChannels\Fcm;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class FcmServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->app->when(FcmChannel::class)
            ->needs(Client::class)
            ->give(function () {
                return new Client([
                    'base_uri' => config('broadcasting.connections.fcm.url', FcmChannel::DEFAULT_API_URL),
                    'headers'  => [
                        'Authorization' => sprintf('key=%s', config('broadcasting.connections.fcm.key')),
                        'Content-Type'  => 'application/json',
                    ],
                ]);
            });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

    }
}
