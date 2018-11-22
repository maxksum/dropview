<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\RefreshTokenEvent;
use SpotifyWebAPI;
use JavaScript;
use Carbon;

class MainController extends Controller
{
    protected $client;
    protected $session;

    public function index() {
      $data['atoken'] = $this->session->getAccessToken();
      return view('welcome', $data);
    }

    public function __construct(SpotifyWebAPI\Session $spotify) {
      $client = new SpotifyWebAPI\SpotifyWebAPI;

      $accessToken = $spotify->getAccessToken();

      $client->setAccessToken($accessToken);

      $this->session = $spotify;
      $this->client = $client;
    }

    public function refreshToken() {
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
      $this->session = $session;
      event(new RefreshTokenEvent($session->getAccessToken()));

      return $session->getAccessToken();
    }

}
