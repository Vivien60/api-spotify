<?php

namespace infrastructure\dal\api\Spotify\utils;

use infrastructure\dal\api\contracts\internal\UrlForCodeAbstract;
use infrastructure\dal\api\Spotify\client\ClientForToken;

class UrlForCode extends UrlForCodeAbstract
{
    public const string SCOPE = 'user-library-modify app-remote-control playlist-modify-private playlist-modify-public playlist-read-collaborative playlist-read-private streaming user-follow-read user-library-read user-modify-playback-state user-read-currently-playing user-read-email user-read-playback-position user-read-playback-state user-read-private user-read-recently-played user-top-read';

    public function __construct(ClientForToken $client, mixed $clientId, string $redirectUri)
    {
        parent::__construct($client, $clientId, $redirectUri);
    }

}