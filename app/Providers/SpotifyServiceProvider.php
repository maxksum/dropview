<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use SpotifyWebAPI;

class SpotifyServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
      $this->app->singleton('SpotifyWebAPI\Session', function ($app) {
         $session = new SpotifyWebAPI\Session(
             env('SPOTIFY_CLIENT_ID'),
             env('SPOTIFY_CLIENT_SECRET'),
             env('SPOTIFY_CALLBACK_URL')
         );

         $scopes = [
             'user-read-email',
             'user-read-private',
         ];

         $session->requestCredentialsToken($scopes);
         return $session;

     });
    }
}
