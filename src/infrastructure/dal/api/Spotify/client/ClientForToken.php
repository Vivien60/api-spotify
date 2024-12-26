<?php

namespace infrastructure\dal\api\Spotify\client;

use infrastructure\dal\api\musicService\contracts\ClientForTokenInterface;

class ClientForToken extends Client implements ClientForTokenInterface
{
    public const string BASE_URI = 'https://accounts.spotify.com/';
}