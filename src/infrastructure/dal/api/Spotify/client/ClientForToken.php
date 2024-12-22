<?php

namespace infrastructure\dal\api\Spotify\client;

use infrastructure\dal\api\contracts\internal\ClientForTokenInterface;

class ClientForToken extends Client implements ClientForTokenInterface
{
    public const string BASE_URI = 'https://accounts.spotify.com/';
}